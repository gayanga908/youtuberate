<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public final function index()
    {
        $this->load->view("app/index");
    }
}
