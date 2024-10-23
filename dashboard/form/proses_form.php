<?php
session_start();

// Konfigurasi dasar
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkcar";

// Batasan jumlah file per request
define('MAX_FILES_PER_REQUEST', 20);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        'nama', 'plat_mobil', 'oli_mesin', 'oli_power_steering', 'oli_transmisi', 'minyak_rem',
        'lampu_utama', 'lampu_sein', 'lampu_rem', 'lampu_klakson', 'cek_aki',
        'cek_kursi', 'cek_lantai', 'cek_dinding', 'cek_kap',
        'cek_stnk', 'cek_apar', 'cek_p3k', 'cek_kunci_roda', 'cek_air_radiator',
        'cek_bahan_bakar', 'cek_tekanan_ban', 'cek_rem'
    ];

    // Pisahkan field foto menjadi beberapa bagian
    $foto_fields = [
        // Bagian 1: Oli dan Cairan
        'grup1' => [
            'oli_mesin_foto', 
            'oli_power_steering_foto', 
            'oli_transmisi_foto', 
            'minyak_rem_foto'
        ],
        // Bagian 2: Lampu
        'grup2' => [
            'lampu_utama_foto', 
            'lampu_sein_foto', 
            'lampu_rem_foto', 
            'lampu_klakson_foto'
        ],
        // Bagian 3: Interior
        'grup3' => [
            'aki_foto',
            'kursi_foto', 
            'lantai_foto', 
            'dinding_foto', 
            'kap_foto'
        ],
        // Bagian 4: Dokumen dan Perlengkapan
        'grup4' => [
            'stnk_foto', 
            'apar_foto', 
            'p3k_foto',
            'kunci_roda_foto'
        ],
        // Bagian 5: Sistem dan Mekanis
        'grup5' => [
            'air_radiator_foto', 
            'bahan_bakar_foto', 
            'tekanan_ban_foto'
        ]
    ];

    $data = [];
    $upload_errors = [];

    // Proses data teks
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($conn, $_POST[$field] ?? '');
    }

    // Proses upload file per grup
    $target_dir = "../../form/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Fungsi untuk memproses upload file
    function processFileUpload($field, $target_dir) {
        if (isset($_FILES[$field]) && $_FILES[$field]["error"] == 0) {
            $file_extension = strtolower(pathinfo($_FILES[$field]["name"], PATHINFO_EXTENSION));
            $allowed_extensions = array("jpg", "jpeg", "png");
            
            if (in_array($file_extension, $allowed_extensions)) {
                $foto_name = $target_dir . uniqid() . '_' . basename($_FILES[$field]["name"]);
                
                if (move_uploaded_file($_FILES[$field]["tmp_name"], $foto_name)) {
                    return $foto_name;
                }
            }
        }
        return '';
    }

    // Proses upload file per grup
    foreach ($foto_fields as $grup => $fields) {
        foreach ($fields as $field) {
            $result = processFileUpload($field, $target_dir);
            if ($result) {
                $data[$field] = $result;
            } else {
                $data[$field] = ''; // Set empty jika gagal upload
            }
        }
    }

    // Proses penyimpanan ke database
    try {
        $columns = implode(", ", array_keys($data));
        $values = "'" . implode("', '", $data) . "'";
        $sql = "INSERT INTO vehicle_inspection ($columns) VALUES ($values)";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['success_message'] = "Data berhasil disimpan";
            header('Location: form-wizard asli.php'); // Ganti dengan path ke halaman beranda Anda
            exit;
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        $_SESSION['error_messages'] = ['Error database: ' . $e->getMessage()];
        header('Location: form-wizard asli.php'); // Ganti dengan path ke halaman form Anda
        exit;
    }
}

$conn->close();
?>