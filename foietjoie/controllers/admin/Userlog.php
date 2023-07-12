<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userlog extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->session->set_userdata('top_menu', 'Reports');
        $this->session->set_userdata('sub_menu', 'userlog/index');
        $data['title'] = "JOURNAL UTILISATEUR";
        $data['page'] = 'list';
        $data['table'] = 'style';
        $userlogList = $this->userlog_model->get();
        $data['userlogList'] = $userlogList;

        $this->load->view('layout/header', $data);
        $this->load->view('admin/userlog/userlogList', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>