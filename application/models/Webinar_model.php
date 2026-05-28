<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webinar_model extends CI_Model {

    public function get_all($limit = 50, $offset = 0)
    {
        if (!$this->db->table_exists('webinars')) return [];
        $this->db->select('webinars.*, users.name AS speaker_name');
        $this->db->from('webinars');
        $this->db->join('users', 'users.id = webinars.speaker_id', 'left');
        $this->db->order_by('webinars.schedule_datetime', 'DESC');
        $this->db->limit((int)$limit, (int)$offset);
        return $this->db->get()->result();
    }

    public function count_all()
    {
        if (!$this->db->table_exists('webinars')) return 0;
        return (int) $this->db->count_all('webinars');
    }

    public function get_by_id($id)
    {
        if (!$this->db->table_exists('webinars')) return null;
        return $this->db->get_where('webinars', ['id' => (int)$id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('webinars', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', (int)$id);
        return $this->db->update('webinars', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', (int)$id);
        return $this->db->delete('webinars');
    }

    public function get_speakers()
    {
        // speaker_id is a user_id; allow mentors/admins as speakers
        $this->db->select('id, name, role_id');
        $this->db->from('users');
        $this->db->where_in('role_id', [1,2,3]);
        $this->db->where('is_active', 1);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }
}

