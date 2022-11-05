<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function getuserkeluhan()
    {
        $userid = $this->session->userdata('id');
        $query = "SELECT * 
        FROM `keluhan`
        WHERE `id` = $userid ";

        return $this->db->query($query)->result_array();
    }

    function update_user($username, $data)
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $db2->where('username', $username);
        $db2->update('user', $data);
    }

    function tambah_role($data_role)
    {
        $this->db->insert('tb_grup_role', $data_role);
    }

    public function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_menu($id, $data)
    {

        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
    }

    public function get_departemen($user)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('user_role', 'user_role.id = user.role_id');
        $this->db->where('username', $user);
        return $this->db->get()->row_array();
    }

    public function get_departemen_1($user)
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $db2->select('*');
        $db2->from('user');
        $db2->join('user_role', 'user_role.id = user.role_id');
        $db2->where('username', $user);
        return $db2->get()->row_array();
    }

    public function get_departemen_user($nik)
    {
        $this->db->select('*');
        $this->db->from('tb_grup_jabatan');
        $this->db->join('departemen', 'departemen.id = tb_grup_jabatan.id_departemen');
        $this->db->where('nik', $nik);
        return $this->db->get()->result_array();
    }

    public function get_departemen_edit($nik)
    {
        $this->db->select('tb_grup_jabatan.id, departemen.departemen');
        $this->db->from('tb_grup_jabatan');
        $this->db->join('departemen', 'departemen.id = tb_grup_jabatan.id_departemen');
        $this->db->where('nik', $nik);
        return $this->db->get()->result_array();
    }

    function get_role($role)
    {
        $this->db->select('*');
        $this->db->from('user_role');
        $this->db->where('id', $role);
        return $this->db->get()->row_array();
    }

    function hapus_role($id)
    {
        // $this->db->where('tb_grup_role.id', $id);
        // $hasil = $this->db->delete('tb_grup_role');
        $hasil = $this->db->delete('tb_grup_role', array('id' => $id));
        echo json_encode($hasil);
    }

    function hapus_departemen($id)
    {

        $hasil = $this->db->delete('tb_grup_jabatan', array('id' => $id));
        echo json_encode($hasil);
    }

    function cari_departemen($departemen)
    {
        $this->db->select('*');
        $this->db->from('departemen');
        $this->db->where('departemen', $departemen);
        return $this->db->get()->row_array();
    }

    function cari_jabatan($nik, $iddepartemen)
    {
        $this->db->select('*');
        $this->db->from('tb_grup_jabatan');
        $this->db->where('nik', $nik);
        $this->db->where('id_departemen', $iddepartemen);
        return $this->db->get()->row_array();
    }

    function tambah_jabatan($data_jabatan)
    {
        $this->db->insert('tb_grup_jabatan', $data_jabatan);
    }

    function get_role_pimpinan()
    {
        $this->db->select('*');
        $this->db->from('view_role');
        $this->db->where('id_role !=', 2);
        $this->db->where('id_role !=', 1);
        return $this->db->get()->result_array();
    }

    function tambah_ttd($data)
    {
        $this->db->insert('ttd', $data);
    }

    function get_ttd()
    {
        $this->db->select('*');
        $this->db->from('ttd');
        return $this->db->get()->result_array();
    }

    function update_ttd($nik, $data)
    {
        $this->db->where('nik', $nik);
        $this->db->update('ttd', $data);
    }
}
