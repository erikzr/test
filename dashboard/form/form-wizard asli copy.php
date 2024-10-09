<?php
session_start(); // Memulai sesi

// Koneksi ke database
$servername = "localhost"; // ganti dengan server Anda
$username = "root"; // ganti dengan username database Anda
$password = ""; // ganti dengan password database Anda
$dbname = "checkcar"; // ganti dengan nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $oli_mesin = $_POST['oli_mesin'];
    $oli_power_steering = $_POST['oli_power_steering'];
    $oli_transmisi = $_POST['oli_transmisi'];
    $minyak_rem = $_POST['minyak_rem'];

    // Mengupload foto
    $target_dir = "uploads/"; // folder untuk menyimpan foto
    $oli_mesin_foto = $target_dir . basename($_FILES["oli_mesin_foto"]["name"]);
    $oli_power_steering_foto = $target_dir . basename($_FILES["oli_power_steering_foto"]["name"]);
    $oli_transmisi_foto = $target_dir . basename($_FILES["oli_transmisi_foto"]["name"]);
    $minyak_rem_foto = $target_dir . basename($_FILES["minyak_rem_foto"]["name"]);

    // Validasi dan upload foto
    $uploadOk = 1;

    // Cek jika file gambar adalah gambar
    foreach ($_FILES as $file) {
        if ($file["error"] == 0) {
            $check = getimagesize($file["tmp_name"]);
            if ($check === false) {
                echo "File " . $file["name"] . " bukan gambar.";
                $uploadOk = 0;
            }
        }
    }

    if ($uploadOk) {
        // Simpan foto ke direktori
        foreach ($_FILES as $file) {
            move_uploaded_file($file["tmp_name"], $target_dir . basename($file["name"]));
        }

        // Siapkan dan bind
        $stmt = $conn->prepare("INSERT INTO pemeriksaan_oli (oli_mesin, oli_power_steering, oli_transmisi, minyak_rem, oli_mesin_foto, oli_power_steering_foto, oli_transmisi_foto, minyak_rem_foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $oli_mesin, $oli_power_steering, $oli_transmisi, $minyak_rem, $oli_mesin_foto, $oli_power_steering_foto, $oli_transmisi_foto, $minyak_rem_foto);

        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Data pemeriksaan oli berhasil disimpan.";
            // Anda dapat menambahkan redirect ke langkah berikutnya di sini
        } else {
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    }
}

// Tutup koneksi
$conn->close();
?>
<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>BMN-Operasional</title>  
  </head>
  <body>
  <form action="proses_form.php" method="post" enctype="multipart/form-data"><!-- Data Pribadi        --><fieldset>
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Data Pribadi</h3>
                                        </div>
                                        <div class="col-5">
                                            <h2 class="steps">Step 1 - 6</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Nama</label>
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" 
                                                value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>" readonly />                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Plat Mobil</label>
                                                <select class="form-select" name="plat_mobil">
                                                    <option value="W 1740 NP">W 1740 NP (Inova Lama)</option>
                                                    <option value="W 1507 NP">W 1507 NP (Reborn)</option>
                                                    <option value="W 1374 NP">W 1374 NP (Kijang Kapsul)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" name="next" class="btn btn-primary next action-button float-end" value="Next">Next</button>
                            
                            </fieldset>
<!--pemeriksa OLI        --><fieldset>
                                <div class="form-card text-start">
                                    <div class="row mb-4">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Oli</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 2 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Oli Mesin -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Oli Mesin</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_mesin" value="baik" id="oli_mesin_baik">
                                                    <label class="form-check-label" for="oli_mesin_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_mesin" value="tidak_baik" id="oli_mesin_tidak_baik">
                                                    <label class="form-check-label" for="oli_mesin_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="oli_mesin_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Mesin</label>
                                                    <input type="file" class="form-control" name="oli_mesin_foto" id="oli_mesin_foto" accept="image/*" capture="camera" />
                                                    <small id="oli_mesin_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_mesin_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Oli Power Steering -->
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Oli Power Steering</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_power_steering" value="baik" id="oli_power_steering_baik">
                                                    <label class="form-check-label" for="oli_power_steering_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_power_steering" value="tidak_baik" id="oli_power_steering_tidak_baik">
                                                    <label class="form-check-label" for="oli_power_steering_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="oli_power_steering_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Power Steering</label>
                                                    <input type="file" class="form-control" name="oli_power_steering_foto" id="oli_power_steering_foto" accept="image/*" capture="camera" />
                                                    <small id="oli_power_steering_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_power_steering_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bagian Oli Transmisi -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Oli Transmisi</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_transmisi" value="baik" id="oli_transmisi_baik">
                                                    <label class="form-check-label" for="oli_transmisi_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_transmisi" value="tidak_baik" id="oli_transmisi_tidak_baik">
                                                    <label class="form-check-label" for="oli_transmisi_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="oli_transmisi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Transmisi</label>
                                                    <input type="file" class="form-control" name="oli_transmisi_foto" id="oli_transmisi_foto" accept="image/*" capture="camera" />
                                                    <small id="oli_transmisi_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_transmisi_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Minyak Rem -->
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Minyak Rem</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="minyak_rem" value="baik" id="minyak_rem_baik">
                                                    <label class="form-check-label" for="minyak_rem_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="minyak_rem" value="tidak_baik" id="minyak_rem_tidak_baik">
                                                    <label class="form-check-label" for="minyak_rem_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="minyak_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Minyak Rem</label>
                                                    <input type="file" class="form-control" name="minyak_rem_foto" id="minyak_rem_foto" accept="image/*" capture="camera" />
                                                    <small id="minyak_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="minyak_rem_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" name="previous" class="btn btn-dark previous action-button-previous me-1 text-white" value="Previous">
                                            Previous
                                        </button>
                                        <button type="button" name="next" class="btn btn-primary next action-button" value="Next">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                            <script>
                                // JavaScript untuk menangani timestamp
                                const handleTimestamp = (inputId, timestampId) => {
                                    const inputElement = document.getElementById(inputId);
                                    const timestampElement = document.getElementById(timestampId);

                                    inputElement.addEventListener('change', () => {
                                        const currentTime = new Date().toLocaleString();
                                        timestampElement.innerText = currentTime;
                                    });
                                };

                                // Panggil fungsi untuk setiap input foto
                                handleTimestamp('oli_mesin_foto', 'oli_mesin_time');
                                handleTimestamp('oli_power_steering_foto', 'oli_power_steering_time');
                                handleTimestamp('oli_transmisi_foto', 'oli_transmisi_time');
                                handleTimestamp('minyak_rem_foto', 'minyak_rem_time');
                            </script>
<!--pemeriksaanpenerangan--><fieldset>
                                <div class="form-card text-start">
                                    <div class="row mb-4">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Penerangan</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 3 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Lampu Utama -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Lampu Utama</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_utama" value="baik" id="lampu_utama_baik">
                                                    <label class="form-check-label" for="lampu_utama_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_utama" value="tidak_baik" id="lampu_utama_tidak_baik">
                                                    <label class="form-check-label" for="lampu_utama_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="lampu_utama_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Utama</label>
                                                    <input type="file" class="form-control" name="lampu_utama_foto" id="lampu_utama_foto" accept="image/*" capture="camera" onchange="updateTimestamp('lampu_utama_time')" />
                                                    <small id="lampu_utama_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_utama_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Lampu Sein -->
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Lampu Sein</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_sein" value="baik" id="lampu_sein_baik">
                                                    <label class="form-check-label" for="lampu_sein_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_sein" value="tidak_baik" id="lampu_sein_tidak_baik">
                                                    <label class="form-check-label" for="lampu_sein_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="lampu_sein_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Sein</label>
                                                    <input type="file" class="form-control" name="lampu_sein_foto" id="lampu_sein_foto" accept="image/*" capture="camera" onchange="updateTimestamp('lampu_sein_time')" />
                                                    <small id="lampu_sein_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_sein_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bagian Lampu Rem -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Lampu Rem</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_rem" value="baik" id="lampu_rem_baik">
                                                    <label class="form-check-label" for="lampu_rem_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_rem" value="tidak_baik" id="lampu_rem_tidak_baik">
                                                    <label class="form-check-label" for="lampu_rem_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="lampu_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Rem</label>
                                                    <input type="file" class="form-control" name="lampu_rem_foto" id="lampu_rem_foto" accept="image/*" capture="camera" onchange="updateTimestamp('lampu_rem_time')" />
                                                    <small id="lampu_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_rem_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Lampu Klakson -->
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Lampu, Klakson & pendukung lainnya</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_klakson" value="baik" id="lampu_klakson_baik">
                                                    <label class="form-check-label" for="lampu_klakson_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="lampu_klakson" value="tidak_baik" id="lampu_klakson_tidak_baik">
                                                    <label class="form-check-label" for="lampu_klakson_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="lampu_klakson_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Klakson</label>
                                                    <input type="file" class="form-control" name="lampu_klakson_foto" id="lampu_klakson_foto" accept="image/*" capture="camera" onchange="updateTimestamp('lampu_klakson_time')" />
                                                    <small id="lampu_klakson_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_klakson_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" name="previous" class="btn btn-dark previous action-button-previous me-1 text-white" value="Previous">
                                            Previous
                                        </button>
                                        <button type="button" name="next" class="btn btn-primary next action-button" value="Next">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                            <script>
                                function updateTimestamp(elementId) {
                                    var now = new Date();
                                    var timestamp = now.toLocaleString(); // Menampilkan tanggal dan waktu lokal
                                    document.getElementById(elementId).innerText = timestamp;
                                }
                            </script>
<!--pemeriksaan Aki      --><fieldset>
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Aki</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 4 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Pemeriksaan Aki -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Tegangan Aki</label>
                                                
                                                <!-- Pilihan Baik / Tidak Baik -->
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_aki" value="baik" id="cek_aki_baik">
                                                    <label class="form-check-label" for="cek_aki_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_aki" value="tidak_baik" id="cek_aki_tidak_baik">
                                                    <label class="form-check-label" for="cek_aki_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="aki_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Tegangan Aki</label>
                                                    <input type="file" class="form-control" name="aki_foto" id="aki_foto" accept="image/*" capture="camera" onchange="updateTimestamp('aki_time')" />
                                                    <small id="aki_timestamp" class="form-text text-muted">Waktu diambil: <span id="aki_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" name="previous" class="btn btn-dark previous action-button-previous me-1 text-white" value="Previous">Previous</button>
                                        <button type="button" name="next" class="btn btn-primary next action-button" value="Submit">Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                            <script>
                                function updateTimestamp(elementId) {
                                    var now = new Date();
                                    var timestamp = now.toLocaleString(); // Menampilkan tanggal dan waktu lokal
                                    document.getElementById(elementId).innerText = timestamp;
                                }
                            </script>
<!--pemeriksaanKebersihan--><fieldset>
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Kebersihan</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 5 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Pemeriksaan Kebersihan -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Kebersihan Kursi -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kebersihan Kursi</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kursi" value="baik" id="cek_kursi_baik">
                                                    <label class="form-check-label" for="cek_kursi_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kursi" value="tidak_baik" id="cek_kursi_tidak_baik">
                                                    <label class="form-check-label" for="cek_kursi_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="kursi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Kursi</label>
                                                    <input type="file" class="form-control" name="kursi_foto" id="kursi_foto" accept="image/*" capture="camera" onchange="updateTimestamp('kursi_time')" />
                                                    <small id="kursi_timestamp" class="form-text text-muted">Waktu diambil: <span id="kursi_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kebersihan Lantai -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kebersihan Lantai</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_lantai" value="baik" id="cek_lantai_baik">
                                                    <label class="form-check-label" for="cek_lantai_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_lantai" value="tidak_baik" id="cek_lantai_tidak_baik">
                                                    <label class="form-check-label" for="cek_lantai_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="lantai_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Lantai</label>
                                                    <input type="file" class="form-control" name="lantai_foto" id="lantai_foto" accept="image/*" capture="camera" onchange="updateTimestamp('lantai_time')" />
                                                    <small id="lantai_timestamp" class="form-text text-muted">Waktu diambil: <span id="lantai_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kebersihan Dinding Luar & Dalam -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kebersihan Dinding Luar & Dalam</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_dinding" value="baik" id="cek_dinding_baik">
                                                    <label class="form-check-label" for="cek_dinding_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_dinding" value="tidak_baik" id="cek_dinding_tidak_baik">
                                                    <label class="form-check-label" for="cek_dinding_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="dinding_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Dinding</label>
                                                    <input type="file" class="form-control" name="dinding_foto" id="dinding_foto" accept="image/*" capture="camera" onchange="updateTimestamp('dinding_time')" />
                                                    <small id="dinding_timestamp" class="form-text text-muted">Waktu diambil: <span id="dinding_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kebersihan Kap Mesin -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kebersihan Kap Mesin</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kap" value="baik" id="cek_kap_baik">
                                                    <label class="form-check-label" for="cek_kap_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kap" value="tidak_baik" id="cek_kap_tidak_baik">
                                                    <label class="form-check-label" for="cek_kap_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="kap_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Kap Mesin</label>
                                                    <input type="file" class="form-control" name="kap_foto" id="kap_foto" accept="image/*" capture="camera" onchange="updateTimestamp('kap_time')" />
                                                    <small id="kap_timestamp" class="form-text text-muted">Waktu diambil: <span id="kap_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" name="previous" class="btn btn-dark previous action-button-previous me-1 text-white" value="Previous">Previous</button>
                                        <button type="button" name="next" class="btn btn-primary next action-button" value="Submit">Submit</button>
                                    </div>
                                </div>
                            </fieldset>
                            <script>
                                function updateTimestamp(elementId) {
                                    var now = new Date();
                                    var timestamp = now.toLocaleString();
                                    document.getElementById(elementId).innerText = timestamp;
                                }
                            </script>
<!--pemeriksaan lain-lain--><fieldset>
                                <div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Lain-lain</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 6 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Pemeriksaan Lain-lain -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- STNK -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek STNK</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_stnk" value="baik" id="cek_stnk_baik">
                                                    <label class="form-check-label" for="cek_stnk_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_stnk" value="tidak_baik" id="cek_stnk_tidak_baik">
                                                    <label class="form-check-label" for="cek_stnk_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="stnk_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto STNK</label>
                                                    <input type="file" class="form-control" name="stnk_foto" id="stnk_foto" accept="image/*" capture="camera" onchange="updateTimestamp('stnk_time')" />
                                                    <small id="stnk_timestamp" class="form-text text-muted">Waktu diambil: <span id="stnk_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Apar -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Apar</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_apar" value="baik" id="cek_apar_baik">
                                                    <label class="form-check-label" for="cek_apar_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_apar" value="tidak_baik" id="cek_apar_tidak_baik">
                                                    <label class="form-check-label" for="cek_apar_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="apar_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Apar</label>
                                                    <input type="file" class="form-control" name="apar_foto" id="apar_foto" accept="image/*" capture="camera" onchange="updateTimestamp('apar_time')" />
                                                    <small id="apar_timestamp" class="form-text text-muted">Waktu diambil: <span id="apar_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kotak P3K -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kotak P3K</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_p3k" value="baik" id="cek_p3k_baik">
                                                    <label class="form-check-label" for="cek_p3k_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_p3k" value="tidak_baik" id="cek_p3k_tidak_baik">
                                                    <label class="form-check-label" for="cek_p3k_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="p3k_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kotak P3K</label>
                                                    <input type="file" class="form-control" name="p3k_foto" id="p3k_foto" accept="image/*" capture="camera" onchange="updateTimestamp('p3k_time')" />
                                                    <small id="p3k_timestamp" class="form-text text-muted">Waktu diambil: <span id="p3k_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kunci Roda -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kunci Roda</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kunci_roda" value="baik" id="cek_kunci_roda_baik">
                                                    <label class="form-check-label" for="cek_kunci_roda_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kunci_roda" value="tidak_baik" id="cek_kunci_roda_tidak_baik">
                                                    <label class="form-check-label" for="cek_kunci_roda_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="kunci_roda_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kunci Roda</label>
                                                    <input type="file" class="form-control" name="kunci_roda_foto" id="kunci_roda_foto" accept="image/*" capture="camera" onchange="updateTimestamp('kunci_roda_time')" />
                                                    <small id="kunci_roda_timestamp" class="form-text text-muted">Waktu diambil: <span id="kunci_roda_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Air Radiator -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Air Radiator</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_air_radiator" value="baik" id="cek_air_radiator_baik">
                                                    <label class="form-check-label" for="cek_air_radiator_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_air_radiator" value="tidak_baik" id="cek_air_radiator_tidak_baik">
                                                    <label class="form-check-label" for="cek_air_radiator_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="air_radiator_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Air Radiator</label>
                                                    <input type="file" class="form-control" name="air_radiator_foto" id="air_radiator_foto" accept="image/*" capture="camera" onchange="updateTimestamp('air_radiator_time')" />
                                                    <small id="air_radiator_timestamp" class="form-text text-muted">Waktu diambil: <span id="air_radiator_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Bahan Bakar -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Bahan Bakar Kendaraan</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_bahan_bakar" value="baik" id="cek_bahan_bakar_baik">
                                                    <label class="form-check-label" for="cek_bahan_bakar_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_bahan_bakar" value="tidak_baik" id="cek_bahan_bakar_tidak_baik">
                                                    <label class="form-check-label" for="cek_bahan_bakar_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="bahan_bakar_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Bahan Bakar</label>
                                                    <input type="file" class="form-control" name="bahan_bakar_foto" id="bahan_bakar_foto" accept="image/*" capture="camera" onchange="updateTimestamp('bahan_bakar_time')" />
                                                    <small id="bahan_bakar_timestamp" class="form-text text-muted">Waktu diambil: <span id="bahan_bakar_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Tekanan Angin & Kondisi Ban -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Tekanan Angin & Kondisi Ban</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_tekanan_ban" value="baik" id="cek_tekanan_ban_baik">
                                                    <label class="form-check-label" for="cek_tekanan_ban_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_tekanan_ban" value="tidak_baik" id="cek_tekanan_ban_tidak_baik">
                                                    <label class="form-check-label" for="cek_tekanan_ban_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="tekanan_ban_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Tekanan & Kondisi Ban</label>
                                                    <input type="file" class="form-control" name="tekanan_ban_foto" id="tekanan_ban_foto" accept="image/*" capture="camera" onchange="updateTimestamp('tekanan_ban_time')" />
                                                    <small id="tekanan_ban_timestamp" class="form-text text-muted">Waktu diambil: <span id="tekanan_ban_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Handrem/Rem -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kondisi Handrem/Rem</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_rem" value="baik" id="cek_rem_baik">
                                                    <label class="form-check-label" for="cek_rem_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_rem" value="tidak_baik" id="cek_rem_tidak_baik">
                                                    <label class="form-check-label" for="cek_rem_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Handrem/Rem</label>
                                                    <input type="file" class="form-control" name="rem_foto" id="rem_foto" accept="image/*" capture="camera" onchange="updateTimestamp('rem_time')" />
                                                    <small id="rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="rem_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Navigasi -->
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1 text-white" value="Previous">Previous</button>
                            </fieldset>
                            <script>
                                function updateTimestamp(elementId) {
                                    const currentTime = new Date().toLocaleString();
                                    document.getElementById(elementId).innerText = currentTime;
                                }
                            </script>

<!--Finish               --><fieldset>
                                <div class="form-card">
                                    <div class="row">
                                    <div class="col-7">
                                        <h3 class="mb-4 text-left">Finish:</h3>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 6 - 6</h2>
                                    </div>
                                    </div>
                                    <br><br>
                                    <h2 class="text-center text-success"><strong>SUCCESS !</strong></h2>
                                    <br>
                                    <div class="row justify-content-center">
                                    <div class="col-3"> <img src="../../assets/images/pages/img-success.png" class="img-fluid" alt="fit-image"> </div>
                                    </div>
                                    <br><br>
                                    <div class="row justify-content-center">
                                    <div class="text-center col-7">
                                        <h5 class="text-center purple-text">Terimakasih , form berhasil di submit!</h5>
                                    </div>
                                    </div>
                                </div>
                            </fieldset>
                            </form>
  </body>
</html>