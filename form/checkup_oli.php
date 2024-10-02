<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan Oli</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="form.css"> <!-- Make sure this is the updated CSS -->
</head>
<body>
    <section>
        <div class="container">
            <h1>Pemeriksaan Oli</h1>
            <form class="form" method="post" action="" enctype="multipart/form-data">
                <!-- Bagian Pemeriksaan Oli -->
            <form class="form" method="post" enctype="multipart/form-data">
                <div class="fieldset-container">
                    <legend>Oli Mesin</legend>
                    <div class="form-group">
                        <div class="radio-group">
                            <label class="baik">
                                <input type="radio" id="oliMesinBaik" name="oliMesin" value="Baik" required>
                                Baik
                            </label>
                            <label class="tidak-baik">
                                <input type="radio" id="oliMesinTidakBaik" name="oliMesin" value="Tidak Baik" required>
                                Tidak Baik
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="oli_mesin_file">Upload Laporan Kecukupan Oli Mesin</label>
                        <input type="file" id="oli_mesin_file" name="oli_mesin_file" accept="image/*" required>
                        <label>
                            <input type="radio" id="oliMesinBaik" name="oliMesin" value="Baik" required>
                            Baik
                        </label>
                        <label>
                            <input type="radio" id="oliMesinTidakBaik" name="oliMesin" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                        <label for="oliMesin">Upload Foto Oli Mesin</label>
                        <input type="file" id="oliMesin" name="oliMesin[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Oli Power Steering</legend>
                    <div class="form-group">
                        <label>
                            <input type="radio" id="oliPowerBaik" name="oliPowerSteering" value="Baik" required>
                            Baik
                        </label>
                        <label>
                            <input type="radio" id="oliPowerTidakBaik" name="oliPowerSteering" value="Tidak Baik"
                                required>
                            Tidak Baik
                        </label>
                        <label for="oliPowerSteering">Upload Foto Oli Power Steering</label>
                        <input type="file" id="oliPowerSteering" name="oliPowerSteering[]"
                            accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Oli Transmisi</legend>
                    <div class="form-group">
                        <label>
                            <input type="radio" id="oliTransmisiBaik" name="oliTransmisi" value="Baik" required>
                            Baik
                        </label>
                        <label>
                            <input type="radio" id="oliTransmisiTidakBaik" name="oliTransmisi" value="Tidak Baik"
                                required>
                            Tidak Baik
                        </label>
                        <label for="oliTransmisi">Upload Foto Oli Transmisi</label>
                        <input type="file" id="oliTransmisi" name="oliTransmisi[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <div class="fieldset-container">
                    <legend>Minyak Rem</legend>
                    <div class="form-group">
                        <label>
                            <input type="radio" id="minyakRemBaik" name="minyakRem" value="Baik" required>
                            Baik
                        </label>
                        <label>
                            <input type="radio" id="minyakRemTidakBaik" name="minyakRem" value="Tidak Baik" required>
                            Tidak Baik
                        </label>
                        <label for="minyakRem">Upload Foto Minyak Rem</label>
                        <input type="file" id="minyakRem" name="minyakRem[]" accept=".jpg,.jpeg,.png,.gif">
                    </div>
                </div>

                <!-- Bagian Upload File -->
                <div class="form-group">
                    <button type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </section>
</body>
</html>