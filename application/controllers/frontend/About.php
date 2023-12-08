<?php

class About extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'About page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/about/index');
        $this->load->view('frontend/temp/footer');
    }
}
