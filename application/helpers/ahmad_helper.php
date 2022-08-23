<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);
    }

    if ($menu == 'approval_1') {
        $menu = 'approval departemen';
    }

    $querymenu = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
    $menu_id = $querymenu['id'];

    // var_dump($menu_id);


    $cari = $ci->m_lembur->cari_akses($role_id, $menu_id);


    if ($cari == []) {
        redirect('auth/blocked');
    }
}

function check_access($role_id, $menu_id)
{
    $ci = get_instance();
    $ci->db->where('role_id', $role_id);
    $ci->db->where('menu_id', $menu_id);
    $result = $ci->db->get('user_access_menu');

    if ($result->num_rows() > 0) {
        return "checked";
    }
}
