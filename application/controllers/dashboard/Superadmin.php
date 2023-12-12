<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_logged();
        $this->load->model('User_model', 'user');
        $this->load->model('Role_model', 'role');
        $this->load->model('Menu_model', 'menu');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = 'Owner';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->user->getUserAdminByUsername();
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
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['role'] = $this->role->getUserRole();
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
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['role'] = $this->role->getUserRoleById($role_id);
        // $this->db->where('id !=', 1);
        $data['menu'] = $this->menu->getMenu();
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
        $this->role->changeaccess($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>');
    }

    // MENU
    public function menu()
    {
        $data['title'] = 'Menu Management';
        $data['menuActive'] = 'SuperAdmin';
        $data['user'] = $this->user->getUserAdminByUsername();
        $data['menu'] = $this->menu->getMenu();

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
        $checkMenu = $this->menu->getUserMenuByNameMenu();
        $menuId = $this->input->post('id');

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Change name menu failed!</div>');
            redirect('dashboard/superadmin/menu');
        } elseif ($checkMenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Nothing changes</div>');
            redirect('dashboard/superadmin/menu');
        } elseif ($menuId == 1 or $menuId == 2 or $menuId == 3 or $menuId == 4 or $menuId == 5) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Cant changes this menu</div>');
            redirect('dashboard/superadmin/menu');
        } else
            $this->menu->editNameMenu($menuId);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Change name menu success</div>');
        redirect('dashboard/superadmin/menu');
    }

    public function deleteMenu($id)
    {
        if ($id == 1 or $id == 2 or $id == 3 or $id == 4 or $id == 5) {
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
        $data['user'] = $this->user->getUserAdminByUsername();

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->menu->getMenu();

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
        $checkSubMenu = $this->menu->getSubMenuByCheck();
        $subMenuId = $this->input->post('id');

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active', 'Is_active', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Change sub menu failed!</div>');
            redirect('dashboard/superadmin/submenu');
        } elseif ($checkSubMenu) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Nothing changes</div>');
            redirect('dashboard/superadmin/submenu');
        } elseif ($subMenuId == 1 or $subMenuId == 2 or $subMenuId == 3 or $subMenuId == 4 or $subMenuId == 5 or $subMenuId == 6 or $subMenuId == 7) {
            $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Cant changes this sub menu</div>');
            redirect('dashboard/superadmin/submenu');
        } else
            $this->menu->editSubMenu($this->input->post('id'));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Change name menu success</div>');
        redirect('dashboard/superadmin/submenu');
    }

    public function deleteSubMenu($id)
    {
        if ($id == 1 or $id == 2 or $id == 3 or $id == 4 or $id == 5 or $id == 6 or $id == 7) {
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
