<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mentor_model');
    }

    public function index()
    {
        $data['title'] = "Manajemen Mentor - Braveia Admin";
        $data['mentors'] = $this->Mentor_model->get_all_mentors();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/mentor/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add()
    {
        $data['title'] = "Tambah Mentor Baru - Braveia Admin";
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/mentor/add');
        $this->load->view('admin/layout/footer');
    }

    public function store()
    {
        // Validasi input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->add();
            return;
        }

        $user_data = [
            'role_id' => 3, // 3 = Mentor
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'is_active' => 1
        ];

        $mentor_data = [
            'expertise' => $this->input->post('expertise', true),
            'hourly_rate' => $this->input->post('hourly_rate', true) ?: 0
        ];

        if ($this->Mentor_model->insert_mentor($user_data, $mentor_data)) {
            $this->session->set_flashdata('success', 'Mentor baru berhasil ditambahkan!');
            redirect('admin/mentor');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
            redirect('admin/mentor/add');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Mentor - Braveia Admin";
        $data['mentor'] = $this->Mentor_model->get_mentor_by_id($id);
        
        if (!$data['mentor']) {
            $this->session->set_flashdata('error', 'Mentor tidak ditemukan.');
            redirect('admin/mentor');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/mentor/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update($id)
    {
        $mentor = $this->Mentor_model->get_mentor_by_id($id);

        if (!$mentor) {
            $this->session->set_flashdata('error', 'Mentor tidak ditemukan.');
            redirect('admin/mentor');
            return;
        }
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Lengkap', 'required');
        
        // Cek apakah email diubah
        if ($this->input->post('email') != $mentor->email) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        } else {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        }
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        $user_data = [
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'is_active' => $this->input->post('is_active') ? 1 : 0
        ];

        if (!empty($this->input->post('password'))) {
            $user_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $mentor_data = [
            'expertise' => $this->input->post('expertise', true),
            'hourly_rate' => $this->input->post('hourly_rate', true) ?: 0
        ];

        if ($this->Mentor_model->update_mentor($id, $user_data, $mentor_data)) {
            $this->session->set_flashdata('success', 'Data mentor berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }
        redirect('admin/mentor');
    }

    public function delete($id)
    {
        if ($this->Mentor_model->delete_mentor($id)) {
            $this->session->set_flashdata('success', 'Mentor berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus mentor.');
        }
        redirect('admin/mentor');
    }
}
