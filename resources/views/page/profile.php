<?php
include '../controller/config.php';
session_start();
$kode = $_GET['id'];
$kode2 = $_SESSION['id'];


// $sql = mysqli_query($conn, "SELECT * FROM Auth");
// $sql2 = mysqli_query($conn, "SELECT a.Alamat, a.Nama, a.Foto, a.NIK, a.NoHP, a.Tanggal_lahir, a.Tempat_lahir, b.Jabatan as nama_jabatan, a.Jabatan FROM petugas a, jabatan b WHERE a.Jabatan=b.Id_jabatan AND a.Kode_petugas='$kode'");

$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' ORDER BY c.Id_jabatan");


$result1 = mysqli_fetch_assoc($sql);
if ($result1['Status'] == 0) {
    header("location:../logout.php");
}

if (!isset($_GET['id']) || $kode != $kode2) {
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Profile - GeoBase</title>
    <?php include 'Meta.php'; ?>
</head>

<body>

    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>

    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <!-- Sidebar navigation-->
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

                    <li class="sidebar-item" style="background-color: #1a9bfc; border-radius: 9px"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="profile.php?id=<?= $result1['Kode_petugas']; ?>" aria-expanded="false"><i class="mdi mdi-account-network text-white"></i><span class="hide-menu text-white">Profile</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="maps.php" aria-expanded="false"><i class="mdi mdi-google-maps"></i><span class="hide-menu">MAPS</span></a></li>

                    <?php if ($result1['Id_jabatan'] == 1 || $result1['Id_jabatan'] == 2) {  ?>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="user.php?id=<?= $result1['Kode_petugas']; ?>&page=1" aria-expanded="false"><i class="mdi mdi-account-edit"></i><span class="hide-menu">Account</span></a></li>
                    <?php } ?>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="starter-kit.html" aria-expanded="false"><i class="mdi mdi-file"></i><span class="hide-menu">Blank</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../404.html" aria-expanded="false"><i class="mdi mdi-alert-outline"></i><span class="hide-menu">404</span></a></li>

                    <li class="sidebar-item" style="position: fixed; bottom: 0; width: 220px"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="../logout.php" aria-expanded="false"><i class="m-r-10 mdi mdi-exit-to-app"></i><span class="hide-menu">LogOut</span></a></li>



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
                            <li class="breadcrumb-item"><a href="../index.php" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
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
                                <?php if (isset($result1['Foto'])) { ?>
                                    <img src="../public/img/User/<?= $result1['Foto']; ?>" class="rounded-circle" width="200" height="200">
                                <?php } else { ?>
                                    <img src="../public/img/User/1.jpg" class="rounded-circle" width="200" height="200">
                                <?php } ?>

                                <h4 class="card-title m-t-10"><?= $result1['Nama']; ?></h4>
                                <h6 class="card-subtitle"><?= $result1['Jabatan']; ?></h6>

                            </center>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body"> <small class="text-muted">Email address </small>
                            <h6><?= $result1['Email']; ?></h6> <small class="text-muted p-t-30 db">Phone</small>
                            <?php if (isset($result1['NoHP'])) { ?>
                                <h6><?= $result1['NoHP']; ?></h6>
                            <?php } else { ?>
                                <h6><i>NULL</i></h6>
                            <?php } ?>
                            <small class="text-muted p-t-30 db">Address</small>
                            <?php if (isset($result1['Alamat'])) { ?>
                                <h6><?= $result1['Alamat']; ?></h6>
                            <?php } else { ?>
                                <h6><i>NULL</i></h6>
                            <?php } ?>
                            <small class="text-muted p-t-30 db">Social Profile</small>
                            <br />

                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-8 col-xlg-9 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <form action="../model/edit-user.php" method="POST" enctype="multipart/form-data" class="form-horizontal form-material mx-2">
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="nama">Nama Lengkap</label>
                                    <div class="col-md-12">
                                        <input type="text" id="nama" value="<?= $result1['Nama']; ?>" class="form-control form-control-line" name="nama">
                                    </div>
                                </div>
                                <!-- <div class="form-group"> -->
                                <!-- <label for="email" class="col-md-12" for="email">Email</label> -->
                                <!-- <div class="col-md-12"> -->
                                <!-- <input id="email" type="email" value="<?= $result1['Email']; ?>" class="form-control form-control-line" disabled readonly id="email"> -->
                                <!-- </div> -->
                                <!-- </div> -->
                                <div class="form-group">
                                    <label for="example-Foto" class="col-md-12 text-dark" for="foto">Foto</label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input type="file" id="foto" class="form-control" id="gambar" placeholder="Ganti gambar" name="gambar">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="nohp">No HP</label>
                                    <div class="col-md-12">
                                        <input type="text" id="nohp" value="<?= $result1['NoHP']; ?>" placeholder="Masukkan No HP" class="form-control form-control-line" name="nohp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="tgllahir">Tanggal Lahir</label>
                                    <div class="col-md-12">
                                        <input type="date" id="tgllahir" value="<?= $result1['Tanggal_lahir']; ?>" name="tgllahir" class="form-control form-control-line">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="tmplahir">Tempat Lahir</label>
                                    <div class="col-md-12">
                                        <input type="text" id="tmplahir" placeholder="Masukkan Tempat Lahir" class="form-control form-control-line" value="<?= $result1['Tempat_lahir']; ?>" name="tmplahir">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-12 text-dark" for="alamat">Alamat</label>
                                    <div class="col-md-12">
                                        <input type="text" id="alamat" placeholder="Masukkan Alamat Tempat Tinggal" class="form-control form-control-line" value="<?= $result1['Alamat']; ?>" name="alamat">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" name="edit" class="btn btn-success text-white">Update Profile</button>
                                    </div>
                                </div>
                            </form>


                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="../model/edit-user.php" method="POST" class="form-horizontal form-material mx-2 mt-4">
                            <div class="form-group">
                                <label class="col-md-12 text-dark" for="pass">Password</label>
                                <div class="col-md-12">
                                    <input type="password" id="pass" name="password" placeholder="Masukkan Password baru" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 text-dark" for="passkon">Konfirmasi Password</label>
                                <div class="col-md-12">
                                    <input type="password" id="passkon" name="password" placeholder="Masukkan Password baru" class="form-control form-control-line">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 text-dark" for="passlama">Password Lama</label>
                                <div class="col-md-12">
                                    <input type="password" id="passlama" placeholder="Masukkan Password lama" class="form-control form-control-line" name="passlama">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="check" id="check" class="mx-2" onclick="myFunction()">
                                <label for="check" class="text-dark">Show Password</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button type="submit" name="change" class="btn btn-danger text-white">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Column -->
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
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->

        <script>
            function myFunction() {
                var x = document.getElementById("pass");
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
        </script>
        <?php include 'footer.php'; ?>