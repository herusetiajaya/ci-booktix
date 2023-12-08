<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Forum page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/forum/index');
        $this->load->view('frontend/temp/footer');
    }
}
