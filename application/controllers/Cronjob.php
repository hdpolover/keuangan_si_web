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
                if (strtotime(date("Y/m/d")) == strtotime("-7 days", date("Y/m/d", $val->tanggal))) {
                    $subject = "Pengingat tagihan";
                    $message = "Hai, {$val->nama} kamu memiliki tagihan {$val->tagihan} yang akan jatuh tempo 7 hari lagi pada {$val->jatuh_tempo}. Harap segera bayar tagihanmu, dan ubah status pada pengingat tagihan";

                    $this->send_email($val->email, $subject, $message);
                }

                if(strtotime(date("Y/m/d")) == strtotime("-3 days", date("Y/m/d", $val->tanggal))){
                    $subject = "Pengingat tagihan";
                    $message = "Hai, {$val->nama} kamu memiliki tagihan {$val->tagihan} yang akan jatuh tempo 3 hari lagi pada {$val->jatuh_tempo}. Harap segera bayar tagihanmu, dan ubah status pada pengingat tagihan";

                    $this->send_email($val->email, $subject, $message);
                }

                if(strtotime(date("Y/m/d")) == strtotime("-1 days", date("Y/m/d", $val->tanggal))){
                    $subject = "Pengingat tagihan";
                    $message = "Hai, {$val->nama} kamu memiliki tagihan {$val->tagihan} yang akan jatuh tempo besok pada {$val->jatuh_tempo}. Harap segera bayar tagihanmu, dan ubah status pada pengingat tagihan";

                    $this->send_email($val->email, $subject, $message);
                }
                if(time() > $val->tanggal){
                    $subject = "Pengingat tagihan";
                    $message = "Hai, {$val->nama} kamu memiliki tagihan {$val->tagihan} yang sudah jatuh tempo pada {$val->jatuh_tempo}. Harap segera bayar tagihanmu, dan ubah status pada pengingat tagihan";

                    $this->send_email($val->email, $subject, $message);
                }
            endforeach;
        }
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
