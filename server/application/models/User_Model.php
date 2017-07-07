<?php

/**
 * Created by PhpStorm.
 * User: Tharindu Gayanga
 * Date: 3/1/2017
 * Time: 10:05 PM
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    function login_auth($params = array())
    {
        $this->db->select('*');
        $this->db->from('user');

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("id", $params)) {
            $this->db->where('id', $params['id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $query = $this->db->get();
            $result = $query->row_array();

        }

        //return fetched data
        return $result;
    }

    function register_users($reg_user_array)
    {
        // Saving new users
        $this->db->trans_start();
        $this->db->insert('user', $reg_user_array);
        $this->db->trans_complete();

        if ($this->db->trans_status() === True) {
            $reg_msg = "1";
        } else {
            $reg_msg = "0";
        }

        return $reg_msg;
    }
}