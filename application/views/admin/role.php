<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->



    <h1>Role management</h1>

    <?= validation_errors(); ?>

    <?= $this->session->flashdata('message'); ?>
    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add new role</a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($role as $r) : ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $r['role'] ?></td>
                    <td>
                        <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>"><button type="button" class="btn btn-warning btn-sm">Access</button></a>
                        <!-- <a href=""><button type="button" class="btn btn-info btn-sm">Edit</button></a>
                        <a href=""><button type="button" class="btn btn-danger btn-sm">Hapus</button></a> -->
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/addrole'); ?>" method="POST">
                <div class="modal-body">
                    <input type="text" class="form-control" id="role" name="role" placeholder="Nama role">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>