<?php
session_start(); // Memulai sesi
include 'auth/koneksi.php';

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

            <!-- cairan -->
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
                            <!-- Oli Mesin -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Oli Mesin</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['oli_mesin'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('oli_mesin', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['oli_mesin'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['oli_mesin'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    
                                    <?php if (!empty($data['oli_mesin_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['oli_mesin_foto'])); ?>" 
                                            alt="Foto Oli Mesin" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['oli_mesin_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Oli Power Steering -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Oli Power Steering</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['oli_power_steering'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('oli_power_steering', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['oli_power_steering'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['oli_power_steering'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    
                                    <?php if (!empty($data['oli_power_steering_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['oli_power_steering_foto'])); ?>" 
                                            alt="Foto Oli Power Steering" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['oli_power_steering_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Oli Transmisi -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Oli Transmisi</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['oli_transmisi'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('oli_transmisi', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['oli_transmisi'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['oli_transmisi'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    
                                    <?php if (!empty($data['oli_transmisi_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['oli_transmisi_foto'])); ?>" 
                                            alt="Foto Oli Transmisi" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['oli_transmisi_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Minyak Rem -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Minyak Rem</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['minyak_rem'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('minyak_rem', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['minyak_rem'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['minyak_rem'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    
                                    <?php if (!empty($data['minyak_rem_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['minyak_rem_foto'])); ?>" 
                                            alt="Foto Minyak Rem" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['minyak_rem_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <script>
                            function updateStatus(field, newStatus, id) {
                                if(confirm('Apakah anda yakin ingin mengubah status?')) {
                                    const formData = new FormData();
                                    formData.append('field', field);
                                    formData.append('status', newStatus);
                                    formData.append('id', id);

                                    fetch('update_status.php', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.text())
                                    .then(rawText => {
                                        try {
                                            const data = JSON.parse(rawText);
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

                            function toggleSection(sectionId) {
                                const section = document.getElementById(sectionId);
                                section.classList.toggle('hidden');
                            }

                            function viewImage(imagePath) {
                                window.open(imagePath, '_blank');
                            }
                            </script>
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
                                <span class="font-medium text-gray-700">Lampu Utama</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['lampu_utama'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('lampu_utama', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['lampu_utama'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['lampu_utama'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['lampu_utama_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_utama_foto'])); ?>" 
                                            alt="Foto Lampu Utama" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_utama_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- lampu sein -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Lampu Sein</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['lampu_sein'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('lampu_sein', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['lampu_sein'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['lampu_sein'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['lampu_sein_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_sein_foto'])); ?>" 
                                            alt="Foto Lampu Sein" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_sein_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- lampu rem -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Lampu Rem</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['lampu_rem'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('lampu_rem', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['lampu_rem'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['lampu_rem'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['lampu_rem_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_rem_foto'])); ?>" 
                                            alt="Foto Lampu Rem" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_rem_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- lampu klakson -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Lampu Klakson</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['lampu_klakson'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('lampu_klakson', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['lampu_klakson'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['lampu_klakson'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['lampu_klakson_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_klakson_foto'])); ?>" 
                                            alt="Foto Lampu Klakson" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['lampu_klakson_foto'])); ?>')"
                                        >
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
                            
                            <!-- cek_aki -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Cek Aki</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['cek_aki'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_aki', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_aki'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_aki'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['aki_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['aki_foto'])); ?>" 
                                            alt="Foto Aki" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['aki_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- cek_kursi -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Cek Kursi</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['cek_kursi'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_kursi', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_kursi'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_kursi'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['kursi_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['kursi_foto'])); ?>" 
                                            alt="Foto Kursi" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['kursi_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_lantai -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Cek Lantai</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['cek_lantai'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_lantai', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_lantai'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_lantai'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['lantai_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['lantai_foto'])); ?>" 
                                            alt="Foto Lantai" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['lantai_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_dinding -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Cek Dinding</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['cek_dinding'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_dinding', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_dinding'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_dinding'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['dinding_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['dinding_foto'])); ?>" 
                                            alt="Foto Dinding" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['dinding_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_kap -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Cek Kap</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo ($data['cek_kap'] === 'baik') ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_kap', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_kap'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_kap'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['kap_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['kap_foto'])); ?>" 
                                            alt="Foto Kap" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['kap_foto'])); ?>')"
                                        >
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
                            
                            <!-- cek_stnk -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">STNK</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_stnk']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_stnk', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_stnk'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_stnk'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['stnk_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['stnk_foto'])); ?>" 
                                            alt="Foto STNK" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['stnk_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- cek_apar -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">APAR</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_apar']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_apar', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_apar'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_apar'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['apar_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['apar_foto'])); ?>" 
                                            alt="Foto APAR" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['apar_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_p3k -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">P3K</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_p3k']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_p3k', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_p3k'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_p3k'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['p3k_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['p3k_foto'])); ?>" 
                                            alt="Foto P3K" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['p3k_foto'])); ?>')"
                                        >
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_kunci_roda -->
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <span class="font-medium text-gray-700">Kunci Roda</span>
                                <div class="flex items-center space-x-4">
                                    <select 
                                        class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_kunci_roda']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                                        onchange="updateStatus('cek_kunci_roda', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="baik" <?php echo ($data['cek_kunci_roda'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="tidak_baik" <?php echo ($data['cek_kunci_roda'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['kunci_roda_foto'])): ?>
                                        <img 
                                            src="../form/uploads/<?php echo basename(htmlspecialchars($data['kunci_roda_foto'])); ?>" 
                                            alt="Foto Kunci Roda" 
                                            class="w-10 h-10 rounded object-cover cursor-pointer"
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['kunci_roda_foto'])); ?>')"
                                        >
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
                
                <!-- cek_air_radiator -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Air Radiator</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_air_radiator']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('cek_air_radiator', this.value, <?php echo $data['id']; ?>)"
                        >
                            <option value="baik" <?php echo ($data['cek_air_radiator'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                            <option value="tidak_baik" <?php echo ($data['cek_air_radiator'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                        </select>
                        <?php if (!empty($data['air_radiator_foto'])): ?>
                            <img 
                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['air_radiator_foto'])); ?>" 
                                alt="Foto Air Radiator" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['air_radiator_foto'])); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- cek_bahan_bakar -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Bahan Bakar</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_bahan_bakar']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('cek_bahan_bakar', this.value, <?php echo $data['id']; ?>)"
                        >
                            <option value="baik" <?php echo ($data['cek_bahan_bakar'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                            <option value="tidak_baik" <?php echo ($data['cek_bahan_bakar'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                        </select>
                        <?php if (!empty($data['bahan_bakar_foto'])): ?>
                            <img 
                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['bahan_bakar_foto'])); ?>" 
                                alt="Foto Bahan Bakar" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['bahan_bakar_foto'])); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- cek_tekanan_ban -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Tekanan Ban</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_tekanan_ban']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('cek_tekanan_ban', this.value, <?php echo $data['id']; ?>)"
                        >
                            <option value="baik" <?php echo ($data['cek_tekanan_ban'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                            <option value="tidak_baik" <?php echo ($data['cek_tekanan_ban'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                        </select>
                        <?php if (!empty($data['tekanan_ban_foto'])): ?>
                            <img 
                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['tekanan_ban_foto'])); ?>" 
                                alt="Foto Tekanan Ban" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['tekanan_ban_foto'])); ?>')"
                            >
                        <?php endif; ?>
                    </div>
                </div>

                <!-- cek_rem -->
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                    <span class="font-medium text-gray-700">Rem</span>
                    <div class="flex items-center space-x-4">
                        <select 
                            class="px-3 py-1 rounded-full text-sm <?php echo strtolower($data['cek_rem']) === 'baik' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>"
                            onchange="updateStatus('cek_rem', this.value, <?php echo $data['id']; ?>)"
                        >
                            <option value="baik" <?php echo ($data['cek_rem'] === 'baik') ? 'selected' : ''; ?>>Baik</option>
                            <option value="tidak_baik" <?php echo ($data['cek_rem'] === 'tidak_baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                        </select>
                        <?php if (!empty($data['rem_foto'])): ?>
                            <img 
                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['rem_foto'])); ?>" 
                                alt="Foto Rem" 
                                class="w-10 h-10 rounded object-cover cursor-pointer"
                                onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['rem_foto'])); ?>')"
                            >
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