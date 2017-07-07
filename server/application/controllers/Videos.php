<?php

/**
 * Created by PhpStorm.
 * User: Tharindu Gayanga
 * Date: 1/25/2017
 * Time: 12:04 PM
 */

require_once 'vendor/autoload.php';
require_once 'vendor/jwhennessey/phpinsight/autoload.php';
require_once APPPATH . 'third_party/Google/Client.php';
use Google\Cloud\NaturalLanguage\NaturalLanguageClient;
use \Firebase\JWT\JWT;
require_once APPPATH . 'third_party/Thread.php';

putenv('GOOGLE_APPLICATION_CREDENTIALS=' . APPPATH . 'third_party/Google/Final Project-6fca45bd784d.json');


class Videos extends CI_Controller
{
    public function __construct()
    {
        // enable CORS on the server
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('videos_model');

    }
    function index()
    {
        $metod = $_SERVER['REQUEST_METHOD'];

        switch ($metod) {
            case 'GET':
                $this->search_Videos();
                break;

            case 'POST' :

                $this->bookmarkVideos();
                break;
            case 'PUT':

                break;

            case 'DELETE':

                break;
        }

    }

    public function search_Videos()
    {
        // Change max timeout for requests
        ini_set('max_execution_time', 100);
        // get the search key from client application
        $search_Key = $this->input->get('search_key');

        //Google client library initialization
        $client = new Google_Client();
        // pass server api keys to the client library
        $client->useApplicationDefaultCredentials();
        $client->setApplicationName("My Application");
        // set client scopes for client library
        $client->setScopes(array(
                                'https://www.googleapis.com/auth/youtube',
                               'https://www.googleapis.com/auth/youtube.force-ssl'
                           )
        );
        //YouTube data api initialization
        $youtube = new Google_Service_YouTube($client);
        // phpInsight library initialization
        $sentiment = new \PHPInsight\Sentiment();

        // get the videos related to the search key
        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $search_Key,
            'maxResults' => '10')
        );


        // for each loop to traverse search result
        foreach ($searchResponse['items'] as $searchResult) {
            switch ($searchResult['id']['kind']) {
                case 'youtube#video':           // filter out only videos in the search result JSO
                    // get video statistics
                    $videoStat = $youtube->videos->listVideos('statistics', array('id' => $searchResult['id']['videoId']));
                    foreach ($videoStat as $videoStatistics) {
                        $commentCount = $videoStatistics['statistics']['commentCount'];
                    }           // get the comments count of the each video
                    if ($commentCount > 0) {
                        $videosWithComments[] = array(
                            'video' => $searchResult['snippet']['title'],
                            'video_description' => $searchResult['snippet']['description'],
                            'video_id' => $searchResult['id']['videoId'],
                            'thumb' => $searchResult['snippet']['thumbnails']["default"]['url'],
                        ); // insert videos that have comments to an array
                    } else {
                        continue;
                    }
                    break;
            }
        }

        foreach ($videosWithComments as $videosWithComments) {
            // get the comments containing ‘understand’ key word for each video
            $videoCommentThreads_Und = $youtube->commentThreads->listCommentThreads('snippet', array(
                'videoId' => $videosWithComments['video_id'],
                'searchTerms' => 'understand',
                'maxResults' => '20'
            ));
            $htmlBody_Und = '';
            $count_und = '0';

            //gets only the comment text from the result JSON and count number of comments found
            foreach ($videoCommentThreads_Und as $comment_Und) {
                $htmlBody_Und .= ($comment_Und['snippet']['topLevelComment']['snippet']['textDisplay'] . '.');
                $count_und++;
            }

            if ($count_und > 0) {
                $class_Und = $sentiment->categorise($htmlBody_Und);
                $score_Und = $sentiment->score($htmlBody_Und);
                $scores_Und = $this->rateAlgo($class_Und, $score_Und);
            } else {
                $scores_Und = '0';
            }

            // get the comments containing ‘video quality’ key words for each video
            $videoCommentThreads_Vid = $youtube->commentThreads->listCommentThreads('snippet', array(
                'videoId' => $videosWithComments['video_id'],
                'searchTerms' => 'video quality',
                'maxResults' => '20'
            ));
            $htmlBody_Vid = '';
            $count_vid = '0';

            //gets only the comment text from the result JSON and count number of comments found
            foreach ($videoCommentThreads_Vid as $comment_Vid) {
                $htmlBody_Vid .= ($comment_Vid['snippet']['topLevelComment']['snippet']['textDisplay'] . '.');
                $count_vid++;
            }

            if ($count_vid > 0) {
                $class_Vid = $sentiment->categorise($htmlBody_Vid);
                $scores_Vid = $sentiment->score($htmlBody_Vid);
                $scores_Vid = $this->rateAlgo($class_Vid, $scores_Vid);
            } else {
                $scores_Vid = '0';
            }
            // get the comments containing ‘Audio’ key word for each video
            $videoCommentThreads_Aud = $youtube->commentThreads->listCommentThreads('snippet', array(
                'videoId' => $videosWithComments['video_id'],
                'searchTerms' => 'Audio',
                'maxResults' => '20'
            ));
            $htmlBody_Aud = '';
            $count_Aud = '0';

            //gets only the comment text from the result JSON and count number of comments found
            foreach ($videoCommentThreads_Aud as $comment_Aud) {
                $htmlBody_Aud .= ($comment_Aud['snippet']['topLevelComment']['snippet']['textDisplay'] . '.');
                $count_Aud++;
            }

            if ($count_Aud > 0) {
                $class_Aud = $sentiment->categorise($htmlBody_Aud);
                $scores_Aud = $sentiment->score($htmlBody_Aud);
                $scores_Aud = $this->rateAlgo($class_Aud, $scores_Aud);
            } else {
                $scores_Aud = '0';
            }

            if ($scores_Und === '0' && $scores_Vid === '0' && $scores_Aud === '0'){
                $noRatedAspects = 0;
            } elseif ($scores_Und === '0' && $scores_Vid === '0' ){
                $noRatedAspects = 1;
            } elseif ($scores_Vid === '0' && $scores_Aud === '0'){
                $noRatedAspects = 1;
            } elseif ($scores_Und === '0' && $scores_Aud === '0'){
                $noRatedAspects = 1;
            } elseif ($scores_Und === '0' || $scores_Vid === '0' || $scores_Aud === '0'){
                $noRatedAspects = 2;
            } elseif ($scores_Und !== '0' && $scores_Vid !== '0' && $scores_Aud !== '0'){
                $noRatedAspects = 3;
            }



            if ($scores_Und === '0' && $scores_Vid === '0' && $scores_Aud === '0') {
                // insert all the unrated video details to an array
                $searchListUnreted[] = array(
                    'video' => $videosWithComments['video'],
                    'video_description' => $videosWithComments['video_description'],
                    'video_id' => $videosWithComments['video_id'],
                    'thumb' => $videosWithComments['thumb']

                );

            } else {
                // insert all the rated video details to an array
                $rating_Score = ($scores_Und + $scores_Vid + $scores_Aud) / $noRatedAspects;
                $searchList[] = array(
                    'video' => $videosWithComments['video'],
                    'video_description' => $videosWithComments['video_description'],
                    'video_id' => $videosWithComments['video_id'],
                    'thumb' => $videosWithComments['thumb'],
                    'score_und' => $scores_Und,
                    'count_und' => $count_und,
                    'score_vid' => $scores_Vid,
                    'count_vid' => $count_vid,
                    'score_aud' => $scores_Aud,
                    'count_aud' => $count_Aud,
                    'video_score' => $rating_Score


                );
            }

        }



        if (isset($searchList) == false) {
            $searchList = array(
               'Novideo' => 'No Videos'
            );
        } elseif (isset($searchListUnreted) == false) {
            $searchListUnreted = array(
                'Novideo' => 'No Videos'
            );
        }
        //return both arrays as a JSON object
        echo json_encode(array('rated' => $searchList, 'unrated' => $searchListUnreted));






    }

    function rateAlgo($sentiClass, $sentiScore){
        if ($sentiClass === "neg") {
            $sentiScore = (10 - ($sentiScore[$sentiClass] * 10)) * (5 / 30);
        } elseif ($sentiClass === 'neu') {
            $sentiScore = ($sentiScore[$sentiClass] * 10) * (5 / 30);
        } else {
            $sentiScore = (($sentiScore[$sentiClass] * 20) + 10) * (5 / 30);
        }
        return $sentiScore;
    }

    function bookmarkVideos(){
        $data = file_get_contents("php://input");
        $json = json_decode($data, true);

       $headerData =  $this->input->get_request_header('Authorization');
        $token = JWT::decode($headerData, "Youtube RAte Secret key!",  array('HS256'));
//        $json2 = json_decode($token, true);

        $con['conditions'] = array('video_id' => $json['video_id']);

        $checkVideoExists = $this->videos_model->checkVideoExists($con);

        if ($checkVideoExists) {
            $bookmark_con['conditions'] = array(
                'username' => $token->username,
                'video_id' => $json['video_id']
            );
            $checkVideoBookmarked = $this->videos_model->checkVideoBookmarked($bookmark_con);

            if ($checkVideoBookmarked) {
                $return = array(
                'msg' => 'Already Bookmarked'

            );
            } elseif (!$checkVideoBookmarked){
                $bookmark_video_array = array(
                    'username' => $token->username,
                    'video_id' => $json['video_id'],
                    'bookmark_date' => time()
                );
                $bookmark_Vid_Msg = $this->videos_model->bookmarkVideos($bookmark_video_array);
                $return = array(
                    'msg' => $bookmark_Vid_Msg
                );

            } else {
                $return = array(
                'msg' => 'Something went wrong'

            );
            }


        }else if (!$checkVideoExists) {
            $save_Video_array = array(
                'video_id' => $json['video_id'],
                'video' => $json['video'],
                'video_description' => $json['video_description'],
                'thumb' =>$json['thumb'],
                'score_und' =>$json['score_und'],
                'count_und' =>$json['count_und'],
                'score_vid' =>$json['score_vid'],
                'count_vid' =>$json['count_vid'],
                'score_aud' =>$json['score_aud'],
                'count_aud' =>$json['count_aud'],
                'video_score' =>$json['video_score']

                );
            $save_Vid_msg = $this->videos_model->saveVideos($save_Video_array);

            $bookmark_video_array = array(
                'username' => $token->username,
                'video_id' => $json['video_id'],
                'bookmark_date' => time()
            );
            $bookmark_Vid_Msg = $this->videos_model->bookmarkVideos($bookmark_video_array);
            $return = array(
                'msg' => $bookmark_Vid_Msg
            );

        } else {
            $return = array(
                'msg' => 'Something went wrong'

            );
        }
//        $json['header'] = $token;
//        $json['error msg'] = $return;
        echo json_encode($return);
    }



}