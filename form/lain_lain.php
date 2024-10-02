<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menyimpan data dari form5.php
    $_SESSION['kursi'] = $_POST['kursi'];
    $_SESSION['lantai'] = $_POST['lantai'];
    $_SESSION['dinding'] = $_POST['dinding'];
    $_SESSION['kap'] = $_POST['kap'];
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lain - Lain</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <section>
        <div class="background-container">
            <!-- Background grid effect -->
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="container">
            <h1>Lain - Lain</h1>
            <form class="form" method="post" action="form7.php" enctype="multipart/form-data">
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
                    </div>
                </div>

                <!-- Bagian Kotak P3K -->
                <div class="fieldset-container">
                    <legend>Kotak P3K</legend>
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
                                <input type="radio" id="kunciRodaTidakBaik" name="kunciRoda" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
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
                                <input type="radio" id="airRadiatorTidakBaik" name="airRadiator" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bagian Bahan Bakar Kendaraan -->
                <div class="fieldset-container">
                    <legend>Bahan Bakar Kendaraan</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="bahanBakarBaik" name="bahanBakar" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="bahanBakarTidakBaik" name="bahanBakar" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bagian Upload File -->
                <div class="form-group">
                    <label for="laporanKondisi">Laporan Kondisi</label>
                    <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                    <input type="file" id="laporanKondisi" name="laporanKondisi[]" multiple
                        accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.pdf,.doc,.docx">
                </div>

                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>