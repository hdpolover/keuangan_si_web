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
        
        // daily  account chart
        $getChartPemasukan = $this->M_admin->getChartPemasukan();
        foreach ($getChartPemasukan as $val):
            // $data['arrChartDailyAccount']['created_at'][] = "'".date("Y-m-d\TH:i:s\.v\Z", $val->created_at)."'";
            $data['arrChartPemasukan']['created_at'][] = "'".$val->created_at."'";
            $data['arrChartPemasukan']['nominal'][] = $val->nominal;
        endforeach;
        
        // daily  account chart
        $getChartPengeluaran = $this->M_admin->getChartPengeluaran();
        foreach ($getChartPengeluaran as $val):
            // $data['arrChartDailyAccount']['created_at'][] = "'".date("Y-m-d\TH:i:s\.v\Z", $val->created_at)."'";
            $data['arrChartPengeluaran']['created_at'][] = "'".$val->created_at."'";
            $data['arrChartPengeluaran']['nominal'][] = $val->nominal;
        endforeach;

        
        $data['arrChartDailyDate'] = array_unique(array_merge(isset($data['arrChartPemasukan']['created_at']) ? $data['arrChartPemasukan']['created_at']:[], isset($data['arrChartPengeluaran']['created_at']) ? $data['arrChartPengeluaran']['created_at']:[]), SORT_REGULAR);

        $this->templateback->view('admin/dashboard', $data);
    }

    public function pengguna()
    {
        $data['pengguna'] = $this->M_admin->get_pengguna();
        $this->templateback->view('admin/pengguna', $data);
    }
}
