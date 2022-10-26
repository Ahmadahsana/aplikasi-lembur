<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title ?></title>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->

    <link rel="icon" href="<?= base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/style.css">
</head>

<body themebg-pattern="theme1">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <section class="login-block">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <form class="md-float-material form-material" method="POST" action="<?= base_url('auth/registration') ?>">
                        <div class="text-center">
                            <!-- <img src="assets/images/logo.png" alt="logo.png"> -->
                        </div>
                        <div class="auth-box card">
                            <div class="card-block">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-center txt-primary">Daftar</h3>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="id" id="id" class="form-control" value="<?= set_value('id') ?>">
                                    <span class="form-bar"></span>
                                    <label class="float-label">NIK karyawan</label>
                                    <small class="text-danger"><?= form_error('id') ?></small>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="name" id="name" class="form-control" value="<?= set_value('name') ?>">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Nama Lengkap</label>
                                    <small class="text-danger"><?= form_error('name') ?></small>
                                </div>
                                <div id="tampilcari" class="form-group form-primary position-relative">
                                    <ul class="list-group position-absolute" id="tampilhasil" style="z-index: 9999; top: 0; width: 100%;">
                                        <!-- <li class="list-group-item">An item</li> -->
                                    </ul>
                                </div>
                                <div class="form-group form-primary">
                                    <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username') ?>">
                                    <span class="form-bar"></span>
                                    <label class="float-label">Username</label>
                                    <small class="text-danger"><?= form_error('username') ?></small>
                                </div>
                                <div class="form-group form-primary">
                                    <!-- <select name="departemen" id="departemen" class="form-control" required>
                                        <option selected disabled>Pilih departemen</option>
                                        <?php foreach ($departemen as $dp) : ?>
                                            <option value="<?= $dp['departemen'] ?>"><?= $dp['departemen'] ?></option>
                                        <?php endforeach ?>
                                    </select> -->
                                    <input type="text" name="departemen" id="departemen" class="form-control" value="<?= set_value('departemen') ?>" placeholder="Departemen" readonly>
                                    <small class="text-danger"><?= form_error('departemen') ?></small>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" id="password1" name="password1" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Password</label>
                                        </div>
                                        <small class="text-danger"><?= form_error('password1') ?></small>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-primary">
                                            <input type="password" id="password2" name="password2" class="form-control">
                                            <span class="form-bar"></span>
                                            <label class="float-label">Confirm Password</label>
                                            <small class="text-danger"><?= form_error('password2') ?></small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Daftar</button>
                                    </div>
                                </div>
                                <hr />

                            </div>
                        </div>
                    </form>
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        </div>
        <!-- end of container-fluid -->
    </section>
    <!-- Warning Section Starts -->


    <!-- Warning Section Ends -->
    <!-- Required Jquery -->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="<?= base_url(); ?>assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= base_url(); ?>assets/js/common-pages.js"></script>

    <script>
        var base_url = '<?php echo base_url(); ?>';
    </script>

    <script>
        $('#id').on('keyup', function() {
            let keyword = $(this).val();
            if (keyword.length >= 3) {
                console.log(keyword);
            }
            $.ajax({
                type: "post",
                url: base_url + "auth/cari_nik",
                data: {
                    keyword: keyword
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    if (response.length > 0) {
                        // console.log('data ada');
                        $('#name').val(response[0].NM);

                    }

                }
            });
        });

        $('#tampilcari').addClass('d-none');

        $('#name').on('keyup', function() {
            let nama = $(this).val().toUpperCase();
            if (nama.length >= 3) {
                // console.log(kata);

                $.ajax({
                    type: "post",
                    url: base_url + "auth/cari_nama",
                    data: {
                        nama: nama
                    },
                    dataType: "json",
                    success: function(response) {
                        // console.log(response);

                        if (response.length > 0) {
                            // console.log('data ada');
                            $('#tampilcari').removeClass('d-none');
                            $('#tampilhasil').html('');
                            $.each(response, function(i, v) {
                                $('#tampilhasil').append(`<a href="#" class="list-group-item" onclick="masukkan('${v.Nm_Karyawan}', '${v.NIK}', '${v.Kd_Bagian}')">${v.Nm_Karyawan   } |  ${v.NIK}  </a>`);
                            });

                        }

                    }
                });
            } else if (nama == '') {
                $('#tampilhasil').html('');
            }


        })

        function masukkan(nama, nik, departemen) {
            $('#tampilhasil').html('');
            $('#id').val(nik);
            $('#name').val(nama);
            $('#departemen').val(departemen);
        }
    </script>
</body>

</html>