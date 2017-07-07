<?php

/**
 * Created by PhpStorm.
 * User: Tharindu Gayanga
 * Date: 3/7/2017
 * Time: 9:52 PM
 */
class Videos_model extends CI_Model
{
    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    function checkVideoExists($params = array())
    {
        $this->db->select('*');
        $this->db->from('videos');

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("video_id", $params)) {
            $this->db->where('video_id', $params['video_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $query = $this->db->get();
            $result = $query->row_array();

        }

        //return fetched data
        return $result;
    }

    function saveVideos($save_Video_array){

        // Saving new users
        $this->db->trans_start();
        $this->db->insert('videos', $save_Video_array);
        $this->db->trans_complete();

        if ($this->db->trans_status() === True) {
            $save_msg = "Video Save Successful";
        } else {
            $save_msg = "Video Save Unsuccessful";
        }

        return $save_msg;
    }

    function checkVideoBookmarked($params = array())
    {
        $this->db->select('*');
        $this->db->from('bookmark');

        //fetch data by conditions
        if (array_key_exists("conditions", $params)) {
            foreach ($params['conditions'] as $key => $value) {
                $this->db->where($key, $value);
            }
        }

        if (array_key_exists("video_id", $params)) {
            $this->db->where('video_id', $params['video_id']);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $query = $this->db->get();
            $result = $query->row_array();

        }

        //return fetched data
        return $result;
    }

    function bookmarkVideos($bookmark_video_array){
// Saving new users
        $this->db->trans_start();
        $this->db->insert('bookmark', $bookmark_video_array);
        $this->db->trans_complete();

        if ($this->db->trans_status() === True) {
            $msg = "Video Bookmark Successful";
        } else {
            $msg = "Video Bookmark Unsuccessful";
        }

        return $msg;
    }

    function getBookmarkedVideos($username)
    {
        $this->db->select('*');
        $this->db->from('videos');
        $this->db->join('bookmark', 'bookmark.video_id = videos.video_id');
        $this->db->where_in('bookmark.username', $username);
        $this->db->order_by('bookmark_id', 'DESC');
        $query = $this->db->get();
        foreach ($query->result_array() as $row)
        {
            $data[] = $row;
        }
        if (isset($data)){
            return $data;
        }




    }
}