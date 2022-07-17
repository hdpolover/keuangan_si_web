<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengguna extends CI_Controller
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

        if ($this->session->userdata('role') != 2) {
            $this->session->set_flashdata('warning', "Kamu tidak memiliki akses");
            redirect(base_url());
        }

        $this->load->model(['M_pengguna']);
    }

    public function index()
    {
        $data['statistik'] = $this->M_pengguna->get_statistik();
        $this->templateback->view('pengguna/dashboard', $data);
    }

    // keuangan
    public function keuangan()
    {
        $page = $this->input->get('p');
        if($page == 'pemasukan' || empty($page)){
            $data['keuangan'] = $this->M_pengguna->get_keuangan(2);

            $this->templateback->view('pengguna/keuangan/pemasukan', $data);
        }elseif($page == 'pengeluaran'){
            $data['keuangan'] = $this->M_pengguna->get_keuangan(1);

            $this->templateback->view('pengguna/keuangan/pengeluaran', $data);
        }elseif($page == 'tabungan'){
            $data['keuangan'] = $this->M_pengguna->get_keuangan(3);

            $this->templateback->view('pengguna/keuangan/tabungan', $data);
        }else{
            $this->session->set_flashdata('notif_error', "Tidak diketahui!");
            redirect(site_url('pengguna'));
        }
    }

    function keuangan_tambah($page = 'pemasukan')
    {
        if ($this->M_pengguna->keuangan_tambah() == true) {
            $this->session->set_flashdata('notif_success', "Berhasil menambahkan data keuangan!");
            redirect(site_url('pengguna/keuangan?p='.$page));
        } else {
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat menambahkan data keuangan, coba lagi nanti!");
            redirect($this->agent->referrer());
        }
    }

    function keuangan_edit($page = 'pemasukan')
    {
        if ($this->M_pengguna->keuangan_edit() == true) {
            $this->session->set_flashdata('notif_success', "Berhasil mengubah data keuangan!");
            redirect(site_url('pengguna/keuangan?p='.$page));
        } else {
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat mengubah data keuangan, coba lagi nanti!");
            redirect($this->agent->referrer());
        }
    }

    function keuangan_hapus($page = 'pemasukan')
    {
        if ($this->M_pengguna->keuangan_hapus() == true) {
            $this->session->set_flashdata('notif_success', "Berhasil menghapus data keuangan!");
            redirect(site_url('pengguna/keuangan?p='.$page));
        } else {
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat menghapus data keuangan, coba lagi nanti!");
            redirect($this->agent->referrer());
        }
    }


    // pengingat
    public function pengingat()
    {
        $data['pengingat'] = $this->M_pengguna->get_pengingat();
        
        $this->templateback->view('pengguna/pengingat', $data);
    }

    function pengingat_tambah(){
        if($this->M_pengguna->pengingat_tambah() == true){
            $this->session->set_flashdata('notif_success', "Pengingat berhasil ditambahkan!");
            redirect(site_url('pengguna/pengingat'));
        }else{
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat menambahkan pengingat, coba lagi nanti!");
			redirect($this->agent->referrer());
        }
    }

    function pengingat_bayar(){
        if($this->M_pengguna->pengingat_bayar() == true){
            $this->session->set_flashdata('notif_success', "Berhasil mengubah pengingat menjadi sudah dibayar!");
            redirect(site_url('pengguna/pengingat'));
        }else{
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat mengubah pengingat, coba lagi nanti!");
			redirect($this->agent->referrer());
        }
    }

    function pengingat_bulanan(){
        if($this->M_pengguna->pengingat_bulanan() == true){
            $this->session->set_flashdata('notif_success', "Berhasil mengaktifkan pengingat bulanan!");
            redirect(site_url('pengguna/pengingat'));
        }else{
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat mengaktifkan pengingat bulanan, coba lagi nanti!");
			redirect($this->agent->referrer());
        }
    }

    function pengingat_bulanan_mati(){
        if($this->M_pengguna->pengingat_bulanan_mati() == true){
            $this->session->set_flashdata('notif_success', "Berhasil menonaktifkan pengingat bulanan!");
            redirect(site_url('pengguna/pengingat'));
        }else{
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat menonaktifkan pengingat bulanan, coba lagi nanti!");
			redirect($this->agent->referrer());
        }
    }

    public function riwayat()
    {
        $data['keuangan'] = $this->M_pengguna->get_keuanganRiwayat();

        $this->templateback->view('pengguna/riwayat', $data);
    }
}
