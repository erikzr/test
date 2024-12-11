<?php
session_start();

// Konfigurasi dasar
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkcar";

// Batasan jumlah file per request
define('MAX_FILES_PER_REQUEST', 25);

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

    $foto_fields = [
        'grup1' => [
            'oli_mesin_foto', 
            'oli_power_steering_foto', 
            'oli_transmisi_foto', 
            'minyak_rem_foto'
        ],
        'grup2' => [
            'lampu_utama_foto', 
            'lampu_sein_foto', 
            'lampu_rem_foto', 
            'lampu_klakson_foto'
        ],
        'grup3' => [
            'aki_foto',
            'kursi_foto', 
            'lantai_foto', 
            'dinding_foto', 
            'kap_foto'
        ],
        'grup4' => [
            'stnk_foto', 
            'apar_foto', 
            'p3k_foto',
            'kunci_roda_foto'
        ],
        'grup5' => [
            'air_radiator_foto', 
            'bahan_bakar_foto', 
            'tekanan_ban_foto'        ]
    ];

    $data = [];
    $upload_errors = [];

    // Proses data teks
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($conn, $_POST[$field] ?? '');
    }

    // Proses upload file
    $target_dir = "../../form/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Fungsi untuk mengkonversi HEIC ke JPG menggunakan Imagick
    function convertHEICToJPG($source_path, $destination_path) {
        if (extension_loaded('imagick')) {
            try {
                $imagick = new Imagick($source_path);
                $imagick->setImageFormat('jpg');
                $imagick->writeImage($destination_path);
                $imagick->clear();
                $imagick->destroy();
                return true;
            } catch (Exception $e) {
                return false;
            }
        }
        return false;
    }

    // Fungsi untuk memproses upload file
    function processFileUpload($field, $target_dir) {
        if (isset($_FILES[$field]) && $_FILES[$field]["error"] == 0) {
            $file_extension = strtolower(pathinfo($_FILES[$field]["name"], PATHINFO_EXTENSION));
            $allowed_extensions = array("jpg", "jpeg", "png", "heic", "heif");
            
            if (in_array($file_extension, $allowed_extensions)) {
                $unique_filename = uniqid() . '_' . basename($_FILES[$field]["name"]);
                $target_path = $target_dir . $unique_filename;
                
                // Jika file adalah HEIC/HEIF, konversi ke JPG
                if ($file_extension == "heic" || $file_extension == "heif") {
                    $temp_path = $_FILES[$field]["tmp_name"];
                    $jpg_path = $target_dir . pathinfo($unique_filename, PATHINFO_FILENAME) . '.jpg';
                    
                    if (convertHEICToJPG($temp_path, $jpg_path)) {
                        return $jpg_path;
                    } else {
                        // Jika konversi gagal, coba simpan file asli
                        if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_path)) {
                            return $target_path;
                        }
                    }
                } else {
                    // Untuk format selain HEIC/HEIF
                    if (move_uploaded_file($_FILES[$field]["tmp_name"], $target_path)) {
                        return $target_path;
                    }
                }
                
                // Kompres gambar jika ukurannya terlalu besar
                if (filesize($target_path) > 1000000) { // 1MB
                    compressImage($target_path, $target_path, 75);
                }
            }
        }
        return '';
    }

    // Fungsi untuk mengkompresi gambar
    function compressImage($source, $destination, $quality) {
        $info = getimagesize($source);
        
        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        }
        
        if (isset($image)) {
            imagejpeg($image, $destination, $quality);
            imagedestroy($image);
            return true;
        }
        
        return false;
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
            header('Location: form-wizard asli.php');
            exit;
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        $_SESSION['error_messages'] = ['Error database: ' . $e->getMessage()];
        header('Location: form-wizard asli.php');
        exit;
    }
}

$conn->close();
?>