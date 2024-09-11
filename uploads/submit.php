<?php
// Konfigurasi database
$servername = "localhost";
$username = "root"; // ganti dengan username database Anda
$password = ""; // ganti dengan password database Anda
$dbname = "monitoring";

// Membuat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mengambil data dari form
$nama_petugas = $_POST['nama_petugas'];
$plat_mobil = $_POST['plat_mobil'];
$tanggal = $_POST['tanggal'];
$oli_mesin = $_POST['oli_mesin'];
$oli_power_steering = $_POST['oli_power_steering'];
$oli_transmisi = $_POST['oli_transmisi'];
$minyak_rem = $_POST['minyak_rem'];
$kondisi_penerangan = $_POST['kondisi_penerangan'];
$lampu_utama = $_POST['lampu_utama'];
$lampu_sein = $_POST['lampu_sein'];
$lampu_rem = $_POST['lampu_rem'];
$lampu_klakson = $_POST['lampu_klakson'];
$accu = $_POST['accu'];
$kebersihan_kursi = $_POST['kebersihan_kursi'];
$kebersihan_lantai = $_POST['kebersihan_lantai'];
$kebersihan_dinding = $_POST['kebersihan_dinding'];
$kebersihan_kap_mesin = $_POST['kebersihan_kap_mesin'];
$stnk = $_POST['stnk'];
$apar = $_POST['apar'];
$kotak_p3k = $_POST['kotak_p3k'];
$kunci_roda = $_POST['kunci_roda'];
$air_radiator = $_POST['air_radiator'];
$bahan_bakar = $_POST['bahan_bakar'];
$tekanan_angin = $_POST['tekanan_angin'];
$kondisi_rem = $_POST['kondisi_rem'];

// Proses upload file
$target_dir = "uploads/";
$uploaded_files = [];

if (isset($_FILES['laporan'])) {
    $file_count = count($_FILES['laporan']['name']);
    for ($i = 0; $i < $file_count; $i++) {
        $target_file = $target_dir . basename($_FILES['laporan']['name'][$i]);
        if (move_uploaded_file($_FILES['laporan']['tmp_name'][$i], $target_file)) {
            $uploaded_files[] = $target_file;
        }
    }
}

// Menggabungkan URL file yang di-upload
$laporan = implode(", ", $uploaded_files);

// Menyimpan data ke database
$sql = "INSERT INTO laporan (nama_petugas, plat_mobil, tanggal, oli_mesin, oli_power_steering, oli_transmisi, minyak_rem, kondisi_penerangan, lampu_utama, lampu_sein, lampu_rem, lampu_klakson, accu, kebersihan_kursi, kebersihan_lantai, kebersihan_dinding, kebersihan_kap_mesin, stnk, apar, kotak_p3k, kunci_roda, air_radiator, bahan_bakar, tekanan_angin, kondisi_rem, laporan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssssssssssssssssssssss", $nama_petugas, $plat_mobil, $tanggal, $oli_mesin, $oli_power_steering, $oli_transmisi, $minyak_rem, $kondisi_penerangan, $lampu_utama, $lampu_sein, $lampu_rem, $lampu_klakson, $accu, $kebersihan_kursi, $kebersihan_lantai, $kebersihan_dinding, $kebersihan_kap_mesin, $stnk, $apar, $kotak_p3k, $kunci_roda, $air_radiator, $bahan_bakar, $tekanan_angin, $kondisi_rem, $laporan);

if ($stmt->execute()) {
    echo "Data berhasil dikirim.";
} else {
    echo "Terjadi kesalahan: " . $stmt->error;
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
