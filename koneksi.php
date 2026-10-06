<?php
$conn = mysqli_connect("localhost", "root", "", "belajar_login");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
