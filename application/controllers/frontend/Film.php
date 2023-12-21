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

        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/movie_schedule', $data);
        $this->load->view('frontend/temp/footer');
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
        echo json_encode($this->studio->getSeatById($this->input->post('id')));
        die();
    }

    public function orderTicket()
    {
        if (!$this->session->userdata('usernameCustomer')) {
            redirect('frontend/auth');
        }
        $data['title'] = 'Order Ticket';
        $data['user'] = $this->customer->getCustomerByUsername();
        $data['detailTicket'] = [
            'film' => htmlspecialchars($this->input->post('film'), true),
            'date' => htmlspecialchars($this->input->post('date'), true),
            'price' => htmlspecialchars($this->input->post('price'), true),
            'time' => htmlspecialchars($this->input->post('time'), true),
            'studio' => htmlspecialchars($this->input->post('studio'), true),
            'seat' => htmlspecialchars($this->input->post('seat'), true),
        ];

        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/orderticket', $data);
        $this->load->view('frontend/temp/footer');
    }
}
