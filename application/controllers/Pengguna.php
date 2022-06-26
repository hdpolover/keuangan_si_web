<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_pengguna']);
    }

    public function index()
    {
        $this->templateback->view('pengguna/dashboard');
    }

    public function keuangan()
    {
        $this->templateback->view('pengguna/keuangan');
    }

    public function pengingat()
    {
        $this->templateback->view('pengguna/pengingat');
    }

    public function riwayat()
    {
        $this->templateback->view('pengguna/riwayat');
    }
}
