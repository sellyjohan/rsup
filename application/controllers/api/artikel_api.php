<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'libraries/REST_Controller.php';

class Artikel_api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('artikel_model');
        $this->load->config('jwt');
        $this->load->helper(['auth', 'log_helper', 'jwt']);
        header('Content-Type: application/json');
    }

    private function authenticate() {
        $headers = $this->input->request_headers();
        if (!isset($headers['Authorization'])) {
            $this->response([
                'status' => 'error',
                'message' => 'Token not provided'
            ], 401);
        }

        $authHeader = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authHeader);

        $decoded = validate_jwt($token);

        if (!$decoded) {
            $this->response([
                'status' => 'error',
                'message' => 'Invalid or expired token'
            ], 401);
        }

        $this->user_data = $decoded;
        return $decoded;
    }

    public function index_get()
    {
        $search = $this->input->get('search');
        $page = (int) $this->input->get('page') ?: 1;
        $limit = 5; 
        $offset = ($page - 1) * $limit;

        $result = $this->artikel_model->get_all($search, $limit, $offset);
        $total = $this->artikel_model->count_all($search);

        $this->response([
            'status' => 'success',
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        ]);
    }

    public function detail_get($id)
    {
        $this->authenticate();

        $data = $this->artikel_model->get_by_id($id);
        if ($data) {
            $this->response([
                'status' => 'success',
                'message' => 'Data artikel ditemukan',
                'data' => $data
            ], 200);
        } else {
            $this->response([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }
    }

    public function create_post()
    {
        $user = $this->authenticate();
        
        if (!in_array($user->role, ['admin', 'editor'])) {
            show_error('Access denied', 403);
        }

        header('Content-Type: application/json');

        $judul = $this->input->post('title');
        $konten = $this->input->post('content');

        if (empty($judul) || empty($konten)) {
            http_response_code(400);
            echo json_encode(['message' => 'Judul dan konten wajib diisi.']);
            return;
        }

        $file_path = null;
        $file_type = null;

        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                http_response_code(400);
                echo json_encode(['message' => $this->upload->display_errors('', '')]);
                return;
            }

            $uploadData = $this->upload->data();
            $file_path = 'uploads/' . $uploadData['file_name'];
            $file_type = $uploadData['file_ext'] === '.pdf' ? 'pdf' : 'image';
        }

        $data = [
            'title' => $judul,
            'content' => $konten,
            'file_path' => $file_path,
            'file_type' => $file_type,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $id = $this->artikel_model->insert($data);

        return $this->response([
            'status' => 'success',
            'message' => 'Artikel berhasil dibuat',
            'data' => ['id' => $id]
        ], 201);
    }


    public function update_post($id)
    {
        $user = $this->authenticate();
        if (!in_array($user->role, ['admin', 'editor'])) {
            show_error('Access denied', 403);
        }

        header('Content-Type: application/json');

        // Ambil data lama dari DB
        $artikelLama = $this->artikel_model->get_by_id($id);
        if (!$artikelLama) {
            return $this->response([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        $judul = $this->input->post('title');
        $konten = $this->input->post('content');

        if (empty($judul) || empty($konten)) {
            http_response_code(400);
            echo json_encode(['message' => 'Judul dan konten wajib diisi.']);
            return;
        }

        $file_path = $artikelLama['file_path'];
        $file_type = $artikelLama['file_type'];

        if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf|jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                http_response_code(400);
                echo json_encode(['message' => $this->upload->display_errors('', '')]);
                return;
            }

            $uploadData = $this->upload->data();
            $file_path = 'uploads/' . $uploadData['file_name'];
            $file_type = $uploadData['file_ext'] === '.pdf' ? 'pdf' : 'image';

            // Hapus file lama jika perlu
            if (!empty($artikelLama['file_path']) && file_exists($artikelLama['file_path'])) {
                unlink($artikelLama['file_path']);
            }
        }

        $data = [
            'title' => $judul,
            'content' => $konten,
            'file_path' => $file_path,
            'file_type' => $file_type,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $updated = $this->artikel_model->update($id, $data);

        if ($updated) {
            $this->response([
                'status' => 'success',
                'message' => 'Artikel berhasil diperbarui'
            ], 200);
        } else {
            $this->response([
                'status' => 'error',
                'message' => 'Gagal memperbarui artikel'
            ], 400);
        }
    }


    public function delete_delete($id) {
        $user = $this->authenticate();
        if (!in_array($user->role, ['admin'])) {
            show_error('Access denied', 403);
        }

        $deleted = $this->artikel_model->delete($id);

        if ($deleted) {
            $this->response([
                'status' => 'success',
                'message' => 'Artikel berhasil dihapus'
            ], 200);
        } else {
            $this->response([
                'status' => 'error',
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }
    }
}
