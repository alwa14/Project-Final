<!DOCTYPE html>
<html dir="ltr" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ $title }} · {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="Project Web, Project Kecil-Kecilan, Lhokseumawe, Politeknik, Politeknik Negeri Lhokseumawe">
    <meta name="description" content="Aplikasi Penjualan Baju">
    <meta name="robots" content="noindex,nofollow">
    <!-- Favicon icon -->
    <link rel="icon" type="image/ico" sizes="32x32" href="{{ url('/') }}/js.png">
    <!-- Custom CSS -->
    <link href="{{ url('/') }}/assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css"
        rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ url('/') }}/css/style.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/css/styleCard.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a341d667ca.js" crossorigin="anonymous"></script>

    <style>
        ::-webkit-scrollbar {
            height: 6px;
            width: 6px;
            border: 1px solid #d5d5d5;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(255, 255, 255, 0.3);
            background: #eeeeee;
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 10px;
            /* background-color: rgba(26, 155, 252, 0.5); */
            background: #b0b0b0;
        }

        ::-webkit-scrollbar-thumb:hover {
            border-radius: 5px;
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            /* background-color: rgba(0, 121, 214, 0.5); */
            background-color: rgba(220, 220, 220, 1);
        }

        @media only screen and (max-width: 993px) {
            ::-webkit-scrollbar {
                width: 5px;
                background-color: #ffffff;
            }
        }
    </style>
</head>

<body>

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
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header d-flex flex-reverse" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="{{ url('/') }}/home">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="{{ url('/') }}/logo.png" style="width: 100px;" alt="homepage"
                                class="dark-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text" style="font-weight: bold; font-size: 20px">
                            <!-- dark Logo text -->
                            <!-- <img src="public/assets/images/logo-text.png" alt="homepage" class="dark-logo" /> -->
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" style="position: fixed; right: 0;"
                        href="javascript:void(0)"><i class="mdi mdi-menu"></i></a>
                    <a class=" waves-effect waves-light d-block d-md-none text-dark"
                        style="position: fixed; right: 50px; top:22px; bottom:100px;"
                        href="{{ url('/') }}/basket"><i class="fa-solid fa-cart-plus"></i>
                        <span class="badge bg-danger text-center"
                            style="padding: 2px 5px; font-size: 9px; position:relative">{{ isset($jumBasket) ? $jumBasket : '0' }}</span>
                        </span>
                    </a>
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
                    <div>{{ ucwords($data['nama']) }}</div>
                    <ul class="navbar-nav float-end">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic"
                                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <center><img src="{{ url('/') }}/img/user/2.jpg" alt="user"
                                        class="rounded-circle" width="31" height="31">
                                </center>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end user-dd animated"
                                aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/') }}/user/{{ $data['id_user'] }}">
                                    <i class="mdi mdi-account m-r-5 m-l-5"></i>
                                    My Profile</a>
                                <a class="dropdown-item" href="{{ url('/') }}/basket">
                                    <i class="fa-solid fa-cart-plus m-r-5 m-l-5"></i>
                                    Keranjang</a>
                                @if ($data['id_akses'] == 1)
                                    <a class="dropdown-item" href="{{ url('/') }}/user">
                                        <i class="fa-solid fa-user-gear m-r-5 m-l-5"></i>
                                        Account</a>
                                    <a class="dropdown-item" href="{{ url('/') }}/barang">
                                        <i class="fa-solid fa-store m-r-5 m-l-5"></i>
                                        Barang</a>
                                    <a class="dropdown-item" style="margin-left: 5px;"
                                        href="{{ url('/') }}/transaksi">
                                        <i class="fa-solid fa-money-bill-1-wave" style="margin-right: 5px;"></i>
                                        Transaction</a>
                                @endif
                                <a class="dropdown-item" href="{{ url('/') }}/logout">
                                    <i class="fa-solid fa-arrow-right-from-bracket m-r-5 m-l-5"></i>
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




        @yield('container')


        <footer class="footer text-center">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-auto">
                    All Rights Reserved by <a href="https://github.com/alwa14" target="_blank">SalwaNur.JB</a>&COPY;
                    2022
                </div>
            </div>
        </footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ url('/') }}/assets/libs/jquery/dist/jquery.min.js"></script>

    <script src="{{ url('/') }}/js/script.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ url('/') }}/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="{{ url('/') }}/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="{{ url('/') }}/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="{{ url('/') }}/js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{ url('/') }}/assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="{{ url('/') }}/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="{{ url('/') }}/js/pages/dashboards/dashboard1.js"></script>
</body>

</html>
