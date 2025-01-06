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

// Menangani Edit Pengguna
// Ubah bagian PHP untuk handling edit di awal file:
if (isset($_POST['edit_user'])) {
    $id = $_POST['edit_id'];
    $name = $_POST['edit_name'];
    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];
    $role = $_POST['edit_role'];
    
    // Mulai dengan query dasar
    $update_fields = array();
    $update_sql = "UPDATE users SET";
    
    // Cek dan tambahkan field yang diubah
    if (!empty($name)) {
        $update_fields[] = " name='$name'";
    }
    
    if (!empty($username)) {
        $update_fields[] = " username='$username'";
    }
    
    if (!empty($password)) {
        $update_fields[] = " password='$password'";
    }
    
    if (!empty($role)) {
        $update_fields[] = " role='$role'";
    }
    
    // Gabungkan semua field yang akan diupdate
    if (count($update_fields) > 0) {
        $update_sql .= implode(",", $update_fields);
        $update_sql .= " WHERE id=$id";
        
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data pengguna berhasil diperbarui!'
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal memperbarui data pengguna!'
                });
            </script>";
        }
    }
}

// Cek apakah form telah dikirim
// Perbaiki bagian pengecekan form submission di awal file (sekitar line 73-76)
// Ganti kode yang ada dengan:

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // Ambil data dari form dengan pengecekan isset
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validasi data tidak kosong
    if(!empty($name) && !empty($username) && !empty($password) && !empty($role)) {
        // Query untuk menambahkan data ke database
        $sql = "INSERT INTO users (name, username, password, role) VALUES ('$name', '$username', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'User baru berhasil ditambahkan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.reload();
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Error: " . $sql . "<br>" . $conn->error . "'
                });
            </script>";
        }
    }
}
// Cek apakah ada permintaan untuk menghapus user
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // Query untuk menghapus user berdasarkan ID
    $delete_sql = "DELETE FROM users WHERE id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        
    
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

.table td, .table th {
    padding: 0.3rem;
    font-size: 14px;
}

.modal-body {
    padding: 0.5rem;
}

.password-field {
    font-size: 14px;
    min-width: 100px;
}

.btn:hover{
    background-color: #6c757d;
}

.action-buttons .btn {
    padding: 0.1rem 0.3rem;
}

.card-body {
    padding: 1rem;
}

.table-responsive {
    height: calc(100vh - 250px);
    overflow-y: auto;
}

.password-cell {
    min-width: 200px;
}

.password-field {
    background: transparent;
    border: none;
    width: auto;
    padding: 0;
    margin: 0;
    flex-grow: 1;
}

.toggle-password-btn {
    padding: 0 5px;
    color: #6c757d;
}

.toggle-password-btn:hover {
    color: #0d6efd;
}

.form-control-plaintext:read-only {
    cursor: default;
}
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


        .status-aman {
            color: #28a745;
        }
        .status-perhatian {
            color: #dc3545;
        }
        .card-stats {
            transition: transform .2s;
        }
        .card-stats:hover {
            transform: scale(1.05);
        }
        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }
        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }
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

                </ul>
            </div>
        </div>
        <button class="logout-btn btn btn-danger w-90" onclick="handleLogout()">
            <i class="fas fa-sign-out-alt"></i>
            <span class="ms-2">Logout</span>
        </button>
    </aside>
    
    <main class="main-content">
        <div class="container-fluid content-inner mt-5 py-0">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">Manajemen Pengguna</h4>
                                <p class="text-muted mb-0">Kelola semua pengguna sistem</p>
                            </div>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                <i class="fas fa-plus me-2"></i>Tambah Pengguna
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Peran</th>
                                            <th width="150">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    if ($result->num_rows > 0) {
                                        $nomor = 1; // Inisialisasi nomor urut
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr class='align-middle'>";  // Tambah class align-middle untuk vertical alignment
                                            echo "<td><small>" . $nomor . "</small></td>"; // Ubah badge jadi small
                                            echo "<td>" . $row["name"] . "</td>";
                                            echo "<td>" . $row["username"] . "</td>";
                                    // Ubah bagian yang menampilkan password pada tabel menjadi:
                                            echo "<td class='password-cell'>";
                                            echo "<div class='d-flex align-items-center'>";
                                            echo "<input type='password' class='form-control-plaintext password-field py-0' id='password_" . $row["id"] . "' value='" . $row["password"] . "' readonly style='font-size: 14px;'>";
                                            echo "<button class='btn btn-link toggle-password-btn py-0 px-1' data-id='" . $row["id"] . "'>";  // Tambahkan data-id di sini
                                            echo "<i class='fas fa-eye'></i>";
                                            echo "</button>";
                                            echo "</div>";
                                            echo "</td>";
                                            echo "<td><small class='badge bg-primary'>" . $row["role"] . "</small></td>";  // Tambah class small
                                            echo "<td class='action-buttons'>";
                                            echo "<div class='btn-group btn-group-sm'>";  // Ubah jadi btn-group-sm
                                            echo "<button class='btn btn-warning btn-sm py-0 px-2' data-bs-toggle='modal' data-bs-target='#editModal" . $row["id"] . "'>";  // Kurangi padding
                                            echo "<i class='fas fa-edit'></i>";  // Hapus text "Edit"
                                            echo "</button>";
                                            echo "<button class='btn btn-danger btn-sm py-0 px-2 ms-1' onclick='confirmDelete(" . $row["id"] . ")'>";  // Kurangi padding
                                            echo "<i class='fas fa-trash'></i>";  // Hapus text "Hapus"
                                            echo "</button>";
                                            echo "</div>";

                                            // Modal Edit
                                            echo "<div class='modal fade' id='editModal" . $row["id"] . "' tabindex='-1'>";
                                            echo "<div class='modal-dialog modal-dialog-centered modal-sm'>";  // Tambah modal-sm
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header py-2'>";  // Kurangi padding
                                            echo "<h6 class='modal-title'><i class='fas fa-user-edit me-2'></i>Edit User</h6>";  // Ubah h5 ke h6
                                            echo "<button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
                                            echo "</div>";

                                            // Ubah bagian form edit di dalam loop while:
                                    echo "<div class='modal-body py-2'>";
                                    echo "<form method='POST' action='' class='needs-validation' novalidate>";
                                    echo "<input type='hidden' name='edit_id' value='" . $row["id"] . "'>";

                                    echo "<div class='mb-2'>";
                                    echo "<label class='form-label small mb-1'>Nama</label>";
                                    echo "<input type='text' class='form-control form-control-sm' name='edit_name' value='" . $row["name"] . "'>";
                                    echo "<small class='text-muted'>Biarkan kosong jika tidak ingin mengubah nama</small>";
                                    echo "</div>";

                                    echo "<div class='mb-2'>";
                                    echo "<label class='form-label small mb-1'>Username</label>";
                                    echo "<input type='text' class='form-control form-control-sm' name='edit_username' value='" . $row["username"] . "'>";
                                    echo "<small class='text-muted'>Biarkan kosong jika tidak ingin mengubah username</small>";
                                    echo "</div>";

                                    echo "<div class='mb-2'>";
                                    echo "<label class='form-label small mb-1'>Password Baru</label>";
                                    echo "<input type='password' class='form-control form-control-sm' name='edit_password'>";
                                    echo "<small class='text-muted'>Biarkan kosong jika tidak ingin mengubah password</small>";
                                    echo "</div>";

                                    echo "<div class='mb-2'>";
                                    echo "<label class='form-label small mb-1'>Peran</label>";
                                    echo "<select class='form-select form-select-sm' name='edit_role'>";
                                    echo "<option value=''>Pilih peran</option>";
                                    echo "<option value='admin' " . ($row["role"] == "admin" ? "selected" : "") . ">Admin</option>";
                                    echo "<option value='user' " . ($row["role"] == "user" ? "selected" : "") . ">User</option>";
                                    echo "</select>";
                                    echo "<small class='text-muted'>Biarkan default jika tidak ingin mengubah peran</small>";
                                    echo "</div>";

                                    echo "<div class='modal-footer p-1'>";
                                    echo "<button type='button' class='btn btn-sm btn-light py-0' data-bs-dismiss='modal'>Batal</button>";
                                    echo "<button type='submit' name='edit_user' class='btn btn-sm btn-primary py-0'>";
                                    echo "<i class='fas fa-save me-1'></i>Simpan</button>";
                                    echo "</div>";

                                    echo "</form>";
                                    echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</td>";
                                            echo "</tr>";
                                            $nomor++; // Increment nomor urut
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' class='text-center py-2'>Tidak ada data pengguna</td></tr>";
                                    }
                                    ?>
</tbody>
                                </table>
                            </div>
                        </div>

                        <div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user-plus me-2"></i>Tambah Pengguna Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" required>
                        <div class="invalid-feedback">
                            Mohon isi nama lengkap
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" required>
                        <div class="invalid-feedback">
                            Mohon isi username
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="invalid-feedback">
                            Mohon isi password
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Peran</label>
                        <select class="form-select" name="role" required>
                            <option value="">Pilih peran</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                        <div class="invalid-feedback">
                            Mohon pilih peran
                        </div>
                    </div>
                    
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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

<!-- <div class="container" style="max-width: 800px;">
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
</div> -->
<?php
// Tutup koneksi
$conn->close();
?>


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

// Utility Functions
            function handleLogout() {
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah Anda yakin ingin keluar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Batal',
                    background: '#fff'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Logging out...',
                            text: 'Mohon tunggu sebentar',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            willOpen: () => Swal.showLoading()
                        });
                        
                        setTimeout(() => {
                            window.location.href = 'logout.php';
                        }, 800);
                    }
                });
            }

            function confirmDelete(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: 'Apakah Anda yakin ingin menghapus pengguna ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '?delete_id=' + id;
        }
    });
}

document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
// Form validation
(function () {
    'use strict'
    var addUserForm = document.querySelector('#addUserModal form')
    addUserForm.addEventListener('submit', function (event) {
        if (!addUserForm.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        addUserForm.classList.add('was-validated')
    }, false)
})()

<?php if (isset($_POST['name']) && !isset($_POST['edit_user'])) { ?>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: 'Pengguna baru berhasil ditambahkan',
        showConfirmButton: false,
        timer: 1500
    });
<?php } ?>

// Tambahkan script ini di bagian bawah file, di dalam tag <script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-password-btn');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const passwordField = document.getElementById('password_' + id);
            const icon = this.querySelector('i');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
});
</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
</body>
</html>