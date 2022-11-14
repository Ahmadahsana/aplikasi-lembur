<?php
defined('BASEPATH') or exit('No direct script access allowed');

class m_lembur extends CI_Model

{
    public function insert_lembur($dataform)
    {
        $query = $this->db->insert('form_pengajuan', $dataform);
        return $this->db->insert_id();
    }

    function get_nama($nama)
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->like('nama', $nama);
        return $this->db->get()->result_array();
    }

    function get_byid_sub($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('user_sub_menu');
        return $query->result();
    }

    function get_form_lembur($status)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where_in('form_pengajuan.status', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_form_lembur_manager($status)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where_in('form_pengajuan.status', $status);
        $this->db->where('form_pengajuan.manager', null);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_form_lembur_hr($status)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where_in('form_pengajuan.status', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_form_lembur_departemen($status, $departemen)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.tgl_lembur, form_pengajuan.status,  status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');;
        // $this->db->join('tb_user', 'form_pengajuan.nik = tb_user.nik');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        // $this->db->join('tb_grup_jabatan', 'form_pengajuan.nik_h = tb_grup_jabatan.nik');
        $this->db->join('view_departemen_form', 'view_departemen_form.id_form = form_pengajuan.id');
        // $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.status', $status);
        $this->db->where_in('id_dept', $departemen);
        $this->db->order_by('form_pengajuan.id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_form($id)
    {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    function get_form_detail($id)
    {
        $this->db->select('*');
        $this->db->from('detail_form');
        $this->db->where('id_form', $id);
        return $this->db->get()->result_array();
    }

    function get_detail($id, $status)
    {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.id', $id);
        $this->db->where_in('detail_form.status', $status);
        return $this->db->get()->result_array();
    }

    function get_detail_hr($id, $status)
    {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.id', $id);
        $this->db->where_in('detail_form.status', $status);
        return $this->db->get()->result_array();
    }

    function get_karyawan_tolak($idform, $status)
    {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.id', $idform);
        $this->db->where('detail_form.status <', $status);
        return $this->db->get()->result_array();
    }

    function get_tolak($idform, $user_pic)
    {
        $this->db->select('*');
        $this->db->from('log_perubahan');
        $this->db->join('jenis_log', 'log_perubahan.jenis_log = jenis_log.id');
        $this->db->where('id_form', $idform);
        $this->db->where('user_pic', $user_pic);
        return $this->db->get()->result_array();
    }

    function update_status($id, $nama, $data)
    {
        $this->db->where('id_form', $id);
        $this->db->where('nama_user', $nama);
        $this->db->update('detail_form', $data);
        return;
    }

    function update_status_hr($id, $data)
    {
        $this->db->where('id_form', $id);
        $this->db->where('status', 4);
        $this->db->or_where('status', 5);
        $this->db->update('detail_form', $data);
        return;
    }

    function update_status_form($id, $data2)
    {
        $this->db->where('id', $id);
        $this->db->update('form_pengajuan', $data2);
        return;
    }

    public function daftar_departemen()
    {
        $this->db->select('*');
        $this->db->from('departemen');
        return $this->db->get()->result_array();
    }

    public function get_daftar_user()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $db2->select('*');
        $db2->from('user');
        // $db2->join('user_role', 'user.role_id = user_role.id');
        return $db2->get()->result_array();
    }

    public function get_riwayat_pengajuan($nik)
    {
        $this->db->select('form_pengajuan.id, pembuat, tgl_lembur, alasan, status, nama_status, warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('nik_h', $nik);
        $this->db->order_by('form_pengajuan.id', 'desc');
        return $this->db->get()->result_array();
    }


    public function get_form_approve($status)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.status >=', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_approve_efisiensi($status, $username)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.status >=', $status);
        $this->db->where('efisiensi', $username);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_approve_cc($status, $username)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.status >=', $status);
        $this->db->where('cc', $username);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_approve_manager($manager, $username)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.manager', $manager);
        $this->db->where('manager', $username);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_approve_ppc($status, $username)
    {
        // $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        // $this->db->from('form_pengajuan');
        // $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        // $this->db->join('tb_grup_jabatan', 'tb_grup_jabatan.nik = form_pengajuan.nik_h');
        // // $this->db->where('form_pengajuan.status >=', $status);
        // // $this->db->where('id_departemen', 2);
        // $this->db->where('ppc', $username);
        // $this->db->order_by('id', 'desc');
        // return $this->db->get()->result_array();

        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.status >=', $status);
        $this->db->where('ppc', $username);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_lembur_admin()
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_lembur_report()
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna, detail_form.nama_user, detail_form.nik, detail_form.departemen, detail_form.jam_mulai, detail_form.jam_selesai, detail_form.status_kar');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.status', 6);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_lembur_report_filter_tgl($tgl_mulai, $tgl_akhir)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna, detail_form.nama_user, detail_form.nik, detail_form.departemen, detail_form.jam_mulai, detail_form.jam_selesai, detail_form.status_kar');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.status', 6);
        $this->db->where('form_pengajuan.tgl_lembur >=', $tgl_mulai);
        $this->db->where('form_pengajuan.tgl_lembur <=', $tgl_akhir);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_lembur_report_filter($departemenpilih, $tgl_mulai, $tgl_akhir)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna, detail_form.nama_user, detail_form.nik, detail_form.departemen, detail_form.jam_mulai, detail_form.jam_selesai, detail_form.status_kar');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.status', 6);
        $this->db->where('form_pengajuan.tgl_lembur >=', $tgl_mulai);
        $this->db->where('form_pengajuan.tgl_lembur <=', $tgl_akhir);
        $this->db->where('detail_form.departemen', $departemenpilih);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_lembur_report_filter_dept($departemenpilih)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna, detail_form.nama_user, detail_form.nik, detail_form.departemen, detail_form.jam_mulai, detail_form.jam_selesai, detail_form.status_kar');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->join('detail_form', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('form_pengajuan.status', 6);
        $this->db->where('detail_form.departemen', $departemenpilih);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_approve_departemen($status, $departemen)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('tb_grup_jabatan', 'form_pengajuan.nik_h = tb_grup_jabatan.nik'); //+
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.status >=', $status);
        $this->db->where_in('id_departemen', $departemen);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_approve_departemen1($status, $departemen, $username)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('view_departemen_form', 'view_departemen_form.id_form = form_pengajuan.id');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('form_pengajuan.status >=', $status);
        $this->db->where('dept', $username);
        $this->db->where_in('id_dept', $departemen);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    public function get_form_hr($status)
    {
        $this->db->select('form_pengajuan.id, form_pengajuan.pembuat, form_pengajuan.nik_h, form_pengajuan.alasan, form_pengajuan.status, form_pengajuan.tgl_lembur, status_f.nama_status, status_f.warna');
        $this->db->from('form_pengajuan');
        $this->db->join('status_f', 'form_pengajuan.status = status_f.id');
        $this->db->where('status', $status);
        $this->db->order_by('id', 'desc');
        return $this->db->get()->result_array();
    }

    function get_departemen_user($pembuat)
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $db2->select('*');
        $db2->from('user');
        $db2->where('username', $pembuat);
        return $db2->get()->row_array();
    }

    function update_keterangan($data, $user, $idform)
    {
        $this->db->where('id_form', $idform);
        $this->db->where('nama_user', $user);
        $this->db->update('detail_form', $data);
        return $this->db->affected_rows();
    }

    function cari_role($nik)
    {
        $this->db->select('*');
        $this->db->from('tb_grup_role');
        $this->db->where('nik', $nik);
        return $this->db->get()->result_array();
    }

    function cari_menu($role)
    {

        $this->db->select('*');
        $this->db->from('user_access_menu');
        $this->db->join('user_menu', 'user_access_menu.menu_id = user_menu.id');
        $this->db->where_in('role_id', $role);
        $this->db->where('menu_id !=', 2);
        $this->db->where('menu_id !=', 14);
        return $this->db->get()->result_array();
    }

    function cari_menu_admin()
    {

        $this->db->select('*');
        $this->db->from('user_menu');
        return $this->db->get()->result_array();
    }

    function get_departemen_form($id)
    {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        $this->db->join('tb_grup_jabatan', 'form_pengajuan.nik_h = tb_grup_jabatan.nik');
        $this->db->where('form_pengajuan.id', $id);
        return $this->db->get()->result_array();
    }

    function get_departemen_form_cetak($id)
    {
        $this->db->select('*');
        $this->db->from('form_pengajuan');
        // $this->db->join('tb_grup_jabatan', 'form_pengajuan.nik_h = tb_grup_jabatan.nik');
        $this->db->join('view_departemen_form', 'form_pengajuan.id = view_departemen_form.id_form');
        $this->db->where('form_pengajuan.id', $id);
        return $this->db->get()->result_array();
    }

    function user_edit($nik)
    {
        $this->db->select('tb_grup_role.id, id_role, alias, nik, role');
        $this->db->from('tb_grup_role');
        $this->db->join('user_role', 'user_role.id = tb_grup_role.id_role');
        $this->db->where('nik', $nik);
        return $this->db->get()->result_array();
    }

    function cari_akses($role_id, $menu_id)
    {
        $this->db->select('*');
        $this->db->from('user_access_menu');
        $this->db->where_in('role_id', $role_id);
        $this->db->where('menu_id', $menu_id);
        return $this->db->get()->result_array();
    }

    function get_departemen($departemen_form)
    {
        $this->db->select('*');
        $this->db->from('departemen');
        $this->db->where('id', $departemen_form);
        return $this->db->get()->row_array();
    }

    function get_form_print($idform)
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $this->db->select('form_pengajuan.id, pembuat, form_pengajuan.nik_h, alasan, no_order, tgl_lembur, dept, ppc, efisiensi, cc, manager, perpanjangan');
        $this->db->from('form_pengajuan');
        $this->db->join($db2->database . '.user', 'form_pengajuan.nik_h = user.nik');
        $this->db->where('form_pengajuan.id', $idform);
        return $this->db->get()->row_array();
    }

    function get_peserta($id, $status)
    {
        $this->db->select('nama_user, id_form, form_pengajuan.status, detail_form.jam_mulai, detail_form.jam_selesai, detail_form.nik, detail_form.departemen, detail_form.status_kar');
        $this->db->from('detail_form');
        $this->db->join('form_pengajuan', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('detail_form.id_form', $id);
        $this->db->where_in('detail_form.status', $status);
        return $this->db->get()->result_array();
    }

    function get_peserta_hr($id, $status)
    {
        $this->db->select('nama_user, id_form, form_pengajuan.status, jam_mulai, jam_selesai');
        $this->db->from('detail_form');
        $this->db->join('form_pengajuan', 'form_pengajuan.id = detail_form.id_form');
        $this->db->where('detail_form.id_form', $id);
        $this->db->where_in('detail_form.status', $status);
        return $this->db->get()->result_array();
    }

    function insert_log($data_detail)
    {
        $this->db->insert('log_perubahan', $data_detail);
    }

    function cari_detail_form($id_detail)
    {
        $this->db->select('*');
        $this->db->from('detail_form');
        $this->db->where('id', $id_detail);
        return $this->db->get()->row_array();
    }

    function hapus_detail($id_detail)
    {
        $this->db->where('id', $id_detail);
        $this->db->delete('detail_form');
    }
}
