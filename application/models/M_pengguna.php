<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_pengguna extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_statistik(){
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'kategori' => 3, 'is_deleted' => 0]);
        $tabungan = $this->db->get()->row()->total;
        
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'kategori' => 2, 'is_deleted' => 0]);
        $pemasukan = $this->db->get()->row()->total;
        
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'kategori' => 1, 'is_deleted' => 0]);
        $pengeluaran = $this->db->get()->row()->total;

        $pengingat = $this->db->get_where('tb_pengingat', ['user_id' => $this->session->userdata('user_id'), 'status' => 0, 'is_deleted' => 0])->num_rows();

        $bergabung = $this->db->get_where('tb_auth', ['user_id' => $this->session->userdata('user_id')])->row();

    
        $interval = date_diff(date_create(date("Y-m-d")), date_create(date("Y-m-d", $bergabung->created_at)));
    
        $lama = $interval->days;

        return [
            'tabungan' => $tabungan,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran,
            'pengingat' => $pengingat,
            'lama' => $lama
        ];
    }
    
    function getChartPemasukan()
    {
        $this->db->select("FROM_UNIXTIME(created_at, '%Y-%m-%d') AS created_at, SUM(nominal) AS nominal");
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'kategori' => 2]);
        $this->db->group_by("FROM_UNIXTIME(created_at, '%Y-%m-%d')");
        return $this->db->get()->result();
    }
    
    function getChartPengeluaran()
    {
        $this->db->select("FROM_UNIXTIME(created_at, '%Y-%m-%d') AS created_at, SUM(nominal) AS nominal");
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'kategori' => 1]);
        $this->db->group_by("FROM_UNIXTIME(created_at, '%Y-%m-%d')");
        return $this->db->get()->result();
    }

    // keuangan
    function get_keuangan($kategori, $tgl){

        $this->db->select("*");
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'kategori' => $kategori, 'is_deleted' => 0]);
        if(!empty($tgl)){
            $this->db->where(['created_at >=' => strtotime($tgl[0]), 'created_at <=' => strtotime($tgl[1])]);
        }

        return $this->db->get()->result();
    }
    function get_keuanganRiwayat()
    {
        return $this->db->get_where('tb_keuangan', ['user_id' => $this->session->userdata('user_id'), 'is_deleted' => 0])->result();
    }

    
    function keuangan_tambah(){
        $nama = $this->input->post('nama');
        $nominal = $this->input->post('nominal');
        $kategori = $this->input->post('kategori');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'nama' => $nama,
            'kategori' => $kategori,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
            'created_at' => time()
        ];

        $this->db->insert('tb_keuangan', $data);
        return $this->db->affected_rows() == true;
    }
    
    function keuangan_edit(){
        $id = $this->input->post('id');

        $nama = $this->input->post('nama');
        $nominal = $this->input->post('nominal');
        $kategori = $this->input->post('kategori');
        $keterangan = $this->input->post('keterangan');

        $data = [
            'nama' => $nama,
            'kategori' => $kategori,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
            'modified_at' => time()
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_keuangan', $data);
        return $this->db->affected_rows() == true;
    }
    
    function keuangan_hapus(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_keuangan', ['is_deleted' => 1]);
        return $this->db->affected_rows() == true;
    }

    // pengingat
    function get_pengingat(){
        $this->db->select('*');
        $this->db->from('tb_pengingat');
        $this->db->where(['user_id' => $this->session->userdata('user_id'), 'is_deleted' => 0]);
        $this->db->order_by('status ASC');
        return $this->db->get()->result();
    }

    function pengingat_tambah(){
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $nominal = $this->input->post('nominal');

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'nama' => $nama,
            'tanggal' => strtotime($tanggal),
            'tagihan' => $nominal,
            'created_at' => time()
        ];

        $this->db->insert('tb_pengingat', $data);
        return $this->db->affected_rows() == true;
    }

    function pengingat_edit(){
        $id = $this->input->post('id');

        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $nominal = $this->input->post('nominal');

        $data = [
            'user_id' => $this->session->userdata('user_id'),
            'nama' => $nama,
            'tanggal' => strtotime($tanggal),
            'tagihan' => $nominal,
            'created_at' => time()
        ];

        $this->db->where('id', $id);
        $this->db->update('tb_pengingat', $data);
        return $this->db->affected_rows() == true;
    }

    function pengingat_hapus(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_pengingat', ['is_deleted' => 1]);
        return $this->db->affected_rows() == true;
    }

    function pengingat_bayar(){
        $id = $this->input->post('id');
        $this->keuangan_tambah();
        $this->db->where('id', $id);
        $this->db->update('tb_pengingat', ['status' => 1]);
        return $this->db->affected_rows() == true;
    }

    function pengingat_bulanan(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_pengingat', ['bulanan' => 1]);
        return $this->db->affected_rows() == true;
    }

    function pengingat_bulanan_mati(){
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('tb_pengingat', ['bulanan' => 0]);
        return $this->db->affected_rows() == true;
    }
}
