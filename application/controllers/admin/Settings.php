<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Settings_model');
    }

    public function index()
    {
        $data['title'] = 'Pengaturan — Admin';
        $keys = [
            // Profil instansi
            'site_name',
            'site_tagline',
            'contact_email',
            'contact_phone',
            'contact_whatsapp',
            'contact_address',
            'social_instagram',
            'social_linkedin',
            'social_youtube',

            // Pembayaran
            'payment_gateway',
            'payment_mode',
            'midtrans_server_key',
            'midtrans_client_key',

            // Email (SMTP)
            'smtp_host',
            'smtp_port',
            'smtp_user',
            'smtp_pass',
            'smtp_from_name',
            'smtp_from_email',
        ];

        $data['settings_map'] = $this->Settings_model->get_map($keys);
        $data['settings_all'] = $this->Settings_model->get_all(); // internal/debug
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/sidebar');
        $this->load->view('admin/settings/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function save()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('key_name', 'Key', 'required');
        $this->form_validation->set_rules('value', 'Value', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', 'Validasi gagal. Pastikan key dan value terisi.');
            redirect('admin/settings');
            return;
        }

        $key = trim((string)$this->input->post('key_name', true));
        $value = (string)$this->input->post('value', true);

        if ($this->Settings_model->upsert($key, $value)) {
            $this->session->set_flashdata('success', 'Pengaturan berhasil disimpan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan pengaturan.');
        }
        redirect('admin/settings');
    }

    public function save_structured()
    {
        // Only accept known keys from structured form
        $allowed = [
            'site_name','site_tagline','contact_email','contact_phone','contact_whatsapp','contact_address',
            'social_instagram','social_linkedin','social_youtube',
            'payment_gateway','payment_mode','midtrans_server_key','midtrans_client_key',
            'smtp_host','smtp_port','smtp_user','smtp_pass','smtp_from_name','smtp_from_email',
        ];

        $posted = $this->input->post(null, true) ?: [];

        foreach ($allowed as $k) {
            if (!array_key_exists($k, $posted)) continue;

            $v = (string)$posted[$k];

            // If secrets are blank, keep existing
            if (in_array($k, ['midtrans_server_key','midtrans_client_key','smtp_pass'], true) && trim($v) === '') {
                continue;
            }

            $this->Settings_model->upsert($k, $v);
        }

        $this->session->set_flashdata('success', 'Pengaturan berhasil disimpan.');
        redirect('admin/settings');
    }

    public function delete($id)
    {
        if ($this->Settings_model->delete($id)) {
            $this->session->set_flashdata('success', 'Pengaturan berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus pengaturan.');
        }
        redirect('admin/settings');
    }
}

