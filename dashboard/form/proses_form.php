<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "checkcar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = [
        'nama', 'plat_mobil', 'oli_mesin', 'oli_power_steering', 'oli_transmisi', 'minyak_rem',
        'lampu_utama', 'lampu_sein', 'lampu_rem', 'lampu_klakson', 'cek_aki',
        'cek_kursi', 'cek_lantai', 'cek_dinding', 'cek_kap',
        'cek_stnk', 'cek_apar', 'cek_p3k', 'cek_kunci_roda', 'cek_air_radiator',
        'cek_bahan_bakar', 'cek_tekanan_ban', 'cek_rem'
    ];

    $data = [];
    foreach ($fields as $field) {
        $data[$field] = mysqli_real_escape_string($conn, $_POST[$field] ?? '');
    }

    $foto_fields = [
        'oli_mesin', 'oli_power_steering', 'oli_transmisi', 'minyak_rem',
        'lampu_utama', 'lampu_sein', 'lampu_rem', 'lampu_klakson', 'aki',
        'kursi', 'lantai', 'dinding', 'kap', 'stnk', 'apar', 'p3k',
        'kunci_roda', 'air_radiator', 'bahan_bakar', 'tekanan_ban',
    ];

    $target_dir = "../../form/uploads/"; // Pastikan path ini benar
    foreach ($foto_fields as $field) {
        if (isset($_FILES[$field . "_foto"]) && $_FILES[$field . "_foto"]["error"] == 0) {
            $foto_name = $target_dir . uniqid() . '_' . basename($_FILES[$field . "_foto"]["name"]);
            if (move_uploaded_file($_FILES[$field . "_foto"]["tmp_name"], $foto_name)) {
                $data[$field . "_foto"] = $foto_name;
            } else {
                echo "Gagal mengunggah file untuk: " . $field . "_foto. Error: " . $_FILES[$field . "_foto"]["error"];
            }
        } else {
            echo "Tidak ada file yang diunggah untuk: " . $field . "_foto. Error: " . ($_FILES[$field . "_foto"]["error"] ?? "File tidak ada");
        }
    }

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", $data) . "'";

    $sql = "INSERT INTO vehicle_inspection ($columns) VALUES ($values)";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
