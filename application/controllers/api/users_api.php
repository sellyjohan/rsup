<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';

class users_api extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->helper(['auth', 'log_helper', 'jwt']);
        $this->load->config('jwt');

        $headers = $this->input->request_headers();
        if (!isset($headers['Authorization'])) {
            show_error('Token not provided', 401);
        }

        $authHeader = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $authHeader);

        $decoded = validate_jwt($token);

        if (!$decoded) {
            show_error('Invalid or expired token', 401);
        }

        // Simpan data user dari token untuk digunakan nanti
        $this->user_data = $decoded;
        
        if (!in_array($decoded->role, ['admin'])) {
            show_error('Access denied', 403);
        }
    }

    public function index_get() {
        $search = $this->get('search');
        $page = (int)$this->get('page') ?: 1;
        $per_page = 10;
        $offset = ($page - 1) * $per_page;
    
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'users.role_id = roles.id', 'left');
    
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.full_name', $search);
            $this->db->or_like('users.username', $search);
            $this->db->or_like('roles.name', $search);
            $this->db->group_end();
        }
    
        // --- Clone query untuk total count ---
        $count_query = clone $this->db;
        $total = $count_query->count_all_results();
    
        // --- Pagination ---
        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        $users = $query->result();
    
        $last_page = ceil($total / $per_page);
    
        $this->response([
            'data' => $users,
            'current_page' => $page,
            'last_page' => $last_page,
            'total' => $total
        ], 200);
    }

    public function user_get($id)
    {
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'users.role_id = roles.id', 'left');
        $this->db->where('users.id', $id);
        $user = $this->db->get()->row();

        if ($user) {
            $this->response(['data' => $user], 200);
        } else {
            $this->response(['message' => 'User tidak ditemukan'], 404);
        }
    }

    public function create_post()
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if (!$this->User_model->validate_user_data($data)) {
            $this->response(['error' => validation_errors()], 400);
            return;
        }

        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $insert_id = $this->User_model->insert_user($data);
        log_activity("Menambahkan user baru dengan ID $insert_id");
        $this->response(['id' => $insert_id, 'message' => 'User berhasil ditambahkan'], 201);
    }

    public function update_put($id)
    {
        $data = json_decode($this->input->raw_input_stream, true);

        if (!$this->User_model->validate_user_data($data, $is_update = true)) {
            $this->response(['error' => validation_errors()], 400);
            return;
        }

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }

        $updated = $this->User_model->update_user($id, $data);
        if ($updated) {
            log_activity("Mengupdate user ID $id");
            $this->response(['message' => 'User berhasil diupdate'], 200);
        } else {
            $this->response(['message' => 'User tidak ditemukan atau tidak berubah'], 404);
        }
    }

    public function delete_delete($id)
    {
        $deleted = $this->User_model->delete_user($id);
        if ($deleted) {
            log_activity("Menghapus user ID $id");
            $this->response([
                'status' => 'success',
                'message' => 'User berhasil dihapus'
              ], 200);
        } else {
            $this->response([
                'status' => 'error',
                'message' => 'User tidak ditemukan'
              ], 404);
        }
    }
}
