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

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link "
                            href="{{ url('/') }}/basket" aria-expanded="false">
                            <i class="mdi mdi-basket"></i><span class="hide-menu"> Keranjang
                                <span class="badge bg-danger text-center"
                                    style="padding: 3px 7px; margin-left: 60px;">{{ isset($jumBasket) ? $jumBasket : '0' }}</span>
                            </span></a>
                    </li>

                    @if ($data['id_akses'] == 1)
                        <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px; "> <a
                                class="sidebar-link waves-effect waves-dark sidebar-link " href="{{ url('/') }}/barang"
                                aria-expanded="false">
                                <i class="mdi mdi-store text-white "></i><span class="hide-menu text-white">Daftar
                                    Barang</span></a>
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
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row align-items-center">
                <div class="col-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}/" class="link"><i
                                        class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Barang</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">Daftar Barang</h1>
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

            <div class="row text-start">
                <div class="col">
                    <div class="mb-0">
                        <button type="button" class="btn btn-primary text-center mb-2" data-bs-toggle="modal"
                            data-bs-target="#Tambah"><i class="fa-solid fa-cart-plus"></i>
                            Tambah Barang</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive" id="container">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-dark">
                        <tr class="fw-semibold text-center">
                            <td>No</td>
                            <td>Nama Barang</td>
                            <td>Size</td>
                            <td>Warna</td>
                            <td>Stok</td>
                            <td>Harga</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <?php $no = 1;
                    ?>
                    <tbody>
                        <?php $total = 0; ?>
                        @if (count($dataBarang) != 0)
                            @foreach ($dataBarang as $row)
                                <tr class="text-start text-center">
                                    <td scope="row text-dark" style="width: 20px">
                                        <label for="Check{{ $row->id_barang }}"><?= $no++ ?></label>
                                    </td>

                                    <td class="text-center text-dark" style="width: 50px">
                                        <label for="Check{{ $row->id_barang }}" class="fw-bold">
                                            {{ $row->nm_barang }}</label>
                                    </td>
                                    <td class="text-center text-dark" style="width: 20px">
                                        <label for="Check{{ $row->id_barang }}"> {{ $row->ukuran }}</label>
                                    </td>
                                    <td class="text-center text-dark text-opacity-0" style="width: 20px">
                                        <label for="Check{{ $row->id_barang }}">{{ $row->warna }}</label>
                                    </td>
                                    <td class="text-center text-dark text-opacity-0" style="width: 30px">
                                        <label for="Check{{ $row->id_barang }}">{{ $row->stok_barang }}</label>
                                    </td>
                                    <td class="text-center text-dark fw-bold" style="width: 50px">
                                        <label for="Check{{ $row->id_barang }}"> IDR
                                            {{ str_replace(',', ' ', number_format($row->harga_jual)) }}</label>
                                    </td>
                                    <td style="width: 40px">
                                        <div class="col">

                                            <button type="button" class="btn btn-success mt-1 text-center text-white"
                                                data-bs-toggle="modal" data-bs-target="#Detail{{ $row->id_barang }}"><i
                                                    class="mdi mdi-information"></i></button>

                                            <button type="button" class="btn btn-primary mt-1 text-center"
                                                data-bs-toggle="modal" data-bs-target="#Edit{{ $row->id_barang }}"><i
                                                    class="mdi mdi-border-color"></i></button>

                                            <button type="button" class="btn btn-danger mt-1 text-center text-white"
                                                data-bs-toggle="modal" data-bs-target="#Delete{{ $row->id_barang }}"><i
                                                    class="mdi mdi-delete"></i></button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr class="text-center fw-semibold">
                                <td colspan="8">
                                    Belum ada barang! <br>Segera tambahkan stok <button type="button"
                                        class="btn btn-link">disini</button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>



        @foreach ($dataBarang as $row)
            <!-- Modal Delete -->
            <div class="modal fade " id="Delete{{ $row->id_barang }}" tabindex="-1" aria-labelledby="DeleteLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DeleteLabel">Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-dark">
                            <center><img src="{{ url('/') }}/img/barang/{{ $row->gambar }}" alt="Foto Profil"
                                    class="rounded-circle img-thumbnail" width="200px">
                            </center>
                            Anda yakin ingin menghapus <strong>{{ $row->nm_barang }}</strong> dari daftar?
                        </div>
                        <div class="modal-footer">
                            <form action="{{ url('/') }}/barang/delete" method="post">
                                @csrf
                                <input type="hidden" name="id_barang" value="{{ $row->id_barang }}">
                                <input type="hidden" name="id_barang" value="{{ $row->id_barang }}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-danger text-white">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Edit -->
            <div class="modal fade" id="Edit{{ $row->id_barang }}" aria-hidden="true" aria-labelledby="EditLabel"
                tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditLabel">Modal 1</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Show a second modal and hide this one with the button below.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" type="button">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade " id="Detail{{ $row->id_barang }}" tabindex="-1" aria-labelledby="DetailLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DetailLabel">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <center><img src="{{ url('/') }}/img/barang/{{ $row->gambar }}" alt="Foto Profil"
                                    class="rounded-circle img-thumbnail" width="200px">
                            </center>
                            <table class="table table-striped-columns text-dark">
                                <tr>
                                    <td>
                                        ID Barang
                                    </td>
                                    <td> : </td>
                                    <td>{{ $row->id_barang }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama Barang
                                    </td>
                                    <td> : </td>
                                    <td>{{ $row->nm_barang }}</td>
                                </tr>
                                <tr>
                                    <td>Model Bahan</td>
                                    <td> : </td>
                                    <td>{{ isset($row->model_bahan) ? $row->model_bahan : 'NULL' }}</td>
                                </tr>
                                <tr>
                                    <td>Merek</td>
                                    <td> : </td>
                                    <td>{{ $row->merk }}</td>
                                </tr>
                                <tr>
                                    <td>Stok</td>
                                    <td> : </td>
                                    <td>{{ $row->stok_barang }}</td>
                                </tr>
                                <tr>
                                    <td>Size</td>
                                    <td> : </td>
                                    <td>{{ $row->ukuran }}</td>
                                </tr>
                                <tr>
                                    <td>Warna</td>
                                    <td> : </td>
                                    <td>{{ $row->warna }}</td>
                                </tr>
                                <tr>
                                    <td>Harga Beli</td>
                                    <td> : </td>
                                    <td>IDR {{ str_replace(',', '.', number_format($row->harga_beli)) }},-</td>
                                </tr>
                                <tr>
                                    <td>Harga Jual</td>
                                    <td> : </td>
                                    <td>IDR {{ str_replace(',', '.', number_format($row->harga_jual)) }},-</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td> : </td>
                                    <td>{{ $row->tgl_masuk }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Beli Semua -->
            <div class="modal fade " id="Tambah" tabindex="-1" aria-labelledby="BeliLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form action="{{ url('/') }}/invoices" method="post">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="BeliLabel">Belanja Semua</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-dark">
                                <table class="table table-hover align-middle text-nowrap">
                                    <thead class="table-dark">
                                        <tr class="fw-semibold text-center">
                                            <td>No</td>
                                            <td>Nama Barang</td>
                                            <td>Size</td>
                                            <td>Quantity</td>
                                        </tr>
                                    </thead>
                                    <?php $no = 1;
                                    ?>
                                    <tbody>
                                        <?php $total = 0; ?>
                                        @foreach ($dataBarang as $row)
                                            @if ($row->stok_barang != 0)
                                                <tr class="text-start">
                                                    <td scope="row text-dark"><label
                                                            for="Check{{ $row->id_barang }}"><?= $no++ ?></label>
                                                    </td>
                                                    <td class="text-center text-dark">
                                                        <label for="Check{{ $row->id_barang }}">
                                                            {{ $row->nm_barang }}</label>
                                                    </td>
                                                    <td class="text-center text-dark">
                                                        <label for="Check{{ $row->id_barang }}">
                                                            {{ $row->ukuran }}</label>
                                                    </td>
                                                    <td class="text-center text-dark text-opacity-0">
                                                        <label
                                                            for="Check{{ $row->id_barang }}">{{ $row->stok_barang }}</label>
                                                    </td>
                                                    <td class="text-center text-dark fw-bold">
                                                        <label for="Check{{ $row->id_barang }}"> IDR
                                                            {{ str_replace(',', ' ', number_format($row->harga_jual * $row->stok_barang)) }}</label>
                                                    </td>
                                                </tr>
                                                <?php
                                                $temp = $row->harga_jual * $row->stok_barang;
                                                $total = $total + $temp; ?>
                                            @endif
                                        @endforeach
                                        <tr class="text-center fw-semibold">
                                            <td colspan="3"></td>
                                            <td>Total : </td>
                                            <td class="text-dark fw-bold">IDR
                                                <?= str_replace(',', ' ', number_format($total)) ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <label for="bayar">Bayar :</label>
                                <input type="number" autofocus class="form-control text-center text-dark" name="bayar"
                                    id="bayar" required>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="total" value="{{ $total }}">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success text-white">Beli Semua</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endsection
