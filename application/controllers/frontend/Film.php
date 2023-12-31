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

        $this->form_validation->set_rules('tickCount', 'Ticket Count', 'trim|required|max_length[3]');
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
                'tickCount' => htmlspecialchars($this->input->post('tickCount', true)),
                'film' => htmlspecialchars($this->input->post('film', true)),
                'date' => htmlspecialchars($this->input->post('date', true)),
                // 'price' => htmlspecialchars($this->input->post('price', true)),
                'time' => htmlspecialchars($this->input->post('time', true)),
                'studio' => htmlspecialchars($this->input->post('studio', true)),
                'seat' => htmlspecialchars($this->input->post('seat', true)),
                'seat2' => htmlspecialchars($this->input->post('seat2', true)),
                'seat3' => htmlspecialchars($this->input->post('seat3', true)),
                'idSeat' => htmlspecialchars($this->input->post('idSeat', true)),
                'idSeat2' => htmlspecialchars($this->input->post('idSeat2', true)),
                'idSeat3' => htmlspecialchars($this->input->post('idSeat3', true)),
            ];
            $this->session->set_tempdata($tempdata);

            $seatId = [
                'idSeat' => htmlspecialchars($this->input->post('idSeat', true)),
                'idSeat2' => htmlspecialchars($this->input->post('idSeat2', true)),
                'idSeat3' => htmlspecialchars($this->input->post('idSeat3', true)),
            ];
            $this->studio->updateSeatIsOrderByIdArr($seatId);

            // var_dump($this->session->tempdata());
            // die();
            redirect('frontend/film/orderTicket');
            
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
        $data['detailTicket'] = $this->session->tempdata();

        $schedule = $this->schedule->getScheduleBydate($this->session->tempdata('date'));
        $price = $schedule['price'];
        $ticketCount = $this->session->tempdata('tickCount');
        $data['price'] = $resultPrice = $price * $ticketCount;

        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/film/orderticket', $data);
        $this->load->view('frontend/temp/footer');
    }
    
    public function cencelOrder()
    {
        $seatId = [
            'idSeat1' => $this->session->tempdata('idSeat'),
            'idSeat2' => $this->session->tempdata('idSeat2'),
            'idSeat3' => $this->session->tempdata('idSeat3'),
        ];
        $this->studio->updateSeatIsNotOrderByIdArr($seatId);
        // $this->session->unset_tempdata();
        redirect('frontend/film/index/');
    }

    public function checkSessTempdata()
    {
        var_dump($this->session->tempdata());
        die();
        
    }

}
