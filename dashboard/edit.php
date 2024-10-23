<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkcar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    handleError("Koneksi database gagal: " . $conn->connect_error);
    exit();
}

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    $status = $_POST['status'];
    $catatan = $_POST['catatan'];
    
    // Update komponen-komponen
    $komponenFields = [
        'oli_mesin', 'oli_power_steering', 'oli_transmisi', 'minyak_rem',
        'lampu_utama', 'lampu_sein', 'lampu_rem', 'lampu_klakson', 'cek_aki',
        'cek_kursi', 'cek_lantai', 'cek_dinding', 'cek_kap',
        'cek_stnk', 'cek_apar', 'cek_p3k', 'cek_kunci_roda',
        'cek_air_radiator', 'cek_bahan_bakar', 'cek_tekanan_ban', 'cek_rem'
    ];

    // Buat query update
    $updateFields = [];
    $updateValues = [];
    $types = "";

    foreach ($komponenFields as $field) {
        if (isset($_POST[$field])) {
            $updateFields[] = "$field = ?";
            $updateValues[] = $_POST[$field];
            $types .= "s";
        }
    }

    // Tambahkan status dan catatan
    $updateFields[] = "status = ?";
    $updateFields[] = "catatan = ?";
    $updateValues[] = $status;
    $updateValues[] = $catatan;
    $types .= "ss";

    // Tambahkan ID untuk WHERE clause
    $updateValues[] = $id;
    $types .= "i";

    $query = "UPDATE inspeksi SET " . implode(", ", $updateFields) . " WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$updateValues);

    if ($stmt->execute()) {
        header("Location: index.php?success=1");
        exit;
    } else {
        $error = "Gagal mengupdate data";
    }
}

// Query untuk mengambil data inspeksi
$query = "SELECT * FROM inspeksi WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Jika data tidak ditemukan, redirect ke halaman utama
if (!$data) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pemeriksaan Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Pemeriksaan Kendaraan</h4>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <!-- Informasi Umum -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informasi Umum</h5>
                            <div class="mb-3">
                                <label class="form-label">Plat Mobil</label>
                                <input type="text" class="form-control" value="<?php echo htmlspecialchars($data['plat_mobil']); ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Komponen Pemeriksaan -->
                    <div class="row">
                        <div class="col-12">
                            <h5>Komponen Pemeriksaan</h5>
                            <div class="accordion" id="accordionKomponen">
                                <!-- Cairan -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCairan">
                                            Cairan
                                        </button>
                                    </h2>
                                    <div id="collapseCairan" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="mb-3">
                                                <label class="form-label">Oli Mesin</label>
                                                <select name="oli_mesin" class="form-select">
                                                    <option value="Baik" <?php echo $data['oli_mesin'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                                    <option value="Buruk" <?php echo $data['oli_mesin'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                                </select>
                                            </div>
                                            <!-- Tambahkan komponen cairan lainnya -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Tambahkan accordion items untuk kategori lainnya -->
                            </div>
                        </div>
                    </div>

                    <!-- Status dan Catatan -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option value="Aman" <?php echo $data['status'] === 'Aman' ? 'selected' : ''; ?>>Aman</option>
                                    <option value="Tidak Aman" <?php echo $data['status'] === 'Tidak Aman' ? 'selected' : ''; ?>>Tidak Aman</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea name="catatan" class="form-control" rows="3"><?php echo htmlspecialchars($data['catatan']); ?></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Accordion untuk kategori komponen lainnya -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLampu">
                                Lampu & Kelistrikan
                            </button>
                        </h2>
                        <div id="collapseLampu" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label class="form-label">Lampu Utama</label>
                                    <select name="lampu_utama" class="form-select">
                                        <option value="Baik" <?php echo $data['lampu_utama'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['lampu_utama'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lampu Sein</label>
                                    <select name="lampu_sein" class="form-select">
                                        <option value="Baik" <?php echo $data['lampu_sein'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['lampu_sein'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lampu Rem</label>
                                    <select name="lampu_rem" class="form-select">
                                        <option value="Baik" <?php echo $data['lampu_rem'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['lampu_rem'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Klakson</label>
                                    <select name="lampu_klakson" class="form-select">
                                        <option value="Baik" <?php echo $data['lampu_klakson'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['lampu_klakson'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Aki</label>
                                    <select name="cek_aki" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_aki'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_aki'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInterior">
                                Interior
                            </button>
                        </h2>
                        <div id="collapseInterior" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label class="form-label">Kursi</label>
                                    <select name="cek_kursi" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_kursi'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_kursi'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Lantai</label>
                                    <select name="cek_lantai" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_lantai'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_lantai'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dinding</label>
                                    <select name="cek_dinding" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_dinding'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_dinding'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kap</label>
                                    <select name="cek_kap" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_kap'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_kap'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDokumen">
                                Dokumen & Perlengkapan
                            </button>
                        </h2>
                        <div id="collapseDokumen" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label class="form-label">STNK</label>
                                    <select name="cek_stnk" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_stnk'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_stnk'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">APAR</label>
                                    <select name="cek_apar" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_apar'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_apar'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">P3K</label>
                                    <select name="cek_p3k" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_p3k'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_p3k'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Kunci Roda</label>
                                    <select name="cek_kunci_roda" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_kunci_roda'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_kunci_roda'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSistem">
                                Sistem Mekanis
                            </button>
                        </h2>
                        <div id="collapseSistem" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label class="form-label">Air Radiator</label>
                                    <select name="cek_air_radiator" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_air_radiator'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_air_radiator'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bahan Bakar</label>
                                    <select name="cek_bahan_bakar" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_bahan_bakar'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_bahan_bakar'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tekanan Ban</label>
                                    <select name="cek_tekanan_ban" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_tekanan_ban'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_tekanan_ban'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Rem</label>
                                    <select name="cek_rem" class="form-select">
                                        <option value="Baik" <?php echo $data['cek_rem'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Buruk" <?php echo $data['cek_rem'] === 'Buruk' ? 'selected' : ''; ?>>Buruk</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="index.php" class="btn btn-secondary ms-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>