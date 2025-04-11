<?php
/**
 * application/controllers/Users.php
 * Controller untuk menampilkan halaman view Users
 * CRUD dilakukan via REST API
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login(); 
        check_role(['admin']); 
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('user/index'); 
        $this->load->view('layout/footer');
    }

}
