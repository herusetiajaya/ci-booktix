<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function uploadImage()
    {
        $this->db->set('name', $this->input->post('name'));
        $this->db->where('email', $this->input->post('email'));
        $this->db->update('admin');
    }

    public function getUserAdmin()
    {
        return $this->db->get('admin')->result_array();
    }

    public function addUserAdmin()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.png',
            'password' => password_hash($this->input->post('passwordFirst', true), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => 0,
            'date_created' => time()
        ];
        $this->db->insert('admin', $data);
    }

    public function deleteUserAdmin($id)
    {
        $this->db->delete('admin', ['id' => $id]);
    }

    public function changeUserAdminIsActive()
    {
        $this;
    }
}