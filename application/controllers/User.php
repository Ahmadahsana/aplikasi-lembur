<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->library('Oracle_Database', '', 'OD');
    }

    public function index()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Pengajuan lembur';
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $this->session->userdata('name');


        $tanggal = $this->input->post('tanggal');
        $alasan = $this->input->post('alasan');
        $perpanjangan = $this->input->post('perpanjangan');
        $nik = $this->session->userdata('nik');

        // var_dump($nik);
        // die;
        // $jam_mulai = $this->input->post('timemulai');
        // $jam_selesai = $this->input->post('timeselesai');
        $bagian = $this->input->post('bagian');
        $no_order = $this->input->post('no_order');

        $jajal = $this->input->post('nik[]');

        $data['form'] = [
            'id' => 0,
            'fff' => 1
        ];

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim');
        // $this->form_validation->set_rules('timemulai', 'timemulai', 'required|trim');
        // $this->form_validation->set_rules('timeselesai', 'timeselesai', 'required|trim');
        // $this->form_validation->set_rules('alasan', 'alasan', 'required|trim');
        $this->form_validation->set_rules('nama[]', 'nama', 'required|trim', ['required' => 'harus mengisi karyawan']);

        if ($this->form_validation->run() == true) {

            $dataform = [
                'pembuat' => $user,
                'nik_h' => $nik,
                'tgl_lembur' => $tanggal,
                'status' => 0,
                'perpanjangan' => $perpanjangan
            ];

            $insert1 = $this->m_lembur->insert_lembur($dataform);

            $result = array();
            foreach ($_POST['nama'] as $key => $val) {
                $result[] = array(
                    'id_form' => $insert1,
                    'nama_user' => $_POST['nama'][$key],
                    'nik' => $_POST['nik'][$key],
                    'jam_mulai' => $_POST['jam_mulai'][$key],
                    'jam_selesai' => $_POST['jam_selesai'][$key],
                    'departemen' => $_POST['departemen'][$key],
                    'status_kar' => $_POST['status_kar'][$key],
                    'bagian' => $bagian[$key],
                    'no_order' => $_POST['no_order'][$key],
                    'alasan' => $_POST['alasan'][$key],
                    'status' => 0
                );
            }

            // var_dump($result);
            // die;

            $this->db->insert_batch('detail_form', $result);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            pengajuan lembur berhasil dikirim
            </div>');

            redirect('user');
        } else {

            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('template/footer', $data);
        }
    }

    public function menu_awal()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $role = $this->session->userdata['role_id'];

        if ($role == []) {
            $role1 = 0;
        } else {
            $role1 = $role;
        }


        $data['menu'] = $this->m_lembur->cari_menu($role1);
        $data['role'] = $this->session->userdata['role_id'];
        $data['title'] = 'Aplikasi lembur';
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/menu_awal', $data);
        $this->load->view('template/footer', $data);
    }

    public function report()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $role = $this->session->userdata['role_id'];

        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];
        $data['title'] = 'Report lembur';
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $tgl_mulai = $this->input->post('tgl_mulai');
        $tgl_akhir = $this->input->post('tgl_akhir');

        if ($tgl_mulai == null) {
            $data['lembur'] = $this->m_lembur->get_form_lembur_report();
        } else {
            $data['lembur'] = $this->m_lembur->get_form_lembur_report_filter($tgl_mulai, $tgl_akhir);
        }

        $peserta = [];

        foreach ($data['lembur'] as $d) {

            $hasil = $this->m_lembur->get_peserta($d['id'], '6');
            foreach ($hasil as $h) {
                // var_dump($hasil);
                // die;
                $peserta[] = [
                    'id' => $h['id_form'],
                    'peserta' => $h['nama_user'],
                    'nik' => $h['nik'],
                    'departemen' => $h['departemen'],
                    'status_kar' => $h['status_kar'],
                    'jam_mulai' => $h['jam_mulai'],
                    'jam_selesai' => $h['jam_selesai']
                ];
            }
        };

        $data['peserta'] = $peserta;

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/report', $data);
        $this->load->view('template/footer', $data);
    }

    public function profile()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);

        $data['userini'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $id = ($user['username']);
        $nik = $user['nik'];

        // $data['role'] = $this->m_lembur->cari_role($nik);


        $data['title'] = 'My profile';


        // $data['user'] = $this->m_user->get_departemen_1($id);

        // var_dump($data['user']);
        // die;


        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('template/footer', $data);
    }

    public function editprofile()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['userini'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $id = ($user['username']);
        // $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['user'] = $this->m_user->get_departemen_1($id);



        $data['title'] = 'Edit profile';

        $this->form_validation->set_rules('fullname', 'name', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/editprofile', $data);
            $this->load->view('template/footer', $data);
        } else {
            $nik = $this->input->post('id');
            $nama = $this->input->post('fullname');


            //cek jika ada image 
            $gambar = $_FILES['foto']['name'];
            if ($gambar) {
                $config['upload_path']      = './assets/images/profile/';
                $config['allowed_types']    = 'jpg|png|gif|jpeg';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('foto')) {
                    $new_image = $this->upload->data('file_name');
                    // $this->db->set('gambar_keluhan', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            // var_dump($new_image);
            // die;



            if ($new_image != '') {
                $data = [
                    'nik' => $nik,
                    'name' => $nama,
                    'image' => $new_image,

                ];
            } else {
                $data = [
                    'nik' => $nik,
                    'name' => $nama,
                ];
            }



            $this->m_user->update_user($nik, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil update profile
            </div>');
            redirect('user/editprofile');
        }
    }



    public function ganti_password()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['userini'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $id = ($user['nik']);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


        $data['title'] = 'Ganti password';


        $this->form_validation->set_rules('password_lama', 'Password lama', 'required|trim');
        $this->form_validation->set_rules('password_baru1', 'Password baru', 'required|trim|min_length[6]|matches[password_baru2]');
        $this->form_validation->set_rules('password_baru2', 'Password baru 2', 'required|trim|min_length[6]|matches[password_baru1]');


        if ($this->form_validation->run() == false) {

            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('user/ganti_password', $data);
            $this->load->view('template/footer', $data);
        } else {
            $password = md5($this->input->post('password_lama'));
            $password_baru = md5($this->input->post('password_baru1'));

            if ($password !== $data['userini']['password']) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Password salah
                </div>');
                redirect('user/ganti_password');
            } else {
                if ($password == $password_baru) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Password tidak boleh sama
                    </div>');
                    redirect('user/ganti_password');
                } else {
                    // password aman
                    $db2->set('password', $password_baru);
                    $db2->where('username', $this->session->userdata('username'));
                    $db2->update('user');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil dirubah
                    </div>');
                    redirect('user/ganti_password');
                }
            }
        }
    }


    public function riwayat_pengajuan()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $user = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $nama = $this->session->userdata('nik');
        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['lembur'] = $this->m_lembur->get_riwayat_pengajuan($nama);

        $data['title'] = 'Riwayat pengajuan';

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/riwayat_pengajuan', $data);
        $this->load->view('template/footer', $data);
    }

    public function edit_form($idform)
    {
        // data untuk yang edit ini
        $data = [];
        foreach ($_POST['jam_selesai1'] as $key => $value) {
            $nama = $_POST['nama1'][$key];
            $data = [
                'nama_user' => $_POST['nama1'][$key],
                'jam_mulai' => $_POST['jam_mulai1'][$key],
                'jam_selesai' => $_POST['jam_selesai1'][$key],
                'bagian' => $_POST['bagian1'][$key],
                'no_order' => $_POST['no_order1'][$key],
            ];

            $this->m_lembur->update_status($idform, $nama, $data);
        }

        // data untuk nambah karyawan ini
        if (isset($_POST['jam_selesai'])) {
            $result = array();
            foreach ($_POST['jam_selesai'] as $key => $val) {
                $result[] = array(
                    'id_form' => $idform,
                    'nama_user' => $_POST['nama'][$key],
                    'nik' => $_POST['nik'][$key],
                    'jam_mulai' => $_POST['jam_mulai'][$key],
                    'jam_selesai' => $_POST['jam_selesai'][$key],
                    'departemen' => $_POST['departemen'][$key],
                    'status_kar' => $_POST['status_kar'][$key],
                    'bagian' => $_POST['bagian'][$key],
                    'no_order' => $_POST['no_order'][$key],
                    'alasan' => $_POST['alasan'][$key],
                    'status' => 0
                );
            }

            $this->db->insert_batch('detail_form', $result);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil melakukan perubahan
                    </div>');
        redirect('form/detail_pengajuan/' . $idform . '/0');
    }

    function get_nama()
    {
        $nama = $this->input->post('carinama');
        // $nama = 'NAID';
        $string_nama = "'%" . $nama . "%'";
        $query = 'SELECT NIK , "Nm_Karyawan" , "Kd_Jabatan" ,"Kd_Bagian", "Kd_Unit" FROM PAYROLLWKS."Karyawan" WHERE "IsActive" = 1 AND "Nm_Karyawan"  LIKE ' . $string_nama;
        $hasil = $this->OD->query($query);
        // $cari = $this->m_lembur->get_nama($nama);
        echo json_encode($hasil);
        // var_dump($hasil);
    }
}
