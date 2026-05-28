<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Webinar extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Webinar_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $data['title'] = 'Webinar & Event — Brave International Academy';
        $data['webinars'] = $this->Webinar_model->get_upcoming(50);
        $data['past_webinars'] = $this->Webinar_model->get_past(12);

        $this->load->view('layout/header', $data);
        $this->load->view('webinar/index', $data);
        $this->load->view('layout/footer');
    }

    public function detail($id)
    {
        $webinar = $this->Webinar_model->get_public_detail($id);
        if (!$webinar) {
            show_404();
            return;
        }

        $data['title'] = html_escape($webinar->title) . ' — Braveia Webinar';
        $data['webinar'] = $webinar;

        $this->load->view('layout/header', $data);
        $this->load->view('webinar/detail', $data);
        $this->load->view('layout/footer');
    }
}
