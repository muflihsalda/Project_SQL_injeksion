<?php
$conn = mysqli_connect("localhost", "root", "", "keamanan_web");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>