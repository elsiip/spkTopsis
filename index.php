<?php 
    include 'koneksi.php';
    session_start();

    if (!isset($_SESSION['name'])) {
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SPK Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <i class="fa-solid fa-calculator"></i>
            <div class="sidebar-brand-text mx-3">SPK</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fa-solid fa-gauge"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Penghitungan TOPSIS
        </div>

        <!-- Nav Item - Kriteria Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="kriteria.php" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-check-double"></i>
                <span>Kriteria</span>
            </a>
        </li>

        <!-- Nav Item - Alternatif Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="alternatif.php" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-object-group"></i>
                <span>Alternatif</span>
            </a>
        </li>

        <!-- Nav Item - Nilai Matriks Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="matriks.php" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-list-ol"></i>
                <span>Nilai Matriks</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="langkah.php" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa-solid fa-subscript"></i>
                <span>Proses Penghitungan</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Pengaturan
        </div>

        <li class="nav-item">
            <a class="nav-link" href="akun.php">
            <i class="fa-solid fa-user"></i>
                <span>Data Akun</span></a>
        </li>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include 'topbar.php'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Data Kriteria</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    include 'koneksi.php';
                                                    $data_kriteria = mysqli_query($mysqli, "SELECT*FROM kriteria");
                                                    $jumlah_kriteria = mysqli_num_rows($data_kriteria);
                                                    ?>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_kriteria; ?> Kriteria</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-6">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Data Alternatif</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <?php
                                                    include 'koneksi.php';
                                                    $data_alternatif = mysqli_query($mysqli, "SELECT*FROM alternatif");
                                                    $jumlah_alternatif = mysqli_num_rows($data_alternatif);
                                                    ?>
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumlah_alternatif; ?> Alternatif</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Studi Kasus</h6>
                        </div>
                        <div class="card-body">
                            <p>Pemerintah Negara Alpha memiliki tanggung jawab untuk meningkatkan kesejahteraan masyarakat, khususnya mereka yang berada dalam kondisi ekonomi kurang mampu. Dalam upaya untuk mencapai tujuan ini, 
                                pemerintah telah meluncurkan program kesejahteraan sosial yang menyediakan bantuan berupa distribusi beras kepada keluarga-keluarga yang membutuhkan. </p>
                            <p class="mb-0">Data yang digunakan dalam penelitian ini adalah data penerima raskin di Desa Y. Kriteria yang tersedia adalah umur, pekerjaan, penghasilan, luas bangunan, tanggungan, biaya tagihan listrik, 
                                dan konsumsi daging. Untuk menentukan bobot setiap kriteria dengan berdasarkan subjektifitas dari peneliti. </p>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    


</body>

</html>