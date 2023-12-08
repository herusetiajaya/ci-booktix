<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Login Customer page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/auth/login');
        $this->load->view('frontend/temp/footer');
    }
}
