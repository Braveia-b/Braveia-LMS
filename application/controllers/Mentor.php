<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentor extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mentor_model');
    }

    public function index()
    {
        $data['title'] = 'Mentor Profesional — Brave International Academy';
        $data['mentors'] = $this->Mentor_model->get_public_mentors();

        $this->load->view('layout/header', $data);
        $this->load->view('mentor/index', $data);
        $this->load->view('layout/footer');
    }
}
