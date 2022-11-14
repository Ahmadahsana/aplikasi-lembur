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

<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>
<script src="<?= base_url('assets/'); ?>js/custom/flat_picker.js"></script>


<?php if ($title == 'Edit user') {
    echo '<script src="' . base_url() . 'assets/js/custom/add_role.js"></script>';
} ?>

<?php if ($title == 'Aplikasi lembur') {
    echo '<script src="' . base_url() . 'assets/js/custom/dodol.js"></script>';
} ?>




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

    $('#carinama').on('keyup', function() {
        console.log('hhhh');
        const nama1 = $(this).val(); // gantinan cuy
        const nama = nama1.toUpperCase();
        if (nama.length >= 3) {
            $('#tampilcarinama').html('')
            // untuk membersihkan pencarian temp
            datapegawaitemp = []
            console.log(nama)
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
                        $('#tampilcarinama').append(`<a href="#" class="listcarinama" data-departemen="${v.Kd_Bagian}" data-statuskar="${v.Kd_Unit}" data-namapegawai="` + v.Nm_Karyawan + `" data-idpegawai="` + v.NIK + `">` + v.Nm_Karyawan + `  |  ` + v.NIK + `  |  ` + v.Kd_Bagian + `</a><br><hr>`)


                    });
                }
            });
        }

    });

    var tbody = document.querySelector("tbody")
    let carinama1 = document.getElementById("carinama")

    let nomorUrut = 1;

    $('#tampilcarinama').on('click', '.listcarinama', function(event) {
        let idpegawai = $(this).data('idpegawai')
        let namapegawai = $(this).data('namapegawai')
        let departemen_pegawai = $(this).data('departemen')
        let unit = $(this).data('statuskar')

        console.log(idpegawai)
        console.log(namapegawai)
        // ${nomorUrut}
        isi = `<tr class="urut">
                <td style="width: 20px;" class="angka"></td> 
                <td><input type="text" class="form-control" id="nama" name="nama[]" value="${namapegawai}" readonly> <input type="text" class="form-control d-none" id="nik" name="nik[]" value="${idpegawai}" readonly></td>
                
                <td><input type="time" class="form-control jam_custom" id="jam_mulai" name="jam_mulai[]" value="" required></td>
                <td><input type="time" class="form-control jam_custom" id="jam_selesai" name="jam_selesai[]" value="" required></td>
                <td><input type="text" class="form-control" id="bagian" name="bagian[]" value="" required placeholder="Bagian"></td>
                <td><input type="text" class="form-control" id="no_order" name="no_order[]" value="" placeholder="No order"></td>
                <td><input type="text" class="form-control" id="alasan" name="alasan[]" value="" required placeholder="Alasan"></td>
                <td><button type="button" class="btn btn-danger btn-sm mr-3" id="btnhapus"><i class="fa fa-trash" required></i></button>
                <input type="text" class="form-control" id="status_kar" name="status_kar[]" value="${unit}" hidden>
                <input type="text" class="form-control" id="departemen" name="departemen[]" value="${departemen_pegawai}" hidden>
                </td>
                </tr> `
        $(tbody).append(isi);
        event.preventDefault();
        nomorUrut++

        $('#exampleModal').modal('hide');
        $('#tampilcarinama').html('')
        carinama1.value = ''

        // return t(document)

        // event.preventDefault();
        if (datapegawai.length <= 0) {
            $.each(datapegawaitemp, function(i, v) {
                if (v.id == idpegawai) {
                    datapegawai.push(datapegawaitemp[i])
                }
            });
        } else {
            if (cekdatapegawai(datapegawai, idpegawai) == true) {

            } else {
                $.each(datapegawaitemp, function(i, v) {
                    if (v.id == idpegawai) {
                        datapegawai.push(datapegawaitemp[i])
                    }
                });
            }
        }

        flatpickr(".jam_custom", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        $('.jam_custom').removeAttr('readonly')

    })

    tbody.addEventListener("click", function(event) {
        if (event.target.id == "btnhapus") {
            event.target.parentElement.parentElement.remove();
        }
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
</script>

</body>

</html>