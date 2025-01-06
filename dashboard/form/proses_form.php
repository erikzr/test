<?php
session_start();

// Konfigurasi dasar
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkcar";

// Ganti header yang ada dengan:
header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit;
}

// Batasan jumlah file per request
define('MAX_FILES_PER_REQUEST', 60);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fungsi untuk mengkonversi HEIC ke JPG menggunakan FFmpeg
function convertHEICToJPG($source_path, $destination_path) {
    try {
        $command = "ffmpeg -i " . escapeshellarg($source_path) . " " . escapeshellarg($destination_path) . " -y 2>&1";
        exec($command, $output, $return_var);
        return $return_var === 0;
    } catch (Exception $e) {
        error_log("Error converting HEIC: " . $e->getMessage());
        return false;
    }
}

// Fungsi optimasi gambar yang baru
function optimizeImage($source_path, $destination_path) {
    $info = getimagesize($source_path);
    
    if (!$info) {
        return false;
    }

    // Dapatkan ukuran file asli
    $original_size = filesize($source_path);
    
    // Set maksimum dimensi gambar berdasarkan ukuran asli
    list($width, $height) = $info;
    
    // Hitung dimensi maksimum yang diizinkan
    $max_width = min(1920, $width);
    $max_height = min(1080, $height);
    
    // Hitung dimensi baru dengan mempertahankan aspect ratio
    $ratio = min($max_width/$width, $max_height/$height);
    $new_width = round($width * $ratio);
    $new_height = round($height * $ratio);
    
    // Buat gambar baru
    $new_image = imagecreatetruecolor($new_width, $new_height);
    
    // Load gambar sumber
    switch ($info['mime']) {
        case 'image/jpeg':
            $source_image = imagecreatefromjpeg($source_path);
            break;
        case 'image/png':
            $source_image = imagecreatefrompng($source_path);
            // Pertahankan transparansi untuk PNG
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
            break;
        default:
            return false;
    }
    
    // Aktifkan interpolasi yang lebih baik
    imagesetinterpolation($new_image, IMG_BICUBIC);
    
    // Resize gambar
    imagecopyresampled(
        $new_image, $source_image,
        0, 0, 0, 0,
        $new_width, $new_height,
        $width, $height
    );
    
    // Coba berbagai level kompresi
    $best_quality = 100;
    $min_quality = 60;
    $target_size = $original_size * 0.5;
    $temp_file = $destination_path . '.tmp';
    
    // Binary search untuk kualitas optimal
    $left = $min_quality;
    $right = $best_quality;
    
    while ($left <= $right) {
        $current_quality = floor(($left + $right) / 2);
        imagejpeg($new_image, $temp_file, $current_quality);
        $new_size = filesize($temp_file);
        
        if ($new_size > $target_size) {
            $right = $current_quality - 1;
        } else {
            $left = $current_quality + 1;
            copy($temp_file, $destination_path);
        }
    }
    
    // Gunakan kualitas minimum jika belum ada hasil
    if (!file_exists($destination_path)) {
        imagejpeg($new_image, $destination_path, $min_quality);
    }
    
    // Bersihkan
    if (file_exists($temp_file)) {
        unlink($temp_file);
    }
    imagedestroy($new_image);
    imagedestroy($source_image);
    
    // Verifikasi hasil
    if (filesize($destination_path) >= $original_size) {
        copy($source_path, $destination_path);
    }
    
    return true;
}

// Fungsi untuk memproses upload file
function processFileUpload($field, $target_dir) {
    if (isset($_FILES[$field]) && $_FILES[$field]["error"] == 0) {
        $file_extension = strtolower(pathinfo($_FILES[$field]["name"], PATHINFO_EXTENSION));
        $allowed_extensions = array("jpg", "jpeg", "png", "heic", "heif");
        
        if (in_array($file_extension, $allowed_extensions)) {
            $unique_filename = uniqid() . '.jpg';
            $target_path = $target_dir . $unique_filename;
            $temp_path = $_FILES[$field]["tmp_name"];
            
            // Handle HEIC/HEIF
            if ($file_extension == "heic" || $file_extension == "heif") {
                $temp_heic = $target_dir . 'temp_' . uniqid() . '.heic';
                move_uploaded_file($temp_path, $temp_heic);
                
                if (convertHEICToJPG($temp_heic, $target_path)) {
                    unlink($temp_heic);
                } else {
                    if (file_exists($temp_heic)) {
                        unlink($temp_heic);
                    }
                    error_log("Failed to convert HEIC file for field: " . $field);
                    return '';
                }
            } else {
                move_uploaded_file($temp_path, $target_path);
            }
            
            // Optimize gambar
            $temp_optimized = $target_dir . 'temp_' . $unique_filename;
            if (optimizeImage($target_path, $temp_optimized)) {
                unlink($target_path);
                rename($temp_optimized, $target_path);
                return $target_path;
            }
        }
    }
    return '';
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
            'ban_foto',
            'rem_foto'
        ]
    ];

    $data = [];
    $upload_errors = [];

    // Proses data teks
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($conn, $_POST[$field] ?? '');
    }

    // Buat direktori upload jika belum ada
    $target_dir = "../../form/uploads/";
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Proses upload file per grup
    foreach ($foto_fields as $grup => $fields) {
        foreach ($fields as $field) {
            $result = processFileUpload($field, $target_dir);
            if ($result) {
                $data[$field] = $result;
            } else {
                $data[$field] = '';
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