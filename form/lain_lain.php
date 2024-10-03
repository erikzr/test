<?php
session_start();

// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=checkcar', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if session data is set
    if (!isset($_SESSION['nama_petugas'], $_SESSION['plat_mobil'], $_SESSION['hari'])) {
        die("Data sesi belum diatur. Silakan kembali ke halaman sebelumnya.");
    }

    // Retrieve data from session
    $nama_petugas = $_SESSION['nama_petugas'];
    $plat_mobil = $_SESSION['plat_mobil'];
    $hari = $_SESSION['hari'];
    
    // Store 'lain-lain' data in session
    $_SESSION['stnk'] = $_POST['stnk'];
    $_SESSION['apar'] = $_POST['apar'];
    $_SESSION['p3k'] = $_POST['p3k'];
    $_SESSION['kunciRoda'] = $_POST['kunciRoda'];
    $_SESSION['airRadiator'] = $_POST['airRadiator'];
    $_SESSION['bahanBakar'] = $_POST['bahanBakar'];

    // Define upload directory
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    // Array to hold filenames for database insertion
    $filenames = [];

    // Validasi ukuran dan tipe file
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $maxFileSize = 10 * 1024 * 1024; // 10 MB

    // Handle file uploads for each category
    $uploadFields = [
        'laporanKondisi' => 'laporan_kondisi_filename',
        'stnk_filename' => 'stnk',
        'apar_filename' => 'apar',
        'p3k_filename' => 'p3k',
        'kunciRoda_filename' => 'kunciRoda',
        'airRadiator_filename' => 'airRadiator',
        'bahanBakar_filename' => 'bahanBakar',
    ];

    foreach ($uploadFields as $field => $dbField) {
        if (isset($_FILES[$field]) && $_FILES[$field]['error'][0] == 0) {
            foreach ($_FILES[$field]['tmp_name'] as $key => $tmpName) {
                $fileType = $_FILES[$field]['type'][$key];
                $fileSize = $_FILES[$field]['size'][$key];

                // Memeriksa tipe dan ukuran file
                if (!in_array($fileType, $allowedTypes) || $fileSize > $maxFileSize) {
                    die("File tidak valid: " . $_FILES[$field]['name'][$key]);
                }

                // Generate unique filename
                $filename = uniqid() . '_' . basename($_FILES[$field]['name'][$key]);
                $uploadFile = $uploadDir . $filename;

                // Move uploaded file
                if (!move_uploaded_file($tmpName, $uploadFile)) {
                    die("Gagal menyimpan file: " . $_FILES[$field]['name'][$key]);
                }
                $filenames[$dbField][] = $filename; // Store filename for database
            }
        }
    }

    // Prepare SQL statement to insert data into the database for checkup
    $stmtCheckup = $pdo->prepare('INSERT INTO checkup (nama_petugas, plat_mobil, hari, stnk, apar, p3k, kunciRoda, airRadiator, bahanBakar) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // Execute the checkup data insertion
    $stmtCheckup->execute([$nama_petugas, $plat_mobil, $hari, $_SESSION['stnk'], $_SESSION['apar'], $_SESSION['p3k'], $_SESSION['kunciRoda'], $_SESSION['airRadiator'], $_SESSION['bahanBakar']]);

    // Prepare SQL statement to insert photo data into the database
    $stmtPhotos = $pdo->prepare('INSERT INTO photos (nama_petugas, plat_mobil, hari, stnk_filename, apar_filename, p3k_filename, kunci_roda_filename, air_radiator_filename, bahan_bakar_filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // Convert the filenames array to a comma-separated string for each field
    $filenamesArray = [];
    foreach ($uploadFields as $dbField => $sessionField) {
        if (isset($filenames[$sessionField])) {
            $filenamesArray[] = implode(',', $filenames[$sessionField]);
        } else {
            $filenamesArray[] = null; // No files uploaded
        }
    }

    // Execute the photos data insertion
    $stmtPhotos->execute([$nama_petugas, $plat_mobil, $hari, $filenamesArray[1], $filenamesArray[2], $filenamesArray[3], $filenamesArray[4], $filenamesArray[5], $filenamesArray[6]]);

    // Hapus data sesi setelah menyimpan
    session_unset(); // Menghapus semua variabel sesi
    session_destroy(); // Menghancurkan sesi

    // Redirect to a confirmation or success page
    header('Location: ttd.php'); // Ganti dengan halaman tujuan Anda
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lain - Lain</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <section>
        <div class="container">
            <h1>Lain - Lain</h1>
            <form class="form" method="post" action="" enctype="multipart/form-data">
                <!-- Bagian STNK -->
                <div class="fieldset-container">
                    <legend>STNK</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="stnkBaik" name="stnk" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="stnkTidakBaik" name="stnk" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                        <label for="stnk_filename">Upload STNK:</label>
                        <input type="file" name="stnk_filename[]" id="stnk_filename" multiple>
                    </div>
                </div>

                <!-- Bagian Apar -->
                <div class="fieldset-container">
                    <legend>Apar</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="aparBaik" name="apar" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="aparTidakBaik" name="apar" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                        <label for="apar_filename">Upload Apar:</label>
                        <input type="file" name="apar_filename[]" id="apar_filename" multiple>
                    </div>
                </div>

                <!-- Bagian P3K -->
                <div class="fieldset-container">
                    <legend>P3K</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="p3kBaik" name="p3k" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="p3kTidakBaik" name="p3k" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                        <label for="p3k_filename">Upload P3K:</label>
                        <input type="file" name="p3k_filename[]" id="p3k_filename" multiple>
                    </div>
                </div>

                <!-- Bagian Kunci Roda -->
                <div class="fieldset-container">
                    <legend>Kunci Roda</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="kunciRodaBaik" name="kunciRoda" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="kunciRodaTidakBaik" name="kunciRoda" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                        <label for="kunci_roda_filename">Upload Kunci Roda:</label>
                        <input type="file" name="kunci_roda_filename[]" id="kunci_roda_filename" multiple>
                    </div>
                </div>

                <!-- Bagian Air Radiator -->
                <div class="fieldset-container">
                    <legend>Air Radiator</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="airRadiatorBaik" name="airRadiator" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="airRadiatorTidakBaik" name="airRadiator" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                        <label for="air_radiator_filename">Upload Air Radiator:</label>
                        <input type="file" name="air_radiator_filename[]" id="air_radiator_filename" multiple>
                    </div>
                </div>

                <!-- Bagian Bahan Bakar -->
                <div class="fieldset-container">
                    <legend>Bahan Bakar</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="bahanBakarBaik" name="bahanBakar" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="bahanBakarTidakBaik" name="bahanBakar" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                        <label for="bahan_bakar_filename">Upload Bahan Bakar:</label>
                        <input type="file" name="bahan_bakar_filename[]" id="bahan_bakar_filename" multiple>
                    </div>
                </div>

                <input type="submit" value="Simpan Data">
            </form>
        </div>
    </section>
</body>
</html>
