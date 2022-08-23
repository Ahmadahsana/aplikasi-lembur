<div class="container-fluid">

    <div class="row col-lg">
        <div class="card">
            <div class="card-body">

                <?php $no = 1; ?>
                <?php foreach ($get_byid as $sm) : ?>
                    <form action="<?php echo base_url() . 'menu/edit_submenu/' . $sm->id; ?>" method="POST">
                        <div class="body">
                            <div class="form-group">
                                <label class="" style="text-align: right">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="<?= $sm->title ?>" placeholder="Nama sub menu">
                            </div>
                            <!-- ini pilih dimasukin ke menu yang mana -->
                            <div class="form-group">
                                <label class="" style="text-align: right">Menu</label>
                                <select name="menu_id" id="menu_id" class="form-control">
                                    <option value="">select Menu</option>
                                    <?php foreach ($menu_pilihan as $m) : ?>
                                        <option value="<?= $m['id'] ?>" <?php if ($m['id'] == $sm->menu_id)
                                                                            echo 'selected'; ?>> <?= $m['menu'] ?> </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <!-- url nya apa? -->
                            <div class="form-group">
                                <label class="" style="text-align: right">URL</label>
                                <input type="text" class="form-control" id="url" name="url" value="<?= $sm->url ?>" placeholder="URL nya">
                            </div>
                            <!-- iconnya apa? -->
                            <div class="form-group">
                                <label class="" style="text-align: right">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon" value="<?= $sm->icon ?>" placeholder="ICON nya">
                            </div>
                            <!-- aktif atau tidak? -->
                            <div class="form-group">
                                <label class="" style="text-align: right">Aktif?</label>
                                <select name="aktif" id="aktif" class="form-control">
                                    <option value="1" <?php if ($sm->is_active == 1) {
                                                            echo 'selected';
                                                        } ?>>Aktif</option>
                                    <option value="0" <?php if ($sm->is_active == 0) {
                                                            echo 'selected';
                                                        } ?>>Tidak aktif</option>

                                </select>
                            </div>

                        </div>
                        <div class="form-group">
                            <a href="<?= base_url('menu/submenu') ?>" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



</div>