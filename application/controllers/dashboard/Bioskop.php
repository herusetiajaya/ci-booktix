<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bioskop extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_logged();
        $this->load->model('User_model', 'user');
        $this->load->model('Studio_model', 'studio');
        $this->load->library('form_validation');
    }

    public function studio()
    {
        $data['title'] = 'Studio';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_studio'] = $this->studio->getStudio();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/bioskop/studio', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function film()
    {
        $data['title'] = 'Film';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/bioskop/film', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function schedule()
    {
        $data['title'] = 'Schedule';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/bioskop/schedule', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function seat()
    {
        $data['title'] = 'Studio';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_seat'] = $this->studio->getSeatJoinStudio();
        $data['tbl_studio'] = $this->studio->getStudio();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/bioskop/seat', $data);
        $this->load->view('dashboard/temp/footer');
    }

    // STUDIO
    public function addStudio()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('information', 'Information', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Add studio failed!</div>');
            redirect('dashboard/bioskop/studio');
        } else {
            $this->studio->addStudio();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Studio added!</div>');
            redirect('dashboard/bioskop/studio');
        }
    }

    public function studioIsActive($idStudio, $isActive)
    {
        $studio = $this->db->get_where('tbl_studio', ['id' => $idStudio])->row_array();
        $nameStudio = $studio['name'];

        if ($isActive === '0') {
            $this->studio->updateStudioNotActive($idStudio);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $nameStudio . ' is active right now!</div>');
            redirect('dashboard/bioskop/studio');
        } elseif ($isActive === '1') {
            $this->studio->updateStudioActive($idStudio);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $nameStudio . ' is not active right now!</div>');
            redirect('dashboard/bioskop/studio');
        }
    }

    public function editStudio()
    {
        $checkStudio = $this->studio->getStudioByCheck();
        $id = $this->input->post('id');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('information', 'Information', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Change studio failed!</div>');
            redirect('dashboard/bioskop/studio');
        } elseif ($checkStudio) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Nothing changes</div>');
            redirect('dashboard/bioskop/studio');
        } else
            $this->studio->updateStudio($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Change studio success</div>');
        redirect('dashboard/bioskop/studio');
    }

    public function deleteStudio($id)
    {
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete studio failed!</div>');
            redirect('dashboard/bioskop/studio');
        } else {
            $this->studio->deleteStudio($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete studio success</div>');
            redirect('dashboard/bioskop/studio');
        }
    }

    // SEAT
    public function addSeat()
    {
        $this->form_validation->set_rules('code_seat', 'Code Seat', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Add seat failed!</div>');
            redirect('dashboard/bioskop/seat');
        } else {
            $this->studio->addSeat();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New seat added!</div>');
            redirect('dashboard/bioskop/seat');
        }
    }

    public function editSeat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('code_seat', 'Code Seat', 'required');
        $this->form_validation->set_rules('studio_id', 'Studio Name', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Change seat failed!</div>');
            redirect('dashboard/bioskop/seat');
        } else
            $this->studio->updateSeat($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Change seat success</div>');
        redirect('dashboard/bioskop/seat');
    }

    public function deleteSeat($id)
    {
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete seat failed!</div>');
            redirect('dashboard/bioskop/seat');
        } else {
            $this->studio->deleteSeat($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete seat success</div>');
            redirect('dashboard/bioskop/seat');
        }
    }
}
