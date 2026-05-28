<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_model extends CI_Model {

    public function get_all_trainings()
    {
        $this->db->select('trainings.*, training_categories.name as category_name, users.name as mentor_name');
        $this->db->from('trainings');
        $this->db->join('training_categories', 'training_categories.id = trainings.category_id');
        $this->db->join('users', 'users.id = trainings.mentor_id');
        return $this->db->get()->result();
    }

    public function get_published_trainings($limit = null)
    {
        $this->db->select('trainings.*, training_categories.name as category_name, users.name as mentor_name');
        $this->db->from('trainings');
        $this->db->join('training_categories', 'training_categories.id = trainings.category_id');
        $this->db->join('users', 'users.id = trainings.mentor_id');
        $this->db->where('trainings.is_published', 1);
        $this->db->order_by('trainings.created_at', 'DESC');
        if ($limit !== null) {
            $this->db->limit((int) $limit);
        }
        return $this->db->get()->result();
    }

    public function get_published_detail($id)
    {
        $this->db->select('trainings.*, training_categories.name as category_name, users.name as mentor_name, users.email as mentor_email');
        $this->db->from('trainings');
        $this->db->join('training_categories', 'training_categories.id = trainings.category_id');
        $this->db->join('users', 'users.id = trainings.mentor_id');
        $this->db->where('trainings.id', (int) $id);
        $this->db->where('trainings.is_published', 1);
        return $this->db->get()->row();
    }

    public function insert($data)
    {
        return $this->db->insert('trainings', $data);
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('trainings', ['id' => (int)$id])->row();
    }

    public function update($id, $data)
    {
        $this->db->where('id', (int)$id);
        return $this->db->update('trainings', $data);
    }

    public function delete($id)
    {
        $this->db->where('id', (int)$id);
        return $this->db->delete('trainings');
    }

    public function get_categories()
    {
        $this->db->order_by('name', 'ASC');
        return $this->db->get('training_categories')->result();
    }

    public function get_mentors_for_select()
    {
        $this->db->select('id, name, email');
        $this->db->from('users');
        $this->db->where('role_id', 3);
        $this->db->where('is_active', 1);
        $this->db->order_by('name', 'ASC');
        return $this->db->get()->result();
    }

    public function get_user_trainings($user_id)
    {
        $this->db->select('trainings.*, training_categories.name as category_name, users.name as mentor_name, user_enrollments.enrolled_at');
        $this->db->from('user_enrollments');
        $this->db->join('trainings', 'trainings.id = user_enrollments.training_id');
        $this->db->join('training_categories', 'training_categories.id = trainings.category_id');
        $this->db->join('users', 'users.id = trainings.mentor_id');
        $this->db->where('user_enrollments.user_id', $user_id);
        $this->db->order_by('user_enrollments.enrolled_at', 'DESC');
        return $this->db->get()->result();
    }

    public function check_enrollment($user_id, $training_id)
    {
        return $this->db->get_where('user_enrollments', [
            'user_id' => $user_id,
            'training_id' => $training_id
        ])->num_rows() > 0;
    }

    public function enroll_user($user_id, $training_id)
    {
        if (!$this->check_enrollment($user_id, $training_id)) {
            return $this->db->insert('user_enrollments', [
                'user_id' => $user_id,
                'training_id' => $training_id
            ]);
        }
        return false;
    }
}
