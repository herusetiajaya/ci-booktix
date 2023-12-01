<?php

class About extends CI_Controller
{
    public function index()
    {
        $data['judul'] = 'Halaman About';
        $this->load->view('home/home_header', $data);
        $this->load->view('about/index');
        $this->load->view('home/home_footer');
    }
}
