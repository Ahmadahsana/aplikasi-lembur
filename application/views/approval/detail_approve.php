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
                                <td><input type="text" name="nama[]" class="form-control" value="<?= $d['nama_user'] ?>" readonly></td>
                                <td><input type="text" name="nik[]" class="form-control" value="<?= $d['nik'] ?>" readonly></td>
                                <td><input type="text" name="no_order[]" class="form-control" value="<?= $d['no_order'] ?>" readonly></td>
                                <td><input type="time" class="form-control" id="jam_mulai" name="jam_mulai[]" value="<?= $d['jam_mulai'] ?>" readonly></td>
                                <td><input type="time" class="form-control" id="jam_selesai" name="jam_selesai[]" value="<?= $d['jam_selesai'] ?>" readonly></td>
                                <td><input type="text" class="form-control" id="bagian" name="bagian[]" value="<?= $d['bagian'] ?>" readonly></td>
                                <td><input type="text" class="form-control" id="alasan" name="alasan[]" value="<?= $d['alasan'] ?>" readonly></td>
                                <!-- <td></td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <?php if ($this->session->userdata['role_id'] !== '8') : ?>

                    <h4>Daftar yang anda tolak</h4>
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
                                    <td><input type="text" name="nama[]" class="form-control" value="<?= $t['nama_user'] ?>" readonly></td>
                                    <td><input type="text" name="nik[]" class="form-control" value="<?= $t['nik'] ?>" readonly></td>
                                    <td><input type="text" name="no_order[]" class="form-control" value="<?= $t['no_order'] ?>"></td>
                                    <td><input type="time" class="form-control" id="jam_mulai" name="jam_mulai[]" value="<?= $t['jam_mulai'] ?>" readonly></td>
                                    <td><input type="time" class="form-control" id="jam_selesai" name="jam_selesai[]" value="<?= $t['jam_selesai'] ?>" readonly></td>
                                    <td><input type="text" name="bagian[]" class="form-control" value="<?= $d['bagian'] ?>" readonly></td>
                                    <td><input type="text" name="nama[]" class="form-control" value="<?= $t['keterangan'] ?>" readonly></td>
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