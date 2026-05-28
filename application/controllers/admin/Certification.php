<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Certification extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Certification_model');
    }

    public function index()
    {
        $data['title'] = 'Sertifikasi — Admin';
        $data['certificates'] = $this->Certification_model->list_certificates(100, 0);
        $data['participants'] = $this->Certification_model->get_participants();
        $data['trainings'] = $this->Certification_model->get_trainings();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/certification/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function issue()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_id', 'Peserta', 'required|integer');
        $this->form_validation->set_rules('training_id', 'Program', 'required|integer');
        $this->form_validation->set_rules('certificate_number', 'Nomor Sertifikat', 'required');
        $this->form_validation->set_rules('file_path', 'File Path', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Validasi gagal. Pastikan semua field terisi.');
            redirect('admin/certification');
            return;
        }

        $data = [
            'user_id' => (int)$this->input->post('user_id', true),
            'training_id' => (int)$this->input->post('training_id', true),
            'certificate_number' => $this->input->post('certificate_number', true),
            'file_path' => $this->input->post('file_path', true),
        ];

        if ($this->Certification_model->insert($data)) {
            $this->session->set_flashdata('success', 'Sertifikat berhasil diterbitkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menerbitkan sertifikat.');
        }
        redirect('admin/certification');
    }

    public function delete($id)
    {
        if ($this->Certification_model->delete($id)) {
            $this->session->set_flashdata('success', 'Sertifikat berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus sertifikat.');
        }
        redirect('admin/certification');
    }
}

