<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kendaraan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input[type="text"],
        input[type="date"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            margin-top: 20px;
            padding: 10px;
            background: #007bff;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Laporan Kendaraan</h1>
        <form action="submit.php" method="post" enctype="multipart/form-data">
            <label for="nama_petugas">Nama Petugas*</label>
            <input type="text" id="nama_petugas" name="nama_petugas" required>

            <label for="plat_mobil">Plat Mobil*</label>
            <select id="plat_mobil" name="plat_mobil" required>
                <option value="W 1740 NP ( Inova Lama )">W 1740 NP ( Inova Lama )</option>
                <option value="W 1507 NP ( Reborn )">W 1507 NP ( Reborn )</option>
                <option value="W 1374 NP ( Kijang Kapsul )">W 1374 NP ( Kijang Kapsul )</option>
            </select>

            <label for="tanggal">Hari/Tanggal*</label>
            <input type="date" id="tanggal" name="tanggal" required>

            <label for="oli_mesin">Oli Mesin*</label>
            <select id="oli_mesin" name="oli_mesin" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="oli_power_steering">Oli Power Steering*</label>
            <select id="oli_power_steering" name="oli_power_steering" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="oli_transmisi">Oli Transmisi*</label>
            <select id="oli_transmisi" name="oli_transmisi" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="minyak_rem">Minyak Rem*</label>
            <select id="minyak_rem" name="minyak_rem" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kondisi_penerangan">Kondisi Penerangan*</label>
            <select id="kondisi_penerangan" name="kondisi_penerangan" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="lampu_utama">Lampu Utama*</label>
            <select id="lampu_utama" name="lampu_utama" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="lampu_sein">Lampu Sein*</label>
            <select id="lampu_sein" name="lampu_sein" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="lampu_rem">Lampu Rem*</label>
            <select id="lampu_rem" name="lampu_rem" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="lampu_klakson">Lampu, Klakson & Pendukung Lainnya*</label>
            <select id="lampu_klakson" name="lampu_klakson" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="accu">ACCU*</label>
            <select id="accu" name="accu" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kebersihan_kursi">Kebersihan Kursi*</label>
            <select id="kebersihan_kursi" name="kebersihan_kursi" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kebersihan_lantai">Kebersihan Lantai*</label>
            <select id="kebersihan_lantai" name="kebersihan_lantai" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kebersihan_dinding">Kebersihan Dinding Dalam & Luar Mobil*</label>
            <select id="kebersihan_dinding" name="kebersihan_dinding" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kebersihan_kap_mesin">Kebersihan Kap Mesin*</label>
            <select id="kebersihan_kap_mesin" name="kebersihan_kap_mesin" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="stnk">STNK Masih Berlaku*</label>
            <select id="stnk" name="stnk" required>
                <option value="Baik ( Masih Berlaku )">Baik ( Masih Berlaku )</option>
                <option value="Tidak Baik ( Expired )">Tidak Baik ( Expired )</option>
            </select>

            <label for="apar">Apar*</label>
            <select id="apar" name="apar" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kotak_p3k">Kotak P3K*</label>
            <select id="kotak_p3k" name="kotak_p3k" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kunci_roda">Kunci Roda*</label>
            <select id="kunci_roda" name="kunci_roda" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="air_radiator">Air Radiator*</label>
            <select id="air_radiator" name="air_radiator" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="bahan_bakar">Cek Bahan Bakar Kendaraan*</label>
            <select id="bahan_bakar" name="bahan_bakar" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="tekanan_angin">Tekanan Angin Ban*</label>
            <select id="tekanan_angin" name="tekanan_angin" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="kondisi_rem">Kondisi Rem*</label>
            <select id="kondisi_rem" name="kondisi_rem" required>
                <option value="Baik">Baik</option>
                <option value="Tidak Baik">Tidak Baik</option>
            </select>

            <label for="laporan">Upload File Laporan</label>
            <input type="file" id="laporan" name="laporan[]" multiple>

            <input type="submit" value="Kirim Laporan">
        </form>
    </div>
</body>
</html>
