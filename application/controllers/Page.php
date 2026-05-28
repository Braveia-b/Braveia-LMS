<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

    private function render($view, $title, $page_heading = null)
    {
        $data['title'] = $title;
        $data['page_heading'] = $page_heading ?: $title;
        $this->load->view('layout/header', $data);
        $this->load->view('pages/' . $view, $data);
        $this->load->view('layout/footer');
    }

    public function about()
    {
        $this->render('about', 'Tentang Kami — Brave International Academy', 'Tentang Brave International Academy');
    }

    public function contact()
    {
        $this->load->model('Settings_model');
        $keys = ['site_name', 'contact_email', 'contact_phone', 'contact_whatsapp', 'contact_address'];
        $data['settings'] = $this->Settings_model->get_map($keys);
        $data['title'] = 'Kontak — Brave International Academy';
        $data['page_heading'] = 'Hubungi Kami';
        $this->load->view('layout/header', $data);
        $this->load->view('pages/contact', $data);
        $this->load->view('layout/footer');
    }

    public function faq()
    {
        $this->render('faq', 'FAQ — Brave International Academy', 'Pertanyaan yang Sering Diajukan');
    }

    public function terms()
    {
        $this->render('terms', 'Syarat & Ketentuan — Brave International Academy');
    }

    public function privacy()
    {
        $this->render('privacy', 'Kebijakan Privasi — Brave International Academy');
    }

    public function career()
    {
        $this->render('career', 'Karir — Brave International Academy', 'Bergabung dengan Tim Kami');
    }

    public function certification()
    {
        $this->render('certification', 'Sertifikasi — Brave International Academy', 'Program Sertifikasi Profesional');
    }
}
