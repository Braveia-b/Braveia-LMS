<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $data['title'] = "Dashboard Admin - Braveia LMS";
        $data['kpis'] = $this->Dashboard_model->get_kpis();
        $data['recent_payments'] = $this->Dashboard_model->get_recent_payments(8);
        $data['recent_participants'] = $this->Dashboard_model->get_recent_participants(6);
        $data['ts_payments_success'] = $this->Dashboard_model->get_timeseries_payments_success(14);
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/layout/footer');
    }
}
