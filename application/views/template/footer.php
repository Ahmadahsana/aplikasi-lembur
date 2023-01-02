</div>
</div>
</div>
</div>
<div id="styleSelector"></div>
</div>
</div>
</div>
</div>

<?php $base_url = '<?= base_url()' ?>
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery/jquery.min.js "></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-ui/jquery-ui.min.js "></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/popper.js/popper.min.js"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/bootstrap/js/bootstrap.min.js "></script>
<!-- waves js -->
<script src="<?= base_url() ?>assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
<script src="<?= base_url() ?>assets/js/pcoded.min.js"></script>
<script src="<?= base_url() ?>assets/js/vertical/vertical-layout.min.js"></script>
<script src="<?= base_url() ?>assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/script.min.js"></script>

<script src="<?= base_url('assets/'); ?>datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url('assets/'); ?>datatables/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/js/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/js/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/js/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>datatables/js/buttons.html5.min.js"></script>

<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js?19112022"></script>
<script src="<?= base_url('assets/'); ?>js/custom/flat_picker.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.time').timepicker({
            showMeridian: false,
            showInputs: false,
            defaultTime: false
        });
    });
</script>

<?php if ($title == 'Edit user') {
    echo '<script src="' . base_url() . 'assets/js/custom/add_role.js"></script>';
} ?>

<?php if ($title == 'Aplikasi lembur') {
    echo '<script src="' . base_url() . 'assets/js/custom/dodol.js"></script>';
} ?>

<script>
    let selected = false;

    $('table').on('keyup', ' .carinama', function() {
        // console.log('typed');
        if (selected) {
            $('.hasilcarinama').html('')
            selected = false
        } else {
            const nama1 = $(this).val(); // gantinan cuy
            const nama = nama1.toUpperCase();
            if (nama.length >= 3) {
                $('.hasilcarinama').html('')
                // untuk membersihkan pencarian temp
                datapegawaitemp = []
                // console.log(nama)
                $.ajax({
                    type: "post",
                    url: "<?= base_url('user/get_nama') ?>",
                    data: {
                        carinama: nama
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);

                        $.each(response, function(i, v) {
                            datapegawaitemp.push({
                                id: v.id,
                                nama: v.Nm_Karyawan,
                                nik: v.NIK,
                                departemen: v.Kd_Bagian
                            })
                            // $('#tampilcarinama').append(`<a href="#" class="listcarinama" data-departemen="${v.Kd_Bagian}" data-statuskar="${v.Kd_Unit}" data-namapegawai="` + v.Nm_Karyawan + `" data-idpegawai="` + v.NIK + `">` + v.Nm_Karyawan + `  |  ` + v.NIK + `  |  ` + v.Kd_Bagian + `</a><br><hr>`)
                            $('.hasilcarinama').append(`<option value="` + v.Nm_Karyawan + `"  data-departemen="${v.Kd_Bagian}" data-statuskar="${v.Kd_Unit}"  data-namapegawai="` + v.Nm_Karyawan + `" data-idpegawai="` + v.NIK + `">  <a href="#" class="listcarinama">` + v.NIK + `  |  ` + v.Kd_Bagian + `</a> <br><hr>`)

                        });
                    }
                });
            }
        }
    })

    var peringatan = false

    $('table').on('change', ' .carinama', function() {
        // console.log('changed?');
        var shownVal = this.value;
        var sisipan = this.parentElement.parentElement.childNodes[1];

        // var idpegawai = document.querySelector(".hasilcarinama option[value='" + shownVal + "']").dataset.idpegawai;
        // var departemen = document.querySelector(".hasilcarinama option[value='" + shownVal + "']").dataset.departemen;
        var idpegawai = document.querySelector(`.hasilcarinama option[value="${shownVal}"]`).dataset.idpegawai;
        var departemen = document.querySelector(`.hasilcarinama option[value="${shownVal}"]`).dataset.departemen;
        var statuskar = document.querySelector(`.hasilcarinama option[value="${shownVal}"]`).dataset.statuskar;


        if (daftar_pegawai.includes(idpegawai)) {
            console.log('sudah ada');
            // this.parentElement.parentElement.childNodes[3].childNodes[1].focus()
            this.parentElement.parentElement.childNodes[3].childNodes[1].value = '';
            console.log(this.parentElement.parentElement.childNodes[3].childNodes[3].childNodes[0]);


            if (peringatan == true) {
                console.log('sudah ada peringatan');
            } else {
                this.parentElement.parentElement.childNodes[3].childNodes[3].insertAdjacentHTML('beforeend', '<p class="text-danger">Nama sudah ada</p>')
                peringatan = true
            }

        } else {
            console.log('belum ada');
            daftar_pegawai.push(idpegawai)
            this.parentElement.parentElement.childNodes[3].childNodes[3].innerHTML = ''

            $(sisipan).html('')

            isiSisipan = `<input type="text" class="form-control d-none" id="nik" name="nik[]" value="${idpegawai}" readonly>
            <input type="text" class="form-control" id="status_kar" name="status_kar[]" value="${statuskar}" hidden>
            <input type="text" class="form-control" id="departemen" name="departemen[]" value="${departemen}" hidden>`

            sisipan.insertAdjacentHTML('beforeend', isiSisipan)
        }


        console.log(daftar_pegawai);
    })

    $('[name="cari_v2"]').on('focus', function() {
        // console.log('focused?');
    })
</script>

<script>
    const cekJamMulai = function(jam_mulai, ) {
        jamStart = new Date()
        temp = jam_mulai.split(':');
        jamStart.setHours((parseInt(temp[0]) + 24) % 24);
        jamStart.setMinutes(parseInt(temp[1]));
        // console.log(jamStart);
        return jamStart

    }

    const cekJamSelesai = function(jam_selesai) {
        jamEnd = new Date()
        temp1 = jam_selesai.split(':');
        jamEnd.setHours((parseInt(temp1[0]) + 24) % 24);
        jamEnd.setMinutes(parseInt(temp1[1]));
        // console.log(jamEnd);
        return jamEnd
    }
</script>

<?php if (isset($tarif)) : ?>
    <script>
        let formId = <?= $form['id'] ?>;
    </script>
    <script src="<?= base_url() ?>assets/js/custom/jam_otomatis.js"></script>
    <script src="<?= base_url('assets/'); ?>js/custom/tolak_pengajuan.js"></script>
<?php endif ?>
<script>
    $('table').on('change', '[name="jam_selesai[]"]', function() {
        var jam_selesai = this.value
        var jam_mulai = this.parentElement.parentElement.childNodes[5].childNodes[0].value
        // console.log(jam_mulai);
        var jamStart = cekJamMulai(jam_mulai);
        var jamEnd = cekJamSelesai(jam_selesai);

        var selisih = jamEnd - jamStart;

        var wadah_peringatan_jam = this.parentElement.parentElement.childNodes[7].childNodes[3];

        if (selisih < 0) {
            // selisihTemp = selisih * -1;
            selisihTemp = selisih + 86400000;
            // console.log(selisihTemp);
            if (selisihTemp >= 28800000) { //28800000 = 8 jam
                wadah_peringatan_jam.insertAdjacentHTML('beforeend', '<p class="text-danger">Jam tidak valid</p>');
                $(this.parentElement.parentElement.childNodes[7].childNodes[1]).val('')
            } else {
                // console.log('ini pasti shift 2 yang lembur');
                $(wadah_peringatan_jam).html('')
            }
        }
        if (selisih > 0) {
            if (selisih > 28800000) {
                wadah_peringatan_jam.insertAdjacentHTML('beforeend', '<p class="text-danger">Jam tidak valid</p>');
                $(this.parentElement.parentElement.childNodes[7].childNodes[1]).val('')
            } else {
                $(wadah_peringatan_jam).html('')
            }
        }
    })

    $('table').on('change', '[name="jam_selesai1[]"]', function() {
        var jam_selesai = this.value
        var jam_mulai = this.parentElement.parentElement.childNodes[5].childNodes[0].value

        // console.log(jam_mulai);
        var jamStart = cekJamMulai(jam_mulai);
        var jamEnd = cekJamSelesai(jam_selesai);

        var selisih = jamEnd - jamStart;

        var wadah_peringatan_jam = this.parentElement.parentElement.childNodes[7].childNodes[2];
        if (selisih < 0) {
            // selisihTemp = selisih * -1;
            selisihTemp = selisih + 86400000;
            // console.log(selisihTemp);
            if (selisihTemp >= 28800000) { //28800000 = 8 jam
                wadah_peringatan_jam.insertAdjacentHTML('beforeend', '<p class="text-danger">Jam tidak valid</p>');
                // console.log(this.parentElement.parentElement.childNodes[7].childNodes[0]);
                $(this.parentElement.parentElement.childNodes[7].childNodes[0]).val('')
            } else {
                // console.log('ini pasti shift 2 yang lembur');
                $(wadah_peringatan_jam).html('')
            }
        }
        if (selisih > 0) {
            if (selisih > 28800000) {
                wadah_peringatan_jam.insertAdjacentHTML('beforeend', '<p class="text-danger">Jam tidak valid</p>');
                // $(this.parentElement.parentElement.childNodes[7].childNodes[1]).val('')
            } else {
                $(wadah_peringatan_jam).html('')
            }
        }
    })
</script>

<script>
    $('.form-check-input').on('click', function() {
        const menu_id = $(this).data('menu');
        const role_id = $(this).data('role');

        $.ajax({
            url: "<?= base_url('admin/gantiakses') ?>",
            type: 'post',
            data: {
                menu_id: menu_id,
                role_id: role_id
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + role_id;
            }
        });

    });
</script>


<script>
    let datapegawai = []
    let datapegawaitemp = []

    var tbody = document.querySelector("tbody")
    // let carinama1 = document.getElementById("carinama")

    // let nomorUrut = 1;
    // let tombolTambahBawah = 0



    tbody.addEventListener("click", function(event) {
        if (event.target.id == "btnhapus") {
            let ini = $(event.target)
            let idx = daftar_pegawai.findIndex((dp) =>
                dp == ini.data('id')
            );
            console.log(idx);
            daftar_pegawai.splice(idx, 1);
            event.target.parentElement.parentElement.remove();
        }

        if (event.target.id == "btnhapus1") {
            var konfir = confirm('Yakin hapus?');
            let ini = $(event.target)
            let idx = daftar_pegawai.findIndex((dp) =>
                dp == ini.data('id')
            );
            let iddetail = ini.data('id');
            // console.log(iddetail);
            daftar_pegawai.splice(idx, 1);

            if (konfir == true) {
                $.ajax({
                    type: "post",
                    url: `<?= base_url('form/tambah_hapus/') ?>`,
                    data: {
                        iddetail: iddetail
                    },
                    success: function(response) {
                        console.log(response);
                    }
                });

                event.target.parentElement.parentElement.remove();
            } else {
                console.log('gak jadi');
            }


        }

        if (event.target.id == "btncopy") {
            // jam mulai idex ke 5
            let jam_mulai = event.target.parentElement.parentElement.childNodes[5].childNodes[0].value;

            // jam selesai index ke 7
            let jam_selesai = event.target.parentElement.parentElement.childNodes[7].childNodes[1].value;

            // bagian index 9
            let bagian = event.target.parentElement.parentElement.childNodes[9].childNodes[0].value;

            // no_order index 11
            let no_order = event.target.parentElement.parentElement.childNodes[11].childNodes[0].value;

            // alasan index 13
            let alasan = event.target.parentElement.parentElement.childNodes[13].childNodes[0].value;


            var isi1 = `
                        <tr class="urut">
                            <td style="width: 20px;" class="angka">
                            </td>
                            <td>
                                <input type="text" class="form-control carinama" id="nama" name="nama[]" value="" list="hasilcarinama" autocomplete="off" required>
                                <div id="peringatan"></div>
                            </td>
                            <datalist id="hasilcarinama" class="hasilcarinama"></datalist>
                            <td><input type="text" class="form-control time" id="jam_mulai" name="jam_mulai[]" value="${jam_mulai}" required></td>
                            <td>
                                <input type="text" class="form-control time validasi_waktu" id="jam_selesai" name="jam_selesai[]" value="${jam_selesai}" required>
                                <div id="peringatan_jam"></div>
                            </td>
                            <td><input type="text" class="form-control" id="bagian" name="bagian[]" value="${bagian}" required placeholder="Bagian"></td>
                            <td><input type="text" class="form-control" id="no_order" name="no_order[]" value="${no_order}" placeholder="No order"></td>
                            <td><input type="text" class="form-control" id="alasan" name="alasan[]" value="${alasan}" required placeholder="Alasan"></td>
                            <td id="tombol_copy" style="text-align: center;">
                                <button type="button" class="btn btn-success btn-sm mr-1" id="btncopy" data-id="">copy</button>
                                <button type="button" class="btn btn-danger btn-sm mr-1" id="btnhapus" data-id=""><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`;

            $(tbody).append(isi1);

            $(function() {
                $('.time').timepicker({
                    showMeridian: false,
                    showInputs: true,
                    defaultTime: false
                });
            });

            let tabelbody1 = document.querySelector('tbody');
            tabelbody1.lastChild;
            // console.log(event.target.parentElement.parentElement.childElementCount);
            tabelbody1.lastChild.childNodes[3].childNodes[1].focus()
        }
    })

    $('#tambah_pegawai').on('click', function() {

        var isi = `<tr class="urut">
                            <td style="width: 20px;" class="angka">
                            </td>
                            <td>
                                <input type="text" class="form-control carinama" id="nama" name="nama[]" value="" list="hasilcarinama" autocomplete="off" required>
                                <div id="peringatan"></div>
                            </td>
                            <datalist id="hasilcarinama" class="hasilcarinama"></datalist>
                            <td><input type="text" class="form-control time" id="jam_mulai" name="jam_mulai[]" value="" required></td>
                            <td>
                                <input type="text" class="form-control time validasi_waktu" id="jam_selesai" name="jam_selesai[]" value="" required>
                                <div id="peringatan_jam"></div>
                            </td>
                            <td><input type="text" class="form-control" id="bagian" name="bagian[]" value="" required placeholder="Bagian"></td>
                            <td><input type="text" class="form-control" id="no_order" name="no_order[]" value="" placeholder="No order"></td>
                            <td><input type="text" class="form-control" id="alasan" name="alasan[]" value="" required placeholder="Alasan"></td>
                            <td id="tombol_copy" style="text-align: center;">
                                <button type="button" class="btn btn-success btn-sm mr-1" id="btncopy" data-id="">copy</button>
                                <button type="button" class="btn btn-danger btn-sm mr-1" id="btnhapus" data-id=""><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>`
        $(tbody).append(isi);

        $(function() {
            $('.time').timepicker({
                showMeridian: false,
                showInputs: true,
                defaultTime: false
            });
        });

        let tabelbody = document.querySelector('tbody');
        tabelbody.lastChild;
        // console.log(tabelbody.childNodes);
        tabelbody.lastChild.childNodes[3].childNodes[1].focus()
    })



    function cekdatapegawai(arr, id) {
        let tmp;
        for (let i = 0; i < arr.length; i++) {
            $.each(arr[i], function(i, v) {
                if (v.id == id) {
                    tmp = false
                } else {
                    tmp = true
                }
            });
        }
        return tmp;
    }
    $(document).ready(function() {

    });
</script>

</body>

</html>