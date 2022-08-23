<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approval_1 extends CI_Controller

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
        // $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $nik = $this->session->userdata('nik');
        $cari_departemen = $this->m_user->get_departemen_user($nik);

        $departemen = [];
        foreach ($cari_departemen as $cd) {
            $departemen[] = $cd['id_departemen'];
        };


        // $id = ($user['nik']);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['lembur'] = $this->m_lembur->get_form_lembur('0');
        // $departemen = $user['departemen'];

        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lembur_departemen'] = $this->m_lembur->get_form_lembur_departemen('0', $departemen);

        // $data['lembur'] = $this->m_lembur->get_form_lembur('3');



        $data['title'] = 'Permintaan lembur dept';


        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/pimpinan_1', $data);
        $this->load->view('template/footer', $data);
    }

    public function riwayat_approve()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $status = 1;

        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();


        $nik = $this->session->userdata('nik');
        $cari_departemen = $this->m_user->get_departemen_user($nik);

        $departemen = [];
        foreach ($cari_departemen as $cd) {
            $departemen[] = $cd['id_departemen'];
        };

        $data['lembur'] = $this->m_lembur->get_form_approve_departemen($status, $departemen);

        // var_dump($status);
        // var_dump($data['lembur']);
        // die;

        $data['title'] = 'Riwayat approve dept';

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/riwayat_approve', $data);
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



        $status = 0;


        $data['form'] = $this->m_lembur->get_form($idform);
        $data['detail'] = $this->m_lembur->get_detail($idform, $status);

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('approval/detail_form', $data);
        $this->load->view('template/footer', $data);
    }

    public function approve($id)
    {
        $get_departemen_form = $this->m_lembur->get_departemen_form($id);
        $departemen_form = $get_departemen_form[0]['id_departemen'];

        if ($departemen_form == '2') {
            $status_form = 1;
        } else {
            $status_form = 2;
        }


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
            'status' => $status_form,
            'dept' => $this->session->userdata('username')
        ];

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Approve
            </div>');

        $this->m_lembur->update_status_form($id, $data2);

        $role = $this->session->userdata('role_id');

        redirect('approval_1');
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
        $status_form = 1;

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
}
