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

// tampilan button gambar

// tampilan button gambar

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="bg-gray-50">
<!-- Komponen Pemeriksaan -->
<div class="max-w-5xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <div class="p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Detail Komponen Pemeriksaan</h2>
            
            <!-- Section: Cairan -->
<!-- Bagian Cairan -->
<div class="mb-6">
    <div class="border rounded-lg overflow-hidden bg-white">
        <button class="w-full px-6 py-4 flex items-center justify-between bg-gray-50 hover:bg-gray-100/80 transition-all duration-200" 
                onclick="toggleSection('collapseCairan')" 
                type="button">
            <div class="flex items-center gap-3">
                <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                    🛢️
                </span>
                <span class="font-semibold text-gray-900">Cairan</span>
            </div>
            <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200" id="iconCairan"></i>
        </button>

        <div id="collapseCairan" class="block border-t">
            <div class="p-4 space-y-3">
                <?php
                $components = [
                    'oli_mesin' => 'Oli Mesin',
                    'oli_power_steering' => 'Oli Power Steering',
                    'oli_transmisi' => 'Oli Transmisi',
                    'minyak_rem' => 'Minyak Rem'
                ];

                foreach ($components as $key => $label): ?>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                        <div class="flex items-center gap-3">
                            <span class="font-medium text-gray-900"><?php echo $label; ?></span>
                            <?php if ($data[$key] === 'Tidak Baik'): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                    Perlu Perhatian
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <select 
                                class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                <?php echo ($data[$key] === 'Baik') 
                                    ? 'bg-emerald-50 text-emerald-700' 
                                    : 'bg-red-50 text-red-700'; ?>"
                                onchange="updateStatus('<?php echo $key; ?>', this.value, <?php echo $data['id']; ?>)"
                            >
                                <option value="Baik" <?php echo ($data[$key] === 'Baik') ? 'selected' : ''; ?>>
                                    Baik
                                </option>
                                <option value="Tidak Baik" <?php echo ($data[$key] === 'Tidak Baik') ? 'selected' : ''; ?>>
                                    Tidak Baik
                                </option>
                            </select>
                            
                            <?php if (!empty($data[$key.'_foto'])): ?>
                                <button 
                                    onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data[$key.'_foto'])); ?>')"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                >
                                    <img 
                                        src="../form/uploads/<?php echo basename(htmlspecialchars($data[$key.'_foto'])); ?>" 
                                        alt="Foto <?php echo $label; ?>" 
                                        class="w-6 h-6 rounded object-cover"
                                    >
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi -->
<div id="confirmModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl max-w-sm w-full mx-4">
        <!-- Header -->
        <div class="px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-900">localhost menyatakan</h2>
        </div>
        
        <!-- Body -->
        <div class="px-6 py-4">
            <p class="text-gray-700" id="confirmMessage">Apakah anda yakin ingin mengubah status?</p>
        </div>
        
        <!-- Footer -->
        <div class="px-6 py-4 border-t bg-gray-50 flex justify-end gap-3 rounded-b-lg">
            <button id="confirmCancel" class="px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 rounded-lg transition-colors">
                Batal
            </button>
            <button id="confirmOk" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">
                Oke
            </button>
        </div>
    </div>
</div>
            <!-- Section: Lampu -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden bg-white">
                    <button class="w-full px-6 py-4 flex items-center justify-between bg-gray-50 hover:bg-gray-100/80 transition-all duration-200" 
                            onclick="toggleSection('collapseLampu')" 
                            type="button">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-yellow-50 text-yellow-600">
                                💡
                            </span>
                            <span class="font-semibold text-gray-900">Lampu</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200" id="iconLampu"></i>
                    </button>

                    <div id="collapseLampu" class="block border-t">
                        <div class="p-4 space-y-3">
                            <?php
                            $lampuComponents = [
                                'lampu_utama' => 'Lampu Utama',
                                'lampu_sein' => 'Lampu Sein',
                                'lampu_rem' => 'Lampu Rem',
                                'lampu_klakson' => 'Lampu Klakson'
                            ];

                            foreach ($lampuComponents as $key => $label): ?>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="font-medium text-gray-900"><?php echo $label; ?></span>
                                        <?php if ($data[$key] === 'Tidak Baik'): ?>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                                Perlu Perhatian
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="flex items-center gap-4">
                                        <select 
                                            class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                            <?php echo ($data[$key] === 'Baik') 
                                                ? 'bg-emerald-50 text-emerald-700' 
                                                : 'bg-red-50 text-red-700'; ?>"
                                            onchange="updateStatus('<?php echo $key; ?>', this.value, <?php echo $data['id']; ?>)"
                                        >
                                            <option value="Baik" <?php echo ($data[$key] === 'Baik') ? 'selected' : ''; ?>>
                                                Baik
                                            </option>
                                            <option value="Tidak Baik" <?php echo ($data[$key] === 'Tidak Baik') ? 'selected' : ''; ?>>
                                                Tidak Baik
                                            </option>
                                        </select>
                                        
                                        <?php if (!empty($data[$key.'_foto'])): ?>
                                            <button 
                                                onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data[$key.'_foto'])); ?>')"
                                                class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                            >
                                                <img 
                                                    src="../form/uploads/<?php echo basename(htmlspecialchars($data[$key.'_foto'])); ?>" 
                                                    alt="Foto <?php echo $label; ?>" 
                                                    class="w-6 h-6 rounded object-cover"
                                                >
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Interior -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden bg-white">
                    <button class="w-full px-6 py-4 flex items-center justify-between bg-gray-50 hover:bg-gray-100/80 transition-all duration-200" 
                            onclick="toggleSection('collapseInter')" 
                            type="button">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                                🚘
                            </span>
                            <span class="font-semibold text-gray-900">Interior</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200" id="iconInter"></i>
                    </button>

                    <div id="collapseInter" class="block border-t">
                        <div class="p-4 space-y-3">
                            <?php
                            $interiorComponents = [
                                'cek_aki' => ['label' => 'Cek Aki', 'foto' => 'aki_foto'],
                                'cek_kursi' => ['label' => 'Cek Kursi', 'foto' => 'kursi_foto'], 
                                'cek_lantai' => ['label' => 'Cek Lantai', 'foto' => 'lantai_foto'],
                                'cek_dinding' => ['label' => 'Cek Dinding', 'foto' => 'dinding_foto'],
                                'cek_kap' => ['label' => 'Cek Kap', 'foto' => 'kap_foto']
                            ];

                            foreach ($interiorComponents as $key => $details): ?>
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="font-medium text-gray-900"><?php echo $details['label']; ?></span>
                                        <?php if ($data[$key] === 'Tidak Baik'): ?>
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                                Perlu Perhatian
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="flex items-center gap-4">
                                        <select 
                                            class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                            <?php echo ($data[$key] === 'Baik') 
                                                ? 'bg-emerald-50 text-emerald-700' 
                                                : 'bg-red-50 text-red-700'; ?>"
                                            onchange="updateStatus('<?php echo $key; ?>', this.value, <?php echo $data['id']; ?>)"
                                        >
                                            <option value="Baik" <?php echo ($data[$key] === 'Baik') ? 'selected' : ''; ?>>
                                                Baik
                                            </option>
                                            <option value="Tidak Baik" <?php echo ($data[$key] === 'Tidak Baik') ? 'selected' : ''; ?>>
                                                Tidak Baik
                                            </option>
                                        </select>
                                        
                                        <?php if (!empty($data[$details['foto']])): ?>
                                            <button 
                                                onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data[$details['foto']])); ?>')"
                                                class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                            >
                                                <img 
                                                    src="../form/uploads/<?php echo basename(htmlspecialchars($data[$details['foto']])); ?>" 
                                                    alt="Foto <?php echo $details['label']; ?>" 
                                                    class="w-6 h-6 rounded object-cover"
                                                >
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dokumen dan Perlengkapan -->
            <div class="mb-6">
                <div class="border rounded-lg overflow-hidden bg-white">
                    <button class="w-full px-6 py-4 flex items-center justify-between bg-gray-50 hover:bg-gray-100/80 transition-all duration-200" 
                            onclick="toggleSection('collapseDoc')" 
                            type="button">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                                📄
                            </span>
                            <span class="font-semibold text-gray-900">Dokumen dan Perlengkapan</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200" id="iconDoc"></i>
                    </button>
                    
                    <div id="collapseDoc" class="block border-t">
                        <div class="p-4 space-y-3">
                            <!-- cek_stnk -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">STNK</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_stnk']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_stnk', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_stnk'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_stnk'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['stnk_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['stnk_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['stnk_foto'])); ?>" 
                                                alt="Foto STNK" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- cek_apar -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">APAR</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_apar']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_apar', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_apar'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_apar'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['apar_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['apar_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['apar_foto'])); ?>" 
                                                alt="Foto APAR" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_p3k -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">P3K</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_p3k']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_p3k', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_p3k'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_p3k'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['p3k_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['p3k_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['p3k_foto'])); ?>" 
                                                alt="Foto P3K" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_kunci_roda -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">Kunci Roda</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_kunci_roda']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_kunci_roda', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_kunci_roda'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_kunci_roda'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['kunci_roda_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['kunci_roda_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['kunci_roda_foto'])); ?>" 
                                                alt="Foto Kunci Roda" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
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
                <div class="border rounded-lg overflow-hidden bg-white">
                    <button class="w-full px-6 py-4 flex items-center justify-between bg-gray-50 hover:bg-gray-100/80 transition-all duration-200" 
                            onclick="toggleSection('collapseSistem')" 
                            type="button">
                        <div class="flex items-center gap-3">
                            <span class="flex items-center justify-center w-10 h-10 rounded-lg bg-blue-50 text-blue-600">
                                ⚙️
                            </span>
                            <span class="font-semibold text-gray-900">Sistem dan Mekanis</span>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 transition-transform duration-200" id="iconSistem"></i>
                    </button>
                    
                    <div id="collapseSistem" class="block border-t">
                        <div class="p-4 space-y-3">
                            
                            <!-- cek_air_radiator -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">Air Radiator</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_air_radiator']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_air_radiator', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_air_radiator'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_air_radiator'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['air_radiator_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['air_radiator_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['air_radiator_foto'])); ?>" 
                                                alt="Foto Air Radiator" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_bahan_bakar -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">Bahan Bakar</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_bahan_bakar']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_bahan_bakar', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_bahan_bakar'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_bahan_bakar'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['bahan_bakar_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['bahan_bakar_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['bahan_bakar_foto'])); ?>" 
                                                alt="Foto Bahan Bakar" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_tekanan_ban -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">Tekanan Ban</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_tekanan_ban']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_tekanan_ban', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_tekanan_ban'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_tekanan_ban'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['ban_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['ban_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['ban_foto'])); ?>" 
                                                alt="Foto Tekanan Ban" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- cek_rem -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100/50 transition-colors">
                                <span class="font-medium text-gray-900">Rem</span>
                                <div class="flex items-center gap-4">
                                    <select 
                                        class="px-4 py-2 rounded-lg text-sm border-0 focus:ring-2 focus:ring-blue-500 cursor-pointer
                                        <?php echo($data['cek_rem']) === 'Baik' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700'; ?>"
                                        onchange="updateStatus('cek_rem', this.value, <?php echo $data['id']; ?>)"
                                    >
                                        <option value="Baik" <?php echo ($data['cek_rem'] === 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Tidak Baik" <?php echo ($data['cek_rem'] === 'Tidak Baik') ? 'selected' : ''; ?>>Tidak Baik</option>
                                    </select>
                                    <?php if (!empty($data['rem_foto'])): ?>
                                        <button 
                                            onclick="viewImage('../form/uploads/<?php echo basename(htmlspecialchars($data['rem_foto'])); ?>')"
                                            class="flex items-center justify-center w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-colors"
                                        >
                                            <img 
                                                src="../form/uploads/<?php echo basename(htmlspecialchars($data['rem_foto'])); ?>" 
                                                alt="Foto Rem" 
                                                class="w-6 h-6 rounded object-cover"
                                            >
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


    <style>
.animate-fade-in {
    animation: fadeIn 0.3s ease-in-out;
}

.animate-fade-out {
    animation: fadeOut 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(20px); }
}

@keyframes progress-bar {
    from { transform: scaleX(0); }
    to { transform: scaleX(1); }
}
</style>

<script>
function updateStatus(field, newStatus, id) {
    const selectElement = event.target;
    const originalValue = selectElement.value;
    
    Swal.fire({
        title: 'Konfirmasi Perubahan',
        text: 'Apakah anda yakin ingin mengubah status?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Ubah!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
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
                    if (data.success) {
                        if (newStatus === 'Baik') {
                            selectElement.className = selectElement.className.replace('bg-red-50 text-red-700', 'bg-emerald-50 text-emerald-700');
                        } else {
                            selectElement.className = selectElement.className.replace('bg-emerald-50 text-emerald-700', 'bg-red-50 text-red-700');
                        }
                        
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Status berhasil diperbarui',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        selectElement.value = originalValue;
                        Swal.fire({
                            title: 'Error!',
                            text: 'Gagal memperbarui status: ' + (data.message || 'Unknown error'),
                            icon: 'error'
                        });
                    }
                } catch (e) {
                    console.error('JSON parse error:', e);
                    selectElement.value = originalValue;
                    Swal.fire({
                        title: 'Error!',
                        text: 'Error parsing response: ' + rawText,
                        icon: 'error'
                    });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                selectElement.value = originalValue;
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat memperbarui status: ' + error.message,
                    icon: 'error'
                });
            });
        } else {
            selectElement.value = originalValue;
        }
    });
}

function toggleSection(sectionId) {
    const section = document.getElementById(sectionId);
    const isHidden = section.classList.contains('hidden');
    
    document.querySelectorAll('[id^="collapse"]').forEach(el => {
        if (el.id !== sectionId) {
            el.classList.add('hidden');
            const iconId = 'icon' + el.id.replace('collapse', '');
            const icon = document.getElementById(iconId);
            if (icon) icon.style.transform = 'rotate(0deg)';
        }
    });
    
    if (isHidden) {
        section.classList.remove('hidden');
        document.getElementById('icon' + sectionId.replace('collapse', '')).style.transform = 'rotate(180deg)';
    } else {
        section.classList.add('hidden');
        document.getElementById('icon' + sectionId.replace('collapse', '')).style.transform = 'rotate(0deg)';
    }
}

function viewImage(imagePath) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    modalImage.src = imagePath;
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function showNotification(message, type = 'success') {
    const existingNotifications = document.querySelectorAll('.notification-toast');
    existingNotifications.forEach(notification => {
        notification.remove();
    });

    const notification = document.createElement('div');
    notification.className = `notification-toast fixed bottom-4 right-4 max-w-md w-full md:w-auto overflow-hidden rounded-lg shadow-lg z-50 animate-fade-in`;
    
    const innerContainer = document.createElement('div');
    innerContainer.className = `flex items-center p-4 ${
        type === 'success' ? 'bg-emerald-50' : 'bg-red-50'
    }`;
    
    const icon = document.createElement('div');
    icon.className = `flex-shrink-0 w-5 h-5 ${
        type === 'success' ? 'text-emerald-400' : 'text-red-400'
    }`;
    icon.innerHTML = type === 'success' 
        ? '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>'
        : '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>';

    const messageDiv = document.createElement('div');
    messageDiv.className = `ml-3 text-sm font-medium ${
        type === 'success' ? 'text-emerald-800' : 'text-red-800'
    }`;
    messageDiv.textContent = message;

    const closeButton = document.createElement('button');
    closeButton.className = `ml-4 flex-shrink-0 inline-flex text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 ${
        type === 'success' ? 'focus:ring-emerald-500' : 'focus:ring-red-500'
    }`;
    closeButton.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>';
    
    const progressBar = document.createElement('div');
    progressBar.className = `absolute bottom-0 left-0 h-1 transform scale-x-0 ${
        type === 'success' ? 'bg-emerald-500' : 'bg-red-500'
    }`;
    progressBar.style.width = '100%';
    progressBar.style.transformOrigin = 'left';
    
    innerContainer.appendChild(icon);
    innerContainer.appendChild(messageDiv);
    innerContainer.appendChild(closeButton);
    notification.appendChild(innerContainer);
    notification.appendChild(progressBar);
    
    document.body.appendChild(notification);

    progressBar.style.animation = 'progress-bar 3s linear forwards';

    closeButton.addEventListener('click', () => {
        notification.classList.add('animate-fade-out');
        setTimeout(() => notification.remove(), 300);
    });

    setTimeout(() => {
        if (document.body.contains(notification)) {
            notification.classList.add('animate-fade-out');
            setTimeout(() => notification.remove(), 300);
        }
    }, 3000);
}

document.getElementById('imageModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeModal();
    }
});

document.addEventListener('keydown', function(e) {
    if (e.key === 'ArrowLeft') {
        // Previous image logic
    } else if (e.key === 'ArrowRight') {
        // Next image logic
    }
});
</script>
<!-- tampilan gambar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true,
        'fadeDuration': 200,
        'imageFadeDuration': 200,
        'disableScrolling': true,
        'showImageNumberLabel': false,
        'albumLabel': "Foto %1 dari %2"
    });
</script>
<!-- tampilan gambar -->

</body>
</html>