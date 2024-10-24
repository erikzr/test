<?php
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

// Ambil ID dari parameter URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query untuk mengambil data inspeksi
$query = "SELECT * FROM vehicle_inspection WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Jika data tidak ditemukan, redirect ke halaman utama
if (!$data) {
    header("Location: index.php");
    exit;
}

// Fungsi untuk mendapatkan nama mobil
function getCarName($platNomor) {
    switch ($platNomor) {
        case 'W 1740 NP':
            return 'Inova Lama';
        case 'W 1507 NP':
            return 'Inova Reborn';
        case 'W 1374 NP':
            return 'Kijang Kapsul';
        default:
            return 'Unknown';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemeriksaan Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
     <!-- Tailwind CSS CDN -->
     <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body class="bg-gray-50">
    <!-- Komponen Pemeriksaan -->
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Detail Komponen</h2>
            <div class="mb-6">
    <div class="border rounded-lg overflow-hidden">
        <button class="w-full px-4 py-3 flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors" 
                onclick="toggleSection('collapseCairan')" 
                type="button">
            <div class="flex items-center space-x-3">
                <span class="text-xl">🛢️</span>
                <span class="font-medium text-gray-800">Cairan</span>
            </div>
            <i class="fas fa-chevron-down text-gray-500"></i>
        </button>
        
        <div id="collapseCairan" class="block">
            <div class="p-4 space-y-3">
                <!-- oli mesin -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Oli Mesin</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['oli_mesin']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('oli_mesin', this.value, <?php echo $data['id']; ?>)"
                        >
                            <option value="Baik" <?php echo $data['oli_mesin'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                            <option value="Kurang Baik" <?php echo $data['oli_mesin'] === 'Kurang Baik' ? 'selected' : ''; ?>>Kurang Baik</option>
                        </select>
                        
                        <?php if (!empty($data['oli_mesin_foto'])): ?>
                            <img 
                                src="../../form/uploads/<?php echo basename(htmlspecialchars($data['oli_mesin_foto'])); ?>" 
                                alt="Foto Oli Mesin" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('../../form/uploads/<?php echo basename(htmlspecialchars($data['oli_mesin_foto'])); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                                <!-- Tambahkan script untuk handle perubahan status -->
                                <script>
function updateStatus(field, newStatus, id) {
    if(confirm('Apakah anda yakin ingin mengubah status?')) {
        // Debug: Log data yang akan dikirim
        console.log('Sending data:', { field, newStatus, id });

        // Buat FormData object
        const formData = new FormData();
        formData.append('field', field);
        formData.append('status', newStatus);
        formData.append('id', id);

        // Kirim AJAX request ke server
        fetch('update_status.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            // Debug: Log raw response
            console.log('Raw response:', response);
            return response.text(); // Ubah ke text() untuk melihat response mentah
        })
        .then(rawText => {
            console.log('Response text:', rawText);
            // Coba parse sebagai JSON
            try {
                const data = JSON.parse(rawText);
                console.log('Parsed JSON:', data);
                
                if(data.success) {
                    alert('Status berhasil diperbarui!');
                    location.reload();
                } else {
                    alert('Gagal memperbarui status: ' + (data.message || 'Unknown error'));
                }
            } catch (e) {
                console.error('JSON parse error:', e);
                alert('Error parsing response: ' + rawText);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Terjadi kesalahan saat memperbarui status: ' + error.message);
        });
    }
}
</script>

                <!-- Oli Power Steering -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Oli Power Steering</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['oli_power_steering']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('oli_power_steering', this.value)"
                        >
                            <option value="Baik" <?php echo $data['oli_power_steering'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                            <option value="Kurang Baik" <?php echo $data['oli_power_steering'] === 'Kurang Baik' ? 'selected' : ''; ?>>Kurang Baik</option>
                        </select>
                        
                        <?php if (!empty($data['oli_power_steering_foto'])): ?>
                            <img 
                                src="<?php echo htmlspecialchars($data['oli_power_steering_foto']); ?>" 
                                alt="Foto Oli Mesin" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('<?php echo htmlspecialchars($data['oli_power_steering_foto']); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tambahkan script untuk handle perubahan status -->
                <script>
                function updateStatus(field, newStatus) {
                    if(confirm('Apakah anda yakin ingin mengubah status?')) {
                        // Kirim AJAX request ke server
                        fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `field=${field}&status=${newStatus}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                alert('Status berhasil diperbarui!');
                                location.reload(); // Refresh halaman untuk menampilkan perubahan
                            } else {
                                alert('Gagal memperbarui status!');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui status!');
                        });
                    }
                }
                </script>

                 <!-- Oli transmisi -->
                 <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Oli Transmisi</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['oli_transmisi']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('oli_transmisi', this.value)"
                        >
                            <option value="Baik" <?php echo $data['oli_transmisi'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                            <option value="Kurang Baik" <?php echo $data['oli_transmisi'] === 'Kurang Baik' ? 'selected' : ''; ?>>Kurang Baik</option>
                        </select>
                        
                        <?php if (!empty($data['oli_transmisi_foto'])): ?>
                            <img 
                                src="<?php echo htmlspecialchars($data['oli_transmisi_foto']); ?>" 
                                alt="Foto Oli Transmisi" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('<?php echo htmlspecialchars($data['oli_transmisi_foto']); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tambahkan script untuk handle perubahan status -->
                <script>
                function updateStatus(field, newStatus) {
                    if(confirm('Apakah anda yakin ingin mengubah status?')) {
                        // Kirim AJAX request ke server
                        fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `field=${field}&status=${newStatus}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                alert('Status berhasil diperbarui!');
                                location.reload(); // Refresh halaman untuk menampilkan perubahan
                            } else {
                                alert('Gagal memperbarui status!');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui status!');
                        });
                    }
                }
                </script>

                <!-- Minyak Rem -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Minyak Rem</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['minyak_rem']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('minyak_rem', this.value)"
                        >
                            <option value="Baik" <?php echo $data['minyak_rem'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                            <option value="Kurang Baik" <?php echo $data['minyak_rem'] === 'Kurang Baik' ? 'selected' : ''; ?>>Kurang Baik</option>
                        </select>
                        
                        <?php if (!empty($data['minyak_rem_foto'])): ?>
                            <img 
                                src="<?php echo htmlspecialchars($data['minyak_rem_foto']); ?>" 
                                alt="Foto Minyak Rem" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('<?php echo htmlspecialchars($data['minyak_rem_foto']); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tambahkan script untuk handle perubahan status -->
                <script>
                function updateStatus(field, newStatus) {
                    if(confirm('Apakah anda yakin ingin mengubah status?')) {
                        // Kirim AJAX request ke server
                        fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `field=${field}&status=${newStatus}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                alert('Status berhasil diperbarui!');
                                location.reload(); // Refresh halaman untuk menampilkan perubahan
                            } else {
                                alert('Gagal memperbarui status!');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui status!');
                        });
                    }
                }
                </script>

                <!-- Oli transmisi -->
                 <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Oli Transmisi</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['oli_transmisi']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('oli_transmisi', this.value)"
                        >
                            <option value="Baik" <?php echo $data['oli_transmisi'] === 'Baik' ? 'selected' : ''; ?>>Baik</option>
                            <option value="Kurang Baik" <?php echo $data['oli_transmisi'] === 'Kurang Baik' ? 'selected' : ''; ?>>Kurang Baik</option>
                        </select>
                        
                        <?php if (!empty($data['oli_transmisi_foto'])): ?>
                            <img 
                                src="<?php echo htmlspecialchars($data['oli_transmisi_foto']); ?>" 
                                alt="Foto Oli Mesin" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('<?php echo htmlspecialchars($data['oli_transmisi_foto']); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Tambahkan script untuk handle perubahan status -->
                <script>
                function updateStatus(field, newStatus) {
                    if(confirm('Apakah anda yakin ingin mengubah status?')) {
                        // Kirim AJAX request ke server
                        fetch('update_status.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded',
                            },
                            body: `field=${field}&status=${newStatus}`
                        })
                        .then(response => response.json())
                        .then(data => {
                            if(data.success) {
                                alert('Status berhasil diperbarui!');
                                location.reload(); // Refresh halaman untuk menampilkan perubahan
                            } else {
                                alert('Gagal memperbarui status!');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Terjadi kesalahan saat memperbarui status!');
                        });
                    }
                }
                </script>
                <!-- Dan seterusnya untuk komponen lainnya dengan pola yang sama -->
            </div>
        </div>
    </div>
</div>

            <!-- Lampu -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden">
                    <button class="w-full px-4 py-3 flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors" 
                            onclick="toggleSection('collapseLampu')" 
                            type="button">
                        <div class="flex items-center space-x-3">
                            <span class="text-xl">💡</span>
                            <span class="font-medium text-gray-800">Lampu</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </button>
                    
                    <div id="collapseLampu" class="block">
                        <div class="p-4 space-y-3">
                            <!-- lampu utama -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">lampu utama</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['lampu_utama']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['lampu_utama']; ?>
                                    </span>
                                    <?php if (!empty($data['lampu_utama_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['lampu_utama_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- lampu_sein -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">lampu_sein</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['lampu_sein']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['lampu_sein']; ?>
                                    </span>
                                    <?php if (!empty($data['lampu_sein_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['lampu_sein_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- lampu_rem -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">lampu_rem</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['lampu_rem']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['lampu_rem']; ?>
                                    </span>
                                    <?php if (!empty($data['lampu_rem_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['lampu_rem_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- lampu_klakson -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">lampu_klakson</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['lampu_klakson']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['lampu_klakson']; ?>
                                    </span>
                                    <?php if (!empty($data['lampu_klakson_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['lampu_klakson_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Interior -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden">
                    <button class="w-full px-4 py-3 flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors" 
                            onclick="toggleSection('collapseInter')" 
                            type="button">
                        <div class="flex items-center space-x-3">
                            <span class="text-xl">🚘</span>
                            <span class="font-medium text-gray-800">Interior</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </button>
                    
                    <div id="collapseInter" class="block">
                        <div class="p-4 space-y-3">
                            <!-- Aki -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">lampu utama</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_aki']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_aki']; ?>
                                    </span>
                                    <?php if (!empty($data['aki_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['aki_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- cek_kursi -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">cek_kursi</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_kursi']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_kursi']; ?>
                                    </span>
                                    <?php if (!empty($data['kursi_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['kursi_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_lantai -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">cek_lantai</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_lantai']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_lantai']; ?>
                                    </span>
                                    <?php if (!empty($data['lantai_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['lantai_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_dinding -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">cek_dinding</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_dinding']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_dinding']; ?>
                                    </span>
                                    <?php if (!empty($data['dinding_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['dinding_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_kap -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">cek_kap</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_kap']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_kap']; ?>
                                    </span>
                                    <?php if (!empty($data['kap_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['kap_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

                <!-- Dokumen dan Perlengkapan -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden">
                    <button class="w-full px-4 py-3 flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors" 
                            onclick="toggleSection('collapseDoc')" 
                            type="button">
                        <div class="flex items-center space-x-3">
                            <span class="text-xl">📄</span>
                            <span class="font-medium text-gray-800">Dokumen dan Perlengkapan</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </button>
                    
                    <div id="collapseDoc" class="block">
                        <div class="p-4 space-y-3">
                            <!-- Aki -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">STNK</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_stnk']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_stnk']; ?>
                                    </span>
                                    <?php if (!empty($data['stnk_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['stnk_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- APAR -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">APAR</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_apar']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_apar']; ?>
                                    </span>
                                    <?php if (!empty($data['apar_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['apar_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- P3K -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">P3K</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_p3k']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_p3k']; ?>
                                    </span>
                                    <?php if (!empty($data['p3k_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['p3k_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Kunci Roda -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Kunci Roda</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_kunci_roda']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_kunci_roda']; ?>
                                    </span>
                                    <?php if (!empty($data['kunci_roda_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['kunci_roda_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Sistem dan Mekanis -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden">
                    <button class="w-full px-4 py-3 flex items-center justify-between bg-gray-50 hover:bg-gray-100 transition-colors" 
                            onclick="toggleSection('collapseSistem')" 
                            type="button">
                        <div class="flex items-center space-x-3">
                            <span class="text-xl">⚙️</span>
                            <span class="font-medium text-gray-800">Sistem dan Mekanis</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-500"></i>
                    </button>
                    
                    <div id="collapseSistem" class="block">
                        <div class="p-4 space-y-3">
                            <!-- Aki -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Air Radiator</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_air_radiator']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_air_radiator']; ?>
                                    </span>
                                    <?php if (!empty($data['air_radiator_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['air_radiator_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Bahan Bakar -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">cek_kursi</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_bahan_bakar']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_bahan_bakar']; ?>
                                    </span>
                                    <?php if (!empty($data['bahan_bakar_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['bahan_bakar_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Tekanan Ban -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Tekanan Ban</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_tekanan_ban']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_tekanan_ban']; ?>
                                    </span>
                                    <?php if (!empty($data['tekanan_ban_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['tekanan_ban_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Rem -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Rem</span>
                                <div class="flex items-center space-x-4">
                                    <span class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_rem']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                        <?php echo $data['cek_rem']; ?>
                                    </span>
                                    <?php if (!empty($data['rem_foto'])): ?>
                                        <button onclick="viewImage('<?php echo htmlspecialchars($data['rem_foto']); ?>')"
                                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                            <i class="fas fa-image"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white p-4 rounded-lg max-w-2xl w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Detail Foto</h3>
                <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <img id="modalImage" src="" alt="Detail" class="w-full rounded">
        </div>
    </div>

    <script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        const isHidden = section.classList.contains('hidden');
        
        // Hide all sections first
        document.querySelectorAll('[id^="collapse"]').forEach(el => {
            if (el.id !== sectionId) {
                el.classList.add('hidden');
            }
        });
        
        // Toggle current section
        if (isHidden) {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    }

    function viewImage(imagePath) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imagePath;
        modal.classList.remove('hidden');
    }

    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside the image
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    </script>
</body>
</html>