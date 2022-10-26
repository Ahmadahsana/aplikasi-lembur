<div class="page-body">
    <?= $this->session->flashdata('message') ?>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Departemen</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($data_role as $l) : ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $l['nik'] ?></td>
                                <td><?= $l['name'] ?></td>
                                <td><?= $l['username'] ?></td>
                                <td><?= $l['departemen'] ?></td>
                                <td><?= $l['alias'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter<?= $l['nik'] ?>">
                                        ttd
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- <?php var_dump($data_ttd) ?> -->

<?php foreach ($data_role as $d) : ?>
    <div class="modal fade" id="exampleModalCenter<?= $d['nik'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tanda tangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url() ?>admin/simpan_ttd" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $d['username'] ?>" readonly>
                        </div>
                        <div class="form-group d-none">
                            <label for="exampleInputEmail1">NIK</label>
                            <input type="text" name="nik" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $d['nik'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <div class="card" style="width: 18rem;">
                                <?php foreach ($data_ttd as $t) : ?>
                                    <!-- <img class="card-img-top" src="<?= base_url() ?>/assets/images/ttd/<?php if ($t['nik'] == $d['nik']) {
                                                                                                                echo $t['ttd'];
                                                                                                            } ?>"> -->
                                    <?php if ($t['nik'] == $d['nik']) : ?>
                                        <img class="card-img-top" src="<?= base_url() ?>/assets/images/ttd/<?= $t['ttd'] ?>">
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Foto Tanda Tangan</label>
                            <input type="file" name="gambar" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> -->
            </div>
        </div>
    </div>
<?php endforeach ?>