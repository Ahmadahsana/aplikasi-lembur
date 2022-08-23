<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->


    <!-- <h1>edit profile</h1> -->
    <?= $this->session->flashdata('message'); ?>

    <div class="container mt-2">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <div class="text-center"> <img src="<?= base_url('assets/images/profile/logo_pura.png') ?>" width="100" class="rounded-circle"> </div>
                    <div class="text-center mt-3">
                        <!-- <span class="bg-secondary p-1 px-4 rounded text-white"><?= $user['role'] ?></span> -->
                        <h5 class="mt-2 mb-0"><?= $user['username'] ?></h5> <span></span>

                        <?php echo form_open_multipart('user/editprofile/') ?>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-4 col-form-label text-right">NIK :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="id" name="id" value="<?= $user['nik'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fullname" class="col-sm-4 col-form-label text-right">Nama lengkap :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['nama'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="foto" class="col-sm-4 col-form-label text-right">Foto :</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="foto" name="foto">
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