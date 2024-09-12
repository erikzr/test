<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Oli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
            border: 1.5px solid #000; /* Menambahkan border hitam 1.5px */
            border-radius: 4px;
            padding: 10px;
            background-color: #fff; /* Memastikan latar belakang putih */
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="radio"] {
            margin-right: 10px;
        }
        .form-group input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        fieldset {
            border: none; /* Menghapus border dari fieldset */
            padding: 10px;
            margin-bottom: 15px;
            background-color: transparent; /* Membuat background transparan */
            text-align: center; /* Memusatkan teks di dalam fieldset */
        }
        legend {
            font-weight: bold;
            margin-bottom: 10px;
        }
        .form-group button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .radio-group {
            display: flex;
            flex-direction: column; /* Mengubah flex-direction agar label berjajar vertikal */
            gap: 10px; /* Jarak antara setiap label */
        }
        .radio-group label {
            display: flex;
            align-items: center;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: normal;
        }
        .radio-group input[type="radio"] {
            margin: 0;
        }
        .baik {
            background-color: #d4edda; /* Hijau muda untuk "Baik" */
            color: #155724; /* Warna teks hijau gelap */
        }
        .tidak-baik {
            background-color: #f8d7da; /* Merah muda untuk "Tidak Baik" */
            color: #721c24; /* Warna teks merah gelap */
        }
        .upload-box {
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            padding: 15px;
            margin-top: 15px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .upload-box p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pemeriksaan Oli</h1>
        <?php
        session_start(); // Lanjutkan sesi

        // Simpan data dari halaman sebelumnya
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['data']['nama_petugas'] = $_POST['nama_petugas'];
            $_SESSION['data']['plat_mobil'] = $_POST['plat_mobil'];
            $_SESSION['data']['hari'] = $_POST['hari'];
        }
        ?>

        <form method="post" action="form3.php">
                    <!-- Bagian Pemeriksaan Oli -->
                    <fieldset>
                <legend>Harap diperiksa secara berkala</legend>
                
                <div class="form-group">
                    <label>Oli Mesin</label>
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="oliMesinBaik" name="oliMesin" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="oliMesinTidakBaik" name="oliMesin" value="Tidak Baik" required>
                            Tidak Baik
                        </label>`
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Oli Power Steering</label>
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
                    <label>Oli Transmisi</label>
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
                    <label>Minyak Rem</label>
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
                
            </fieldset>

            <!-- Bagian Upload File -->
            <div class="upload-box">
                <div class="form-group">
                    <label for="laporanOli">Laporan Kecukupan Oli</label>
                    <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                    <input type="file" id="laporanOli" name="laporanOli[]" multiple accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.pdf,.doc,.docx">
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Kirim</button>
            </div>
        </form>


    </div>
</body>
</html>