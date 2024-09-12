<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Penerangan Kendaraan</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
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
            max-width: 400px;
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
        }

        h1 {
            color: #0f0;
            margin-bottom: 20px;
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
        }

        input[type="radio"] {
            margin-right: 10px;
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
    </style>
</head>

<body>
<<<<<<< HEAD:form/checkup_lampu.html
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
        <form method="post" action="checkup_aki.php">
        <!-- Bagian Lampu Utama -->
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
            
            <!-- Bagian Lampu Sein -->
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
            
            <!-- Bagian Lampu Rem -->
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
            
            <!-- Bagian Lampu, Klakson & Pendukung lainnya -->
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
>>>>>>> 0b05ceb88e76bd276960558e8a180c4ce7318908:form/checkup_lampu.php

            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
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
            <h1>Pemeriksaan Penerangan</h1>
            <form class="form" method="post" action="form3.php">
                <!-- Bagian Lampu Utama -->
                <div class="fieldset-container">
                    <legend>Lampu Utama</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="lampuUtamaBaik" name="lampuUtama" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="lampuUtamaTidakBaik" name="lampuUtama" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bagian Lampu Sein -->
                <div class="fieldset-container">
                    <legend>Lampu Sein</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="lampuSeinBaik" name="lampuSein" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="lampuSeinTidakBaik" name="lampuSein" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bagian Lampu Rem -->
                <div class="fieldset-container">
                    <legend>Lampu Rem</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="lampuRemBaik" name="lampuRem" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="lampuRemTidakBaik" name="lampuRem" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bagian Lampu, Klakson & Pendukung lainnya -->
                <div class="fieldset-container">
                    <legend>Klakson & lainnya</legend>
                    <div class="form-group">
                        <label>Baik</label>
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="lampuKlaksonBaik" name="lampuKlakson" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="lampuKlaksonTidakBaik" name="lampuKlakson" value="Tidak Baik"
                                    required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Bagian Upload File -->
                <div class="form-group">
                    <label for="laporanPenerangan">Laporan Kondisi Penerangan</label>
                    <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.</p>
                    <input type="file" id="laporanPenerangan" name="laporanPenerangan[]" multiple
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