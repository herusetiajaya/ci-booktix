<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Home page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/home/index');
        $this->load->view('frontend/temp/footer');
    }
}
