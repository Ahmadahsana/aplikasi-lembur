<!DOCTYPE html>
<html>

<head>
    <title>Form <?= $pdf['judul_keluhan']; ?></title>
    <meta charset="utf-8">
    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt "Times New Roman";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .page {
            width: 210mm;
            min-height: 297mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            border-radius: 5px;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .subpage {
            /* mengatur isi dengan border */
            padding: 0cm;
            border: 1px black solid;
            height: 277mm;
            padding-left: none;
            padding-right: 0mm;
        }

        .kecil {
            font-size: 8pt;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
        }

        th.ok {
            border: 0px
        }

        td.ok {
            border: 0px
        }

        tr.ok {
            border: 0px
        }


        @page {
            size: A4;
            margin: 0;
        }

        @media print {

            html,
            body {
                width: 210mm;
                height: 297mm;
            }

            .page {
                margin: 0;
                border: initial;
                border-radius: initial;
                width: initial;
                min-height: initial;
                box-shadow: initial;
                background: initial;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>

    <div class="book">
        <div class="page">
            <div class="subpage">
                <table>
                    <tr>
                        <th style="width: 38mm; height:27mm"><img width="50%" src="<?= base_url('assets/img/pura.png') ?>"><br>
                            <div class="kecil">PT. Purabarutama Div. eng</div>
                        </th>
                        <th colspan="5">
                            <h3>PERMINTAAN PERUBAHAN DATA <br> APLIKASI SIMPG-DE</h3>
                            <div class="kecil">FM-IT-06/Rev-0/29-11-2021</div>
                        </th>
                    </tr>

                    <tr>
                        <td colspan="6" style=" height: 25mm;" valign="top">JENIS PERMINTAAN : <br> <br>
                            <table>
                                <tr>
                                    <td class="ok" width="7%"></td>
                                    <td class="ok"><input type="checkbox" id="vehicle1" name="vehicle1" checked> PENAMBAHAN USER</td>
                                    <td class="ok"><input type="checkbox" id="vehicle1" name="vehicle1"> PERUBAHAN HAK AKSES USER</td>
                                </tr>
                                <tr>
                                    <td class="ok"></td>
                                    <td class="ok"><input type="checkbox" id="vehicle1" name="vehicle1"> PERUBAHAN DATA TRANSAKSI</td>
                                    <td class="ok"><input type="checkbox" id="vehicle1" name="vehicle1"> PERUBAHAN MASTER DATA</td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td class="ok" colspan="6">ALASAN/TUJUAN PERUBAHAN</td>
                    </tr>
                    <tr>
                        <td colspan="6" rowspan="2" style="height: 40mm;">a <br>
                            <?= $pdf['judul_keluhan'] ?>
                        </td>
                    </tr>
                    <tr>

                    </tr>


                    <tr>
                        <td class="ok" colspan="6">URAIAN PERUBAHAN</td>
                    </tr>
                    <tr>
                        <td colspan="6" style="height: 40mm;">b <br>
                            <?= $pdf['deskripsi_keluhan'] ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3">CATATAN :</td>
                        <td colspan="2">Tanggal : <?= date('d F Y', $pdf['tgl_keluhan']); ?></td>
                    </tr>

                    <tr>
                        <td colspan="3" rowspan="4">c</td>
                        <td style="width: 20mm;">Diajukan Oleh:</td>
                        <td style="width: 20mm;">Disetujui Oleh:</td>

                    </tr>
                    <tr>

                        <td class="ok" style="height: 20mm;">d</td>
                        <td class="ok">e</td>
                    </tr>
                    <tr>

                        <td class="ok" style="text-align: center;"><?= $pdf['nama_pengadu'] ?></td>
                        <td class="ok">(.........................)</td>

                    </tr>
                    <tr>

                        <td>User</td>
                        <td>Kabag ......</td>
                    </tr>
                    <tr>
                        <td colspan="3">TINDAK LANJUT SISTEM ANALYS</td>
                        <td colspan="2">Tanggal : <?= date('d F Y', $pdf['tgl_selesai']); ?></td>
                    </tr>

                    <tr>
                        <td colspan="3" rowspan="4">f</td>
                        <td>Menindaklanjuti:</td>
                        <td>Menyetujui:</td>

                    </tr>
                    <tr>

                        <td class="ok" style="height: 20mm;">g</td>
                        <td class="ok">h</td>
                    </tr>
                    <tr>

                        <td class="ok"><?= $pdf['petugas'] ?></td>
                        <td class="ok">(.........................)</td>

                    </tr>
                    <tr>

                        <td>Operator</td>
                        <td>Kabid EDP</td>
                    </tr>
                    <tr>
                        <td colspan="2">VERIFIKASI:</td>
                        <td style="width: 20mm;">User</td>
                        <td colspan="2">Tanggal : <?= date('d F Y', $pdf['tgl_complete']); ?></td>
                    </tr>

                    <tr>
                        <td colspan="2" rowspan="3"><?= $pdf['verifikasi'] ?></td>
                        <td class="ok" style="height: 20mm;">j</td>
                        <td class="ok">k</td>
                        <td class="ok">l</td>
                    </tr>
                    <tr>

                        <td class="ok"><?= $pdf['nama_pengadu'] ?></td>
                        <td class="ok">(.........................)</td>
                        <td class="ok">(.........................)</td>

                    </tr>
                    <tr>

                        <td>Bag...</td>
                        <td>Kabag ......</td>
                        <td>Kabag EDP</td>
                    </tr>


                    <!-- tr dengan td sebanyak 5 -->
                    <!-- <tr>
                    <td>a</td>
                    <td>a</td>
                    <td>a</td>
                    <td>a</td>
                    <td>a</td>
                </tr> -->
                </table>
            </div>
        </div>

    </div>

</body>

</html>