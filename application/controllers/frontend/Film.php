<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Film extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Film_model', 'film');
        $this->load->model('Schedule_model', 'schedule');
        $this->load->model('Studio_model', 'studio');
        $this->load->model('UserCustomer_model', 'customer');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Film page';
        $data['tblFilm'] = $this->film->getFilm();

        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/index', $data);
        $this->load->view('frontend/temp/footer');
    }

    public function viewFilm($id)
    {
        $data['title'] = 'Film page';
        $data['tblFilm'] = $this->film->getFilmById($id);

        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/viewfilm', $data);
        $this->load->view('frontend/temp/footer');
    }

    public function movieSchedule($idFilm)
    {
        $data['title'] = 'Movie Schedule';
        $data['user'] = $this->customer->getCustomerByUsername();
        $data['tblFilm'] = $this->film->getFilmById($idFilm);
        $data['tblSchedule'] = $this->schedule->getSchedule();
        $data['tblStudio'] = $this->studio->getStudio();

        $this->form_validation->set_rules('film', 'Film', 'trim|required|max_length[30]');
        $this->form_validation->set_rules('date', 'Date', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('time', 'Time', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('studio', 'Studio', 'trim|required|max_length[20]');
        $this->form_validation->set_rules('seat', 'Seat', 'trim|required|max_length[20]');

        if ($this->form_validation->run() == false) {
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/film/movie_schedule', $data);
            $this->load->view('frontend/temp/footer');
        } else {
            $tempdata = [
                'film' => htmlspecialchars($this->input->post('film', true)),
                'date' => htmlspecialchars($this->input->post('date', true)),
                // 'price' => htmlspecialchars($this->input->post('price', true)),
                'time' => htmlspecialchars($this->input->post('time', true)),
                'studio' => htmlspecialchars($this->input->post('studio', true)),
                'seat' => htmlspecialchars($this->input->post('seat', true)),
            ];
            $this->session->set_tempdata($tempdata);
            redirect('frontend/film/orderTicket');
            // var_dump(
            //     $this->session->tempdata()
            // );
            // die();
        }
    }

    public function getSchedule()
    {
        echo json_encode($this->schedule->getScheduleById($this->input->post('id')));
        die();
    }

    public function getTime()
    {
        echo json_encode($this->schedule->getTimeByDate($this->input->post('id')));
        die();
    }

    public function getSeat()
    {
        echo json_encode($this->studio->getSeatByStudioId($this->input->post('id')));
        die();
    }

    public function orderTicket()
    {
        if (!$this->session->userdata('usernameCustomer')) {
            // $this->session->set_flashdata('message-swal', 'swal("LOGIN", "cannot load this page", "error");');
            redirect('frontend/auth');
        }
        $data['title'] = 'Order Ticket';
        $data['user'] = $this->customer->getCustomerByUsername();
        $data['film'] = $this->film->getFilmByTitle($this->session->tempdata('film'));
        $data['schedule'] = $this->schedule->getScheduleBydate($this->session->tempdata('date'));
        $data['detailTicket'] = $this->session->tempdata();

        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/orderticket', $data);
        $this->load->view('frontend/temp/footer');
    }

}
