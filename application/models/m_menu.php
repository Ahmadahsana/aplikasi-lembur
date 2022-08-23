<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_menu extends CI_Model

{
    public function getsubmenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`

        ";

        // $this->db->select('*');
        // $this->db->from('user_sub_menu');
        // $query = $this->db->get()->result_array();
        // return $query;
        return $this->db->query($query)->result_array();
    }

    function get_byid($id)
    {
        $this->db->where('id_keluhan', $id);
        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function hapussub($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function hapusmenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }
}
