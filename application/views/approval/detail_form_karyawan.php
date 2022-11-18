<div class="page-body">
    <div class="card">
        <div class="card-body">
            <?= $this->session->flashdata('message') ?>
            <form action="<?= base_url('user/edit_form/') . $form['id'] ?>" method="POST" class="form-material">
                <div class="form-group row">
                    <label for="tanggal" class="col-sm-2 col-form-label">Status :</label>
                    <div class="col-sm-10">
                        <a href="#" class="badge badge-<?= $form['warna'] ?>"><?= $form['nama_status'] ?></a>
                    </div>
                    <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="tanggal" value="<?= $form['tgl_lembur'] ?>" readonly>
                    </div>
                </div>

                <?php if ($form['perpanjangan'] == 1) : ?>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-info">
                                Perpanjangan
                            </button>
                        </div>
                    </div>
                <?php endif ?>

                <?php if ($form['status'] >= 4) : ?>
                    <div class="row justify-content-end mr-4">
                        <a href="<?= base_url('form/print/') . $form['id'] . '/' . $form['status'] ?>" class="btn btn-success"><i class="fa fa-print"></i> Print</a>
                    </div>
                <?php endif ?>
                <h4>Daftar pegawai</h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama</th>
                            <!-- <th scope="col">NIK</th> -->
                            <th scope="col" style="width: 140px;">Jam mulai</th>
                            <th scope="col" style="width: 140px;">Jam selesai</th>
                            <th scope="col">Bagian</th>
                            <th scope="col">NO Order</th>
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
                                <td class="page"><input type="text" name="nama1[]" class="form-control" value="<?= $d['nama_user'] ?>" readonly></td>
                                <!-- <td class="page"><input type="text" name="nik[]" class="form-control" value="<?= $d['nik'] ?>" readonly></td> -->
                                <td class="page"><input type="time" class="form-control" id="jam_mulai" name="jam_mulai1[]" value="<?= $d['jam_mulai'] ?>"></td>
                                <td class="page"><input type="time" class="form-control" id="jam_selesai" name="jam_selesai1[]" value="<?= $d['jam_selesai'] ?>"></td>
                                <td class="page"><input type="text" class="form-control" id="bagian" name="bagian1[]" value="<?= $d['bagian'] ?>"></td>
                                <td class="page"><input type="text" name="no_order1[]" class="form-control" value="<?= $d['no_order'] ?>"></td>
                                <td class="page"><input type="text" class="form-control" id="alasan" name="alasan1[]" value="<?= $d['alasan'] ?>"></td>
                                <!-- <td></td> -->
                            </tr>
                        <?php endforeach ?>

                        <?php if ($form['status'] == 0) : ?>
                            <tr>
                                <th scope="row" colspan="8">PEGAWAI TAMBAHAN</th>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

                <?php if ($form['status'] == 0) : ?>
                    <div class="row justify-content-end mb-3">
                        <button type="button" class="btn btn-sm btn-success mr-3" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-tag"></i>Tambah pegawai</button>
                    </div>
                <?php endif ?>

                <?php if ($form['status'] != 0) : ?>

                    <h4>Daftar Perubahan</h4>
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
                                    <td><input type="text" name="" class="form-control" value="<?= $t['nama_user'] ?>" readonly></td>
                                    <td><input type="text" name="" class="form-control" value="<?= $t['nik'] ?>" readonly></td>
                                    <td><input type="text" name="" class="form-control" value="<?= $d['bagian'] ?>"></td>
                                    <td><input type="time" class="form-control" id="jam_mulai" name="" value="<?= $t['jam_mulai'] ?>"></td>
                                    <td><input type="time" class="form-control" id="jam_selesai" name="" value="<?= $t['jam_selesai'] ?>"></td>
                                    <td><input type="text" name="" class="form-control" value="<?= $t['keterangan'] ?>" readonly></td>
                                    <!-- <td></td> -->
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endif ?>

                <!-- cuma untuk mengirim ke belakang / alat bantu saja -->
                <input type="text" name="status_form" class="d-none" value="<?= $form['status'] ?>">
                <!-- akhirrrr -->

                <?php if ($form['status'] == 0) : ?>
                    <div class="row justify-content-end">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary mr-3">Simpan perubahan</button>
                        </div>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah pegawai lemburan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Cari nama pegawai</label>
                        <input type="text" class="form-control" id="carinama" name="carinama" placeholder="cari">
                    </div>
                </form>
                <div id="tampilcarinama">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    var d = new Date();
    d.setDate(d.getDate() - 3);
    console.log(d.toISOString().slice(0, 10));

    let inputTanggal = document.querySelector('#tanggal');
    let waktu = new Date();
    let tgl = waktu.getDate();
    tanggal.setAttribute("min", d.toISOString().slice(0, 10));
</script>

<!-- menonaktifkan tombol enter -->
<script type="text/javascript">
    window.addEventListener('keydown', function(e) {
        if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
            if (e.target.nodeName === 'INPUT' && e.target.type !== 'textarea') {
                e.preventDefault();
                return false;
            }
        }
    }, true);
</script>