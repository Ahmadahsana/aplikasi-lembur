<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->library('form_validation');
        // date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $db2 = $this->load->database('database_kedua', TRUE);
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $status = 1;

        // $data['user'] = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // $user = $this->db->get_where('tb_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['title'] = 'Menu management';

        $data['menu_management'] = $this->db->get('user_menu')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('template/footer', $data);
    }

    public function addmenu()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Menu management';
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

            $data['menu'] = $this->db->get('user_menu')->result_array();
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('template/footer', $data);
        } else {
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil ditambahkan
            </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
            redirect('menu');
        }
    }

    public function editmenu($id)
    {
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        $menu = $this->input->post('menu');
        $data = [
            'menu' => $menu
        ];


        if ($this->form_validation->run() == false) {
            redirect('menu');
        } else {
            $this->m_user->edit_menu($id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Menu berhasil diedit
            </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
            redirect('menu');
        }
    }

    public function submenu()
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];
        $data['menu_edit'] = $this->m_lembur->cari_menu_admin();

        $db2 = $this->load->database('database_kedua', TRUE);
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');


        $data['title'] = 'Submenu Management';
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->model('m_menu');
        $data['submenu'] = $this->m_menu->getsubmenu();

        // $data['menu'] = $this->db->get('user_menu')->result_array();

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('template/footer', $data);
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sub Menu berhasil ditambahkan
            </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
            redirect('menu/submenu');
        }
    }

    public function edit_submenu($id)
    {
        $role = $this->session->userdata['role_id'];
        $data['menu'] = $this->m_lembur->cari_menu($role);
        $data['role'] = $this->session->userdata['role_id'];

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        $title = $this->input->post('title');
        $menu_id = $this->input->post('menu_id');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $aktif = $this->input->post('aktif');

        $data = [
            'menu_id' => $menu_id,
            'title' => $title,
            'url' => $url,
            'icon' => $icon,
            'is_active' => $aktif
        ];

        $this->db->where('id', $id);
        $this->db->update('user_sub_menu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sub Menu berhasil di update
            </div>'); //pesan yang ditampilkan ketika berhasil insert ke tabel
        redirect('menu/submenu');
    }
}
