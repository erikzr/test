<?php
session_start();

// Fungsi untuk menangani error
function handleError($message) {
    echo "<div class='alert alert-danger'>Error: $message</div>";
    error_log($message);
}

// koneksi kedatabase
include 'auth/koneksi.php';

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" rel="stylesheet">
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
        /* Mengatur container utama */
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Mengatur tabel responsive */
    .table-responsive {
        margin: 0;
        padding: 0;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Mengatur lebar minimum tabel */
    #inspectionTable {
        margin-bottom: 0;
    }

    /* Mengatur cell pada tabel */
    #inspectionTable th,
    #inspectionTable td {
        white-space: nowrap;
        vertical-align: middle;
    }

    /* Mengatur modal dialog */
    .modal-dialog.modal-lg {
        max-width: 90%;
        margin: 1.75rem auto;
    }

    /* Mengatur pagination agar tetap di posisinya */
    .dataTables_wrapper .dataTables_paginate {
        position: sticky;
        bottom: 0;
        background: white;
        padding: 10px 0;
        border-top: 1px solid #dee2e6;
        margin-top: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .modal-dialog.modal-lg {
            max-width: 95%;
        }
        
        .btn-group {
            display: flex;
            flex-direction: row;
            gap: 2px;
        }
    }

    /* Mengatur ukuran tombol pada tabel */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
        const style = document.createElement('style');
        style.textContent = `
            .card {
                border-radius: 15px;
                border: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }
            
            .card-header {
                background-color: transparent;
                border-bottom: 1px solid rgba(0,0,0,0.05);
                padding: 1.5rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .component-chart {
                position: relative;
                margin: auto;
                height: 250px;
                width: 100%;
            }
            
            .badge {
                padding: 0.5em 1em;
                font-weight: 500;
                border-radius: 30px;
            }
            
            .list-unstyled li {
                margin-bottom: 0.5rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .text-muted {
                color: #6c757d !important;
            }
        `;
        document.head.appendChild(style);
        .status-aman { color: #28a745; }
        .status-perhatian { color: #dc3545; }
        .card-stats { transition: transform .2s; }
        .card-stats:hover { transform: scale(1.05); }
        .table-responsive { max-height: 500px; overflow-y: auto; }
        .component-chart { height: 200px; margin-bottom: 20px; }
/* CSS untuk sidebar */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    transition: all 0.3s ease;
}

.sidebar.collapsed {
    width: 60px;
}

.sidebar.collapsed .logo-title,
.sidebar.collapsed .item-name {
    display: none;
}

.sidebar-header {
    padding: 15px;
}

.sidebar-body {
    height: calc(100vh - 70px);
}

.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
}

/* Responsive */
@media (max-width: 991px) {
    .sidebar {
        width: 60px;
    }
    
    .sidebar .logo-title,
    .sidebar .item-name {
        display: none;
    }
    
    .sidebar:hover {
        width: 250px;
    }
    
    .sidebar:hover .logo-title,
    .sidebar:hover .item-name {
        display: inline;
    }
}

.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

/* Style saat sidebar collapse */
.sidebar.collapsed .logout-btn span {
    display: none;
}

.sidebar.collapsed .logout-btn {
    width: 40px;
    left: 50%;
    transform: translateX(-50%);
}

/* Hover effect */
.logout-btn:hover {
    opacity: 0.9;
}

/* Responsive styling */
@media (max-width: 991px) {
    .sidebar .logout-btn span {
        display: none;
    }
    
    .sidebar .logout-btn {
        width: 40px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .sidebar:hover .logout-btn {
        width: calc(100% - 30px);
        left: 15px;
        transform: none;
    }
    
    .sidebar:hover .logout-btn span {
        display: inline;
    }
}

            /* komponen lihat detail */
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

        /* Custom styling untuk SweetAlert */
.custom-swal-popup {
    border-radius: 15px !important;
    padding: 20px !important;
}

.custom-swal-title {
    font-size: 24px !important;
    color: #333 !important;
}

.custom-swal-confirm-button {
    padding: 12px 30px !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    letter-spacing: 0.5px !important;
}

.custom-swal-cancel-button {
    padding: 12px 30px !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    letter-spacing: 0.5px !important;
}

/* Animasi loading custom */
.swal2-loading {
    border-radius: 50% !important;
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .custom-swal-popup {
        background: #1a1a1a !important;
    }
    
    .custom-swal-title {
        color: #fff !important;
    }
    
    .swal2-html-container {
        color: #ddd !important;
    }
}

.icon-30 {
    height: 1.875rem;
    width: 1.875rem;
    margin-left: -15px; /* Sesuaikan nilai ini */
}

.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
    padding: 4px 2px; /* 4px untuk vertikal, 20px untuk horizontal */
    border: none;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
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
            <img src="../kmnf.png" alt="Kominfo Logo" class="icon-30">

                <h4 class="logo-title" style="font-size:20px">Dashboard Admin</h4>
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
        <button class="logout-btn btn btn-danger w-100" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span class="ms-2">Logout</span>
        </button>
    </aside>
        
        <main class="main-content">
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="#" class="navbar-brand">
                        <h4 class="logo-title">Pemeriksaan Kendaraan</h4>
                    </a>
                </div>
            </nav>
            
            <div class="container-fluid content-inner mt-5 py-0">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card card-stats bg-info text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-white mb-0">Total Inspeksiii</h5>
                                        <span class="h2 font-weight-bold mb-0" style="color:white;"><?php echo $totalInspeksi; ?></span>
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
                                        <span class="h2 font-weight-bold mb-0" style="color:white;"><?php echo number_format($persentaseAman, 1); ?>%</span>
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
                                        <span class="h2 font-weight-bold mb-0" style="color:white;"><?php echo $perluPerhatian; ?></span>
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
                
               
<!-- Filter Section -->
<!-- Tabel Pemeriksaan Kendaraan -->
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
            
            <!-- Filter Controls -->
            <div class="card-body pb-0">
                <form id="filterForm" class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="startDate" name="startDate">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Mobil</label>
                        <select class="form-select" id="carType" name="carType">
                            <option value="">Semua Mobil</option>
                            <option value="Inova Lama">Inova Lama</option>
                            <option value="Inova Reborn">Inova Reborn</option>
                            <option value="Kijang Kapsul">Kijang Kapsul</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter me-2"></i>Filter
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            <i class="fas fa-undo me-2"></i>Reset
                        </button>
                    </div>
                </form>
            </div>

                <!-- Tambahkan container dengan max-width -->
                <div class="container-fluid px-3">
                    <div class="card mb-3">
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover mb-0" id="inspectionTable">
                                    <thead>
                                        <tr>
                                            <th class="px-2" style="width: 5%">No</th>
                                            <th class="px-2" style="width: 15%">Nama Petugas</th>
                                            <th class="px-2" style="width: 12%">Plat Mobil</th>
                                            <th class="px-2" style="width: 13%">Nama Mobil</th>
                                            <th class="px-2" style="width: 15%">Tanggal Pemeriksaan</th>
                                            <th class="px-2" style="width: 25%">Komponen</th>
                                            <th class="px-2" style="width: 15%">Aksi</th>
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
                                                    'Rem' => ['status' => $row['cek_rem'], 'foto' => $row['tekanan_ban_foto']]
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
<script>
    
            document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTables
            $('#inspectionTable').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                buttons: [],
                order: [[4, 'desc']],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
                }
            });

            // Initialize Bootstrap components
            initializeBootstrapComponents();
            
            // Initialize Charts
            initializeCharts();
            
            // Initialize Image Preview
            initializeImagePreview();
            
            // Add card hover effects
            initializeCardHoverEffects();
            });

            // Bootstrap Components Initialization
            function initializeBootstrapComponents() {
                // Setup Popovers
                const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                const popoverList = popoverTriggerList.map(popoverTriggerEl => 
                    new bootstrap.Popover(popoverTriggerEl, { trigger: 'hover' })
                );

                // Setup Tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                const tooltipList = tooltipTriggerList.map(tooltipTriggerEl => 
                    new bootstrap.Tooltip(tooltipTriggerEl)
                );

                // Handle Modal States
                initializeModals();
            }

            // Modal Management
            function initializeModals() {
                function cleanupModalState() {
                    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                    document.body.classList.remove('modal-open');
                }

                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    const modalInstance = new bootstrap.Modal(modal);

                    modal.addEventListener('show.bs.modal', () => cleanupModalState());
                    modal.addEventListener('shown.bs.modal', () => {
                        if (document.querySelectorAll('.modal-backdrop').length > 1) {
                            document.querySelectorAll('.modal-backdrop').forEach((backdrop, index) => {
                                if (index > 0) backdrop.remove();
                            });
                        }
                    });
                    modal.addEventListener('hidden.bs.modal', () => cleanupModalState());
                });

                document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                    button.addEventListener('click', () => cleanupModalState());
                });
            }

            // Chart Initialization and Management
            document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk membuat gradient
            function createGradient(ctx, colorStart, colorEnd) {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, colorStart);
                gradient.addColorStop(1, colorEnd);
                return gradient;
            }

            // Fungsi untuk membuat chart
            function createInspectionChart(canvas) {
                const ctx = canvas.getContext('2d');
                const cardBody = canvas.closest('.card-body');
                const cardHeader = canvas.closest('.card').querySelector('.card-header');
                
                // Ambil data
                const persentaseBaik = parseFloat(cardBody.querySelector('.badge.bg-success').textContent.match(/\d+/)[0]);
                const persentaseBuruk = parseFloat(cardBody.querySelector('.badge.bg-danger').textContent.match(/\d+/)[0]);
                
                // Buat gradients
                const greenGradient = createGradient(ctx, 'rgba(40, 167, 69, 0.9)', 'rgba(40, 167, 69, 0.6)');
                const redGradient = createGradient(ctx, 'rgba(220, 53, 69, 0.9)', 'rgba(220, 53, 69, 0.6)');

                return new Chart(canvas, {
                    type: 'doughnut',
                    data: {
                        labels: ['Komponen Baik', 'Perlu Perbaikan'],
                        datasets: [{
                            data: [persentaseBaik, persentaseBuruk],
                            backgroundColor: [greenGradient, redGradient],
                            borderColor: ['#28a745', '#dc3545'],
                            borderWidth: 2,
                            borderRadius: 5,
                            offset: 5,
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        cutout: '65%',
                        animation: {
                            animateRotate: true,
                            animateScale: true
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    padding: 20,
                                    font: {
                                        size: 12,
                                        family: "'Segoe UI', 'Arial', sans-serif",
                                        weight: 500
                                    },
                                    usePointStyle: true,
                                    pointStyle: 'circle'
                                }
                            },
                            tooltip: {
                                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                padding: 12,
                                bodyFont: {
                                    size: 14
                                },
                                callbacks: {
                                    label: function(context) {
                                        return `${context.label}: ${context.raw}%`;
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Status Komponen',
                                padding: {
                                    top: 10,
                                    bottom: 20
                                },
                                font: {
                                    size: 16,
                                    family: "'Segoe UI', 'Arial', sans-serif",
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                });
            }

            // Inisialisasi semua chart
            const charts = document.querySelectorAll('.component-chart canvas');
            const chartInstances = Array.from(charts).map(canvas => createInspectionChart(canvas));
            
            // Simpan instances untuk referensi global jika diperlukan
            window.chartInstances = chartInstances;
            });

            // Image Preview Implementation
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize image preview functionality
            initializeImagePreview();
            
            // Initialize modals
            initializeModals();
        });

        function initializeImagePreview() {
            const imagePreviewModal = new bootstrap.Modal(document.getElementById('imagePreviewModal'));
            const previewImage = document.getElementById('previewImage');
            const downloadLink = document.getElementById('downloadImage');

            // Add click handler to all image preview buttons
            document.querySelectorAll('[onclick^="viewImage"]').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const imagePath = this.getAttribute('onclick').match(/'([^']+)'/)[1];
                    viewImage(imagePath);
                });
            });

            // Enhanced viewImage function with proper path handling and error checking
            window.viewImage = function(imagePath) {
                if (!imagePath) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Path gambar tidak ditemukan!'
                    });
                    return;
                }

                // Construct proper image path
                const fullImagePath = constructImagePath(imagePath);
                
                // Pre-load image to check if it exists
                const tempImg = new Image();
                tempImg.onload = function() {
                    previewImage.src = fullImagePath;
                    downloadLink.href = fullImagePath;
                    imagePreviewModal.show();
                };
                
                tempImg.onerror = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat gambar. File mungkin tidak ada atau rusak.'
                    });
                };
                
                tempImg.src = fullImagePath;
            };

            // Helper function to construct proper image path
            function constructImagePath(imagePath) {
                if (imagePath.startsWith('http')) {
                    return imagePath;
                }
                
                // Remove any leading slashes
                imagePath = imagePath.replace(/^\/+/, '');
                
                // Construct the full path - adjust this based on your folder structure
                return `../form/uploads/${imagePath}`;  // Adjust this path according to your directory structure
            }

            // Add zoom functionality
            if (previewImage) {
                previewImage.addEventListener('click', function() {
                    this.classList.toggle('zoomed');
                });
                
                // Prevent right-click on preview image
                previewImage.addEventListener('contextmenu', e => e.preventDefault());
            }
        }

        // Enhanced modal initialization
        function initializeModals() {
            const modals = document.querySelectorAll('.modal');
            
            modals.forEach(modal => {
                const modalInstance = new bootstrap.Modal(modal);
                
                modal.addEventListener('hidden.bs.modal', function() {
                    // Reset image zoom when modal is closed
                    const previewImage = this.querySelector('#previewImage');
                    if (previewImage) {
                        previewImage.classList.remove('zoomed');
                    }
                    
                    // Clean up modal state
                    cleanupModalState();
                });
            });
        }

        // Modal state cleanup
        function cleanupModalState() {
            document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.body.classList.remove('modal-open');
        }

        // Add necessary CSS styles
        const styleSheet = document.createElement('style');
        styleSheet.textContent = `
            #previewImage {
                transition: transform 0.3s ease;
                cursor: zoom-in;
                max-width: 100%;
                height: auto;
            }
            
            #previewImage.zoomed {
                transform: scale(1.5);
                cursor: zoom-out;
            }
            
            .modal-body {
                overflow: auto;
                text-align: center;
                padding: 20px;
            }
            
            .btn-image-preview {
                padding: 0.25rem 0.5rem;
                font-size: 0.875rem;
                line-height: 1.5;
                border-radius: 0.2rem;
            }
        `;
        document.head.appendChild(styleSheet);

            // Card Hover Effects
            function initializeCardHoverEffects() {
                document.querySelectorAll('.card').forEach(card => {
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-5px)';
                        this.style.boxShadow = '0 6px 15px rgba(0,0,0,0.1)';
                        this.style.transition = 'all 0.3s ease';
                    });

                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0)';
                        this.style.boxShadow = 'none';
                    });
                });
            }

            // Sidebar Toggle
            const toggleSidebar = () => {
                document.querySelector('.sidebar').classList.toggle('collapsed');
            };

            document.body.insertAdjacentHTML('afterbegin', `
                <button 
                    class="btn btn-toggle" 
                    onclick="toggleSidebar()" 
                    style="position: fixed; top: 10px; left: 10px; z-index: 1000;">
                    <i class="fas fa-bars"></i>
                </button>
            `);

            // Utility Functions
            function handleLogout() {
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah Anda yakin ingin keluar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal',
                    background: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Logging out...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => Swal.showLoading()
                        });
                        
                        setTimeout(() => {
                            window.location.href = 'logout.php';
                        }, 800);
                    }
                });
            }

            function printInspection(id) {
                window.open(`print.php?id=${id}`, '_blank', 'width=800,height=600');
            }

            function deleteInspection(id) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah Anda yakin ingin menghapus data pemeriksaan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Menggunakan fetch untuk AJAX request
                    fetch('delete.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'id=' + id
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Terhapus!',
                                'Data pemeriksaan berhasil dihapus.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Gagal!',
                                data.message || 'Gagal menghapus data pemeriksaan.',
                                'error'
                            );
                        }
                    })
                    .catch(error => {
                        Swal.fire(
                            'Error!',
                            'Terjadi kesalahan saat menghapus data.',
                            'error'
                        );
                        console.error('Error:', error);
                    });
                }
            });
        }
            function exportToExcel() {
            try {
                // Initialize workbook
                const wb = XLSX.utils.book_new();
                const fileName = `Laporan_Pemeriksaan_Kendaraan_${new Date().toISOString().slice(0,10)}.xlsx`;

                // Get current date formatted in Indonesian format
                const currentDate = new Date().toLocaleDateString('id-ID', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                }).split('/').join('-');

                // Prepare data structure
                const data = [];
                const table = document.getElementById("inspectionTable");
                const rows = Array.from(table.querySelectorAll('tr')).slice(1);

                // Process each row
                rows.forEach(row => {
                    const id = row.cells[0].textContent.trim();
                    const nama = row.cells[1].textContent.trim();
                    const platMobil = row.cells[2].textContent.trim();
                    let tanggalPemeriksaan = row.cells[row.cells.length - 2].textContent.trim() || currentDate;
                    let tanggalUpdate = row.cells[row.cells.length - 1].textContent.trim() || currentDate;

                    // Get modal data
                    const detailsButton = row.querySelector('button[data-bs-toggle="modal"]');
                    if (detailsButton) {
                        const modalId = detailsButton.getAttribute('data-bs-target');
                        const modal = document.querySelector(modalId);
                        
                        if (modal) {
                            const vehicleData = {
                                'ID': id,
                                'Nama': nama,
                                'Plat Mobil': platMobil,
                                'Tanggal Pemeriksaan': tanggalPemeriksaan,
                                'Tanggal Update': tanggalUpdate
                            };

                            // Get component statuses
                            const modalRows = modal.querySelectorAll('tbody tr');
                            modalRows.forEach(modalRow => {
                                const cells = modalRow.querySelectorAll('td');
                                if (cells.length >= 2) {
                                    const componentName = cells[0].textContent.trim();
                                    const status = cells[1].textContent.trim();
                                    if (!componentName.toLowerCase().includes('foto')) {
                                        vehicleData[componentName] = status;
                                    }
                                }
                            });

                            data.push(vehicleData);
                        }
                    }
                });

                // Create worksheet with enhanced header styling
                const ws = XLSX.utils.json_to_sheet(data, {
                    header: [
                        'ID', 'Nama', 'Plat Mobil', 'Tanggal Pemeriksaan', 'Tanggal Update',
                        'Oli Mesin', 'Oli Power Steering', 'Oli Transmisi', 'Minyak Rem',
                        'Lampu Utama', 'Lampu Sein', 'Lampu Rem', 'Klakson', 'Aki',
                        'Kursi', 'Lantai', 'Dinding', 'Kap',
                        'STNK', 'APAR', 'P3K', 'Kunci Roda',
                        'Air Radiator', 'Bahan Bakar', 'Tekanan Ban', 'Rem'
                    ]
                });

                // Enhanced column widths
                ws['!cols'] = [
                    { wch: 8 },   // ID
                    { wch: 20 },  // Nama
                    { wch: 15 },  // Plat Mobil
                    { wch: 18 },  // Tanggal Pemeriksaan
                    { wch: 18 },  // Tanggal Update
                    ...Array(21).fill({ wch: 16 }) // Component columns
                ];

                // Apply professional styling
                const range = XLSX.utils.decode_range(ws['!ref']);
                for (let R = range.s.r; R <= range.e.r; R++) {
                    for (let C = range.s.c; C <= range.e.c; C++) {
                        const cell_address = { c: C, r: R };
                        const cell_ref = XLSX.utils.encode_cell(cell_address);
                        
                        if (!ws[cell_ref]) continue;

                        // Header row styling
                        if (R === 0) {
                            ws[cell_ref].s = {
                                font: { 
                                    bold: true, 
                                    color: { rgb: "FFFFFF" },
                                    name: "Arial",
                                    sz: 12
                                },
                                fill: { 
                                    patternType: "solid",
                                    fgColor: { rgb: "1F4E78" } // Darker blue for headers
                                },
                                alignment: { 
                                    horizontal: "center",
                                    vertical: "center",
                                    wrapText: true
                                },
                                border: {
                                    top: { style: "medium", color: { rgb: "B4C6E7" } },
                                    bottom: { style: "medium", color: { rgb: "B4C6E7" } },
                                    left: { style: "medium", color: { rgb: "B4C6E7" } },
                                    right: { style: "medium", color: { rgb: "B4C6E7" } }
                                }
                            };
                        } 
                        // Data rows styling
                        else {
                            const value = ws[cell_ref].v;
                            ws[cell_ref].s = {
                                font: {
                                    name: "Arial",
                                    sz: 11,
                                    color: { rgb: "000000" }
                                },
                                alignment: {
                                    horizontal: C <= 4 ? "left" : "center",
                                    vertical: "center"
                                },
                                border: {
                                    top: { style: "thin", color: { rgb: "B4C6E7" } },
                                    bottom: { style: "thin", color: { rgb: "B4C6E7" } },
                                    left: { style: "thin", color: { rgb: "B4C6E7" } },
                                    right: { style: "thin", color: { rgb: "B4C6E7" } }
                                },
                                fill: {
                                    patternType: "solid",
                                    fgColor: { rgb: R % 2 === 0 ? "EDF3FA" : "FFFFFF" } // Light blue alternating rows
                                }
                            };

                            // Status styling with improved colors
                            if (C >= 5) {
                                if (value === 'baik') {
                                    ws[cell_ref].s.font.color = { rgb: "1E6C41" }; // Darker green
                                    ws[cell_ref].s.fill = {
                                        patternType: "solid",
                                        fgColor: { rgb: "E2EFDA" }
                                    };
                                } else if (value === 'tidak_baik') {
                                    ws[cell_ref].s.font.color = { rgb: "843C39" }; // Darker red
                                    ws[cell_ref].s.fill = {
                                        patternType: "solid",
                                        fgColor: { rgb: "FFE6E6" }
                                    };
                                }
                            }

                            // Date columns formatting
                            if (C === 3 || C === 4) {
                                ws[cell_ref].z = 'dd-mm-yyyy';
                            }
                        }
                    }
                }

                // Set row heights
                ws['!rows'] = [
                    { hpt: 30 }, // Header row
                    ...Array(range.e.r).fill({ hpt: 25 }) // Data rows
                ];

                // Add worksheet to workbook
                XLSX.utils.book_append_sheet(wb, ws, "Laporan Pemeriksaan");
                
                // Export file
                XLSX.writeFile(wb, fileName);
                
                // Success notification
                Swal.fire({
                    icon: 'success',
                    title: 'Ekspor Berhasil',
                    text: 'File Excel berhasil diunduh!',
                    confirmButtonColor: '#28a745',
                    timer: 2000,
                    timerProgressBar: true
                });
                
            } catch (error) {
                console.error('Error saat mengekspor Excel:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Ekspor Gagal',
                    text: 'Terjadi kesalahan saat mengekspor data ke Excel!',
                    confirmButtonColor: '#dc3545'
                });
            }
            }
            // Fungsi untuk mengekspor ke PDF
            function exportToPDF() {
                try {
                    const table = document.getElementById('inspectionTable');
                    const today = new Date().toISOString().slice(0,10);
                    
                    const { jsPDF } = window.jspdf;
                    const doc = new jsPDF({
                        orientation: 'landscape',
                        unit: 'mm',
                        format: 'a2' // Menggunakan ukuran A2 untuk memuat lebih banyak data
                    });
                    
                    // Header
                    doc.setFontSize(16);
                    doc.text('LAPORAN PEMERIKSAAN KENDARAAN', 15, 15);
                    doc.setFontSize(12);
                    doc.text(`Tanggal Cetak: ${today}`, 15, 25);
                    
                    // Mengumpulkan data untuk tabel
                    const tableData = [];
                    const headers = [
                        ['Informasi Kendaraan', 'Status Komponen', 'Foto Komponen', 'Waktu']
                    ];
                    
                    // Mengambil data dari tabel dan modal
                    const rows = Array.from(table.querySelectorAll('tr')).slice(1);
                    rows.forEach(tr => {
                        const detailsButton = tr.querySelector('button[data-bs-toggle="modal"]');
                        if (detailsButton) {
                            const modalId = detailsButton.getAttribute('data-bs-target');
                            const modal = document.querySelector(modalId);
                            
                            if (modal) {
                                const vehicleInfo = {
                                    id: tr.cells[0].textContent.trim(),
                                    nama: tr.cells[1].textContent.trim(),
                                    plat: tr.cells[2].textContent.trim()
                                };
                                
                                const modalRows = modal.querySelectorAll('tbody tr');
                                modalRows.forEach(modalRow => {
                                    const cells = modalRow.querySelectorAll('td');
                                    if (cells.length >= 2) {
                                        tableData.push([
                                            `ID: ${vehicleInfo.id}\nNama: ${vehicleInfo.nama}\nPlat: ${vehicleInfo.plat}`,
                                            `${cells[0].textContent.trim()}: ${cells[1].textContent.trim()}`,
                                            cells[1].querySelector('img') ? 'Ada Foto' : 'Tidak Ada Foto',
                                            `Pemeriksaan: ${tr.cells[tr.cells.length - 2].textContent.trim()}\nUpdate: ${tr.cells[tr.cells.length - 1].textContent.trim()}`
                                        ]);
                                    }
                                });
                            }
                        }
                    });
                    
                    // Membuat tabel PDF
                    doc.autoTable({
                        head: headers,
                        body: tableData,
                        startY: 30,
                        styles: {
                            fontSize: 8,
                            cellPadding: 2
                        },
                        columnStyles: {
                            0: {cellWidth: 60}, // Informasi Kendaraan
                            1: {cellWidth: 60}, // Status Komponen
                            2: {cellWidth: 30}, // Foto
                            3: {cellWidth: 40}  // Waktu
                        },
                        didDrawPage: function(data) {
                            // Nomor halaman
                            doc.setFontSize(8);
                            doc.text(
                                `Halaman ${doc.internal.getNumberOfPages()}`,
                                doc.internal.pageSize.width - 20,
                                doc.internal.pageSize.height - 10
                            );
                        }
                    });
                    
                    doc.save(`Laporan_Pemeriksaan_Kendaraan_${today}.pdf`);
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'File PDF berhasil diunduh!'
                    });
                } catch (error) {
                    console.error('Error ekspor PDF:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat mengekspor PDF!'
                    });
                }
            }

            // Status Management
            function updateOverallStatus() {
                const components = document.querySelectorAll('[data-component-status]');
                const allGood = Array.from(components)
                    .every(component => component.dataset.componentStatus !== 'buruk');
                
                const statusBadge = document.querySelector('#overallStatus');
                if (statusBadge) {
                    statusBadge.className = `badge ${allGood ? 'bg-success' : 'bg-danger'}`;
                    statusBadge.textContent = allGood ? 'Aman' : 'Perlu Perbaikan';
                }
            }

            // Event Listeners
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    if (imagePreviewModal && imagePreviewModal._isShown) {
                        imagePreviewModal.hide();
                    }
                    cleanupModalState();
                }
            });

            // Global Event Handlers
            window.addEventListener('load', function() {
                // Initialize overall status on page load
                updateOverallStatus();
                
                // Add any global event handlers that need to run after page load
                document.addEventListener('visibilitychange', function() {
                    if (document.visibilityState === 'visible') {
                        // Refresh charts if needed
                        if (typeof chartInstances !== 'undefined') {
                            chartInstances.forEach(chart => chart.update());
                        }
                    }
                });
            });

            // Format Utilities
            function formatNumber(num) {
                return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            // Helper function for error handling
            function handleError(error, operation) {
                console.error(`Error during ${operation}:`, error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: `Terjadi kesalahan saat ${operation}`
                });
            }

            // Register service worker if supported
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', () => {
                    navigator.serviceWorker.register('/sw.js').catch(error => {
                        console.error('ServiceWorker registration failed:', error);
                    });
                });
            }
</script>
    <script src="../assets/js/core/libs.min.js"></script>
    <script src="../assets/js/hope-ui.js"></script>
    <!-- Untuk Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <!-- Untuk PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
</body>
</html>