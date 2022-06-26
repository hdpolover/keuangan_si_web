<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utility extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
    }

    public function not_found()
    {
        $this->load->view('utility/not_found');
    }
}
