<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require FCPATH . 'pdf/autoload.php';
// require_once __DIR__ . '/vendor/autoload.php';

class Form extends CI_Controller

{
    function __construct()
    {
        parent::__construct();
        // $this->load->library('tcpdf');
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

        $id = $this->session->userdata('nik');
        $data['user'] = $db2->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


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
        require FCPATH . 'vendor/autoload.php';
        // $data['form'] = $this->m_lembur->get_form($idform); 
        $data['form'] = $this->m_lembur->get_form_print($idform); //tak joinkan ke user
        $data['title'] = $idform;
        // var_dump('hai');
        // die;
        // $pembuat = $data['form']['nik'];
        $user = $this->m_lembur->get_departemen_form_cetak($idform);

        $data['departemen'] = $user;
        $data['data_ttd'] = $this->m_user->get_ttd();



        $data['detail'] = $this->m_lembur->get_detail($idform, $status);
        $bocah_lembur = $data['detail'];
        $header_form = $data['form'];
        $tgl_lembur =  date("d-m-Y", strtotime($header_form['tgl_lembur']));

        $karyawan_eng = array_filter($bocah_lembur, function ($bocah) {
            return $bocah['status_kar'] == 'ENG';
        });

        $karyawan_os = array_filter($bocah_lembur, function ($bocah) {
            return $bocah['status_kar'] == 'OSS_KPRS';
        });

        // var_dump($data['form']['perpanjangan']);
        // die;

        // nama terang
        $ttd_dept = $this->m_lembur->cari_ttd($header_form['dept']);
        $ttd_ppc = $this->m_lembur->cari_ttd($header_form['ppc']);
        $ttd_efisiensi = $this->m_lembur->cari_ttd($header_form['efisiensi']);
        $ttd_cc = $this->m_lembur->cari_ttd($header_form['cc']);

        // gambar ttd
        $ttd_gambar_dept = FCPATH . '/assets/images/ttd/' . $ttd_dept['ttd'];
        $ttd_gambar_efisiensi = FCPATH . '/assets/images/ttd/' . $ttd_efisiensi['ttd'];
        $ttd_gambar_cc = FCPATH . '/assets/images/ttd/' . $ttd_cc['ttd'];
        if ($data['departemen'][0]['departemen'] == 'Produksi') {
            $ttd_gambar_ppc = FCPATH . '/assets/images/ttd/' . $ttd_ppc['ttd'];
        }


        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        // $spreadsheet = IOFactory::createReader(FCPATH.'files/template.xls');
        if ($data['departemen'][0]['departemen'] == 'Produksi') {
            $spreadsheet = $reader->load(FCPATH . '/assets/template_produksi.xls');
        } else {
            $spreadsheet = $reader->load(FCPATH . '/assets/template_1.xls');
        }

        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_PORTRAIT);
        $spreadsheet->getActiveSheet()->getPageSetup()
            ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
        $spreadsheet->getActiveSheet()->getPageSetup()->setFitToWidth(1);

        $spreadsheet->getActiveSheet()->getPageMargins()->setTop(1);
        $spreadsheet->getActiveSheet()->getPageMargins()->setRight(0.75);
        $spreadsheet->getActiveSheet()->getPageMargins()->setLeft(0.75);
        $spreadsheet->getActiveSheet()->getPageMargins()->setBottom(1);

        $worksheet = $spreadsheet->getActiveSheet();

        $setLogo = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $setLogo->setName('Logo');
        $setLogo->setDescription('Logo');
        $setLogo->setPath(FCPATH . '/assets/logo_pura.png');
        $setLogo->setOffsetX(60);
        $setLogo->setOffsetY(10);
        $setLogo->setHeight(46);
        $setLogo->setCoordinates('A1');
        $setLogo->setWorksheet($spreadsheet->getActiveSheet());

        $worksheet->setCellValue('B15', $ttd_dept['nama_terang']);
        $worksheet->setCellValue('E15', $ttd_efisiensi['nama_terang']);
        $worksheet->setCellValue('G15', $ttd_cc['nama_terang']);

        // ttd dept
        $setttddept = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $setttddept->setName('Logo');
        $setttddept->setDescription('Logo');
        $setttddept->setPath($ttd_gambar_dept);
        $setttddept->setOffsetX(40);
        $setttddept->setOffsetY(10);
        $setttddept->setHeight(56);
        $setttddept->setCoordinates('B12');
        $setttddept->setWorksheet($spreadsheet->getActiveSheet());

        // ttd efisiensi
        $setttdefisiensi = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $setttdefisiensi->setName('Logo');
        $setttdefisiensi->setDescription('Logo');
        $setttdefisiensi->setPath($ttd_gambar_efisiensi);
        $setttdefisiensi->setOffsetX(20);
        $setttdefisiensi->setOffsetY(10);
        $setttdefisiensi->setHeight(56);
        $setttdefisiensi->setCoordinates('E12');
        $setttdefisiensi->setWorksheet($spreadsheet->getActiveSheet());

        // ttd cc
        $setttdcc = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $setttdcc->setName('Logo');
        $setttdcc->setDescription('Logo');
        $setttdcc->setPath($ttd_gambar_cc);
        $setttdcc->setOffsetX(55);
        $setttdcc->setOffsetY(10);
        $setttdcc->setHeight(65);
        $setttdcc->setCoordinates('G12');
        $setttdcc->setWorksheet($spreadsheet->getActiveSheet());

        // ttd ppc
        if ($data['departemen'][0]['departemen'] == 'Produksi') {
            $setttdppc = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $setttdppc->setName('Logo');
            $setttdppc->setDescription('Logo');
            $setttdppc->setPath($ttd_gambar_ppc);
            $setttdppc->setOffsetX(30);
            $setttdppc->setOffsetY(10);
            $setttdppc->setHeight(65);
            $setttdppc->setCoordinates('C12');
            $setttdppc->setWorksheet($spreadsheet->getActiveSheet());
        }

        if ($data['form']['perpanjangan'] == 1) {
            $worksheet->setCellValue('A5', 'Perpanjangan Lembur');
        }

        if ($data['departemen'][0]['departemen'] == 'Produksi') {
            $worksheet->setCellValue('C15', $ttd_ppc['nama_terang']);
        }

        $row = 9;
        $no_urut = 1;

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
            ],
            'font' => [
                'bold' => true,
            ]
        ];
        $styletengah = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'font' => [
                'bold' => false,
            ]
        ];

        if (count($karyawan_eng) > 0) {

            $worksheet->insertNewRowBefore($row, 1);
            $spreadsheet->getActiveSheet()->mergeCells('A' . ($row - 1) . ':J' . ($row - 1));
            // $worksheet->getStyle('A' . ($row - 1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            $worksheet->getStyle('A' . ($row - 1))->applyFromArray($styleArray);
            $worksheet->setCellValue('A' . ($row - 1), 'KARYAWAN PURA');
            $worksheet->insertNewRowBefore(($row + 1), count($karyawan_eng));
            foreach ($karyawan_eng as $d) {
                $worksheet->setCellValue('A' . $row, $no_urut);
                $worksheet->setCellValue('B' . $row, $d['nama_user']);
                $worksheet->setCellValue('C' . $row, $d['bagian']);
                $worksheet->setCellValue('D' . $row, date("H:i", strtotime($d['jam_mulai'])));
                $worksheet->getStyle('D' . $row)->applyFromArray($styletengah);
                $worksheet->setCellValue('E' . $row, date("H:i", strtotime($d['jam_selesai'])));
                $worksheet->getStyle('E' . $row)->applyFromArray($styletengah);
                $worksheet->setCellValue('F' . $row, $d['no_order']);
                $spreadsheet->getActiveSheet()->mergeCells('F' . $row . ':G' . $row);
                $worksheet->setCellValue('H' . $row, $d['alasan']);
                $spreadsheet->getActiveSheet()->mergeCells('H' . $row . ':J' . $row);

                $row++;
                $no_urut++;
            }
        }

        if (count($karyawan_os) > 0) {

            if (count($karyawan_eng) == 0) {
                $row = $row;
            } else {
                $row = $row + 1;
            }
            $worksheet->insertNewRowBefore($row, 1);
            $spreadsheet->getActiveSheet()->mergeCells('A' . ($row - 1) . ':J' . ($row - 1));
            $worksheet->getStyle('A' . ($row - 1))->applyFromArray($styleArray);
            $worksheet->setCellValue('A' . ($row - 1), 'KARYAWAN OS');
            $worksheet->insertNewRowBefore(($row), count($karyawan_os));
            foreach ($karyawan_os as $d) {
                $worksheet->setCellValue('A' . $row, $no_urut);
                $worksheet->setCellValue('B' . $row, $d['nama_user']);
                $worksheet->setCellValue('C' . $row, $d['bagian']);
                $worksheet->setCellValue('D' . $row, date("H:i", strtotime($d['jam_mulai'])));
                $worksheet->getStyle('D' . $row)->applyFromArray($styletengah);
                $worksheet->setCellValue('E' . $row, date("H:i", strtotime($d['jam_selesai'])));
                $worksheet->getStyle('E' . $row)->applyFromArray($styletengah);
                $worksheet->setCellValue('F' . $row, $d['no_order']);
                $spreadsheet->getActiveSheet()->mergeCells('F' . $row . ':G' . $row);
                $worksheet->setCellValue('H' . $row, $d['alasan']);
                $spreadsheet->getActiveSheet()->mergeCells('H' . $row . ':J' . $row);

                $row++;
                $no_urut++;
            }
        }

        // $worksheet->insertNewRowBefore(9, count($bocah_lembur));
        //     foreach ($bocah_lembur as $d) {
        //         $worksheet->setCellValue('A' . $row, $no_urut);
        //         $worksheet->setCellValue('B' . $row, $d['nama_user']);
        //         $worksheet->setCellValue('C' . $row, $d['bagian']);
        //         $worksheet->setCellValue('D' . $row, $d['jam_mulai']);
        //         $worksheet->setCellValue('E' . $row, $d['jam_selesai']);
        //         $worksheet->setCellValue('F' . $row, $d['no_order']);
        //         $spreadsheet->getActiveSheet()->mergeCells('F' . $row . ':G' . $row);
        //         $worksheet->setCellValue('H' . $row, $d['alasan']);
        //         $spreadsheet->getActiveSheet()->mergeCells('H' . $row . ':J' . $row);

        //         $row++;
        //         $no_urut++;
        //     }

        $worksheet->setCellValue('C3', $tgl_lembur);

        $spreadsheet->getActiveSheet()->removeRow($row); // delete last row template
        $last =  $worksheet->getHighestRow();

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Dompdf');
        $writer->save(FCPATH . '/assets/hasil_pdf/Form_pengajuan_' . $idform . '.pdf');

        $data['path'] = base_url() . 'assets/hasil_pdf/Form_pengajuan_' . $idform . '.pdf';

        // $this->load->view('laporan_pdf', $data);
        redirect($data['path']);
    }

    // function print2()
    // {
    //     // require_once FCPATH . '/vendor/autoload.php';
    //     // $mpdf = new mPDF();
    //     // $mpdf->WriteHTML('<h1>Hello world!</h1>');
    //     // $mpdf->Output();
    //     $this->load->view('mpdf_print');
    // }

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
    }

    function tambah_hapus()
    {
        $iddetail = $this->input->post('iddetail');
        // $user_pic = $this->session->userdata('nik');

        $this->m_lembur->hapus_detail($iddetail);
    }
}
