<!-- Begin Page Content -->
<div class="container-fluid">

    <?php var_dump($user) ?>

    <div class="container mt-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <div class="text-center"> <img src="<?= base_url('assets/images/profile/logo_pura.png') ?>" width="100" class="rounded-circle"> </div>
                    <div class="text-center mt-3">
                        <!-- <span class="bg-secondary p-1 px-4 rounded text-white"><?= $user['role'] ?></span> -->
                        <h5 class="mt-2 mb-0"><?= $user['nama'] ?></h5> <span></span>
                        <div class="px-4 mt-1">

                            <div class="row">
                                <div class="col-lg-6" style="text-align: right;">
                                    <p>NIK : </p>
                                    <p>Departemen :</p>

                                </div>
                                <div class="col-lg-6" style="text-align: left;">
                                    <p><?= $user['nik'] ?> </p>

                                    <p></p>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="buttons"> <button class="btn btn-outline-primary px-4">Message</button> <button class="btn btn-primary px-4 ms-3">Contact</button> </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>






</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->