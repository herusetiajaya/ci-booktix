<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_logged();
        $this->load->model('User_model', 'user');
    }

    public function paymentbank()
    {
        $data['title'] = 'Payment Bank';
        $data['menuActive'] = 'Management';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/management/payment', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function report()
    {
        $data['title'] = 'Report';
        $data['menuActive'] = 'Management';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/management/report', $data);
        $this->load->view('dashboard/temp/footer');
    }
}
