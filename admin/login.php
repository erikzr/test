<?php
session_start(); // Mulai sesi untuk menyimpan informasi pengguna

$servername = "localhost"; // Ubah dengan server database Anda
$username = "root"; // Ubah dengan username database Anda
$password = ""; // Ubah dengan password database Anda
$dbname = "checkcar"; // Ubah dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputPassword = $_POST['password'];

    // Mengambil data pengguna dari database
    $sql = "SELECT password FROM users WHERE username = 'admin'"; // Ganti 'user1' dengan username yang sesuai
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mengambil data password yang tersimpan
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        // Memverifikasi password
        if (password_verify($inputPassword, $hashedPassword)) {
            // Password benar, lanjutkan ke halaman berikutnya
            $_SESSION['username'] = 'admin'; // Simpan username ke dalam session
            header("Location: dashboard.php"); // Ganti dengan halaman yang ingin diakses setelah login
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Pengguna tidak ditemukan!";
    }
}

$conn->close();
?>
