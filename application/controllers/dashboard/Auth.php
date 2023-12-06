<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard/admin');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';
            $this->load->view('dashboard/temp/auth_header', $data);
            $this->load->view('dashboard/auth/login');
            $this->load->view('dashboard/temp/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $admin = $this->db->get_where('admin', ['email' => $email])->row_array();
        // jika usernya ada
        if ($admin) {
            // jika adminnya aktif
            if ($admin['is_active'] == 1) {
                // cek password
                if (password_verify($password, $admin['password'])) {
                    $data = [
                        'email' => $admin['email'],
                        'role_id' => $admin['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($admin['role_id'] == 1) {
                        redirect('dashboard/superadmin');
                    } else {
                        redirect('dashboard/admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('dashboard/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Email has not activated!</div>');
                redirect('dashboard/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('dashboard/auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('dashboard/auth');
    }
    public function blocked()
    {
        $data['title'] = 'Access Blocked';
        $this->load->view('dashboard/temp/auth_header', $data);
        $this->load->view('dashboard/auth/blocked');
        $this->load->view('dashboard/temp/auth_footer');
    }
}
