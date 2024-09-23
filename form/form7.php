<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menyimpan data dari form6.php
    session_start();
    $_SESSION['stnk'] = $_POST['stnk'];
    $_SESSION['apar'] = $_POST['apar'];
    $_SESSION['p3k'] = $_POST['p3k'];
    $_SESSION['kunciRoda'] = $_POST['kunciRoda'];
    $_SESSION['airRadiator'] = $_POST['airRadiator'];
    $_SESSION['bahanBakar'] = $_POST['bahanBakar'];

    // Proses untuk menyimpan semua data ke database
    include 'config.php'; // Menghubungkan dengan file koneksi database

    $sql = "INSERT INTO checkup (
                nama_petugas, plat_mobil, hari, oliMesin, oliPowerSteering, 
                oliTransmisi, minyakRem, lampuUtama, lampuSein, lampuRem, 
                lampuKlakson, accu, kursi, lantai, dinding, kap,
                stnk, apar, p3k, kunciRoda, airRadiator, bahanBakar, oli
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";

    // Pastikan bahwa string tipe data memiliki jumlah karakter yang sesuai dengan jumlah parameter yang akan di-bind
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param(
            "sssssssssssssssssssssss",  // Sesuaikan jumlah 's' dengan jumlah parameter yang di-bind
            $_SESSION['nama_petugas'],
            $_SESSION['plat_mobil'],
            $_SESSION['hari'],
            $_SESSION['oliMesin'],
            $_SESSION['oliPowerSteering'],
            $_SESSION['oliTransmisi'],
            $_SESSION['minyakRem'],
            $_SESSION['lampuUtama'],
            $_SESSION['lampuSein'],
            $_SESSION['lampuRem'],
            $_SESSION['lampuKlakson'],
            $_SESSION['accu'],
            $_SESSION['kursi'],
            $_SESSION['lantai'],
            $_SESSION['dinding'],
            $_SESSION['kap'],
            $_SESSION['stnk'],
            $_SESSION['apar'],
            $_SESSION['p3k'],
            $_SESSION['kunciRoda'],
            $_SESSION['airRadiator'],
            $_SESSION['bahanBakar'],
            $_SESSION['oli']
        );

        if ($stmt->execute()) {
            echo "Data berhasil disimpan.";
        } else {
            echo "Gagal menyimpan data: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gagal menyiapkan statement: " . $conn->error;
    }

    $conn->close();
    session_destroy(); // Menghapus session setelah data disimpan
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form 7</title>
</head>
<body>

<h2>Terima Kasih</h2>
<p>Data telah berhasil dikirim. Terima kasih telah mengisi form check-up kendaraan.</p>
<a href="../index.html">isi lagi</a>

</body>
</html>
