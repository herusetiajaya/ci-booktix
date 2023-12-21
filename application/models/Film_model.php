<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Film_model extends CI_Model
{
    public function getFilm()
    {
        return $this->db->get('tbl_film')->result_array();
    }

    public function getFilmById($id)
    {
        return $this->db->get_where('tbl_film', ['id' => $id])->row_array();
    }

    public function setImgFilm($new_image)
    {
        $this->db->set('img', $new_image);
    }

    public function addFilm()
    {
        $data = [
            'title' => htmlspecialchars($this->input->post('title')),
            'category' => htmlspecialchars($this->input->post('category')),
            'description' => htmlspecialchars($this->input->post('description')),
        ];
        $this->db->insert('tbl_film', $data);
    }

    public function updateFilm($id)
    {
        $data = [
            'title' => htmlspecialchars($this->input->post('title')),
            'category' => htmlspecialchars($this->input->post('category')),
            'description' => htmlspecialchars($this->input->post('description')),
        ];
        $this->db->where('id', $id);
        $this->db->update('tbl_film', $data);
    }

    public function deleteFilmById($id)
    {
        $this->db->delete('tbl_film', ['id' => $id]);
    }
}
