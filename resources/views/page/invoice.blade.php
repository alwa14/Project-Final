@extends('layouts.main')

@section('container')
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav" style="margin-top: 45px;">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link "
                            href="{{ url('/') }}/home" aria-expanded="false">
                            <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link "
                            href="{{ url('/') }}/user/{{ $data['id_user'] }}" aria-expanded="false">
                            <i class="mdi mdi-account"></i><span class="hide-menu">Profile</span></a>
                    </li>

                    <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px; "> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link " href="{{ url('/') }}/basket/#"
                            aria-expanded="false">
                            <i class="mdi mdi-basket text-white"></i><span class="hide-menu text-white"> Keranjang
                                <span class="badge bg-danger text-center"
                                    style="padding: 3px 7px; margin-left: 60px;">{{ isset($jumBasket) ? $jumBasket : '0' }}</span>
                            </span></a>
                    </li>

                    @if ($data['id_akses'] == 1)
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link "
                                href="{{ url('/') }}/barang" aria-expanded="false">
                                <i class="mdi mdi-store"></i><span class="hide-menu">Daftar Barang</span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/') }}/user" aria-expanded="false"><i
                                    class="mdi mdi-account-edit"></i><span class="hide-menu">Account</span></a>
                        </li>
                    @endif

                    <li class="sidebar-item" style="position: fixed; bottom: 0; width: 220px"> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/') }}/logout"
                            aria-expanded="false"><i class="fa-solid fa-arrow-right-from-bracket m-r-10"></i><span
                                class="hide-menu">Logout</span></a></li>
                </ul>

            </nav>
            <!-- End Sidebar navigation -->
        </div>
        <!-- End Sidebar scroll-->
    </aside>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}#" class="link"><i
                                        class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Daftar Keranjang</h1>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>


        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
        </div>
    </div>
    @if (isset($success))
        <h1>Berhasil membeli</h1>
    @elseif(isset($pesan))
        <h1>GAGAL</h1>
    @endif
@endsection
