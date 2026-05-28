<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participant_model extends CI_Model {
    public function count_participants($filters = [])
    {
        $this->db->from('users');
        $this->db->where('role_id', 4);

        $q = trim((string)($filters['q'] ?? ''));
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('name', $q);
            $this->db->or_like('email', $q);
            $this->db->group_end();
        }

        $status = (string)($filters['status'] ?? '');
        if ($status === 'active') $this->db->where('is_active', 1);
        if ($status === 'inactive') $this->db->where('is_active', 0);

        return (int) $this->db->count_all_results();
    }

    public function list_participants($filters = [], $limit = 20, $offset = 0)
    {
        $this->db->select('id, name, email, phone, is_active, created_at');
        $this->db->from('users');
        $this->db->where('role_id', 4);

        $q = trim((string)($filters['q'] ?? ''));
        if ($q !== '') {
            $this->db->group_start();
            $this->db->like('name', $q);
            $this->db->or_like('email', $q);
            $this->db->group_end();
        }

        $status = (string)($filters['status'] ?? '');
        if ($status === 'active') $this->db->where('is_active', 1);
        if ($status === 'inactive') $this->db->where('is_active', 0);

        $this->db->order_by('created_at', 'DESC');
        $this->db->limit((int)$limit, (int)$offset);
        return $this->db->get()->result();
    }

    public function set_active($user_id, $is_active)
    {
        $this->db->where('id', (int)$user_id);
        $this->db->where('role_id', 4);
        return $this->db->update('users', ['is_active' => $is_active ? 1 : 0]);
    }

    public function get_by_id($user_id)
    {
        return $this->db->get_where('users', ['id' => (int)$user_id, 'role_id' => 4])->row();
    }
}

