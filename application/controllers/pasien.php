<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pasien_model');
        $this->load->model('Log_aktivitas_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['pasien'] = $this->Pasien_model->get_all();
        $this->load->view('pasien/index', $data);
    }

    public function detail($id) {
        $data['pasien'] = $this->Pasien_model->get_by_id($id);
        $this->load->view('pasien/detail', $data);
    }

    public function tambah() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[pasien.nik]');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pasien/tambah');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir')
            ];

            $this->Pasien_model->insert($data);

            $this->Log_aktivitas_model->insert([
                'user_id' => $this->session->userdata('user_id'),
                'aktivitas' => 'Menambahkan pasien baru: ' . $data['nama']
            ]);

            redirect('pasien');
        }
    }

    public function edit($id) {
        $data['pasien'] = $this->Pasien_model->get_by_id($id);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pasien/edit', $data);
        } else {
            $update_data = [
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'alamat' => $this->input->post('alamat'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir')
            ];

            $this->Pasien_model->update($id, $update_data);

            $this->Log_aktivitas_model->insert([
                'user_id' => $this->session->userdata('user_id'),
                'aktivitas' => 'Mengedit pasien: ' . $update_data['nama']
            ]);

            redirect('pasien');
        }
    }

    public function hapus($id) {
        $pasien = $this->Pasien_model->get_by_id($id);

        if ($pasien) {
            $this->Pasien_model->delete($id);

            $this->Log_aktivitas_model->insert([
                'user_id' => $this->session->userdata('user_id'),
                'aktivitas' => 'Menghapus pasien: ' . $pasien->nama
            ]);
        }

        redirect('pasien');
    }

    public function cari() {
        $keyword = $this->input->get('q');
        $data['pasien'] = $this->Pasien_model->search($keyword);
        $this->load->view('pasien/index', $data);
    }
}
