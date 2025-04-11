<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class token_model extends CI_Model {

    public function save_token($data) {
        return $this->db->insert('user_tokens', $data);
    }

    public function get_token($token) {
        $this->db->where('refresh_token', $token);
        return $this->db->get('user_tokens')->row_array();
    }

    public function delete_token($token) {
        $this->db->where('refresh_token', $token);
        return $this->db->delete('user_tokens');
    }

    public function delete_tokens_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->delete('user_tokens');
    }
}
