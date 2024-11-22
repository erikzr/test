<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengecekan Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
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
    </style>
</head>
<body>
    <?php
    // Define service categories and their items
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

    <nav class="navbar">
        <img src="logo.png" alt="Logo" class="logo">
    </nav>

    <div class="container">
        <div class="header">
            <h1 class="welcome-text">Halo, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?>!</h1>
            <p class="sub-text">Selamat Datang di Form Checkup Mobil Kominfo</p>
        </div>

        <div class="form-card">
            <div class="form-title">
                <h2>Form Pengecekan Kendaraan</h2>
                <button type="button" class="add-button" onclick="addServiceItem()">+ Tambah Item Service</button>
            </div>

            <form id="serviceForm" method="POST" enctype="multipart/form-data">
                <div id="serviceItems">
                    <div class="service-item">
                        <div class="service-row">
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
                                <label>Kondisi</label>
                                <div class="radio-group">
                                    <label class="radio-option">
                                        <input type="radio" name="condition[0]" value="baik" required> Baik
                                    </label>
                                    <label class="radio-option">
                                        <input type="radio" name="condition[0]" value="tidak_baik" required> Tidak Baik
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Foto</label>
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
                            <label>Pilih Jenis Service</label>
                            <select name="service_type[]" onchange="updateServiceOptions(this)" required>
                                <option value="">Pilih Kategori</option>
                                ${Object.keys(serviceCategories).map(category => 
                                    `<option value="${category}">${category}</option>`
                                ).join('')}
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Pilih Item</label>
                            <select name="service_item[]" required>
                                <option value="">Pilih Item</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Kondisi</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="condition[${serviceCounter}]" value="baik" required> Baik
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="condition[${serviceCounter}]" value="tidak_baik" required> Tidak Baik
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="photo[]" accept="image/*" required>
                            <div class="timestamp">Waktu diambil: belum diambil</div>
                            <button type="button" class="remove-button" onclick="removeServiceItem(this)">Hapus</button>
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