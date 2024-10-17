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
        .steps{
            margin-right: 200px;
            width:200px;
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
                    <div class="logo-normal">
                        <svg class=" icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                        </svg>
                    </div>
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
                
                
                
                
                <h4 class="logo-title">BMN-Operasional</h4>
            </a>
            <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                <i class="icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </i>
            </div>
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
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="icon">
                                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="icon-20">
                                    <path opacity="0.4" d="M16.0756 2H19.4616C20.8639 2 22.0001 3.14585 22.0001 4.55996V7.97452C22.0001 9.38864 20.8639 10.5345 19.4616 10.5345H16.0756C14.6734 10.5345 13.5371 9.38864 13.5371 7.97452V4.55996C13.5371 3.14585 14.6734 2 16.0756 2Z" fill="currentColor"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="currentColor"></path>
                                </svg>
                            </i>
                            <span class="item-name">Dashboard</span>
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
                        <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                            <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                            <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                            <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
                        </svg>
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
                        <form id="form-wizard1" class="mt-3 text-center"action="proses_form.php" method="post" enctype="multipart/form-data">
                            <ul id="top-tab-list" class="p-0 row list-inline">
                            <!-- ini adalah kotak konfirmasi selesai dari form -->
                                <li class="mb-2 col-lg-3 col-md-6 text-start " id="data-pribadi">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                            </svg>                                        
                                        </div>
                                        <span class="dark-wizard">Data Pribadi</span>
                                    </a>
                                </li>
                                <li class="mb-2 col-lg-3 col-md-6 text-start" id="oli">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>                                        
                                        </div>
                                        <span class="dark-wizard">Oli</span>
                                    </a>
                                </li>
                                <li class="mb-2 col-lg-3 col-md-6 text-start" id="penerangan">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>                                        
                                        </div>
                                        <span class="dark-wizard">Penerangan</span>
                                    </a>
                                </li>
                                <li id="aki" class="mb-2 col-lg-3 col-md-6 text-start">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />

                                            </svg>
                                        </div>
                                        <span class="dark-wizard">Aki</span>
                                    </a>
                                </li>
                                <li id="Kebersihan" class="mb-2 col-lg-3 col-md-6 text-start">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <span class="dark-wizard">Kebersihan</span>
                                    </a>
                                </li>
                                <li id="lain-lain" class="mb-2 col-lg-3 col-md-6 text-start">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                        <span class="dark-wizard">Lain-lain</span>
                                    </a>
                                </li>
                                <li id="confirm" class="mb-2 col-lg-3 col-md-6 text-start">
                                    <a href="javascript:void();">
                                        <div class="iq-icon me-3">
                                            <svg class="svg-icon icon-20" xmlns="http://www.w3.org/2000/svg"  width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </div>
                                        <span class="dark-wizard">Finish</span>
                                    </a>
                                </li>
                            <!-- sampai dengan sini adalah kotak konfirmasi form -->

                            </ul>
                            <!-- fieldsets -->
<!-- Data Pribadi        --><fieldset>
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
                                <button type="submit" name="next" class="btn btn-primary next action-button float-end" value="Submit">Submit</button>
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
    
    
  </body>
</html>