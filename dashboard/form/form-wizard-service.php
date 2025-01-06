<?php
    session_start(); // Start the session

    // Koneksi ke database
$servername = "localhost"; // Sesuaikan dengan host Anda
$username = "root"; // Ganti dengan username MySQL Anda
$password = ""; // Ganti dengan password MySQL Anda
$dbname = "checkcar"; // Nama database Anda

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Iterasi data form yang dikirim
    foreach ($_POST['service_type'] as $index => $mobil) {
        $kilometer = $_POST['kilometer'][$index] ?? null;
        $tanggal_perbaikan = $_POST['service_date'][$index] ?? null;
        $tanggal_selesai = $_POST['return_service_date'][$index] ?? null;
        $jenis_service = $_POST['service_type'][$index] ?? null;
        $item_service = $_POST['service_item'][$index] ?? null;
        $keterangan = $_POST['keterangan'][$index] ?? '';

        // Validasi input kosong
        if (!$mobil || !$kilometer || !$tanggal_perbaikan || !$tanggal_selesai || !$jenis_service || !$item_service) {
            continue; // Lewati data ini
        }

        // Tangani file upload
        $bukti_nota = null;
        if (isset($_FILES['photo']['name'][$index]) && $_FILES['photo']['name'][$index] != '') {
            $upload_dir = '../../form/uploadservice/'; // Folder untuk menyimpan file
            $filename = time() . '_' . basename($_FILES['photo']['name'][$index]);
            $target_file = $upload_dir . $filename;

            // Pindahkan file ke folder tujuan
            if (move_uploaded_file($_FILES['photo']['tmp_name'][$index], $target_file)) {
                $bukti_nota = $target_file;
            } else {
                echo "Gagal mengunggah file untuk item ke-" . ($index + 1) . ".<br>";
                continue; // Lewati data ini jika file gagal diunggah
            }
        }

        // Simpan data ke database
        $stmt = $conn->prepare("
            INSERT INTO servicerutin (
                mobil, kilometer, tanggal_perbaikan, tanggal_selesai, jenis_service, item_service, keterangan, bukti_nota
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            'sissssss',
            $mobil,
            $kilometer,
            $tanggal_perbaikan,
            $tanggal_selesai,
            $jenis_service,
            $item_service,
            $keterangan,
            $bukti_nota
        );

        if ($stmt->execute()) {
        } else {
            echo "Terjadi kesalahan: " . $stmt->error . "<br>";
        }
    }
}


    // Define service categories and their items
    $carCategories = [
        'W 1740 NP (Inova Lama)' => [
            'oli_mesin' => 'Oli Mesin',
            'oli_power_steering' => 'Oli Power Steering',
            'oli_transmisi' => 'Oli Transmisi'
        ],
        'W 1507 NP (Reborn)' => [
            'lampu_utama' => 'Lampu Utama',
            'lampu_sein' => 'Lampu Sein',
            'lampu_rem' => 'Lampu Rem',
            'lampu_klakson' => 'Lampu Klakson',
            'aki' => 'Aki'
        ],
        'W 1347 NP (Kijang Kapsul)' => [
            'kursi' => 'Kursi',
            'lantai' => 'Lantai',
            'dinding' => 'Dinding'
        ],
    ];

    $serviceCategories = [
        'Pemeriksaan Oli' => [
            'oli_mesin' => 'Oli Mesin',
            'oli_power_steering' => 'Oli Power Steering',
            'oli_transmisi' => 'Oli Transmisi'
        ],
        'Kelistrikan' => [
            'lampu_utama' => 'Lampu Utama',
            'lampu_sein' => 'Lampu Sein',
            'lampu_rem' => 'Lampu Rem',
            'lampu_klakson' => 'Lampu Klakson',
            'aki' => 'Aki'
        ],
        'Interior' => [
            'kursi' => 'Kursi',
            'lantai' => 'Lantai',
            'dinding' => 'Dinding'
        ],
        'Eksterior' => [
            'kap' => 'Kap',
            'stnk' => 'STNK',
            'apar' => 'APAR',
            'p3k' => 'P3K',
            'kunci_roda' => 'Kunci Roda'
        ],
        'Cairan' => [
            'air_radiator' => 'Air Radiator',
            'minyak_rem' => 'Minyak Rem',
            'bahan_bakar' => 'Bahan Bakar'
        ],
        'Mekanis' => [
            'tekanan_ban' => 'Tekanan Ban',
            'rem' => 'Rem'
        ]
    ];

    $conn->close();
?>
<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>BMN-Operasional</title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="../../assets/images/favicon.ico">
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="../../assets/css/core/libs.min.css">
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="../../assets/css/hope-ui.min.css?v=5.0.0">
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="../../assets/css/custom.min.css?v=5.0.0">
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="../../assets/css/customizer.min.css?v=5.0.0">
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="../../assets/css/rtl.min.css?v=5.0.0">

      <!-- Bootstrap Icons -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

      <!-- Font Awesome -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

      
      <style>/* Gaya Umum */

      /* kamera */
      .camera-capture {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    background: #f8f9fa;
    border-radius: 5px;
}

#camera-preview, #captured-image {
    width: 100%;
    max-width: 640px;
    margin-bottom: 10px;
}

.timestamp {
    margin-top: 10px;
    font-size: 0.9em;
    color: #666;
}
      /* kamera */

.service-form-container {
            padding: 1.5rem;
            margin-top: 2rem;
        }

        .service-item {
            background: #f8f9fa;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            border: 1px solid #e9ecef;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            font-weight: 500;
            color: #344767;
            margin-bottom: 0.5rem;
        }

        .form-control, .form-select {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 0.625rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3a57e8;
            box-shadow: 0 0 0 0.2rem rgba(58, 87, 232, 0.15);
        }

        .file-upload {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background: #e9ecef;
            border-color: #3a57e8;
        }

        .file-upload-label i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
            color: #3a57e8;
        }

        .btn-add-service {
            background-color: #ffffff;
            color: #3a57e8;
            border: 2px dashed #3a57e8;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-add-service:hover {
            background-color: #3a57e8;
            color: #ffffff;
        }

        .btn-save {
            background-color: #3a57e8;
            color: #ffffff;
            border: none;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background-color: #2b44b8;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(58, 87, 232, 0.2);
        }

        .timestamp {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        .section-title {
            color: #344767;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .service-form-container {
                padding: 1rem;
            }

            .service-item {
                padding: 1rem;
            }
        }

.content-inner {
  padding: 0;
}

.card {
  margin: 0;
  border-radius: 20;
  width: 100%;
}

.card-body {
  padding: 20px;
}

.form-card {
  width: 100%;
}

.header-mobile {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.header-mobile .brand {
    display: flex;
    align-items: center;
}

.header-mobile .brand .logo {
    width: 30px;
    height: 30px;
    object-fit: contain; /* Menjaga logo tetap proporsional */
}

.header-mobile .brand span {
    font-size: 16px; /* Ukuran font teks */
    font-weight: bold; /* Teks lebih tegas */
    white-space: nowrap; /* Cegah teks terpotong */
}


.brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

.logo {
    width: 24px;
    height: 24px;
}

/* Header Mobile */
.header-mobile {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 60px;
    background: white;
    display: flex;
    align-items: center;
    padding: 0 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    z-index: 1000;
}

.menu-toggle {
    background: none;
    border: none;
    font-size: 24px;
    padding: 8px;
    margin-right: 10px;
}

/* Menu Mobile */
.nav-mobile {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 15px;
    color: #333;
    text-decoration: none;
    border-radius: 8px;
}

.nav-item.active {
    background: #0d6efd;
    color: white;
}

.nav-item i {
    font-size: 20px;
}

/* Konten Utama */
.main-content {
    padding-top: 60px;
}

.navbar .navbar-brand {
    font-size: 1.2rem; /* Sesuaikan ukuran teks */
    margin-left: 0;    /* Hilangkan jarak tambahan di sebelah kiri */
}

.navbar img {
    margin-right: 8px; /* Jarak logo ke teks */
    object-fit: cover; /* Pastikan logo terlihat proporsional */
}

@media (min-width: 992px) {
    .main-content {
        padding-top: 0;
        margin-left: 260px;
    }
}

/* Global Reset */
html, body {
    margin: 0; /* Remove default margin */
    padding: 0; /* Remove default padding */
    overflow-x: hidden; /* Prevent horizontal scrolling */
    width: 100%; /* Ensure body width is 100% */
}

.steps {
    margin-right: 0; /* Remove fixed margin to avoid pushing out of viewport */
    width: 100%; /* Adjust width to be responsive */
    max-width: 200px; /* Set a max width as needed */
}

h4 {
    font-size: 20px;
}

.form-check-input {
    border: 2px solid #555; /* Darker border color */
    background-color: #fff; /* White background for radio button */
    width: 18px;
    height: 18px;
}

.steps {
    margin: 0; /* Remove margin to keep it centered */
    padding: 0; /* Remove padding for consistency */
    max-width: 100%; /* Prevent exceeding the viewport */
    overflow: hidden; /* Hide overflow */
    white-space: nowrap; /* Prevent text wrapping */
    text-overflow: ellipsis; /* Show ellipsis for overflow text */
    font-size: 24px; /* Set a base font size */
}

.modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
}

.modal-contentf {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    position: relative;
}

.close-btn {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 24px;
    cursor: pointer;
    color: #666;
}

.help-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #3498db;
    color: white;
    cursor: pointer;
    margin-left: 8px;
    font-size: 14px;
}

@media (max-width: 768px) {
    .custom-class {
        font-size: 14px;
        padding: 10px;
    }
}

/* Sidebar Layout */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 260px;
    z-index: 1000;
    transition: all 0.3s ease;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 10px 15px;
    color: #4a5568;
    transition: all 0.2s ease;
}

.nav-link:hover {
    background-color: #f7fafc;
    color: #2d3748;
}

.nav-link.active {
    background-color: #3182ce;
    color: white;
}

.icon {
    margin-right: 10px;
}

.nav-link i {
    font-size: 1.25rem;
}

/* Menu Mobile: Tinggi dan Tampilan Responsif */
.nav-mobile {
    position: fixed;
    top: 60px; /* Sesuaikan dengan tinggi header */
    left: 0;
    height: calc(100vh - 60px); /* Sisa tinggi layar setelah header */
    width: 100%;
    background: white;
    z-index: 999; /* Pastikan di atas konten lainnya */
    overflow-y: auto; /* Gulir jika menu terlalu panjang */
    transition: all 0.3s ease;
}

/* Perbaiki Padding dan Penempatan Elemen */
.nav-item {
    padding: 12px 20px;
    text-align: left;
}

@media (max-width: 768px) {
    .sidebar {
        display: none; /* Sembunyikan sidebar untuk perangkat kecil */
    }

    .main-content {
        margin-left: 0; /* Pastikan konten utama memenuhi layar */
        padding: 20px;
    }

    .header-mobile .menu-toggle {
        display: inline-block; /* Tampilkan tombol menu toggle */
    }

    /* Saat menu toggle aktif */
    .nav-mobile.active {
        display: flex;
    }
}

.btn {
    background: none; /* Hilangkan background tombol */
    border: none;     /* Hilangkan border tombol */
    color: #333;      /* Warna ikon */
    cursor: pointer;  /* Pointer saat hover */
}

.btn-kirim {
    background: #3182ce; /* Hilangkan background tombol */
    border: none;     /* Hilangkan border tombol */
    color: #333;      /* Warna ikon */
    cursor: pointer;  /* Pointer saat hover */
}

.btn:hover {
    color: #0d6efd;   /* Ubah warna saat hover */
}

.btn i {
    display: inline-block;
    transition: transform 0.3s ease; /* Efek animasi */
}

.btn:active i {
    transform: scale(0.9); /* Efek klik */
}


.menu-toggle {
    transition: transform 0.3s ease;
}

.menu-toggle.active {
    transform: rotate(90deg); /* Animasi saat dibuka */
}


/* Add Bootstrap Icons */
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css");
</style>

      
  </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
          </div>
      </div>    </div>
    <!-- loader END -->
        <!-- Sidebar -->
        <aside class="sidebar bg-white shadow-lg" style="width: 260px; height: 100vh; position: fixed;">
            <div class="p-4 border-bottom">
                <a href="#" class="d-flex align-items-center text-decoration-none">
                    <img src="../../kmnf.png" alt="Kominfo Logo" class="me-2" style="width: 32px; height: 32px;">
                    <span class="fw-bold text-dark fs-5">BMN-Operasional</span>
                </a>
            </div>
            
            <nav class="mt-4">
                <div class="nav flex-column px-3">
                    <a href="form-wizard asli.php" class="nav-link  rounded mb-2 d-flex align-items-center">
                        <i class="bi bi-house-door me-2"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="form-wizard-service.php" class="nav-link active rounded mb-2 d-flex align-items-center">
                        <i class="bi bi-tools me-2"></i>
                        <span>Service</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Sidebar Mobile -->
        <div class="sidebar-mobile d-lg-none">
            <div class="header-mobile d-flex align-items-center justify-content-flex-start px-3 py-2">
                <!-- Tombol Toggle -->
                <button class="btn p-0" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-3"></i>
                </button>

                <!-- Brand (Logo + Teks) -->
                <div class="d-flex align-items-center gap-1">
                    <img src="../../kmnf.png" alt="Logo Kominfo" class="logo" style="width: 30px; height: 30px;">
                    <span class="text-nowrap fw-bold" style="font-size: 16px;">BMN-Operasional</span>
                </div>
            </div>
        </div>

        <!-- Menu Offcanvas Mobile -->
        <div class="offcanvas offcanvas-start" id="mobileSidebar">
            <div class="offcanvas-header">
                <div class="brand">
                    <img src="../../kmnf.png" alt="Logo Kominfo" class="logo">
                    <span>BMN-Operasional</span>
                </div>
                <button class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="nav-mobile">
                    <a href="form-wizard asli.php" class="nav-item ">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="#" class="nav-item active">
                        <i class="bi bi-tools"></i>
                        <span>Service</span>
                    </a>
                </nav>
            </div>
        </div>   
        <!-- Mobile Header -->
        <header class="d-lg-none fixed-top bg-white shadow-sm py-2 px-3">
            <div class="d-flex align-items-center justify-content-flex-start">
                <button class="btn btn-light" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                    <i class="bi bi-list"></i>
                </button>
                <div class="d-flex align-items-center">
                    <img src="../../kmnf.png" alt="Kominfo Logo" class="me-2" style="width: 32px; height: 32px;">
                    <span class="fw-bold">BMN-Operasional</span>
                </div>
            </div>
        </header>   
        <main class="main-content">
        <div class="position-relative iq-banner">
            <!-- Keep your existing navbar -->
            
            <!-- Modified Form Content -->
            <div class="container-fluid content-inner mt-5 py-0">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Form Service Rutin</h4>
                            </div>
                            <div class="card-body">
                                <form id="serviceForm" method="POST" enctype="multipart/form-data">
                                    <div id="serviceItems">
                                        <div class="service-item">
                                            <div class="row">
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Pilih Mobil</label>
                                                        <select class="form-select" name="service_type[]" required>
                                                            <option value="">Pilih Kategori</option>
                                                            <option value="W 1740 NP">W 1740 NP (Inova Lama)</option>
                                                            <option value="W 1507 NP">W 1507 NP (Reborn)</option>
                                                            <option value="W 1347 NP">W 1347 NP (Kijang Kapsul)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Kilometer Terakhir</label>
                                                        <input type="text" class="form-control" name="kilometer[]" placeholder="Masukkan kilometer" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Tanggal Perbaikan</label>
                                                        <input type="date" class="form-control" name="service_date[]" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Tanggal Selesai</label>
                                                        <input type="date" class="form-control" name="return_service_date[]" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Jenis Service</label>
                                                        <select class="form-select" name="service_type[]" onchange="updateServiceOptions(this)" required>
                                                            <option value="">Pilih Kategori</option>
                                                            <option value="Pemeriksaan Oli">Pemeriksaan Oli</option>
                                                            <option value="Kelistrikan">Kelistrikan</option>
                                                            <option value="Interior">Interior</option>
                                                            <option value="Eksterior">Eksterior</option>
                                                            <option value="Cairan">Cairan</option>
                                                            <option value="Mekanis">Mekanis</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Item Service</label>
                                                        <select class="form-select" name="service_item[]" required>
                                                            <option value="">Pilih Item</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Keterangan</label>
                                                        <textarea class="form-control" name="keterangan[]" rows="3" placeholder="Masukkan keterangan tambahan"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
    <div class="form-group">
        <label class="form-label">Bukti Nota</label>
        <div class="camera-capture">
            <!-- Video element untuk preview kamera -->
            <video id="camera-preview" class="d-none" autoplay playsinline></video>
            
            <!-- Canvas untuk mengambil snapshot -->
            <canvas id="capture-canvas" class="d-none"></canvas>
            
            <!-- Image preview -->
            <img id="captured-image" class="d-none" alt="captured photo">
            
            <!-- Input file tersembunyi untuk menyimpan hasil foto -->
            <input type="file" class="d-none" name="photo[]" accept="image/*" required>
            
            <!-- Tombol untuk mengaktifkan kamera -->
            <button type="button" id="start-camera" class="btn btn-primary mb-2">
                <i class="fas fa-camera"></i> Buka Kamera
            </button>
            
            <!-- Tombol untuk mengambil foto -->
            <button type="button" id="capture-photo" class="btn btn-success mb-2 d-none">
                <i class="fas fa-camera"></i> Ambil Foto
            </button>
            
            <!-- Tombol untuk mengulang foto -->
            <button type="button" id="retake-photo" class="btn btn-warning mb-2 d-none">
                <i class="fas fa-redo"></i> Ulang Foto
            </button>
            
            <div class="timestamp">Waktu diambil: <span id="capture-timestamp">belum diambil</span></div>
        </div>
    </div>
</div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex gap-3 mt-4">
                                        <!-- <button type="button" class="btn btn-add-service" onclick="addServiceItem()">
                                            <i class="fas fa-plus me-2"></i>Tambah Item Service
                                        </button> -->
                                        <button type="submit" class="btn btn-save btn-kirim">
                                            <i class="fas fa-save me-2"></i>Simpan Pemeriksaan
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <!-- Wrapper End-->

    <!-- Library Bundle Script -->
    <script src="../../assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="../../assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="../../assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="../../assets/js/charts/vectore-chart.js"></script>
    <script src="../../assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="../../assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="../../assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="../../assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="../../assets/js/plugins/form-wizard.js"></script>
        
    <!-- App Script -->
    <script src="../../assets/js/hope-ui.js" defer></script>
    
    <script>
        function updateServiceOptions(selectElement) {
            const category = selectElement.value;
            const itemSelect = selectElement.closest('.row').querySelector('[name="service_item[]"]');
            itemSelect.innerHTML = '<option value="">Pilih Item</option>';

            const serviceItems = {
                'Pemeriksaan Oli': ['Oli Mesin', 'Oli Power Steering', 'Oli Transmisi'],
                'Kelistrikan': ['Lampu Utama', 'Lampu Sein', 'Lampu Rem', 'Lampu Klakson', 'Aki'],
                'Interior': ['Kursi', 'Lantai', 'Dinding'],
                'Eksterior': ['Kap', 'STNK', 'APAR', 'P3K', 'Kunci Roda'],
                'Cairan': ['Air Radiator', 'Minyak Rem', 'Bahan Bakar'],
                'Mekanis': ['Tekanan Ban', 'Rem']
            };

            if (category && serviceItems[category]) {
                serviceItems[category].forEach(item => {
                    const option = new Option(item, item);
                    itemSelect.add(option);
                });
            }
        }

        function addServiceItem() {
            const template = document.querySelector('.service-item').cloneNode(true);
            template.querySelectorAll('input, select, textarea').forEach(input => {
                input.value = '';
            });
            template.querySelector('.timestamp').textContent = 'Waktu diambil: belum diambil';
            document.getElementById('serviceItems').appendChild(template);
        }

        // Enhanced file upload handling
        document.addEventListener('change', function(e) {
            if (e.target.type === 'file') {
                const timestamp = new Date().toLocaleString();
                const container = e.target.closest('.form-group');
                container.querySelector('.timestamp').textContent = `Waktu diambil: ${timestamp}`;
                
                const label = container.querySelector('.file-upload-label');
                if (e.target.files.length > 0) {
                    const fileName = e.target.files[0].name;
                    label.innerHTML = `<i class="fas fa-check text-success"></i><span class="ms-2">${fileName}</span>`;
                    label.style.borderColor = '#198754';
                } else {
                    label.innerHTML = `<i class="fas fa-cloud-upload-alt"></i><span class="ms-2">Pilih atau seret file ke sini</span>`;
                    label.style.borderColor = '#dee2e6';
                }
            }
        });


        // fungsi kamera
        document.addEventListener('DOMContentLoaded', function() {
    const cameraPreview = document.getElementById('camera-preview');
    const captureCanvas = document.getElementById('capture-canvas');
    const capturedImage = document.getElementById('captured-image');
    const startButton = document.getElementById('start-camera');
    const captureButton = document.getElementById('capture-photo');
    const retakeButton = document.getElementById('retake-photo');
    const timestampSpan = document.getElementById('capture-timestamp');
    const fileInput = document.querySelector('input[type="file"]');
    
    let stream = null;

    // Fungsi untuk memulai kamera
    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({
                video: { facingMode: 'environment' }, // Menggunakan kamera belakang jika ada
                audio: false
            });
            cameraPreview.srcObject = stream;
            cameraPreview.classList.remove('d-none');
            startButton.classList.add('d-none');
            captureButton.classList.remove('d-none');
        } catch (err) {
            console.error('Error accessing camera:', err);
            alert('Gagal mengakses kamera. Pastikan browser memiliki izin untuk mengakses kamera.');
        }
    }

    // Fungsi untuk mengambil foto
    function capturePhoto() {
        // Set canvas sesuai ukuran video
        captureCanvas.width = cameraPreview.videoWidth;
        captureCanvas.height = cameraPreview.videoHeight;
        
        // Gambar frame video ke canvas
        const ctx = captureCanvas.getContext('2d');
        ctx.drawImage(cameraPreview, 0, 0);
        
        // Konversi canvas ke blob
        captureCanvas.toBlob((blob) => {
            // Buat File object dari blob
            const timestamp = new Date().toLocaleString('id-ID');
            const file = new File([blob], `photo_${Date.now()}.jpg`, { type: 'image/jpeg' });
            
            // Update file input
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fileInput.files = dataTransfer.files;
            
            // Tampilkan preview
            capturedImage.src = URL.createObjectURL(blob);
            capturedImage.classList.remove('d-none');
            
            // Update UI
            cameraPreview.classList.add('d-none');
            captureButton.classList.add('d-none');
            retakeButton.classList.remove('d-none');
            timestampSpan.textContent = timestamp;
            
            // Hentikan stream kamera
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        }, 'image/jpeg', 0.8);
    }

    // Fungsi untuk mengulang foto
    function retakePhoto() {
        capturedImage.classList.add('d-none');
        retakeButton.classList.add('d-none');
        startButton.classList.remove('d-none');
        timestampSpan.textContent = 'belum diambil';
        fileInput.value = '';
    }

    // Event listeners
    startButton.addEventListener('click', startCamera);
    captureButton.addEventListener('click', capturePhoto);
    retakeButton.addEventListener('click', retakePhoto);
});
    </script>

    
  </body>
</html>