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

    // Menyimpan status lampu ke session
    $_SESSION['lampuUtama'] = $_POST['lampuUtama'];
    $_SESSION['lampuSein'] = $_POST['lampuSein'];
    $_SESSION['lampuRem'] = $_POST['lampuRem'];
    $_SESSION['lampuKlakson'] = $_POST['lampuKlakson'];

    // Mendefinisikan direktori upload
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Membuat direktori jika tidak ada
    }

    // Array untuk menyimpan nama file untuk penyimpanan di database
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
    handleFileUpload('laporanLampuUtama', $filenames, $uploadDir);
    handleFileUpload('laporanLampuSein', $filenames, $uploadDir);
    handleFileUpload('laporanLampuRem', $filenames, $uploadDir);
    handleFileUpload('laporanLampuKlakson', $filenames, $uploadDir);

    // Menyiapkan pernyataan SQL untuk menyisipkan data ke dalam tabel checkup
    $stmtCheckup = $pdo->prepare('INSERT INTO checkup (nama_petugas, plat_mobil, hari, 
        lampuUtama, lampuSein, lampuRem, lampuKlakson) 
        VALUES (?, ?, ?, ?, ?, ?, ?)');

    // Menjalankan penyisipan data pemeriksaan
    $stmtCheckup->execute([$nama_petugas, $plat_mobil, $hari, 
        $_SESSION['lampuUtama'], 
        $_SESSION['lampuSein'], 
        $_SESSION['lampuRem'], 
        $_SESSION['lampuKlakson']]);

    // Menyiapkan pernyataan SQL untuk menyisipkan data foto ke dalam tabel photos
    $stmtPhotos = $pdo->prepare('INSERT INTO photos (nama_petugas, plat_mobil, hari, 
        lampu_utama_filename, lampu_sein_filename, lampu_rem_filename, lampu_klakson_filename) 
        VALUES (?, ?, ?, ?, ?, ?, ?)');

    // Menjalankan penyisipan data foto
    $stmtPhotos->execute([$nama_petugas, $plat_mobil, $hari, 
        $filenames['laporanLampuUtama'], 
        $filenames['laporanLampuSein'], 
        $filenames['laporanLampuRem'], 
        $filenames['laporanLampuKlakson']]);

    // Redirect ke halaman selanjutnya (pemeriksaan aki)
    header('Location: checkup_aki.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Penerangan Kendaraan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <section>
        <div class="container">
            <h1>Pemeriksaan Penerangan</h1>
            <form class="form" method="post" action="" enctype="multipart/form-data">
                <!-- Bagian untuk lampu utama -->
                <div class="fieldset-container">
                    <legend>Lampu Utama</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="lampuUtama" value="Baik" required> Baik
                            </label>
                            <label>
                                <input type="radio" name="lampuUtama" value="Tidak Baik" required> Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="laporanLampuUtama">Laporan Kecukupan Lampu Utama</label>
                        <input type="file" id="laporanLampuUtama" name="laporanLampuUtama" accept="image/*" required>
                    </div>
                </div>

                <!-- Bagian untuk lampu sein -->
                <div class="fieldset-container">
                    <legend>Lampu Sein</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="lampuSein" value="Baik" required> Baik
                            </label>
                            <label>
                                <input type="radio" name="lampuSein" value="Tidak Baik" required> Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="laporanLampuSein">Laporan Kecukupan Lampu Sein</label>
                        <input type="file" id="laporanLampuSein" name="laporanLampuSein" accept="image/*" required>
                    </div>
                </div>

                <!-- Bagian untuk lampu rem -->
                <div class="fieldset-container">
                    <legend>Lampu Rem</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="lampuRem" value="Baik" required> Baik
                            </label>
                            <label>
                                <input type="radio" name="lampuRem" value="Tidak Baik" required> Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="laporanLampuRem">Laporan Kecukupan Lampu Rem</label>
                        <input type="file" id="laporanLampuRem" name="laporanLampuRem" accept="image/*" required>
                    </div>
                </div>

                <!-- Bagian untuk lampu klakson -->
                <div class="fieldset-container">
                    <legend>Lampu Klakson</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" name="lampuKlakson" value="Baik" required> Baik
                            </label>
                            <label>
                                <input type="radio" name="lampuKlakson" value="Tidak Baik" required> Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="laporanLampuKlakson">Laporan Kecukupan Lampu Klakson</label>
                        <input type="file" id="laporanLampuKlakson" name="laporanLampuKlakson" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
