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
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <!-- <?php var_dump($lembur_departemen) ?> -->

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($lembur_departemen as $l) : ?>

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
                                <td><span class="badge badge-pill badge-danger"><?= $l['nama_status'] ?></span></td>
                                <td><a href="<?= base_url('approval_1/detail/') . $l['id'] ?>" title="lihat detail"><button class="btn btn-info"><i class="fa fa-eye"></i></button></a></td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>