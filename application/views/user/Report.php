<div class="row justify-content-center">
    <div class="col-lg">

        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                    <div class="row d-flex align-items-center mb-4">
                        <div class="col-1 d-flex justify-content-end">
                            Tgl Mulai :
                        </div>
                        <div class="col-2">
                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?= set_value('tgl_mulai') ?>">
                        </div>
                        <div class="col-1 d-flex justify-content-end">
                            Tgl Akhir :
                        </div>
                        <div class="col-2">
                            <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" value="<?= set_value('tgl_akhir') ?>">
                        </div>
                        <div class="col-1 d-flex justify-content-end">
                            Departemen
                        </div>
                        <div class="col-2">
                            <select class="form-control" name="departemen">
                                <option disabled selected>Pilih departemen</option>
                                <?php foreach ($departemen as $d) : ?>
                                    <option value="<?= $d['departemen'] ?>" <?php if (set_value('departemen') == $d['departemen']) {
                                                                                echo 'selected';
                                                                            } ?>><?= $d['departemen'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Peserta lembur</th>
                                <th>NIK</th>
                                <th>Departemen</th>
                                <th>Jam mulai</th>
                                <th>Jam selesai</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Status Karyawan</th>
                            </tr>
                        </thead>


                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($lembur as $l) : ?>
                                <?php
                                $time1 = strtotime($l['jam_mulai']);
                                $time2 = strtotime($l['jam_selesai']);
                                $difference = round(abs($time2 - $time1) / 3600, 2);
                                ?>

                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date("d-M-Y", strtotime($l['tgl_lembur'])) ?></td>
                                    <td><?= $l['nama_user'] ?></td>
                                    <td><?= $l['nik'] ?></td>
                                    <td><?= $l['departemen'] ?></td>
                                    <td><?= $l['jam_mulai'] ?></td>
                                    <td><?= $l['jam_selesai'] ?></td>
                                    <td><?= $difference ?></td>

                                    <td><span class="badge badge-pill badge-<?= $l['warna'] ?>"><?= $l['nama_status'] ?></span></td>
                                    <td><?= $l['status_kar'] ?></td>
                                </tr>

                            <?php endforeach ?>


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>