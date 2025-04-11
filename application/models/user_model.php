<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_user($username, $password)
    {
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'users.role_id = roles.id');
        $this->db->where('users.username', $username);

        $user = $this->db->get()->row_array();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return null;
    }

    public function get_all_users()
    {
        return $this->db->get('users')->result();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function insert_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        return $this->db->affected_rows() > 0;
    }

    public function delete_user($id)
    {
        $this->db->delete('users', ['id' => $id]);
        return $this->db->affected_rows() > 0;
    }

    public function validate_user_data($data, $is_update = false)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_data($data);

        $this->form_validation->set_rules('username', 'User Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        if (!$is_update || !empty($data['password'])) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        }
        $this->form_validation->set_rules('role_id', 'Role', 'required|trim');

        return $this->form_validation->run();
    }
}
