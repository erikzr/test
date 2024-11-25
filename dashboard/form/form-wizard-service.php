<?php
    session_start(); // Start the session
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
@media only screen and (max-width: 768px) {
    .service-row {
        display: block !important;
        margin: 0 auto;
    }
    .form-group {
        width: 100% !important;
        margin-bottom: 1rem;
    }
    .service-item {
        margin-bottom: 1rem;
    }
}
        
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

.navbar {
            background-color: white;
            padding: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .header {
            background: linear-gradient(135deg, #0052cc 0%, #0033cc 100%);
            color: white;
            padding: 2rem;
            border-radius: 10px 10px 0 0;
        }

        .welcome-text {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .sub-text {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .form-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-top: 2rem;
            padding: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            color: #333;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .service-item {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            position: relative;
        }

        .service-row {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr auto;
            gap: 1rem;
            align-items: start;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #666;
        }

        select, input[type="file"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: white;
        }

        .radio-group {
            display: flex;
            gap: 1.5rem;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .radio-option input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: #0052cc;
        }

        .add-button {
            background-color: #0052cc;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .remove-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .timestamp {
            color: #999;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .submit-button {
            background-color: #0052cc;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
            width: 100%;
        }

        .button:hover {
            opacity: 0.9;
        }

        .input-date {
    width: 200px; /* Ubah ukuran sesuai keinginan */
    padding: 0.5rem;
    font-size: 1rem;
}

.input-kilometer {
    width: 200px; /* Ubah ukuran sesuai keinginan */
    padding: 0.5rem;
    font-size: 1rem;
    border-radius: 4px; /* Opsional: agar tampilannya lebih rapi */
    border: 1px solid #ccc; /* Opsional: menambahkan border */
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
                    <a class="nav-link" href="form-wizard asli.php">
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
                    <a class="nav-link active" aria-current="page" href="#">
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
                <!-- Sidebar Menu End --></div>
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
      </div>
      <div class="form-card">
            <div class="form-title">
                <h2>Form Service Rutin</h2>
            </div>
            <button type="button" class="add-button" onclick="addServiceItem()">+ Tambah Item Service</button>
            <br>
            <br>
            
            <form id="serviceForm" method="POST" enctype="multipart/form-data">
                <div id="serviceItems">
                    <div class="service-item">
                        <div class="service-row">
                            <div class="form-group">
                                <label>Pilih mobil</label>
                                <select name="service_type[]" onchange="updateServiceOptions(this)" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($carCategories as $category => $items): ?>
                                        <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kilometer">Kilometer Terakhir</label>
                                <input type="text" name="kilometer" id="kilometer" placeholder="Kilometer Mobil" class="input-kilometer" required>
                            </div>

                            <div class="form-group">
                                <label for="service_date">Tanggal Perbaikan</label>
                                <input type="date" name="service_date" id="service_date" class="input-date" required>
                            </div>

                            <div class="form-group">
                                <label for="return_service_date">Tanggal Selesai Perbaikan</label>
                                <input type="date" name="return_service_date" id="return_service_date" class="input-date" required>
                            </div>
                                    
                            <div class="form-group">
                                <label>Pilih Jenis Service</label>
                                <select name="service_type[]" onchange="updateServiceOptions(this)" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($serviceCategories as $category => $items): ?>
                                        <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pilih Item</label>
                                <select name="service_item[]" required>
                                    <option value="">Pilih Item</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kilometer">Keterangan Tambahan</label>
                                <input type="text" name="kilometer" id="kilometer" placeholder="Kilometer Mobil" class="input-kilometer" required>
                            </div>

                            <div class="form-group">
                                <label>Bukti Nota</label>
                                <input type="file" name="photo[]" accept="image/*" required>
                                <div class="timestamp">Waktu diambil: belum diambil</div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-button">Simpan Pemeriksaan</button>
            </form>
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
    
    <script>
        let serviceCounter = 0;
        const serviceCategories = <?php echo json_encode($serviceCategories); ?>;

        function updateServiceOptions(selectElement) {
            const category = selectElement.value;
            const itemSelect = selectElement.parentElement.nextElementSibling.querySelector('select');
            itemSelect.innerHTML = '<option value="">Pilih Item</option>';

            if (category && serviceCategories[category]) {
                Object.entries(serviceCategories[category]).forEach(([value, label]) => {
                    const option = new Option(label, value);
                    itemSelect.add(option);
                });
            }
        }

        function addServiceItem() {
            serviceCounter++;
            const template = `
                 <div class="service-item">
                        <div class="service-row">
                        <div class="form-group">
                                <label>Pilih mobil</label>
                                <select name="service_type[]" onchange="updateServiceOptions(this)" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($carCategories as $category => $items): ?>
                                        <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kilometer">Kilometer Terakhir</label>
                                <input type="text" name="kilometer" id="kilometer" placeholder="Kilometer Mobil" class="input-kilometer" required>
                            </div>

                            <div class="form-group">
                                <label for="service_date">Tanggal Perbaikan</label>
                                <input type="date" name="service_date" id="service_date" class="input-date" required>
                            </div>

                            <div class="form-group">
                                <label for="return_service_date">Tanggal Selesai Perbaikan</label>
                                <input type="date" name="return_service_date" id="return_service_date" class="input-date" required>
                                <button type="button" class="remove-button" onclick="removeServiceItem(this)">Hapus</button>
                            </div>
                                    
                            <div class="form-group">
                                <label>Pilih Jenis Service</label>
                                <select name="service_type[]" onchange="updateServiceOptions(this)" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach ($serviceCategories as $category => $items): ?>
                                        <option value="<?php echo htmlspecialchars($category); ?>"><?php echo htmlspecialchars($category); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Pilih Item</label>
                                <select name="service_item[]" required>
                                    <option value="">Pilih Item</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kilometer">Keterangan Tambahan</label>
                                <input type="text" name="kilometer" id="kilometer" placeholder="Kilometer Mobil" class="input-kilometer" required>
                            </div>

                            <div class="form-group">
                                <label>Bukti Nota</label>
                                <input type="file" name="photo[]" accept="image/*" required>
                                <div class="timestamp">Waktu diambil: belum diambil</div>
                            </div>
                        </div>
                    </div>
            `;

            document.getElementById('serviceItems').insertAdjacentHTML('beforeend', template);
        }

        function removeServiceItem(button) {
            button.closest('.service-item').remove();
        }

        // Update timestamp when file is selected
        document.addEventListener('change', function(e) {
            if (e.target.type === 'file') {
                const timestamp = new Date().toLocaleString();
                e.target.nextElementSibling.textContent = `Waktu diambil: ${timestamp}`;
            }
        });
    </script>
    
  </body>
</html>