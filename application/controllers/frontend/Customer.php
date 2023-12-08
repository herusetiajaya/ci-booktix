<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('frontend/auth');
        }
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('customer', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Customer page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/customer/index', $data);
        $this->load->view('frontend/temp/footer');
    }
}
