<?php
    include 'koneksi.php';
    $id_sampel = $_GET["id_sampel"];
    //mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM sampel WHERE id_sampel = '$id_sampel'";
    $hasil_query = mysqli_query($mysqli, $query);

    //periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($mysqli) .
            " - " . mysqli_error($mysqli));
    } else {
        echo "<script>
        alert('Data berhasil dihapus.');
        window.location = 'matriks.php';
        </script>";
    }
?>