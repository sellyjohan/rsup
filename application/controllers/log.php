<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Log_aktivitas_model');
        $this->load->model('User_model');
    }

    public function index() {
        $data['log'] = $this->Log_aktivitas_model->get_all_with_user();
        $this->load->view('log/index', $data);
    }
}
