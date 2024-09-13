<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Menyimpan data dari form5.php
    session_start();
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
    <title>Laporan Kendaraan</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
            color: #000;
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
            padding: 15px;
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

        .radio-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
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

        .modal-confirm {
            color: #434e65;
            width: 525px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
        }

        .modal-confirm .modal-header {
            background: #47c9a2;
            border-bottom: none;
            position: relative;
            text-align: center;
            margin: -20px -20px 0;
            border-radius: 5px 5px 0 0;
            padding: 35px;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 36px;
            margin: 10px 0;
        }

        .modal-confirm .form-control,
        .modal-confirm .btn {
            min-height: 40px;
            border-radius: 3px;
        }

        .modal-confirm .close {
            position: absolute;
            top: 15px;
            right: 15px;
            color: #fff;
            text-shadow: none;
            opacity: 0.5;
        }

        .modal-confirm .close:hover {
            opacity: 0.8;
        }

        .modal-confirm .icon-box {
            color: #fff;
            width: 95px;
            height: 95px;
            display: inline-block;
            border-radius: 50%;
            z-index: 9;
            border: 5px solid #fff;
            padding: 15px;
            text-align: center;
        }

        .modal-confirm .icon-box i {
            font-size: 64px;
            margin: -4px 0 0 -4px;
        }

        .modal-confirm.modal-dialog {
            margin-top: 80px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #eeb711 !important;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            border-radius: 30px;
            margin-top: 10px;
            padding: 6px 20px;
            border: none;
        }

        .modal-confirm .btn:hover,
        .modal-confirm .btn:focus {
            background: #eda645 !important;
            outline: none;
        }

        .modal-confirm .btn span {
            margin: 1px 3px 0;
            float: left;
        }

        .modal-confirm .btn i {
            margin-left: 1px;
            font-size: 20px;
            float: right;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
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
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
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
            <form class="form" method="post">
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
                        <p>Upload maksimum 5 file yang didukung: gambar, video, atau dokumen. Maksimal 10 MB per file.
                        </p>
                        <input type="file" id="fileUpload" name="fileUpload[]"
                            accept=".jpg,.jpeg,.png,.gif,.mp4,.avi,.mov,.mpg,.mpeg,.pdf,.doc,.docx" multiple>
                    </div>

                    <!-- Submit Button -->
                    <button href="berhasil.php" type="submit">Kirim</button>
                </div>

                <!-- </form>
            <div class="text-center">
     Button HTML (to Trigger Modal) 
    <a href="#myModal" class="trigger-btn" data-toggle="modal">Click to Open Success Modal</a>
</div>

 Modal HTML 
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h4>Great!</h4>	
                <p>Your account has been created successfully.</p>
                <button class="btn btn-success" data-dismiss="modal"><span>Start Exploring</span> <i class="material-icons">&#xE5C8;</i></button>
            </div>
        </div>
    </div>
</div>    
        </div> -->
    </section>
</body>

</html>