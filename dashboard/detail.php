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

// Query untuk mengambil data inspeksi
$query = "SELECT i.*, u.nama 
          FROM vehicle_inspection i 
          LEFT JOIN users u ON i.user_id = u.id 
          WHERE i.id = ?";
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

// Fungsi untuk mendapatkan nama mobil
function getCarName($platNomor) {
    switch ($platNomor) {
        case 'W 1740 NP':
            return 'Inova Lama';
        case 'W 1507 NP':
            return 'Inova Reborn';
        case 'W 1374 NP':
            return 'Kijang Kapsul';
        default:
            return 'Unknown';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemeriksaan Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Detail Pemeriksaan Kendaraan</h4>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Informasi Umum</h5>
                        <table class="table">
                            <tr>
                                <th>Petugas</th>
                                <td><?php echo htmlspecialchars($data['nama']); ?></td>
                            </tr>
                            <tr>
                                <th>Plat Mobil</th>
                                <td><?php echo htmlspecialchars($data['plat_mobil']); ?></td>
                            </tr>
                            <tr>
                                <th>Nama Mobil</th>
                                <td><?php echo htmlspecialchars(getCarName($data['plat_mobil'])); ?></td>
                            </tr>
                            <tr>
                                <th>Tanggal Pemeriksaan</th>
                                <td><?php echo date("d/m/Y H:i", strtotime($data['created_at'])); ?></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge <?php echo $data['status'] == 'Aman' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['status']; ?>
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Komponen Pemeriksaan -->
                <div class="row">
                    <div class="col-12">
                        <h5>Detail Komponen</h5>
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
                                        <table class="table">
                                            <tr>
                                                <th>Oli Mesin</th>
                                                <td>
                                                    <span class="badge <?php echo strtolower($data['oli_mesin']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                                        <?php echo $data['oli_mesin']; ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if (!empty($data['oli_mesin_foto'])): ?>
                                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['oli_mesin_foto']); ?>')">
                                                            <i class="fas fa-image"></i> Lihat Foto
                                                        </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Tambahkan komponen cairan lainnya dengan format yang sama -->
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Tambahkan accordion items untuk kategori lainnya -->
                        </div>
                    </div>
                </div>

                <?php if (!empty($data['catatan'])): ?>
                <div class="row mt-4">
                    <div class="col-12">
                        <h5>Catatan</h5>
                        <div class="alert alert-info">
                            <?php echo nl2br(htmlspecialchars($data['catatan'])); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="imageModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Foto Pemeriksaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" id="modalImage" class="img-fluid" alt="Foto Pemeriksaan">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function viewImage(imagePath) {
            document.getElementById('modalImage').src = imagePath;
            new bootstrap.Modal(document.getElementById('imageModal')).show();
        }
    </script>
</body>
</html>