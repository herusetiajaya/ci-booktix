<?php

use function PHPSTORM_META\type;

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('frontend/customer');
        }
        // $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/auth/login');
            $this->load->view('frontend/temp/footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        // $email = $this->input->post('email');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('customer', ['username' => $username])->row_array();
        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'email' => $user['email']
                    ];
                    $this->session->set_userdata($data);
                    redirect('frontend/home');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                    redirect('frontend/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This Username has not activated!</div>');
                redirect('frontend/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username not found!</div>');
            redirect('frontend/auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('frontend/home');
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('frontend/customer');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'User Name', 'required|trim|is_unique[customer.username]', ['is_unique' => 'This Username has already to use!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', ['valid_email' => 'The Email is not a valid email address.']);

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', ['matches' => 'Password dont match!', 'min_length' => 'Password to short!', 'required' => 'Password required.']);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/auth/registration');
            $this->load->view('frontend/temp/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'card_id' => '000xxx',
                'phone' => '085xxxxxxx',
                'address' => '085xxxxxxx',
                'image' => 'default.png',
                'is_active' => 0,
                'date_created' => time()
            ];

            // siapkan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('customer', $data);
            $this->db->insert('user_token', $user_token);
            // $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please activate your account <a href="' . base_url() . 'frontend/auth/pageactivation?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">here</a> </div>');
            redirect('frontend/auth');
        }
    }

    public function pageactivation()
    {
        $data['title'] = 'Page Activation';
        $data['emailFrom'] = 'herujaya@gmail.com';
        $data['emailTo'] = $_GET['email'];
        $data['token'] = $_GET['token'];
        $data['emailSubject'] = 'Account Verification';

        $data['title'] = 'Login page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/auth/pageactivation', $data);
        $this->load->view('frontend/temp/footer');
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('customer', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('customer');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">' . $email . ' has been activated! Please login.</div>');
                    redirect('frontend/auth');
                } else {
                    $this->db->delete('customer', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Token expired.</div>');
                    redirect('frontend/auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger role="alert">Account activation failed! Wrong token.</div>');
                redirect('frontend/auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Account activation failed! Wrong email.</div>');
            redirect('frontend/auth');
        }
    }

    public function forgotpassword()
    {
        if ($this->session->userdata('email')) {
            redirect('frontend/customer');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', ['valid_email' => 'The Email is not a valid email address.']);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/auth/forgot-password');
            $this->load->view('frontend/temp/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('customer', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                // siapkan token
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                // $this->_sendEmail($token, 'forgot');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password! <a href="' . base_url() . 'frontend/auth/pageresetpass?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">here</a></div>');
                redirect('frontend/auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
                redirect('frontend/auth/forgotpassword');
            }
        }
    }

    public function pageresetpass()
    {
        $data['title'] = 'Page Reset Password';
        $data['emailFrom'] = 'herujaya@gmail.com';
        $data['emailTo'] = $_GET['email'];
        $data['token'] = $_GET['token'];
        $data['emailSubject'] = 'Reset Password';

        $data['title'] = 'Login page';
        $this->load->view('frontend/temp/header', $data);
        $this->load->view('frontend/auth/pageresetpass', $data);
        $this->load->view('frontend/temp/footer');
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('customer', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
                $this->db->delete('user_token', ['email' => $email]);
            } else {
                $this->db->delete('user_token', ['email' => $email]);
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
                redirect('frontend/auth/forgotpassword');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
            redirect('frontend/auth/forgotpassword');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('frontend/auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login page';
            $this->load->view('frontend/temp/header', $data);
            $this->load->view('frontend/auth/change-password', $data);
            $this->load->view('frontend/temp/footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('customer');

            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
            redirect('frontend/auth');
        }
    }
}
