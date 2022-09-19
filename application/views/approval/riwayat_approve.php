<div class="page-body">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>ID form</th> -->
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th style="width: 400px;">Peserta lembur</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        foreach ($lembur as $l) : ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <!-- <td><?= $l['id'] ?></td> -->
                                <td><?= date('d-m-Y', strtotime($l['tgl_lembur'])) ?></td>
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
                                <td><span class="badge badge-pill badge-<?= $l['warna'] ?>"><?= $l['nama_status'] ?></span></td>
                                <td><a href="<?= base_url('approval_1/detail_approve/') . $l['id'] . '/' . $l['status'] ?>" title="lihat detail"><button class="btn btn-info"><i class="fa fa-eye"></i>Detail</button></a></td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>