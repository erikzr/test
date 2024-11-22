<!--pemeriksa OLI        --><fieldset>
                                <div class="form-card text-start">
                                    <div class="row mb-4">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Oli</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 2 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Oli Mesin -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Oli Mesin</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_mesin" value="baik" id="oli_mesin_baik">
                                                    <label class="form-check-label" for="oli_mesin_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_mesin" value="tidak_baik" id="oli_mesin_tidak_baik">
                                                    <label class="form-check-label" for="oli_mesin_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="oli_mesin_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Mesin</label>
                                                    <input type="file" class="form-control" name="oli_mesin_foto" id="oli_mesin_foto" accept="image/*" capture="camera" />
                                                    <small id="oli_mesin_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_mesin_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Oli Power Steering -->
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Oli Power Steering</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_power_steering" value="baik" id="oli_power_steering_baik">
                                                    <label class="form-check-label" for="oli_power_steering_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_power_steering" value="tidak_baik" id="oli_power_steering_tidak_baik">
                                                    <label class="form-check-label" for="oli_power_steering_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="oli_power_steering_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Power Steering</label>
                                                    <input type="file" class="form-control" name="oli_power_steering_foto" id="oli_power_steering_foto" accept="image/*" capture="camera" />
                                                    <small id="oli_power_steering_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_power_steering_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Bagian Oli Transmisi -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Oli Transmisi</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_transmisi" value="baik" id="oli_transmisi_baik">
                                                    <label class="form-check-label" for="oli_transmisi_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="oli_transmisi" value="tidak_baik" id="oli_transmisi_tidak_baik">
                                                    <label class="form-check-label" for="oli_transmisi_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="oli_transmisi_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Oli Transmisi</label>
                                                    <input type="file" class="form-control" name="oli_transmisi_foto" id="oli_transmisi_foto" accept="image/*" capture="camera" />
                                                    <small id="oli_transmisi_timestamp" class="form-text text-muted">Waktu diambil: <span id="oli_transmisi_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Bagian Minyak Rem -->
                                        <div class="col-md-6">
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Minyak Rem</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="minyak_rem" value="baik" id="minyak_rem_baik">
                                                    <label class="form-check-label" for="minyak_rem_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="minyak_rem" value="tidak_baik" id="minyak_rem_tidak_baik">
                                                    <label class="form-check-label" for="minyak_rem_tidak_baik">Tidak Baik</label>
                                                </div>
                                                <!-- Input Foto Menggunakan Kamera -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);">
                                                    <label for="minyak_rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Minyak Rem</label>
                                                    <input type="file" class="form-control" name="minyak_rem_foto" id="minyak_rem_foto" accept="image/*" capture="camera" />
                                                    <small id="minyak_rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="minyak_rem_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-end mt-4">
                                        <button type="button" name="previous" class="btn btn-dark previous action-button-previous me-1 text-white" value="Previous">
                                            Previous
                                        </button>
                                        <button type="button" name="next" class="btn btn-primary next action-button" value="Next">
                                            Next
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                            <script>
                                // JavaScript untuk menangani timestamp
                                const handleTimestamp = (inputId, timestampId) => {
                                    const inputElement = document.getElementById(inputId);
                                    const timestampElement = document.getElementById(timestampId);

                                    inputElement.addEventListener('change', () => {
                                        const currentTime = new Date().toLocaleString();
                                        timestampElement.innerText = currentTime;
                                    });
                                };

                                // Panggil fungsi untuk setiap input foto
                                handleTimestamp('oli_mesin_foto', 'oli_mesin_time');
                                handleTimestamp('oli_power_steering_foto', 'oli_power_steering_time');
                                handleTimestamp('oli_transmisi_foto', 'oli_transmisi_time');
                                handleTimestamp('minyak_rem_foto', 'minyak_rem_time');
                            </script>