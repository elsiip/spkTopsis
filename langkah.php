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

    <title>SPK Penghitungan</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free-6.5.1-web/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

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
            <li class="nav-item">
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

            <li class="nav-item active">
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

                <?php include 'topbar.php';
                include 'koneksi.php';
                $tampil = $mysqli->query("SELECT b.nama_alternatif,c.nama_kriteria,a.nilai,c.bobot,c.jenis_kriteria
                FROM
                  sampel a
                  JOIN
                    alternatif b USING(id_alternatif)
                  JOIN
                    kriteria c USING(id_kriteria);");

                $data          = array();
                $kriterias     = array();
                $bobot         = array();
                $nilai_kuadrat = array();
                $status = array();

                if ($tampil) {
                    while ($row = $tampil->fetch_object()) {
                        if (!isset($data[$row->nama_alternatif])) {
                            $data[$row->nama_alternatif] = array();
                        }
                        if (!isset($data[$row->nama_alternatif][$row->nama_kriteria])) {
                            $data[$row->nama_alternatif][$row->nama_kriteria] = array();
                        }
                        if (!isset($nilai_kuadrat[$row->nama_kriteria])) {
                            $nilai_kuadrat[$row->nama_kriteria] = 0;
                        }
                        $bobot[$row->nama_kriteria] = $row->bobot;
                        $data[$row->nama_alternatif][$row->nama_kriteria] = $row->nilai;
                        $nilai_kuadrat[$row->nama_kriteria] += pow($row->nilai, 2);
                        $kriterias[] = $row->nama_kriteria;
                        $status[$row->nama_kriteria] = $row->jenis_kriteria;
                    }
                }

                $kriteria     = array_unique($kriterias);
                $jml_kriteria = count($kriteria);
                ?>


                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Proses Penghitungan</h1>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                    </div>

                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 1 - Evaluation Matrix (x<sub>ij</sub>)</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th rowspan='3'>No</th>
                                            <th rowspan='3'>Alternatif</th>
                                            <th rowspan='3'>Nama</th>
                                            <th colspan='<?php echo $jml_kriteria; ?>' class="text-center">
                                                <div class="d-flex justify-content-center">Kriteria</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($kriteria as $k)
                                                echo "<th class='text-center'>$k</th>\n";
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($n = 1; $n <= $jml_kriteria; $n++)
                                                echo "<th class='text-center'>C$n</th>";
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($data as $nama => $krit) {
                                            echo "<tr>
                                                <td>" . (++$i) . "</td>
                                                <th>A$i</th>
                                                <td>$nama</td>";
                                            foreach ($kriteria as $k) {
                                                echo "<td align='center'>" . round($krit[$k], 3) . "</td>";
                                            }
                                            echo "</tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 2 - Keputusan Ternormalisasi</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th rowspan='3'>No</th>
                                            <th rowspan='3'>Alternatif</th>
                                            <th rowspan='3'>Nama</th>
                                            <th colspan='<?php echo $jml_kriteria; ?>' class="text-center">
                                                <div class="d-flex justify-content-center">Kriteria</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($kriteria as $k)
                                                echo "<th class='text-center'>$k</th>\n";
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($n = 1; $n <= $jml_kriteria; $n++)
                                                echo "<th>C$n</th>";
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        foreach ($data as $nama => $krit) {
                                            echo "<tr>
                                                    <td>" . (++$i) . "</td>
                                                    <th>A{$i}</th>
                                                    <td>{$nama}</td>";
                                            foreach ($kriteria as $k) {
                                                echo
                                                "<td align='center'>" . round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) .
                                                    "</td>";
                                            }
                                            echo
                                            "</tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 3 - Normalisasi Berbobot</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th rowspan='3'>No</th>
                                            <th rowspan='3'>Alternatif</th>
                                            <th rowspan='3'>Nama</th>
                                            <th colspan='<?php echo $jml_kriteria; ?>' class="text-center">
                                                <div class="d-flex justify-content-center">Kriteria</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($kriteria as $k)
                                                echo "<th>$k</th>\n";
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($n = 1; $n <= $jml_kriteria; $n++)
                                                echo "<th>C$n</th>";
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $y = array();
                                        foreach ($data as $nama => $krit) {
                                            echo "<tr>
                                                    <td>" . (++$i) . "</td>
                                                    <th>A{$i}</th>
                                                    <td>{$nama}</td>";
                                            foreach ($kriteria as $k) {
                                                $y[$k][$i - 1] = round(($krit[$k] / sqrt($nilai_kuadrat[$k])), 4) * $bobot[$k];
                                                echo "<td align='center'>" . $y[$k][$i - 1] . "</td>";
                                            }
                                            echo
                                            "</tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 4 - Solusi Ideal Positif (A<sup>+</sup>)</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th colspan='<?php echo $jml_kriteria; ?>' class="text-center">
                                                <div class="d-flex justify-content-center">Kriteria</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($kriteria as $k)
                                                echo "<th>$k</th>\n";
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($n = 1; $n <= $jml_kriteria; $n++)
                                                echo "<th class='text-center'>a<sub>{$n}</sub><sup>+</sup></th>";
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $yplus = array();
                                        foreach ($kriteria as $k) {
                                            $yplus[$k] = ($status[$k] == 'Benefit' ? max($y[$k]) : min($y[$k]));

                                            echo "<th>" . $yplus[$k] . "</th>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 5 - Solusi Ideal Negatif (A<sup>-</sup>)</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th colspan='<?php echo $jml_kriteria; ?>' class="text-center">
                                                <div class="d-flex justify-content-center">Kriteria</div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <?php
                                            foreach ($kriteria as $k)
                                                echo "<th>$k</th>\n";
                                            ?>
                                        </tr>
                                        <tr>
                                            <?php
                                            for ($n = 1; $n <= $jml_kriteria; $n++)
                                                echo "<th class='text-center'>a<sub>{$n}</sub><sup>-</sup></th>";
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ymin = array();
                                        foreach ($kriteria as $k) {
                                            $ymin[$k] = ($status[$k] == 'Cost' ? max($y[$k]) : min($y[$k]));
                                            echo "<th>" . $ymin[$k] . "</th>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 6 - Jarak Positif (D<sub>i</sub><sup>+</sup>)</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Alternatif</th>
                                            <th>Nama</th>
                                            <th>D<suo>+</sup></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $dplus = array();
                                        foreach ($data as $nama => $krit) {
                                            echo "<tr>
                                                    <td>" . (++$i) . "</td>
                                                    <th>A{$i}</th>
                                                    <td>{$nama}</td>";
                                            foreach ($kriteria as $k) {
                                                if (!isset($dplus[$i - 1])) $dplus[$i - 1] = 0;
                                                $dplus[$i - 1] += pow($yplus[$k] - $y[$k][$i - 1], 2);
                                            }
                                            echo "<td>" . round(sqrt($dplus[$i - 1]), 4) . "</td>
                                                    </tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 7 - Jarak Negatif (D<sub>i</sub><sup>-</sup>)</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Alternatif</th>
                                            <th>Nama</th>
                                            <th>D<suo>-</sup></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $dmin = array();
                                        foreach ($data as $nama => $krit) {
                                            echo "<tr>
                                                        <td>" . (++$i) . "</td>
                                                        <th>A{$i}</th>
                                                        <td>{$nama}</td>";
                                            foreach ($kriteria as $k) {
                                                if (!isset($dmin[$i - 1])) $dmin[$i - 1] = 0;
                                                $dmin[$i - 1] += pow($ymin[$k] - $y[$k][$i - 1], 2);
                                            }
                                            echo "<td>" . round(sqrt($dmin[$i - 1]), 4) . "</td>
                                                    </tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Langkah 8 - Nilai Preferensi(V<sub>i</sub>)</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Alternatif</th>
                                            <th>Nama</th>
                                            <th>V<suo>i</sup></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $V = array();
                                        $Y = array();
                                        $Z = array();
                                        $hasilakhir = array();

                                        foreach ($data as $nama => $krit) {
                                            echo "<tr>
                                                    <td>" . (++$i) . "</td>
                                                    <th>A{$i}</th>
                                                    <td>{$nama}</td>";
                                            foreach ($kriteria as $k) {
                                                $V[$i - 1] = round(sqrt($dmin[$i - 1]), 4) / (round(sqrt($dmin[$i - 1]), 4) + round(sqrt($dplus[$i - 1]), 4));
                                            }
                                            echo "<td>" . round($V[$i - 1], 4) . "</td></tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-sm-13">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-primary">Hasil Ranking</h6>
                            </div>
                            <div class="card-body">
                                <table class='table table-bordered' id='dataTable' cellspacing='0'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Alternatif</th>
                                            <th>Nama</th>
                                            <th>V<sub>i</sub></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $V = array();
                                        $alternatif = array();
                                        $hasilakhir = array();

                                        foreach ($data as $nama => $krit) {
                                            $alternatif[$i] = $nama;
                                            $V[$i] = round(sqrt($dmin[$i]), 4) / (round(sqrt($dmin[$i]), 4) + round(sqrt($dplus[$i]), 4));
                                            $alternatif_ranked[$i] = "A" . (++$i);
                                        }

                                        array_multisort($V, SORT_DESC, $alternatif_ranked, $alternatif);

                                        foreach ($V as $key => $value) {
                                            $rank = $key + 1;
                                            echo "<tr>
                                            <td>{$rank}</td>
                                            <td>{$alternatif_ranked[$key]}</td>
                                            <td>{$alternatif[$key]}</td>
                                            <td>".number_format($value, 4)."</td>
                                            </tr>\n";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php include 'footer.php'; ?>
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