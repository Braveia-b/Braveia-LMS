<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
    }

    public function index()
    {
        $data['title'] = "Kategori Program - Braveia Admin";
        $data['categories'] = $this->Category_model->get_all();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/category/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function add()
    {
        $data['title'] = "Tambah Kategori - Braveia Admin";
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/category/add');
        $this->load->view('admin/layout/footer');
    }

    public function store()
    {
        // Validasi input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->add();
            return;
        }

        $this->load->helper('url');
        
        $data = [
            'name' => $this->input->post('name', true),
            'slug' => url_title($this->input->post('name', true), 'dash', TRUE),
            'description' => $this->input->post('description', true),
            'icon' => $this->input->post('icon', true)
        ];

        if ($this->Category_model->insert($data)) {
            $this->session->set_flashdata('success', 'Kategori baru berhasil ditambahkan!');
            redirect('admin/category');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan data.');
            redirect('admin/category/add');
        }
    }

    public function edit($id)
    {
        $data['title'] = "Edit Kategori - Braveia Admin";
        $data['category'] = $this->Category_model->get_by_id($id);
        
        if (!$data['category']) {
            $this->session->set_flashdata('error', 'Kategori tidak ditemukan.');
            redirect('admin/category');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/category/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Nama Kategori', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
            return;
        }

        $this->load->helper('url');
        
        $data = [
            'name' => $this->input->post('name', true),
            'slug' => url_title($this->input->post('name', true), 'dash', TRUE),
            'description' => $this->input->post('description', true),
            'icon' => $this->input->post('icon', true)
        ];

        if ($this->Category_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Kategori berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui data.');
        }
        redirect('admin/category');
    }

    public function delete($id)
    {
        if ($this->Category_model->delete($id)) {
            $this->session->set_flashdata('success', 'Kategori berhasil dihapus!');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus kategori.');
        }
        redirect('admin/category');
    }
}
