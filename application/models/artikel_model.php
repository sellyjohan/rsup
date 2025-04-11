<?php
class artikel_model extends CI_Model {

    public function get_all($search = null, $limit = 5, $offset = 0)
    {
        if ($search) {
            $this->db->like('title', $search);
            $this->db->or_like('content', $search);
        }

        $this->db->limit($limit, $offset);
        return $this->db->get('articles')->result();
    }

    public function count_all($search = null)
    {
        if ($search) {
            $this->db->like('title', $search);
            $this->db->or_like('content', $search);
        }

        return $this->db->count_all_results('articles');
    }

    public function get_by_id($id){
        return $this->db->get_where('articles', ['id' => $id])->row_array();
    }

    public function insert($data) {
        $this->db->insert('articles', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('articles', $data);
    }

    public function delete($id) {
        return $this->db->delete('articles', ['id' => $id]);
    }
}
