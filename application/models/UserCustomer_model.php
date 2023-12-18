<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserCustomer_model extends CI_Model
{

    public function getCustomerByUsername()
    {
        return $this->db->get_where('customer', ['username' => $this->session->userdata('usernameCustomer')])->row_array();
    }

    // Customer Authentication
    public function getCustomerByUsernameAndEmailAuth($usernameOrEmail)
    {
        $sEmail = $this->db->get_where('customer', ['email' => $usernameOrEmail])->row_array();
        if ($usernameOrEmail == $sEmail['email']) {
            $data = ['email' => $usernameOrEmail];
        } else {
            $data = ['username' => $usernameOrEmail];
        }
        return $this->db->get_where('customer', $data)->row_array();
    }

    public function getCustomer()
    {
        return $this->db->get('customer')->result_array();
    }

    public function getCustomerById($id)
    {
        return $this->db->get_where('customer', ['id' => $id])->row_array();
    }

    public function addCustomer()
    {
        $data = [
            'username' => htmlspecialchars($this->input->post('username', true)),
            'password' => password_hash($this->input->post('passwordFirst'), PASSWORD_DEFAULT),
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'card_id' => '',
            'phone' => '088xxxxxxxx',
            'address' => '',
            'image' => 'defaultCustomer.png',
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
            'date_created' => time()
        ];
        $this->db->insert('customer', $data);
    }

    public function uploadImageCustomer($new_image)
    {
        $this->db->set('image', $new_image);
    }

    public function updateImageCustomer()
    {
        $data = [
            'name' => htmlspecialchars($this->input->post('name', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'card_id' => htmlspecialchars($this->input->post('card_id', true)),
            'phone' => htmlspecialchars($this->input->post('phone', true)),
            'address' => htmlspecialchars($this->input->post('address', true)),
        ];
        $this->db->where('username', $this->input->post('username'));
        $this->db->update('customer', $data);
    }

    public function updatePasswordCustomer($password_hash, $id)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('id', $id);
        $this->db->update('customer');
    }

    public function updatePasswordCustomerByUsername($password_hash)
    {
        $this->db->set('password', $password_hash);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->update('customer');
    }

    public function resetPasswordCustomer($password, $id)
    {
        $this->db->set('password', $password);
        $this->db->where('id', $id);
        $this->db->update('customer');
    }

    public function updateCustomerIsActive($idCustomer)
    {
        $this->db->where('id', $idCustomer);
        $this->db->update('customer', ['is_active' => 0]);
    }
    public function updateCustomerIsNotActive($idCustomer)
    {
        $this->db->where('id', $idCustomer);
        $this->db->update('customer', ['is_active' => 1]);
    }

    public function deleteCustomer($id)
    {
        $this->db->delete('customer', ['id' => $id]);
    }
}
