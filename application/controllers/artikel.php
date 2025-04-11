<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artikel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        check_login();
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('artikel/artikel_list');
        $this->load->view('layout/footer');
    }
    
    public function create($id = null) {
        check_role(['admin', 'editor']); 
        $this->load->view('layout/header');
        $this->load->view('artikel/artikel_form', ['id' => $id]);
        $this->load->view('layout/footer');
    }

}
