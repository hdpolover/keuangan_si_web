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

        return [
            'pengguna' => $pengguna,
            'keuangan' => $keuangan
        ];
    }

    function get_pengguna(){
        return $this->db->query("SELECT *, SUM(nominal) keuangan FROM tb_auth a LEFT JOIN tb_keuangan b ON a.user_id = b.user_id WHERE a.role = 2 GROUP BY a.user_id")->result();
    }
}
