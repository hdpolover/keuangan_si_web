<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_admin']);
    }

    public function index()
    {
        $this->templatefront->view('admin/dashboard');
    }
}
