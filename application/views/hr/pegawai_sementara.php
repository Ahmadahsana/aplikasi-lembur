<div class="page-body">
    <div class="card">
        <?= $this->session->flashdata('message') ?>
        <div class="card-body">

            <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Tambah pegawai</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Bagian</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Status</th>
                        <th scope="col">Opsi</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($pegawai as $key => $p) : ?>
                        <tr>
                            <th scope="row"><?= $no ?></th>
                            <td><?= $p['Nm_Karyawan'] ?></td>
                            <td><?= $p['NIK']  ?></td>
                            <td><?= $p['Kd_Bagian']  ?></td>
                            <td><?= $p['Kd_Unit']  ?></td>
                            <td><?= $p['status']  ?></td>
                            <td></td>
                        </tr>
                    <?php $no++;
                    endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('hr/tambah_pegawai'); ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nama" placeholder="Nama karyawan" value="" style="text-transform:uppercase">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Bagian</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" name="bagian">
                                <?php foreach ($departemen as $key => $d) : ?>
                                    <option value="<?= $d['departemen'] ?>"><?= $d['departemen'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Unit</label>
                        <div class="col-sm-10">
                            <select class="form-control" aria-label="Default select example" name="unit">
                                <option value="OSS_KPRS">Karyawan OS</option>
                                <option value="ENG">Karyawan Pura</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>