<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->database('database_kedua', TRUE);
        $this->load->library('Oracle_Database', '', 'OD');
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('user/menu_awal');
        }

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            //jika login gagal maka
            $data['title'] = 'Login';


            // login versi keren
            $this->load->view('auth/loginv2');
        } else {
            //jika berhasil validasi makaa
            $this->_login();
        }
    }

    private function _login()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        // $user = $this->db->get_where('tb_user', ['username' => $username])->row_array();
        $user = $db2->get_where('user', ['username' => $username])->row_array();

        $nik = $user['nik'];

        $cari_role = $this->m_lembur->cari_role($nik);

        $role = [];

        foreach ($cari_role as $c) {
            $role[] = $c['id_role'];
        };

        if ($cari_role == null) {
            $role = ['2'];
        }

        // var_dump($user);
        // die;

        //jika datanya ada di database
        if ($user) {
            //jika usernya aktif
            if ($user['is_active'] == 1) {
                //cek passwordnya

                if ($password == $user['password']) {
                    $data = [
                        'username' => $user['username'],
                        'name' => $user['name'],
                        'nik' => $user['nik'],
                        'departemen' => $user['departemen'],
                        'role_id' => $role
                    ];
                    $this->session->set_userdata($data);


                    redirect('user/menu_awal');
                } else {
                    //password salah.
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    password salah
                    </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Akun tidak aktif
                </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Login gagal
            </div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $this->load->database('database_kedua', TRUE);
        $data['departemen'] = $this->m_lembur->daftar_departemen();
        //validasi ketika tambah data

        $this->form_validation->set_rules('id', 'ID', 'required|trim');
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check', 'required|trim');
        $this->form_validation->set_rules('departemen', 'Departemen', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            //jika validasi salah maka tampil:
            $data['title'] = 'Tambah data user'; //menambahkan judul halaman web

            $this->load->view('auth/registration', $data);
        } else {
            // jika user ada di data pusat
            $nik1 = $this->input->post('id');
            $nik_string = "'" . $nik1 . "'";
            $sql = 'SELECT NIK, "Nm_Karyawan" nm FROM PAYROLLWKS."Karyawan" WHERE NIK = ' . $nik_string . '';
            $hasil = $this->OD->query($sql);
            $hasil1 = count($hasil);
            $userada = $db2->get_where('user', ['nik' => $nik1])->row_array();

            if ($hasil1 > 0) {

                if ($userada > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Maaf anda sudah pernah mendaftar
                    </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
                    redirect('auth');
                } else {
                    $data = [ //proses pengambilan data
                        'nik' => $this->input->post('id'),
                        'name' => $this->input->post('name'),
                        'username' => $this->input->post('username'),
                        'image' => 'default.jpg',
                        'departemen' => $this->input->post('departemen'),
                        'password' => md5($this->input->post('password1')),
                        'role_id' => 2,
                        'is_active' => 1,
                        'date_created' => date('Y-m-d')
                    ];

                    //proses memasukkan data yang diambil kedalam tabel user
                    $db2->insert('user', $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    User berhasil ditambahkan
                    </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                Maaf NIK anda tidak terdaftar
                </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
                redirect('auth');
            }

            // iki lawas

        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            berhasil log out
            </div>');
        redirect('auth');
    }

    public function blocked()
    {
        $data['title'] = 'Blocked';
        $this->load->view('template/header', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('template/footer');
    }

    public function username_check($str)
    {
        $db2 = $this->load->database('database_kedua', TRUE);

        $db2->select('username');
        $db2->from('user');
        $db2->where('username', $str);
        $username = $db2->get()->row_array();

        $username1 = $username['username'];


        if ($str == $username1) {
            $this->form_validation->set_message('username_check', 'username telah terdaftar coy, coba yang lain');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function cari_nik()
    {
        $nik = $this->input->post('keyword');
        $nik_string = "'" . $nik . "'";
        $query = 'SELECT NIK, "Nm_Karyawan" nm FROM PAYROLLWKS."Karyawan" WHERE NIK = ' . $nik_string . '';

        $hasil = $this->OD->query($query);
        echo json_encode($hasil);
    }

    function cari_nama()
    {
        $nama = $this->input->post('nama');
        // $nama = 'NAID';
        $string_nama = "'%" . $nama . "%'";
        $query = 'SELECT NIK , "Nm_Karyawan" , "Kd_Jabatan" ,"Kd_Bagian"  FROM PAYROLLWKS."Karyawan" WHERE "IsActive" = 1 AND "Nm_Karyawan"  LIKE ' . $string_nama;
        $hasil = $this->OD->query($query);
        // $cari = $this->m_lembur->get_nama($nama);
        echo json_encode($hasil);
        // var_dump($hasil);
    }
}
