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

    public function insert($data)
    {
        return $this->db->insert('trainings', $data);
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
