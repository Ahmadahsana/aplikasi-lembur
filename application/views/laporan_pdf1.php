<!DOCTYPE html>
<html>


<head>
    <title>Form NO. <?php echo $title ?></title>
    <meta charset="utf-8">
    <style type="text/css">
        /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 10pt "Arial";
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

        table.ok {
            border: 0px
        }

        td.ok {
            border: 0px
        }

        tr.ok {
            border: 0px
        }

        tr.bod {
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
                        <td rowspan="3" colspan="2" style="width: 25%; height:27mm; text-align: center;">
                            <img width="20%" src="<?= base_url('assets/images/pura.png') ?>"><br>
                            <div class="kecil">PT. Purabarutama Div. eng</div>
                        </td>
                        <td rowspan="3" colspan="4" style="text-align: center;">SURAT PERINTAH LEMBUR <br> <?= date("d-M-Y", strtotime($form['tgl_lembur'])); ?></td>
                        <!-- <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td> -->
                        <td style="width: 25%;">
                            <table>
                                <tr class="ok">
                                    <td class="ok" style="width: 40%;">No.Form </td>
                                    <td class="ok">: FM-HR-08</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>

                        <!-- <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td> -->
                        <td>
                            <table>
                                <tr class="ok">
                                    <td class="ok" style="width: 40%;">Revisi </td>
                                    <td class="ok">: 1</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>

                        <!-- <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td> -->
                        <td>
                            <table>
                                <tr class="ok">
                                    <td class="ok" style="width: 40%;">Tanggal </td>
                                    <td class="ok">: 9 Sept 2019</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="text-align: center;">
                        <td colspan="7">/</td>
                        <!-- <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td> -->
                    </tr>
                    <tr style="text-align: center;">
                        <td rowspan="2" style="width: 5%;">NO</td>
                        <td rowspan="2">NAMA KARYAWAN</td>
                        <td rowspan="2">BAGIAN</td>
                        <td colspan="2">JAM LEMBUR</td>
                        <!-- <td>5</td> -->
                        <td rowspan="2">NO ORDER</td>
                        <td rowspan="2">KETERANGAN</td>
                    </tr>
                    <tr style="text-align: center;">
                        <!-- <td>1</td> -->
                        <!-- <td>2</td> -->
                        <!-- <td>3</td> -->
                        <td>MULAI</td>
                        <td>SELESAI</td>
                        <!-- <td>6</td> -->
                        <!-- <td>7</td> -->
                    </tr>
                    <?php $no = 1; ?>
                    <?php foreach ($detail as $d) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d['nama_user'] ?></td>
                            <td><?= $d['bagian'] ?></td>
                            <td><?= $d['jam_mulai'] ?></td>
                            <td><?= $d['jam_selesai'] ?></td>
                            <td><?= $d['no_order'] ?></td>
                            <td><?= $d['alasan'] ?></td>
                        </tr>
                    <?php endforeach ?>

                </table>
                <br>

                <table class="ok" style="margin-top: 40px; text-align: center; text-transform: capitalize;">
                    <tr>
                        <td>Hormat Kami</td>
                        <td>Mengetahui</td>
                        <td>Mengetahui</td>
                        <td>Menyetujui</td>
                        <td>Menyetujui</td>
                    </tr>
                    <tr>
                        <td>Kabag <?php echo $departemen['departemen'] ?></td>
                        <td>PPC</td>
                        <td>Efisiensi</td>
                        <td>Cost Control</td>
                        <td>General Manager</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                    </tr>
                    <tr>
                        <td><?= $form['dept'] ?></td>
                        <td><?= $form['ppc'] ?></td>
                        <td><?= $form['efisiensi'] ?></td>
                        <td><?= $form['cc'] ?></td>
                        <td><?= $form['manager'] ?></td>
                    </tr>
                </table>

            </div>

        </div>

    </div>

</body>

</html>