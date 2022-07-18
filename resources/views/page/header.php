        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <!-- ============================================================== -->

            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar" data-navbarbg="skin6">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header" data-logobg="skin6">
                        <!-- ============================================================== -->
                        <!-- Logo -->
                        <!-- ============================================================== -->
                        <a class="navbar-brand" href="index.php">
                            <!-- Logo icon -->
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="<?= $url; ?>public/favicon.ico" style="width: 50px;" alt="homepage" class="dark-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text" style="font-weight: bold; font-size: 23px">
                                <!-- dark Logo text -->
                                <!-- <img src="public/assets/images/logo-text.png" alt="homepage" class="dark-logo" /> -->
                                Voucher
                            </span>
                        </a>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <!-- This is for the sidebar toggle which is visible on mobile only -->
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        <!-- ============================================================== -->
                        <!-- toggle and nav items -->
                        <!-- ============================================================== -->
                        <ul class="navbar-nav float-start me-auto">
                            <!-- ============================================================== -->
                            <!-- Search -->
                            <!-- ============================================================== -->

                        </ul>
                        <!-- ============================================================== -->
                        <!-- Right side toggle and nav items -->
                        <!-- ============================================================== -->
                        <div><?= $result1['Nama']; ?></div>
                        <ul class="navbar-nav float-end">
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php if (isset($result1['Foto'])) { ?>
                                        <center><img src="<?= $url; ?>public/img/User/<?= $result1['Foto']; ?>" alt="user" class="rounded-circle" width="31" height="31">
                                        </center>
                                    <?php } else { ?>
                                        <center><img src="<?= $url; ?>public/img/User/1.jpg" alt="user" class="rounded-circle" width="31" height="31">
                                        </center>
                                    <?php } ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php?id=<?= $result1['Kode_petugas']; ?>"><i class="ti-user m-r-5 m-l-5"></i>
                                        My Profile</a>
                                    <a class="dropdown-item" href=""><i class="ti-wallet m-r-5 m-l-5"></i>
                                        My Balance</a>
                                    <a class="dropdown-item" href=""><i class="ti-email m-r-5 m-l-5"></i>
                                        Inbox</a>
                                    <a class="dropdown-item" href="<?= $url; ?>logout.php"><i class="m-r-10 mdi mdi-exit-to-app"></i>
                                        Logout</a>
                                </ul>
                            </li>
                            <!-- ============================================================== -->
                            <!-- User profile and search -->
                            <!-- ============================================================== -->
                        </ul>
                    </div>
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->