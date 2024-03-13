<?php

    if (!defined('BASEPATH'))
    {
        exit('No direct script access allowed');
    }

    class Index extends MY_Controller
    {

        public $session;
        
        public function __construct()
        {
            parent::__construct();
            $this->load->setTemplate('blank');
            $this->load->library('commonlib');
            $this->load->library('session');
            $this->load->model('User_model');
        }

        public function dashboard()
        {
            $dataArray = array();
            $this->load->setTemplate('admin');
            $this->load->helper('url');
//            p($_SESSION);
            $user_type = $this->session->userdata('user_type');
//            p($user_type);
            $dataArray['user_type'] = $user_type;
            $this->load->view('dashboard', $dataArray);
        }

    }
    