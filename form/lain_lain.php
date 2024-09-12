<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD:form/lain_lain.html
    <title>Laporan Kendaraan</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
=======
    <title>Pemeriksaan Penerangan Kendaraan</title>
>>>>>>> 0b05ceb88e76bd276960558e8a180c4ce7318908:form/lain_lain.php
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        section {
            position: relative;
            min-height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
        }

        .background-container {
            position: absolute;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            grid-template-rows: repeat(auto-fill, minmax(60px, 1fr));
            gap: 2px;
            z-index: 1;
        }

        .background-container span {
            background: #181818;
            aspect-ratio: 1;
            width: 100%;
            height: 100%;
            transition: 1.5s;
        }

        .background-container span:hover {
            background: #0f0;
            transition: 0s;
        }

        section::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(#000, #0f0, #000);
            animation: animate 5s linear infinite;
        }

        @keyframes animate {
            0% {
                transform: translateY(-100%);
            }

            100% {
                transform: translateY(100%);
            }
        }
        .container {
            position: relative;
            background: #fffcfc;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
            max-width: 600px;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }
        h1 {
            color: #0f0;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form {
            background: #b8b2b2;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
        }

        .fieldset-container {
            border: 2px solid #000;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            position: relative;
            background: #b8b2b2;
        }

        .fieldset-container legend {
            font-weight: 600;
            color: #000;
            padding: 0 10px;
            position: absolute;
            top: -10px;
            left: 10px;
            background: #fffcfc;
            border: 1px solid #000;
            border-radius: 5px;
            padding: 0 5px;
        }
        .form-group {
            border: 1px solid #000;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            color: #000;
            margin-bottom: 5px;
<<<<<<< HEAD:form/lain_lain.html
=======
            font-weight: bold;
        }
        .form-group input[type="radio"] {
            margin-right: 10px;
        }
        fieldset {
            border: 1.5px solid #0e0e0e; /* Menebalkan garis */
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
            background-color: transparent; /* Membuat background transparan */
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
>>>>>>> 0b05ceb88e76bd276960558e8a180c4ce7318908:form/lain_lain.php
        }
        .radio-group {
            display: flex;
<<<<<<< HEAD:form/lain_lain.html
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
=======
            align-items: center;
            gap: 20px;
>>>>>>> 0b05ceb88e76bd276960558e8a180c4ce7318908:form/lain_lain.php
        }
        .radio-group label {
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
            font-weight: normal;
        }
        .radio-group input[type="radio"] {
            margin-right: 5px;
        }
<<<<<<< HEAD:form/lain_lain.html

        .radio-group label:hover {
            background: #dcdcdc;
        }

        input[type="file"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 0.5px solid #555;
            border-radius: 4px;
            background: #333;
            color: #fff;
            font-size: 1em;
            box-sizing: border-box;
        }

        button {
            background: #0f0;
            color: #000;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            width: 25%;
            transition: opacity 0.3s ease;
        }

        button:hover {
            opacity: 0.8;
        }

        @media (max-width: 900px) {
            .background-container span {
                width: 100%;
                height: 100%;
            }
        }

        @media (max-width: 600px) {
            .background-container span {
                width: 100%;
                height: 100%;
            }
        }
=======
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
            box-shadow: 0 0 5px rgb(0, 0, 0);
        }
        .upload-box p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #555;
        }
        .upload-box input[type="file"] {
            display: block;
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
>>>>>>> 0b05ceb88e76bd276960558e8a180c4ce7318908:form/lain_lain.php
    </style>
</head>
<body>
<<<<<<< HEAD:form/lain_lain.html
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
            <h1>Laporan Kendaraan</h1>
            <form class="form" method="post" action="form3.php">
                <!-- Bagian Lain - Lain -->
                <div class="fieldset-container">
                    <legend>Lain - Lain</legend>
                    <!-- STNK masih berlaku -->
                    <div class="form-group">
                        <label>STNK masih berlaku</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="stnkBaik" name="stnk" value="Baik" required>
                                Baik ( Masih Berlaku )
                            </label>
                            <label>
                                <input type="radio" id="stnkTidakBaik" name="stnk" value="Tidak Baik" required>
                                Tidak Baik ( Expired )
                            </label>
                        </div>
                    </div>

                    <!-- Apar -->
                    <div class="form-group">
                        <label>Apar</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="aparBaik" name="apar" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="aparTidakBaik" name="apar" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>

                    <!-- Kotak P3K -->
                    <div class="form-group">
                        <label>Kotak P3K</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="p3kBaik" name="p3k" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="p3kTidakBaik" name="p3k" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>

                    <!-- Kunci Roda -->
                    <div class="form-group">
                        <label>Kunci Roda</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="kunciRodaBaik" name="kunciRoda" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="kunciRodaTidakBaik" name="kunciRoda" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>

                    <!-- Air Radiator -->
                    <div class="form-group">
                        <label>Air Radiator</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="airRadiatorBaik" name="airRadiator" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="airRadiatorTidakBaik" name="airRadiator" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>

                    <!-- Cek Bahan Bakar Kendaraan -->
                    <div class="form-group">
                        <label>Cek Bahan Bakar Kendaraan</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="bahanBakarBaik" name="bahanBakar" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="bahanBakarTidakBaik" name="bahanBakar" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>

                    <!-- Cek Oli Kendaraan -->
                    <div class="form-group">
                        <label>Cek Oli Kendaraan</label>
                        <div class="radio-group">
                            <label>
                                <input type="radio" id="oliBaik" name="oli" value="Baik" required>
                                Baik
                            </label>
                            <label>
                                <input type="radio" id="oliTidakBaik" name="oli" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>

                    <!-- Bagian Upload File -->
                    <div class="form-group">
                        <label for="fileUpload">Laporan Kebersihan</label>
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                        <input type="file" id="fileUpload" name="fileUpload[]"
                            accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
=======
    <div class="container">
        <h1>Kondisi Penerangan Kendaraan</h1>
        <p>Harap diperiksa secara berkala dan berfungsi semestinya.</p>

        <?php
        session_start(); // Lanjutkan sesi

        // Simpan data dari halaman sebelumnya
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_SESSION['data']['oli_mesin'] = $_POST['oli_mesin'];
            $_SESSION['data']['oli_power_stering'] = $_POST['oli_power_stering'];
            $_SESSION['data']['oli_transmisi'] = $_POST['oli_transmisi'];
            $_SESSION['data']['oli_rem'] = $_POST['oli_rem'];
        }
        ?>

        <!-- Form Baru: Lain-lain -->
        <form method="post" action="process_form.php">
            <fieldset>
                <legend>Lain - Lain</legend>
                
                <!-- STNK masih berlaku -->
                <div class="form-group">
                    <label>STNK masih berlaku</label>
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="stnkBaik" name="stnk" value="Baik" required>
                            Baik ( Masih Berlaku )
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="stnkTidakBaik" name="stnk" value="Tidak Baik" required>
                            Tidak Baik ( Expired )
                        </label>
                    </div>
                </div>
                
                <!-- Apar -->
                <div class="form-group">
                    <label>Apar</label>
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

                <!-- Kotak P3K -->
                <div class="form-group">
                    <label>Kotak P3K</label>
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

                <!-- Kunci Roda -->
                <div class="form-group">
                    <label>Kunci Roda</label>
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
                </div>

                <!-- Air Radiator -->
                <div class="form-group">
                    <label>Air Radiator</label>
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
                </div>

                <!-- Cek Bahan Bakar Kendaraan -->
                <div class="form-group">
                    <label>Cek Bahan Bakar Kendaraan</label>
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
                </div>

                <!-- Cek Tekanan Angin dan Kondisi Ban -->
                <div class="form-group">
                    <label>Cek Tekanan Angin dan Kondisi Ban</label>
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="banBaik" name="ban" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="banTidakBaik" name="ban" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                    </div>
                </div>

                <!-- Kondisi Rem/Handrem -->
                <div class="form-group">
                    <label>Kondisi Rem/Handrem</label>
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="remBaik" name="rem" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="remTidakBaik" name="rem" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                    </div>
                </div>
            </fieldset>
            
            <!-- Bagian Upload File -->
            <div class="upload-box">
                <div class="form-group">
                    <label for="laporanPenerangan">Laporan Kondisi Penerangan *</label>
                    <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                    <input type="file" id="laporanPenerangan" name="laporanPenerangan[]" multiple accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.pdf,.doc,.docx">
                </div>
            </div>

            <!-- Tombol Kirim -->
            <div class="form-group">
                <button type="submit">Kirim</button>
            </div>
        </form>

        <!-- Form 6: Pemeriksaan Penerangan Kendaraan -->
        <form method="post" action="checkup_aki.php">
            <fieldset>
                <legend>Lampu Utama</legend>
                <div class="form-group">
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="lampuUtamaBaik" name="lampu_utama" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="lampuUtamaTidakBaik" name="lampu_utama" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Lampu Sein</legend>
                <div class="form-group">
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="lampuSeinBaik" name="lampu_sen" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="lampuSeinTidakBaik" name="lampu_sen" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Lampu Rem</legend>
                <div class="form-group">
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="lampuRemBaik" name="lampu_rem" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="lampuRemTidakBaik" name="lampu_rem" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Lampu, Klakson & Pendukung lainnya</legend>
                <div class="form-group">
                    <div class="radio-group">
                        <label class="baik">
                            <input type="radio" id="lampuKlaksonBaik" name="klakson" value="Baik" required>
                            Baik
                        </label>
                        <label class="tidak-baik">
                            <input type="radio" id="lampuKlaksonTidakBaik" name="klakson" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                    </div>
                </div>
            </fieldset>

            <!-- Bagian Upload File -->
            <div class="upload-box">
                <div class="form-group">
                    <label for="laporanPenerangan">Laporan Kondisi Penerangan *</label>
                    <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                    <input type="file" id="laporanPenerangan" name="laporanPenerangan[]" multiple accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.pdf,.doc,.docx">
                </div>
            </div>

            <!-- Tombol Kirim -->
            <div class="form-group">
                <button type="submit">Kirim</button>
            </div>
        </form>
    </div>
>>>>>>> 0b05ceb88e76bd276960558e8a180c4ce7318908:form/lain_lain.php
</body>
</html>
