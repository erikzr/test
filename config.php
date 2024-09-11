<?php
// db.php
$servername = "localhost";
$username = "root"; // Sesuaikan jika ada username lain
$password = ""; // Sesuaikan jika ada password
$dbname = "checkup"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
