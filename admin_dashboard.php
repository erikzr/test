<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect if not an admin
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome Admin!</h1>
    <p>This is the admin dashboard.</p>
    <!-- Add admin functionalities here -->
    <a href="logout.php">Logout</a>
</body>
</html>
