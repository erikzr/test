<?php
include 'config.php';

// Mendapatkan data dari form
$nama_petugas = $_POST['nama_petugas'];
$plat_mobil = $_POST['plat_mobil'];
$hari = $_POST['hari'];
$oli_mesin = $_POST['oli_mesin'];
$oli_power_stering = $_POST['oli_power_stering'];
$oli_transmisi = $_POST['oli_transmisi'];
$oli_rem = $_POST['oli_rem'];
$lampu_utama = $_POST['lampu_utama'];
$lampu_sen = $_POST['lampu_sen'];
$lampu_rem = $_POST['lampu_rem'];
$klakson = $_POST['klakson'];
$kondisi_accu = $_POST['kondisi_accu'];
$kebersihan_lantai = $_POST['kebersihan_lantai'];
$kebersihan_kursi = $_POST['kebersihan_kursi'];
$kebersihan_dinding = $_POST['kebersihan_dinding'];
$kebersihan_kap_mesin = $_POST['kebersihan_kap_mesin'];
$cek_stnk = $_POST['cek_stnk'];
$cek_apar = $_POST['cek_apar'];
$cek_p3k = $_POST['cek_p3k'];
$cek_kunci_roda = $_POST['cek_kunci_roda'];
$cek_air_radiator = $_POST['cek_air_radiator'];
$cek_bahan_bakar = $_POST['cek_bahan_bakar'];
$cek_tekanan_ban = $_POST['cek_tekanan_ban'];
$cek_rem = $_POST['cek_rem'];

// Fungsi untuk upload gambar
function uploadGambar($inputName) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES[$inputName]["name"]);
    move_uploaded_file($_FILES[$inputName]["tmp_name"], $target_file);
    return $target_file;
}

$foto_oli = uploadGambar('foto_oli');
$foto_penerangan = uploadGambar('foto_penerangan');
$foto_accu = uploadGambar('foto_accu');
$foto_kebersihan = uploadGambar('foto_kebersihan');
$foto_cek_lain = uploadGambar('foto_cek_lain');

// SQL untuk menyimpan data
$sql = "INSERT INTO kelayakan_mobil (
            nama_petugas, plat_mobil, hari, oli_mesin, oli_power_stering, oli_transmisi, oli_rem, foto_oli,
            lampu_utama, lampu_sen, lampu_rem, klakson, foto_penerangan,
            kondisi_accu, foto_accu, kebersihan_lantai, kebersihan_kursi, kebersihan_dinding, kebersihan_kap_mesin, foto_kebersihan,
            cek_stnk, cek_apar, cek_p3k, cek_kunci_roda, cek_air_radiator, cek_bahan_bakar, cek_tekanan_ban, cek_rem, foto_cek_lain
        ) VALUES (
            '$nama_petugas', '$plat_mobil', '$hari', '$oli_mesin', '$oli_power_stering', '$oli_transmisi', '$oli_rem', '$foto_oli',
            '$lampu_utama', '$lampu_sen', '$lampu_rem', '$klakson', '$foto_penerangan',
            '$kondisi_accu', '$foto_accu', '$kebersihan_lantai', '$kebersihan_kursi', '$kebersihan_dinding', '$kebersihan_kap_mesin', '$foto_kebersihan',
            '$cek_stnk', '$cek_apar', '$cek_p3k', '$cek_kunci_roda', '$cek_air_radiator', '$cek_bahan_bakar', '$cek_tekanan_ban', '$cek_rem', '$foto_cek_lain'
        )";

if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman terima kasih atau halaman lain setelah berhasil
    header("Location: checkup_oli.html");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
