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
    
    // Menyimpan status ACCU ke session
    $_SESSION['accu'] = $_POST['accu'];

    // Mendefinisikan direktori upload
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Membuat direktori jika tidak ada
    }

    // Array untuk menyimpan nama file untuk penyimpanan di database
    $filenames = [];

    // Menangani upload file untuk ACCU
    if (isset($_FILES['laporanAccu']) && $_FILES['laporanAccu']['error'][0] == 0) {
        foreach ($_FILES['laporanAccu']['tmp_name'] as $key => $tmpName) {
            $filename = uniqid() . '_' . basename($_FILES['laporanAccu']['name'][$key]); // Menghasilkan nama file unik
            $uploadFile = $uploadDir . $filename;

            // Memindahkan file yang diupload ke direktori yang ditentukan
            if (move_uploaded_file($tmpName, $uploadFile)) {
                $filenames[] = $filename; // Menyimpan nama file untuk database
            } else {
                die("Gagal menyimpan file: " . $_FILES['laporanAccu']['name'][$key]);
            }
        }
    }

    // Menyiapkan pernyataan SQL untuk menyisipkan data ke dalam tabel checkup
    $stmtCheckup = $pdo->prepare('INSERT INTO checkup (nama_petugas, plat_mobil, hari, accu) VALUES (?, ?, ?, ?)');

    // Menjalankan penyisipan data pemeriksaan
    $stmtCheckup->execute([$nama_petugas, $plat_mobil, $hari, $_SESSION['accu']]);

    // Menyiapkan pernyataan SQL untuk menyisipkan data foto ke dalam tabel photos
    $stmtPhotos = $pdo->prepare('INSERT INTO photos (nama_petugas, plat_mobil, hari, accu_filename) VALUES (?, ?, ?, ?)');

    // Mengonversi array nama file menjadi string yang dipisahkan dengan koma
    $filenamesString = implode(',', $filenames);

    // Menjalankan penyisipan data foto
    $stmtPhotos->execute([$nama_petugas, $plat_mobil, $hari, $filenamesString]);

    // Redirect ke halaman selanjutnya (pemeriksaan kebersihan)
    header('Location: kebersihan.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan ACCU</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <section>
        <div class="container">
            <h1>Laporan ACCU</h1>
            <form class="form" method="post" action="" enctype="multipart/form-data">
                <!-- Bagian Cek Tegangan Aki -->
                <div class="fieldset-container">
                    <legend>Cek Tegangan Aki (Min. 12 Volt)</legend>
                    <div class="form-group">
                        <label>ACCU</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="accuBaik" name="accu" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="accuTidakBaik" name="accu" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="laporanAccu">Laporan ACCU</label>
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                        <input type="file" id="laporanAccu" name="laporanAccu[]" multiple accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.pdf,.doc,.docx">
                    </div>
                </div>

                <!-- Bagian Upload File -->


                <!-- Tombol Kirim -->
                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
