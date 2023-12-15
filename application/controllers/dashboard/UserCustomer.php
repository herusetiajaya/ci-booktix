<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserCustomer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('dashboard/auth');
        }
        $this->load->model('User_model', 'user');
        $this->load->model('UserCustomer_model', 'customer');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'List Customers';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_customer'] = $this->customer->getCustomer();

        $this->form_validation->set_rules('username', 'Username',  'required|trim|is_unique[customer.username]', ['is_unique' => 'This Username has already to use!']);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);
        $this->form_validation->set_rules('passwordFirst', 'Password', 'required|trim|min_length[3]|matches[passwordSecond]', ['matches' => 'Password dont match!', 'min_length' => 'Password to short!']);
        $this->form_validation->set_rules('passwordSecond', 'Password', 'required|trim|matches[passwordFirst]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/usercustomer/index', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $this->customer->addCustomer();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Add user customer success</div>');
            redirect('dashboard/usercustomer/');
        }
    }

    public function viewUserCustomer($id)
    {
        $data['title'] = 'Profile';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_customer'] = $this->customer->getCustomerById($id);

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/usercustomer/viewcustomer', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function editCustomer($id)
    {
        $data['title'] = 'Edit Profile';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_customer'] = $this->customer->getCustomerById($id);

        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('card_id', 'Card ID', 'required|trim');
        $this->form_validation->set_rules('phone', 'Phone', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/usercustomer/editcustomer', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/frontend/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['tbl_customer']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/frontend/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->customer->uploadImageCustomer($new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->customer->updateImageCustomer();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile has been updated!</div>');
            redirect('dashboard/usercustomer/viewusercustomer/' . $id);
        }
    }

    public function changePasswordCustomer($id)
    {
        $data['title'] = 'Change Password';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_customer'] = $this->customer->getCustomerById($id);

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/usercustomer/changepasscustomer', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['tbl_customer']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('dashboard/user/changepasswordadmin/' . $id);
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('dashboard/user/changepasswordadmin/' . $id);
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->customer->updatePasswordCustomer($password_hash, $id);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('dashboard/usercustomer/viewusercustomer/' . $id);
                }
            }
        }
    }

    public function resetPasswordCustomer($id)
    {
        $data['title'] = 'Reset Password';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_customer'] = $this->customer->getCustomerById($id);

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/usercustomer/resetpasswordcustomer', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $this->customer->resetPasswordCustomer($password, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password success to reset!</div>');
            redirect('dashboard/usercustomer/viewusercustomer/' . $id);
        }
    }

    public function deleteCustomer($id)
    {
        if ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete user failed!</div>');
            redirect('dashboard/usercustomer');
        } else {
            $this->customer->deleteCustomer($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete user success</div>');
            redirect('dashboard/usercustomer');
        }
    }

    public function changeCustomerIsActive($idCustomer, $isActive)
    {
        $customer = $this->customer->getCustomerById($idCustomer);
        $userCustomer = $customer['username'];

        if ($isActive === '0') {
            $this->customer->updateCustomerIsNotActive($idCustomer);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User ' . $userCustomer . ' is active right now!</div>');
            redirect('dashboard/usercustomer/');
        } elseif ($isActive === '1') {
            $this->customer->updateCustomerIsActive($idCustomer);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">User ' . $userCustomer . ' is not active right now!</div>');
            redirect('dashboard/usercustomer/');
        }
    }
}
