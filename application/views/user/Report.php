<div class="row justify-content-center">
    <div class="col-lg">

        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-1 d-flex justify-content-end">
                            Tgl Mulai :
                        </div>
                        <div class="col-2">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?= set_value('tgl_mulai') ?>">
                        </div>
                        <div class="col-1 d-flex justify-content-end">
                            Tgl Akhir :
                        </div>
                        <div class="col-2">
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= set_value('tgl_akhir') ?>">
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Peserta lembur</th>
                                <th>NIK</th>
                                <th>Departemen</th>
                                <th>Jam mulai</th>
                                <th>Jam selesai</th>
                                <th>Status</th>
                                <th>Status Karyawan</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($lembur as $l) : ?>

                                <?php foreach ($peserta as $p) : ?>
                                    <?php if ($p['id'] == $l['id']) : ?>


                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= date("d-M-Y", strtotime($l['tgl_lembur'])) ?></td>
                                            <td><?= $p['peserta'] ?></td>
                                            <td><?= $p['nik'] ?></td>
                                            <td><?= $p['departemen'] ?></td>
                                            <td><?= $p['jam_mulai'] ?></td>
                                            <td><?= $p['jam_selesai'] ?></td>

                                            <td><span class="badge badge-pill badge-<?= $l['warna'] ?>"><?= $l['nama_status'] ?></span></td>
                                            <td><?= $p['status_kar'] ?></td>
                                            <!-- <td><a href="#" title="lihat detail"><button class="btn btn-info"><i class="fa fa-eye"></i></button></a></td> -->
                                        </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php endforeach ?>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>