<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    /**
     * Set true in child controllers to enforce admin guard.
     * Default true because this base is used for admin controllers.
     * For non-admin usage, override to false.
     */
    protected $requires_admin = true;

    public function __construct()
    {
        parent::__construct();

        if ($this->requires_admin) {
            $this->require_admin_access();
        }
    }

    protected function require_admin_access()
    {
        if (
            !$this->session->userdata('is_logged_in') ||
            !in_array($this->session->userdata('role_id'), [1, 2])
        ) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }
}

