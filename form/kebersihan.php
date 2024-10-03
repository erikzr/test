<?php
session_start();

// Cek apakah session ada
if (!isset($_SESSION['nama_petugas'], $_SESSION['plat_mobil'], $_SESSION['hari'])) {
    die("Data tidak lengkap. Silakan kembali ke halaman sebelumnya.");
}

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

    // Mengambil data kebersihan
    $kursi_status = $_POST['kursi'];
    $lantai_status = $_POST['lantai'];
    $dinding_status = $_POST['dinding'];
    $kap_status = $_POST['kap'];

    // Define upload directory
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    // Array untuk menyimpan filenames untuk penyimpanan ke database
    $filenames = [
        'kursi' => [],
        'lantai' => [],
        'dinding' => [],
        'kap' => []
    ];

    // Proses upload file untuk kebersihan
    foreach (['kursi', 'lantai', 'dinding', 'kap'] as $key) {
        if (isset($_FILES[$key . 'FileUpload']) && $_FILES[$key . 'FileUpload']['error'][0] == 0) {
            foreach ($_FILES[$key . 'FileUpload']['tmp_name'] as $fileKey => $tmpName) {
                $filename = uniqid() . '_' . basename($_FILES[$key . 'FileUpload']['name'][$fileKey]); // Generate unique filename
                $uploadFile = $uploadDir . $filename;

                // Move uploaded file to the designated directory
                if (move_uploaded_file($tmpName, $uploadFile)) {
                    $filenames[$key][] = $filename; // Store filename for database
                } else {
                    die("Failed to save the file: " . $_FILES[$key . 'FileUpload']['name'][$fileKey]);
                }
            }
        }
    }

    // Siapkan SQL statement untuk menyimpan data ke database
    $stmtCheckup = $pdo->prepare('INSERT INTO checkup (nama_petugas, plat_mobil, hari, kursi, lantai, dinding, kap) VALUES (?, ?, ?, ?, ?, ?, ?)');
    
    // Eksekusi penyimpanan data pemeriksaan
    $stmtCheckup->execute([$nama_petugas, $plat_mobil, $hari, $kursi_status, $lantai_status, $dinding_status, $kap_status]);

    // Siapkan SQL statement untuk menyimpan data foto ke database
    $stmtPhotos = $pdo->prepare('INSERT INTO photos (nama_petugas, plat_mobil, hari, kursi_filename, lantai_filename, dinding_filename, kap_filename) VALUES (?, ?, ?, ?, ?, ?, ?)');

    // Ubah array filename menjadi string yang dipisahkan koma
    $kursiFilenamesString = implode(',', $filenames['kursi']);
    $lantaiFilenamesString = implode(',', $filenames['lantai']);
    $dindingFilenamesString = implode(',', $filenames['dinding']);
    $kapFilenamesString = implode(',', $filenames['kap']);

    // Eksekusi penyimpanan data foto
    $stmtPhotos->execute([$nama_petugas, $plat_mobil, $hari, $kursiFilenamesString, $lantaiFilenamesString, $dindingFilenamesString, $kapFilenamesString]);

    // Redirect ke halaman berikutnya (lain_lain)
    header('Location: lain_lain.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebersihan Interior & Eksterior</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <section>
        <div class="container">
            <h1>Kebersihan Interior & Eksterior</h1>
            <form class="form" method="post" action="" enctype="multipart/form-data">
                <!-- Bagian Kebersihan Kursi -->
                <div class="fieldset-container">
                    <legend>Kebersihan Kursi</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="kursiBaik" name="kursi" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="kursiTidakBaik" name="kursi" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend>Laporan Kebersihan</legend>
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                        <input type="file" id="kursiFileUpload" name="kursiFileUpload[]" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                    </div>
                </div>

                <!-- Bagian Kebersihan Lantai -->
                <div class="fieldset-container">
                    <legend>Kebersihan Lantai</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="lantaiBaik" name="lantai" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="lantaiTidakBaik" name="lantai" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend>Laporan Kebersihan</legend>
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                        <input type="file" id="lantaiFileUpload" name="lantaiFileUpload[]" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                    </div>
                </div>

                <!-- Bagian Kebersihan Dinding -->
                <div class="fieldset-container">
                    <legend>Kebersihan Dinding</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="dindingBaik" name="dinding" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="dindingTidakBaik" name="dinding" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend>Laporan Kebersihan</legend>
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                        <input type="file" id="dindingFileUpload" name="dindingFileUpload[]" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                    </div>
                </div>

                <!-- Bagian Kebersihan Kap -->
                <div class="fieldset-container">
                    <legend>Kebersihan Kap</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="kapBaik" name="kap" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="kapTidakBaik" name="kap" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <legend>Laporan Kebersihan</legend>
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                        <input type="file" id="kapFileUpload" name="kapFileUpload[]" accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                    </div>
                </div>

                <input type="submit" value="Selanjutnya">
            </form>
        </div>
    </section>
</body>
</html>
