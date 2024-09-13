<?php
include 'form/config.php'; // Menghubungkan dengan file koneksi database

$sql = "SELECT * FROM checkup";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nama Petugas</th>
                <th>Plat Mobil</th>
                <th>Hari</th>
                <th>Oli Mesin</th>
                <th>Oli Power Steering</th>
                <th>Oli Transmisi</th>
                <th>Minyak Rem</th>
                <th>Lampu Utama</th>
                <th>Lampu Sein</th>
                <th>Lampu Rem</th>
                <th>Lampu Klakson</th>
                <th>Accu</th>
                <th>Kursi</th>
                <th>Lantai</th>
                <th>Dinding</th>
                <th>Kap</th>
                <th>STNK</th>
                <th>APAR</th>
                <th>P3K</th>
                <th>Kunci Roda</th>
                <th>Air Radiator</th>
                <th>Bahan Bakar</th>
                <th>Oli</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["nama_petugas"] . "</td>
                <td>" . $row["plat_mobil"] . "</td>
                <td>" . $row["hari"] . "</td>
                <td>" . $row["oliMesin"] . "</td>
                <td>" . $row["oliPowerSteering"] . "</td>
                <td>" . $row["oliTransmisi"] . "</td>
                <td>" . $row["minyakRem"] . "</td>
                <td>" . $row["lampuUtama"] . "</td>
                <td>" . $row["lampuSein"] . "</td>
                <td>" . $row["lampuRem"] . "</td>
                <td>" . $row["lampuKlakson"] . "</td>
                <td>" . $row["accu"] . "</td>
                <td>" . $row["kursi"] . "</td>
                <td>" . $row["lantai"] . "</td>
                <td>" . $row["dinding"] . "</td>
                <td>" . $row["kap"] . "</td>
                <td>" . $row["stnk"] . "</td>
                <td>" . $row["apar"] . "</td>
                <td>" . $row["p3k"] . "</td>
                <td>" . $row["kunciRoda"] . "</td>
                <td>" . $row["airRadiator"] . "</td>
                <td>" . $row["bahanBakar"] . "</td>
                <td>" . $row["oli"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data yang ditemukan.";
}

$conn->close();
?>
