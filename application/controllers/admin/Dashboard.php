<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek login dan role
        if (!$this->session->userdata('is_logged_in') || !in_array($this->session->userdata('role_name'), ['Super Admin', 'Admin'])) {
            $this->session->set_flashdata('error', 'Akses ditolak!');
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard Admin - Braveia LMS";
        
        // Memanggil layout AdminLTE
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/dashboard/index');
        $this->load->view('admin/layout/footer');
    }
}
