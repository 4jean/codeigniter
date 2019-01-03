<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class My404 extends CI_Controller
{


    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function index()
    {
        $data['page_title'] = 'Page Not Found';
        $this->load->view('errors/my404', $data);
    }


}