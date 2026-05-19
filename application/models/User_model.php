<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function register($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_email($email)
    {
        $this->db->select('users.*, roles.name as role_name');
        $this->db->from('users');
        $this->db->join('roles', 'roles.id = users.role_id');
        $this->db->where('users.email', $email);
        return $this->db->get()->row();
    }
    
    public function get_role_by_name($name)
    {
        return $this->db->get_where('roles', ['name' => $name])->row();
    }
}
