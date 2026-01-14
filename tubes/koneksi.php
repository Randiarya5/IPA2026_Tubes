<?php
$host = "localhost";      
$user = "root";          
$password = "";           
$database = "pw2025_tubes_243040009";  

$koneksi = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
 