<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Login - Braveia LMS";
            $this->load->view('layout/header', $data);
            $this->load->view('auth/login');
            $this->load->view('layout/footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->User_model->get_user_by_email($email);

            if ($user && password_verify($password, $user->password)) {
                $session_data = [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'role_name' => $user->role_name,
                    'is_logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);
                
                // Redirect based on role
                if (in_array($user->role_name, ['Super Admin', 'Admin'])) {
                    redirect('admin/dashboard');
                } else {
                    redirect('dashboard');
                }
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah!');
                redirect('auth/login');
            }
        }
    }

    public function register()
    {
        if ($this->session->userdata('is_logged_in')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Daftar - Braveia LMS";
            $this->load->view('layout/header', $data);
            $this->load->view('auth/register');
            $this->load->view('layout/footer');
        } else {
            $role_name = $this->input->post('role') == 'corporate' ? 'Corporate' : 'Peserta';
            $role = $this->User_model->get_role_by_name($role_name);
            
            // Fallback if role is not found (Needs seeder later)
            $role_id = $role ? $role->id : 4; 

            $data = [
                'name' => htmlspecialchars($this->input->post('name', TRUE)),
                'email' => htmlspecialchars($this->input->post('email', TRUE)),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => $role_id,
                'is_active' => 1
            ];

            $this->User_model->register($data);
            $this->session->set_flashdata('success', 'Pendaftaran berhasil! Silakan login.');
            redirect('auth/login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
