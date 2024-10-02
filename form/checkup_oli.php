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
    // Retrieve form data from session
    $nama_petugas = $_SESSION['nama_petugas'];
    $plat_mobil = $_SESSION['plat_mobil'];
    $hari = $_SESSION['hari'];
    $upload_date = date('Y-m-d H:i:s'); // Tanggal upload

    // Initialize an array to store file names
    $fileNames = [];
    $uploadDir = __DIR__ . '/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true); // Create the directory if it doesn't exist
    }

    // Prepare SQL statement to insert data into the database
    $stmt = $pdo->prepare('INSERT INTO photos (nama_petugas, plat_mobil, hari, upload_date, photo_filename, oli_mesin_filename, oli_power_steering_filename, oli_transmisi_filename, minyak_rem_filename) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // Process Oli Mesin
    if (isset($_POST['oliMesin'])) {
        $oliMesin = $_POST['oliMesin'];
        $oliMesinFilename = '';

        if (!empty($_FILES['oliMesin']['name'][0])) {
            $oliMesinFilename = uniqid() . '-' . basename($_FILES['oliMesin']['name'][0]);
            move_uploaded_file($_FILES['oliMesin']['tmp_name'][0], $uploadDir . $oliMesinFilename);
        }
    }

    // Process Oli Power Steering
    if (isset($_POST['oliPowerSteering'])) {
        $oliPowerSteering = $_POST['oliPowerSteering'];
        $oliPowerSteeringFilename = '';

        if (!empty($_FILES['oliPowerSteering']['name'][0])) {
            $oliPowerSteeringFilename = uniqid() . '-' . basename($_FILES['oliPowerSteering']['name'][0]);
            move_uploaded_file($_FILES['oliPowerSteering']['tmp_name'][0], $uploadDir . $oliPowerSteeringFilename);
        }
    }

    // Process Oli Transmisi
    if (isset($_POST['oliTransmisi'])) {
        $oliTransmisi = $_POST['oliTransmisi'];
        $oliTransmisiFilename = '';

        if (!empty($_FILES['oliTransmisi']['name'][0])) {
            $oliTransmisiFilename = uniqid() . '-' . basename($_FILES['oliTransmisi']['name'][0]);
            move_uploaded_file($_FILES['oliTransmisi']['tmp_name'][0], $uploadDir . $oliTransmisiFilename);
        }
    }

    // Process Minyak Rem
    if (isset($_POST['minyakRem'])) {
        $minyakRem = $_POST['minyakRem'];
        $minyakRemFilename = '';

        if (!empty($_FILES['minyakRem']['name'][0])) {
            $minyakRemFilename = uniqid() . '-' . basename($_FILES['minyakRem']['name'][0]);
            move_uploaded_file($_FILES['minyakRem']['tmp_name'][0], $uploadDir . $minyakRemFilename);
        }
    }

    // Execute SQL statement
    $stmt->execute([$nama_petugas, $plat_mobil, $hari, $upload_date, '', $oliMesinFilename, $oliPowerSteeringFilename, $oliTransmisiFilename, $minyakRemFilename]);

    echo "Data and photos uploaded successfully!";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Oli</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <section>
        <div class="container">
            <h1>Pemeriksaan Oli</h1>

            <form class="form" method="post" enctype="multipart/form-data">
                <div class="fieldset-container">
                    <legend>Oli Mesin</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="oliMesinBaik" name="oliMesin" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="oliMesinTidakBaik" name="oliMesin" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oliMesin">Upload Foto Oli Mesin</label>
                        <input type="file" id="oliMesin" name="oliMesin[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Oli Power Steering</legend>
                    <div class="form-group">
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
                        <label for="oliPowerSteering">Upload Foto Oli Power Steering</label>
                        <input type="file" id="oliPowerSteering" name="oliPowerSteering[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Oli Transmisi</legend>
                    <div class="form-group">
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
                        <label for="oliTransmisi">Upload Foto Oli Transmisi</label>
                        <input type="file" id="oliTransmisi" name="oliTransmisi[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Minyak Rem</legend>
                    <div class="form-group">
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
                    <div class="form-group">
                        <label for="minyakRem">Upload Foto Minyak Rem</label>
                        <input type="file" id="minyakRem" name="minyakRem[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
