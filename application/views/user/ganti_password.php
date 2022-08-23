<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- <h1>edit profile</h1> -->
    <?= $this->session->flashdata('message'); ?>

    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <!-- <div class="text-center"> <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" width="100" class="rounded-circle"> </div> -->
                    <div class="text-center mt-3">

                        <!-- <h5 class="mt-2 mb-0"><?= $user['name'] ?></h5> -->

                        <form action="<?= base_url('user/ganti_password') ?>" method="POST">
                            <div class="form-group row">
                                <label for="fullname" class="col-sm-4 col-form-label">Password lama :</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password_lama" name="password_lama">
                                    <small class="text-danger"><?= form_error('password_lama') ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fullname" class="col-sm-4 col-form-label">Password baru :</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password_baru1" name="password_baru1">
                                    <small class="text-danger"><?= form_error('password_baru1') ?></small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-sm-4 col-form-label">Ulangi password baru :</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password_baru2" name="password_baru2">
                                    <small class="text-danger"><?= form_error('password_baru2') ?></small>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary">simpan</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->