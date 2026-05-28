<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Courses extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Training_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $data['title'] = 'Program Pelatihan — Brave International Academy';
        $data['trainings'] = $this->Training_model->get_published_trainings();
        $data['categories'] = $this->Training_model->get_categories();

        $this->load->view('layout/header', $data);
        $this->load->view('courses/index', $data);
        $this->load->view('layout/footer');
    }

    public function detail($id)
    {
        $training = $this->Training_model->get_published_detail($id);
        if (!$training) {
            show_404();
            return;
        }

        $data['title'] = html_escape($training->title) . ' — Braveia';
        $data['training'] = $training;

        $this->load->view('layout/header', $data);
        $this->load->view('courses/detail', $data);
        $this->load->view('layout/footer');
    }
}
