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

    <title>SPK Akun</title>

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
            <a class="nav-link collapsed" href="kriteriaTopsis.php" aria-expanded="true" aria-controls="collapseTwo">
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

        <li class="nav-item active">
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

            <?php 

                    include 'koneksi.php';

                    $action = isset($_POST['action']) ? $_POST['action'] : "";

                    if($action == "update"){ //if the user hit the submit button
                        //$mysqli->real_escape_string() function helps us prevent attacks such as SQL injection
                        $query = "update users set
                                    name ='".$mysqli->real_escape_string($_POST['name'])."',
                                    email ='".$mysqli->real_escape_string($_POST['email'])."',
                                    password ='".$mysqli->real_escape_string($_POST['password'])."'
                                    where id ='".$mysqli->real_escape_string($_REQUEST['id'])."'";

                        //execute the query
                        if($mysqli->query($query)){
                            //if updating the record was successful
                            echo "<div class='row'>";
                                echo "<div class='col-sm-9'></div>";
                                echo "<div class='col-sm-3 text-right alert alert-success alert-dismissible fade show'>Data berhasil diubah</div>";
                                echo "</div>";
                            echo "</div>";
                        }else{
                            //if unable to update new record
                            echo "<div class='row'>";
                                echo "<div class='col-sm-9'></div>";
                                echo "<div class='col-sm-3 text-right alert alert-success alert-dismissible fade show'>Data gagal diubah</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                    }

                    //select the specific database record to update
                    $query = "select id, name, email, password
                                from users where id='".$mysqli->real_escape_string($_REQUEST['id'])."'
                                limit 0,1";

                    //execute the query
                    $result = $mysqli->query($query);

                    //get the result
                    $row = $result->fetch_assoc();

                    //asign the result to certain variable so our html form will be filled up with values
                    $id = $row['id'];
                    $name = $row['name'];
                    $email = $row['email'];
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Akun</h1>
                    </div>

                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-6">

                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Ubah Data</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="#" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="name">Nama</label>
                                            <input type="text" name="name" id="name" required="required" placeholder="ketik" autocomplete="off" class="form-control" value='<?php echo $name; ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" required="required" placeholder="ketik" autocomplete="off" class="form-control" value='<?php echo $email; ?>'>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" required="required" placeholder="ketik" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="cpassword">Konfirmasi Password</label>
                                            <input type="password" name="cpassword" id="cpassword" required="required" placeholder="ketik" autocomplete="off" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-sm btn-success" name="edit"><i class="fa fa-plus"></i> Edit</button>
                                            <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Batal</button>
                                            <a href='akun.php' class='btn btn-sm btn-info'><i class='fas fa-caret-left'></i> Back</a>
                                            <input type='hidden' name='action' value='update'/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-8">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar Akun</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                        include 'koneksi.php';
                                        $action = isset($_GET['action']) ? $_GET['action']: "";
                                        //query all records from the database
                                        $query = "select * from users";
                                        //execute the query
                                        $result = $mysqli->query($query);
                                        //get number of rows returned
                                        $num_results = $result->num_rows;

                                        if($num_results > 0){
                                            echo "<table class='table table-bordered' id='dataTable' cellspacing='0'>";
                                                echo "<thead>";
                                                    echo "<tr>";
                                                        echo "<th>No</th>";
                                                        echo "<th>Nama</th>";
                                                        echo "<th>Email</th>";
                                                        echo "<th>Aksi</th>";
                                                    echo "</tr>";
                                                echo "</thead>";
                                
                                                echo "<tbody>";
                                                $no = 1;
                                                while($row = $result->fetch_assoc()){
                                                    extract($row);
                                    ?>	
                                                    <tr>
                                                        <td><?php echo $no++; ?></td>
                                                        <td><?php echo $row['name']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td>
                                                            <a href='edit_akun.php?id=<?php echo $row['id']; ?>' class='btn btn-sm btn-info'><i class='fa fa-pen'></i>Edit</a>
                                                            <a href='hapus_akun.php?id=<?php echo $row['id']; ?>' class='btn btn-sm btn-danger' onclick="return confirm('apakah anda yakin?')"><i class='fa fa-trash'></i>Hapus</a>
                                                        </td>
                                                    </tr>

                                                <?php
                                                }
                                                ?>	

                                                </tbody>
                                                </table>
                                
                                    <?php  
                                        }else{
                                            //if database table is empty
                                            //echo "Data tidak ditemukan";
                                        }
                                        $result->free();
                                        $mysqli->close();
                                    ?>
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