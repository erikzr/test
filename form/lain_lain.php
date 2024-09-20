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
            /* Changed width to match the example */
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #000;
            margin-bottom: 20px;
            font-size: 1.5em;
            /* Adjusted font size to match the example */
        }

        .form {
            background: #b8b2b2;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
        }

        .fieldset-container {
            border: 2px solid rgb(0, 0, 0);
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            position: relative;
            background: #b8b2b2;
        }

        .fieldset-container legend {
            font-weight: 600;
            color: rgb(0, 0, 0);
            padding: 0 10px;
            position: absolute;
            top: -10px;
            left: 10px;
            background: #fffcfc;
            border: 1px solid rgb(0, 0, 0);
            border-radius: 5px;
            font-size: 1.1em;
            /* Adjusted font size for legend */
        }

        .form-group {
            border: 1px solid rgb(0, 0, 0);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            background: #b8b2b2;
        }

        .form-group label {
            display: block;
            color: #000000;
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
            width: 30%;
            /* Adjusted width to be consistent */
        }

        button:hover {
            opacity: 0.8;
        }

        .baik {
            color: #0f0;
            /* Color for 'Baik' options */
        }

        .tidak-baik {
            color: #f00;
            /* Color for 'Tidak Baik' options */
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