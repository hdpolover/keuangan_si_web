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
}
