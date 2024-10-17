<?php
session_start();

// Fungsi untuk menangani error
function handleError($message) {
    echo "<div class='alert alert-danger'>Error: $message</div>";
    error_log($message);
}

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

// Mengambil data pemeriksaan terbaru dengan semua field
$sql = "SELECT * FROM vehicle_inspection ORDER BY created_at DESC LIMIT 10";

$result = $conn->query($sql);

if (!$result) {
    handleError("Query error: " . $conn->error);
    exit();
}

// Menghitung statistik
$totalInspeksi = $result->num_rows;
$perluPerhatian = 0;
$inspeksiData = [];
$komponenStats = [];

while ($row = $result->fetch_assoc()) {
    $status = 'Aman';
    $totalKomponen = 0;
    $komponenBaik = 0;
    
    $komponenList = [
        'oli_mesin', 'oli_power_steering', 'oli_transmisi', 
        'minyak_rem', 'lampu_utama', 'lampu_sein', 
        'lampu_rem', 'lampu_klakson', 'cek_aki'
    ];
    
    foreach ($komponenList as $komponen) {
        if (isset($row[$komponen])) {
            $totalKomponen++;
            if (strtolower(trim($row[$komponen])) === 'baik') {
                $komponenBaik++;
            }
        }
    }
    
    if ($totalKomponen > 0) {
        $persentaseBaik = ($komponenBaik / $totalKomponen) * 100;
        $persentaseBuruk = 100 - $persentaseBaik;
    } else {
        $persentaseBaik = 0;
        $persentaseBuruk = 0;
    }
    
    $carName = '';
    switch ($row['plat_mobil']) {
        case 'W 1740 NP':
            $carName = 'Inova Lama';
            break;
        case 'W 1507 NP':
            $carName = 'Inova Reborn';
            break;
        case 'W 1374 NP':
            $carName = 'Kijang Kapsul';
            break;
        default:
            $carName = 'Unknown';
    }
    
    $komponenStats[] = [
        'plat_mobil' => $row['plat_mobil'],
        'car_name' => $carName,
        'inspection_date' => $row['created_at'],
        'persentase_baik' => round($persentaseBaik, 1),
        'persentase_buruk' => round($persentaseBuruk, 1),
        'detail_komponen' => array_map(function($komponen) use ($row) {
            return [
                'nama' => $komponen,
                'nilai' => $row[$komponen] ?? 'tidak ada'
            ];
        }, $komponenList)
    ];
    
    if ($persentaseBaik < 100) {
        $status = 'Perlu Perhatian';
        $perluPerhatian++;
    }
    
    $row['status'] = $status;
    $inspeksiData[] = $row;
}

$persentaseAman = $totalInspeksi > 0 ? (($totalInspeksi - $perluPerhatian) / $totalInspeksi) * 100 : 0;

// Pagination logic
$itemsPerPage = 3;
$totalPages = ceil(count($komponenStats) / $itemsPerPage);
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$currentPageItems = array_slice($komponenStats, $offset, $itemsPerPage);

$conn->close();
?>

<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Pemeriksaan Kendaraan</title>
    
    <link rel="stylesheet" href="../assets/css/hope-ui.min.css">
    <link rel="stylesheet" href="../assets/css/custom.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <style>
        .status-aman { color: #28a745; }
        .status-perhatian { color: #dc3545; }
        .card-stats { transition: transform .2s; }
        .card-stats:hover { transform: scale(1.05); }
        .table-responsive { max-height: 500px; overflow-y: auto; }
        .component-chart { height: 200px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
            <div class="sidebar-header d-flex align-items-center justify-content-start">
                <a href="#" class="navbar-brand">
                    <h4 class="logo-title">Dashboard Admin</h4>
                </a>
            </div>
            <div class="sidebar-body pt-0 data-scrollbar">
                <div class="sidebar-list">
                    <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="item-name">Dashboard</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
        
        <main class="main-content">
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="#" class="navbar-brand">
                        <h4 class="logo-title">Pemeriksaan Kendaraan</h4>
                    </a>
                    <div class="navbar-tool">
                        <a href="#" class="btn btn-primary">Keluar</a>
                    </div>
                </div>
            </nav>
            
            <div class="container-fluid content-inner mt-5 py-0">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-stats bg-info text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Total Inspeksi</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $totalInspeksi; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-info rounded-circle shadow">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats bg-success text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Persentase Aman</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo number_format($persentaseAman, 1); ?>%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-success rounded-circle shadow">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card card-stats bg-danger text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Perlu Perhatian</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $perluPerhatian; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-white text-danger rounded-circle shadow">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Persentase Kondisi Komponen per Kendaraan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($currentPageItems as $stat): ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-title mb-0">
                                                    <?php echo htmlspecialchars($stat['car_name']); ?> (<?php echo htmlspecialchars($stat['plat_mobil']); ?>)
                                                </h5>
                                                <small class="text-muted">
                                                    Tanggal Inspeksi: <?php echo date("d/m/Y H:i", strtotime($stat['inspection_date'])); ?>
                                                </small>
                                            </div>
                                            <div class="card-body">
                                                <div class="component-chart">
                                                    <canvas id="chart-<?php echo str_replace(' ', '-', $stat['plat_mobil']); ?>"></canvas>
                                                </div>
                                                <div class="text-center mt-3">
                                                    <span class="badge bg-success me-2">Baik: <?php echo $stat['persentase_baik']; ?>%</span>
                                                    <span class="badge bg-danger">Perlu Perbaikan: <?php echo $stat['persentase_buruk']; ?>%</span>
                                                </div>
                                                <div class="mt-3">
                                                    <small class="text-muted">Detail Komponen:</small>
                                                    <ul class="list-unstyled small">
                                                        <?php foreach ($stat['detail_komponen'] as $detail): ?>
                                                        <li>
                                                            <?php echo htmlspecialchars($detail['nama']); ?>: 
                                                            <span class="badge <?php echo strtolower($detail['nilai']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                                                <?php echo htmlspecialchars($detail['nilai']); ?>
                                                            </span>
                                                        </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                                
                                <!-- Pagination controls -->
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-center">
                                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                        <?php endfor; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pemeriksaan Kendaraan Terbaru</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Plat Mobil</th>
                                                <th>Tanggal</th>
                                                <th>Oli Mesin</th>
                                                <th>Oli Power Steering</th>
                                                <th>Oli Transmisi</th>
                                                <th>Minyak Rem</th>
                                                <th>Lampu Utama</th>
                                                <th>Lampu Sein</th>
                                                <th>Lampu Rem</th>
                                                <th>Klakson</th>
                                                <th>Aki</th>
                                                <th>Status</th>
                                                <th>Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($inspeksiData as $row): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                <td><?php echo htmlspecialchars($row['plat_mobil']); ?></td>
                                                <td><?php echo date("d/m/Y H:i", strtotime($row['created_at'])); ?></td>
                                                <td><?php echo htmlspecialchars($row['oli_mesin']); ?></td>
                                                <td><?php echo htmlspecialchars($row['oli_power_steering']); ?></td>
                                                <td><?php echo htmlspecialchars($row['oli_transmisi']); ?></td>
                                                <td><?php echo htmlspecialchars($row['minyak_rem']); ?></td>
                                                <td><?php echo htmlspecialchars($row['lampu_utama']); ?></td>
                                                <td><?php echo htmlspecialchars($row['lampu_sein']); ?></td>
                                                <td><?php echo htmlspecialchars($row['lampu_rem']); ?></td>
                                                <td><?php echo htmlspecialchars($row['lampu_klakson']); ?></td>
                                                <td><?php echo htmlspecialchars($row['cek_aki']); ?></td>
                                                <td><span class="badge <?php echo $row['status'] == 'Aman' ? 'bg-success' : 'bg-danger'; ?>"><?php echo $row['status']; ?></span></td>
                                                <td><a href="lihat_detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Lihat Detail</a></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer class="footer">
                <div class="footer-body">
                    <ul class="left-panel list-inline mb-0 p-0">
                        <li class="list-inline-item"><a href="#">Kebijakan Privasi</a></li>
                        <li class="list-inline-item"><a href="#">Syarat Penggunaan</a></li>
                    </ul>
                    <div class="right-panel">
                        ©<?php echo date("Y"); ?> Dashboard Pemeriksaan Kendaraan
                    </div>
                </div>
            </footer>
        </main>
    </div>
    <script src="../assets/js/core/libs.min.js"></script>
    <script src="../assets/js/hope-ui.js"></script>
    <script>
        <?php foreach ($currentPageItems as $stat): ?>
        new Chart(document.getElementById('chart-<?php echo str_replace(' ', '-', $stat['plat_mobil']); ?>'), {
            type: 'doughnut',
            data: {
                labels: ['Komponen Baik', 'Perlu Perbaikan'],
                datasets: [{
                    data: [<?php echo $stat['persentase_baik']; ?>, <?php echo $stat['persentase_buruk']; ?>],
                    backgroundColor: ['#28a745', '#dc3545'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        <?php endforeach; ?>
    </script>
</body>
</html>