<!--pemeriksaan lain-lain--><fieldset>
<div class="form-card text-start">
                                    <div class="row">
                                        <div class="col-7">
                                            <h3 class="mb-4">Pemeriksaan Lain-lain</h3>
                                        </div>
                                        <div class="col-5 text-end">
                                            <h2 class="steps">Step 6 - 6</h2>
                                        </div>
                                    </div>

                                    <!-- Bagian Pemeriksaan Lain-lain -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- STNK -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek STNK</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_stnk" value="baik" id="cek_stnk_baik">
                                                    <label class="form-check-label" for="cek_stnk_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_stnk" value="tidak_baik" id="cek_stnk_tidak_baik">
                                                    <label class="form-check-label" for="cek_stnk_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="stnk_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto STNK</label>
                                                    <input type="file" class="form-control" name="stnk_foto" id="stnk_foto" accept="image/*" capture="camera" onchange="updateTimestamp('stnk_time')" />
                                                    <small id="stnk_timestamp" class="form-text text-muted">Waktu diambil: <span id="stnk_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Apar -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Apar</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_apar" value="baik" id="cek_apar_baik">
                                                    <label class="form-check-label" for="cek_apar_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_apar" value="tidak_baik" id="cek_apar_tidak_baik">
                                                    <label class="form-check-label" for="cek_apar_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="apar_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Apar</label>
                                                    <input type="file" class="form-control" name="apar_foto" id="apar_foto" accept="image/*" capture="camera" onchange="updateTimestamp('apar_time')" />
                                                    <small id="apar_timestamp" class="form-text text-muted">Waktu diambil: <span id="apar_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kotak P3K -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kotak P3K</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_p3k" value="baik" id="cek_p3k_baik">
                                                    <label class="form-check-label" for="cek_p3k_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_p3k" value="tidak_baik" id="cek_p3k_tidak_baik">
                                                    <label class="form-check-label" for="cek_p3k_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="p3k_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kotak P3K</label>
                                                    <input type="file" class="form-control" name="p3k_foto" id="p3k_foto" accept="image/*" capture="camera" onchange="updateTimestamp('p3k_time')" />
                                                    <small id="p3k_timestamp" class="form-text text-muted">Waktu diambil: <span id="p3k_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Kunci Roda -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kunci Roda</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kunci_roda" value="baik" id="cek_kunci_roda_baik">
                                                    <label class="form-check-label" for="cek_kunci_roda_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_kunci_roda" value="tidak_baik" id="cek_kunci_roda_tidak_baik">
                                                    <label class="form-check-label" for="cek_kunci_roda_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="kunci_roda_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Kunci Roda</label>
                                                    <input type="file" class="form-control" name="kunci_roda_foto" id="kunci_roda_foto" accept="image/*" capture="camera" onchange="updateTimestamp('kunci_roda_time')" />
                                                    <small id="kunci_roda_timestamp" class="form-text text-muted">Waktu diambil: <span id="kunci_roda_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Air Radiator -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Air Radiator</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_air_radiator" value="baik" id="cek_air_radiator_baik">
                                                    <label class="form-check-label" for="cek_air_radiator_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_air_radiator" value="tidak_baik" id="cek_air_radiator_tidak_baik">
                                                    <label class="form-check-label" for="cek_air_radiator_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="air_radiator_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Air Radiator</label>
                                                    <input type="file" class="form-control" name="air_radiator_foto" id="air_radiator_foto" accept="image/*" capture="camera" onchange="updateTimestamp('air_radiator_time')" />
                                                    <small id="air_radiator_timestamp" class="form-text text-muted">Waktu diambil: <span id="air_radiator_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Bahan Bakar -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Bahan Bakar Kendaraan</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_bahan_bakar" value="baik" id="cek_bahan_bakar_baik">
                                                    <label class="form-check-label" for="cek_bahan_bakar_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_bahan_bakar" value="tidak_baik" id="cek_bahan_bakar_tidak_baik">
                                                    <label class="form-check-label" for="cek_bahan_bakar_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="bahan_bakar_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Bahan Bakar</label>
                                                    <input type="file" class="form-control" name="bahan_bakar_foto" id="bahan_bakar_foto" accept="image/*" capture="camera" onchange="updateTimestamp('bahan_bakar_time')" />
                                                    <small id="bahan_bakar_timestamp" class="form-text text-muted">Waktu diambil: <span id="bahan_bakar_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Tekanan Angin & Kondisi Ban -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Tekanan Angin & Kondisi Ban</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_tekanan_ban" value="baik" id="cek_tekanan_ban_baik">
                                                    <label class="form-check-label" for="cek_tekanan_ban_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_tekanan_ban" value="tidak_baik" id="cek_tekanan_ban_tidak_baik">
                                                    <label class="form-check-label" for="cek_tekanan_ban_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="tekanan_ban_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Tekanan & Kondisi Ban</label>
                                                    <input type="file" class="form-control" name="tekanan_ban_foto" id="tekanan_ban_foto" accept="image/*" capture="camera" onchange="updateTimestamp('tekanan_ban_time')" />
                                                    <small id="tekanan_ban_timestamp" class="form-text text-muted">Waktu diambil: <span id="tekanan_ban_time">belum diambil</span></small>
                                                </div>
                                            </div>

                                            <!-- Handrem/Rem -->
                                            <div class="form-group p-4 mb-4" style="border: 1px solid #e0e0e0; border-radius: 8px;">
                                                <label class="form-label">Cek Kondisi Handrem/Rem</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_rem" value="baik" id="cek_rem_baik">
                                                    <label class="form-check-label" for="cek_rem_baik">Baik</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="cek_rem" value="tidak_baik" id="cek_rem_tidak_baik">
                                                    <label class="form-check-label" for="cek_rem_tidak_baik">Tidak Baik</label>
                                                </div>

                                                <!-- Input Foto -->
                                                <div class="input-image mt-3" style="padding: 16px; background-color: #f9f9f9; border-radius: 8px;">
                                                    <label for="rem_foto" class="form-label d-block" style="font-weight: 600;">Ambil Foto Handrem/Rem</label>
                                                    <input type="file" class="form-control" name="rem_foto" id="rem_foto" accept="image/*" capture="camera" onchange="updateTimestamp('rem_time')" />
                                                    <small id="rem_timestamp" class="form-text text-muted">Waktu diambil: <span id="rem_time">belum diambil</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Navigasi -->
                                <button type="submit" name="next" class="btn btn-primary next action-button float-end" value="Submit">Submit</button>
                                <button type="button" name="previous" class="btn btn-dark previous action-button-previous float-end me-1 text-white" value="Previous">Previous</button>
                            </fieldset>