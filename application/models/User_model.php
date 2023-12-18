<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function getUserAdminByUsername()
    {
        return $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function getUserAdminByUsernameAuth($username)
    {
        return $this->db->get_where('admin', ['username' => $username])->row_array();
    }

    public function addUserAdmin()
    {
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'image' => 'default.png',
            'password' => password_hash($this->input->post('passwordFirst', true), PASSWORD_DEFAULT),
            'role_id' => 2,
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
            'date_created' => time()
        ];
        $this->db->insert('admin', $data);
    }

    public function getUserAdmin()
    {
        return $this->db->get('admin')->result_array();
    }

    public function getUserAdminById($id)
    {
        return $this->db->get_where('admin', ['id' => $id])->row_array();
    }

    public function uploadImage($new_image)
    {
        $this->db->set('image', $new_image);
    }

    public function updateImage()
    {
        $this->db->set('name', htmlspecialchars($this->input->post('name')));
        $this->db->set('email', htmlspecialchars($this->input->post('email')));
        $this->db->where('username', $this->input->post('username'));
        $this->db->update('admin');
    }

    public function updatePassword($password_hash)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('admin');
    }

    public function updatePasswordById($password_hash, $id)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('id', $id);
        $this->db->update('admin');
    }

    public function updateIsActive($idAdmin)
    {
        $this->db->where('id', $idAdmin);
        $this->db->update('admin', ['is_active' => 0]);
    }
    public function updateIsNotActive($idAdmin)
    {
        $this->db->where('id', $idAdmin);
        $this->db->update('admin', ['is_active' => 1]);
    }

    public function updateUserNotSuperAdmin($idAdmin)
    {
        $this->db->where('id', $idAdmin);
        $this->db->update('admin', ['role_id' => 1]);
    }

    public function updateUserSuperAdmin($idAdmin)
    {
        $this->db->where('id', $idAdmin);
        $this->db->update('admin', ['role_id' => 2]);
    }

    public function resetPassword($password, $id)
    {
        $this->db->set('password', $password);
        $this->db->where('id', $id);
        $this->db->update('admin');
    }

    public function deleteUserAdmin($id)
    {
        $this->db->delete('admin', ['id' => $id]);
    }
}
