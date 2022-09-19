<div class="page-body">
    <?= $this->session->flashdata('message') ?>
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-body">
                    <form action="<?= base_url('admin/update_user/') . $useredit['username'] ?>" method="POST">

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">UserName</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" value="<?= $useredit['username'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $useredit['name'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik" name="nik" value="<?= $useredit['nik'] ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Departemen</label>
                            <!-- <div class="col-sm-5">
                                <button type="button" class="btn btn-success">
                                    <?php echo $useredit['departemen'] ?> <span class="badge badge-light">X</span>
                                </button>
                            </div> -->
                            <!-- <?php var_dump($useredit) ?> -->
                            <div class="col-sm-10">
                                <select name="departemen" id="departemen" class="custom-select">
                                    <?php foreach ($departemen as $d) : ?>
                                        <option value="<?= $d['departemen'] ?>" <?php if ($d['departemen'] == $useredit['departemen']) {
                                                                                    echo 'selected';
                                                                                } ?>><?= $d['departemen'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-9">
                                <?php //var_dump($useredit_role);
                                foreach ($useredit_role as $u) : ?>
                                    <!-- <button type="button" class="btn btn-sm btn-primary mb-1">
                                        <?php echo $u['role'] ?> <span id="hapus" class="badge badge-light klik hapus">X</span>
                                    </button> -->
                                    <div class="btn-group mb-1" role="group" aria-label="Basic example">

                                        <button type="button" class="btn btn-sm btn-secondary"><?php echo $u['alias'] ?></button>
                                        <button type="button" id="hapus<?php echo $u['id']  ?>" class="btn btn-sm btn-dark " onclick="remove(<?php echo $u['id']  ?>)">X</button>
                                    </div>
                                <?php endforeach ?>
                            </div>

                            <div class="col-sm-1">
                                <button type="button" id="addrole" class="btn btn-sm btn-primary mb-1 ">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="role" hidden>
                            <div class="form-group row ">
                                <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <select name="role" id="role" class="custom-select">
                                        <option disabled selected> tambah role</option>
                                        <?php foreach ($role as $r) : ?>
                                            <option value="<?= $r['id'] ?>" <?php if ($r['id'] == $useredit['role_id']) {
                                                                                echo '';
                                                                            } ?>><?= $r['alias'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <a class="btn btn-sm btn-success mb-3 text-light tombol">Tambah</a>
                                </div>
                            </div> -->
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Aktif?</label>
                            <div class="col-sm-10">
                                <select name="aktif" id="aktif" class="custom-select">
                                    <option value="1" <?php if ($useredit['is_active'] == '1') {
                                                            echo 'selected';
                                                        } ?>>aktif</option>
                                    <option value="0" <?php if ($useredit['is_active'] == '0') {
                                                            echo 'selected';
                                                        } ?>>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>