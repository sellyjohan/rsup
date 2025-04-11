<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('File_model');
        $this->load->model('Log_aktivitas_model');
    }

    public function upload($pasien_id) {
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg|docx';
        $config['max_size']      = 2048;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $this->session->set_flashdata('error', $this->upload->display_errors());
        } else {
            $upload_data = $this->upload->data();

            $data = [
                'pasien_id' => $pasien_id,
                'file_path' => 'uploads/' . $upload_data['file_name'],
                'file_name' => $upload_data['client_name']
            ];

            $this->File_model->insert($data);

            $this->Log_aktivitas_model->insert([
                'user_id' => $this->session->userdata('user_id'),
                'aktivitas' => 'Upload file untuk pasien ID: ' . $pasien_id
            ]);

            $this->session->set_flashdata('success', 'File berhasil diupload.');
        }

        redirect('pasien/detail/' . $pasien_id);
    }

    public function download($id) {
        $file = $this->File_model->get_by_id($id);

        if ($file) {
            force_download($file->file_path, NULL);
        } else {
            show_404();
        }
    }

    public function hapus($id) {
        $file = $this->File_model->get_by_id($id);
        if ($file) {
            unlink($file->file_path);
            $this->File_model->delete($id);
        }
        redirect('pasien/detail/' . $file->pasien_id);
    }
}
