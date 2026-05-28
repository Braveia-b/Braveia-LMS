<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Training_model');
        $this->load->model('Mentor_model');
        $this->load->helper('text');
    }

    public function index()
    {
        $data['title'] = 'Brave International Academy — Platform LMS Profesional';
        $data['popular_trainings'] = $this->Training_model->get_published_trainings(6);

        $data['stats'] = [
            'trainings' => count($data['popular_trainings']),
            'mentors' => 0,
            'participants' => 0,
        ];

        $mentors = $this->Mentor_model->get_public_mentors();
        $data['stats']['mentors'] = count($mentors);

        $this->db->from('users');
        $this->db->where('role_id', 4);
        $this->db->where('is_active', 1);
        $data['stats']['participants'] = (int) $this->db->count_all_results();

        $published = $this->Training_model->get_published_trainings();
        $data['stats']['trainings'] = count($published) > 0 ? count($published) : $data['stats']['trainings'];

        $this->load->view('layout/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('layout/footer');
    }
}
