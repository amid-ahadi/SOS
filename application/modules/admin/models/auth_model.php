<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // ورود کاربر
    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get('users')->row();

        return $query ? $query : FALSE;
    }

    // خروج کاربر
    public function logout()
    {
        $this->session->unset_userdata('admin');
    }

    // چک کردن وضعیت لاگین
    public function is_logged_in($redirect = false, $check_access = false)
    {
        $admin = $this->session->userdata('admin');

        if (!$admin) {
            if ($redirect) {
                redirect('admin/login');
            }
            return false;
        }

        return true;
    }
}