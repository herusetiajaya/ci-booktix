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
        $this->load->model('Film_model', 'film');
        $this->load->model('Schedule_model', 'schedule');
        $this->load->library('form_validation');
    }

    // STUDIO
    public function studio()
    {
        $data['title'] = 'Studio';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_studio'] = $this->studio->getStudio();

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('information', 'Information', 'required|trim|max_length[50]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/bioskop/studio', $data);
            $this->load->view('dashboard/temp/footer');
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

        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('information', 'Information', 'required|trim|max_length[50]');

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
    public function seat()
    {
        $data['title'] = 'Studio';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_seat'] = $this->studio->getSeatJoinStudio();
        $data['tbl_studio'] = $this->studio->getStudio();

        $this->form_validation->set_rules('code_seat', 'Code Seat', 'required|trim|max_length[2]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/bioskop/seat', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $this->studio->addSeat();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New seat added!</div>');
            redirect('dashboard/bioskop/seat');
        }
    }

    public function editSeat()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('code_seat', 'Code Seat', 'required|trim|max_length[2]');
        $this->form_validation->set_rules('studio_id', 'Studio Name', 'required|trim');

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

    // Film
    public function film()
    {
        $data['title'] = 'Film';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tblFilm'] = $this->film->getFilm();

        $this->form_validation->set_rules('title', 'Title', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('category', 'Category', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('description', 'Description', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('img', 'Poster', 'trim|max_length[30]|');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/bioskop/film', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $upload_image = $_FILES['img']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/dashboard/img/img-film/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img')) {
                    $old_image = $data['tblFilm']['img'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/dashboard/img/img-film/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->film->setImgFilm($new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->film->addFilm();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Studio added!</div>');
            redirect('dashboard/bioskop/film');
        }
    }

    public function editfilm($id)
    {
        $data['tblFilm'] = $this->film->getFilmById($id);
        // $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'Title', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('category', 'Category', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('description', 'Description', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('img', 'Poster', 'trim|max_length[30]|');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update Film Failed</div>');
            redirect('dashboard/bioskop/film');
        } else {
            $upload_image = $_FILES['img']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/dashboard/img/img-film/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('img')) {
                    $old_image = $data['tblFilm']['img'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/dashboard/img/img-film/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->film->setImgFilm($new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->film->updateFilm($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update film success</div>');
            redirect('dashboard/bioskop/film');
        }
    }

    public function deleteFilm($id)
    {
        $film = $this->film->getFilmById($id);
        $nameImg = $film['img'];
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete film failed!</div>');
            redirect('dashboard/bioskop/film');
        } else {
            $this->film->deleteFilmById($id);
            if ($nameImg != 'default.png') {
                unlink(FCPATH . 'assets/dashboard/img/img-film/' . $nameImg);
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete film success</div>');
            redirect('dashboard/bioskop/film');
        }
    }

    // Schedule
    public function schedule()
    {
        $data['title'] = 'Schedule';
        $data['menuActive'] = 'Bioskop';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tblSchedule'] = $this->schedule->getSchedule();

        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[30]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/bioskop/schedule', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $this->schedule->addSchedule();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Schedule added!</div>');
            redirect('dashboard/bioskop/schedule');
        }
    }

    public function getSchedule()
    {
        echo json_encode($this->schedule->getScheduleById($this->input->post('id')));
        die();
    }

    public function editSchedule()
    {
        $id = $this->input->post('id');

        $this->form_validation->set_rules('date', 'Date', 'trim|required');
        $this->form_validation->set_rules('time', 'Time', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|max_length[30]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update schedule Failed</div>');
            redirect('dashboard/bioskop/schedule');
        } else {
            $this->schedule->updateSchedule($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update schedule success</div>');
            redirect('dashboard/bioskop/schedule');
        }
    }

    public function deleteScheduleById($id)
    {
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete schedule failed!</div>');
            redirect('dashboard/bioskop/schedule');
        } else {
            $this->schedule->deleteSchedule($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete schedule success</div>');
            redirect('dashboard/bioskop/schedule');
        }
    }
}
