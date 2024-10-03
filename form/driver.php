<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link rel="stylesheet" href="driver.css">
</head>
<body>
    <section>
        <div class="container">
        <img src="bmnn.png" alt="Logo" style="width: 80px; height: auto; display: block; margin: 0 auto; transform: translateX(-130px);">
            
            <h1>Driver</h1>

            <form class="form" method="post" action="driver.php" enctype="multipart/form-data">
                <h2>Data Pribadi</h2>
                <label for="nama_petugas">Nama Petugas:</label>
                <input class="kotak" type="text" id="nama_petugas" name="nama_petugas" placeholder="nama lengkap" required><br><br>
                
                <div class="form-group">
                    <label>Plat Mobil:</label>
                    <div class="radio-group">
                        <label>
                            <input type="radio" id="plat_mobil_inova" name="plat_mobil" value="W 1740 NP ( Inova Lama )" required>
                            W 1740 NP ( Inova Lama )
                        </label>
                        <label>
                            <input type="radio" id="plat_mobil_reborn" name="plat_mobil" value="W 1507 NP ( Reborn )" required>
                            W 1507 NP ( Reborn )
                        </label>
                        <label>
                            <input type="radio" id="plat_mobil_kapsul" name="plat_mobil" value="W 1374 NP ( Kijang Kapsul )" required>
                            W 1374 NP ( Kijang Kapsul )
                        </label>
                    </div>
                </div>

                <label for="hari">Hari:</label>
                <input class="kotak" type="date" id="hari" name="hari" required><br><br>

                <label for="kamera">FOTO MOBIL TAMPAK DEPAN</label>
                <input type="file" id="kamera" name="kamera" accept="image/*" capture="environment" required onchange="previewImage(event)" onfocus="wkkwkwkw()">
                <br><br>

                <!-- Area untuk menampilkan pratinjau gambar -->
                <img id="preview" src="" alt="Pratinjau Gambar" style="display:none; max-width: 300px;">
                <p id="timestamp" style="display:none;"></p> <!-- Timestamp akan ditampilkan di sini -->

                <input type="submit" value="Lanjutkan">
            </form>
        </div>
    </section>

    <script>
        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();

            reader.onload = function(){
                var preview = document.getElementById('preview');
                preview.src = reader.result;
                preview.style.display = 'block';

                // Menampilkan timestamp dengan format 24 jam
                var timestamp = document.getElementById('timestamp');
                var now = new Date();
                var hours = now.getHours().toString().padStart(2, '0'); // Format 24 jam
                var minutes = now.getMinutes().toString().padStart(2, '0');
                var seconds = now.getSeconds().toString().padStart(2, '0');
                var formattedTime = hours + ':' + minutes + ':' + seconds;
                var formattedDate = now.toLocaleDateString('id-ID'); // Format tanggal lokal Indonesia
                timestamp.textContent = 'Foto diambil pada: ' + formattedDate + ' ' + formattedTime;
                timestamp.style.display = 'block';
            };

            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
