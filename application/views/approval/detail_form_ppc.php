<div class="page-body">
    <!-- <?php var_dump($detail) ?> -->

    <form action="<?= base_url('approval_ppc/approve/') . $form['id'] ?>" method="POST" class="">
        <div class="card">
            <div class="card-body">
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
                            <th scope="col" style="width: 6%;">Jam mulai</th>
                            <th scope="col" style="width: 6%;">Jam selesai</th>
                            <th scope="col" style="width: 100px;">NIK</th>
                            <th scope="col" style="width: 100px;">No order</th>
                            <th scope="col" style="width: 60px;">Durasi</th>
                            <th scope="col" style="width: 100px;">Bagian</th>
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
                                <td>
                                    <input type="hidden" id="id_detail" class="form-control" value="<?= $d['id'] ?>" readonly>
                                    <input type="text" name="nama[]" class="form-control" value="<?= $d['nama_user'] ?>" readonly>
                                </td>
                                <td><input type="text" class="form-control jam_custom time" id="jam_mulai" name="jam_mulai[]" value="<?= $d['jam_mulai'] ?>" required></td>
                                <td>
                                    <input type="text" class="form-control jam_custom time" id="jam_selesai" name="jam_selesai[]" value="<?= $d['jam_selesai'] ?>" required>
                                    <div id="peringatan"></div>
                                </td>
                                <td><input type="text" name="nik[]" class="form-control" value="<?= $d['nik'] ?>" readonly></td>
                                <td><input type="text" name="no_order[]" class="form-control" value="<?= $d['no_order'] ?>"></td>
                                <td><input type="text" class="form-control" id="durasi" name="durasi" value="<?= $d['durasi'] + 0 ?> j" readonly></td>
                                <td><input type="text" class="form-control" id="bagian" name="bagian[]" value="<?= $d['bagian'] ?>"></td>
                                <td>
                                    <!-- <input type="text" class="form-control" id="alasan" name="alasan[]" value="<?= $d['alasan'] ?>"> -->
                                    <textarea id="alasan" name="alasan[]" class="form-control" cols="30" rows="1"><?= $d['alasan'] ?></textarea>
                                </td>
                                <td>
                                    <input type="hidden" id="id_detail" class="form-control" value="<?= $d['id'] ?>" readonly>
                                    <?php if ($this->session->userdata['role_id'][0] == '7') {
                                        echo '';
                                    } elseif ($this->session->userdata['role_id'] == '2') {
                                        echo '';
                                    } else {
                                        echo '<button type="button" class="btn btn-danger btn-sm" id="tolak">Tolak</button>';
                                    } ?>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <div class="row justify-content-end">
                    <div class="form-group mr-4" id="wadah_submit">
                        <h6>Asumsi biaya lembur *</h6>
                        <h5 id="total_tarif_lembur">Rp. <?= number_format($tarif['total_harga'] + 0, 0, ',', '.')  ?></h5>
                    </div>
                </div>

                <div class="row justify-content-end">
                    <div class="form-group" id="wadah_submit">

                        <?php if ($this->session->userdata['role_id'][0] == '7') {
                            echo '<button type="submit" class="btn btn-primary mr-3">Tandai telah diinput</button>';
                        } elseif ($this->session->userdata['role_id'] == '2') {
                            echo '';
                        } else {
                            echo '<button type="submit" id="submit" class="btn btn-primary mr-3">Approve</button>';
                        } ?>


                    </div>
                </div>

                <div class="row justify-content-start">
                    <div class="form-group ml-2" id="wadah_submit">
                        <h6>* Dengan asumsi tarif lembur per jam Rp. 13.500</h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="daftar_tolak" id="list_tolak">

        </div>
    </form>
</div>

<script>
    let dataDetail = <?= json_encode($detail) ?>
</script>
<!-- <script src="<?= base_url('assets/'); ?>js/custom/tolak_pengajuan.js"></script> -->