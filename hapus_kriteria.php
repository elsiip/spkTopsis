<?php
    include 'koneksi.php';
    $id_kriteria = $_GET["id_kriteria"];
    //mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM kriteria WHERE id_kriteria = '$id_kriteria'";
    $hasil_query = mysqli_query($mysqli, $query);

    //periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($mysqli) .
            " - " . mysqli_error($mysqli));
    } else {
        echo "<script>
        alert('Data berhasil dihapus.');
        window.location = 'kriteria.php';
        </script>";
    }