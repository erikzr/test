<?php
session_start();

// Koneksi ke database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=checkcar', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari session
    $nama_petugas = $_SESSION['nama_petugas'];
    $plat_mobil = $_SESSION['plat_mobil'];
    $hari = $_SESSION['hari'];

    // Mendefinisikan direktori upload
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Membuat direktori jika tidak ada
    }

    // Array untuk menyimpan nama file untuk disimpan di database
    $filenames = [];

    // Fungsi untuk menangani upload file
    function handleFileUpload($fileInputName, &$filenames, $uploadDir) {
        if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] == 0) {
            $filename = uniqid() . '.png'; // Menghasilkan nama file unik
            $uploadFile = $uploadDir . $filename;

            // Memindahkan file yang diupload ke direktori yang ditentukan
            if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $uploadFile)) {
                $filenames[$fileInputName] = $filename; // Menyimpan nama file untuk database
            } else {
                die("Gagal menyimpan file: " . $_FILES[$fileInputName]['name']);
            }
        }
    }

    // Menangani setiap upload file
    handleFileUpload('oli_mesin_file', $filenames, $uploadDir);
    handleFileUpload('oli_power_steering_file', $filenames, $uploadDir);
    handleFileUpload('oli_transmisi_file', $filenames, $uploadDir);
    handleFileUpload('minyak_rem_file', $filenames, $uploadDir);

    // Menyiapkan pernyataan SQL untuk menyisipkan data ke dalam tabel checkup
    $stmtCheckup = $pdo->prepare('INSERT INTO checkup (
        nama_petugas, plat_mobil, hari, 
        oliMesin, oliPowerSteering, oliTransmisi, minyakRem
    ) VALUES (?, ?, ?, ?, ?, ?, ?)');

    // Mengambil status dari tombol radio
    $oli_mesin_status = $_POST['oliMesin'];
    $oli_power_steering_status = $_POST['oliPowerSteering'];
    $oli_transmisi_status = $_POST['oliTransmisi'];
    $minyak_rem_status = $_POST['minyakRem'];

    // Menjalankan penyisipan data pemeriksaan
    $stmtCheckup->execute([$nama_petugas, $plat_mobil, $hari, 
        $oli_mesin_status, 
        $oli_power_steering_status, 
        $oli_transmisi_status, 
        $minyak_rem_status]);

    // Menyiapkan pernyataan SQL untuk menyisipkan data foto ke dalam tabel photos
    $stmtPhotos = $pdo->prepare('INSERT INTO photos (
        nama_petugas, plat_mobil, hari, 
        oli_mesin_filename, oli_power_steering_filename, oli_transmisi_filename, minyak_rem_filename
    ) VALUES (?, ?, ?, ?, ?, ?, ?)');

    // Menjalankan penyisipan data foto
    $stmtPhotos->execute([$nama_petugas, $plat_mobil, $hari, 
        $filenames['oli_mesin_file'], 
        $filenames['oli_power_steering_file'], 
        $filenames['oli_transmisi_file'], 
        $filenames['minyak_rem_file']]);

    // Redirect ke halaman selanjutnya (pemeriksaan lampu)
    header('Location: checkup_lampu.php');
    exit(); // Memastikan bahwa skrip berhenti setelah pengalihan
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Oli</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <section>
        <div class="container">
            <h1>Pemeriksaan Oli</h1>
            <form class="form" method="post" action="" enctype="multipart/form-data">
                <!-- Bagian Pemeriksaan Oli -->
                <div class="fieldset-container">
                    <legend>Oli Mesin</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="oliMesinBaik" name="oliMesin" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="oliMesinTidakBaik" name="oliMesin" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oli_mesin_file">Upload Laporan Kecukupan Oli Mesin</label>
                        <input type="file" id="oli_mesin_file" name="oli_mesin_file" accept="image/*" required>
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Oli Power Steering</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="oliPowerBaik" name="oliPowerSteering" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="oliPowerTidakBaik" name="oliPowerSteering" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oli_power_steering_file">Upload Laporan Kecukupan Oli Power Steering</label>
                        <input type="file" id="oli_power_steering_file" name="oli_power_steering_file" accept="image/*" required>
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Oli Transmisi</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="oliTransmisiBaik" name="oliTransmisi" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="oliTransmisiTidakBaik" name="oliTransmisi" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oli_transmisi_file">Upload Laporan Kecukupan Oli Transmisi</label>
                        <input type="file" id="oli_transmisi_file" name="oli_transmisi_file" accept="image/*" required>
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Minyak Rem</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="minyakRemBaik" name="minyakRem" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="minyakRemTidakBaik" name="minyakRem" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="minyak_rem_file">Upload Laporan Kecukupan Minyak Rem</label>
                        <input type="file" id="minyak_rem_file" name="minyak_rem_file" accept="image/*" required>
                    </div>
                </div>

                <!-- Bagian Upload File -->
                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
