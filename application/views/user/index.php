<div class="page-body">
    <?= $this->session->flashdata('message') ?>
    <div class="card">

        <div class="card-block">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="tanggal">Tanggal lembur</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= set_value('tanggal') ?>" required>
                        <small class="text-danger"><?= form_error('tanggal') ?></small>
                    </div>
                    <div class="form-group col-md-6  align-self-end">
                        <div class="form-check">
                            <input type="checkbox" id="perpanjangan" name="perpanjangan" value="1">
                            <label for="perpanjangan"> Perpanjangan? </label>
                        </div>
                    </div>
                </div>



                <div class="row justify-content-between">
                    <div class="form-group col-md-4">
                        <h5>Daftar pegawai ikut lemburan</h5>
                    </div>

                </div>

                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 20px;">No</th>
                            <th scope="col">Nama</th>
                            <!-- <th scope="col">NIK</th> -->
                            <th scope="col" style="width: 10%;">Jam mulai</th>
                            <th scope="col" style="width: 10%;">Jam selesai</th>
                            <th scope="col" style="width: 10%;">Bagian</th>
                            <th scope="col" style="width: 10%;">No Order</th>
                            <th scope="col">Alasan</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="number">

                        <small class="text-danger"><?= form_error('nik[]') ?></small>
                        <!-- <div class="alert alert-danger" role="alert">
                            <?= form_error('nik[]') ?>
                        </div> -->
                    </tbody>

                </table>
                <div class="row justify-content-end align-item-center mr-1" id="tombol_bawah">
                    <div class="form-group col-md-4 ">
                        <div class="row justify-content-end">
                            <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-tag"></i>Tambah pegawai</button>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end align-item-center">
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary mr-3">Kirim pengajuan</button>
                    </div>
                </div>
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