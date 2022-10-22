<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_auth extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function cek_user($email)
    {
        $this->db->select('*');
        $this->db->from('tb_auth');
        $this->db->where('email', $email);
        $this->db->or_where('username', $email);
        $query = $this->db->get();
    
        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_user($email)
    {
        $this->db->select('*');
        $this->db->from('tb_auth');
        $this->db->where('email', $email);
        $this->db->or_where('username', $email);
        $query = $this->db->get();
    
        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function get_userByID($user_id)
    {
        $this->db->select('*');
        $this->db->from('tb_auth');
        $this->db->where('user_id', $user_id);
        ;
        $query = $this->db->get();
    
        // jika hasil dari query diatas memiliki lebih dari 0 record
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    public function add_user($data_auth)
    {
        $this->db->insert('tb_auth', $data_auth);
        return $this->db->affected_rows() == true;
    }

    public function update_password($data_user, $where)
    {
        $this->db->where($where);
        $this->db->update('tb_auth', $data_user);
        return $this->db->affected_rows() == true;
    }

    public function update_logTime()
    {
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->update('tb_auth', ['log_time' => time()]);
        return $this->db->affected_rows() == true;
    }

    public function getUserByCode($code){
        $this->db->select('*')
        ->from('tb_auth')
        ->where('otp', $code)
        ;

        return $this->db->get()->row();
    }

    public function cekVerifikasi($user_id){
        $this->db->select('*')
        ->from('tb_auth')
        ->where('user_id', $user_id)
        ;

        $models = $this->db->get()->row();

        if($models->status == 1){
            return true;
        }else{
            return false;
        }
    }

    public function verifikasiEmail($user_id){
        
        $this->db->where('user_id', $user_id);
        $this->db->update('tb_auth', ['status' => 2]);
        return $this->db->affected_rows() == true;
    }
}
