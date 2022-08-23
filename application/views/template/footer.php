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

<script src="<?= base_url('assets/'); ?>js/demo/datatables-demo.js"></script>


<script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>

<?php if ($title == 'Edit user') {
    echo '<script src="' . base_url() . 'assets/js/custom/add_role.js"></script>';
} ?>

<?php if ($title == 'Aplikasi lembur') {
    echo '<script src="' . base_url() . 'assets/js/custom/dodol.js"></script>';
} ?>


<script>
    $(document).ready(function() {
        console.log('ready');
    });
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
                            nik: v.NIK
                        })
                        $('#tampilcarinama').append(`<a href="#" class="listcarinama" data-namapegawai="` + v.Nm_Karyawan + `" data-idpegawai="` + v.NIK + `">` + v.Nm_Karyawan + `</a><br><hr>`)


                    });
                }
            });
        }

    });

    const tbody = document.querySelector("tbody")
    const carinama1 = document.getElementById("carinama")


    $('#tampilcarinama').on('click', '.listcarinama', function(event) {
        let idpegawai = $(this).data('idpegawai')
        let namapegawai = $(this).data('namapegawai')

        console.log(idpegawai)
        console.log(namapegawai)

        isi = `<tr>
                            <td></td>
                            <td><input type="text" class="form-control" id="nama" name="nama[]" value="${namapegawai}" readonly></td>
                            <td><input type="text" class="form-control" id="nik" name="nik[]" value="${idpegawai}" readonly></td>
                            <td><input type="text" class="form-control" id="bagian" name="bagian[]" value=""></td>
                            <td><button type="button" class="btn btn-danger btn-sm mr-3" id="btnhapus"><i class="fa fa-trash"></i> Hapus</button></td>
                            </tr>`
        $(tbody).append(isi);
        event.preventDefault();

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



    })

    tbody.addEventListener("click", function(event) {
        if (event.target.id == "btnhapus") {
            event.target.parentElement.parentElement.remove();
        }
    })

    tbody.addEventListener("click", function(event) {
        if (event.target.id == "tolak") {

            var keterangan = prompt("ALASAN Tolak karyawan ini?");
            console.log(keterangan);
            var ok = event.target.parentElement.parentElement;
            var iya = ok.querySelector('input');
            var isinama = iya.getAttribute('value');
            console.log(isinama);

            var idform = `<?= $form['id'] ?>`;


            console.log(idform);

            $.ajax({
                type: "post",
                url: `<?= base_url('form/tambah_tolak/') ?>`,
                data: {
                    nama: isinama,
                    idform: idform,
                    keterangan: keterangan
                },
                success: function(response) {
                    console.log(response);
                    event.target.parentElement.parentElement.remove();
                }
            });
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
<!--  -->
</body>

</html>