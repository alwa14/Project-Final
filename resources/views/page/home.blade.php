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
                    <li class="sidebar-item" style="background-color: #ffffff; border-radius: 9px; "> <a
                            class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('/') }}/home"
                            aria-expanded="false">
                            <i class="mdi mdi-view-dashboard text-white"></i><span
                                class="hide-menu text-white">Dashboard</span></a>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ url('/') }}/user/{{ $data['id_user'] }}" aria-expanded="false">
                            <i class="mdi mdi-account"></i><span class="hide-menu">Profile</span></a>
                    </li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="{{ url('/') }}/basket" aria-expanded="false">
                            <i class="mdi mdi-basket"></i><span class="hide-menu"> Keranjang
                                <span class="badge bg-danger text-center"
                                    style="padding: 3px 7px; margin-left: 60px;">{{ isset($jumBasket) ? $jumBasket : '0' }}</span>
                            </span></a>
                    </li>

                    @if ($data['id_akses'] == 1)
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/') }}/barang" aria-expanded="false">
                                <i class="mdi mdi-store"></i><span class="hide-menu">Daftar Barang</span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/') }}/user" aria-expanded="false"><i
                                    class="mdi mdi-account-edit"></i><span class="hide-menu">Account</span></a>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ url('/') }}/transaksi" aria-expanded="false"><i
                                    class="fa-solid fa-money-bill-1-wave"></i><span class="hide-menu">Transaction</span></a>
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
    <div class="page-wrapper mt-3">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            @if (isset($welcome))
                <div>Selamat Datang {{ ucwords($data['nama']) }}</div>
            @endif
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="#" class="link"><i
                                        class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Dashboard</h1>
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
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <!-- ============================================================== -->

            {{-- <div class="col">
                <div class="d-flex flex-row-reverse mb-3">
                    <!-- <button type="submit" name="cari" class="btn btn-info text-white disabled" style="margin-left: 10px; height: 35px;"><i class="mdi mdi-account-search"></i> Cari</button> -->
                    <input type="text" style="height: 35px; margin-left: 20px" name="search" id="search"
                        placeholder="Cari..." autofocus autocomplete="off">

                    <div class="fa-2x" style="position: absolute; top: 153px; right: 205px" id="loader">
                        <i class="fas fa-circle-notch fa-spin"></i>
                    </div>
                </div>
            </div> --}}
            @if (isset($success))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                    <div>
                        {{ $success }}
                    </div>
                </div>
            @endif
            @if (isset($pesan))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                    <div>
                        {{ $pesan }}
                    </div>
                </div>
            @endif
            <div class="row baris" id="barang">
                @foreach ($barang as $row)
                    @if ($row->stok_barang > 0)
                        <div class="col-lg-3 card1 mx-auto" style="padding-left: 0; padding-right: 0">
                            <div class="container text-center" style="padding-left: 0; padding-right: 0">
                                <div class="card card-1" style="width: 18rem; height: 570px">
                                    <form action="{{ url('/') }}/insertBasket" method="post">
                                        <img class="mx-auto my-4" src="img/barang/{{ $row->gambar }}"
                                            alt="{{ $row->nm_barang }}" width="200">
                                        <div class="card-body"
                                            style="padding-bottom: 150px; height: 50px; padding-top: 20px">
                                            <h5 class="card-title fw-bold" style="font-size: 15px">{{ $row->nm_barang }}
                                            </h5>
                                            <p class="card-text text-dark" style="font-size: 13px">
                                                {{ $row->merk }}
                                            </p>
                                            <p class="card-text text-muted">Ukuran
                                                {{ $row->ukuran }}
                                            </p>
                                            <input type="number" name="qty" id="qty" value="1"
                                                class="form-control text-center" min="1"
                                                max="{{ $row->stok_barang }}">
                                        </div>
                                        <div class="card-footer"
                                            style="padding-bottom: 20px; background-color: #FFF; border: 0">
                                            <p class="text-muted fw-bold"
                                                style="font-size: 11px; text-decoration: line-through">IDR
                                                {{ str_replace(',', '.', number_format($row->harga_jual + 80000)) }},-
                                            </p>
                                            <p class="text-dark fw-bold" style="font-size: 15px">IDR
                                                {{ str_replace(',', '.', number_format($row->harga_jual)) }},-
                                            </p>

                                            @csrf
                                            <input type="hidden" name="id_user" value="{{ $data['id_user'] }}">
                                            <input type="hidden" name="id_barang" value="{{ $row->id_barang }}">
                                            <button type="submit"
                                                class="btn btn-primary mx-auto waves-effect waves-dark"><i
                                                    class="fa-solid fa-cart-plus m-r-5 m-l-5"></i>Masukkan
                                                Keranjang</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
    @endsection
