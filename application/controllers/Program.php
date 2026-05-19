<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Training_model');
        // Pastikan user sudah login
        if (!$this->session->userdata('is_logged_in')) {
            $this->session->set_flashdata('error', 'Silakan login terlebih dahulu untuk mengakses program.');
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data['title'] = "Semua Program - Braveia LMS";
        $data['trainings'] = $this->Training_model->get_all_trainings();
        $user_id = $this->session->userdata('user_id');
        
        // Ambil data program apa saja yang sudah di-enroll oleh user ini
        $enrolled = $this->Training_model->get_user_trainings($user_id);
        $data['enrolled_ids'] = array_column($enrolled, 'training_id');
        
        $this->load->view('layout/header', $data);
        $this->load->view('program/index');
        $this->load->view('layout/footer');
    }

    public function enroll($training_id)
    {
        $user_id = $this->session->userdata('user_id');
        
        if ($this->Training_model->enroll_user($user_id, $training_id)) {
            $this->session->set_flashdata('success', 'Berhasil memilih program! Anda sekarang dapat mengakses materi program tersebut.');
        } else {
            $this->session->set_flashdata('error', 'Anda sudah memilih program ini sebelumnya atau terjadi kesalahan.');
        }
        
        redirect('dashboard');
    }
}
