<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends CI_Controller

{
    function detail($idform)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Detail Form';

        // $data['userini'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $id = ($user['nik']);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $status = 4;

        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail($idform, $status);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_form', $data);
        $this->load->view('template/footer', $data);
    }

    function detail_pengajuan($idform, $status)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Detail Form';

        // $data['userini'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $id = $this->session->userdata('nik');
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // $status_form = $this->session->userdata('status_form');




        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail($idform, $status);
        $data['karyawan_tolak'] = $this->m_lembur->get_karyawan_tolak($idform, $status);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_form_karyawan', $data);
        $this->load->view('template/footer', $data);
    }

    function detail_approve($idform, $status)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        // $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Detail Form';

        // $data['userini'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $id = ($user['nik']);
        // $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data'] = [$idform, $status];
        $status_form = $this->session->userdata('status_form');

        if ($status_form == 1) {
            $status_tolak = 0;
        } elseif ($status_form == 2) {
            $status_tolak = 1;
        } elseif ($status_form == 3) {
            $status_tolak = 2;
        } elseif ($status_form == 4) {
            $status_tolak = 3;
        } elseif ($status_form == 5) {
            $status_tolak = 4;
        } else {
        }


        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail($idform, $status);
        $data['tolak'] = $this->m_lembur->get_tolak($idform, $status_tolak);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_approve', $data);
        $this->load->view('template/footer', $data);
    }

    function approve($id)
    {
        $status_form = 5;

        $result = array();
        $r = 0;
        foreach ($_POST['jam_selesai'] as $key => $val) {
            $result[] = [
                'nama_user' => $_POST['nama'][$key],
                'jam_mulai' => $_POST['jam_mulai'][$key],
                'jam_selesai' => $_POST['jam_selesai'][$key],
                'bagian' => $_POST['bagian'][$key],
                'status' => $status_form
            ];

            foreach ($result as $r) {
                $data = [
                    $nama = $r['nama_user'],
                    $jam_mulai = $r['jam_mulai'],
                    $jam_selesai = $r['jam_selesai'],
                    $bagian = $r['bagian'],
                    $status = $r['status']
                ];
            }

            $data1 = [
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'bagian' => $bagian,
                'status' => $status
            ];


            $this->m_lembur->update_status($id, $nama, $data1);
        }

        $data2 = [
            'status' => $status_form
        ];

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Approve
            </div>');

        $this->m_lembur->update_status_form($id, $data2);

        $role = $this->session->userdata('role_id');

        if ($role !== '7') {
            redirect('approval_' . $status_form);
        } else {
            redirect('hr');
        }
    }

    function print($idform, $status)
    {
        // $data['form'] = $this->m_lembur->get_form($idform); 
        $data['form'] = $this->m_lembur->get_form_print($idform); //tak joinkan ke user
        $data['title'] = $idform;

        // $pembuat = $data['form']['nik'];
        $user = $this->m_lembur->get_departemen_form_cetak($idform);

        // var_dump($user);
        // $departemen_form = $user[0]['id_departemen'];
        // var_dump($departemen_form);
        // $data['departemen'] = $this->m_lembur->get_departemen($departemen_form);
        $data['departemen'] = $user;
        $data['data_ttd'] = $this->m_user->get_ttd();

        $data['detail'] = $this->m_lembur->get_detail($idform, $status);
        // var_dump($status);
        $this->load->view('laporan_pdf1', $data);
    }

    function tambah_tolak()
    {
        $id_detail = $this->input->post('nama');
        $idform = $this->input->post('idform');
        $keterangan = $this->input->post('keterangan');
        $user_pic = $this->session->userdata('nik');

        $dari_detail = $this->m_lembur->cari_detail_form($id_detail);

        $data = [
            'id_detail' => $dari_detail['id'],
            'id_form' => $dari_detail['id_form'],
            'nama_user' => $dari_detail['nama_user'],
            'nik' => $dari_detail['nik'],
            'jam_mulai'  => $dari_detail['jam_mulai'],
            'jam_selesai' => $dari_detail['jam_selesai'],
            'departemen' => $dari_detail['departemen'],
            'status_kar' => $dari_detail['status_kar'],
            'bagian' => $dari_detail['bagian'],
            'no_order' => $dari_detail['no_order'],
            'alasan' => $dari_detail['alasan'],
            'status' => $dari_detail['status'],
            'jenis_log' => 2,
            'keterangan' => $keterangan,
            'user_pic' => $user_pic
        ];

        $tambah_log = $this->m_lembur->insert_log($data);
        $this->m_lembur->hapus_detail($id_detail);
        // if ($update > 0) {
        //     echo 'success';
        // } else {
        //     echo 'gagal';
        // }
        // var_dump($dari_detail);
    }
}
