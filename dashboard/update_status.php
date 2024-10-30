<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for JSON response
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require_once 'auth/koneksi.php';

// Function to log debug information
function debugLog($message) {
    $logFile = 'debug.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Verify request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method. Only POST is allowed.'
    ]);
    exit;
}

// Get and validate POST data
$field = $_POST['field'] ?? '';
$status = $_POST['status'] ?? '';
$id = $_POST['id'] ?? '';

debugLog("Received request - Field: $field, Status: $status, ID: $id");

// Validate required fields
if (empty($field) || empty($status) || empty($id)) {
    debugLog("Missing required fields");
    echo json_encode([
        'success' => false,
        'message' => 'Missing required fields'
    ]);
    exit;
}

// Validate field name against allowed fields
$allowed_fields = [
    'oli_mesin', 'oli_power_steering', 'oli_transmisi', 'minyak_rem',
    'lampu_utama', 'lampu_sein', 'lampu_rem', 'lampu_klakson', 'cek_aki',
    'cek_kursi', 'cek_lantai', 'cek_dinding', 'cek_kap',
    'cek_stnk', 'cek_apar', 'cek_p3k', 'cek_kunci_roda', 'cek_air_radiator',
    'cek_bahan_bakar', 'cek_tekanan_ban', 'cek_rem'
];

if (!in_array($field, $allowed_fields)) {
    debugLog("Invalid field name: $field");
    echo json_encode([
        'success' => false,
        'message' => 'Invalid field name'
    ]);
    exit;
}

// Validate status values
$allowed_statuses = ['Baik', 'Kurang Baik'];
if (!in_array($status, $allowed_statuses)) {
    debugLog("Invalid status value: $status");
    echo json_encode([
        'success' => false,
        'message' => 'Invalid status value'
    ]);
    exit;
}

try {
    // Prepare and execute the update query
    $sql = "UPDATE vehicle_inspection SET `$field` = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("si", $status, $id);
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    // Check if any rows were affected
    if ($stmt->affected_rows > 0) {
        debugLog("Update successful - Rows affected: " . $stmt->affected_rows);
        echo json_encode([
            'success' => true,
            'message' => 'Status updated successfully',
            'data' => [
                'field' => $field,
                'status' => $status,
                'id' => $id,
                'affected_rows' => $stmt->affected_rows
            ]
        ]);
    } else {
        debugLog("No rows updated - ID might not exist");
        echo json_encode([
            'success' => false,
            'message' => 'No records were updated. The ID might not exist.'
        ]);
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    debugLog("Error: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => 'Database error: ' . $e->getMessage()
    ]);
} finally {
    $conn->close();
}
?>