<?php
class TemplateBack
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->database();
    }

    public function getSettingsValue($key)
    {
        $query = $this->_ci->db->get_where('tb_settings', ['key' => $key]);
        return $query->row()->value;
    }

    public function getPengingat()
    {
        $query = $this->_ci->db->get_where('tb_pengingat', ['user_id' => $this->_ci->session->userdata('user_id'), 'status' => 0]);
        return $query->result();
    }

    public function view($content, $data = null)
    {
        $data['web_title'] = $this->getSettingsValue('web_title');
        $data['web_desc'] = $this->getSettingsValue('web_desc');
        $data['web_icon'] = $this->getSettingsValue('web_icon');
        $data['web_logo'] = $this->getSettingsValue('web_logo');

        $data['pengingat_notif'] = $this->getPengingat();

        $this->_ci->load->view('template/backend/header', $data);
        $this->_ci->load->view('template/alert', $data);
        $this->_ci->load->view('template/backend/navbar', $data);
        $this->_ci->load->view('template/backend/sidebar', $data);
        $this->_ci->load->view($content, $data);
        $this->_ci->load->view('template/backend/footer', $data);
    }
}
