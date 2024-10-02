<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver</title>
    <link rel="stylesheet" href="driver.css">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            text-align: center;
            overflow: auto; /* Membolehkan scroll */
            height: auto; /* Pastikan body dan html memiliki tinggi otomatis */
        }
        #signature {
            border: 1px solid black;
            margin-top: 20px;
            cursor: crosshair; /* Menampilkan kursor seperti silang */
            width: 100%; /* Mengisi lebar form */
            height: 200px; /* Tinggi kolom tanda tangan */
            touch-action: none; /* Mencegah scroll saat menggambar di mobile */
        }
        #controls {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <section>
        <div class="container">
            <h1>Identitas</h1>

            <form class="form" method="post" action="driver.php" enctype="multipart/form-data">
                <h2>Tanda Tangan</h2>
                <canvas id="signature" width="640" height="200"></canvas>
                <div id="controls">
                    <button type="button" id="clear">Clear</button>
                    <button type="button" id="save">Save</button>
                </div>
                <img id="signatureImage" style="display:none;" alt="Signature"/>
                <input type="file" id="kamera" name="kamera" accept="image/*" capture="environment" required onchange="previewImage(event)">
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

        const canvas = document.getElementById('signature');
        const ctx = canvas.getContext('2d');
        let drawing = false;

        // Atur ketebalan pena
        ctx.lineWidth = 4; // Menebalkan pena dengan ketebalan 4px
        ctx.strokeStyle = 'black'; // Atur warna pena (hitam)

        // Fungsi untuk memulai menggambar
        function startDrawing(x, y) {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(x, y);
        }

        // Fungsi untuk menggambar
        function draw(x, y) {
            if (!drawing) return;
            ctx.lineTo(x, y);
            ctx.stroke();
        }

        // Fungsi untuk menyelesaikan menggambar
        function stopDrawing() {
            drawing = false;
            ctx.closePath();
        }

        // Menghitung offset untuk desktop
        function getMousePos(event) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: (event.clientX - rect.left) * (canvas.width / rect.width),
                y: (event.clientY - rect.top) * (canvas.height / rect.height)
            };
        }

        // Event mouse untuk desktop
        canvas.addEventListener('mousedown', (event) => {
            const pos = getMousePos(event);
            startDrawing(pos.x, pos.y);
        });
        canvas.addEventListener('mousemove', (event) => {
            const pos = getMousePos(event);
            draw(pos.x, pos.y);
        });
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing); // Menangani mouse keluar dari canvas

        // Menghitung offset untuk mobile
        canvas.addEventListener('touchstart', (event) => {
            const touch = event.touches[0];
            const pos = {
                x: (touch.clientX - canvas.getBoundingClientRect().left) * (canvas.width / canvas.clientWidth),
                y: (touch.clientY - canvas.getBoundingClientRect().top) * (canvas.height / canvas.clientHeight)
            };
            startDrawing(pos.x, pos.y);
            event.preventDefault(); // Mencegah scroll saat menggambar
        });
        canvas.addEventListener('touchmove', (event) => {
            const touch = event.touches[0];
            const pos = {
                x: (touch.clientX - canvas.getBoundingClientRect().left) * (canvas.width / canvas.clientWidth),
                y: (touch.clientY - canvas.getBoundingClientRect().top) * (canvas.height / canvas.clientHeight)
            };
            draw(pos.x, pos.y);
            event.preventDefault(); // Mencegah scroll saat menggambar
        });
        canvas.addEventListener('touchend', stopDrawing);

        // Clear canvas
        document.getElementById('clear').addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        });

        // Simpan tanda tangan sebagai gambar
        document.getElementById('save').addEventListener('click', () => {
            const dataURL = canvas.toDataURL();
            const signatureImage = document.getElementById('signatureImage');
            signatureImage.src = dataURL;
            signatureImage.style.display = 'block'; // Menampilkan gambar tanda tangan
        });
    </script>
</body>
</html>
