<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('usernameCustomer')) {
            redirect('frontend/auth');
        }
        $this->load->model('UserCustomer_model', 'customer');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['user'] = $this->customer->getCustomerByUsername();
        $data['title'] = 'Customer page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/customer/index', $data);
        $this->load->view('frontend/temp/footer');
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->customer->getCustomerByUsername();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|max_length[10]|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/customer/changepassword', $data);
            $this->load->view('frontend/temp/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('frontend/customer/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('frontend/customer/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->customer->updatePasswordCustomerByUsername($password_hash);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('frontend/customer');
                }
            }
        }
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->customer->getCustomerByUsername();

        $this->form_validation->set_rules('email', 'Email', 'required|trim|max_length[25]|valid_email', ['valid_email' => 'The Email is not a valid email address.']);
        $this->form_validation->set_rules('name', 'Name', 'required|trim|max_length[30]');
        $this->form_validation->set_rules('card_id', 'Card ID', 'required|trim|max_length[10]');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim|max_length[12]');
        $this->form_validation->set_rules('address', 'Address', 'required|trim|max_length[50]');

        if ($this->form_validation->run() == false) {
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/customer/edit', $data);
            $this->load->view('frontend/temp/footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/frontend/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'defaultCustomer.png') {
                        unlink(FCPATH . 'assets/frontend/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->customer->uploadImageCustomer($new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->customer->updateImageCustomer();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('frontend/customer');
        }
    }
}
