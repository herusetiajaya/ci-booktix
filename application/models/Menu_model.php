<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{
    // JOIN user MENU AND user SUB MENU
    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`. *, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
    ";
        return $this->db->query($query)->result_array();
    }

    // USER MENU
    public function addMenu()
    {
        $this->db->insert('user_menu', ['menu' => htmlspecialchars($this->input->post('menu', true))]);
    }

    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function getUserMenuByNameMenu()
    {
        return $this->db->get_where('user_menu', ['menu' => htmlspecialchars($this->input->post('menu', true))])->row_array();
    }

    public function editNameMenu()
    {
        $data = [
            "menu" => htmlspecialchars($this->input->post('menu', true))
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function deleteMenuById($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
        $this->db->delete('user_access_menu', ['menu_id' => $id]);
    }

    // USER SUB MENU
    public function addSubMenu()
    {
        $data = [
            'title' => htmlspecialchars($this->input->post('title', true)),
            'menu_id' => htmlspecialchars($this->input->post('menu_id', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true)),
        ];
        $this->db->insert('user_sub_menu', $data);
    }

    public function getSubMenuByCheck()
    {
        return $this->db->get_where('user_sub_menu', [
            'title' => $this->input->post('title'),
            'menu_id' => $this->input->post('menu_id'),
            'url' => $this->input->post('url'),
            'icon' => $this->input->post('icon'),
            'is_active' => $this->input->post('is_active')
        ])->row_array();
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function editSubMenu()
    {
        $data = [
            'title' => htmlspecialchars($this->input->post('title', true)),
            'menu_id' => htmlspecialchars($this->input->post('menu_id', true)),
            'url' => htmlspecialchars($this->input->post('url', true)),
            'icon' => htmlspecialchars($this->input->post('icon', true)),
            'is_active' => htmlspecialchars($this->input->post('is_active', true))
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    public function deleteSubMenuById($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }

    public function updateIsActive($idSubMenu)
    {
        $this->db->where('id', $idSubMenu);
        $this->db->update('user_sub_menu', ['is_active' => 0]);
    }
    public function updateIsNotActive($idSubMenu)
    {
        $this->db->where('id', $idSubMenu);
        $this->db->update('user_sub_menu', ['is_active' => 1]);
    }
}
