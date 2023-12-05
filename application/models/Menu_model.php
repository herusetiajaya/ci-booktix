<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`. *, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
    ";
        return $this->db->query($query)->result_array();
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }

    public function editNameMenu()
    {
        $data = [
            "menu" => $this->input->post('menu', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_menu', $data);
    }

    public function deleteMenuById($id)
    {
        $this->db->delete('user_menu', ['id' => $id]);
    }

    public function editSubMenu()
    {
        $data = [
            'title' => $this->input->post('title', true),
            'menu_id' => $this->input->post('menu_id', true),
            'url' => $this->input->post('url', true),
            'icon' => $this->input->post('icon', true),
            'is_active' => $this->input->post('is_active', true)
        ];
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('user_sub_menu', $data);
    }

    public function setRulesEditSubMenu()
    {
        if (
            $this->input->post('id') === '1' or
            $this->input->post('id') === '2' or
            $this->input->post('id') === '3' or
            $this->input->post('id') === '4' or
            $this->input->post('id') === '5' or
            $this->input->post('id') === '6' or
            $this->input->post('id') === '7'
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSubMenuById($id)
    {
        $this->db->delete('user_sub_menu', ['id' => $id]);
    }

    public function setRulesDeleteSubMenu($id)
    {
        if (
            $id === '1' or
            $id === '2' or
            $id === '3' or
            $id === '4' or
            $id === '5' or
            $id === '6' or
            $id === '7'
        ) {
            return true;
        } else {
            return false;
        }
    }
}
