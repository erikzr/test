<?php
session_start(); // Mulai sesi

// Koneksi database
try {
    $pdo = new PDO('mysql:host=localhost;dbname=checkcar', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form
    $nama_petugas = $_POST['nama_petugas'];
    $plat_mobil = $_POST['plat_mobil'];
    $hari = $_POST['hari'];

    // Proses file yang diunggah (foto dari input file)
    if (isset($_FILES['kamera']) && $_FILES['kamera']['error'] == 0) {
        $fileTmpPath = $_FILES['kamera']['tmp_name'];
        $fileName = $_FILES['kamera']['name'];
        $fileSize = $_FILES['kamera']['size'];
        $fileType = $_FILES['kamera']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Ekstensi yang diizinkan
        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Tentukan lokasi penyimpanan
            $uploadFileDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true); // Buat folder jika belum ada
            }

            // Buat nama file unik dan simpan file
            $newFileName = uniqid() . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Masukkan data ke database
                $stmt = $pdo->prepare('INSERT INTO photos (nama_petugas, plat_mobil, hari, photo_filename) VALUES (?, ?, ?, ?)');
                $stmt->execute([$nama_petugas, $plat_mobil, $hari, $newFileName]);

                // Set data ke sesi jika diperlukan di halaman berikutnya
                $_SESSION['nama_petugas'] = $nama_petugas;
                $_SESSION['plat_mobil'] = $plat_mobil;
                $_SESSION['hari'] = $hari;

                // Redirect ke halaman checkup_oli.php
                header("Location: checkup_oli.php");
                exit(); // Pastikan tidak ada kode yang dieksekusi setelah ini
            } else {
                echo "Terjadi kesalahan saat mengunggah file.";
            }
        } else {
            echo "Ekstensi file tidak diperbolehkan. Unggah file dengan ekstensi .jpg, .jpeg, atau .png.";
        }
    } else {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link rel="stylesheet" href="driver.css">
</head>
<body>
    <section>
        <div class="container">
            <h1>Driver</h1>

            <form class="form" method="post" action="driver.php" enctype="multipart/form-data">
                <h2>Data Pribadi</h2>
                <label for="nama_petugas">Nama Petugas:</label>
                <input class="kotak" type="text" id="nama_petugas" name="nama_petugas" placeholder="nama lengkap" required><br><br>
                
                <div class="form-group">
                    <label>Plat Mobil:</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" id="plat_mobil_inova" name="plat_mobil" value="W 1740 NP ( Inova Lama )" required>
                            W 1740 NP ( Inova Lama )
                        </label>
                        <label>
                            <input type="radio" id="plat_mobil_reborn" name="plat_mobil" value="W 1507 NP ( Reborn )" required>
                            W 1507 NP ( Reborn )
                        </label>
                        <label>
                            <input type="radio" id="plat_mobil_kapsul" name="plat_mobil" value="W 1374 NP ( Kijang Kapsul )" required>
                            W 1374 NP ( Kijang Kapsul )
                        </label>
                    </div>
                </div>

                <label for="hari">Hari:</label>
                <input class="kotak" type="date" id="hari" name="hari" required><br><br>

                <label for="kamera">FOTO MOBIL TAMPAK DEPAN</label>
                <input type="file" id="kamera" name="kamera" accept="image/*" capture="environment" required onchange="previewImage(event)">
                <br><br>

                <!-- Area untuk menampilkan pratinjau gambar -->
                <img id="preview" src="" alt="Pratinjau Gambar" style="display:none; max-width: 300px;">
                <p id="timestamp" style="display:none;"></p> <!-- Timestamp akan ditampilkan di sini -->

                <input type="submit" value="Lanjutkan">
            </form>
        </div>
    </section>

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';

                // Menampilkan timestamp dengan format 24 jam
                var timestamp = document.getElementById('timestamp');
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0'); // Format 24 jam
                var minutes = now.getMinutes().toString().padStart(2, '0');
                var seconds = now.getSeconds().toString().padStart(2, '0');
                var formattedTime = hours + ':' + minutes + ':' + seconds;
                var formattedDate = now.toLocaleDateString('id-ID'); // Format tanggal lokal Indonesia
                timestamp.textContent = 'Foto diambil pada: ' + formattedDate + ' ' + formattedTime;
                timestamp.style.display = 'block';
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>

