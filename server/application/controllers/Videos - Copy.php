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

        ini_set('max_execution_time', 100);
        $search_Key = $this->input->get('search_key');

        $client = new Google_Client();
        $client->useApplicationDefaultCredentials();
        $client->setApplicationName("My Application");
        $client->setScopes(array('https://www.googleapis.com/auth/youtube', 'https://www.googleapis.com/auth/youtube.force-ssl'));
        // Define an object that will be used to make all API requests.
        $youtube = new Google_Service_YouTube($client);
//        $language = new NaturalLanguageClient(['projectId' => 'my_project']);
        $sentiment = new \PHPInsight\Sentiment();


        $searchResponse = $youtube->search->listSearch('id,snippet', array(
            'q' => $search_Key,
            'maxResults' => '10')
        );

//        $videos = '';
//        $channels = '';
//        $playlists = '';

        // Add each result to the appropriate list, and then display the lists of
        // matching videos, channels, and playlists.
        foreach ($searchResponse['items'] as $searchResult) {
            switch ($searchResult['id']['kind']) {
                case 'youtube#video':
                    $videoStat = $youtube->videos->listVideos('statistics', array(
                        'id' => $searchResult['id']['videoId']
                    ));
                    foreach ($videoStat as $videoStatistics) {
                        $commentCount =  $videoStatistics['statistics']['commentCount'];
                    }
                    if ($commentCount > 0){
//                    $videos .= sprintf('<li>%s (%s) </li> ', $searchResult['snippet']['title'], $searchResult['id']['videoId']);
                        $videoCommentThreads_Und = $youtube->commentThreads->listCommentThreads('snippet', array(
                            'videoId' => $searchResult['id']['videoId'],
                            'searchTerms' => 'understand',
                            'maxResults' => '80'
                        ));
                        $htmlBody_Und = '';
                        $count = '0';
                        foreach ($videoCommentThreads_Und as $comment_Und) {
                            $htmlBody_Und .= ($comment_Und['snippet']['topLevelComment']['snippet']['textDisplay'] . '.');
                            $count++;
                        }
                        if ($count > 0){
//                    $annotation = $language->annotateText($htmlBody);

                        $class_Und = $sentiment->categorise($htmlBody_Und);
                        $scores_Und = $sentiment->score($htmlBody_Und);


                            if ($class_Und === "neg") {
                                $scores_Und = ( 10 - ($scores_Und[$class_Und] * 10)) * ( 5 / 30 );
                            } elseif ($scores_Und === 'neu') {
                                $scores_Und = ($scores_Und[$class_Und] * 10) * ( 5 / 30 );
                            } else {
                                $scores_Und = (($scores_Und[$class_Und] * 20) + 10) * ( 5 / 30 );
                            }
//                    $videos.=$htmlBody;

//                        $videoCommentThreads_Vid = $youtube->commentThreads->listCommentThreads('snippet', array(
//                            'videoId' => $searchResult['id']['videoId'],
//                            'searchTerms' => 'video quality',
//                            'maxResults' => '20'
//                        ));
//                        $htmlBody_Vid = '';
//                        foreach ($videoCommentThreads_Vid as $comment_Vid) {
//                            $htmlBody_Vid .= ($comment_Vid['snippet']['topLevelComment']['snippet']['textDisplay'] . '.');
//                        }
////                    $annotation = $language->annotateText($htmlBody);
//
//                        $class_Vid = $sentiment->categorise($htmlBody_Vid);
//                        $scores_Vid = $sentiment->score($htmlBody_Vid);
////                    $videos.=$htmlBody;
//                        if ($class_Und === "neg"){
//                            $scores_Vid = ($scores_Vid[$class_Vid] * 10) * 0.25;
//                        }else{
//                            $scores_Vid = ($scores_Vid[$class_Vid] * 10) * 0.25;
//                        }

                            $searchList[] = array(
                                'video' => $searchResult['snippet']['title'],
                                'video_description' => $searchResult['snippet']['description'],
                                'video_id' => $searchResult['id']['videoId'],
                                'thumb' => $searchResult['snippet']['thumbnails']["default"]['url'],
                                'score_und' => $scores_Und,
                                'class_und' => $class_Und,
                                'count' => $count,
//                            'score_vid' => $scores_Vid,
//                            'class_vid' => $class_Vid,

                            );
                        }else{
                            $searchListUnreted[] = array(
                                'video' => $searchResult['snippet']['title'],
                                'video_description' => $searchResult['snippet']['description'],
                                'video_id' => $searchResult['id']['videoId'],
                                'thumb' => $searchResult['snippet']['thumbnails']["default"]['url'],
//                                'score_und' => $scores_Und,
//                                'class_und' => $class_Und,
                                'count' => $count,
//                            'score_vid' => $scores_Vid,
//                            'class_vid' => $class_Vid,

                            );
                        }
//

                    }else{
                        continue;
                    }

//                    $senti_score = $annotation->sentiment();
//                  $videos .=  $scores [$class] . $class . '<br>';
                    break;
//                case 'youtube#channel':
//                    $channels .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'], $searchResult['id']['channelId']);
//                    break;
//                case 'youtube#playlist':
//                    $playlists .= sprintf('<li>%s (%s)</li>', $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
//                    break;
            }
        }


//        $scores = $sentiment->score("hate you, disslike you and will kill you");
//        $class = $sentiment->categorise("hate you, disslike you and will kill you");


    echo json_encode(array('rated' => $searchList, 'unrated' => $searchListUnreted) );
//   echo json_encode($searchList);
//var_dump($searchResponse);




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
                    'video_id' => $json['video_id']
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
                'count' =>$json['count'],
                'class_und' =>$json['class_und']
                );
            $save_Vid_msg = $this->videos_model->saveVideos($save_Video_array);

            $bookmark_video_array = array(
                'username' => $token->username,
                'video_id' => $json['video_id']
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