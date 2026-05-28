<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certification_model extends CI_Model {

    public function list_certificates($limit = 50, $offset = 0)
    {
        if (!$this->db->table_exists('certificates')) return [];

        $this->db->select('certificates.*, users.name AS user_name, users.email AS user_email, trainings.title AS training_title');
        $this->db->from('certificates');
        $this->db->join('users', 'users.id = certificates.user_id', 'left');
        $this->db->join('trainings', 'trainings.id = certificates.training_id', 'left');
        $this->db->order_by('certificates.issued_at', 'DESC');
        $this->db->limit((int)$limit, (int)$offset);
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert('certificates', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', (int)$id);
        return $this->db->delete('certificates');
    }

    public function get_participants()
    {
        $this->db->select('id, name, email');
        $this->db->from('users');
        $this->db->where('role_id', 4);
        $this->db->where('is_active', 1);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function get_trainings()
    {
        $this->db->select('id, title');
        $this->db->from('trainings');
        $this->db->order_by('title', 'ASC');
        return $this->db->get()->result();
    }
}

