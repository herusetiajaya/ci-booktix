<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('email')) {
            redirect('dashboard/auth');
        }
        $this->load->model('User_model', 'userModel');
        $this->load->library('form_validation');
        // is_logged_in();
        // check_logged();
    }
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        // echo 'Selamat datang ' . $data['user']['name'];
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/user/index', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/user/edit', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/dashboard/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['admin']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/dashboard/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->userModel->uploadImage();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('dashboard/user');
        }
    }
    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/user/changepassword', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['admin']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('dashboard/user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('dashboard/user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('admin');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('dashboard/user/changepassword');
                }
            }
        }
    }

    public function viewAdmin($id)
    {
        $adminLogin =  $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $roleId = $adminLogin['role_id'];
        if ($roleId === '2') {
            check_logged();
        }
        $data['title'] = 'Profile';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['id' => 1])->row_array();
        $data['useradmin'] = $this->db->get_where('admin', ['id' => $id])->row_array();

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/user/listadminview', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function editAdmin($id)
    {
        $adminLogin =  $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $roleId = $adminLogin['role_id'];
        if ($roleId === '2') {
            check_logged();
        }
        $data['title'] = 'Edit Profile';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['id' => 1])->row_array();
        $data['useradmin'] = $this->db->get_where('admin', ['id' => $id])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/user/listadminedit', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            // cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '3048';
                $config['upload_path'] = './assets/dashboard/img/profile/';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['useradmin']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/dashboard/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->userModel->uploadImage();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile has been updated!</div>');
            redirect('dashboard/user/listAdmin');
        }
    }

    public function listAdmin()
    {
        $adminLogin =  $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $roleId = $adminLogin['role_id'];
        if ($roleId === '2') {
            check_logged();
        }
        $data['title'] = 'List Admin';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['listadmin'] = $this->userModel->getUserAdmin();
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/user/listadmin', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function addAdmin()
    {
        $adminLogin =  $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $roleId = $adminLogin['role_id'];
        if ($roleId === '2') {
            check_logged();
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[admin.email]', ['is_unique' => 'This email has already registered!']);

        $this->form_validation->set_rules('passwordFirst', 'Password', 'required|trim|min_length[3]|matches[passwordSecond]', ['matches' => 'Password dont match!', 'min_length' => 'Password to short!']);
        $this->form_validation->set_rules('passwordSecond', 'Password', 'required|trim|matches[passwordFirst]');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Add user admin failed!</div>');
            redirect('dashboard/user/listadmin');
        } else {
            $this->userModel->addUserAdmin();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Add user admin success</div>');
            redirect('dashboard/user/listadmin');
        }
    }

    public function deleteAdmin($id)
    {
        $adminLogin =  $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $roleId = $adminLogin['role_id'];
        if ($roleId === '2') {
            check_logged();
        }
        if ($id === '1') {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cant delete this user</div>');
            redirect('dashboard/user/listadmin');
        } elseif ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete user failed!</div>');
            redirect('dashboard/user/listadmin');
        } else {
            $this->userModel->deleteUserAdmin($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete user success</div>');
            redirect('dashboard/user/listadmin');
        }
    }

    public function changeAdminIsActive($idAdmin, $isActive)
    {
        $adminLogin =  $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $roleId = $adminLogin['role_id'];
        if ($roleId === '2') {
            check_logged();
        }

        $admin = $this->db->get_where('admin', ['id' => $idAdmin])->row_array();
        $nameAdmin = $admin['name'];

        if ($idAdmin === '1') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cant change this user!</div>');
            redirect('dashboard/user/listAdmin');
        } elseif ($isActive === '0') {
            $this->db->where('id', $idAdmin);
            $this->db->update('admin', ['is_active' => 1]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User admin ' . $nameAdmin . ' is active now!</div>');
            redirect('dashboard/user/listAdmin');
        } elseif ($isActive === '1') {
            $this->db->where('id', $idAdmin);
            $this->db->update('admin', ['is_active' => 0]);
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">User admin ' . $nameAdmin . ' is not active now!</div>');
            redirect('dashboard/user/listAdmin');
        }
    }

    public function listCustomer()
    {
        $data['title'] = 'List Customers';
        $data['menuActive'] = 'Users';
        $data['admin'] = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array();
        $data['listcustomer'] = $this->db->get('customer')->result_array();
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/user/listcustomer', $data);
        $this->load->view('dashboard/temp/footer');
    }
}
