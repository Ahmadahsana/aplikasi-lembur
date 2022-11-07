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

                <?php if ($form['perpanjangan'] == 1) : ?>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-success">
                                Perpanjangan
                            </button>
                        </div>
                    </div>
                <?php endif ?>
                <h4>Daftar pegawai</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col">NIK</th>
                            <th scope="col">NO Order</th>
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
                                <td class="page"><input type="text" name="nama[]" class="form-control" value="<?= $d['nama_user'] ?>" readonly></td>
                                <td class="page"><input type="text" name="nik[]" class="form-control" value="<?= $d['nik'] ?>" readonly></td>
                                <td class="page"><input type="text" name="bagian[]" class="form-control" value="<?= $d['no_order'] ?>" readonly></td>
                                <td class="page"><input type="time" class="form-control" id="jam_mulai" name="jam_mulai[]" value="<?= $d['jam_mulai'] ?>"></td>
                                <td class="page"><input type="time" class="form-control" id="jam_selesai" name="jam_selesai[]" value="<?= $d['jam_selesai'] ?>"></td>
                                <td class="page"><input type="text" class="form-control" id="bagian" name="bagian[]" value="<?= $d['bagian'] ?>"></td>
                                <td class="page"><input type="text" class="form-control" id="alasan" name="alasan[]" value="<?= $d['alasan'] ?>"></td>
                                <!-- <td></td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <h4>Daftar yang ditolak</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td scope="col">No</td>
                            <th scope="col">Nama</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Bagian</th>
                            <th scope="col" style="width: 140px;">Jam mulai</th>
                            <th scope="col" style="width: 140px;">Jam selesai</th>
                            <th scope="col">Alasan tolak</th>
                            <!-- <th scope="col">Opsi</th> -->

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($karyawan_tolak as $t) :
                        ?>
                            <tr>
                                <td scope="row"></td>
                                <td><input type="text" name="nama[]" class="form-control" value="<?= $t['nama_user'] ?>" readonly></td>
                                <td><input type="text" name="nik[]" class="form-control" value="<?= $t['nik'] ?>" readonly></td>
                                <td><input type="text" name="bagian[]" class="form-control" value="<?= $d['bagian'] ?>" readonly></td>
                                <td><input type="time" class="form-control" id="jam_mulai" name="jam_mulai[]" value="<?= $t['jam_mulai'] ?>"></td>
                                <td><input type="time" class="form-control" id="jam_selesai" name="jam_selesai[]" value="<?= $t['jam_selesai'] ?>"></td>
                                <td><input type="text" name="nama[]" class="form-control" value="<?= $t['keterangan'] ?>" readonly></td>
                                <!-- <td></td> -->
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="row justify-content-end">
                    <div class="form-group">




                    </div>
                </div>
            </form>
        </div>
    </div>
</div>