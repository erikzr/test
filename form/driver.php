
<?php
            session_start(); // Mulai sesi atau lanjutkan sesi yang ada
            ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link rel="stylesheet" href="driver.css">
    <style>
         #video {
             border: 1px solid black;
             width: 100%;
             height: auto;
         }
         #photo {
             border: 1px solid black;
             margin-top: 20px;
             display: none; /* Sembunyikan foto sampai diambil */
             width: 100%;
             height: auto;
         }
         #timestamp {
             font-style: italic;
             color: black;
             margin-top: 10px;
         }
    </style>
</head>

<body>
    <section>
        <div class="background-container"></div>

        <div class="container">
    <h1>Driver</h1>

    <form class="form" method="post" action="checkup_oli.php" enctype="multipart/form-data">
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
        <input type="file" id="kamera" name="kamera" accept="image/*" capture="environment" required>
        <!-- Atribut "accept=image/*" untuk memastikan hanya gambar yang dipilih -->
        <!-- Atribut "capture=environment" untuk memprioritaskan kamera belakang pada perangkat mobile -->
        
        <input type="submit" value="Lanjutkan">
    </form>
</div>



<script>
    async function startCamera() {
        const video = document.getElementById('video');
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        } catch (error) {
            console.error('Error accessing the camera', error);
            alert('Tidak dapat mengakses kamera, silakan periksa izin kamera.');
        }
    }

    function takePhoto() {
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photo = document.getElementById('photo');
        const timestamp = document.getElementById('timestamp');
        const photoData = document.getElementById('photoData'); // Hidden input field

        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        const context = canvas.getContext('2d');
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        photo.src = canvas.toDataURL('image/png');
        photo.style.display = 'block'; // Tampilkan foto
        
        photoData.value = photo.src; // Set the base64 photo data to the hidden input field

        const now = new Date();
        timestamp.textContent = `Timestamp: ${now.toLocaleDateString()} ${now.toLocaleTimeString()}`;
    }

    window.onload = startCamera;
</script>

</body>

</html>
