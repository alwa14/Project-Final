<?php
include '../controller/config.php';
session_start();
$kode = $_GET['id'];
$kode2 = $_SESSION['id'];


$sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' ORDER BY c.Id_jabatan");

$result1 = mysqli_fetch_assoc($sql);
if ($result1['Status'] == 0) {
    header("location:../logout.php");
}

if (!isset($_GET['id']) || $kode != $kode2) {
    header("Location: ../index.php");
}

$jumlahDataPerHalaman = 3;
$jumData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM auth"));
$jumlahHalaman = ceil($jumData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


$data = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan ORDER BY a.Status DESC, c.Jabatan LIMIT $awalData, $jumlahDataPerHalaman");



?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>User - GeoBase</title>
    <?php include 'Meta.php'; ?>
</head>

<body>
    <?php $url = "../"; ?>
    <?php include 'header.php'; ?>




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

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php?id=<?= $result1['Kode_petugas']; ?>&pesan=''" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a></li>

                    <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="maps.php" aria-expanded="false"><i class="mdi mdi-google-maps"></i><span class="hide-menu">MAPS</span></a></li>

                    <?php if ($result1['Id_jabatan'] == 1 || $result1['Id_jabatan'] == 2) {  ?>
                        <li class="sidebar-item" style="background-color: #1a9bfc;"> <a class="sidebar-link waves-effect waves-dark sidebar-link active" href="user.php?id=<?= $result1['Kode_petugas']; ?>&page=1" aria-expanded="false"><i class="mdi mdi-account-edit text-white"></i><span class="hide-menu text-white">Account</span></a></li>
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
                            <li class="breadcrumb-item"><a href="#" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">User</li>
                        </ol>
                    </nav>
                    <h1 class="mb-0 fw-bold">User Account</h1>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>

        <?php
        if (isset($_GET['pesan'])) {
            $pesan =  $_GET['pesan'];

        ?>
            <?php
            if ($pesan == "gagal") {
            ?>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                    <div>
                        Username atau Password yang anda masukkan salah!
                    </div>
                </div>
            <?php
            } elseif ($pesan == "error") {
            ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-exclamation flex-shrink-0 me-2"></i>
                    <div>
                        Gagal menambahkan data user!
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fa-solid fa-circle-check flex-shrink-0 me-2"></i>
                    <div>
                        Berhasil menambahkan akun user!
                    </div>
                </div>
        <?php
            }
        }
        ?>


        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="mb-0">
                        <button type="button" class="btn btn-primary text-center mb-2" data-bs-toggle="modal" data-bs-target="#TambahUser"><i class="mdi mdi-account-plus"></i> Tambah User</button>
                    </div>
                </div>

                <div class="col">
                    <div class="d-flex flex-row-reverse mb-3">
                        <!-- <button type="submit" name="cari" class="btn btn-info text-white disabled" style="margin-left: 10px; height: 35px;"><i class="mdi mdi-account-search"></i> Cari</button> -->
                        <input type="text" style="height: 35px; margin-left: 20px" name="search" id="search" placeholder="Search" autofocus autocomplete="off">

                        <div class="fa-2x" style="position: absolute; top: 153px; right: 205px" id="loader">
                            <i class="fas fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive" id="container">
                <table class="table table-hover align-middle text-nowrap">
                    <thead class="table-dark">
                        <tr class="fw-semibold text-center">
                            <td>No</td>
                            <td>Action</td>
                            <td>Kode Petugas</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td>Jabatan</td>
                            <td>Terakhir Login</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <?php $no = $awalData; ?>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
                            <tr class="text-start">
                                <td scope="row">
                                    <p class="text-dark"><?= $no = $no + 1; ?></p>
                                </td>
                                <td class="p-1" style="width: 5%;">
                                    <div class="row">
                                        <button type="button" class="btn btn-success mt-1 text-center  text-white" data-bs-toggle="modal" data-bs-target="#Detail<?= $row['Kode_petugas']; ?>"><i class="mdi mdi-information"></i> Detail</button>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-primary mt-1 text-center" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['Kode_petugas']; ?>"><i class="mdi mdi-grease-pencil"></i> Edit</button>
                                    </div>
                                    <div class="row">
                                        <button type="button" class="btn btn-danger mt-1 text-white text-center" data-bs-toggle="modal" data-bs-target="#Delete<?= $row['Kode_petugas']; ?>"><i class="mdi mdi-delete"></i> Hapus</button>
                                    </div>
                                </td>
                                <td class="text-center text-dark">
                                    <?= $row['Kode_petugas']; ?>
                                </td>
                                <td class="text-center text-dark">
                                    <?php if (isset($row['Nama'])) { ?>
                                    <?= $row['Nama'];
                                    } else { ?>
                                        <i>NULL</i>
                                    <?php } ?>
                                </td>
                                <td class="text-center text-dark">
                                    <?= $row['Username']; ?>
                                </td>
                                <td class="text-center text-dark">
                                    <?php if (isset($row['Jabatan'])) { ?>
                                    <?= $row['Jabatan'];
                                    } else { ?>
                                        <i>NULL</i>
                                    <?php } ?>
                                </td>
                                <td class="text-center text-dark text-opacity-0">
                                    <?= $row['Last_login']; ?>
                                </td>
                                <td class="text-center text-dark ">
                                    <?= ($row['Status'] == 1) ? "<p class='text-success'>Online</p>" : "Oflline"; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <div class="col mt-2">
                <nav aria-label="...">
                    <ul class="pagination">

                        <?php if ($halamanAktif > 1) : ?>
                            <li class="page-item">
                                <span class="page-link"><a href="?id=<?= $result1['Kode_petugas']; ?>&page=<?= $halamanAktif - 1; ?>" style="text-decoration: none;">Previous</a></span>
                            </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                            <?php if ($i == $halamanAktif) : ?>
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link"><a href="?id=<?= $result1['Kode_petugas']; ?>&page=<?= $i; ?>" class="text-white" style="text-decoration: none;"><?= $i; ?></a></span>
                                </li>
                            <?php else : ?>
                                <li class="page-item"><a class="page-link" href="?id=<?= $result1['Kode_petugas']; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if ($halamanAktif < $jumlahHalaman) : ?>
                            <li class="page-item">
                                <span class="page-link"><a href="?id=<?= $result1['Kode_petugas']; ?>&page=<?= $halamanAktif + 1; ?>" style="text-decoration: none;">Next</a></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>

        <?php $data = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan ORDER BY c.Id_jabatan"); ?>

        <?php while ($row = mysqli_fetch_assoc($data)) : ?>
            <!-- Modal Edit -->
            <div class="modal fade " id="Edit<?= $row['Kode_petugas']; ?>" tabindex="-1" aria-labelledby="EditLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="EditLabel">Edit</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?= $row['Nama']; ?>
                            <br>
                            <?= $row['NIK']; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Delete -->
            <div class="modal fade " id="Delete<?= $row['Kode_petugas']; ?>" tabindex="-1" aria-labelledby="DeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DeleteLabel">Delete</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Anda yakin ingin menghapus akun <strong><?= $row['Nama']; ?></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Hapus</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail -->
            <div class="modal fade " id="Detail<?= $row['Kode_petugas']; ?>" tabindex="-1" aria-labelledby="DetailLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="DetailLabel">Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <?php if (isset($row['Foto'])) { ?>
                                <center><img src="../public/img/User/<?= $row['Foto']; ?>" alt="Foto Profil" class="rounded-circle img-thumbnail" width="200px">
                                </center>
                            <?php } else { ?>
                                <center><img src="../public/img/User/1.jpg" alt="Foto Profil" class="rounded-circle img-thumbnail" width="200px">
                                </center>
                            <?php } ?>
                            <table class="table table-striped-columns">
                                <tr>
                                    <td>
                                        Kode Petugas
                                    </td>
                                    <td> : </td>
                                    <td><?= $row['Kode_petugas']; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Nama
                                    </td>
                                    <td> : </td>
                                    <td><?= $row['Nama']; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        NIK
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['NIK'])) { ?>
                                        <?= $row['NIK'];
                                        } else { ?>
                                            <i>NULL</i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Username
                                    </td>
                                    <td> : </td>
                                    <td><?= $row['Username']; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Email
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['Email'])) { ?>
                                        <?= $row['Email'];
                                        } else { ?>
                                            <i>NULL</i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Password
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php $pass = $row['Password'];
                                        $awal = substr($pass, 0, 16);
                                        $akhir = substr($pass, 16);
                                        ?>
                                        <div><?= $awal; ?></div>
                                        <div><?= $akhir; ?></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Password Lama
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['Old_password'])) : ?>
                                            <?php $pass = $row['Old_password'];
                                            $awal = substr($pass, 0, 16);
                                            $akhir = substr($pass, 16);
                                            ?>
                                            <div><?= $awal; ?></div>
                                            <div><?= $akhir; ?></div>
                                        <?php else : ?>
                                            <i>NULL</i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Jabatan
                                    </td>
                                    <td> : </td>
                                    <td><?= $row['Jabatan']; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        No HP
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['NoHP'])) { ?>
                                        <?= $row['NoHP'];
                                        } else { ?>
                                            <i>NULL</i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal Lahir
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['Tanggal_lahir'])) { ?>
                                        <?= $row['Tanggal_lahir'];
                                        } else { ?>
                                            <i>NULL</i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tempat Lahir
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['Tempat_lahir'])) { ?>
                                        <?= $row['Tempat_lahir'];
                                        } else { ?>
                                            <i>NULL</i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Terakhir Login
                                    </td>
                                    <td> : </td>
                                    <td><?= $row['Last_login']; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Status
                                    </td>
                                    <td> : </td>
                                    <td><?= ($row['Status'] == 1) ? "<p class='text-success'>Online</p>" : "Oflline"; ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        Terakhir Update
                                    </td>
                                    <td> : </td>
                                    <td>
                                        <?php if (isset($row['Updated_at'])) { ?>
                                        <?= $row['Updated_at'];
                                        } else { ?>
                                            <i>NULL</i>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Akun Dibuat
                                    </td>
                                    <td> : </td>
                                    <td><?= $row['Created_at']; ?></td>
                                </tr>

                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- Modal Tambah User -->
        <div class="modal fade " id="TambahUser" tabindex="-1" aria-labelledby="TambahUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TambahUserLabel">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../model/tambah-user.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3 row">
                                <label for="kode-petugas" class="col-md-4 col-form-label">Kode Petugas</label>
                                <div class="col-sm-8">
                                    <input type="text" name="kode_petugas" class="form-control" id="kode-petugas" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama" class="col-md-4 col-form-label">Nama Petugas</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama" class="form-control" id="nama" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="Email" class="col-md-4 col-form-label">Email</label>
                                <div class="col-sm-8">
                                    <input type="email" name="email" class="form-control" id="Email" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-md-4 col-form-label">Password</label>
                                <div class="col-sm-8">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>
                            <?php $q = mysqli_query($conn, "SELECT * FROM jabatan"); ?>
                            <div class="mb-3 row">
                                <label class="col-md-4 col-form-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <select class="form-select" name="jabatan" aria-label="Default select example">
                                        <?php while ($row = mysqli_fetch_assoc($q)) { ?>
                                            <option value="<?= $row['Id_jabatan']; ?>"><?= $row['Jabatan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="tambah-user" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <?php include 'footer.php'; ?>