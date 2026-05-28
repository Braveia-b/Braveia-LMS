<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Transaction_model');
    }

    public function index()
    {
        $data['title'] = 'Transaksi — Admin';

        $filters = [
            'q' => $this->input->get('q', true),
            'status' => $this->input->get('status', true),
            'item_type' => $this->input->get('item_type', true),
            'date_from' => $this->input->get('date_from', true),
            'date_to' => $this->input->get('date_to', true),
        ];

        $page = max(1, (int)$this->input->get('page'));
        $per_page = 15;
        $offset = ($page - 1) * $per_page;

        $data['filters'] = $filters;
        $data['page'] = $page;
        $data['per_page'] = $per_page;
        $data['total'] = $this->Transaction_model->count_payments($filters);
        $data['payments'] = $this->Transaction_model->list_payments($filters, $per_page, $offset);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/transaction/index', $data);
        $this->load->view('admin/layout/footer');
    }
}

