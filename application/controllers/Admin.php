<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('logged_in') == false || !$this->session->userdata('logged_in')) {
            if (!empty($_SERVER['QUERY_STRING'])) {
                $uri = uri_string() . '?' . $_SERVER['QUERY_STRING'];
            } else {
                $uri = uri_string();
            }
            $this->session->set_userdata('redirect', $uri);
            $this->session->set_flashdata('notif_warning', "Harap login ke akun anda untuk melanjutkan");
            redirect('login');
        }

        if ($this->session->userdata('role') != 1) {
            $this->session->set_flashdata('warning', "Kamu tidak memiliki akses");
            redirect(base_url());
        }

        $this->load->model(['M_admin']);
    }

    public function index()
    {
        $data['statistik'] = $this->M_admin->get_statistik();

        $this->templateback->view('admin/dashboard', $data);
    }

    public function pengguna()
    {
        $data['pengguna'] = $this->M_admin->get_pengguna();
        $this->templateback->view('admin/pengguna', $data);
    }
}
