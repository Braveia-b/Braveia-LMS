<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webinar extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Webinar_model');
    }

    public function index()
    {
        $data['title'] = 'Event & Webinar — Admin';
        $data['webinars'] = $this->Webinar_model->get_all(100, 0);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/webinar/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add()
    {
        $data['title'] = 'Buat Webinar — Admin';
        $data['speakers'] = $this->Webinar_model->get_speakers();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/webinar/add', $data);
        $this->load->view('admin/layout/footer');
    }

    public function store()
    {
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('speaker_id', 'Speaker', 'required|integer');
        $this->form_validation->set_rules('schedule_datetime', 'Jadwal', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->add();
            return;
        }

        $title = $this->input->post('title', true);
        $data = [
            'title' => $title,
            'slug' => url_title($title, 'dash', true),
            'description' => $this->input->post('description', true),
            'speaker_id' => (int)$this->input->post('speaker_id', true),
            'thumbnail' => $this->input->post('thumbnail', true), // placeholder path/url
            'schedule_datetime' => $this->input->post('schedule_datetime', true),
            'zoom_link' => $this->input->post('zoom_link', true),
            'price' => (float)($this->input->post('price', true) ?: 0),
            'quota' => (int)($this->input->post('quota', true) ?: 100),
        ];

        if ($this->Webinar_model->insert($data)) {
            $this->session->set_flashdata('success', 'Webinar berhasil dibuat.');
            redirect('admin/webinar');
        } else {
            $this->session->set_flashdata('error', 'Gagal membuat webinar.');
            redirect('admin/webinar/add');
        }
    }

    public function edit($id)
    {
        $webinar = $this->Webinar_model->get_by_id($id);
        if (!$webinar) {
            $this->session->set_flashdata('error', 'Webinar tidak ditemukan.');
            redirect('admin/webinar');
            return;
        }

        $data['title'] = 'Edit Webinar — Admin';
        $data['webinar'] = $webinar;
        $data['speakers'] = $this->Webinar_model->get_speakers();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/webinar/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update($id)
    {
        $webinar = $this->Webinar_model->get_by_id($id);
        if (!$webinar) {
            $this->session->set_flashdata('error', 'Webinar tidak ditemukan.');
            redirect('admin/webinar');
            return;
        }

        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->form_validation->set_rules('title', 'Judul', 'required');
        $this->form_validation->set_rules('speaker_id', 'Speaker', 'required|integer');
        $this->form_validation->set_rules('schedule_datetime', 'Jadwal', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
            return;
        }

        $title = $this->input->post('title', true);
        $data = [
            'title' => $title,
            'slug' => url_title($title, 'dash', true),
            'description' => $this->input->post('description', true),
            'speaker_id' => (int)$this->input->post('speaker_id', true),
            'thumbnail' => $this->input->post('thumbnail', true),
            'schedule_datetime' => $this->input->post('schedule_datetime', true),
            'zoom_link' => $this->input->post('zoom_link', true),
            'price' => (float)($this->input->post('price', true) ?: 0),
            'quota' => (int)($this->input->post('quota', true) ?: 100),
        ];

        if ($this->Webinar_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Webinar berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui webinar.');
        }
        redirect('admin/webinar');
    }

    public function delete($id)
    {
        if ($this->Webinar_model->delete($id)) {
            $this->session->set_flashdata('success', 'Webinar berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus webinar.');
        }
        redirect('admin/webinar');
    }
}

