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

    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url() ?>assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/themify-icons/themify-icons.css">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/feather/css/feather.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/jquery.mCustomScrollbar.css">

    <link href="<?= base_url('assets/'); ?>datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet" />

    <!-- <link href="<?= base_url('assets/'); ?>datatables/css/buttons.dataTables.min.css" rel="stylesheet"> -->

    <style type="text/css">
        /* tbody .number {
            counter-reset: rowNumber;
        }

        tbody tr .urut {
            counter-increment: rowNumber;
        }

        tbody tr td:first-child::before {
            content: counter(rowNumber);
            min-width: 1em;
            margin-right: 0.5em;
        } */

        .number tr:not(.fble_htr) {
            counter-increment: rowNumber;
        }

        .number tr:not(.fble_htr) td:first-child::before {
            content: counter(rowNumber);
            min-width: 1em;
            margin-right: 0.5em;
        }
    </style>

    <style>
        .klik {
            cursor: pointer;
        }

        /* tambahan */
        /* .table.table-sm td,
        .table.table-sm th {
            padding: 0.6rem 0.5rem;
        } */
    </style>

    <style>
        .page td {
            padding: 0;
            margin: 0;
        }
    </style>

</head>

<body>
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