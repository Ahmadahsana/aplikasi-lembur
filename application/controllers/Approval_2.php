<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval_2 extends CI_Controller

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

        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['lembur'] = $this->m_lembur->get_form_lembur('2');
        $peserta = [];

        foreach ($data['lembur'] as $d) {

            $hasil = $this->m_lembur->get_peserta($d['id'], '2');
            foreach ($hasil as $h) {
                $peserta[] = [
                    'id' => $h['id_form'],
                    'peserta' => $h['nama_user']
                ];
            }
        };

        $data['peserta'] = $peserta;

        $data['title'] = 'Permintaan lembur';

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/pimpinan_2', $data);
        $this->load->view('template/footer', $data);
    }

    public function riwayat_approve()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        // $db2 = $this->load->database('database_kedua', TRUE);
        // $data['userini'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $id = ($user['nik']);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $status = $this->session->userdata('status_form');
        $status = 3;

        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lembur'] = $this->m_lembur->get_form_approve($status);

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

        $data['title'] = 'Riwayat approve';

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/riwayat_approve2', $data);
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

        $status_form = $this->session->userdata('status_form');


        // if ($status_form == 1) {
        $status = 2;



        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail($idform, $status);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_form2', $data);
        $this->load->view('template/footer', $data);
    }

    public function approve($id)
    {
        $status_form = 3;
        $detail_form = $this->m_lembur->get_form_detail($id);
        $user_pic = $this->session->userdata('nik');
        $result = array();
        $r = 0;
        foreach ($_POST['jam_selesai'] as $key => $val) {
            if ($detail_form[$key]['jam_mulai'] !== $_POST['jam_mulai'][$key] || $detail_form[$key]['jam_selesai'] !== $_POST['jam_selesai'][$key]) { // || $detail_form[$key]['jam_mulai'] !== $_POST['jam_mulai'][$key] && $detail_form[$key]['jam_selesai'] !== $_POST['jam_selesai'][$key]
                $data_detail = [
                    'id_detail' => $detail_form[$key]['id'],
                    'id_form' => $detail_form[$key]['id_form'],
                    'nama_user' => $detail_form[$key]['nama_user'],
                    'nik' => $detail_form[$key]['nik'],
                    'jam_mulai'  => $detail_form[$key]['jam_mulai'],
                    'jam_selesai' => $detail_form[$key]['jam_selesai'],
                    'departemen' => $detail_form[$key]['departemen'],
                    'status_kar' => $detail_form[$key]['status_kar'],
                    'bagian' => $detail_form[$key]['bagian'],
                    'no_order' => $detail_form[$key]['no_order'],
                    'alasan' => $detail_form[$key]['alasan'],
                    'status' => $status_form,
                    'jenis_log' => 1,
                    'user_pic' => $user_pic
                ];
                // var_dump($data_detail);
                // die;
                $this->m_lembur->insert_log($data_detail);
            }
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
            'status' => $status_form,
            'efisiensi' => $this->session->userdata('username')
        ];

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Approve
            </div>');

        $this->m_lembur->update_status_form($id, $data2);

        $role = $this->session->userdata('role_id');

        redirect('approval_2');
    }

    function detail_approve($idform, $status)
    {
        $user_pic = $this->session->userdata('nik');
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
        $status_form = 3;

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
        $data['tolak'] = $this->m_lembur->get_tolak($idform, $user_pic);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_approve', $data);
        $this->load->view('template/footer', $data);
    }
}
