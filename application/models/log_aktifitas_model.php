<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_aktivitas_model extends CI_Model
{
    private $table = 'log_aktivitas';

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function get_all() {
        $this->db->order_by('waktu', 'DESC');
        return $this->db->get($this->table)->result();
    }

    public function get_by_user($user_id) {
        return $this->db->get_where($this->table, ['user_id' => $user_id])->result();
    }
}
