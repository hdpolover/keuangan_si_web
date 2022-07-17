<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_admin');
    }

    public function reminder_bulanan()
    {
        $reminder = $this->M_admin->get_allreminder();
        $no = 0;
        if(!empty($reminder)){
            foreach($reminder as $key => $val):
                $deadline = strtotime("-7 day", time());
                if($deadline > $val->tanggal && $val->status == 1){
                    $this->M_admin->update_reminder($val->id);
                    $no++;
                }
            endforeach;
        }

        ej('Success activated '.$no.' reminder');
    }
}
