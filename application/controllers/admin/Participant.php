<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Participant extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Participant_model');
    }

    public function index()
    {
        $data['title'] = 'Peserta — Admin';

        $filters = [
            'q' => $this->input->get('q', true),
            'status' => $this->input->get('status', true), // active|inactive
        ];

        $page = max(1, (int)$this->input->get('page'));
        $per_page = 15;
        $offset = ($page - 1) * $per_page;

        $data['filters'] = $filters;
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        $data['total'] = $this->Participant_model->count_participants($filters);
        $data['participants'] = $this->Participant_model->list_participants($filters, $per_page, $offset);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/participant/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function toggle($id)
    {
        $user = $this->Participant_model->get_by_id($id);
        if (!$user) {
            $this->session->set_flashdata('error', 'Peserta tidak ditemukan.');
            redirect('admin/participant');
            return;
        }

        $next = !$user->is_active;
        if ($this->Participant_model->set_active($id, $next)) {
            $this->session->set_flashdata('success', 'Status peserta berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui status peserta.');
        }
        redirect('admin/participant');
    }
}

