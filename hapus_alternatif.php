<?php
    include 'koneksi.php';
    $id_alternatif = $_GET["id_alternatif"];
    //mengambil id yang ingin dihapus

    //jalankan query DELETE untuk menghapus data
    $query = "DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif'";
    $hasil_query = mysqli_query($mysqli, $query);

    //periksa query, apakah ada kesalahan
    if (!$hasil_query) {
        die("Gagal menghapus data: " . mysqli_errno($mysqli) .
            " - " . mysqli_error($mysqli));
    } else {
        echo "<script>
        alert('Data berhasil dihapus.');
        window.location = 'alternatif.php';
        </script>";
    }