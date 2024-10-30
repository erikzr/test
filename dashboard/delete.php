<?php
// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log semua request yang masuk
file_put_contents('debug.log', date('Y-m-d H:i:s') . " - Delete request received\n", FILE_APPEND);

header('Content-Type: application/json');

// Pastikan request adalah POST atau DELETE
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && $_SERVER['REQUEST_METHOD'] !== 'DELETE') {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
    exit;
}

// Ambil ID dari request
$id = $_POST['id'] ?? $_GET['id'] ?? '';

// Log data yang diterima
file_put_contents('debug.log', "Received ID for deletion: $id\n", FILE_APPEND);

// Validasi input
if (empty($id)) {
    $error = "ID tidak ditemukan";
    file_put_contents('debug.log', "Error: $error\n", FILE_APPEND);
    echo json_encode(['success' => false, 'message' => $error]);
    exit;
}

session_start(); // Memulai sesi
include 'auth/koneksi.php';

// Delete data dari database
$sql = "DELETE FROM vehicle_inspection WHERE id = ?";
file_put_contents('debug.log', "SQL Query: $sql\n", FILE_APPEND);

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    file_put_contents('debug.log', "Delete successful\n", FILE_APPEND);
    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil dihapus',
        'data' => [
            'id' => $id
        ]
    ]);
} else {
    $error = "Delete failed: " . $stmt->error;
    file_put_contents('debug.log', "$error\n", FILE_APPEND);
    echo json_encode([
        'success' => false,
        'message' => 'Gagal menghapus data: ' . $stmt->error
    ]);
}

$stmt->close();
$conn->close();
?>