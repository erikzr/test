<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log semua request yang masuk
file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Request received\n", FILE_APPEND);
file_put_contents('debug.log', "POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);

header('Content-Type: application/json');

// Pastikan request adalah POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
    exit;
}

// Ambil data dari POST
$field = $_POST['field'] ?? '';
$status = $_POST['status'] ?? '';
$id = $_POST['id'] ?? '';

// Log data yang diterima
file_put_contents('debug.log', "Received data:\nField: $field\nStatus: $status\nID: $id\n\n", FILE_APPEND);

// Validasi input
if (empty($field) || empty($status) || empty($id)) {
    $error = "Data tidak lengkap. Field: $field, Status: $status, ID: $id";
    file_put_contents('debug.log', "Error: $error\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => $error]);
    exit;
}

session_start(); // Memulai sesi
include 'auth/koneksi.php';

// Validasi field name
$allowed_fields = [
    'oli_mesin', 'oli_power_steering', 'oli_transmisi', 'minyak_rem',
    'lampu_utama', 'lampu_sein', 'lampu_rem', 'lampu_klakson', 'cek_aki',
    'cek_kursi', 'cek_lantai', 'cek_dinding', 'cek_kap',
    'cek_stnk', 'cek_apar', 'cek_p3k', 'cek_kunci_roda', 'cek_air_radiator',
    'cek_bahan_bakar', 'cek_tekanan_ban', 'cek_rem'
];

if (!in_array($field, $allowed_fields)) {
    file_put_contents('debug.log', "Invalid field: $field\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => 'Field tidak valid']);
    exit;
}

// Update status di database
$sql = "UPDATE vehicle_inspection SET `$field` = ? WHERE id = ?";
file_put_contents('debug.log', "SQL Query: $sql\n", FILE_APPEND);

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $id);

if ($stmt->execute()) {
    file_put_contents('debug.log', "Update successful\n", FILE_APPEND);
    echo json_encode([
        'success' => true,
        'message' => 'Status berhasil diupdate',
        'data' => [
            'field' => $field,
            'status' => $status,
            'id' => $id
        ]
    ]);
} else {
    $error = "Update failed: " . $stmt->error;
    file_put_contents('debug.log', "$error\n", FILE_APPEND);
    echo json_encode([
        'success' => false,
        'message' => 'Gagal update database: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>