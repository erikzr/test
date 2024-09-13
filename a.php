<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tampilkan Data</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchData() {
                $.ajax({
                    url: 'get_data.php', // File yang mengambil data
                    type: 'GET',
                    success: function(data) {
                        $('#data-table').html(data); // Menampilkan data ke dalam elemen dengan id "data-table"
                    }
                });
            }

            // Panggil fetchData pertama kali
            fetchData();

            // Atur interval untuk fetchData setiap 5 detik
            setInterval(fetchData, 5000);
        });
    </script>
</head>
<body>

<h2>Data Check-Up Kendaraan</h2>
<div id="data-table">Loading data...</div>

</body>
</html>
