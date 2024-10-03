<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php"); // Redirect if not a user
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome User!</h1>
    <p>This is the user dashboard.</p>
    <!-- Add user functionalities here -->
    <a href="logout.php">Logout</a>
</body>
</html>
