<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }

        $this->load->model('User_model', 'user');
    }

    public function paymentbank()
    {
        $data['title'] = 'Payment Bank';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/management/payment', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function transaction()
    {
        $data['title'] = 'Transaction';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/management/transaction', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function report()
    {
        $data['title'] = 'Report';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/management/report', $data);
        $this->load->view('dashboard/temp/footer');
    }
}
