<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Cek login
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = "Dashboard Peserta - Braveia LMS";
        
        $this->load->model('Training_model');
        $user_id = $this->session->userdata('user_id');
        $data['enrolled_programs'] = $this->Training_model->get_user_trainings($user_id);
        
        $this->load->view('layout/header', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('layout/footer');
    }
}
