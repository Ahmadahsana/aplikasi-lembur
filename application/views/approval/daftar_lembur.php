<div class="page-body">
    <?= $this->session->flashdata('message') ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama pembuat</th>
                            <th>Peserta lembur</th>
                            <th>Jam</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($lembur as $l) : ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $l['tgl_lembur'] ?></td>
                                <td><?= $l['pembuat'] ?></td>
                                <td>
                                    <?php

                                    foreach ($peserta as $p) {
                                        if ($p['id'] == $l['id']) {
                                            echo $p['peserta'];
                                            echo '</br>';
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php

                                    foreach ($peserta as $p) {
                                        if ($p['id'] == $l['id']) {
                                            echo $p['jam_mulai'];
                                            echo ' - ';
                                            echo $p['jam_selesai'];
                                            echo '</br>';
                                        }
                                    } ?>
                                </td>
                                <td><span class="badge badge-pill badge-<?= $l['warna'] ?>"><?= $l['nama_status'] ?></span></td>
                                <td>
                                    <a href="<?= base_url('form/print/') . $l['id'] . '/4' ?>" title="lihat detail"><button class="btn btn-sm btn-secondary"><i class="fa fa-print"></i></button></a>
                                    <a href="<?= base_url('hr/approve/') . $l['id'] ?>" title="lihat detail"><button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button></a>
                                    <a href="<?= base_url('hr/detail/') . $l['id'] ?>" title="lihat detail"><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i>Detail</button></a>
                                </td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>