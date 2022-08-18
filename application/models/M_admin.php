<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function get_statistik(){
        $this->db->select('*');
        $this->db->from('tb_auth');
        $this->db->where('role', 2);
        $pengguna = $this->db->get()->num_rows();
        
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where('is_deleted', 0);
        $keuangan = $this->db->get()->row()->total;
        
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where(['is_deleted' => 0, 'kategori' => 2]);
        $pemasukan = $this->db->get()->row()->total;
        
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where(['is_deleted' => 0, 'kategori' => 1]);
        $pengeluaran = $this->db->get()->row()->total;

        return [
            'pengguna' => $pengguna,
            'keuangan' => $keuangan,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ];
    }
    
    function getChartPemasukan()
    {
        $this->db->select("FROM_UNIXTIME(created_at, '%Y-%m-%d') AS created_at, SUM(nominal) AS nominal");
        $this->db->from('tb_keuangan');
        $this->db->where(['kategori' => 2]);
        $this->db->group_by("FROM_UNIXTIME(created_at, '%Y-%m-%d')");
        return $this->db->get()->result();
    }
    
    function getChartPengeluaran()
    {
        $this->db->select("FROM_UNIXTIME(created_at, '%Y-%m-%d') AS created_at, SUM(nominal) AS nominal");
        $this->db->from('tb_keuangan');
        $this->db->where(['kategori' => 1]);
        $this->db->group_by("FROM_UNIXTIME(created_at, '%Y-%m-%d')");
        return $this->db->get()->result();
    }


    function get_pengguna(){
        return $this->db->query("SELECT * FROM tb_auth a WHERE a.role = 2")->result();
    }

    function get_nominal($id){
        $this->db->select('SUM(nominal) as total');
        $this->db->from('tb_keuangan');
        $this->db->where(['user_id' => $id, 'is_deleted' => 0]);
        return $this->db->get()->row()->total;
    }

    function get_allreminder(){
        return $this->db->get_where('tb_pengingat', ['bulanan' => 1])->result();
    }

    function update_reminder($id, $new_date){
        $this->db->where('id', $id);
        $this->db->update('tb_pengingat', ['status' => 0, 'tanggal' => $new_date]);
    }
}
