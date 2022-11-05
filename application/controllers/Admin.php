<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    var $table = 'keluhan';

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
        $data['title'] = 'Dashboard';

        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function daftar_user()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Daftar user';
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['daftar_user'] = $this->m_lembur->get_daftar_user();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/daftar_user', $data);
        $this->load->view('template/footer', $data);
    }



    public function role()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Role';

        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // $data['role'] = $db2->get('user_role')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('template/footer', $data);
    }

    public function addrole()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Role';

            $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

            $data['role'] = $db2->get('user_role')->result_array();

            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('template/footer', $data);
        } else {
            $db2->insert('user_role', ['role' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Role berhasil ditambahkan
            </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
            redirect('admin/role');
        }
    }

    public function roleaccess($role_id)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Role access';

        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // $data['role'] = $db2->get_where('user_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        // $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/role_access', $data);
        $this->load->view('template/footer', $data);
    }

    public function gantiakses()
    {
        $menu_id = $this->input->post('menu_id');
        $role_id = $this->input->post('role_id');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            berhasil ganti akses
            </div>');
    }

    public function editsub($id)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Submenu management';
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['get_byid'] = $this->m_lembur->get_byid_sub($id);
        $data['menu_pilihan'] = $this->db->get('user_menu')->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('menu/edit_sub', $data);
        $this->load->view('template/footer', $data);
    }

    public function daftar_lembur()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];
        $data['title'] = 'Daftar lembur';
        $db2 = $this->load->database('database_kedua', TRUE);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['lembur'] = $this->m_lembur->get_form_lembur_admin();
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

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/daftar_lembur', $data);
        $this->load->view('template/footer', $data);
    }

    public function hapussub($id)
    {
        $this->load->model('m_menu');

        $this->m_menu->hapussub($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            berhasil hapus 
            </div>');
        redirect('menu/submenu');
    }

    public function edit_user($nik)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $db2 = $this->load->database('database_kedua', TRUE);
        $data['title'] = 'Edit user';
        $data['useredit'] = $db2->get_where('user', ['nik' => $nik])->row_array();
        $data['useredit_role'] = $this->m_lembur->user_edit($nik);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['departemen'] = $this->db->get('departemen')->result_array();
        $data['role'] = $this->db->get('user_role')->result_array();

        $departemen = $this->m_user->get_departemen_edit($nik);
        $data['departemen_user'] = $departemen;

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/edit_user', $data);
        $this->load->view('template/footer', $data);
    }



    public function update_user($username)
    {

        $nama = $this->input->post('nama');
        $username = $this->input->post('username');
        $nik = $this->input->post('nik');
        $departemen = $this->input->post('departemen');
        $role = $this->input->post('role');
        $aktif = $this->input->post('aktif');


        //ini untuk database pura keluhan
        $data = [
            'nik' => $nik,
            'name' => $nama,
            'username' => $username,
            'departemen' => $departemen,
            // 'role_id' => $role,
            'is_active' => $aktif
        ];

        // mencari id departemen
        $caridepartemen = $this->m_user->cari_departemen($departemen);
        $iddepartemen = $caridepartemen['id'];

        // mencari di tb_grup_jabatan
        $carijabatan = $this->m_user->cari_jabatan($nik, $iddepartemen);

        if ($carijabatan == null) {
            $data_jabatan = [
                'nik' => $nik,
                'id_jabatan' => 0,
                'id_departemen' => $iddepartemen
            ];

            $this->m_user->tambah_jabatan($data_jabatan);
        }

        if ($role != null) {
            $data_role = [
                'id_role' => $role,
                'nik' => $nik
            ];
            $this->m_user->tambah_role($data_role);
        }

        //proses memasukkan data yang diambil kedalam tabel user di pura keluhan

        $this->m_user->update_user($username, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        berhasil update data user
        </div>');
        redirect('admin/daftar_user/');
    }

    public function hapus_user($id)
    {
        $where = array('id' => $id);
        $this->m_user->hapus($where, 'user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        berhasil hapus user
        </div>');
        redirect('admin/daftar_user');
    }

    public function hapus_menu($id)
    {
        $this->load->model('m_menu');

        $this->m_menu->hapusmenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            berhasil hapus 
            </div>');
        redirect('menu');
    }

    function hapus_role()
    {
        $id = $this->input->get('id');
        // var_dump($id);
        // echo json_encode($id);
        $this->m_user->hapus_role($id);
    }

    function hapus_departemen()
    {
        $id = $this->input->get('id');
        $this->m_user->hapus_departemen($id);
    }

    function ttd()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];
        $data['title'] = 'Tanda tangan';
        $db2 = $this->load->database('database_kedua', TRUE);
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['data_role'] = $this->m_user->get_role_pimpinan();
        $data['data_ttd'] = $this->m_user->get_ttd();

        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('admin/ttd', $data);
        $this->load->view('template/footer', $data);
    }

    function simpan_ttd()
    {
        $username = $this->input->post('username');
        $nik = $this->input->post('nik');
        $nama_terang = $this->input->post('nama_terang');
        $gambar = $_FILES['gambar']['name'];

        if ($gambar) {
            $config['upload_path']      = './assets/images/ttd/';
            $config['allowed_types']    = 'jpg|png|gif|jpeg';
            $config['file_name']    = $username;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('gambar')) {
                $new_image = $this->upload->data('file_name');
                // $this->db->set('gambar_keluhan', $new_image);
            } else {
                echo $this->upload->display_errors();
            }
        }

        $ttdlama = $this->db->get_where('ttd', ['nik' => $nik])->result_array();

        if (count($ttdlama) > 0) {

            if ($gambar) {
                $data = [
                    'nik' => $nik,
                    'username' => $username,
                    'ttd' => $new_image,
                    'nama_terang' => $nama_terang
                ];
            } else {
                $data = [
                    'nik' => $nik,
                    'username' => $username,
                    'nama_terang' => $nama_terang
                ];
            }

            $this->m_user->update_ttd($nik, $data);
        } else {
            $data = [
                'nik' => $nik,
                'username' => $username,
                'ttd' => $new_image,
                'nama_terang' => $nama_terang
            ];

            $this->m_user->tambah_ttd($data);
        }


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            berhasil simpan ttd
            </div>');
        redirect('admin/ttd');
    }

    public function reset_password($username)
    {
        $password_reset = md5('123456');
        $db2 = $this->load->database('database_kedua', TRUE);
        $db2->set('password', $password_reset);
        $db2->where('username', $username);
        $db2->update('user');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password berhasil direset
                    </div>');
        redirect('admin/daftar_user');
    }

    public function hapus_lembur($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('form_pengajuan');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Berhasil hapus
                    </div>');
        redirect('admin/daftar_lembur');
    }
}
