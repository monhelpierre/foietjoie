<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
define('THEMES_DIR', 'themes');
define('BASE_URI', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

class MY_Controller extends CI_Controller
{

    // protected $langs = array();

    public function __construct()
    {

        parent::__construct();
         $this->load->library('auth');
        // $this->load->library('module_lib');
      
        $this->load->helper('directory');
        $this->load->model('setting_model');
    }

}

class Admin_Controller extends MY_Controller
{
    protected $aaaa = false;
    public function __construct()
    {
        parent::__construct();
        $this->auth->is_logged_in();
        // $this->load->library('rbac');
    }

}


class Public_Controller extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

}

