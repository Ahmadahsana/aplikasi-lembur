<!-- side bar -->

<div class="pcoded-main-container">

    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
            <div class="pcoded-inner-navbar main-menu">
                <div class="">
                    <div class="main-menu-header">

                        <img class="img-80 img-radius" src="<?= base_url('assets/images/profile/logo_pura.png') ?>" alt="User-Profile-Image">
                        <div class="user-details">
                            <span id="more-details"><?= $user['username'] ?><i class="fa fa-caret-down"></i></span>
                        </div>
                    </div>
                    <div class="main-menu-content">
                        <ul>
                            <li class="more-details">
                                <a href=""><i class="ti-user"></i>View Profile</a>
                                <a href=""><i class="ti-arrow-right"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- cara menaruh aktif <li class="pcoded-hasmenu active pcoded-trigger"> -->
                <!-- cara menaruh aktive di  <li class="active"> -->

                <!-- Query menu -->

                <?php foreach ($menu as $m) : ?>
                    <!-- <?php var_dump($menu) ?> -->

                    <div class="pcoded-navigation-label"><?php echo $m['menu'] ?></div>
                    <ul class="pcoded-item pcoded-left-item">

                        <!-- Query sub menu sesuai user -->


                        <!-- <?php var_dump($menu) ?> -->
                        <?php
                        $menuid = $m['menu_id'];
                        $querysubmenu = "SELECT *
                            FROM `user_sub_menu`
                            WHERE `menu_id` = $menuid
                            AND `is_active` = 1
                            ";
                        $submenu = $this->db->query($querysubmenu)->result_array();
                        ?>

                        <?php foreach ($submenu as $sm) : ?>

                            <?php if ($sm['title'] == $title) : ?>
                                <li class="active">
                                <?php else : ?>
                                <li class="">
                                <?php endif ?>
                                <a href="<?= base_url($sm['url']) ?>" class="waves-effect waves-dark">
                                    <span class="pcoded-micon"><i class="<?= $sm['icon'] ?>"></i><b></b></span>
                                    <span class="pcoded-mtext"><?= $sm['title'] ?></span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                </li>

                            <?php endforeach ?>

                    </ul>

                <?php endforeach ?>

                <div class="pcoded-navigation-label">User</div>
                <ul class="pcoded-item pcoded-left-item">


                    <!-- <li class="active"> -->
                    <li class="<?php  ?>">
                        <a href="<?= base_url('user/ganti_password') ?>" class="waves-effect waves-dark">
                            <span class="pcoded-micon"><i class="ti-key"></i><b></b></span>
                            <span class="pcoded-mtext">Ganti password</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                </ul>

            </div>
        </nav>
        <div class="pcoded-content">
            <!-- Page-header start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="page-header-title">
                                <h5 class="m-b-10"><?= $title ?></h5>
                                <p class="m-b-0">Aplikasi pengajuan lembur</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href=""> <i class="fa fa-home"></i> </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""><?= $title ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-header end -->

            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">