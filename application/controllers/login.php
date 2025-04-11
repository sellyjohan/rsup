<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index() {
        $data['error'] = $this->session->flashdata('error');
        $this->load->view('login_view', $data);
    }

    public function do_login() {
        $recaptchaResponse = $this->input->post('g-recaptcha-response');
        $secret = '6LeXCRIrAAAAAC1d0sHRuRh2gtzNSUVjiJsgssXL';

        $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}");
        $responseData = json_decode($verify);

        if (!$responseData->success) {
            $this->session->set_flashdata('error', 'reCAPTCHA verification failed.');
            redirect('login');
        }

        $this->load->model('User_model');

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->User_model->get_user($username, $password);

        if ($user) {
            $this->load->model('token_model');
            $this->load->config('jwt');
            $this->load->library('JWT_Lib');

            $key = $this->config->item('jwt_key');
            $issuedAt = time();
            $expireAt = $issuedAt + (60 * 60);

            $payload = [
                'iat' => $issuedAt,
                'exp' => $expireAt,
                'sub' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role_name']
            ];

            $token = $this->jwt_lib->encode($payload, $key, 'HS256');

            // Simpan token ke DB
            $this->token_model->save_token([
                'user_id' => $user['id'],
                'refresh_token' => $token,
                'expires_at' => date('Y-m-d H:i:s', $expireAt)
            ]);

            // Simpan ke session juga
            $this->session->set_userdata([
                'username' => $user['username'],
                'full_name' => $user['full_name'],
                'role' => $user['role_name'],
                'logged_in' => true,
                'jwt_token' => $token
            ]);

            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau password salah!');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
