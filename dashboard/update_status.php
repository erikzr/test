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

// Function to log debug information with enhanced formatting
function debugLog($message, $type = 'INFO') {
    $logFile = 'debug.log';
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp][$type] $message\n";
    file_put_contents($logFile, $logMessage, FILE_APPEND);
}

// Function to send JSON response and exit
function sendResponse($success, $message, $data = null) {
    $response = [
        'success' => $success,
        'message' => $message
    ];
    
    if ($data !== null) {
        $response['data'] = $data;
    }
    
    echo json_encode($response);
    exit;
}

// Verify request method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    debugLog('Invalid request method: ' . $_SERVER['REQUEST_METHOD'], 'ERROR');
    sendResponse(false, 'Invalid request method. Only POST is allowed.');
}

// Get and sanitize POST data
$field = trim($_POST['field'] ?? '');
$status = trim($_POST['status'] ?? '');
$id = filter_var($_POST['id'] ?? '', FILTER_VALIDATE_INT);

debugLog("Received request - Field: $field, Status: $status, ID: $id");

// Validate required fields
if (empty($field) || empty($status) || $id === false) {
    debugLog("Missing or invalid required fields", 'ERROR');
    sendResponse(false, 'Missing or invalid required fields');
}

// Define allowed fields based on your table structure
$allowed_fields = [
    'oli_mesin',
    'oli_power_steering',
    'oli_transmisi',
    'minyak_rem',
    'lampu_utama',
    'lampu_sein',
    'lampu_rem',
    'lampu_klakson',
    'cek_aki',
    'cek_kursi',
    'cek_lantai',
    'cek_dinding',
    'cek_kap',
    'cek_stnk',
    'cek_apar',
    'cek_p3k',
    'cek_kunci_roda',
    'cek_air_radiator',
    'cek_bahan_bakar',
    'cek_tekanan_ban',
    'cek_rem'
];

// Validate field name
if (!in_array($field, $allowed_fields)) {
    debugLog("Invalid field name: $field", 'ERROR');
    sendResponse(false, 'Invalid field name');
}

// Validate status values (sesuai dengan nilai yang ada di database)
$allowed_statuses = ['baik', 'tidak_baik'];
if (!in_array(strtolower($status), $allowed_statuses)) {
    debugLog("Invalid status value: $status", 'ERROR');
    sendResponse(false, 'Invalid status value. Must be "baik" or "tidak_baik"');
}

try {
    // Begin transaction
    $conn->begin_transaction();

    // First, verify that the record exists
    $check_sql = "SELECT id FROM vehicle_inspection WHERE id = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $id);
    $check_stmt->execute();
    $result = $check_stmt->get_result();

    if ($result->num_rows === 0) {
        $conn->rollback();
        debugLog("Record not found with ID: $id", 'ERROR');
        sendResponse(false, 'Record not found');
    }

    // Prepare and execute the update query
    $sql = "UPDATE vehicle_inspection SET `$field` = ?, updated_at = NOW() WHERE id = ?";
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
        $conn->commit();
        debugLog("Update successful - Rows affected: " . $stmt->affected_rows, 'SUCCESS');
        sendResponse(true, 'Status updated successfully', [
            'field' => $field,
            'status' => $status,
            'id' => $id,
            'affected_rows' => $stmt->affected_rows,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    } else {
        $conn->rollback();
        debugLog("No changes made - New value same as old value", 'INFO');
        sendResponse(true, 'No changes needed - value already up to date');
    }
    
} catch (Exception $e) {
    if ($conn->inTransaction()) {
        $conn->rollback();
    }
    debugLog("Error: " . $e->getMessage(), 'ERROR');
    sendResponse(false, 'Database error: ' . $e->getMessage());
} finally {
    if (isset($check_stmt)) {
        $check_stmt->close();
    }
    if (isset($stmt)) {
        $stmt->close();
    }
    $conn->close();
}
?>