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
        // $this->load->model('Customer_model', 'customer');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'List Customers';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['tbl_customer'] = $this->db->get('customer')->result_array();
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/usercustomer/index', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function addCustomer()
    {
        $this->form_validation->set_rules('username', 'Username',  'required|trim|is_unique[customer.username]', ['is_unique' => 'This Username has already to use!']);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);

        $this->form_validation->set_rules('passwordFirst', 'Password', 'required|trim|min_length[3]|matches[passwordSecond]', ['matches' => 'Password dont match!', 'min_length' => 'Password to short!']);
        $this->form_validation->set_rules('passwordSecond', 'Password', 'required|trim|matches[passwordFirst]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Add user customer failed!</div>');
            redirect('dashboard/usercustomer/#customerModal');
        } else {
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('passwordFirst'), PASSWORD_DEFAULT),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'card_id' => '0099xxx',
                'phone' => '088xxxxxx',
                'address' => 'addyourAddress',
                'image' => 'default.png',
                'is_active' => 0,
                'date_created' => time()
            ];
            $this->db->insert('customer', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Add user customer success</div>');
            redirect('dashboard/usercustomer/');
        }
    }


    public function viewUserCustomer($id)
    {
        $data['title'] = 'Profile';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['tbl_customer'] = $this->db->get_where('customer', ['id' => $id])->row_array();

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
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['tbl_customer'] = $this->db->get_where('customer', ['id' => $id])->row_array();

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
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $dataC = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'card_id' => htmlspecialchars($this->input->post('card_id', true)),
                'phone' => htmlspecialchars($this->input->post('phone', true)),
                'address' => htmlspecialchars($this->input->post('address', true)),
            ];
            $this->db->where('username', $this->input->post('username'));
            $this->db->update('customer', $dataC);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile has been updated!</div>');
            redirect('dashboard/usercustomer/viewusercustomer/' . $id);
        }
    }

    public function changePasswordCustomer($id)
    {
        $data['title'] = 'Change Password';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['tbl_customer'] = $this->db->get_where('customer', ['id' => $id])->row_array();

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

                    $this->db->set('password', $password_hash);
                    $this->db->where('id', $id);
                    $this->db->update('customer');

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
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['tbl_customer'] = $this->db->get_where('customer', ['id' => $id])->row_array();

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

            $this->db->set('password', $password);
            $this->db->where('id', $id);
            $this->db->update('customer');

            $this->session->unset_userdata('reset_email');
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
            $this->db->delete('customer', ['id' => $id]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete user success</div>');
            redirect('dashboard/usercustomer');
        }
    }

    public function changeCustomerIsActive($idCustomer, $isActive)
    {
        $data['title'] = '';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $customer = $this->db->get_where('customer', ['id' => $idCustomer])->row_array();
        $userCustomer = $customer['username'];

        if ($isActive === '0') {
            $this->db->where('id', $idCustomer);
            $this->db->update('customer', ['is_active' => 1]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User ' . $userCustomer . ' is active now!</div>');
            redirect('dashboard/usercustomer/');
        } elseif ($isActive === '1') {
            $this->db->where('id', $idCustomer);
            $this->db->update('customer', ['is_active' => 0]);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">User ' . $userCustomer . ' is not active now!</div>');
            redirect('dashboard/usercustomer/');
        }
    }
}
