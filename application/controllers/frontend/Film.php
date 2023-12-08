<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Film extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Film page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/index');
        $this->load->view('frontend/temp/footer');
    }
}
