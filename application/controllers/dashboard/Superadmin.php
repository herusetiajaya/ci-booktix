<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->session->userdata('email')) {
        //     redirect('auth');
        // }
        // is_logged_in();
        $this->load->model('Menu_model', 'menu');
        $this->load->library('form_validation');
        check_logged();
    }
    public function index()
    {
        $data['title'] = 'Owner';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/superadmin/index', $data);
        $this->load->view('dashboard/temp/footer');
    }

    // ROLE
    public function role()
    {
        $data['title'] = 'Role / Level';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/superadmin/role', $data);
        $this->load->view('dashboard/temp/footer');
    }
    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
        $data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        // $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('dashboard/temp/header', $data);
        $this->load->view('dashboard/temp/sidebar', $data);
        $this->load->view('dashboard/temp/topbar', $data);
        $this->load->view('dashboard/superadmin/role-access', $data);
        $this->load->view('dashboard/temp/footer');
    }

    public function changeaccess()
    {
        $data['menuActive'] = 'SuperAdmin';
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');
        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('user_access_menu', $data);
        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    // MENU
    public function menu()
    {
        $data['title'] = 'Menu Management';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/superadmin/menu', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $this->menu->addMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('dashboard/superadmin/menu');
        }
    }

    public function editMenu()
    {
        $nameMenu = $this->db->get_where('user_menu', ['menu' => $this->input->post('menu')])->row_array();
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Change name menu failed!</div>');
            redirect('dashboard/superadmin/menu');
        } elseif ($nameMenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Nothing changes</div>');
            redirect('dashboard/superadmin/menu');
        } elseif ($this->input->post('id') === '1' or $this->input->post('id') === '2' or $this->input->post('id') === '3') {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Cant changes this menu</div>');
            redirect('dashboard/superadmin/menu');
        } else
            $this->menu->editNameMenu($this->input->post('id'));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Change name menu success</div>');
        redirect('dashboard/superadmin/menu');
    }

    public function deleteMenu($id)
    {
        if ($id === '1' or $id === '2' or $id === '3') {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cant delete this menu!</div>');
            redirect('dashboard/superadmin/menu');
        } elseif ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete menu failed!</div>');
            redirect('dashboard/superadmin/menu');
        } else {
            $this->menu->deleteMenuById($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete menu success</div>');
            redirect('dashboard/superadmin/menu');
        }
    }

    // SUB MENU
    public function submenu()
    {
        $data['title'] = 'Submenu Management';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Is_active', 'required');

        if ($this->form_validation->run() == false) {

            $this->load->view('dashboard/temp/header', $data);
            $this->load->view('dashboard/temp/sidebar', $data);
            $this->load->view('dashboard/temp/topbar', $data);
            $this->load->view('dashboard/superadmin/submenu', $data);
            $this->load->view('dashboard/temp/footer');
        } else {
            $this->menu->addSubMenu();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added!</div>');
            redirect('dashboard/superadmin/submenu');
        }
    }

    public function editSubMenu()
    {
        $subMenu = $this->db->get_where('user_sub_menu', [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ])->row_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Is_active', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Change sub menu failed!</div>');
            redirect('dashboard/superadmin/submenu');
        } elseif ($subMenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Nothing changes</div>');
            redirect('dashboard/superadmin/submenu');
        } elseif ($this->menu->setRulesEditSubMenu()) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Cant changes this sub menu</div>');
            redirect('dashboard/superadmin/submenu');
        } else
            $this->menu->editSubMenu($this->input->post('id'));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Change name menu success</div>');
        redirect('dashboard/superadmin/submenu');
    }

    public function deleteSubMenu($id)
    {
        if ($this->menu->setRulesDeleteSubMenu($id)) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cant delete this sub menu!</div>');
            redirect('dashboard/superadmin/submenu');
        } elseif ($id == null) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Delete sub menu failed!</div>');
            redirect('dashboard/superadmin/submenu');
        } else {
            $this->menu->deleteSubMenuById($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Delete sub menu success</div>');
            redirect('dashboard/superadmin/submenu');
        }
    }
}
