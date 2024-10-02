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
            <h1>Tanda Tangan</h1>
            <div id="signature-pad"></div>
            <div class="button-container">
                <button id="clear">Bersihkan</button>
                <button id="save">Simpan Tanda Tangan</button>
            </div>
            <form id="signature-form" method="post" action="submit_ttd.php" style="display:none;">
                <input type="hidden" name="signature" id="signature">
            </form>
        </div>
    </section>

    <script>
        const canvas = document.createElement('canvas');
        const signaturePad = document.getElementById('signature-pad');
        signaturePad.appendChild(canvas);
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
