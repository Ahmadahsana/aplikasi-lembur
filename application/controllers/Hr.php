<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hr extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $id = ($user['nik']);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $status = ['5', '4'];
        $data['lembur'] = $this->m_lembur->get_form_lembur_hr($status);

        $peserta = [];

        foreach ($data['lembur'] as $d) {

            $hasil = $this->m_lembur->get_peserta_hr($d['id'], $status);

            foreach ($hasil as $h) {
                $peserta[] = [
                    'id' => $h['id_form'],
                    'peserta' => $h['nama_user'],
                    'jam_selesai' => $h['jam_selesai'],
                    'jam_mulai' => $h['jam_mulai']
                ];
            }
        };

        $data['peserta'] = $peserta;

        $data['title'] = 'Daftar lemburan';

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/daftar_lembur', $data);
        $this->load->view('template/footer', $data);
    }

    public function riwayat_input()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['userini'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $status = 6;

        $data['lembur'] = $this->m_lembur->get_form_hr($status);

        $peserta = [];

        foreach ($data['lembur'] as $d) {

            $hasil = $this->m_lembur->get_peserta($d['id'], $d['status']);
            foreach ($hasil as $h) {
                $peserta[] = [
                    'id' => $h['id_form'],
                    'peserta' => $h['nama_user']
                ];
            }
        };

        $data['peserta'] = $peserta;

        $data['title'] = 'Sudah diinput';

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/riwayat_approve_hr', $data);
        $this->load->view('template/footer', $data);
    }

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

        $status = [5, 4];

        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail_hr($idform, $status);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_form_hr', $data);
        $this->load->view('template/footer', $data);
    }

    public function approve($id)
    {
        $status_form = 6;

        $result = array();
        $r = 0;
        // foreach ($_POST['jam_selesai'] as $key => $val) {
        //     $result[] = [
        //         'nama_user' => $_POST['nama'][$key],
        //         'jam_mulai' => $_POST['jam_mulai'][$key],
        //         'jam_selesai' => $_POST['jam_selesai'][$key],
        //         'bagian' => $_POST['bagian'][$key],
        //         'status' => $status_form
        //     ];

        //     foreach ($result as $r) {
        //         $data = [
        //             $nama = $r['nama_user'],
        //             $jam_mulai = $r['jam_mulai'],
        //             $jam_selesai = $r['jam_selesai'],
        //             $bagian = $r['bagian'],
        //             $status = $r['status']
        //         ];
        //     }

        //     $data1 = [
        //         'jam_mulai' => $jam_mulai,
        //         'jam_selesai' => $jam_selesai,
        //         'bagian' => $bagian,
        //         'status' => $status
        //     ];

        //     $this->m_lembur->update_status($id, $nama, $data1);
        // }

        // metode lain ----------------------------------------------------

        $data1 = [
            'status' => 6
        ];

        $this->m_lembur->update_status_hr($id, $data1);

        // akhir metode lain ----------------------------------------------

        $data2 = [
            'status' => $status_form
        ];

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil input
            </div>');

        $this->m_lembur->update_status_form($id, $data2);

        $role = $this->session->userdata('role_id');

        redirect('hr');
    }

    function detail_approve($idform, $status)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Detail Form';

        // $data['userini'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $id = ($user['nik']);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data'] = [$idform, $status];
        $status_form = 6;

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
            $status_tolak = 5;
        }


        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail($idform, $status);
        $data['tolak'] = $this->m_lembur->get_tolak($idform, $status_tolak);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_approve_hr', $data);
        $this->load->view('template/footer', $data);
    }
}
