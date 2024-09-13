<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebersihan Interior & Eksterior</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        /* Resetting default margin, padding, and box-sizing */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        /* Body styling */
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

        /* Section styling */
        section {
            position: relative;
            min-height: 100vh;
            /* Ensure the section takes at least the height of the viewport */
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
            /* Allow scrolling if needed */
        }

        /* Background container styling */
        .background-container {
            position: absolute;
            width: 100%;
            height: 100%;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
            grid-template-rows: repeat(auto-fill, minmax(60px, 1fr));
            gap: 2px;
            z-index: 1;
            /* Ensure background is behind the form */
        }

        .background-container span {
            background: #181818;
            aspect-ratio: 1;
            /* Ensure aspect ratio is 1:1 */
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

        /* Container styling */
        .container {
            position: relative;
            background: #fffcfc;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
            max-width: 400px;
            z-index: 2;
            /* Ensure the container is above the background */
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 20px;
            /* Ensure container doesn't touch the edges */
        }

        /* Header styling */
        h1 {
            color: #0f0;
            margin-bottom: 20px;
        }

        /* Form styling */
        .form {
            background: #b8b2b2;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
        }

        /* Fieldset container styling */
        .fieldset-container {
            border: 2px solid #000;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            position: relative;
            /* Position relative to place legend absolutely */
            background: #b8b2b2;
            /* Match the form background color */
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

        /* Form group styling */
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

        /* Radio group styling */
        .radio-group {
            display: flex;
            flex-direction: column;
            /* Set orientation to column */
            align-items: flex-start;
            /* Align items to the left */
            gap: 5px;
            /* Reduce spacing between radio buttons */
        }

        .radio-group label {
            display: flex;
            align-items: center;
            margin: 0;
            /* Remove default margin */
            padding: 0;
            /* Remove default padding */
            font-weight: normal;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
            /* Space between radio button and label */
        }

        .radio-group label:hover {
            background: #dcdcdc;
        }

        /* File input styling */
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

        /* Button styling */
        button {
            background: #0f0;
            color: #000;
            padding: 10px;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
            width: 25%;
            /* Ensure button spans the full width of its container */
        }

        button:hover {
            opacity: 0.8;
        }

        /* Responsive styling */
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
    <<<<<<< HEAD:form/kebersihan.html <section>
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
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
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
            <h1>Kebersihan Interior & Eksterior</h1>
            <form class="form" method="post" action="form3.php">
                <!-- Bagian Kebersihan Kursi -->
                <div class="fieldset-container">
                    <legend>Kebersihan Kursi</legend>
                    <div class="container">
                        <h1>Kebersihan Interior & Eksterior</h1>
                        <p>Pastikan kebersihan Interior dan Eksterior Bersih!</p>
                        <form method="post" action="lain_lain.php">
                            <!-- Bagian Kebersihan Kursi -->
                            <fieldset>
                                <legend>Kebersihan Kursi</legend>
                                <div class="form-group">
                                    <div class="radio-group">
                                        <label class="baik">
                                            <input type="radio" id="kursiBaik" name="kursi" value="Baik" required>
                                            Baik
                                        </label>
                                        <label class="tidak-baik">
                                            <input type="radio" id="kursiTidakBaik" name="kursi" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Bagian Kebersihan Lantai -->
                            <fieldset>
                                <legend>Kebersihan Lantai</legend>
                                <div class="form-group">
                                    <div class="radio-group">
                                        <label class="baik">
                                            <input type="radio" id="lantaiBaik" name="lantai" value="Baik" required>
                                            Baik
                                        </label>
                                        <label class="tidak-baik">
                                            <input type="radio" id="lantaiTidakBaik" name="lantai" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Bagian Kebersihan Dinding dalam & Luar Mobil -->
                            <fieldset>
                                <legend>Kebersihan Dinding dalam & Luar Mobil</legend>
                                <div class="form-group">
                                    <div class="radio-group">
                                        <label class="baik">
                                            <input type="radio" id="dindingBaik" name="dinding" value="Baik" required>
                                            Baik
                                        </label>
                                        <label class="tidak-baik">
                                            <input type="radio" id="dindingTidakBaik" name="dinding" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Bagian Kebersihan Kap Mesin -->
                            <fieldset>
                                <legend>Kebersihan Kap Mesin</legend>
                                <div class="form-group">
                                    <div class="radio-group">
                                        <label class="baik">
                                            <input type="radio" id="kapBaik" name="kap" value="Baik" required>
                                            Baik
                                        </label>
                                        <label class="tidak-baik">
                                            <input type="radio" id="kapTidakBaik" name="kap" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </fieldset>

                            <!-- Bagian Upload File -->
                            <div class="file-upload">
                                <fieldset>
                                    <legend>Upload Laporan Kebersihan (maks. 5 file, 10 MB per file)</legend>
                                    <div class="form-group">
                                        <div class="radio-group">
                                            <label>
                                                <input type="radio" id="kursiBaik" name="kursi" value="Baik" required>
                                                Baik
                                            </label>
                                            <label>
                                                <input type="radio" id="kursiTidakBaik" name="kursi" value="Tidak Baik"
                                                    required>
                                                Tidak Baik
                                            </label>
                                        </div>
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
                                            <input type="radio" id="lantaiTidakBaik" name="lantai" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Kebersihan Dinding dalam & Luar Mobil -->
                            <div class="fieldset-container">
                                <legend>Kebersihan Dinding</legend>
                                <div class="form-group">
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" id="dindingBaik" name="dinding" value="Baik" required>
                                            Baik
                                        </label>
                                        <label>
                                            <input type="radio" id="dindingTidakBaik" name="dinding" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Kebersihan Kap Mesin -->
                            <div class="fieldset-container">
                                <legend>Kebersihan Kap Mesin</legend>
                                <div class="form-group">
                                    <div class="radio-group">
                                        <label>
                                            <input type="radio" id="kapBaik" name="kap" value="Baik" required>
                                            Baik
                                        </label>
                                        <label>
                                            <input type="radio" id="kapTidakBaik" name="kap" value="Tidak Baik"
                                                required>
                                            Tidak Baik
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Bagian Upload File -->
                            <div class="form-group">
                                <label for="fileUpload">Laporan Kebersihan</label>
                                <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per
                                    file.</p>
                                <input type="file" id="fileUpload" name="fileUpload[]"
                                    accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                            </div>

                            <!-- Tombol Kirim -->
                            <div class="form-group">
                                <button type="submit">Kirim</button>
                            </div>
                        </form>
                    </div>
                    </section>
</body>

</html>