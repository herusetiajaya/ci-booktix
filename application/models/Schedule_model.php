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

    public function addSchedule()
    {
        $data = [
            'date' => htmlspecialchars($this->input->post('date', true)),
            'time' => htmlspecialchars($this->input->post('time', true)),
            'price' => htmlspecialchars($this->input->post('price', true)),
            'message' => htmlspecialchars($this->input->post('message', true)),
        ];
        $this->db->insert('tbl_schedule', $data);
    }

    public function updateSchedule($id)
    {
        $data = [
            'date' => htmlspecialchars($this->input->post('date', true)),
            'time' => htmlspecialchars($this->input->post('time', true)),
            'price' => htmlspecialchars($this->input->post('price', true)),
            'message' => htmlspecialchars($this->input->post('message', true)),
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_schedule', $data);
    }

    public function deleteSchedule($id)
    {
        $this->db->delete('tbl_schedule', ['id' => $id]);
    }
}
