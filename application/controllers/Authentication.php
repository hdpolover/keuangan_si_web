<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Authentication extends CI_Controller
{

    // construct
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['M_auth', 'M_admin']);
    }

    public function index()
    {
        if ($this->session->userdata('logged_in') == true || $this->session->userdata('logged_in')) {
            $this->session->set_flashdata('warning', 'Berhasil masuk ke akun.');
            
            if($this->session->userdata('role') == 1){
                redirect(site_url('admin'));
            }elseif($this->session->userdata('role') == 2){
                redirect(site_url('pengguna'));
            }else{
                redirect(site_url('logout'));
            }

        } else {
            $this->templatefront->view('authentication/login');
        }
    }

    public function daftar()
    {
        $this->templatefront->view('authentication/daftar');
    }

    public function lupa()
    {
        $this->templatefront->view('authentication/lupa');
    }

    public function reset($email = null)
    {
        if ($this->M_auth->cek_user($email) == true) {
            $user = $this->M_auth->get_user($email);

            $data['user_id'] = $user->user_id;
            $data['email'] = $email;

            $this->templatefront->view('authentication/reset', $data);
        } else {
            $this->session->set_flashdata('error', 'Tidak dapat menemukan akun dengan email tersebut !');
            redirect(site_url('login'));
        }
    }

    function proses_login(){
        $this->reminder_email();
        // ambil inputan dari view
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        // cek apakah data user ada, berdasarkan email yang dimasukkan
        if ($this->M_auth->cek_user($email) == true) {
            // ambil data user, menjadi array
            $user = $this->M_auth->get_user($email);

            // cek apakah password yang dimasukkan sama dengan database
            if (password_verify($password, $user->password)) {

                // simpan data user yang login kedalam session
                $session_data = array(
                    'user_id'   => $user->user_id,
                    'nama'      => $user->nama,
                    'email'     => $user->email,
                    'role'      => $user->role,
                    'logged_in' => true,
                );

                $this->session->set_userdata($session_data);

                $this->M_auth->update_logTime();

                if ($this->session->userdata('redirect')) {
                    $this->session->set_flashdata('notif_success', 'Anda telah masuk. Silahkan melanjutkan aktivitas anda!');
                    redirect($this->session->userdata('redirect'));
                } else {
                    if($user->role == 1){
                        $this->session->set_flashdata('notif_success', "Selamat datang admin!");
                        redirect(site_url('admin'));
                    }else{
                        $this->session->set_flashdata('notif_success', "Selamat datang!");
                        redirect(site_url('pengguna'));
                    }
                }
            } else {
                $this->session->set_flashdata('warning', "Mohon maaf. Password yang Anda masukkan salah!");
                redirect(site_url('login'));
            }
        } else {
            $this->session->set_flashdata('error', "Mohon maaf. Akun tidak terdaftar!");
            redirect(site_url('login'));
        }
    }
    
    /**
     * Function proses daftar user baru
     *
     * @return boolean
     */
    function proses_daftar(){
        // ambil inputan dari view
        $nama           = htmlspecialchars($this->input->post('nama'));
        $email          = htmlspecialchars($this->input->post('email'));
        $password       = htmlspecialchars($this->input->post('password'));
        $password_conf  = htmlspecialchars($this->input->post('password_conf'));
    
        // cek apakah email telah ada
        if ($this->M_auth->cek_user($email) == false) {
      
            // cek apakah password sama
            if ($password == $password_conf) {
        
                 // ubah inputan view menjadi array
                $data_user = array(
                    'nama'      => $nama,
                    'email'     => $email,
                    'password'  => password_hash($password, PASSWORD_DEFAULT),
                    'created_at'=> time()
                );
        
                // masukkan ke database
                if ($this->M_auth->add_user($data_user) == true) {
                    $subject    = "Selamat bergabung - {$email}";
                    $message    = "Hai, {$nama} selamat bergabung.</br></br></br></br>";
          
                    $this->send_email($email, $subject, $message);

                    $user     = $this->M_auth->get_user($email);
                
                    // simpan data user yang login kedalam session
                    $session_data = array(
                        'user_id'   => $user->user_id,
                        'nama'      => $user->nama,
                        'email'     => $user->email,
                        'role'      => $user->role,
                        'logged_in' => true,
                    );
          
                    $this->session->set_userdata($session_data);
          
                    $this->session->set_flashdata('success', "Berhasil mendaftaran akun Anda!");

                    if($this->session->userdata('role') == 1){
                        redirect(site_url('admin'));
                    }elseif($this->session->userdata('role') == 2){
                        redirect(site_url('pengguna'));
                    }else{
                        redirect(site_url('logout'));
                    }

                } else {
                    $this->session->set_flashdata('error', "Terjadi kesalahan saat mendaftarkan akun Anda. Harap coba lagi!");
                    redirect(site_url('daftar'));
                }
            } else {
                $this->session->set_flashdata('warning', "Password yang Anda masukkan tidak sama!");
                redirect(site_url('daftar'));
            }
        } else {
            $this->session->set_flashdata('warning', "Email telah digunakan !");
            redirect(site_url('daftar'));
        }
    }

    function proses_lupa(){
        $email = $this->input->post('email');

        if ($this->M_auth->cek_user($email) == true) {
            $user = $this->M_auth->get_user($email);

            $subject = "Pemulihan password - {$user->email}";
            $message = "Hai, {$user->nama}. Kami mendapatkan permintaan pemulihan password atas nama email <b>{$user->email}</b>.<br>Harap klik link berikut ini untuk memulihkan password anda, atau abaikan email ini jika anda tidak merasa melakukan proses pemulihan akun.<br><br><b><i>" . base_url() . "reset-password/{$email}</i></b>";

            if ($this->send_email($email, $subject, $message)) {
                $this->session->set_flashdata('success', "Berhasil mengirim link pemulihan password anda, harap cek email anda !");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', "Terjadi kesalahan, saat mengirimkan email pemulihan password, coba lagi nanti !");
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('warning', "Tidak dapat menemukan akun atas nama email {$email}. Pastikan email tersebut telah terdaftar diwebsite kami !");
            redirect($this->agent->referrer());
        }
    }

    function proses_reset(){
        $user_id = $this->input->post('user_id');
        $password = $this->input->post('password');
        $password_conf = $this->input->post('password_conf');

        if ($password == $password_conf) {
            $data_user = array(
                'password' => password_hash($password, PASSWORD_DEFAULT)
            );
            $where = array('user_id' => $user_id);
            $user = $this->M_auth->get_userByID($user_id);

            if ($this->M_auth->update_password($data_user, $where)) {
                $now = date("d F Y - H:i");

                $subject = "Perubahan password - {$user->email}";
                $message = "Hai, {$user->nama} password kamu telah dirubah, pada {$now}. Harap hubungi admin jika ini bukan anda atau abaikan email ini.</br></br></br></br>";

                $this->send_email($user->email, $subject, $message);

                $this->session->set_flashdata('success', "Berhasil merubah password anda, harap login untuk melanjutkan !");
                redirect(site_url('login'));
            } else {
                $this->session->set_flashdata('error', "Terjadi kesalahan, saat mengubah password anda, coba lagi nanti !");
                redirect($this->agent->referrer());
            }
        } else {
            $this->session->set_flashdata('warning', "Password yang anda masukkan tidak sama, harap coba lagi !");
            redirect($this->agent->referrer());
        }
    }
    
    /**
     * Function to logout
     *
     * @return void
     */
    function proses_logout(){

        $user_data = $this->session->all_userdata();

        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }

        $this->session->sess_destroy();
        $this->session->set_flashdata('success', 'Berhasil keluar!');
        redirect(base_url());
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
    
    /**
     * Function to check hash password
     *
     * @return string
     */
    public function password_hash()
    {
        ej(password_hash("12341234", PASSWORD_DEFAULT));
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
