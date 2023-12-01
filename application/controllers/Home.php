<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data['judul'] = 'Halaman Home';
        $this->load->view('home/home_header', $data);
        $this->load->view('home/index');
        $this->load->view('home/home_footer');
    }
}
