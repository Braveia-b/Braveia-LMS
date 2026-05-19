<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('is_logged_in') || !in_array($this->session->userdata('role_name'), ['Super Admin', 'Admin'])) {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('auth/login');
        }
        $this->load->model('Training_model');
    }

    public function index()
    {
        $data['title'] = "Manajemen Pelatihan - Braveia LMS";
        $data['trainings'] = $this->Training_model->get_all_trainings();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/training/index', $data);
        $this->load->view('admin/layout/footer');
    }
}
