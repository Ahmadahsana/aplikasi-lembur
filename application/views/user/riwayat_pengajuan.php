<div class="page-body">
    <div class="card">
        <!-- <?php var_dump($lembur) ?> -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID form</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <!-- <th style="width: 400px;">Alasan</th> -->
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $no = 1;
                        // var_dump($lembur);
                        foreach ($lembur as $l) : ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $l['id'] ?></td>
                                <td><?= date('d-m-Y', strtotime($l['tgl_lembur'])) ?></td>
                                <td><?= $l['pembuat'] ?></td>
                                <!-- <td><?= $l['alasan'] ?></td> -->
                                <td><span class="badge badge-pill badge-<?= $l['warna'] ?>"><?= $l['nama_status'] ?></span></td>
                                <td><a href="<?= base_url('form/detail_pengajuan/') . $l['id'] . '/' . $l['status'] ?>" title="lihat detail"><button class="btn btn-info"><i class="fa fa-eye"></i>Detail</button></a></td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>