<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        check_login();
    }

    public function index() {
        $role = $this->session->userdata('role');

        switch ($role) {
            case 'admin':
                $this->load->view('dashboard/admin');
                break;
            case 'editor':
                $this->load->view('dashboard/editor');
                break;
            case 'user':
                $this->load->view('dashboard/user');
                break;
            default:
                show_error('Unauthorized role');
        }
    }
}
