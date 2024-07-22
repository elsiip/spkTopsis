<?php 

    $server = "localhost";
    $user = "root";
    $pass = "admin";
    $database = "db_topsis";

    $mysqli = new mysqli($server, $user, $pass, $database);

    if (!$mysqli) {
        die("<script>alert('Connection Failed.')</script>");
    }

?>