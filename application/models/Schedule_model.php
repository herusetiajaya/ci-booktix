<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Schedule_model extends CI_Model
{
    public function getSchedule()
    {
        return $this->db->get('tbl_schedule')->result_array();
    }

    public function getScheduleById($id)
    {
        return $this->db->get_where('tbl_Schedule', ['id' => $id])->row_array();
    }

    public function getScheduleBydate($date)
    {
        return $this->db->get_where('tbl_Schedule', ['date' => $date])->row_array();
    }

    public function addSchedule()
    {

        // $int = htmlspecialchars($this->input->post('price', true));
        // $rupiah = 'Rp. ' . number_format($int, 0, '.', '.');
        // $price = $rupiah;
        $data = [
            'date' => htmlspecialchars($this->input->post('date', true)),
            'price' => htmlspecialchars($this->input->post('price', true)),
            'message' => htmlspecialchars($this->input->post('message', true)),
        ];
        $this->db->insert('tbl_schedule', $data);
    }

    public function updateSchedule($id)
    {
        $data = [
            'date' => htmlspecialchars($this->input->post('date', true)),
            'price' => htmlspecialchars($this->input->post('price', true)),
            'message' => htmlspecialchars($this->input->post('message', true)),
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_schedule', $data);
    }

    public function deleteSchedule($id)
    {
        $this->db->delete('tbl_schedule', ['id' => $id]);
        $this->db->delete('tbl_time', ['schedule_id' => $id]);
    }

    // JOIN schedule AND time
    public function getTimeJoinSchedule()
    {
        $query = "SELECT `tbl_time`. *, `tbl_schedule`.`date`
        FROM `tbl_time` JOIN `tbl_schedule`
        ON `tbl_time`.`schedule_id` = `tbl_schedule`.`id`
    ";
        return $this->db->query($query)->result_array();
    }
    // Get Time By Date
    public function getTimeByDate($id)
    {
        return $this->db->get_where('tbl_time', ['schedule_id' => $id])->result_array();
    }

    public function getTime()
    {
        return $this->db->get('tbl_time')->result_array();
    }

    // Time
    public function addTime()
    {
        $data = [
            'time' => htmlspecialchars($this->input->post('time', true)),
            'schedule_id' => htmlspecialchars($this->input->post('schedule_id', true)),
        ];
        $this->db->insert('tbl_time', $data);
    }

    public function editTime($id)
    {
        $data = [
            'time' => htmlspecialchars($this->input->post('time', true)),
            'schedule_id' => htmlspecialchars($this->input->post('schedule_id', true)),
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_time', $data);
    }

    public function deleteTime($id)
    {
        $this->db->delete('tbl_time', ['id' => $id]);
    }
}
