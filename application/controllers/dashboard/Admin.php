<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
        // is_logged_in();
        check_logged();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['menuActive'] = 'Admin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        // echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/admin/index', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function order()
    {
        $data['title'] = 'Order Ticket';
        $data['menuActive'] = 'Admin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        // echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/admin/order', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function confirm()
    {
        $data['title'] = 'Confirm Payment';
        $data['menuActive'] = 'Admin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        // echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/admin/confirm', $data);
        $this->load->view('dashboard/temp/footer');
    }
}
