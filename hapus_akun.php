<?php
    include 'koneksi.php';
    $id = $_GET["id"];
    //mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM users WHERE id = '$id'";
    $hasil_query = mysqli_query($mysqli, $query);

    //periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($mysqli) .
            " - " . mysqli_error($mysqli));
    } else {
        echo "<script>
        alert('Data berhasil dihapus.');
        window.location = 'akun.php';
        </script>";
    }
?>