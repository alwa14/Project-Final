 @extends('layouts.main')


 @section('container')
     <!-- ============================================================== -->
     <!-- Left Sidebar - style you can find in sidebar.scss  -->
     <!-- ============================================================== -->
     <aside class="left-sidebar" data-sidebarbg="skin6">
         <!-- Sidebar scroll-->
         <div class="scroll-sidebar">
             <!-- Sidebar navigation-->
             <nav class="sidebar-nav">
                 <ul id="sidebarnav" style="margin-top: 45px;">
                     <li class="sidebar-item" style=""> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                             href="{{ url('/') }}/home" aria-expanded="false">
                             <i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                     </li>

                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                             style="background-color: #1a9bfc; border-radius: 9px; "
                             href="{{ url('/') }}/user/{{ $data['id_user'] }}" aria-expanded="false">
                             <i class="mdi mdi-account text-white"></i><span class="hide-menu text-white">Profile</span></a>
                     </li>

                     <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                             href="{{ url('/') }}/basket/{{ $data['id_user'] }}" aria-expanded="false">
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
                                     class="fa-solid fa-money-bill-1-wave"></i><span
                                     class="hide-menu">Transaction</span></a>
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
                             <li class="breadcrumb-item"><a href="../index.php" class="link"><i
                                         class="mdi mdi-home-outline fs-4"></i></a></li>
                             <li class="breadcrumb-item active" aria-current="page">Profile</li>
                         </ol>
                     </nav>
                     <h1 class="mb-0 fw-bold">Profile</h1>
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
             @if (isset($pesan))
                 <div class="alert alert-success d-flex align-items-center" role="alert">
                     <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                     <div>
                         {{ $pesan }}
                     </div>
                 </div>
             @endif
             @if (isset($gagal))
                 <div class="alert alert-warning d-flex align-items-center" role="alert">
                     <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                     <div>
                         {{ $gagal }}
                     </div>
                 </div>
             @endif
             <!-- ============================================================== -->
             <!-- Start Page Content -->
             <!-- ============================================================== -->
             <!-- Row -->
             <div class="row">
                 <!-- Column -->
                 <div class="col-lg-4 col-xlg-3 col-md-5">
                     <div class="card">
                         <div class="card-body">
                             <center class="m-t-30">
                                 <img src="{{ url('/') }}/img/User/2.jpg" class="rounded-circle" width="200"
                                     height="200">

                                 <h4 class="card-title m-t-10">{{ ucwords($data['nama']) }}</h4>
                                 <h6 class="card-subtitle">{{ $data['id_akses'] == 1 ? 'Admin' : 'Pelanggan' }}</h6>

                             </center>
                         </div>
                         <div>
                             <hr>
                         </div>
                         <div class="card-body">
                             <small class="text-muted">Nama</small>
                             <h6>{{ ucwords($data['nama']) }}</h6>

                             <small class="text-muted">Username</small>
                             <h6>{{ $data['username'] }}</h6>

                             <small class="text-muted">Hak Akses</small>
                             <h6>{{ $data['nama_akses'] }}</h6>
                         </div>
                     </div>
                 </div>
                 <!-- Column -->
                 <!-- Column -->
                 <div class="col-lg-8 col-xlg-9 col-md-7">
                     <div class="card">
                         <div class="card-body">
                             <form action="{{ url('/') }}/edit" method="POST" enctype="multipart/form-data"
                                 class="form-horizontal form-material mx-2">
                                 @csrf
                                 <input type="hidden" name="id_user" value="{{ $data['id_user'] }}">
                                 <input type="hidden" name="namaAsli" value="{{ $data['nama'] }}">
                                 <input type="hidden" name="usernameAsli" value="{{ $data['username'] }}">
                                 <div class="form-group">
                                     <label class="col-md-12 text-dark" for="nama">Nama Lengkap</label>
                                     <div class="col-md-12">
                                         <input type="text" id="nama" value="{{ ucwords($data['nama']) }}"
                                             class="form-control form-control-line" name="nama" maxlength="100">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-12 text-dark" for="username">Username</label>
                                     <div class="col-md-12">
                                         <input type="text" id="username" value="{{ $data['username'] }}"
                                             class="form-control form-control-line" name="username" maxlength="20">
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <div class="col-sm-12">
                                         <button type="submit" name="edit" class="btn btn-success text-white">Update
                                             Profile</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <div class="card">
                         <div class="card-body">
                             <form action="{{ url('/') }}/changePassword" method="POST"
                                 class="form-horizontal form-material mx-2 mt-4">
                                 @csrf
                                 <input type="hidden" name="id_user" value="{{ $data['id_user'] }}">
                                 <div class="form-group">
                                     <label class="col-md-12 text-dark" for="passlama">Password Lama</label>
                                     <div class="col-md-12">
                                         <input type="password" id="passlama" placeholder="Masukkan Password lama"
                                             class="form-control form-control-line" name="passlama" maxlength="100">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-12 text-dark" for="pass">Password Baru</label>
                                     <div class="col-md-12">
                                         <input type="password" id="password" name="password"
                                             placeholder="Masukkan Password baru" class="form-control form-control-line"
                                             maxlength="100">
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <label class="col-md-12 text-dark" for="passkon">Konfirmasi Password</label>
                                     <div class="col-md-12">
                                         <input type="password" id="passkon" name="password"
                                             placeholder="Konfirmasi Password baru" class="form-control form-control-line"
                                             maxlength="100">
                                         <div id="validationServer03Feedback" class="invalid-feedback">
                                             Password tidak sama!
                                         </div>
                                     </div>
                                 </div>

                                 <div class="form-group">
                                     <input type="checkbox" name="check" id="check" class="mx-2"
                                         onclick="myFunction()">
                                     <label for="check" class="text-dark">Show Password</label>
                                 </div>
                                 <div class="form-group">
                                     <div class="col-sm-12">
                                         <button type="submit" name="change" class="btn btn-danger text-white">Change
                                             Password</button>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                     <!-- Column -->
                 </div>
             </div>
             <!-- Row -->
             <!-- ============================================================== -->
             <!-- End PAge Content -->
             <!-- ============================================================== -->
             <!-- ============================================================== -->
             <!-- Right sidebar -->
             <!-- ============================================================== -->
             <!-- .right-sidebar -->
             <!-- ============================================================== -->
             <!-- End Right sidebar -->
             <!-- ============================================================== -->
         </div>
         <!-- ============================================================== -->
         <!-- End Container fluid  -->
         <!-- ============================================================== -->
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script>
             function myFunction() {
                 var x = document.getElementById("password");
                 var y = document.getElementById("passkon");
                 var z = document.getElementById("passlama");
                 if (x.type === "password" && y.type === "password" && z.type === "password") {
                     x.type = "text";
                     y.type = "text";
                     z.type = "text";
                 } else {
                     x.type = "password";
                     y.type = "password";
                     z.type = "password";
                 }
             }


             $(document).ready(function() {
                 $('#passkon').on('keyup', function() {
                     let pass = $('#password').val();
                     let passkon = $('#passkon').val();

                     if (passkon != pass) {
                         $('#passkon').addClass("is-invalid");
                     } else {
                         $('#passkon').removeClass("is-invalid");
                     }

                 });
             });
         </script>
     @endsection
