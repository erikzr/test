<?php
session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkcar";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Query untuk mengambil data
$sql = "SELECT * FROM servicerutin ORDER BY created_at DESC";
$result = $conn->query($sql);

$no = 1;


// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk menangani error
function handleError($message) {
    echo "<div class='alert alert-danger'>Error: $message</div>";
    error_log($message);
}

// Mengambil data pemeriksaan terbaru dari `vehicle_inspection`
$sqlInspection = "SELECT * FROM vehicle_inspection ORDER BY created_at DESC";
$resultInspection = $conn->query($sqlInspection);

if (!$resultInspection) {
    handleError("Query error: " . $conn->error);
    exit();
}

// Menghitung statistik
$totalInspeksi = $resultInspection->num_rows;
$perluPerhatian = 0;
$inspeksiData = [];
$komponenStats = [];

while ($row = $resultInspection->fetch_assoc()) {
    $status = 'Aman';
    $totalKomponen = 0;
    $komponenBaik = 0;
    $komponenBuruk = 0;

    $komponenList = [
        'Oli Mesin', 'Oli Power Steering', 'Oli Transmisi',
        'Minyak Rem', 'Lampu Utama', 'Lampu Sein',
        'Lampu Rem', 'Lampu Klakson', 'Cek Aki'
    ];

    foreach ($komponenList as $komponen) {
        if (isset($row[$komponen])) {
            $totalKomponen++;
            if (strtolower(trim($row[$komponen])) === 'baik') {
                $komponenBaik++;
            } else {
                $komponenBuruk++;
            }
        }
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
        'komponen_baik' => $komponenBaik,
        'komponen_buruk' => $komponenBuruk,
        'detail_komponen' => array_map(function($komponen) use ($row) {
            return [
                'nama' => $komponen,
                'nilai' => $row[$komponen] ?? 'tidak ada'
            ];
        }, $komponenList)
    ];

    if ($komponenBuruk > 0) {
        $status = 'Perlu Perhatian';
        $perluPerhatian++;
    }

    $row['status'] = $status;
    $inspeksiData[] = $row;
}

// Total kendaraan yang perlu perhatian
$mobilPerluPerhatian = $perluPerhatian;
$mobilAman = $totalInspeksi - $perluPerhatian;

// Pagination logic
$itemsPerPage = 3;
$totalPages = ceil(count($komponenStats) / $itemsPerPage);
$currentPage = isset($_GET['page']) ? max(1, min($totalPages, intval($_GET['page']))) : 1;
$offset = ($currentPage - 1) * $itemsPerPage;
$currentPageItems = array_slice($komponenStats, $offset, $itemsPerPage);

// Menutup koneksi
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
    <!-- <script src="https://unpkg.com/jspdf-autotable@3.8.4/dist/jspdf.plugin.autotable.js"></script> -->
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
    max-height: 500px;
    overflow-y: auto;
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

/* Mengatur ukuran tombol pada tabel */
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

/* Styling untuk card */
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
    height: 200px;
    margin-bottom: 20px;
    width: 100%;
}

.badge {
    padding: 0.5em 1em;
    font-weight: 500;
    border-radius: 30px;
    font-size: 0.875rem;
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

/* Status styles */
.status-aman { 
    color: #28a745; 
}

.status-perhatian { 
    color: #dc3545; 
}

.card-stats { 
    transition: transform .2s; 
}

.card-stats:hover { 
    transform: scale(1.05); 
}

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
    height: calc(100vh - 50px);
}


/* CSS untuk Tombol Logout - Diperbarui */
.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
}

/* Ketika sidebar diciutkan */
.sidebar.collapsed .logout-btn {
    width: 28px;
    height: 28px;
    padding: 3px;
    left: 50%;
    transform: translateX(-50%);
}

.sidebar.collapsed .logout-btn span {
    display: none;
}

/* Styling untuk ikon logout */
.logout-btn i, 
.logout-btn svg {
    width: 16px;
    height: 16px;
}

/* Komponen lihat detail */
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

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0c63e4;
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

/* Ikon styling */
.icon-30 {
    height: 1.875rem;
    width: 1.875rem;
    margin-left: -15px;
}

/* Responsive styles */
@media (max-width: 992px) {
    .modal-dialog.modal-lg {
        max-width: 95%;
    }
    
    .btn-group {
        display: flex;
        flex-direction: row;
        gap: 2px;
    }
    
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
    
    .sidebar .logout-btn {
        width: 28px;
        height: 28px;
        padding: 3px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .sidebar .logout-btn span {
        display: none;
    }
    
    .sidebar:hover .logout-btn {
        width: calc(100% - 30px);
        left: 15px;
        transform: none;
        padding: 3px 8px;
    }
    
    .sidebar:hover .logout-btn span {
        display: inline;
    }
}

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

/* Efek hover untuk tombol logout */
.logout-btn:hover {
    opacity: 0.9;
    background-color: #c82333;
}

th {
    padding: 8px; /* Atur jarak dalam setiap kolom jika dibutuhkan */
}

th, td {
    padding: 10px 12px; /* Menambahkan jarak di dalam kolom */
    text-align: center; /* Menyelaraskan teks di tengah */
}

button.btn.btn-sm.btn-info:hover {
  background-color: rgb(5, 123, 130); /* Warna yang sedikit lebih gelap */
  /* Atau, gunakan filter untuk menggelapkan: */
  /* filter: brightness(90%); */
}

button.btn.btn-primary.w-50:hover {
  background-color: rgb(46, 69, 185);
}

button#resetButton:hover {
  background-color: rgb(0, 23, 58);
}

a.btn.btn-sm.btn-info.my-1:hover {
  background-color: rgb(5, 123, 130); /* Warna yang sedikit lebih gelap */
  /* Atau, gunakan filter untuk menggelapkan: */
  /* filter: brightness(90%); */
}

button.btn.btn-sm.btn-danger.my-1:hover {
  background-color: rgb(153, 40, 26); /* Warna yang sedikit lebih gelap */
  /* Atau, gunakan filter untuk menggelapkan: */
  /* filter: brightness(90%); */
}

button.btn.btn-primary:hover {
  background-color: rgb(46, 69, 185);
}

button.btn.btn-danger.ms-2:hover {
  background-color: rgba(0, 0, 0, 0.2); /* Overlay semi-transparan gelap */
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
                 <a class="nav-link" href="adminusers.php">
                    <i class="fas fa-users"></i>
                        <span class="item-name">Users</span>
                             </a>
                </li>
                </ul>
            </div>
        </div>
        <button class="logout-btn btn btn-danger w-90" onclick="handleLogout()">
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
                                <h5 class="card-title text-uppercase text-white mb-0">Total Inspeksi</h5>
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
                                <span class="h2 font-weight-bold mb-0" style="color:white;"><?php echo number_format($mobilAman); ?></span>
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
                        <h4 class="card-title">Kondisi Komponen per Kendaraan</h4>
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
                                            <span class="badge bg-success me-2">Baik: <?php echo $stat['komponen_baik']; ?></span>
                                            <span class="badge bg-danger">Perlu Perbaikan: <?php echo $stat['komponen_buruk']; ?></span>
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
                        <nav aria-label="Page navigation" class="mt-4">
                            <ul class="pagination justify-content-center">
                                <?php if ($currentPage > 1): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                </li>
                                <?php endfor; ?>
                                
                                <?php if ($currentPage < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                                <?php endif; ?>
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
                    <div class="card-body border-bottom">
                        <form id="filterForm" class="row g-3 align-items-end">
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
                                    <option value="W 1740 NP">Inova Lama</option>
                                    <option value="W 1507 NP">Inova Reborn</option>
                                    <option value="W 1374 NP">Kijang Kapsul</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary w-50" onclick="applyFilters()">
                                    <i class="fas fa-filter me-2"></i>Terapkan Filter
                                </button>
                                <button id="resetButton" type="button" class="btn btn-secondary w-50" onclick="resetFilters()">Reset</button>
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
                                        <th class="px-2" style="width: 10%">No</th>
                                        <th class="px-2" style="width: 15%">Nama Petugas</th>
                                        <th class="px-2" style="width: 10%">Plat Mobil</th>
                                        <th class="px-2" style="width: 10%">Nama Mobil</th>
                                        <th class="px-2" style="width: 15%">Tanggal Pemeriksaan</th>
                                        <th class="px-2" style="width: 15%">Komponen</th>
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
                                                    'Tekanan Ban' => ['status' => $row['cek_tekanan_ban'], 'foto' => $row['ban_foto']],
                                                    'Rem' => ['status' => $row['cek_rem'], 'foto' => $row['rem_foto']]

                                                ]
                                            ];
                                        ?>
                                        <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo htmlspecialchars($row['nama']); ?></td>
    <td><?php echo htmlspecialchars($row['plat_mobil']); ?></td>
    <td><?php echo htmlspecialchars($carName); ?></td>
    <td><?php echo date("d/m/Y H:i", strtotime($row['created_at'])); ?></td>
    <td>
        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#komponenModal<?php echo $no; ?>">
            Detail Komponen
        </button>
        <!-- Modal untuk Detail Komponen -->
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
                                            data-bs-target="#collapse<?php echo $kategori . $no; ?>">
                                        <?php echo $kategori; ?>
                                    </button>
                                </h2>
                                <div id="collapse<?php echo $kategori . $no; ?>" class="accordion-collapse collapse">
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

    <!-- Kolom Aksi -->
    <td>
        <div class="text-center">
            <!-- Tombol Lihat -->
            <a href="detail.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info my-1">
                <i class="fas fa-eye"></i> Lihat
            </a>
            <!-- Tombol Hapus -->
            <button class="btn btn-sm btn-danger my-1" onclick="deleteInspection(<?php echo $row['id']; ?>)">
                <i class="fas fa-trash"></i> Hapus
            </button>
        </div>
    </td>
</tr>
                                  
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

    <!-- Tabel Pemeriksaan service Kendaraan -->
    <div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Service Rutin Kendaraan</h4>
                <div>
                    <button class="btn btn-primary" onclick="exportServisToExcel()">
                        <i class="fas fa-file-excel me-2"></i>Export Excel
                    </button>
                    <button class="btn btn-danger ms-2" onclick="exportServisToPDF()">
                        <i class="fas fa-file-pdf me-2"></i>Export PDF
                    </button>
                </div>
            </div>
            <div class="card-body border-bottom">
                <form id="filterForm" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="startDate1" name="startDate">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" id="endDate1" name="endDate">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Jenis Mobil</label>
                        <select class="form-select" id="carType1" name="carType">
                            <option value="">Semua Mobil</option>
                            <option value="W 1740 NP">Inova Lama</option>
                            <option value="W 1507 NP">Inova Reborn</option>
                            <option value="W 1347 NP">Kijang Kapsul</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex justify-content-between">
                        <button type="button" class="btn btn-primary w-50" onclick="applyFiltersServisRutin()">
                            <i class="fas fa-filter me-2"></i>Terapkan Filter
                        </button>
                        <button id="resetButton" type="button" class="btn btn-secondary w-50" onclick="resetFilters()">Reset</button>
                    </div>
                </form>
            </div>
            <div class="container-fluid px-3">
                <div class="card mb-3">
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover mb-0" id="ServisRutin">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mobil</th>
                                        <th>Kilometer</th>
                                        <th>Tanggal Perbaikan</th>
                                        <th>Tanggal Selesai</th>
                                        <th>Jenis Service</th>
                                        <th>Item Service</th>
                                        <th>Keterangan</th>
                                        <th>Bukti Nota</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if ($result->num_rows > 0) {
                                        $no = 1; // Pastikan ini diinisialisasi
                                        while ($row = $result->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row['mobil']); ?></td>
                                                <td><?php echo htmlspecialchars($row['kilometer']); ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($row['tanggal_perbaikan'])); ?></td>
                                                <td><?php echo date("d/m/Y", strtotime($row['tanggal_selesai'])); ?></td>
                                                <td><?php echo htmlspecialchars($row['jenis_service']); ?></td>
                                                <td><?php echo htmlspecialchars($row['item_service']); ?></td>
                                                <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                                                <td>
                                                    <?php if ($row['bukti_nota']) { ?>
                                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#notaModal<?php echo $no; ?>">
                                                            <i class="fas fa-file-alt"></i> Lihat Nota
                                                        </button>
                                                        
                                                        <!-- Modal untuk Bukti Nota -->
                                                        <div class="modal fade" id="notaModal<?php echo $no; ?>" tabindex="-1">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Bukti Nota</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                    <img src="../form/uploadservice/<?php echo htmlspecialchars($row['bukti_nota']); ?>"                                                                            alt="Bukti Nota" 
                                                                            class="img-fluid" 
                                                                            style="max-height: 70vh; max-width: 100%;">
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="<?php echo htmlspecialchars($row['bukti_nota']); ?>" 
                                                                        target="_blank" 
                                                                        class="btn btn-secondary">
                                                                            Buka Gambar Penuh
                                                                        </a>
                                                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>
                                                        <span class="text-muted">Tidak ada</span>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button class="btn btn-sm btn-info my-1">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>
                                                        <button class="btn btn-sm btn-danger my-1" onclick="deleteInspection(<?php echo $row['id']; ?>)">
                                                            <i class="fas fa-trash"></i> Hapus
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php 
                                        }
                                    } else {
                                        echo "<tr><td colspan='10' class='text-center'>Tidak ada data ditemukan.</td></tr>";
                                    }
                                    ?>
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
// Function untuk format tanggal dari dd/mm/yyyy HH:ii ke yyyy-mm-dd format
function formatDate(dateString) {
    const [date, time] = dateString.split(' ');
    const [day, month, year] = date.split('/');
    return `${year}-${month}-${day}`;
}

// Function untuk cek apakah tanggal dalam range
function isDateInRange(dateStr, startDate, endDate) {
    if (!startDate && !endDate) return true;
    
    const date = new Date(formatDate(dateStr));
    const start = startDate ? new Date(startDate) : null;
    const end = endDate ? new Date(endDate) : null;
    
    if (start && end) {
        return date >= start && date <= end;
    } else if (start) {
        return date >= start;
    } else if (end) {
        return date <= end;
    }
    return true;
}

// Simpan kondisi awal tabel saat halaman dimuat
let originalTableState = null;
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById('inspectionTable');
    originalTableState = table.innerHTML;
});

//ServisRutin
function applyFiltersServisRutin() {
    const startDate = document.getElementById('startDate1').value;
    const endDate = document.getElementById('endDate1').value;
    const carType = document.getElementById('carType1').value;
    
    const table = document.getElementById('ServisRutin');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    let visibleCount = 0;
    
    for (let i = 0; i < rows.length; i++) {
        const plateCell = rows[i].getElementsByTagName('td')[1]; // Plat Mobil column
        const dateCell = rows[i].getElementsByTagName('td')[3];  // Tanggal Pemeriksaan column
        
        if (plateCell && dateCell) {
            const plateText = plateCell.textContent.trim();
            const dateText = dateCell.textContent.trim();
            
            const matchesCarType = !carType || plateText === carType;
            const matchesDate = isDateInRange(dateText, startDate, endDate);
            
            if (matchesCarType && matchesDate) {
                rows[i].style.display = '';
                visibleCount++;
                // Update nomor baris
                rows[i].getElementsByTagName('td')[0].textContent = visibleCount;
            } else {
                rows[i].style.display = 'none'; //or block
            }
        }
    }
}

// Function filter utama
function applyFilters() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const carType = document.getElementById('carType').value;
    
    const table = document.getElementById('inspectionTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    
    let visibleCount = 0;
    
    for (let i = 0; i < rows.length; i++) {
        const plateCell = rows[i].getElementsByTagName('td')[2]; // Plat Mobil column
        const dateCell = rows[i].getElementsByTagName('td')[4];  // Tanggal Pemeriksaan column
        
        if (plateCell && dateCell) {
            const plateText = plateCell.textContent.trim();
            const dateText = dateCell.textContent.trim();
            
            const matchesCarType = !carType || plateText === carType;
            const matchesDate = isDateInRange(dateText, startDate, endDate);
            
            if (matchesCarType && matchesDate) {
                rows[i].style.display = '';
                visibleCount++;
                // Update nomor baris
                rows[i].getElementsByTagName('td')[0].textContent = visibleCount;
            } else {
                rows[i].style.display = 'none'; //or block
            }
        }
    }
    
    // Update text menampilkan entri
    updateEntryInfo(visibleCount);
}

// Function untuk update info entri
function updateEntryInfo(count) {
    const showingText = document.querySelector('.dataTables_info');
    if (showingText) {
        if (count === 0) {
            showingText.textContent = 'Tidak ada data yang ditampilkan';
        } else {
            showingText.textContent = `Menampilkan 1 sampai ${count} dari ${count} entri`;
        }
    }
}

// Function reset yang mengembalikan tabel ke kondisi awal
function resetFilters() {
    // Reset form filter
    document.getElementById('filterForm').reset();
    
    // Kembalikan tabel ke kondisi awal
    const table = document.getElementById('inspectionTable');
    if (originalTableState) {
        table.innerHTML = originalTableState;
    }

    // Reset nilai filter
    document.getElementById('startDate').value = '';
    document.getElementById('endDate').value = '';
    if (document.getElementById('carType')) {
        document.getElementById('carType').selectedIndex = 0;
    }
    
    // Update informasi entri dengan jumlah total baris asli
    const totalRows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr').length;
    updateEntryInfo(totalRows);
}

// Event listener untuk tombol reset
document.getElementById('resetButton').addEventListener('click', function(e) {
    e.preventDefault();
    resetFilters();
});

// Event listener untuk form filter
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    applyFilters();
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

function exportServisToExcel() {
    try {
        // Ambil tabel dan semua baris yang visible
        const table = document.getElementById('ServisRutin');
        const visibleRows = Array.from(table.getElementsByTagName('tbody')[0].getElementsByTagName('tr'))
            .filter(row => row.style.display !== 'none');

        // Ambil header (kecuali kolom Aksi)
        const headers = Array.from(table.getElementsByTagName('thead')[0].getElementsByTagName('th'))
            .slice(0, -2)
            .map(th => th.textContent.trim());

        // Siapkan data dalam format yang benar untuk XLSX
        const filteredData = visibleRows.map(row => {
            return Array.from(row.getElementsByTagName('td'))
                .slice(0, -2)
                .map(td => {
                    // Bersihkan data dari karakter khusus dan format yang tidak perlu
                    let value = td.textContent.trim();

                    // Jika ini adalah tanggal, format dengan benar
                    if (value.includes('/')) {
                        const [date, time] = value.split(' ');
                        const [day, month, year] = date.split('/');
                        value = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                        if (time) {
                            value += ' ' + time;
                        }
                    }

                    return value;
                });
        });

        // Buat workbook dan worksheet
        const wb = XLSX.utils.book_new();
        const ws = XLSX.utils.aoa_to_sheet([headers, ...filteredData]);
        // Define column widths (set the width for each column based on the content or header)
        ws['!cols'] = headers.map((header, index) => {
            if (index === 0) return { wch: 8 }; // Example: First column (ID) gets width of 8
            if (header.toLowerCase().includes('mobil')) return { wch: 22 }; // Example: Name-related columns
            if (header.toLowerCase().includes('kilometer')) return { wch: 15 }; // Example: Date-related columns
            if (header.toLowerCase().includes('tanggal perbaikan')) return { wch: 18 }; // Example: Date-related columns
            if (header.toLowerCase().includes('tanggal selesai')) return { wch: 18 }; // Example: Date-related columns
            if (header.toLowerCase().includes('jenis service')) return { wch: 22 }; // Example: Date-related columns
            if (header.toLowerCase().includes('item service')) return { wch: 18 }; // Example: Date-related columns
            if (header.toLowerCase().includes('keterangan')) return { wch: 20 }; // Example: Date-related columns
            return { wch: 15 }; // Default width for other columns
        });
        // Tambahkan worksheet ke workbook
        XLSX.utils.book_append_sheet(wb, ws, "Filtered Data");

        // Simpan file Excel
        const timestamp = new Date().toISOString().replace(/[-:T]/g, '_').slice(0, 15);
        const filename = `Filtered_Servis_Rutin_Data_${timestamp}.xlsx`;
        XLSX.writeFile(wb, filename);

        console.log('Export berhasil!');
    } catch (error) {
        console.error('Error saat export:', error);
        alert('Terjadi kesalahan saat mengekspor data. Detail: ' + error.message);
    }
}
function exportServisToPDF() {
        try {
        // Import jsPDF and AutoTable (ensure these libraries are included in your project)
        const { jsPDF } = window.jspdf;
        // require("jspdf-autotable");

        // Get table and visible rows
        const table = document.getElementById('ServisRutin');
        const visibleRows = Array.from(
            table.getElementsByTagName('tbody')[0].getElementsByTagName('tr')
        ).filter(row => row.style.display !== 'none');

        // Get headers (excluding "Aksi" column)
        const headers = Array.from(
            table.getElementsByTagName('thead')[0].getElementsByTagName('th')
        ).slice(0, -2).map(th => th.textContent.trim());

        // Prepare filtered data
        const filteredData = visibleRows.map(row => {
            return Array.from(row.getElementsByTagName('td'))
                .slice(0, -2) // Exclude "Aksi" column
                .map(td => {
                    let value = td.textContent.trim();

                    // Format dates correctly
                    if (value.includes('/')) {
                        const [date, time] = value.split(' ');
                        const [day, month, year] = date.split('/');
                        value = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
                        if (time) {
                            value += ' ' + time;
                        }
                    }

                    // Replace "Baik" and "Tidak Baik" with abbreviations
                    if (value.toLowerCase() === 'baik') value = 'B';
                    if (value.toLowerCase() === 'tidak baik') value = 'TB';

                    return value;
                });
        });

        // Initialize jsPDF
        const doc = new jsPDF({ orientation: 'landscape', unit: 'pt', format: 'a4' });

        // AutoTable column widths (adjust manually for a better layout)
        const columnWidths = headers.map(header => {
            if (header.toLowerCase().includes('mobil')) return 100;
            if (header.toLowerCase().includes('kilometer')) return 70;
            if (header.toLowerCase().includes('tanggal')) return 80;
            if (header.toLowerCase().includes('jenis service')) return 90;
            if (header.toLowerCase().includes('item service')) return 80;
            if (header.toLowerCase().includes('keterangan')) return 100;
            return 60; // Default width for other columns
        });

        // Add AutoTable
        doc.autoTable({
            head: [headers], // Table headers
            body: filteredData, // Table body
            startY: 30, // Start position from top
            styles: {
                fontSize: 10,
                cellWidth: 'wrap', // Adjust cell width
            },
            columnStyles: headers.reduce((acc, _, i) => {
                acc[i] = { cellWidth: columnWidths[i] || 'auto' };
                return acc;
            }, {}),
            didParseCell: function (data) {
                // Apply background colors for "B" and "TB"
                if (data.row.raw[data.column.index] === 'B') {
                    data.cell.styles.fillColor = [173, 216, 230]; // Light blue
                } else if (data.row.raw[data.column.index] === 'TB') {
                    data.cell.styles.fillColor = [255, 99, 71]; // Light red
                }
            }
        });

        // Add title and other decorations
        doc.setFontSize(14);
        doc.text('Laporan Servis Rutin', 40, 20);

        // Save PDF file
        const timestamp = new Date().toISOString().replace(/[-:T]/g, '_').slice(0, 15);
        const filename = `Filtered_Servis_Rutin_Data_${timestamp}.pdf`;
        doc.save(filename);

        console.log('PDF export successful!');
    } catch (error) {
        console.error('Error exporting PDF:', error);
        alert('An error occurred while exporting the data. Details: ' + error.message);
    }
}
function exportToExcel() {
    try {
        // Initialize workbook
        const wb = XLSX.utils.book_new();
        const fileName = `Laporan_Pemeriksaan_Kendaraan_${new Date().toISOString().slice(0, 10)}.xlsx`;

        // Get current date formatted in Indonesian format
        const currentDate = new Date().toLocaleDateString('id-ID', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        }).split('/').join('-');

        // Prepare data structure
        const data = [];
        const table = document.getElementById("inspectionTable");
        const rows = Array.from(
            table.querySelectorAll('tbody tr')
        ).filter(row => row.style.display !== 'none'); // Only visible rows

        // Process each visible row
        rows.forEach(row => {
            const id = row.cells[0].textContent.trim();
            const nama = row.cells[1].textContent.trim();
            const platMobil = row.cells[2].textContent.trim();
            let namaMobil = row.cells[3] ? row.cells[3].textContent.trim() : '';
            let tanggalPemeriksaan = row.cells[row.cells.length - 3].textContent.trim() || currentDate;

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
                        'Nama Mobil': namaMobil
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
                'ID', 'Nama', 'Plat Mobil', 'Tanggal Pemeriksaan', 'Nama Mobil',
                'Oli Mesin', 'Oli Power Steering', 'Oli Transmisi', 'Minyak Rem',
                'Lampu Utama', 'Lampu Sein', 'Lampu Rem', 'Klakson', 'Aki',
                'Kursi', 'Lantai', 'Dinding', 'Kap',
                'STNK', 'APAR', 'P3K', 'Kunci Roda',
                'Air Radiator', 'Bahan Bakar', 'Tekanan Ban', 'Rem'
            ]
        });

        // Enhanced column widths
        ws['!cols'] = [
            { wch: 8 },  // ID
            { wch: 20 }, // Nama
            { wch: 15 }, // Plat Mobil
            { wch: 18 }, // Tanggal Pemeriksaan
            { wch: 18 }, // Tanggal Update
            ...Array(21).fill({ wch: 16 }) // Component columns
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

async function exportToPDF() {
    try {
        const { jsPDF } = window.jspdf;

        // Initialize PDF in landscape mode
        const pdf = new jsPDF('landscape');
        const fileName = `Laporan_Pemeriksaan_Kendaraan_${new Date().toISOString().slice(0, 10)}.pdf`;

        // Get current date formatted in Indonesian format
        const currentDate = new Date().toLocaleDateString('id-ID', {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
        }).split('/').join('-');

        // Prepare data structure
        const data = [];
        const table = document.getElementById("inspectionTable");
        const rows = Array.from(table.querySelectorAll('tbody tr')).filter(
            row => row.style.display !== 'none' // Only visible rows
        );

        // Process visible rows
        rows.forEach(row => {
            const id = row.cells[0].textContent.trim();
            const nama = row.cells[1].textContent.trim();
            const platMobil = row.cells[2].textContent.trim();
            const namaMobil = row.cells[3] ? row.cells[3].textContent.trim() : '';
            const tanggalPemeriksaan = row.cells[row.cells.length - 3].textContent.trim() || currentDate;

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
                        'Nama Mobil': namaMobil,
                        'Tanggal Pemeriksaan': tanggalPemeriksaan
                    };

                    // Get component statuses
                    const modalRows = modal.querySelectorAll('tbody tr');
                    modalRows.forEach(modalRow => {
                        const cells = modalRow.querySelectorAll('td');
                        if (cells.length >= 2) {
                            const componentName = cells[0].textContent.trim();
                            const status = cells[1].textContent.trim();
                            if (!componentName.toLowerCase().includes('foto')) {
                               vehicleData[componentName] = status === "baik" ? "B" : status === "tidak_baik" ? "TB" : status;
                            }
                        }
                    });

                    data.push(vehicleData);
                }
            }
        });

        // Define headers
        const headers = [
            'ID', 'Nama', 'Plat Mobil', 'Nama Mobil', 'Tanggal Pemeriksaan',
            'Oli Mesin', 'Oli Power Steering', 'Oli Transmisi', 'Minyak Rem',
            'Lampu Utama', 'Lampu Sein', 'Lampu Rem', 'Klakson', 'Aki',
            'Kursi', 'Lantai', 'Dinding', 'Kap',
            'STNK', 'APAR', 'P3K', 'Kunci Roda',
            'Air Radiator', 'Bahan Bakar', 'Tekanan Ban', 'Rem'
        ];

        // Convert data to array of arrays for autoTable
        const pdfData = data.map(row =>
            headers.map(header => row[header] || '')
        );

        // Add the table to the PDF with rotated headers and conditional styling
        pdf.autoTable({
            head: [headers],
            body: pdfData,
            startY: 10,
            startX: 4,
            theme: 'striped',
            styles: {
                font: 'helvetica',
                fontSize: 7,
                fontStyle: 'bold',
                valign: 'middle',
                halign: 'center'
            },
            headStyles: {
                fillColor: [31, 78, 120],
                textColor: [255, 255, 255],
                fontSize: 8,
                fontStyle: 'bold',
                halign: 'center',
                valign: 'middle',
                cellWidth: 10.4,
                minCellHeight: 10,
                cellPadding:1
            },
            tableLineColor: [200, 200, 200],
            alternateRowStyles: {
                fillColor: [237, 243, 250]
            },
            margin: { top: 20 },
            horizontalPageBreak: false,
            // didDrawCell: function (data) {
            //     const cell = data.cell;
            //     const content = cell.raw; // Use raw cell content
            //     if (data.section === 'body') {
            //         if (content === 'B') {
            //             cell.styles.fillColor = [0, 102, 204]; // Blue background
            //             cell.styles.textColor = [255, 255, 255]; // White text
            //         } else if (content === 'TB') {
            //             cell.styles.fillColor = [255, 51, 51]; // Red background
            //             cell.styles.textColor = [255, 255, 255]; // White text
            //         }
            //     }
            // },
        });

        // Add title and save the file
        pdf.setFontSize(14);
        pdf.text('Laporan Pemeriksaan Kendaraan', pdf.internal.pageSize.getWidth() / 2, 7, { align: 'center' });
        pdf.save(fileName);

        // Success notification
        Swal.fire({
            icon: 'success',
            title: 'Ekspor Berhasil',
            text: 'File PDF berhasil diunduh!',
            confirmButtonColor: '#28a745',
            timer: 2000,
            timerProgressBar: true
        });
    } catch (error) {
        console.error('Error saat mengekspor PDF:', error);
        Swal.fire({
            icon: 'error',
            title: 'Ekspor Gagal',
            text: 'Terjadi kesalahan saat mengekspor data ke PDF!',
            confirmButtonColor: '#dc3545'
        });
    }
}


            // Fungsi untuk mengekspor ke PDF
            function exportToPDFs() {
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
                            2: {cellWidth: 1}, // Foto
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blob-polyfill/7.0.20220408/Blob.min.js"></script>

    <!-- Untuk PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
</body>
</html>