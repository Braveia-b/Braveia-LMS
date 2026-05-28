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
        $range = (int) $this->input->get('range');
        if (!in_array($range, [7, 30, 90], true)) {
            $range = 30;
        }

        $chart_days = min($range, 30);

        $this->Dashboard_model->set_range_days($range);

        $data['title'] = 'Dashboard Admin - Braveia LMS';
        $data['range'] = $range;
        $data['kpis'] = $this->Dashboard_model->get_kpis();
        $data['attention_items'] = $this->Dashboard_model->get_attention_items();
        $data['top_programs'] = $this->Dashboard_model->get_top_programs(5);
        $data['recent_payments'] = $this->Dashboard_model->get_recent_payments(8);
        $data['recent_participants'] = $this->Dashboard_model->get_recent_participants(6);
        $data['ts_payments'] = $this->Dashboard_model->get_timeseries_payments_success($chart_days);
        $data['ts_enrollments'] = $this->Dashboard_model->get_timeseries_enrollments($chart_days);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/dashboard/index', $data);
        $this->load->view('admin/layout/footer');
    }
}
