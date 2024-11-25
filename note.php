<!-- Pemeriksaan Penerangan -->
<fieldset>
    <div class="form-card text-start">
        <div class="row mb-4">
            <div class="col-7">
                <h3 class="mb-4">Pemeriksaan Penerangan</h3>
            </div>
            <div class="col-5 text-end">
                <h2 class="steps">Step 3 - 6</h2>
            </div>
        </div>

        <!-- Bagian Lampu Utama -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Utama</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_utama" value="baik" id="lampu_utama_baik" required>
                        <label class="form-check-label" for="lampu_utama_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_utama" value="tidak_baik" id="lampu_utama_tidak_baik">
                        <label class="form-check-label" for="lampu_utama_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_utama_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Utama</label>
                        <input type="file" class="form-control" name="lampu_utama_foto" id="lampu_utama_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_utama_time')" />
                        <small id="lampu_utama_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_utama_time">belum diambil</span></small>
                    </div>
                </div>
            </div>

            <!-- Bagian Lampu Sein -->
            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Sein</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_sein" value="baik" id="lampu_sein_baik" required>
                        <label class="form-check-label" for="lampu_sein_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_sein" value="tidak_baik" id="lampu_sein_tidak_baik">
                        <label class="form-check-label" for="lampu_sein_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_sein_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Sein</label>
                        <input type="file" class="form-control" name="lampu_sein_foto" id="lampu_sein_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_sein_time')" />
                        <small id="lampu_sein_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_sein_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bagian Lampu Rem dan Klakson -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Rem</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_rem" value="baik" id="lampu_rem_baik" required>
                        <label class="form-check-label" for="lampu_rem_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_rem" value="tidak_baik" id="lampu_rem_tidak_baik">
                        <label class="form-check-label" for="lampu_rem_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Rem</label>
                        <input type="file" class="form-control" name="lampu_rem_foto" id="lampu_rem_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_rem_time')" />
                        <small id="lampu_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_rem_time">belum diambil</span></small>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                    <label class="form-label">Lampu Klakson & Pendukung</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_klakson" value="baik" id="lampu_klakson_baik" required>
                        <label class="form-check-label" for="lampu_klakson_baik">Baik</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="lampu_klakson" value="tidak_baik" id="lampu_klakson_tidak_baik">
                        <label class="form-check-label" for="lampu_klakson_tidak_baik">Tidak Baik</label>
                    </div>
                    <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                        <label for="lampu_klakson_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Lampu Klakson</label>
                        <input type="file" class="form-control" name="lampu_klakson_foto" id="lampu_klakson_foto" accept="image/*" capture="camera" required onchange="updateTimestamp('lampu_klakson_time')" />
                        <small id="lampu_klakson_timestamp" class="form-text text-muted">Waktu diambil: <span id="lampu_klakson_time">belum diambil</span></small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Navigasi -->
        <div class="d-flex justify-content-end mt-4">
            <button type="button" id="btn-prev-3" class="btn btn-dark vehicle-prev me-1 text-white" value="Previous">Previous</button>
            <button type="button" id="btn-next-3" class="btn btn-primary vehicle-next" value="Next">Next</button>
        </div>
    </div>
</fieldset>