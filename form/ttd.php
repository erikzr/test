<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanda Tangan</title>
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
        .container {
            margin-top: 20px;
        }
        #signature-pad {
            border: 1px solid #000;
            width: 100%;
            height: 200px;
            position: relative;
            cursor: crosshair;
        }
        .button-container {
            margin-top: 20px;
        }
        button {
            margin: 5px;
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
            </form>
        </div>
    </section>

    <script>
        const canvas = document.getElementById('signature');
        const ctx = canvas.getContext('2d');
        canvas.width = signaturePad.clientWidth;
        canvas.height = signaturePad.clientHeight;

        let drawing = false;

        function startDrawing(event) {
            drawing = true;
            ctx.beginPath();
            ctx.moveTo(event.offsetX, event.offsetY);
        }

        function draw(event) {
            if (!drawing) return;
            ctx.lineTo(event.offsetX, event.offsetY);
            ctx.stroke();
        }

        function stopDrawing() {
            drawing = false;
            ctx.closePath();
        }

        function clearSignature() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }

        function saveSignature() {
            const dataURL = canvas.toDataURL('image/png');
            document.getElementById('signature').value = dataURL; // Set the base64 data to hidden input
            document.getElementById('signature-form').submit(); // Submit the form
        }

        signaturePad.addEventListener('mousedown', startDrawing);
        signaturePad.addEventListener('mousemove', draw);
        signaturePad.addEventListener('mouseup', stopDrawing);
        signaturePad.addEventListener('mouseleave', stopDrawing);
        document.getElementById('clear').addEventListener('click', clearSignature);
        document.getElementById('save').addEventListener('click', saveSignature);
    </script>
</body>
</html>
