<div class="page-body">
    <!-- <?php var_dump($form) ?> -->

    <div class="card">
        <div class="card-body">
            <form action="<?= base_url('approval_ppc/approve/') . $form['id'] ?>" method="POST" class="form-material">
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal" value="<?= $form['tgl_lembur'] ?>" readonly>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="alasan" class="col-sm-2 col-form-label">Alasan</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="alasan" name="alasan" cols="2" rows="2" readonly> <?= $form['alasan'] ?> </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alasan" class="col-sm-2 col-form-label">NO Order</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="no_order" name="no_order" cols="2" rows="2" readonly> <?= $form['no_order'] ?> </textarea>
                    </div>
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
                            <th scope="col">Opsi</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        ?>
                        <?php foreach ($detail as $d) :
                        ?>
                            <tr>

                                <th scope="row"><?= $no++ ?></th>
                                <td><input type="text" name="nama[]" class="form-control" value="<?= $d['nama_user'] ?>" readonly></td>
                                <td><input type="text" name="nik[]" class="form-control" value="<?= $d['nik'] ?>" readonly></td>
                                <td><input type="text" name="no_order[]" class="form-control" value="<?= $d['no_order'] ?>"></td>
                                <td><input type="time" class="form-control" id="jam_mulai" name="jam_mulai[]" value="<?= $d['jam_mulai'] ?>"></td>
                                <td><input type="time" class="form-control" id="jam_selesai" name="jam_selesai[]" value="<?= $d['jam_selesai'] ?>"></td>
                                <td><input type="text" class="form-control" id="bagian" name="bagian[]" value="<?= $d['bagian'] ?>"></td>
                                <td><input type="text" class="form-control" id="alasan" name="alasan[]" value="<?= $d['alasan'] ?>"></td>
                                <td>
                                    <?php if ($this->session->userdata['role_id'][0] == '7') {
                                        echo '';
                                    } elseif ($this->session->userdata['role_id'] == '2') {
                                        echo '';
                                    } else {
                                        echo '<button type="button" class="btn btn-danger btn-sm ml-4" id="tolak">Tolak</button>';
                                    } ?>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                <div class="row justify-content-end">
                    <div class="form-group">

                        <?php if ($this->session->userdata['role_id'][0] == '7') {
                            echo '<button type="submit" class="btn btn-primary mr-3">Tandai telah diinput</button>';
                        } elseif ($this->session->userdata['role_id'] == '2') {
                            echo '';
                        } else {
                            echo '<button type="submit" class="btn btn-primary mr-3">Approve</button>';
                        } ?>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>