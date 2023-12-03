<?php

function is_logged_in()
{
    $this_mod = get_instance();
    if (!$this_mod->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $this_mod->session->userdata('role_id');
        $menu = $this_mod->uri->segment(1);

        $queryMenu = $this_mod->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $this_mod->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_logged()
{
    $this_mod = get_instance();
    if (!$this_mod->session->userdata('email')) {
        redirect('dashboard/auth');
    } else {
        $role_id = $this_mod->session->userdata('role_id');
        $menu = $this_mod->uri->segment(2);

        $queryMenu = $this_mod->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $this_mod->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('dashboard/auth/blocked');
        }
    }
}

function check_access($role_id,  $menu_id)
{
    $thisci = get_instance();

    $thisci->db->where('role_id', $role_id);
    $thisci->db->where('menu_id', $menu_id);
    $result = $thisci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}
