<?php

function is_logged_in()
{
    $this_in_ci_helper = get_instance();
    if (!$this_in_ci_helper->session->userdata('email')) {
        redirect('auth');
    } else {
        $role_id = $this_in_ci_helper->session->userdata('role_id');
        $menu = $this_in_ci_helper->uri->segment(1);

        $queryMenu = $this_in_ci_helper->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $queryMenu['id'];

        $userAccess = $this_in_ci_helper->db->get_where('user_access_menu', [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ]);
        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
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
