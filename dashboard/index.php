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
     <!-- Excel Export Library -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    
    <!-- PDF Export Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
    <!-- SweetAlert for notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>

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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
        }

        .logo-title {
            color: #333;
            font-size: 1.5rem;
            margin: 0;
        }

        .sidebar-body {
            padding: 15px 0;
        }

        .navbar-nav {
            list-style: none;
        }

        .nav-item {
            margin: 5px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .nav-link:hover, .nav-link.active {
            background: #f0f0f0;
            color: #2196F3;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 15px;
            right: 15px;
            padding: 12px;
            background: #ff4444;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .logout-btn i {
            margin-right: 8px;
        }

        .logout-btn:hover {
            background: #ff0000;
        }

        .toggle-sidebar {
            display: none;
            position: fixed;
            top: 20px;
            left: 20px;
            background: #2196F3;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1000;
        }

        /* Media Queries */
        @media (max-width: 1024px) {
            .sidebar {
                width: 240px;
            }
        }

        @media (max-width: 768px) {
            .toggle-sidebar {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
    <button class="toggle-sidebar">
        <i class="fas fa-bars"></i>
    </button>

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
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users"></i>
                            <span class="item-name">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i>
                            <span class="item-name">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <button class="logout-btn" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </button>
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
                
               
<!-- Tabel Pemeriksaan Kendaraan --><!-- Tabel Pemeriksaan Kendaraan -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Pemeriksaan Kendaraan</h4>
                <div>
                    <button class="btn btn-primary" onclick="exportToExcel()">
                        <i class="fas fa-file-excel me-2"></i>Export Excel
                    </button>
                    <button class="btn btn-danger ms-2" onclick="exportToPDF()">
                        <i class="fas fa-file-pdf me-2"></i>Export PDF
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="inspectionTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Petugas</th>
                                <th>Plat Mobil</th>
                                <th>Nama Mobil</th>
                                <th>Tanggal Pemeriksaan</th>
                                <th>Komponen</th>
                                <th>Interior</th>
                                <th>Dokumen & Perlengkapan</th>
                                <th>Sistem Mekanis</th>
                                <th>Status</th>
                                <th>Catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = 1;
                            foreach ($inspeksiData as $row): 
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

                                // Kelompokkan komponen berdasarkan kategori
                                $komponenList = [
                                    'Cairan' => [
                                        'Oli Mesin' => ['status' => $row['oli_mesin'], 'foto' => $row['oli_mesin_foto']],
                                        'Oli Power Steering' => ['status' => $row['oli_power_steering'], 'foto' => $row['oli_power_steering_foto']],
                                        'Oli Transmisi' => ['status' => $row['oli_transmisi'], 'foto' => $row['oli_transmisi_foto']],
                                        'Minyak Rem' => ['status' => $row['minyak_rem'], 'foto' => $row['minyak_rem_foto']]
                                    ],
                                    'Lampu' => [
                                        'Lampu Utama' => ['status' => $row['lampu_utama'], 'foto' => $row['lampu_utama_foto']],
                                        'Lampu Sein' => ['status' => $row['lampu_sein'], 'foto' => $row['lampu_sein_foto']],
                                        'Lampu Rem' => ['status' => $row['lampu_rem'], 'foto' => $row['lampu_rem_foto']],
                                        'Klakson' => ['status' => $row['lampu_klakson'], 'foto' => $row['lampu_klakson_foto']],
                                        'Aki' => ['status' => $row['cek_aki'], 'foto' => $row['aki_foto']]
                                    ],
                                    'Interior' => [
                                        'Kursi' => ['status' => $row['cek_kursi'], 'foto' => $row['kursi_foto']],
                                        'Lantai' => ['status' => $row['cek_lantai'], 'foto' => $row['lantai_foto']],
                                        'Dinding' => ['status' => $row['cek_dinding'], 'foto' => $row['dinding_foto']],
                                        'Kap' => ['status' => $row['cek_kap'], 'foto' => $row['kap_foto']]
                                    ],
                                    'Dokumen' => [
                                        'STNK' => ['status' => $row['cek_stnk'], 'foto' => $row['stnk_foto']],
                                        'APAR' => ['status' => $row['cek_apar'], 'foto' => $row['apar_foto']],
                                        'P3K' => ['status' => $row['cek_p3k'], 'foto' => $row['p3k_foto']],
                                        'Kunci Roda' => ['status' => $row['cek_kunci_roda'], 'foto' => $row['kunci_roda_foto']]
                                    ],
                                    'Sistem' => [
                                        'Air Radiator' => ['status' => $row['cek_air_radiator'], 'foto' => $row['air_radiator_foto']],
                                        'Bahan Bakar' => ['status' => $row['cek_bahan_bakar'], 'foto' => $row['bahan_bakar_foto']],
                                        'Tekanan Ban' => ['status' => $row['cek_tekanan_ban'], 'foto' => $row['tekanan_ban_foto']],
                                        'Rem' => ['status' => $row['cek_rem'], 'foto' => '']
                                    ]
                                ];
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                <td><?php echo htmlspecialchars($row['plat_mobil']); ?></td>
                                <td><?php echo htmlspecialchars($carName); ?></td>
                                <td><?php echo date("d/m/Y H:i", strtotime($row['created_at'])); ?></td>
                                
                                <!-- Komponen Button -->
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#komponenModal<?php echo $no; ?>">
                                        Lihat Komponen
                                    </button>
                                    
                                    <!-- Modal Komponen -->
                                    <div class="modal fade" id="komponenModal<?php echo $no; ?>" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Komponen</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="accordion" id="accordionKomponen<?php echo $no; ?>">
                                                        <?php foreach ($komponenList as $kategori => $items): ?>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                                                        data-bs-target="#collapse<?php echo $kategori.$no; ?>">
                                                                    <?php echo $kategori; ?>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse<?php echo $kategori.$no; ?>" class="accordion-collapse collapse">
                                                                <div class="accordion-body">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-sm">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Komponen</th>
                                                                                    <th>Status</th>
                                                                                    <th>Foto</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php foreach ($items as $nama => $data): ?>
                                                                                <tr>
                                                                                    <td><?php echo $nama; ?></td>
                                                                                    <td>
                                                                                        <span class="badge <?php echo strtolower($data['status']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                                                                            <?php echo htmlspecialchars($data['status']); ?>
                                                                                        </span>
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php if (!empty($data['foto'])): ?>
                                                                                            <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['foto']); ?>')">
                                                                                                <i class="fas fa-image"></i>
                                                                                            </button>
                                                                                        <?php else: ?>
                                                                                            <span class="text-muted">-</span>
                                                                                        <?php endif; ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php endforeach; ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Interior Status -->
                                <td>
                                    <?php
                                    $interior_status = array_column($komponenList['Interior'], 'status');
                                    $all_good = array_reduce($interior_status, function($carry, $item) {
                                        return $carry && strtolower($item) === 'baik';
                                    }, true);
                                    ?>
                                    <span class="badge <?php echo $all_good ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $all_good ? 'Baik' : 'Perlu Perbaikan'; ?>
                                    </span>
                                </td>

                                <!-- Dokumen Status -->
                                <td>
                                    <?php
                                    $dokumen_status = array_column($komponenList['Dokumen'], 'status');
                                    $all_good = array_reduce($dokumen_status, function($carry, $item) {
                                        return $carry && strtolower($item) === 'baik';
                                    }, true);
                                    ?>
                                    <span class="badge <?php echo $all_good ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $all_good ? 'Lengkap' : 'Tidak Lengkap'; ?>
                                    </span>
                                </td>

                                <!-- Sistem Status -->
                                <td>
                                    <?php
                                    $sistem_status = array_column($komponenList['Sistem'], 'status');
                                    $all_good = array_reduce($sistem_status, function($carry, $item) {
                                        return $carry && strtolower($item) === 'baik';
                                    }, true);
                                    ?>
                                    <span class="badge <?php echo $all_good ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $all_good ? 'Baik' : 'Perlu Perbaikan'; ?>
                                    </span>
                                </td>

                                <!-- Overall Status -->
                                <td>
                                    <span class="badge <?php echo $row['status'] == 'Aman' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>

                                <!-- Notes -->
                                <td>
                                    <?php if (!empty($row['catatan'])): ?>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="popover" 
                                            title="Catatan Pemeriksaan" 
                                            data-bs-content="<?php echo htmlspecialchars($row['catatan']); ?>">
                                        <i class="fas fa-sticky-note"></i>
                                    </button>
                                    <?php else: ?>
                                    <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- Actions -->
                                <td>
                                    <div class="btn-group">
                                        <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteInspection(<?php echo $row['id']; ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" class="img-fluid" alt="Preview" style="max-height: 80vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a id="downloadImage" href="" class="btn btn-sm btn-primary" download>
                    <i class="fas fa-download"></i> Unduh Foto
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    // Initialize image preview modal
let imagePreviewModal = null;
let currentImageSrc = '';

document.addEventListener('DOMContentLoaded', function() {
    imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
    
    // Initialize zoom functionality
    const previewImage = document.getElementById('previewImage');
    previewImage.addEventListener('click', function() {
        this.classList.toggle('zoomed');
    });
});

function viewImage(imagePath) {
    try {
        // Get the elements
        const previewImage = document.getElementById('previewImage');
        const downloadLink = document.getElementById('downloadImage');
        
        // Construct the full image path if needed
        // Assuming images are stored in an 'uploads' directory
        const fullImagePath = imagePath.startsWith('http') ? imagePath : `../form/uploads/${imagePath}`;
        
        // Set the image source
        previewImage.src = fullImagePath;
        currentImageSrc = fullImagePath;
        
        // Set the download link
        downloadLink.href = fullImagePath;
        
        // Show the modal
        imagePreviewModal.show();
        
        // Reset zoom when opening new image
        previewImage.classList.remove('zoomed');
        
        // Handle image load error
        previewImage.onerror = function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal memuat gambar. File mungkin tidak ada atau rusak.'
            });
            imagePreviewModal.hide();
        };
    } catch (error) {
        console.error('Error viewing image:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Terjadi kesalahan saat membuka gambar.'
        });
    }
}

// Function to handle keyboard navigation
document.addEventListener('keydown', function(e) {
    if (imagePreviewModal && imagePreviewModal._isShown) {
        if (e.key === 'Escape') {
            imagePreviewModal.hide();
        }
    }
});

// Prevent right-click on preview image
document.getElementById('previewImage').addEventListener('contextmenu', function(e) {
    e.preventDefault();
});

// Update the table cell where you show the image button
function updateImageButton(buttonElement, imagePath) {
    if (imagePath && imagePath.trim() !== '') {
        buttonElement.innerHTML = `
            <button class="btn btn-sm btn-primary" onclick="viewImage('${imagePath}')">
                <i class="fas fa-image"></i>
            </button>`;
    } else {
        buttonElement.innerHTML = '<span class="text-muted">-</span>';
    }
}
// Initialize popovers
var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl, {
        trigger: 'hover'
    })
})

// Initialize DataTables
$(document).ready(function() {
    $('#inspectionTable').DataTable({
        responsive: true,
        dom: 'Bfrtip',
        buttons: [],
        order: [[4, 'desc']], // Sort by date column descending
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
        }
    });
});

// Export to Excel function
function exportToExcel() {
    try {
        let table = document.getElementById("inspectionTable");
        let rows = [];
        
        // Get headers (excluding the Aksi column)
        let headers = [];
        for(let i = 0; i < table.rows[0].cells.length - 1; i++) {
            headers.push(table.rows[0].cells[i].textContent.trim());
        }
        rows.push(headers);
        
        // Get data
        for(let i = 1; i < table.rows.length; i++) {
            let row = [];
            for(let j = 0; j < table.rows[i].cells.length - 1; j++) {
                let cell = table.rows[i].cells[j];
                
                // Handle different cell contents
                let text = '';
                if (cell.querySelector('.badge')) {
                    text = cell.querySelector('.badge').textContent.trim();
                } else if (cell.querySelector('button.btn-info')) {
                    // For "Lihat Komponen" button, get the modal content
                    let modalId = cell.querySelector('button').getAttribute('data-bs-target');
                    let modal = document.querySelector(modalId);
                    if (modal) {
                        text = Array.from(modal.querySelectorAll('table tr'))
                            .map(tr => Array.from(tr.cells).map(td => td.textContent.trim()).join(': '))
                            .join('; ');
                    } else {
                        text = 'Lihat Detail';
                    }
                } else {
                    text = cell.textContent.trim();
                }
                row.push(text);
            }
            rows.push(row);
        }
        
        // Create workbook
        let wb = XLSX.utils.book_new();
        let ws = XLSX.utils.aoa_to_sheet(rows);
        
        // Auto-size columns
        const max_width = rows.reduce((w, r) => Math.max(w, r.length), 0);
        ws['!cols'] = Array(max_width).fill({ wch: 15 });
        
        // Add worksheet to workbook
        XLSX.utils.book_append_sheet(wb, ws, "Pemeriksaan Kendaraan");
        
        // Generate Excel file
        let today = new Date().toISOString().slice(0,10);
        XLSX.writeFile(wb, `Laporan_Pemeriksaan_Kendaraan_${today}.xlsx`);
        
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: 'File Excel berhasil diunduh!'
        });
    } catch (error) {
        console.error('Export Excel error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan saat mengekspor Excel!'
        });
    }
}

// Export to PDF function
function exportToPDF() {
    try {
        const table = document.getElementById('inspectionTable');
        const today = new Date().toISOString().slice(0,10);
        
        // Configure html2canvas
        html2canvas(table, {
            scale: 2,
            logging: false,
            useCORS: true
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            
            // Initialize jsPDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF({
                orientation: 'landscape',
                unit: 'pt',
                format: 'a4'
            });
            
            // Add title
            doc.setFontSize(18);
            doc.text('Laporan Pemeriksaan Kendaraan', 40, 40);
            doc.setFontSize(12);
            doc.text(`Tanggal: ${today}`, 40, 60);
            
            // Calculate dimensions
            const imgWidth = doc.internal.pageSize.getWidth() - 80;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            
            // Add table image
            doc.addImage(imgData, 'PNG', 40, 80, imgWidth, imgHeight);
            
            // Save PDF
            doc.save(`Laporan_Pemeriksaan_Kendaraan_${today}.pdf`);
            
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'File PDF berhasil diunduh!'
            });
        });
    } catch (error) {
        console.error('Export PDF error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan saat mengekspor PDF!'
        });
    }
}

// Delete confirmation function
function deleteInspection(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Anda yakin ingin menghapus data pemeriksaan ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `delete.php?id=${id}`;
        }
    })
}

// Function to handle status changes and update overall status
function updateOverallStatus() {
    const components = document.querySelectorAll('[data-component-status]');
    let allGood = true;
    
    components.forEach(component => {
        if (component.dataset.componentStatus === 'buruk') {
            allGood = false;
        }
    });
    
    const statusBadge = document.querySelector('#overallStatus');
    statusBadge.className = `badge ${allGood ? 'bg-success' : 'bg-danger'}`;
    statusBadge.textContent = allGood ? 'Aman' : 'Perlu Perbaikan';
}

// Initialize tooltips
var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})

// Handle modal image zoom
document.getElementById('previewImage').addEventListener('click', function() {
    this.classList.toggle('img-zoom');
});

// Print function
function printInspection(id) {
    window.open(`print.php?id=${id}`, '_blank', 'width=800,height=600');
}
</script>

<!-- Add necessary CSS -->
<style>
    /* komponen lihat detail */
    <style>
.img-fluid.zoomed {
    transform: scale(1.5);
    transition: transform 0.3s ease;
    cursor: zoom-out;
}

.img-fluid {
    transition: transform 0.3s ease;
    cursor: zoom-in;
}

.modal-body {
    overflow: auto;
    max-height: 80vh;
}

.img-zoom {
    transform: scale(1.5);
    transition: transform 0.3s ease;
}

.table td, .table th {
    vertical-align: middle;
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0c63e4;
}

.badge {
    font-size: 0.875rem;
}
    /* sampai sini komponen lihat detail */

/* Responsive adjustments */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-group {
        display: flex;
        flex-direction: column;
    }
    
    .btn-group .btn {
        margin: 2px 0;
    }
}
</style>
            
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