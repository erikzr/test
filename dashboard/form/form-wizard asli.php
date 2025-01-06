<?php
    session_start(); // Start the session
?>
<!doctype html>
<html lang="en" dir="ltr" data-bs-theme="light" data-bs-theme-color="theme-color-default">
  <head>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    color: black;
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

.btn{
    background: none; /* Hilangkan background tombol */
    border: none;     /* Hilangkan border tombol */
    color: #000;      /* Warna ikon */
    cursor: pointer;  /* Pointer saat hover */
}
.btn-kirim {
    background: #0d6efd; /* Hilangkan background tombol */
    border: none;     /* Hilangkan border tombol */
    color: white;      /* Warna ikon */
    cursor: pointer;  /* Pointer saat hover */
}

.btn-1:hover {
    color: #3182ce;   /* Ubah warna saat hover */
    
}

.btn:hover{
    color: #000;      /* Warna ikon */
}

.btn-1 i {
    display: inline-block;
    transition: transform 0.3s ease; /* Efek animasi */
}

.btn-1:active i {
    transform: scale(0.9); /* Efek klik */
}

.btn-1 {
    background: #0d6efd; /* Hilangkan background tombol */
    border: none;     /* Hilangkan border tombol */
    color: #333;      /* Warna ikon */
    cursor: pointer;  /* Pointer saat hover */
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
            </div>    
        </div>
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
                    <a href="#" class="nav-link active rounded mb-2 d-flex align-items-center">
                        <i class="bi bi-house-door me-2"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="form-wizard-service.php" class="nav-link rounded mb-2 d-flex align-items-center">
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
                    <a href="#" class="nav-item active">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="form-wizard-service.php" class="nav-item">
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
                <!--Nav Start-->
                <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
                    <div class="container-fluid navbar-inner">
                        <button class="btn btn-link d-lg-none p-0 me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
                            <i class="fas fa-bars fs-4 text-primary"></i>
                        </button>
                        <a href="../../dashboard/index.html" class="navbar-brand">
                            <div class="logo-main">
                                <div class="logo-normal">
                                </div>
                            </div>
                        </a>
                    </div>
                </nav>         
                <!-- Nav Header Component Start -->
                <div class="iq-navbar-header" style="height: 215px;">
                    <div class="container-fluid iq-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="flex-wrap d-flex justify-content-between align-items-center">
                                    <div>
                                        <h1>                        
                                            <?php
                                            if (isset($_SESSION['full_name'])) {
                                                echo "Halo , " . $_SESSION['full_name'] . ""; // Display user's full name
                                            } else {
                                                echo "Hello Devs!"; // Fallback if not logged in
                                            }
                                            ?>
                                        </h1>
                                        <p>Selamat Datang di Form Checkup Mobil Kominfo</p>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="iq-header-img">
                        <img src="../../assets/images/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
                        <img src="../../assets/images/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
                        <img src="../../assets/images/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
                        <img src="../../assets/images/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
                        <img src="../../assets/images/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
                        <img src="../../assets/images/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
                    </div>
                </div>          
                <!-- Nav Header Component End -->
            </div>
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                    <div class="row">                
                        <div class="col-sm-12 col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Form Pengecekan Kendaraan</h4>
                                    </div>
                                </div>
                            <div class="card-body">

                            <form id="vehicle-check-form" class="mt-3 text-center" 
    action="<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . '/test/dashboard/form/proses_form.php'; ?>" 
    method="POST" enctype="multipart/form-data">                          
                                          
                                    <!-- Data Pribadi -->
                                    <fieldset>
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
                                                        value="<?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : ''; ?>" readonly required/>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Plat Mobil</label>
                                                        <select class="form-select" name="plat_mobil" required>
                                                            <option value="">Pilih Plat Mobil</option>
                                                            <option value="W 1740 NP">W 1740 NP (Inova Lama)</option>
                                                            <option value="W 1507 NP">W 1507 NP (Reborn)</option>
                                                            <option value="W 1374 NP">W 1374 NP (Kijang Kapsul)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" id="btn-next-1" class="btn btn-primary float-end vehicle-next btn-kirim" value="Next">Next</button>
                                    </fieldset>

                                    <!-- Pemeriksaan Oli -->
                                    <fieldset>
                                        <div class="form-card text-start">
                                            <div class="row mb-4">
                                        <!-- Infografik Panduan -->
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <h5 class="mb-3">Panduan Pemeriksaan</h5>
                                                <!-- SVG Infografik di sini -->
                                                <svg viewBox="0 0 900 800" xmlns="http://www.w3.org/2000/svg">
                                                    <!-- Background -->
                                                    <rect width="900" height="800" fill="#f0f4f8"/>
                                                    
                                                    <!-- Header -->
                                                    <rect width="900" height="80" fill="#2c3e50"/>
                                                    <text x="450" y="50" text-anchor="middle" font-size="24" font-weight="bold" fill="white">
                                                        PANDUAN PEMERIKSAAN OLI DAN MINYAK KENDARAAN
                                                    </text>

                                                    <!-- Oli Mesin Section -->
                                                    <g transform="translate(50,100)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#3498db" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#3498db"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Oli Mesin</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Level: Antara MIN-MAX</text>
                                                            <text x="20" y="70" font-size="14">• Warna: Keemasan-Coklat terang</text>
                                                            <text x="20" y="95" font-size="14">• Tidak tercampur air</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Level dibawah MIN/diatas MAX</text>
                                                            <text x="20" y="180" font-size="14">• Warna hitam pekat/putih susu</text>
                                                            <text x="20" y="205" font-size="14">• Berbau hangus/terkontaminasi</text>
                                                        </g>
                                                    </g>

                                                    <!-- Power Steering Section -->
                                                    <g transform="translate(470,100)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#e74c3c" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#e74c3c"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Oli Power Steering</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Warna merah/pink cerah</text>
                                                            <text x="20" y="70" font-size="14">• Level tepat, tidak berbusa</text>
                                                            <text x="20" y="95" font-size="14">• Tidak ada kebocoran</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Warna gelap/keruh</text>
                                                            <text x="20" y="180" font-size="14">• Berbusa/berkabut</text>
                                                            <text x="20" y="205" font-size="14">• Ada kebocoran sistem</text>
                                                        </g>
                                                    </g>

                                                    <!-- Oli Transmisi Section -->
                                                    <g transform="translate(50,420)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#2ecc71" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#2ecc71"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Oli Transmisi</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Warna merah-kecoklatan</text>
                                                            <text x="20" y="70" font-size="14">• Level sesuai dipstick</text>
                                                            <text x="20" y="95" font-size="14">• Tidak ada partikel asing</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Warna hitam/gosong</text>
                                                            <text x="20" y="180" font-size="14">• Ada partikel logam</text>
                                                            <text x="20" y="205" font-size="14">• Berbau hangus</text>
                                                        </g>
                                                    </g>

                                                    <!-- Minyak Rem Section -->
                                                    <g transform="translate(470,420)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#f39c12" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#f39c12"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Minyak Rem</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Warna kuning/ungu cerah</text>
                                                            <text x="20" y="70" font-size="14">• Level antara MIN-MAX</text>
                                                            <text x="20" y="95" font-size="14">• Belum 2 tahun pemakaian</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Warna gelap/keruh</text>
                                                            <text x="20" y="180" font-size="14">• Level dibawah MIN</text>
                                                            <text x="20" y="205" font-size="14">• Lebih dari 2 tahun</text>
                                                        </g>
                                                    </g>

                                                    <!-- Tips Section -->
                                                    <g transform="translate(15,740)">
                                                        <rect width="870" height="40" rx="20" fill="#34495e"/>
                                                        <text x="430" y="25" text-anchor="middle" font-size="14" fill="white">
                                                            TIPS: Periksa saat mesin dingin • Kendaraan di permukaan datar • Dokumentasikan dengan foto • Jika ragu, konsultasi mekanik
                                                        </text>
                                                    </g>
                                                </svg>
                                            </div>
                                        </div>
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
                                                        <label class="form-label">
                                                            Oli Mesin
                                                            <span class="help-icon" onclick="showGuide('oli_mesin')">?</span>
                                                        </label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="oli_mesin" value="Baik" id="oli_mesin_baik" required>
                                                            <label class="form-check-label" for="oli_mesin_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="oli_mesin" value="Tidak Baik" id="oli_mesin_tidak_baik">
                                                            <label class="form-check-label" for="oli_mesin_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="oli_mesin_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Mesin</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('oli_mesin_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="oli_mesin_foto" id="oli_mesin_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="imagePreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="uploadedImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="oli_mesin_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_mesin_time">belum diambil</span></small>
                                                        </div>

                                                            <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                                document.getElementById('oli_mesin_foto').addEventListener('change', function(event) {
                                                                    var reader = new FileReader();
                                                                    reader.onload = function() {
                                                                    var imgElement = document.getElementById('uploadedImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    }
                                                                    reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                                });
                                                            </script>

                                                            <!-- Modal panduan Oli Mesin -->
                                                            <!-- <div id="modal_oli_mesin" class="modal">
                                                                <div class="modal-contentf">
                                                                    <span class="close-btn" onclick="closeGuide('oli_mesin')">&times;</span>
                                                                    <svg viewBox="0 0 380 280" xmlns="http://www.w3.org/2000/svg">
                                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#3498db" stroke-width="2"/>
                                                                        <rect width="380" height="50" rx="15" fill="#3498db"/>
                                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Oli Mesin</text>
                                                                        
                                                                        <g transform="translate(20,70)">
                                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                                            <text x="20" y="45" font-size="14">• Level: Antara MIN-MAX</text>
                                                                            <text x="20" y="70" font-size="14">• Warna: Keemasan-Coklat terang</text>
                                                                            <text x="20" y="95" font-size="14">• Tidak tercampur air</text>
                                                                            
                                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                                            <text x="20" y="155" font-size="14">• Level dibawah MIN/diatas MAX</text>
                                                                            <text x="20" y="180" font-size="14">• Warna hitam pekat/putih susu</text>
                                                                            <text x="20" y="205" font-size="14">• Berbau hangus/terkontaminasi</text>
                                                                        </g>
                                                                    </svg>
                                                                </div>
                                                            </div> -->
                                                    </div>
                                                </div>

                                                <!-- Bagian Oli Power Steering -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Oli Power Steering</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="oli_power_steering" value="Baik" id="oli_power_steering_baik" required>
                                                            <label class="form-check-label" for="oli_power_steering_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="oli_power_steering" value="Tidak Baik" id="oli_power_steering_tidak_baik">
                                                            <label class="form-check-label" for="oli_power_steering_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                            <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                                <label for="oli_power_steering_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Power Steering</label>
                                                                <!-- Tombol untuk membuka kamera -->
                                                                <button type="button" class="form-control" onclick="document.getElementById('oli_power_steering_foto').click();">Ambil Foto</button>
                                                                <!-- Input file yang dipanggil melalui tombol -->
                                                                <input type="file" class="form-control" name="oli_power_steering_foto" id="oli_power_steering_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                                
                                                                <!-- Tempat untuk menampilkan gambar -->
                                                                <div id="imagePreview" style="margin-top: 16px; text-align: center;">
                                                                    <img id="uploadedImagePS" src="" alt="Preview Image" 
                                                                        style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                                </div>

                                                                <small id="oli_power_steering_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_power_steering_time">belum diambil</span></small>
                                                            </div>

                                                            <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                            document.getElementById('oli_power_steering_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                var imgElement = document.getElementById('uploadedImagePS');
                                                                imgElement.src = reader.result;
                                                                imgElement.style.display = 'block'; // Menampilkan gambar
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                            </script>
                                                        </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Oli Transmisi dan Minyak Rem -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Oli Transmisi</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="oli_transmisi" value="Baik" id="oli_transmisi_baik" required>
                                                            <label class="form-check-label" for="oli_transmisi_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="oli_transmisi" value="Tidak Baik" id="oli_transmisi_tidak_baik">
                                                            <label class="form-check-label" for="oli_transmisi_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="oli_transmisi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Transmisi</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('oli_transmisi_foto').click();">Ambil Foto</button>
                                                            <!-- Input file untuk foto -->
                                                            <input type="file" class="form-control" name="oli_transmisi_foto" id="oli_transmisi_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="imagePreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="uploadedImageOT" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="oli_transmisi_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_transmisi_time">belum diambil</span></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Minyak Rem</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="minyak_rem" value="Baik" id="minyak_rem_baik" required>
                                                            <label class="form-check-label" for="minyak_rem_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="minyak_rem" value="Tidak Baik" id="minyak_rem_tidak_baik">
                                                            <label class="form-check-label" for="minyak_rem_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="minyak_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Minyak Rem</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('minyak_rem_foto').click();">Ambil Foto</button>
                                                            <!-- Input file untuk foto -->
                                                            <input type="file" class="form-control" name="minyak_rem_foto" id="minyak_rem_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="imagePreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="uploadedImageMR" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="minyak_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="minyak_rem_time">belum diambil</span></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                            document.getElementById('oli_transmisi_foto').addEventListener('change', function(event) {
                                                var reader = new FileReader();
                                                reader.onload = function() {
                                                    var imgElement = document.getElementById('uploadedImageOT');
                                                    imgElement.src = reader.result;
                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                }
                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                            });

                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                            document.getElementById('minyak_rem_foto').addEventListener('change', function(event) {
                                                var reader = new FileReader();
                                                reader.onload = function() {
                                                    var imgElement = document.getElementById('uploadedImageMR');
                                                    imgElement.src = reader.result;
                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                }
                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                            });
                                            </script>


                                            <!-- Tombol Navigasi -->
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" id="btn-prev-2" class="btn btn-dark vehicle-prev me-1 text-white btn-kirim" value="Previous">Previous</button>
                                                <button type="button" id="btn-next-2" class="btn btn-primary vehicle-next btn-kirim" value="Next">Next</button>
                                            </div>
                                        </div>
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
                                    </fieldset>


                                    <!-- Pemeriksaan Penerangan -->
                                    <fieldset>
                                        <div class="form-card text-start">
                                            <div class="row mb-4">
                                                <svg viewBox="0 0 900 800" xmlns="http://www.w3.org/2000/svg">
                                                    <!-- Background -->
                                                    <rect width="900" height="800" fill="#f0f4f8"/>
                                                    
                                                    <!-- Header -->
                                                    <rect width="900" height="80" fill="#2c3e50"/>
                                                    <text x="450" y="50" text-anchor="middle" font-size="24" font-weight="bold" fill="white">
                                                        PANDUAN PEMERIKSAAN LAMPU KENDARAAN
                                                    </text>

                                                    <!-- Lampu Utama Section -->
                                                    <g transform="translate(50,100)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#3498db" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#3498db"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Lampu Utama</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Nyala terang dan stabil</text>
                                                            <text x="20" y="70" font-size="14">• Kaca lampu bersih dan utuh</text>
                                                            <text x="20" y="95" font-size="14">• Pencahayaan merata</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Redup atau mati sebelah</text>
                                                            <text x="20" y="180" font-size="14">• Kaca lampu buram/pecah</text>
                                                            <text x="20" y="205" font-size="14">• Cahaya tidak fokus</text>
                                                        </g>
                                                    </g>

                                                    <!-- Lampu Sein Section -->
                                                    <g transform="translate(470,100)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#e74c3c" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#e74c3c"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Lampu Sein</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Berkedip teratur</text>
                                                            <text x="20" y="70" font-size="14">• Warna sesuai standar</text>
                                                            <text x="20" y="95" font-size="14">• Semua arah berfungsi</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Kedipan tidak teratur</text>
                                                            <text x="20" y="180" font-size="14">• Tidak menyala/mati</text>
                                                            <text x="20" y="205" font-size="14">• Warna pudar/tidak sesuai</text>
                                                        </g>
                                                    </g>

                                                    <!-- Lampu Rem Section -->
                                                    <g transform="translate(50,420)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#2ecc71" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#2ecc71"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Lampu Rem</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Menyala saat pedal diinjak</text>
                                                            <text x="20" y="70" font-size="14">• Intensitas cahaya kuat</text>
                                                            <text x="20" y="95" font-size="14">• Semua titik menyala</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Respon lambat/tidak menyala</text>
                                                            <text x="20" y="180" font-size="14">• Cahaya redup/tidak stabil</text>
                                                            <text x="20" y="205" font-size="14">• Ada titik mati</text>
                                                        </g>
                                                    </g>

                                                    <!-- Lampu Klakson & Pendukung Section -->
                                                    <g transform="translate(470,420)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#f39c12" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#f39c12"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Lampu Klakson & Pendukung</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Klakson suara jelas</text>
                                                            <text x="20" y="70" font-size="14">• Lampu hazard berfungsi</text>
                                                            <text x="20" y="95" font-size="14">• Lampu plat nomor menyala</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Klakson lemah/mati</text>
                                                            <text x="20" y="180" font-size="14">• Hazard tidak sinkron</text>
                                                            <text x="20" y="205" font-size="14">• Lampu pendukung mati</text>
                                                        </g>
                                                    </g>

                                                    <!-- Tips Section -->
                                                    <g transform="translate(15,740)">
                                                        <rect width="870" height="40" rx="20" fill="#34495e"/>
                                                        <text x="430" y="25" text-anchor="middle" font-size="14" fill="white">
                                                            TIPS: Periksa saat mesin menyala • Lakukan di tempat gelap • Dokumentasikan dengan foto • Jika ragu, konsultasi bengkel
                                                        </text>
                                                    </g>
                                                </svg>
                                                <br>
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
                                                            <input class="form-check-input" type="radio" name="lampu_utama" value="Baik" id="lampu_utama_baik" required>
                                                            <label class="form-check-label" for="lampu_utama_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_utama" value="Tidak Baik" id="lampu_utama_tidak_baik">
                                                            <label class="form-check-label" for="lampu_utama_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="lampu_utama_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Utama</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('lampu_utama_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="lampu_utama_foto" id="lampu_utama_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="lampuUtamaPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="lampuUtamaImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="lampu_utama_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_utama_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                            document.getElementById('lampu_utama_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('lampuUtamaImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('lampu_utama_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                <!-- Bagian Lampu Sein -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Lampu Sein</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_sein" value="Baik" id="lampu_sein_baik" required>
                                                            <label class="form-check-label" for="lampu_sein_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_sein" value="Tidak Baik" id="lampu_sein_tidak_baik">
                                                            <label class="form-check-label" for="lampu_sein_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="lampu_sein_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Sein</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('lampu_sein_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="lampu_sein_foto" id="lampu_sein_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="lampuSeinPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="lampuSeinImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="lampu_sein_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_sein_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                            document.getElementById('lampu_sein_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('lampuSeinImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('lampu_sein_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Bagian Lampu Rem dan Klakson -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Lampu Rem</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_rem" value="Baik" id="lampu_rem_baik" required>
                                                            <label class="form-check-label" for="lampu_rem_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_rem" value="Tidak Baik" id="lampu_rem_tidak_baik">
                                                            <label class="form-check-label" for="lampu_rem_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="lampu_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Rem</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('lampu_rem_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="lampu_rem_foto" id="lampu_rem_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="lampuRemPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="lampuRemImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="lampu_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_rem_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                            document.getElementById('lampu_rem_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('lampuRemImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('lampu_rem_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Lampu Klakson & Pendukung</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_klakson" value="Baik" id="lampu_klakson_baik" required>
                                                            <label class="form-check-label" for="lampu_klakson_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="lampu_klakson" value="Tidak Baik" id="lampu_klakson_tidak_baik">
                                                            <label class="form-check-label" for="lampu_klakson_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="lampu_klakson_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Klakson</label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('lampu_klakson_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="lampu_klakson_foto" id="lampu_klakson_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto lampu klakson
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="lampuKlaksonPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="lampuKlaksonImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="lampu_klakson_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_klakson_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('lampu_klakson_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('lampuKlaksonImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('lampu_klakson_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tombol Navigasi -->
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" id="btn-prev-3" class="btn btn-dark vehicle-prev me-1 text-white btn-kirim" value="Previous">Previous</button>
                                                <button type="button" id="btn-next-3" class="btn btn-primary vehicle-next btn-kirim" value="Next">Next</button>
                                            </div>
                                        </div>
                                        <script>
                                            function updateTimestamp(elementId) {
                                                var now = new Date();
                                                var timestamp = now.toLocaleString(); // Menampilkan tanggal dan waktu lokal
                                                document.getElementById(elementId).innerText = timestamp;
                                            }
                                        </script>
                                    </fieldset>

                                                        
                                    <!-- Pemeriksaan Aki -->
                                    <fieldset>
                                        <div class="form-card text-start">
                                            <div class="row mb-4">
                                            <svg viewBox="0 0 900 400" xmlns="http://www.w3.org/2000/svg">
                                                    <!-- Background -->
                                                    <rect width="900" height="400" fill="#f0f4f8"/>
                                                    
                                                    <!-- Header -->
                                                    <rect width="900" height="80" fill="#2c3e50"/>
                                                    <text x="450" y="50" text-anchor="middle" font-size="24" font-weight="bold" fill="white">
                                                        PANDUAN PEMERIKSAAN TEGANGAN AKI
                                                    </text>

                                                    <!-- Tegangan Aki Section -->
                                                    <g transform="translate(100,100)">
                                                        <rect width="700" height="220" rx="15" fill="white" stroke="#3498db" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="700" height="50" rx="15" fill="#3498db"/>
                                                        <text x="350" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Tegangan Aki</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(30,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Tegangan 12.4-12.7 volt saat mesin mati</text>
                                                            <text x="20" y="70" font-size="14">• Tegangan 13.7-14.7 volt saat mesin hidup</text>
                                                            <text x="20" y="95" font-size="14">• Starter berputar kuat dan lancar</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="350" y="20" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="370" y="45" font-size="14">• Tegangan dibawah 12 volt</text>
                                                            <text x="370" y="70" font-size="14">• Starter lemah atau tidak berputar</text>
                                                            <text x="370" y="95" font-size="14">• Memerlukan jumper/starter dorong</text>
                                                        </g>
                                                    </g>

                                                    <!-- Tips Section -->
                                                    <g transform="translate(15,340)">
                                                        <rect width="870" height="40" rx="20" fill="#34495e"/>
                                                        <text x="430" y="25" text-anchor="middle" font-size="14" fill="white">
                                                            TIPS: Gunakan multimeter digital • Ukur dalam kondisi dingin • Pastikan terminal bersih • Catat hasil pengukuran
                                                        </text>
                                                    </g>
                                                </svg><br>

                                                <div class="col-7">
                                                    <h3 class="mb-4">Pemeriksaan Aki</h3>
                                                </div>
                                                <div class="col-5 text-end">
                                                    <h2 class="steps">Step 4 - 6</h2>
                                                </div>
                                            </div>

                                            <!-- Bagian Pemeriksaan Aki -->
                                            <div class="row">
                                                <!-- Cek Tegangan Aki -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Tegangan Aki <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_aki" value="Baik" id="cek_aki_baik" required>
                                                            <label class="form-check-label" for="cek_aki_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_aki" value="Tidak Baik" id="cek_aki_tidak_baik">
                                                            <label class="form-check-label" for="cek_aki_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi aki
                                                        </div>
                                                        
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="aki_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Tegangan Aki <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('aki_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="aki_foto" id="aki_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto tegangan aki
                                                            </div>
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="akiPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="akiImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="aki_timestamp" class="form-text text-muted">Waktu diambil: <span id="aki_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                            document.getElementById('aki_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('akiImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('aki_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tombol Navigasi -->
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-dark vehicle-prev me-1 text-white btn-kirim" value="Previous">Previous</button>
                                                <button type="button" class="btn btn-primary vehicle-next btn-kirim" value="Next">Next</button>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Form Pemeriksaan Kebersihan -->
                                    <fieldset>
                                        <div class="form-card text-start">
                                            <!-- Header -->
                                            <div class="row mb-4">
                                            <svg viewBox="0 0 900 800" xmlns="http://www.w3.org/2000/svg">
                                                <!-- Background -->
                                                <rect width="900" height="800" fill="#f0f4f8"/>
                                                
                                                <!-- Header -->
                                                <rect width="900" height="80" fill="#2c3e50"/>
                                                <text x="450" y="50" text-anchor="middle" font-size="24" font-weight="bold" fill="white">
                                                    PANDUAN PEMERIKSAAN KEBERSIHAN KENDARAAN
                                                </text>

                                                <!-- Kebersihan Kursi Section -->
                                                <g transform="translate(50,100)">
                                                    <rect width="380" height="280" rx="15" fill="white" stroke="#3498db" stroke-width="2"/>
                                                    <!-- Header -->
                                                    <rect width="380" height="50" rx="15" fill="#3498db"/>
                                                    <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Kebersihan Kursi</text>
                                                    
                                                    <!-- Content -->
                                                    <g transform="translate(20,70)">
                                                        <!-- Kondisi Baik -->
                                                        <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                        <text x="20" y="45" font-size="14">• Tidak ada noda atau kotoran</text>
                                                        <text x="20" y="70" font-size="14">• Jok tidak berbau</text>
                                                        <text x="20" y="95" font-size="14">• Cover kursi bersih dan rapi</text>
                                                        
                                                        <!-- Kondisi Buruk -->
                                                        <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                        <text x="20" y="155" font-size="14">• Ada noda yang mencolok</text>
                                                        <text x="20" y="180" font-size="14">• Berbau tidak sedap</text>
                                                        <text x="20" y="205" font-size="14">• Cover kotor atau rusak</text>
                                                    </g>
                                                </g>

                                                <!-- Kebersihan Lantai Section -->
                                                <g transform="translate(470,100)">
                                                    <rect width="380" height="280" rx="15" fill="white" stroke="#e74c3c" stroke-width="2"/>
                                                    <!-- Header -->
                                                    <rect width="380" height="50" rx="15" fill="#e74c3c"/>
                                                    <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Kebersihan Lantai</text>
                                                    
                                                    <!-- Content -->
                                                    <g transform="translate(20,70)">
                                                        <!-- Kondisi Baik -->
                                                        <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                        <text x="20" y="45" font-size="14">• Karpet bersih dari debu</text>
                                                        <text x="20" y="70" font-size="14">• Tidak ada sampah</text>
                                                        <text x="20" y="95" font-size="14">• Kering dan tidak lembab</text>
                                                        
                                                        <!-- Kondisi Buruk -->
                                                        <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                        <text x="20" y="155" font-size="14">• Karpet kotor dan berdebu</text>
                                                        <text x="20" y="180" font-size="14">• Ada sampah berserakan</text>
                                                        <text x="20" y="205" font-size="14">• Basah atau lembab</text>
                                                    </g>
                                                </g>

                                                <!-- Kebersihan Dinding Section -->
                                                <g transform="translate(50,420)">
                                                    <rect width="380" height="280" rx="15" fill="white" stroke="#2ecc71" stroke-width="2"/>
                                                    <!-- Header -->
                                                    <rect width="380" height="50" rx="15" fill="#2ecc71"/>
                                                    <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Kebersihan Dinding</text>
                                                    
                                                    <!-- Content -->
                                                    <g transform="translate(20,70)">
                                                        <!-- Kondisi Baik -->
                                                        <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                        <text x="20" y="45" font-size="14">• Dinding interior bersih</text>
                                                        <text x="20" y="70" font-size="14">• Cat tidak kusam</text>
                                                        <text x="20" y="95" font-size="14">• Tidak ada kotoran menempel</text>
                                                        
                                                        <!-- Kondisi Buruk -->
                                                        <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                        <text x="20" y="155" font-size="14">• Dinding kotor/bernoda</text>
                                                        <text x="20" y="180" font-size="14">• Cat memudar/kusam</text>
                                                        <text x="20" y="205" font-size="14">• Ada kotoran menempel</text>
                                                    </g>
                                                </g>

                                                <!-- Kebersihan Kap Mesin Section -->
                                                <g transform="translate(470,420)">
                                                    <rect width="380" height="280" rx="15" fill="white" stroke="#f39c12" stroke-width="2"/>
                                                    <!-- Header -->
                                                    <rect width="380" height="50" rx="15" fill="#f39c12"/>
                                                    <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Kebersihan Kap Mesin</text>
                                                    
                                                    <!-- Content -->
                                                    <g transform="translate(20,70)">
                                                        <!-- Kondisi Baik -->
                                                        <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                        <text x="20" y="45" font-size="14">• Ruang mesin bersih</text>
                                                        <text x="20" y="70" font-size="14">• Tidak ada oli berceceran</text>
                                                        <text x="20" y="95" font-size="14">• Bebas debu dan kotoran</text>
                                                        
                                                        <!-- Kondisi Buruk -->
                                                        <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                        <text x="20" y="155" font-size="14">• Ruang mesin kotor</text>
                                                        <text x="20" y="180" font-size="14">• Ada ceceran oli/pelumas</text>
                                                        <text x="20" y="205" font-size="14">• Banyak debu menumpuk</text>
                                                    </g>
                                                </g>

                                                <!-- Tips Section -->
                                                <g transform="translate(15,740)">
                                                    <rect width="870" height="40" rx="20" fill="#34495e"/>
                                                    <text x="430" y="25" text-anchor="middle" font-size="14" fill="white">
                                                        TIPS: Periksa di bawah sinar cukup • Dokumentasikan dengan foto • Periksa sudut tersembunyi • Catat area yang perlu perhatian khusus
                                                    </text>
                                                </g>
                                            </svg><br>

                                                <div class="col-7">
                                                    <h3 class="mb-4">Pemeriksaan Kebersihan</h3>
                                                </div>
                                                <div class="col-5 text-end">
                                                    <h2 class="steps">Step 5 - 6</h2>
                                                </div>
                                            </div>

                                            <!-- Form Content -->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- Kebersihan Kursi -->
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Kebersihan Kursi <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_kursi" value="Baik" id="cek_kursi_baik" required>
                                                            <label class="form-check-label" for="cek_kursi_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_kursi" value="Tidak Baik" id="cek_kursi_tidak_baik">
                                                            <label class="form-check-label" for="cek_kursi_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi kebersihan kursi
                                                        </div>

                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                            <label for="kursi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Kursi <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('kursi_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="kursi_foto" id="kursi_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto kebersihan kursi
                                                            </div>
                                                            
                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="kursiPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="kursiImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="kursi_timestamp" class="form-text text-muted">Waktu diambil: <span id="kursi_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar
                                                            document.getElementById('kursi_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('kursiImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('kursi_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                    <!-- Kebersihan Lantai -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Kebersihan Lantai <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_lantai" value="Baik" id="cek_lantai_baik" required>
                                                            <label class="form-check-label" for="cek_lantai_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_lantai" value="Tidak Baik" id="cek_lantai_tidak_baik">
                                                            <label class="form-check-label" for="cek_lantai_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi kebersihan lantai
                                                        </div>

                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                            <label for="lantai_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Lantai <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('lantai_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="lantai_foto" id="lantai_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto kebersihan lantai
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="lantaiPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="lantaiImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="lantai_timestamp" class="form-text text-muted">Waktu diambil: <span id="lantai_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('lantai_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('lantaiImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('lantai_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- Kebersihan Dinding -->
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Kebersihan Dinding Luar & Dalam <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_dinding" value="Baik" id="cek_dinding_baik" required>
                                                            <label class="form-check-label" for="cek_dinding_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_dinding" value="Tidak Baik" id="cek_dinding_tidak_baik">
                                                            <label class="form-check-label" for="cek_dinding_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi kebersihan dinding
                                                        </div>

                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                            <label for="dinding_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Dinding <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('dinding_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="dinding_foto" id="dinding_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto kebersihan dinding
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="dindingPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="dindingImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="dinding_timestamp" class="form-text text-muted">Waktu diambil: <span id="dinding_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('dinding_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('dindingImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('dinding_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                <!-- Kebersihan Kap Mesin -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Kebersihan Kap Mesin <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_kap" value="Baik" id="cek_kap_baik" required>
                                                            <label class="form-check-label" for="cek_kap_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_kap" value="Tidak Baik" id="cek_kap_tidak_baik">
                                                            <label class="form-check-label" for="cek_kap_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi kebersihan kap mesin
                                                        </div>

                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                            <label for="kap_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Kap Mesin <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('kap_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="kap_foto" id="kap_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto kebersihan kap mesin
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="kapPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="kapImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="kap_timestamp" class="form-text text-muted">Waktu diambil: <span id="kap_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('kap_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('kapImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('kap_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Navigation Buttons -->
                                            <div class="d-flex justify-content-end mt-4">
                                                <button type="button" class="btn btn-dark vehicle-prev me-1 text-white btn-kirim" value="Previous">Previous</button>
                                                <button type="button" class="btn btn-primary vehicle-next btn-kirim" value="Next">Next</button>
                                            </div>
                                        </div>
                                        <script>
                                            function updateTimestamp(elementId) {
                                            var now = new Date();
                                            var timestamp = now.toLocaleString();
                                                document.getElementById(elementId).innerText = timestamp;
                                            }
                                        </script>
                                    </fieldset>


                                    <!--pemeriksaan lain-lain-->
                                    <fieldset>
                                        <div class="form-card text-start">
                                            <div class="row mb-4">

                                            <svg viewBox="0 0 900 1100" xmlns="http://www.w3.org/2000/svg">
                                                    <!-- Background -->
                                                    <rect width="900" height="1100" fill="#f0f4f8"/>
                                                    
                                                    <!-- Header -->
                                                    <rect width="900" height="80" fill="#2c3e50"/>
                                                    <text x="450" y="50" text-anchor="middle" font-size="24" font-weight="bold" fill="white">
                                                        PEMERIKSAAN LAIN-LAIN KENDARAAN
                                                    </text>

                                                    <!-- Row 1 -->
                                                    <!-- STNK Section -->
                                                    <g transform="translate(50,100)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#3498db" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#3498db"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Cek STNK</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Masa berlaku masih aktif</text>
                                                            <text x="20" y="70" font-size="14">• Dokumen jelas dan terbaca</text>
                                                            <text x="20" y="95" font-size="14">• Tidak ada kerusakan dokumen</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Dokumen kadaluarsa</text>
                                                            <text x="20" y="180" font-size="14">• Dokumen rusak/tidak jelas</text>
                                                            <text x="20" y="205" font-size="14">• Informasi tidak lengkap</text>
                                                        </g>
                                                    </g>

                                                    <!-- Kunci Roda Section -->
                                                    <g transform="translate(470,100)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#e74c3c" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#e74c3c"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Cek Kunci Roda</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Kunci roda lengkap</text>
                                                            <text x="20" y="70" font-size="14">• Kondisi masih bagus</text>
                                                            <text x="20" y="95" font-size="14">• Mudah digunakan</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Kunci tidak lengkap</text>
                                                            <text x="20" y="180" font-size="14">• Kunci berkarat/rusak</text>
                                                            <text x="20" y="205" font-size="14">• Sulit digunakan</text>
                                                        </g>
                                                    </g>

                                                    <!-- Row 2 -->
                                                    <!-- APAR Section -->
                                                    <g transform="translate(50,400)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#2ecc71" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#2ecc71"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Cek APAR</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Tekanan normal</text>
                                                            <text x="20" y="70" font-size="14">• Segel masih utuh</text>
                                                            <text x="20" y="95" font-size="14">• Tidak kadaluarsa</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Tekanan rendah</text>
                                                            <text x="20" y="180" font-size="14">• Segel rusak</text>
                                                            <text x="20" y="205" font-size="14">• Sudah kadaluarsa</text>
                                                        </g>
                                                    </g>

                                                    <!-- Kotak P3K Section -->
                                                    <g transform="translate(470,400)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#f39c12" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#f39c12"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Cek Kotak P3K</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Isi lengkap</text>
                                                            <text x="20" y="70" font-size="14">• Obat belum kadaluarsa</text>
                                                            <text x="20" y="95" font-size="14">• Kotak dalam kondisi baik</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Isi tidak lengkap</text>
                                                            <text x="20" y="180" font-size="14">• Ada obat kadaluarsa</text>
                                                            <text x="20" y="205" font-size="14">• Kotak rusak</text>
                                                        </g>
                                                    </g>

                                                    <!-- Row 3 -->
                                                    <!-- Air Radiator Section -->
                                                    <g transform="translate(50,700)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#9b59b6" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#9b59b6"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Cek Air Radiator</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Level air cukup</text>
                                                            <text x="20" y="70" font-size="14">• Tidak ada kebocoran</text>
                                                            <text x="20" y="95" font-size="14">• Warna air jernih</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Level air kurang</text>
                                                            <text x="20" y="180" font-size="14">• Ada kebocoran</text>
                                                            <text x="20" y="205" font-size="14">• Air kotor/keruh</text>
                                                        </g>
                                                    </g>

                                                    <!-- Tekanan Ban Section -->
                                                    <g transform="translate(470,700)">
                                                        <rect width="380" height="280" rx="15" fill="white" stroke="#16a085" stroke-width="2"/>
                                                        <!-- Header -->
                                                        <rect width="380" height="50" rx="15" fill="#16a085"/>
                                                        <text x="190" y="35" text-anchor="middle" font-size="20" font-weight="bold" fill="white">Cek Tekanan Ban</text>
                                                        
                                                        <!-- Content -->
                                                        <g transform="translate(20,70)">
                                                            <!-- Kondisi Baik -->
                                                            <text x="0" y="20" font-size="16" font-weight="bold" fill="#2ecc71">✓ Kondisi Baik:</text>
                                                            <text x="20" y="45" font-size="14">• Tekanan sesuai standar</text>
                                                            <text x="20" y="70" font-size="14">• Tidak ada kebocoran</text>
                                                            <text x="20" y="95" font-size="14">• Kondisi ban baik</text>
                                                            
                                                            <!-- Kondisi Buruk -->
                                                            <text x="0" y="130" font-size="16" font-weight="bold" fill="#e74c3c">✗ Kondisi Buruk:</text>
                                                            <text x="20" y="155" font-size="14">• Tekanan tidak sesuai</text>
                                                            <text x="20" y="180" font-size="14">• Ada kebocoran</text>
                                                            <text x="20" y="205" font-size="14">• Ban aus/rusak</text>
                                                        </g>
                                                    </g>

                                                    <!-- Tips Section -->
                                                    <g transform="translate(15,1020)">
                                                        <rect width="870" height="40" rx="20" fill="#34495e"/>
                                                        <text x="430" y="25" text-anchor="middle" font-size="14" fill="white">
                                                            TIPS: Periksa dengan teliti • Dokumentasikan dengan foto • Catat setiap temuan • Laporkan jika ada masalah
                                                        </text>
                                                    </g>
                                                </svg>
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
                                                        <label class="form-label">Cek STNK <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_stnk" value="Baik" id="cek_stnk_baik" required>
                                                            <label class="form-check-label" for="cek_stnk_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_stnk" value="Tidak Baik" id="cek_stnk_tidak_baik">
                                                            <label class="form-check-label" for="cek_stnk_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi STNK
                                                        </div>

                                                        <!-- Input Foto STNK -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="stnk_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto STNK <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('stnk_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="stnk_foto" id="stnk_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto STNK
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="stnkPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="stnkImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="stnk_timestamp" class="form-text text-muted">Waktu diambil: <span id="stnk_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('stnk_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('stnkImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('stnk_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <!-- Kunci Roda -->
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Kunci Roda <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_kunci_roda" value="Baik" id="cek_kunci_roda_baik" required>
                                                            <label class="form-check-label" for="cek_kunci_roda_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_kunci_roda" value="Tidak Baik" id="cek_kunci_roda_tidak_baik">
                                                            <label class="form-check-label" for="cek_kunci_roda_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi kunci roda
                                                        </div>

                                                        <!-- Input Foto Kunci Roda -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="kunci_roda_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kunci Roda <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('kunci_roda_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="kunci_roda_foto" id="kunci_roda_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto kunci roda
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="kunciRodaPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="kunciRodaImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="kunci_roda_timestamp" class="form-text text-muted">Waktu diambil: <span id="kunci_roda_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('kunci_roda_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('kunciRodaImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('kunci_roda_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- APAR -->
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Apar <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_apar" value="Baik" id="cek_apar_baik" required>
                                                            <label class="form-check-label" for="cek_apar_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_apar" value="Tidak Baik" id="cek_apar_tidak_baik">
                                                            <label class="form-check-label" for="cek_apar_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi Apar
                                                        </div>

                                                        <!-- Input Foto APAR -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="apar_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto APAR <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('apar_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="apar_foto" id="apar_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto APAR
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="aparPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="aparImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="apar_timestamp" class="form-text text-muted">Waktu diambil: <span id="apar_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('apar_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('aparImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('apar_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                    <!-- Kotak P3k -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Kotak P3k <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_p3k" value="Baik" id="cek_p3k_baik" required>
                                                            <label class="form-check-label" for="cek_p3k_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_p3k" value="Tidak Baik" id="cek_p3k_tidak_baik">
                                                            <label class="form-check-label" for="cek_p3k_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi kunci roda
                                                        </div>

                                                        <!-- Input Foto P3K -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="p3k_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto P3K <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('p3k_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="p3k_foto" id="p3k_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto P3K
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="p3kPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="p3kImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="p3k_timestamp" class="form-text text-muted">Waktu diambil: <span id="p3k_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('p3k_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('p3kImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('p3k_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- Rem -->
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Rem <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_rem" value="Baik" id="cek_rem_baik" required>
                                                            <label class="form-check-label" for="cek_rem_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_rem" value="Tidak Baik" id="cek_rem_tidak_baik">
                                                            <label class="form-check-label" for="cek_rem_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi rem
                                                        </div>

                                                        <!-- Input Foto Rem -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Rem <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('rem_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="rem_foto" id="rem_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto rem
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="remPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="remImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="rem_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('rem_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('remImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('rem_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                    <!-- bahan bakar -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Ketersediaan Bahan Bakar <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_bahan_bakar" value="Baik" id="cek_bahan_bakar_baik" required>
                                                            <label class="form-check-label" for="cek_bahan_bakar_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_bahan_bakar" value="Tidak Baik" id="cek_bahan_bakar_tidak_baik">
                                                            <label class="form-check-label" for="cek_bahan_bakar_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi ban cadangan
                                                        </div>

                                                        <!-- Input Foto Bahan Bakar -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="bahan_bakar_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Bahan Bakar <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('bahan_bakar_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="bahan_bakar_foto" id="bahan_bakar_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto bahan bakar
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="bahanBakarPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="bahanBakarImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="bahan_bakar_timestamp" class="form-text text-muted">Waktu diambil: <span id="bahan_bakar_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('bahan_bakar_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('bahanBakarImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('bahan_bakar_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!-- air radiator -->
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Air Radiator <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_air_radiator" value="Baik" id="cek_air_radiator_baik" required>
                                                            <label class="form-check-label" for="cek_air_radiator_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_air_radiator" value="Tidak Baik" id="cek_air_radiator_tidak_baik">
                                                            <label class="form-check-label" for="cek_air_radiator_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi air radiator
                                                        </div>

                                                        <!-- Input Foto Air Radiator -->
                                                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                            <label for="air_radiator_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Air Radiator <span class="text-danger">*</span></label>
                                                            <!-- Tombol untuk membuka kamera -->
                                                            <button type="button" class="form-control" onclick="document.getElementById('air_radiator_foto').click();">Ambil Foto</button>
                                                            <!-- Input file yang dipanggil melalui tombol -->
                                                            <input type="file" class="form-control" name="air_radiator_foto" id="air_radiator_foto" accept="image/*" capture="camera" required style="display:none;" />
                                                            <div class="invalid-feedback">
                                                                Silakan ambil foto air radiator
                                                            </div>

                                                            <!-- Tempat untuk menampilkan gambar -->
                                                            <div id="airRadiatorPreview" style="margin-top: 16px; text-align: center;">
                                                                <img id="airRadiatorImage" src="" alt="Preview Image" 
                                                                    style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
                                                            </div>

                                                            <small id="air_radiator_timestamp" class="form-text text-muted">Waktu diambil: <span id="air_radiator_time">belum diambil</span></small>
                                                        </div>

                                                        <script>
                                                            // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
                                                            document.getElementById('air_radiator_foto').addEventListener('change', function(event) {
                                                                var reader = new FileReader();
                                                                reader.onload = function() {
                                                                    var imgElement = document.getElementById('airRadiatorImage');
                                                                    imgElement.src = reader.result;
                                                                    imgElement.style.display = 'block'; // Menampilkan gambar
                                                                    
                                                                    // Menambahkan timestamp saat gambar dipilih
                                                                    var timestamp = new Date().toLocaleString();
                                                                    document.getElementById('air_radiator_time').textContent = timestamp;
                                                                }
                                                                reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
                                                            });
                                                        </script>

                                                    </div>
                                                </div>

                                                    <!-- tekanan ban -->
                                                <div class="col-md-6">
                                                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                        <label class="form-label">Cek Tekanan Ban <span class="text-danger">*</span></label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_tekanan_ban" value="Baik" id="cek_tekanan_ban_baik" required>
                                                            <label class="form-check-label" for="cek_tekanan_ban_baik">Baik</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="cek_tekanan_ban" value="Tidak Baik" id="cek_tekanan_ban_tidak_baik">
                                                            <label class="form-check-label" for="cek_tekanan_ban_tidak_baik">Tidak Baik</label>
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            Silakan pilih kondisi tekanan ban
                                                        </div>

<!-- Input Foto Tekanan Ban -->
<div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
    <label for="ban_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Tekanan Ban <span class="text-danger">*</span></label>
    <!-- Tombol untuk membuka kamera -->
    <button type="button" class="form-control" onclick="document.getElementById('ban_foto').click();">Ambil Foto</button>
    <!-- Input file yang dipanggil melalui tombol -->
    <input type="file" class="form-control" name="ban_foto" id="ban_foto" accept="image/*" capture="camera" required style="display:none;" />
    <div class="invalid-feedback">
        Silakan ambil foto tekanan ban
    </div>

    <!-- Tempat untuk menampilkan gambar -->
    <div id="banPreview" style="margin-top: 16px; text-align: center;">
        <img id="banImage" src="" alt="Preview Image" 
            style="max-width: 250px; max-height: 200px; width: 100%; height: auto; border-radius: 8px; border: 2px solid #ddd; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); object-fit: cover; display: none; margin: 0 auto;" />
    </div>

    <small id="ban_timestamp" class="form-text text-muted">Waktu diambil: <span id="ban_time">belum diambil</span></small>
</div>

<script>
    // Menambahkan event listener pada input file untuk menampilkan gambar dan timestamp
    document.getElementById('ban_foto').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var imgElement = document.getElementById('banImage');
            imgElement.src = reader.result;
            imgElement.style.display = 'block'; // Menampilkan gambar
            
            // Menambahkan timestamp saat gambar dipilih
            var timestamp = new Date().toLocaleString();
            document.getElementById('ban_time').textContent = timestamp;
        }
        reader.readAsDataURL(event.target.files[0]); // Membaca gambar yang dipilih
    });
</script>

                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Tombol Navigasi -->
                                            <button type="submit" name="submit" class="btn btn-success float-end btn-kirim" value="submit">Submit</button>

                                        </div>
                                        <script>
                                            function updateTimestamp(elementId) {
                                                const currentTime = new Date().toLocaleString();
                                                document.getElementById(elementId).innerText = currentTime;
                                            }
                                        </script>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        <!-- Footer Section Start -->
        <footer class="footer">
            <div class="footer-body">
                <div class="right-panel">
                    ©<script>document.write(new Date().getFullYear())</script> BPSDMP Kominfo
                    <span class="">
                </div>
            </div>
        </footer>
        <!-- Footer Section End -->    
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
        
        <!-- AOS Animation Plugin-->

        <!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        
        <!-- App Script -->
        <script src="../../assets/js/hope-ui.js" defer></script>
        
        <style>
    /* Sembunyikan semua fieldset kecuali yang pertama */
    #vehicle-check-form fieldset:not(:first-of-type) {
        display: none;
    }

    /* Style untuk validasi */
    .form-control.is-invalid,
    .form-check-input.is-invalid {
        border-color: #dc3545;
    }

    .invalid-feedback {
        display: none;
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    .form-control.is-invalid ~ .invalid-feedback,
    .form-check-input.is-invalid ~ .invalid-feedback {
        display: block;
    }

    .text-danger {
        color: #dc3545;
    }
    </style>

    <script>
    // Fungsi untuk update timestamp
    function updateTimestamp(timeId) {
        const now = new Date();
        const timestamp = now.toLocaleString('id-ID');
        document.getElementById(timeId).textContent = timestamp;
    }

    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vehicle-check-form');
    const fieldsets = form.getElementsByTagName('fieldset');
    let currentStep = 0;

    // Fungsi untuk menampilkan pesan error dengan SweetAlert2
    function showErrorAlert(messages) {
        Swal.fire({
            title: 'Data Belum Lengkap',
            html: messages.map(msg => `<p class="mb-2">⚠️ ${msg}</p>`).join(''),
            icon: 'warning',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#3085d6',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    }

    // Fungsi untuk validasi fieldset saat ini
    function validateCurrentFieldset() {
        const currentFieldset = fieldsets[currentStep];
        const requiredFields = currentFieldset.querySelectorAll('[required]');
        let isValid = true;
        let errorMessages = [];

        requiredFields.forEach(field => {
            const fieldLabel = field.getAttribute('data-label') || field.getAttribute('name') || 'Field';

            // Untuk radio buttons
            if (field.type === 'radio') {
                const radioGroup = currentFieldset.querySelectorAll(`input[name="${field.name}"]`);
                const isChecked = Array.from(radioGroup).some(radio => radio.checked);

                if (!isChecked) {
                    isValid = false;
                    radioGroup.forEach(radio => {
                        radio.classList.add('is-invalid');
                    });
                    errorMessages.push(`Mohon pilih salah satu opsi untuk ${fieldLabel}`);
                } else {
                    radioGroup.forEach(radio => {
                        radio.classList.remove('is-invalid');
                    });
                }
            }
            // Untuk file input
            else if (field.type === 'file') {
                if (!field.files || field.files.length === 0) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    errorMessages.push(`Mohon upload file untuk ${fieldLabel}`);
                } else {
                    field.classList.remove('is-invalid');
                }
            }
            // Untuk select dropdown
            else if (field.tagName === 'SELECT') {
                if (!field.value || field.value === '') {
                    isValid = false;
                    field.classList.add('is-invalid');
                    errorMessages.push(`Mohon pilih salah satu opsi untuk ${fieldLabel}`);
                } else {
                    field.classList.remove('is-invalid');
                }
            }
            // Untuk input lainnya
            else {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('is-invalid');
                    errorMessages.push(`Mohon lengkapi ${fieldLabel}`);
                } else {
                    field.classList.remove('is-invalid');
                }
            }
        });

        if (!isValid) {
            showErrorAlert(errorMessages);
        }

        return isValid;
    }

    // Array pesan konfirmasi formal dengan candaan
    const messages = [
        {
            title: "Konfirmasi Pengiriman",
            text: "Apakah Anda yakin ingin mengirim form ini? Data akan diproses seperti kopi yang sedang digiling - tidak bisa kembali 😄"
        },
        {
            title: "Verifikasi Data",
            text: "Form sudah siap dikirim? Seperti helm, lebih baik dipastikan dulu sebelum jalan 🏍️"
        },
        {
            title: "Konfirmasi Submit",
            text: "Pastikan semua data sudah benar ya! Jangan sampai seperti bensin - sudah terlanjur masuk, susah dikeluarkan ⛽"
        },
        {
            title: "Periksa Kembali",
            text: "Data sudah lengkap? Seperti spion, penting untuk memeriksa sebelum melaju 🚗"
        },
        {
            title: "Finalisasi Form",
            text: "Siap untuk mengirim? Ingat, form ini seperti lampu sen - sekali nyala harus diteruskan 🚦"
        },
        {
            title: "Konfirmasi Akhir",
            text: "Yakin data sudah oke? Jangan sampai seperti ban bocor - di tengah jalan baru ketahuan ada yang kurang 🛠️"
        }
    ];

    // Event listener untuk tombol next
    document.querySelectorAll('.vehicle-next').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            if (validateCurrentFieldset()) {
                // Jika ini adalah fieldset terakhir, tampilkan konfirmasi submit
                if (currentStep === fieldsets.length - 1) {
                    // Pilih pesan secara random
                    const randomMessage = messages[Math.floor(Math.random() * messages.length)];

                    // Tampilkan konfirmasi
                    Swal.fire({
                        title: randomMessage.title,
                        text: randomMessage.text,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Kirim!',
                        cancelButtonText: 'Periksa Lagi'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form jika diperlukan
                            const form = document.querySelector('form');
                            if (form) {
                                form.submit();
                            }
                        }
                    });
                } else {
                    // Tampilkan animasi loading
                    Swal.fire({
                        title: 'Menyimpan Data',
                        text: 'Mohon tunggu sebentar...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        },
                        timer: 800
                    }).then(() => {
                        fieldsets[currentStep].style.display = 'none';
                        currentStep++;
                        if (fieldsets[currentStep]) {
                            fieldsets[currentStep].style.display = 'block';
                        }
                    });
                }
            }
        });
    });

    // Event listener untuk tombol previous
    document.querySelectorAll('.vehicle-prev').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Kembali ke Step Sebelumnya?',
                text: 'Pastikan data sudah tersimpan dengan benar',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kembali',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
            }).then((result) => {
                if (result.isConfirmed) {
                    fieldsets[currentStep].style.display = 'none';
                    currentStep--;
                    fieldsets[currentStep].style.display = 'block';
                }
            });
        });
    });

    // Event listener untuk validasi saat input berubah
    document.querySelectorAll('input[required], select[required]').forEach(field => {
        field.addEventListener('change', function() {
            if (this.type === 'radio') {
                const radioGroup = document.querySelectorAll(`input[name="${this.name}"]`);
                radioGroup.forEach(radio => {
                    radio.classList.remove('is-invalid');
                });
            } else {
                if (this.value) {
                    this.classList.remove('is-invalid');

                    // Tampilkan feedback positif
                    const fieldLabel = this.getAttribute('data-label') || this.getAttribute('name') || 'Field';
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });

                    Toast.fire({
                        icon: 'success',
                        title: `${fieldLabel} telah diisi`
                    });
                } else {
                    this.classList.add('is-invalid');
                }
            }
        });
    });
});



    </script>

    <!-- JavaScript - Tambahkan sebelum closing body -->
<script>
function showGuide(type) {
    document.getElementById('modal_' + type).style.display = 'block';
}

function closeGuide(type) {
    document.getElementById('modal_' + type).style.display = 'none';
}

// Tutup modal ketika user klik di luar modal
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
}
</script>

<!-- convert -->
<script src="../../assets/js/kompres-gambar/kompres-gambar.js"></script>
    </body>
</html>