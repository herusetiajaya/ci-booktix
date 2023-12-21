<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Studio_model extends CI_Model
{
    // Studio
    public function getStudio()
    {
        return $this->db->get('tbl_studio')->result_array();
    }

    public function getStudioByCheck()
    {
        return $this->db->get_where('tbl_studio', [
            'name' => htmlspecialchars($this->input->post('name')),
            'information' => htmlspecialchars($this->input->post('information')),
        ])->row_array();
    }

    public function addStudio()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'information' => htmlspecialchars($this->input->post('information', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
        ];
        $this->db->insert('tbl_studio', $data);
    }

    public function updateStudio($id)
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name')),
            'information' => htmlspecialchars($this->input->post('information')),
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_studio', $data);
    }

    public function updateStudioNotActive($idStudio)
    {
        $this->db->where('id', $idStudio);
        $this->db->update('tbl_studio', ['is_active' => 1]);
    }
    public function updateStudioActive($idStudio)
    {
        $this->db->where('id', $idStudio);
        $this->db->update('tbl_studio', ['is_active' => 0]);
    }

    public function deleteStudio($id)
    {
        $this->db->delete('tbl_studio', ['id' => $id]);
        $this->db->delete('tbl_seat', ['studio_id' => $id]);
    }

    // Seat
    public function getSeatById($id)
    {
        return $this->db->get_where('tbl_seat', ['studio_id' => $id])->result_array();
    }
    // JOIN seat AND studio
    public function getSeatJoinStudio()
    {
        $query = "SELECT `tbl_seat`. *, `tbl_studio`.`name`
            FROM `tbl_seat` JOIN `tbl_studio`
            ON `tbl_seat`.`studio_id` = `tbl_studio`.`id`
        ";
        return $this->db->query($query)->result_array();
    }
    public function addSeat()
    {
        $data = [
            'code_seat' => htmlspecialchars($this->input->post('code_seat')),
            'studio_id' => htmlspecialchars($this->input->post('studio_id')),
        ];
        $this->db->insert('tbl_seat', $data);
    }

    public function updateSeat($id)
    {
        $data = [
            'code_seat' => htmlspecialchars($this->input->post('code_seat')),
            'studio_id' => htmlspecialchars($this->input->post('studio_id')),
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_seat', $data);
    }

    public function deleteSeat($id)
    {
        $this->db->delete('tbl_seat', ['id' => $id]);
    }
}
