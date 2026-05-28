<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
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

    public function add()
    {
        $data['title'] = "Tambah Program - Braveia LMS";
        $data['categories'] = $this->Training_model->get_categories();
        $data['mentors'] = $this->Training_model->get_mentors_for_select();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/training/add', $data);
        $this->load->view('admin/layout/footer');
    }

    public function store()
    {
        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->form_validation->set_rules('title', 'Judul Program', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('mentor_id', 'Mentor', 'required|integer');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->add();
            return;
        }

        $title = $this->input->post('title', true);
        $data = [
            'category_id' => (int)$this->input->post('category_id', true),
            'mentor_id' => (int)$this->input->post('mentor_id', true),
            'title' => $title,
            'slug' => url_title($title, 'dash', true),
            'description' => $this->input->post('description', true),
            'thumbnail' => $this->input->post('thumbnail', true),
            'level' => $this->input->post('level', true),
            'price' => (float)($this->input->post('price', true) ?: 0),
            'is_published' => $this->input->post('is_published') ? 1 : 0,
        ];

        if ($this->Training_model->insert($data)) {
            $this->session->set_flashdata('success', 'Program berhasil ditambahkan.');
            redirect('admin/training');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan program.');
            redirect('admin/training/add');
        }
    }

    public function edit($id)
    {
        $training = $this->Training_model->get_by_id($id);
        if (!$training) {
            $this->session->set_flashdata('error', 'Program tidak ditemukan.');
            redirect('admin/training');
            return;
        }

        $data['title'] = "Edit Program - Braveia LMS";
        $data['training'] = $training;
        $data['categories'] = $this->Training_model->get_categories();
        $data['mentors'] = $this->Training_model->get_mentors_for_select();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/training/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update($id)
    {
        $training = $this->Training_model->get_by_id($id);
        if (!$training) {
            $this->session->set_flashdata('error', 'Program tidak ditemukan.');
            redirect('admin/training');
            return;
        }

        $this->load->library('form_validation');
        $this->load->helper('url');

        $this->form_validation->set_rules('title', 'Judul Program', 'required');
        $this->form_validation->set_rules('category_id', 'Kategori', 'required|integer');
        $this->form_validation->set_rules('mentor_id', 'Mentor', 'required|integer');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id);
            return;
        }

        $title = $this->input->post('title', true);
        $data = [
            'category_id' => (int)$this->input->post('category_id', true),
            'mentor_id' => (int)$this->input->post('mentor_id', true),
            'title' => $title,
            'slug' => url_title($title, 'dash', true),
            'description' => $this->input->post('description', true),
            'thumbnail' => $this->input->post('thumbnail', true),
            'level' => $this->input->post('level', true),
            'price' => (float)($this->input->post('price', true) ?: 0),
            'is_published' => $this->input->post('is_published') ? 1 : 0,
        ];

        if ($this->Training_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Program berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui program.');
        }
        redirect('admin/training');
    }

    public function delete($id)
    {
        if ($this->Training_model->delete($id)) {
            $this->session->set_flashdata('success', 'Program berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus program.');
        }
        redirect('admin/training');
    }
}
