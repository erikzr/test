<?php
// Koneksi ke database (gunakan ulang atau masukkan kode koneksi ini di awal file)
$servername = "localhost";
$username = "root";
$password = "";
$database = "checkcar";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Query untuk menambahkan data ke database
    $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "User baru berhasil ditambahkan!";
        // Refresh halaman untuk melihat perubahan
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Cek apakah ada permintaan untuk menghapus user
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Query untuk menghapus user berdasarkan ID
    $delete_sql = "DELETE FROM users WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "User berhasil dihapus!";
        echo "<meta http-equiv='refresh' content='0'>";
    } else {
        echo "Error saat menghapus user: " . $conn->error;
    }
}

// Query untuk mengambil data dari tabel users
$sql = "SELECT id, name, username, password, role FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id" dir="ltr" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard Pemeriksaan Kendaraan</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" rel="stylesheet">
    
    
    <!-- SweetAlert for notifications -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.32/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="../assets/css/hope-ui.min.css">
    <link rel="stylesheet" href="../assets/css/custom.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    
    <style>
        /* Mengatur container utama */
    .container-fluid {
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Mengatur tabel responsive */
    .table-responsive {
        margin: 0;
        padding: 0;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    /* Mengatur lebar minimum tabel */
    #inspectionTable {
        margin-bottom: 0;
    }

    /* Mengatur cell pada tabel */
    #inspectionTable th,
    #inspectionTable td {
        white-space: nowrap;
        vertical-align: middle;
    }

    /* Mengatur modal dialog */
    .modal-dialog.modal-lg {
        max-width: 90%;
        margin: 1.75rem auto;
    }

    /* Mengatur pagination agar tetap di posisinya */
    .dataTables_wrapper .dataTables_paginate {
        position: sticky;
        bottom: 0;
        background: white;
        padding: 10px 0;
        border-top: 1px solid #dee2e6;
        margin-top: 10px;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .modal-dialog.modal-lg {
            max-width: 95%;
        }
        
        .btn-group {
            display: flex;
            flex-direction: row;
            gap: 2px;
        }
    }

    /* Mengatur ukuran tombol pada tabel */
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
        const style = document.createElement('style');
        style.textContent = `
            .card {
                border-radius: 15px;
                border: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
                transition: all 0.3s ease;
            }
            
            .card-header {
                background-color: transparent;
                border-bottom: 1px solid rgba(0,0,0,0.05);
                padding: 1.5rem;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .component-chart {
                position: relative;
                margin: auto;
                height: 250px;
                width: 100%;
            }
            
            .badge {
                padding: 0.5em 1em;
                font-weight: 500;
                border-radius: 30px;
            }
            
            .list-unstyled li {
                margin-bottom: 0.5rem;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .text-muted {
                color: #6c757d !important;
            }
        `;
        document.head.appendChild(style);
        .status-aman { color: #28a745; }
        .status-perhatian { color: #dc3545; }
        .card-stats { transition: transform .2s; }
        .card-stats:hover { transform: scale(1.05); }
        .table-responsive { max-height: 500px; overflow-y: auto; }
        .component-chart { height: 200px; margin-bottom: 20px; }
/* CSS untuk sidebar */
.sidebar {
    width: 250px;
    height: 100vh;
    position: fixed;
    transition: all 0.3s ease;
}

.sidebar.collapsed {
    width: 60px;
}

.sidebar.collapsed .logo-title,
.sidebar.collapsed .item-name {
    display: none;
}

.sidebar-header {
    padding: 15px;
}

.sidebar-body {
    height: calc(100vh - 70px);
}

.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
}

/* Responsive */
@media (max-width: 991px) {
    .sidebar {
        width: 60px;
    }
    
    .sidebar .logo-title,
    .sidebar .item-name {
        display: none;
    }
    
    .sidebar:hover {
        width: 250px;
    }
    
    .sidebar:hover .logo-title,
    .sidebar:hover .item-name {
        display: inline;
    }
}

.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

/* Style saat sidebar collapse */
.sidebar.collapsed .logout-btn span {
    display: none;
}

.sidebar.collapsed .logout-btn {
    width: 40px;
    left: 50%;
    transform: translateX(-50%);
}

/* Hover effect */
.logout-btn:hover {
    opacity: 0.9;
}

/* Responsive styling */
@media (max-width: 991px) {
    .sidebar .logout-btn span {
        display: none;
    }
    
    .sidebar .logout-btn {
        width: 40px;
        left: 50%;
        transform: translateX(-50%);
    }
    
    .sidebar:hover .logout-btn {
        width: calc(100% - 30px);
        left: 15px;
        transform: none;
    }
    
    .sidebar:hover .logout-btn span {
        display: inline;
    }
}

            /* komponen lihat detail */
        .img-fluid.zoomed {
            transform: scale(1.5);
            transition: transform 0.3s ease;
            cursor: zoom-out;
        }

        .img-fluid {
            transition: transform 0.3s ease;
            cursor: zoom-in;
        }

        .modal-body {
            overflow: auto;
            max-height: 80vh;
        }

        .img-zoom {
            transform: scale(1.5);
            transition: transform 0.3s ease;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .accordion-button:not(.collapsed) {
            background-color: #e7f1ff;
            color: #0c63e4;
        }

        .badge {
            font-size: 0.875rem;
        }
            /* sampai sini komponen lihat detail */

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }
            
            .btn-group {
                display: flex;
                flex-direction: column;
            }
            
            .btn-group .btn {
                margin: 2px 0;
            }
        }

        /* Custom styling untuk SweetAlert */
.custom-swal-popup {
    border-radius: 15px !important;
    padding: 20px !important;
}

.custom-swal-title {
    font-size: 24px !important;
    color: #333 !important;
}

.custom-swal-confirm-button {
    padding: 12px 30px !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    letter-spacing: 0.5px !important;
}

.custom-swal-cancel-button {
    padding: 12px 30px !important;
    border-radius: 8px !important;
    font-weight: 500 !important;
    letter-spacing: 0.5px !important;
}

/* Animasi loading custom */
.swal2-loading {
    border-radius: 50% !important;
}

/* Dark mode support */
@media (prefers-color-scheme: dark) {
    .custom-swal-popup {
        background: #1a1a1a !important;
    }
    
    .custom-swal-title {
        color: #fff !important;
    }
    
    .swal2-html-container {
        color: #ddd !important;
    }
}

.icon-30 {
    height: 1.875rem;
    width: 1.875rem;
    margin-left: -15px; /* Sesuaikan nilai ini */
}

.logout-btn {
    position: absolute;
    bottom: 20px;
    left: 15px;
    width: calc(100% - 30px);
    padding: 4px 2px; /* 4px untuk vertikal, 20px untuk horizontal */
    border: none;
    border-radius: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.nav-link.active {
    background-color: blue; /* Ubah warna sesuai kebutuhan */
    color: white; /* Ubah warna teks sesuai kebutuhan */
}

/* Tambahkan kelas ini agar tidak ada efek hover */
.no-hover-effect {
    background-color: #007bff;
    color: white;
    border: none;
}

.no-hover-effect:hover {
    background-color: #007bff; /* Tetap warna biru */
    color: white;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="wrapper">
    <button class="toggle-sidebar">
        <i class="fas fa-bars"></i>
    </button>

    <aside class="sidebar sidebar-default sidebar-white sidebar-base navs-rounded-all">
        <div class="sidebar-header d-flex align-items-center justify-content-start">
            <a href="#" class="navbar-brand">
            <img src="../kmnf.png" alt="Kominfo Logo" class="icon-30">

                <h4 class="logo-title" style="font-size:20px">Dashboard Admin</h4>
            </a>
        </div>
        <div class="sidebar-body pt-0 data-scrollbar">
            <div class="sidebar-list">
                <ul class="navbar-nav iq-main-menu" id="sidebar-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="item-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                            <i class="fas fa-users"></i>
                                 <span class="item-name">Users</span>
                                </a>
                            </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-cog"></i>
                            <span class="item-name">Settings</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <button class="logout-btn btn btn-danger w-100" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span class="ms-2">Logout</span>
        </button>
    </aside>
        
        <main class="main-content">
            <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
                <div class="container-fluid navbar-inner">
                    <a href="#" class="navbar-brand">
                        <h4 class="logo-title">Pemeriksaan Kendaraan</h4>
                    </a>
                </div>
            </nav>
            
            <div class="container-fluid content-inner mt-5 py-0">
                
<!-- Filter Section -->
<!-- Tabel Pemeriksaan Kendaraan -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title mb-0">Data Driver BMN-Operasional</h4>
                <div>
                </div>
            </div>

            <div class="container" style="max-width: 800px;">
    <div class="card mb-3">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Aksi</th> <!-- Kolom untuk tombol Hapus -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            // Output data dari setiap baris
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["id"] . "</td>";
                                echo "<td>" . $row["name"] . "</td>";
                                echo "<td>" . $row["username"] . "</td>";
                                echo "<td>" . $row["password"] . "</td>";
                                echo "<td>" . $row["role"] . "</td>";
                                echo "<td>";
                                // Tombol Hapus dengan konfirmasi JavaScript
                                echo "<a href='?delete_id=" . $row["id"] . "' onclick=\"return confirm('Apakah Anda yakin ingin menghapus user ini?')\" class='btn btn-danger btn-sm'>Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No data found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container" style="max-width: 800px;">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Tambah User Baru</h5>
            <form method="POST" action="">
                <div class="form-group mb-2">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group mb-2">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group mb-2">
                    <label for="role">Role:</label>
                    <input type="text" class="form-control" id="role" name="role" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Tambah User</button>
            </form>
        </div>
    </div>
</div>
<?php
// Tutup koneksi
$conn->close();
?>


<!-- Image Preview Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="previewImage" src="" class="img-fluid" alt="Preview" style="max-height: 80vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <a id="downloadImage" href="" class="btn btn-sm btn-primary" download>
                    <i class="fas fa-download"></i> Unduh Foto
                </a>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
                <div class="footer-body">
                    <ul class="left-panel list-inline mb-0 p-0">
                        <li class="list-inline-item"><a href="#">Kebijakan Privasi</a></li>
                        <li class="list-inline-item"><a href="#">Syarat Penggunaan</a></li>
                    </ul>
                    <div class="right-panel">
                        ©<?php echo date("Y"); ?> Dashboard Pemeriksaan Kendaraan
                    </div>
                </div>
            </footer>
        </main>
    </div>
<script>
    

</script>
    <script src="../assets/js/core/libs.min.js"></script>
    <script src="../assets/js/hope-ui.js"></script>
    <!-- Untuk Excel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <!-- Untuk PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
// Fungsi untuk menampilkan atau menyembunyikan form
function toggleForm() {
    var form = document.getElementById("userForm");
    if (form.style.display === "none") {
        form.style.display = "block";
    } else {
        form.style.display = "none";
    }
}
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
</body>
</html>