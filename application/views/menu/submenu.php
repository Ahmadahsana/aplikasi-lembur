<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="card">
        <div class="card-body">


            <h1>Submenu Management</h1>

            <?= validation_errors(); ?>

            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add new sub menu</a>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">title</th>
                        <th scope="col">menu</th>
                        <th scope="col">url</th>
                        <th scope="col">icon</th>
                        <th scope="col">active</th>
                        <th scope="col">action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($submenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $sm['title'] ?></td>
                            <td><?= $sm['menu'] ?></td>
                            <td><?= $sm['url'] ?></td>
                            <td><?= $sm['icon'] ?></td>
                            <td><?= $sm['is_active'] ?></td>
                            <td>
                                <a href="<?= base_url('admin/editsub/') ?><?= $sm['id'] ?>" class="btn btn-info btn-sm mb-3">Edit</a>
                                <a href="<?= base_url('admin/hapussub/') . $sm['id'] ?>"><button type="button" class="btn btn-danger btn-sm mb-3" onclick="javascript: return confirm('anda yakin hapus?')">Hapus</button></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Nama sub menu">
                    </div>
                    <!-- ini pilih dimasukin ke menu yang mana -->
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id'] ?>"> <?= $m['menu'] ?> </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <!-- url nya apa? -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL nya">
                    </div>
                    <!-- iconnya apa? -->
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="ICON nya">
                    </div>
                    <!-- aktif atau tidak? -->
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" value="1" name="is_active" id="is_active" checked>
                                </div>
                            </div>
                            <input type="text" class="form-control" for="is_active" aria-label="Text input with checkbox" value="Aktif" readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Logout Modal-->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Yakin Hapus?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Anda akan menghapus sub menu</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url('admin/hapussub/') ?><?= $sm['id'] ?>">Hapus</a>
            </div>
        </div>
    </div>
</div>