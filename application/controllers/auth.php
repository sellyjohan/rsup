<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login() {
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->get_by_username($username);

            if ($user && password_verify($password, $user->password)) {
                $this->session->set_userdata([
                    'user_id' => $user->id,
                    'username' => $user->username,
                    'role_id' => $user->role_id
                ]);
                redirect('pasien');
            } else {
                $this->session->set_flashdata('error', 'Username atau password salah.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
