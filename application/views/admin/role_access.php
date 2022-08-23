<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->



    <h1>Menu management</h1>

    <?= validation_errors(); ?>

    <?= $this->session->flashdata('message'); ?>

    <h5>Role : <?= $role['role'] ?></h5>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Menu</th>
                <th scope="col">Access</th>

            </tr>
        </thead>
        <tbody>
            <?php $no = 1; ?>
            <?php foreach ($menu as $r) : ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $r['menu'] ?></td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" <?= check_access($role['id'], $r['id']); ?> data-role="<?= $role['id'] ?>" data-menu="<?= $r['id'] ?>">
                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->