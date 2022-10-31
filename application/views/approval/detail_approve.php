<div class="page-body">
    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('form/approve/') . $form['id'] ?>" method="POST" class="form-material">
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal" value="<?= $form['tgl_lembur'] ?>" readonly>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="alasan" class="col-sm-2 col-form-label">alasan</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="alasan" name="alasan" cols="2" rows="2" readonly> <?= $form['alasan'] ?> </textarea>
                    </div>
                </div> -->

                <!-- <div class="row justify-content-end mr-4">
                    <a href="<?= base_url('form/print/') . $data[0] . '/' . $data[1] ?>" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                </div> -->
                <h4>Daftar pegawai</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIK</th>
                            <th scope="col">No order</th>
                            <th scope="col" style="width: 140px;">Jam mulai</th>
                            <th scope="col" style="width: 140px;">Jam selesai</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">Alasan</th>
                            <!-- <th scope="col">Opsi</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($detail as $d) :
                        ?>
                            <tr>

                                <th scope="row"><?= $no++ ?></th>
                                <td><?= $d['nama_user'] ?></td>
                                <td><?= $d['nik'] ?></td>
                                <td><?= $d['no_order'] ?></td>
                                <td><?= $d['jam_mulai'] ?></td>
                                <td><?= $d['jam_selesai'] ?></td>
                                <td><?= $d['bagian'] ?></td>
                                <td><?= $d['alasan'] ?></td>
                                <!-- <td></td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <?php if ($this->session->userdata['role_id'] !== '8') : ?>

                    <h4>Daftar Perubahan</h4>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td scope="col">No</td>
                                <th scope="col">Nama</th>
                                <th scope="col">NIK</th>
                                <th scope="col">No order</th>
                                <th scope="col" style="width: 140px;">Jam mulai</th>
                                <th scope="col" style="width: 140px;">Jam selesai</th>
                                <th scope="col">Bagian</th>
                                <th scope="col">Jenis Perubahan</th>
                                <th scope="col">Alasan tolak</th>
                                <!-- <th scope="col">Opsi</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($tolak as $t) :
                            ?>
                                <tr>
                                    <td scope="row"><?= $no++ ?></td>
                                    <td><?= $t['nama_user'] ?></td>
                                    <td><?= $t['nik'] ?></td>
                                    <td><?= $t['no_order'] ?></td>
                                    <td><?= $t['jam_mulai'] ?></td>
                                    <td><?= $t['jam_selesai'] ?></td>
                                    <td><?= $t['bagian'] ?></td>
                                    <td><span class="badge badge-pill <?php if ($t['jenis_log'] == 1) {
                                                                            echo 'badge-success';
                                                                        } else {
                                                                            echo 'badge-danger';
                                                                        } ?> "><?= $t['nama_log'] ?></span></td>
                                    <td><?= $t['keterangan'] ?></td>
                                    <!-- <td></td> -->
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                <?php endif ?>
                <div class="row justify-content-end">
                    <div class="form-group">




                    </div>
                </div>

            </form>
        </div>
    </div>
</div>