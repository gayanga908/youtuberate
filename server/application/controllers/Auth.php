<?php

/**
 * Created by PhpStorm.
 * User: Tharindu Gayanga
 * Date: 3/1/2017
 * Time: 8:09 AM
 */
require_once 'vendor/autoload.php';
//require_once APPPATH . '/vendor/firebase/php-jwt/src/JWT.php';
// import JWT library
use \Firebase\JWT\JWT;

class Auth extends CI_Controller
{
    public function __construct()
    {
        // enable CORS on the server
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD']; // get request method from request header
        if($method == "OPTIONS") {
            die();
        }
        parent::__construct();
        $this->load->model('user_model'); // load user model

    }

    function index()
    {
        $metod = $_SERVER['REQUEST_METHOD'];

        switch ($metod) {
            case 'GET':
//                $this->userAuthentication();
                break;

            case 'POST' :

                $this->userAuthentication();
                break;
            case 'PUT':

                break;

            case 'DELETE':

                break;
        }

    }

    function userAuthentication()
    {

        $data = file_get_contents("php://input");       // get data from the request header
        $json = json_decode($data, true);               // decode data

        $con['conditions'] = array('email' => $json['username'], 'password' => md5($json['password']));
        $checkLogin = $this->user_model->login_auth($con);      // authenticate user
        if ($checkLogin) {
            $token['username'] = $json['username'];     // set token data
            $date = new DateTime();
            $token['iat'] = $date->getTimestamp();          // set token create time
            $token['exp'] = $date->getTimestamp() + 60*60;  // set token expire time


            $output = array(
              'username' => $json['username'],
              'error' => '',
              'id_token' => JWT::encode($token, "Youtube RAte Secret key!") // encode token
            );
//            $output[] ="";
//            $output['id_token'] = ;

        } else {
            $output['error'] ="Invalid Login";
        }
//        echo json_encode($msg);
//
//        $user = array('user' => $json['username'], 'pass' => $json['password'], 'msg' => 'success');





        echo json_encode($output);

    }
}