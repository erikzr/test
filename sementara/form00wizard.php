<?php
    session_start(); // Start the session
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

    <style>
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
    
    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all ">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="#" class="navbar-brand">
                
                <!--Logo start-->
                <div class="logo-main">
                    
                    <div class="logo-mini">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <!--logo End-->
                
                
                
                <img src="../../kmnf.png" alt="Kominfo Logo" class="icon-30">

                <h4 class="logo-title">BMN-Operasional</h4>
            </a>
            
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <!-- Sidebar Menu Start -->
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    <li class="nav-item static-item">
                        <a class="nav-link static-item disabled" href="#" tabindex="-1">
                            <span class="default-icon">Home</span>
                            <span class="mini-icon">-</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="#">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-20">
                                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="form-wizard-service.php">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-20">
                                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">Service</span>
                        </a>
                    </li>
                </ul>
                <!-- Sidebar Menu End -->        </div>
        </div>
        <div class="sidebar-footer"></div>
    </aside>    <main class="main-content">
      <div class="position-relative iq-banner">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
          <div class="container-fluid navbar-inner">
            <a href="../../dashboard/index.html" class="navbar-brand">
                
                <!--Logo start-->
                <div class="logo-main">
                    <div class="logo-normal">
                    <img src="../../kmnf.png" alt="Kominfo Logo" class="icon-30">

                    </div>
                    <div class="logo-mini">
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                        </svg>
                    </div>
                </div>
                <!--logo End-->
                
                <h4 class="logo-title">BMN-Operasional</h4>
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
                                        echo "Halo , " . $_SESSION['full_name'] . "!"; // Display user's full name
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
          </div>          <!-- Nav Header Component End -->
        <!--Nav End-->
      </div>
      <div class="conatiner-fluid content-inner mt-n5 py-0">
       <div>
            <div class="row">                
                <div class="col-sm-12 col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Form Pengecekan Kendaraan</h4>
                        </div>
                        </div>
                        <div class="card-body">
                        <form id="vehicle-check-form" class="mt-3 text-center" action="proses_form.php" method="post" enctype="multipart/form-data">
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
        <button type="button" id="btn-next-1" class="btn btn-primary float-end vehicle-next" value="Next">Next</button>
    </fieldset>

    <!-- Pemeriksaan Oli -->
    <fieldset>
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
                            <input class="form-check-input" type="radio" name="oli_mesin" value="baik" id="oli_mesin_baik" required>
                            <label class="form-check-label" for="oli_mesin_baik">Baik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="oli_mesin" value="tidak_baik" id="oli_mesin_tidak_baik">
                            <label class="form-check-label" for="oli_mesin_tidak_baik">Tidak Baik</label>
                        </div>
                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                            <label for="oli_mesin_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Mesin</label>
                            <input type="file" class="form-control" name="oli_mesin_foto" id="oli_mesin_foto" accept="image/*" capture="camera" required/>
                            <small id="oli_mesin_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_mesin_time">belum diambil</span></small>
                        </div>
                    </div>
                </div>

                <!-- Bagian Oli Power Steering -->
                <div class="col-md-6">
                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                        <label class="form-label">Oli Power Steering</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="oli_power_steering" value="baik" id="oli_power_steering_baik" required>
                            <label class="form-check-label" for="oli_power_steering_baik">Baik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="oli_power_steering" value="tidak_baik" id="oli_power_steering_tidak_baik">
                            <label class="form-check-label" for="oli_power_steering_tidak_baik">Tidak Baik</label>
                        </div>
                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                            <label for="oli_power_steering_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Power Steering</label>
                            <input type="file" class="form-control" name="oli_power_steering_foto" id="oli_power_steering_foto" accept="image/*" capture="camera" required/>
                            <small id="oli_power_steering_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_power_steering_time">belum diambil</span></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bagian Oli Transmisi dan Minyak Rem -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                        <label class="form-label">Oli Transmisi</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="oli_transmisi" value="baik" id="oli_transmisi_baik" required>
                            <label class="form-check-label" for="oli_transmisi_baik">Baik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="oli_transmisi" value="tidak_baik" id="oli_transmisi_tidak_baik">
                            <label class="form-check-label" for="oli_transmisi_tidak_baik">Tidak Baik</label>
                        </div>
                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                            <label for="oli_transmisi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Transmisi</label>
                            <input type="file" class="form-control" name="oli_transmisi_foto" id="oli_transmisi_foto" accept="image/*" capture="camera" required/>
                            <small id="oli_transmisi_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_transmisi_time">belum diambil</span></small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                        <label class="form-label">Minyak Rem</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="minyak_rem" value="baik" id="minyak_rem_baik" required>
                            <label class="form-check-label" for="minyak_rem_baik">Baik</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="minyak_rem" value="tidak_baik" id="minyak_rem_tidak_baik">
                            <label class="form-check-label" for="minyak_rem_tidak_baik">Tidak Baik</label>
                        </div>
                        <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                            <label for="minyak_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Minyak Rem</label>
                            <input type="file" class="form-control" name="minyak_rem_foto" id="minyak_rem_foto" accept="image/*" capture="camera" required/>
                            <small id="minyak_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="minyak_rem_time">belum diambil</span></small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Navigasi -->
            <div class="d-flex justify-content-end mt-4">
                <button type="button" id="btn-prev-2" class="btn btn-dark vehicle-prev me-1 text-white" value="Previous">Previous</button>
                <button type="button" id="btn-next-2" class="btn btn-primary vehicle-next" value="Next">Next</button>
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
<!-- Pemeriksaan Penerangan -->
<fieldset>
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
                        <input class="form-check-input" type="radio" name="lampu_utama" value="baik" id="lampu_utama_baik" required>
                        <label class="form-check-label" for="lampu_utama_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_utama" value="tidak_baik" id="lampu_utama_tidak_baik">
                        <label class="form-check-label" for="lampu_utama_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_utama_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Utama</label>
                        <input type="file" class="form-control" name="lampu_utama_foto" id="lampu_utama_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_utama_time')" />
                        <small id="lampu_utama_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_utama_time">belum diambil</span></small>
                    </div>
                </div>
            </div>

            <!-- Bagian Lampu Sein -->
            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Sein</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_sein" value="baik" id="lampu_sein_baik" required>
                        <label class="form-check-label" for="lampu_sein_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_sein" value="tidak_baik" id="lampu_sein_tidak_baik">
                        <label class="form-check-label" for="lampu_sein_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_sein_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Sein</label>
                        <input type="file" class="form-control" name="lampu_sein_foto" id="lampu_sein_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_sein_time')" />
                        <small id="lampu_sein_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_sein_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Lampu Rem dan Klakson -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Rem</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_rem" value="baik" id="lampu_rem_baik" required>
                        <label class="form-check-label" for="lampu_rem_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_rem" value="tidak_baik" id="lampu_rem_tidak_baik">
                        <label class="form-check-label" for="lampu_rem_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Rem</label>
                        <input type="file" class="form-control" name="lampu_rem_foto" id="lampu_rem_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_rem_time')" />
                        <small id="lampu_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_rem_time">belum diambil</span></small>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Klakson & Pendukung</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_klakson" value="baik" id="lampu_klakson_baik" required>
                        <label class="form-check-label" for="lampu_klakson_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_klakson" value="tidak_baik" id="lampu_klakson_tidak_baik">
                        <label class="form-check-label" for="lampu_klakson_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_klakson_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Klakson</label>
                        <input type="file" class="form-control" name="lampu_klakson_foto" id="lampu_klakson_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_klakson_time')" />
                        <small id="lampu_klakson_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_klakson_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-end mt-4">
            <button type="button" id="btn-prev-3" class="btn btn-dark vehicle-prev me-1 text-white" value="Previous">Previous</button>
            <button type="button" id="btn-next-3" class="btn btn-primary vehicle-next" value="Next">Next</button>
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
<!-- Pemeriksaan Aki -->
<fieldset>
    <div class="form-card text-start">
        <div class="row mb-4">
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
                        <input class="form-check-input" type="radio" name="cek_aki" value="baik" id="cek_aki_baik" required>
                        <label class="form-check-label" for="cek_aki_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_aki" value="tidak_baik" id="cek_aki_tidak_baik">
                        <label class="form-check-label" for="cek_aki_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi aki
                    </div>
                    
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="aki_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Tegangan Aki <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="aki_foto" id="aki_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('aki_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto tegangan aki
                        </div>
                        <small id="aki_timestamp" class="form-text text-muted">Waktu diambil: <span id="aki_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-dark vehicle-prev me-1 text-white" value="Previous">Previous</button>
            <button type="button" class="btn btn-primary vehicle-next" value="Next">Next</button>
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
<!-- Form Pemeriksaan Kebersihan -->
<fieldset>
    <div class="form-card text-start">
        <!-- Header -->
        <div class="row">
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
                        <input class="form-check-input" type="radio" name="cek_kursi" value="baik" id="cek_kursi_baik" required>
                        <label class="form-check-label" for="cek_kursi_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_kursi" value="tidak_baik" id="cek_kursi_tidak_baik">
                        <label class="form-check-label" for="cek_kursi_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi kebersihan kursi
                    </div>

                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                        <label for="kursi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Kursi <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="kursi_foto" id="kursi_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('kursi_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto kebersihan kursi
                        </div>
                        <small id="kursi_timestamp" class="form-text text-muted">Waktu diambil: <span id="kursi_time">belum diambil</span></small>
                    </div>
                </div>

                <!-- Kebersihan Lantai -->
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Cek Kebersihan Lantai <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_lantai" value="baik" id="cek_lantai_baik" required>
                        <label class="form-check-label" for="cek_lantai_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_lantai" value="tidak_baik" id="cek_lantai_tidak_baik">
                        <label class="form-check-label" for="cek_lantai_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi kebersihan lantai
                    </div>

                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                        <label for="lantai_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Lantai <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="lantai_foto" id="lantai_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lantai_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto kebersihan lantai
                        </div>
                        <small id="lantai_timestamp" class="form-text text-muted">Waktu diambil: <span id="lantai_time">belum diambil</span></small>
                    </div>
                </div>

                <!-- Kebersihan Dinding -->
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Cek Kebersihan Dinding Luar & Dalam <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_dinding" value="baik" id="cek_dinding_baik" required>
                        <label class="form-check-label" for="cek_dinding_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_dinding" value="tidak_baik" id="cek_dinding_tidak_baik">
                        <label class="form-check-label" for="cek_dinding_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi kebersihan dinding
                    </div>

                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                        <label for="dinding_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Dinding <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="dinding_foto" id="dinding_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('dinding_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto kebersihan dinding
                        </div>
                        <small id="dinding_timestamp" class="form-text text-muted">Waktu diambil: <span id="dinding_time">belum diambil</span></small>
                    </div>
                </div>

                <!-- Kebersihan Kap Mesin -->
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Cek Kebersihan Kap Mesin <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_kap" value="baik" id="cek_kap_baik" required>
                        <label class="form-check-label" for="cek_kap_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_kap" value="tidak_baik" id="cek_kap_tidak_baik">
                        <label class="form-check-label" for="cek_kap_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi kebersihan kap mesin
                    </div>

                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                        <label for="kap_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kebersihan Kap Mesin <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="kap_foto" id="kap_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('kap_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto kebersihan kap mesin
                        </div>
                        <small id="kap_timestamp" class="form-text text-muted">Waktu diambil: <span id="kap_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Buttons -->
        <div class="d-flex justify-content-end mt-4">
            <button type="button" class="btn btn-dark vehicle-prev me-1 text-white" value="Previous">Previous</button>
            <button type="button" class="btn btn-primary vehicle-next" value="Next">Next</button>
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
<!--pemeriksaan lain-lain-->
<fieldset>
    <div class="form-card text-start">
        <div class="row mb-4">
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
                        <input class="form-check-input" type="radio" name="cek_stnk" value="baik" id="cek_stnk_baik" required>
                        <label class="form-check-label" for="cek_stnk_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_stnk" value="tidak_baik" id="cek_stnk_tidak_baik">
                        <label class="form-check-label" for="cek_stnk_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi STNK
                    </div>

                    <!-- Input Foto -->
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="stnk_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto STNK <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="stnk_foto" id="stnk_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('stnk_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto STNK
                        </div>
                        <small id="stnk_timestamp" class="form-text text-muted">Waktu diambil: <span id="stnk_time">belum diambil</span></small>
                    </div>
                </div>

                <!-- Kunci Roda -->
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Cek Kunci Roda <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_kunci_roda" value="baik" id="cek_kunci_roda_baik" required>
                        <label class="form-check-label" for="cek_kunci_roda_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_kunci_roda" value="tidak_baik" id="cek_kunci_roda_tidak_baik">
                        <label class="form-check-label" for="cek_kunci_roda_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi kunci roda
                    </div>

                    <!-- Input Foto -->
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="kunci_roda_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kunci Roda <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="kunci_roda_foto" id="kunci_roda_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('kunci_roda_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto kunci roda
                        </div>
                        <small id="kunci_roda_timestamp" class="form-text text-muted">Waktu diambil: <span id="kunci_roda_time">belum diambil</span></small>
                    </div>
                </div>

                <!-- Air Radiator -->
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Cek Air Radiator <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_air_radiator" value="baik" id="cek_air_radiator_baik" required>
                        <label class="form-check-label" for="cek_air_radiator_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_air_radiator" value="tidak_baik" id="cek_air_radiator_tidak_baik">
                        <label class="form-check-label" for="cek_air_radiator_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi air radiator
                    </div>

                    <!-- Input Foto -->
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="air_radiator_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Air Radiator <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="air_radiator_foto" id="air_radiator_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('air_radiator_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto air radiator
                        </div>
                        <small id="air_radiator_timestamp" class="form-text text-muted">Waktu diambil: <span id="air_radiator_time">belum diambil</span></small>
                    </div>
                </div>

                <!-- Ban Cadangan -->
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Cek Ketersediaan Ban Cadangan <span class="text-danger">*</span></label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_ban_cadangan" value="baik" id="cek_ban_cadangan_baik" required>
                        <label class="form-check-label" for="cek_ban_cadangan_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cek_ban_cadangan" value="tidak_baik" id="cek_ban_cadangan_tidak_baik">
                        <label class="form-check-label" for="cek_ban_cadangan_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="invalid-feedback">
                        Silakan pilih kondisi ban cadangan
                    </div>

                    <!-- Input Foto -->
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="ban_cadangan_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Ban Cadangan <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" name="ban_cadangan_foto" id="ban_cadangan_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('ban_cadangan_time')" />
                        <div class="invalid-feedback">
                            Silakan ambil foto ban cadangan
                        </div>
                        <small id="ban_cadangan_timestamp" class="form-text text-muted">Waktu diambil: <span id="ban_cadangan_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi -->
<div class="d-flex justify-content-end mt-4">
<button type="submit" name="next" class="btn btn-primary next action-button float-end" value="Submit">Submit</button>
<button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1 text-white" value="Previous">Previous</button>
</div>

    </div>
</fieldset>
                            <script>
                                function updateTimestamp(elementId) {
                                    const currentTime = new Date().toLocaleString();
                                    document.getElementById(elementId).innerText = currentTime;
                                }
                            </script>

<!--Finish-->
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

<script>
// Pastikan script dijalankan setelah DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    // Tambahkan event listener untuk tombol next
    const nextButton = document.querySelector('.vehicle-next');
    if (nextButton) {
        nextButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Validasi form terlebih dahulu
            const currentFieldset = this.closest('fieldset');
            const requiredInputs = currentFieldset.querySelectorAll('input[required]');
            const radioGroups = new Set();
            
            // Cek semua input required
            let isValid = true;
            requiredInputs.forEach(input => {
                if (input.type === 'radio') {
                    radioGroups.add(input.name);
                } else if (!input.value) {
                    isValid = false;
                    input.classList.add('is-invalid');
                }
            });
            
            // Cek radio groups
            radioGroups.forEach(groupName => {
                const checkedRadio = currentFieldset.querySelector(`input[name="${groupName}"]:checked`);
                if (!checkedRadio) {
                    isValid = false;
                    const radioInputs = currentFieldset.querySelectorAll(`input[name="${groupName}"]`);
                    radioInputs.forEach(radio => radio.classList.add('is-invalid'));
                }
            });
            
            if (!isValid) {
                Swal.fire({
                    title: 'Error',
                    text: 'Mohon lengkapi semua field yang wajib diisi',
                    icon: 'error',
                    confirmButtonColor: '#3085d6'
                });
                return;
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
                    // Sembunyikan fieldset saat ini
                    currentFieldset.style.display = 'none';
                    
                    // Tampilkan fieldset finish
                    const finishFieldset = document.querySelector('fieldset:last-of-type');
                    if (finishFieldset) {
                        finishFieldset.style.display = 'block';
                        // Scroll ke atas fieldset finish
                        finishFieldset.scrollIntoView({ behavior: 'smooth' });
                    }
                    
                    // Submit form jika diperlukan
                    const form = document.querySelector('form');
                    if (form) {
                        form.submit();
                    }
                }
            });
        });
    }

    // Hapus class invalid saat input berubah
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('change', function() {
            this.classList.remove('is-invalid');
        });
    });
});
</script>
                        </form>
                        </div>
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
      <!-- Footer Section End -->    </main>

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

// Fungsi untuk menangani navigasi form
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vehicle-check-form');
    const fieldsets = form.getElementsByTagName('fieldset');
    let currentStep = 0;

    // Fungsi untuk validasi fieldset saat ini
    function validateCurrentFieldset() {
        const currentFieldset = fieldsets[currentStep];
        const requiredFields = currentFieldset.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            // Untuk radio buttons
            if (field.type === 'radio') {
                const radioGroup = currentFieldset.querySelectorAll(`input[name="${field.name}"]`);
                const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                
                if (!isChecked) {
                    isValid = false;
                    radioGroup.forEach(radio => {
                        radio.classList.add('is-invalid');
                    });
                } else {
                    radioGroup.forEach(radio => {
                        radio.classList.remove('is-invalid');
                    });
                }
            } 
            // Untuk input lainnya
            else {
                if (!field.value) {
                    isValid = false;
                    field.classList.add('is-invalid');
                } else {
                    field.classList.remove('is-invalid');
                }
            }
        });

        return isValid;
    }

    // Event listener untuk tombol next
    document.querySelectorAll('.vehicle-next').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (validateCurrentFieldset()) {
                fieldsets[currentStep].style.display = 'none';
                currentStep++;
                if (fieldsets[currentStep]) {
                    fieldsets[currentStep].style.display = 'block';
                }
            } else {
                alert('Mohon lengkapi semua field yang wajib diisi');
            }
        });
    });

    // Event listener untuk tombol previous
    document.querySelectorAll('.vehicle-prev').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            fieldsets[currentStep].style.display = 'none';
            currentStep--;
            fieldsets[currentStep].style.display = 'block';
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
                } else {
                    this.classList.add('is-invalid');
                }
            }
        });
    });
});
</script>
  </body>
</html>