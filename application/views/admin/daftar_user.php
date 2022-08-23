<div class="page-body">
    <?= $this->session->flashdata('message') ?>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                // var_dump($daftar_user);

                                foreach ($daftar_user as $l) : ?>

                                    <tr>
                                        <td></td>
                                        <td><?= $l['name'] ?></td>
                                        <td><?= $l['username'] ?></td>
                                        <td class="text-center"><a href=" <?= base_url('admin/edit_user/') . $l['nik'] ?>" title="lihat detail"><button class="btn btn-sm btn-info"><i class="fa fa-eye"></i>Detail</button></a></td>
                                    </tr>
                                <?php endforeach ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>