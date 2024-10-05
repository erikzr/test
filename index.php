<?php
session_start(); // Start the session

// Initialize alert message variable
$alertMessage = '';
$alertType = '';

$servername = "localhost";
$db_username = "root"; // Your database username
$db_password = ""; // Your database password
$dbname = "checkcar";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password, role, name FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password, $role, $full_name);
        $stmt->fetch();
        
        // Verify password (no hashing for demonstration)
        if ($password === $hashed_password) {
            // Password is correct, set session variables based on role
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role; // Store the user's role
            $_SESSION['full_name'] = $full_name; // Store user's full name in session
            
            // Success message
            $alertMessage = "Login successful! Redirecting...";
            $alertType = "success";

            // Redirect after a short delay
            echo "<script>setTimeout(function() { window.location.href = '" . ($role === 'admin' ? "dashboard/index.html" : "dashboard/form/form-wizard asli.php") . "'; }, 2000);</script>";
        } else {
            $alertMessage = "Invalid username or password.";
            $alertType = "danger";
        }
    } else {
        $alertMessage = "Invalid username or password.";
        $alertType = "danger";
    }
    $stmt->close();
}

$conn->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMN-Operasional</title>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="stylesheet" href="assets/css/core/libs.min.css">
    <link rel="stylesheet" href="assets/css/hope-ui.min.css?v=5.0.0">
    <link rel="stylesheet" href="assets/css/custom.min.css?v=5.0.0">
    <link rel="stylesheet" href="assets/css/customizer.min.css?v=5.0.0">
    <link rel="stylesheet" href="assets/css/rtl.min.css?v=5.0.0">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white; /* Change this to your desired background color */
        }

        .wrapper {
            width: 100%; /* Ensure the wrapper uses the full width */
            max-width: 500px; /* Set a max width for the form */
            padding: 20px; /* Add some padding */
            box-shadow: 0 2px 10px rgba(0,0,0,0.1); /* Optional shadow for the card */
            border-radius: 10px; /* Optional rounding for aesthetics */
        }

        .alert {
            margin-bottom: 20px; /* Space between alert and form */
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="login-content">
            <div class="d-flex justify-content-center align-items-center">
                <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                    <div class="card-body z-3 px-md-0 px-lg-4">
                        <a href="index.html" class="navbar-brand d-flex justify-content-center mb-3">
                            <img src="kominfo.png" alt="Logo Kominfo" style="width: 50px; height: auto;">
                        </a>
                        <h2 class="mb-2 text-center">Sign In</h2>
                        <p class="text-center">Masuk untuk melanjutkan.</p>
                        
                        <!-- Alert Message -->
                        <?php if ($alertMessage): ?>
                            <div class="alert alert-<?php echo $alertType; ?>" role="alert">
                                <?php echo $alertMessage; ?>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST" action="">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" id="username" placeholder=" " required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder=" " required>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="assets/js/core/libs.min.js"></script>
    <script src="assets/js/core/external.min.js"></script>
    <script src="assets/js/charts/widgetcharts.js"></script>
    <script src="assets/js/charts/vectore-chart.js"></script>
    <script src="assets/js/charts/dashboard.js"></script>
    <script src="assets/js/plugins/fslightbox.js"></script>
    <script src="assets/js/plugins/setting.js"></script>
    <script src="assets/js/plugins/slider-tabs.js"></script>
    <script src="assets/js/plugins/form-wizard.js"></script>
    <script src="assets/js/hope-ui.js" defer></script>
</body>
</html>
