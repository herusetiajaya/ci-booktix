<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            redirect('dashboard/auth');
        }
        $this->load->model('User_model', 'user');
        $this->load->library('form_validation');
        // is_logged_in();
        // check_logged();
    }

    // User admin
    public function index()
    {
        $data['title'] = 'My Profile';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();

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
        $data['user'] = $this->user->getUserAdminByUsername();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);
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
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/dashboard/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->user->uploadImage($new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->user->updateImage();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('dashboard/user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();

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
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('dashboard/user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('dashboard/user/changepassword');
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->user->updatePassword($password_hash);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('dashboard/user/');
                }
            }
        }
    }

    // Users admin
    public function listAdmin()
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $data['title'] = 'List Admin';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['tbl_admin'] = $this->user->getUserAdmin();

        $this->form_validation->set_rules('username', 'Username',  'required|trim|is_unique[admin.username]', ['is_unique' => 'This Username has already to use!']);
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);

        $this->form_validation->set_rules('passwordFirst', 'Password', 'required|trim|min_length[3]|matches[passwordSecond]', ['matches' => 'Password dont match!', 'min_length' => 'Password to short!']);
        $this->form_validation->set_rules('passwordSecond', 'Password', 'required|trim|matches[passwordFirst]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/user/listadmin', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $this->user->addUserAdmin();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Add user admin success</div>');
            redirect('dashboard/user/listadmin');
        }
    }

    public function viewAdmin($id)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $data['title'] = 'Profile';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['useradmin'] = $this->user->getUserAdminById($id);

        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/user/listadminview', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function editAdmin($id)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $data['title'] = 'Edit Profile';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['useradmin'] = $this->user->getUserAdminById($id);

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);

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
                    $this->user->uploadImage($new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $this->user->updateImage();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile has been updated!</div>');
            redirect('dashboard/user/viewadmin/' . $id);
        }
    }

    public function changePasswordAdmin($id)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $data['title'] = 'Change Password';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['useradmin'] = $this->user->getUserAdminById($id);

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/user/listadminchangepass', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['useradmin']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
                redirect('dashboard/user/changepasswordadmin/' . $id);
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password!</div>');
                    redirect('dashboard/user/changepasswordadmin/' . $id);
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->user->updatePasswordById($password_hash, $id);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed!</div>');
                    redirect('dashboard/user/viewadmin/' . $id);
                }
            }
        }
    }

    public function resetPasswordAdmin($id)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $data['title'] = 'Reset Password';
        $data['menuActive'] = 'Users';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['useradmin'] = $this->user->getUserAdminById($id);

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/user/listadminresetpass', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $this->user->resetPassword($password, $id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password success to reset!</div>');
            redirect('dashboard/user/viewadmin/' . $id);
        }
    }

    public function deleteAdmin($id)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        if ($id == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cant delete this user</div>');
            redirect('dashboard/user/listadmin');
        } elseif ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete user failed!</div>');
            redirect('dashboard/user/listadmin');
        } else {
            $this->user->deleteUserAdmin($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete user success</div>');
            redirect('dashboard/user/listadmin');
        }
    }

    public function changeAdminIsActive($idAdmin, $isActive)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $admin = $this->user->getUserAdminById($idAdmin);
        $nameAdmin = $admin['name'];
        $usernameAdmin = $admin['username'];

        if ($idAdmin == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cant change this user!</div>');
            redirect('dashboard/user/listAdmin');
        } elseif ($usernameAdmin === $this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cannot change your own status!</br><p><small>You must login another SuperAdmin to change yours status</small></p></div>');
            redirect('dashboard/user/listAdmin');
        } elseif ($isActive === '0') {
            $this->user->updateIsNotActive($idAdmin);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User admin ' . $nameAdmin . ' is active right now!</div>');
            redirect('dashboard/user/listAdmin');
        } elseif ($isActive === '1') {
            $this->user->updateIsActive($idAdmin);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User admin ' . $nameAdmin . ' is not active right now!</div>');
            redirect('dashboard/user/listAdmin');
        }
    }

    public function changeRoleAdmin($idAdmin, $role_Id)
    {
        if ($this->session->userdata('role_id') == 2) {
            check_logged();
        }
        $admin = $this->user->getUserAdminById($idAdmin);
        $usernameAdmin = $admin['username'];

        if ($idAdmin == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Cant change this user!</div>');
            redirect('dashboard/user/viewAdmin/' . $idAdmin);
        } elseif ($usernameAdmin === $this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cannot change your own level!</br><p><small>You must login another SuperAdmin to change yours level</small></p></div>');
            redirect('dashboard/user/viewAdmin/' . $idAdmin);
        } elseif ($role_Id == 2) {
            $this->user->updateUserNotSuperAdmin($idAdmin);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User ' . $usernameAdmin . ' is SuperAdmin right now!</div>');
            redirect('dashboard/user/viewAdmin/' . $idAdmin);
        } elseif ($role_Id == 1) {
            $this->user->updateUserSuperAdmin($idAdmin);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User ' . $usernameAdmin . ' is not SuperAdmin right now!</div>');
            redirect('dashboard/user/viewAdmin/' . $idAdmin);
        }
    }
}
