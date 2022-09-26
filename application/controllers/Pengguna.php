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
        $this->load->model(['M_pengguna', 'M_admin']);

        $this->reminder_bulanan();
        $this->reminder_email();
    }

    public function reminder_bulanan()
    {
        $reminder = $this->M_admin->get_allreminder();
        $no = 0;
        if(!empty($reminder)){
            foreach($reminder as $key => $val):
                $deadline = strtotime("-7 day", time());
                if($deadline > $val->tanggal && $val->status == 1){
                    $new_date = strtotime("+1 month", $val->tanggal);
                    $this->M_admin->update_reminder($val->id, $new_date);
                    $no++;
                }
            endforeach;
        }

        return ('Success activated '.$no.' reminder');
    }

    public function reminder_email(){
        $reminder = $this->M_admin->get_allreminderEmail();
        $no = 0;
        if(!empty($reminder)){
            foreach($reminder as $key => $val):
                if(time() > $val->tanggal){
                    $subject = "Pengingat tagihan";
                    $message = "Hai, {$val->nama} kamu memiliki tagihan {$val->tagihan} yang akan jatuh tempo pada {$val->jatuh_tempo}. Harap segera bayar tagihanmu, dan ubah status pada pengingat tagihan";

                    $this->send_email($val->email, $subject, $message);
                }
            endforeach;
        }
    }

    public function index()
    {
        $data['statistik'] = $this->M_pengguna->get_statistik();
        
        // daily  account chart
        $getChartPemasukan = $this->M_pengguna->getChartPemasukan();
        foreach ($getChartPemasukan as $val):
            // $data['arrChartDailyAccount']['created_at'][] = "'".date("Y-m-d\TH:i:s\.v\Z", $val->created_at)."'";
            $data['arrChartPemasukan']['created_at'][] = "'".$val->created_at."'";
            $data['arrChartPemasukan']['nominal'][] = $val->nominal;
        endforeach;
        
        // daily  account chart
        $getChartPengeluaran = $this->M_pengguna->getChartPengeluaran();
        foreach ($getChartPengeluaran as $val):
            // $data['arrChartDailyAccount']['created_at'][] = "'".date("Y-m-d\TH:i:s\.v\Z", $val->created_at)."'";
            $data['arrChartPengeluaran']['created_at'][] = "'".$val->created_at."'";
            $data['arrChartPengeluaran']['nominal'][] = $val->nominal;
        endforeach;

        
        $data['arrChartDailyDate'] = array_unique(array_merge(isset($data['arrChartPemasukan']['created_at']) ? $data['arrChartPemasukan']['created_at']:[], isset($data['arrChartPengeluaran']['created_at']) ? $data['arrChartPengeluaran']['created_at']:[]), SORT_REGULAR);
        
        // ej($data);
        $this->templateback->view('pengguna/dashboard', $data);
    }

    // keuangan
    public function keuangan()
    {
        $page = $this->input->get('p');
        $tgl = [];
        if($this->input->post('periode')){
            $periode = $this->input->post('periode');
            $tgl = explode('-', str_replace(' ', '', $periode));
        }

        if($page == 'pemasukan' || empty($page)){
            $data['keuangan'] = $this->M_pengguna->get_keuangan(2, $tgl);

            $this->templateback->view('pengguna/keuangan/pemasukan', $data);
        }elseif($page == 'pengeluaran'){
            $data['keuangan'] = $this->M_pengguna->get_keuangan(1, $tgl);

            $this->templateback->view('pengguna/keuangan/pengeluaran', $data);
        }elseif($page == 'tabungan'){
            $data['keuangan'] = $this->M_pengguna->get_keuangan(3, $tgl);

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

    function pengingat_edit(){
        if($this->M_pengguna->pengingat_edit() == true){
            $this->session->set_flashdata('notif_success', "Pengingat berhasil diubah!");
            redirect(site_url('pengguna/pengingat'));
        }else{
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat mengubah pengingat, coba lagi nanti!");
			redirect($this->agent->referrer());
        }
    }

    function pengingat_hapus(){
        if($this->M_pengguna->pengingat_hapus() == true){
            $this->session->set_flashdata('notif_success', "Pengingat berhasil dihapus!");
            redirect(site_url('pengguna/pengingat'));
        }else{
            $this->session->set_flashdata('notif_warning', "Terjadi kesalahaan saat menghapus pengingat, coba lagi nanti!");
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
    
    /**
     * Function to send mailer
     *
     * @param  string $email
     * @param  string $subject
     * @param  string $message
     * 
     * @return boolean
     */
    public function send_email($email, $subject, $message)
    {
        $mail = array(
            'to' => $email,
            'subject' => $subject,
            'message' => $message
        );

        if ($this->mailer->send($mail) == true) {
            return true;
        } else {
            return false;
        }
    }
}
