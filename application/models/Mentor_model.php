<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor_model extends CI_Model {

    public function get_all_mentors()
    {
        $this->db->select('mentors.*, users.name, users.email, users.is_active');
        $this->db->from('mentors');
        $this->db->join('users', 'users.id = mentors.user_id');
        $this->db->order_by('mentors.id', 'DESC');
        return $this->db->get()->result();
    }

    public function get_public_mentors()
    {
        $this->db->select('mentors.*, users.name, users.email, users.avatar, users.bio');
        $this->db->from('mentors');
        $this->db->join('users', 'users.id = mentors.user_id');
        $this->db->where('users.is_active', 1);
        $this->db->order_by('users.name', 'ASC');
        return $this->db->get()->result();
    }

    public function insert_mentor($user_data, $mentor_data)
    {
        $this->db->trans_start();

        // Insert into users table
        $this->db->insert('users', $user_data);
        $user_id = $this->db->insert_id();

        // Add user_id to mentor_data
        $mentor_data['user_id'] = $user_id;

        // Insert into mentors table
        $this->db->insert('mentors', $mentor_data);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function get_mentor_by_id($id)
    {
        $this->db->select('mentors.*, users.name, users.email, users.is_active');
        $this->db->from('mentors');
        $this->db->join('users', 'users.id = mentors.user_id');
        $this->db->where('mentors.id', $id);
        return $this->db->get()->row();
    }

    public function update_mentor($id, $user_data, $mentor_data)
    {
        $this->db->trans_start();

        // Get user_id first
        $mentor = $this->db->get_where('mentors', ['id' => $id])->row();
        
        if ($mentor) {
            // Update users table
            $this->db->where('id', $mentor->user_id);
            $this->db->update('users', $user_data);

            // Update mentors table
            $this->db->where('id', $id);
            $this->db->update('mentors', $mentor_data);
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function delete_mentor($id)
    {
        $this->db->trans_start();

        $mentor = $this->db->get_where('mentors', ['id' => $id])->row();
        
        if ($mentor) {
            // Delete mentor record
            $this->db->where('id', $id);
            $this->db->delete('mentors');

            // Delete user record (optional, depending on business logic, here we'll delete)
            $this->db->where('id', $mentor->user_id);
            $this->db->delete('users');
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}

