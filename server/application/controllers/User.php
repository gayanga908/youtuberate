<?php

/**
 * Created by PhpStorm.
 * User: Tharindu Gayanga
 * Date: 3/6/2017
 * Time: 11:03 AM
 */
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;

class User extends CI_Controller
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
        $this->load->model('user_model');
        $this->load->model('videos_model');
    }

    function index()
    {
        $metod = $_SERVER['REQUEST_METHOD'];

        switch ($metod) {
            case 'GET':
                $this->getUserBookmarkVideos();
                break;

            case 'POST' :
                $this->createUser();

                break;
            case 'PUT':

                break;

            case 'DELETE':

                break;
        }

    }

    function createUser(){

        $data = file_get_contents("php://input");
        $json = json_decode($data, true);
        $con['conditions'] = array('email' => $json['username']);
        $checkLogin = $this->user_model->login_auth($con);
        if ($checkLogin) {
            $return = array(
                'error' => 'User Already Exists'

            );
        }else if (!$checkLogin) {
            $reg_user_array = array('firstName' => $json['firstName'], 'lastName' => $json['lastName'], 'email' => $json['username'], 'password' => md5($json['password']));
            $reg_msg = $this->user_model->register_users($reg_user_array);
            $return = array(
                'error' => '',
                'reg_msg' => $reg_msg
            );
        } else {
            $return = array(
                'error' => 'Something went wrong'

            );
        }


        echo json_encode($return);
    }

    function getUserBookmarkVideos(){
        $headerData =  $this->input->get_request_header('Authorization');
        $token = JWT::decode($headerData, "Youtube RAte Secret key!",  array('HS256'));
        $bookmarks = $this->videos_model->getBookmarkedVideos($token->username);
       echo json_encode($bookmarks);



    }
}