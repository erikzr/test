<div class="row">
    <div class="col-12">
        <h5>Detail Komponen</h5>
        <div class="accordion" id="accordionKomponen">
            <!-- Cairan -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCairan">
                        Cairan
                    </button>
                </h2>
                <div id="collapseCairan" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <table class="table">
                            <tr>
                                <th>Oli Mesin</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['oli_mesin']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['oli_mesin']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['oli_mesin_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['oli_mesin_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Oli Power Steering</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['oli_power_steering']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['oli_power_steering']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['oli_power_steering_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['oli_power_steering_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Oli Transmisi</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['oli_transmisi']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['oli_transmisi']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['oli_transmisi_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['oli_transmisi_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Minyak Rem</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['minyak_rem']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['minyak_rem']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['minyak_rem_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['minyak_rem_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Lampu -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLampu">
                        Lampu
                    </button>
                </h2>
                <div id="collapseLampu" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <table class="table">
                            <tr>
                                <th>Lampu Utama</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['lampu_utama']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['lampu_utama']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['lampu_utama_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['lampu_utama_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Lampu Sein</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['lampu_sein']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['lampu_sein']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['lampu_sein_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['lampu_sein_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Lampu Rem</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['lampu_rem']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['lampu_rem']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['lampu_rem_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['lampu_rem_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Klakson</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['lampu_klakson']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['lampu_klakson']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['lampu_klakson_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['lampu_klakson_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Interior -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInterior">
                        Interior
                    </button>
                </h2>
                <div id="collapseInterior" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <table class="table">
                            <tr>
                                <th>Aki</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_aki']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_aki']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['aki_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['aki_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kursi</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_kursi']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_kursi']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['kursi_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['kursi_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Lantai</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_lantai']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_lantai']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['lantai_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['lantai_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Dinding</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_dinding']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_dinding']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['dinding_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['dinding_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Kap</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_kap']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_kap']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['kap_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['kap_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Dokumen dan Perlengkapan -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDokumen">
                        Dokumen dan Perlengkapan
                    </button>
                </h2>
                <div id="collapseDokumen" class="accordion-collapse collapse">
                    <div class="accordion-body">
                        <table class="table">
                            <tr>
                                <th>STNK</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_stnk']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_stnk']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['stnk_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['stnk_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>APAR</th>
                                <td>
                                    <span class="badge <?php echo strtolower($data['cek_apar']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo $data['cek_apar']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (!empty($data['apar_foto'])): ?>
                                        <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['apar_foto']); ?>')">
                                            <i class="fas fa-image"></i> Lihat Foto
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                               <th>P3K</th>
                               <td>
                                   <span class="badge <?php echo strtolower($data['cek_p3k']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                       <?php echo $data['cek_p3k']; ?>
                                   </span>
                               </td>
                               <td>
                                   <?php if (!empty($data['p3k_foto'])): ?>
                                       <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['p3k_foto']); ?>')">
                                           <i class="fas fa-image"></i> Lihat Foto
                                       </button>
                                   <?php endif; ?>
                               </td>
                           </tr>
                           <tr>
                               <th>Kunci Roda</th>
                               <td>
                                   <span class="badge <?php echo strtolower($data['cek_kunci_roda']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                       <?php echo $data['cek_kunci_roda']; ?>
                                   </span>
                               </td>
                               <td>
                                   <?php if (!empty($data['kunci_roda_foto'])): ?>
                                       <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['kunci_roda_foto']); ?>')">
                                           <i class="fas fa-image"></i> Lihat Foto
                                       </button>
                                   <?php endif; ?>
                               </td>
                           </tr>
                       </table>
                   </div>
               </div>
           </div>

           <!-- Sistem dan Mekanis -->
           <div class="accordion-item">
               <h2 class="accordion-header">
                   <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSistem">
                       Sistem dan Mekanis
                   </button>
               </h2>
               <div id="collapseSistem" class="accordion-collapse collapse">
                   <div class="accordion-body">
                       <table class="table">
                           <tr>
                               <th>Air Radiator</th>
                               <td>
                                   <span class="badge <?php echo strtolower($data['cek_air_radiator']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                       <?php echo $data['cek_air_radiator']; ?>
                                   </span>
                               </td>
                               <td>
                                   <?php if (!empty($data['air_radiator_foto'])): ?>
                                       <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['air_radiator_foto']); ?>')">
                                           <i class="fas fa-image"></i> Lihat Foto
                                       </button>
                                   <?php endif; ?>
                               </td>
                           </tr>
                           <tr>
                               <th>Bahan Bakar</th>
                               <td>
                                   <span class="badge <?php echo strtolower($data['cek_bahan_bakar']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                       <?php echo $data['cek_bahan_bakar']; ?>
                                   </span>
                               </td>
                               <td>
                                   <?php if (!empty($data['bahan_bakar_foto'])): ?>
                                       <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['bahan_bakar_foto']); ?>')">
                                           <i class="fas fa-image"></i> Lihat Foto
                                       </button>
                                   <?php endif; ?>
                               </td>
                           </tr>
                           <tr>
                               <th>Tekanan Ban</th>
                               <td>
                                   <span class="badge <?php echo strtolower($data['cek_tekanan_ban']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                       <?php echo $data['cek_tekanan_ban']; ?>
                                   </span>
                               </td>
                               <td>
                                   <?php if (!empty($data['tekanan_ban_foto'])): ?>
                                       <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['tekanan_ban_foto']); ?>')">
                                           <i class="fas fa-image"></i> Lihat Foto
                                       </button>
                                   <?php endif; ?>
                               </td>
                           </tr>
                           <tr>
                               <th>Rem</th>
                               <td>
                                   <span class="badge <?php echo strtolower($data['cek_rem']) === 'baik' ? 'bg-success' : 'bg-danger'; ?>">
                                       <?php echo $data['cek_rem']; ?>
                                   </span>
                               </td>
                               <td>
                                   <?php if (!empty($data['rem_foto'])): ?>
                                       <button class="btn btn-sm btn-primary" onclick="viewImage('<?php echo htmlspecialchars($data['rem_foto']); ?>')">
                                           <i class="fas fa-image"></i> Lihat Foto
                                       </button>
                                   <?php endif; ?>
                               </td>
                           </tr>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>