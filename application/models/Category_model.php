<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

    public function get_all()
    {
        $this->db->order_by('name', 'ASC');
        return $this->db->get('training_categories')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('training_categories', $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('training_categories', ['id' => $id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('training_categories', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('training_categories');
    }
}

