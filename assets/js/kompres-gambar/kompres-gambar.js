// Tambahkan script ini ke file HTML Anda
console.log('Script kompresi gambar berhasil dimuat');
const kompresGambar = {
    maxLebar: 1920,
    maxTinggi: 1080,
    kualitas: 0.7,
    
    showLoading: function() {
        if (!document.getElementById('loading-overlay')) {
            const loading = document.createElement('div');
            loading.id = 'loading-overlay';
            loading.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            `;
            
            const spinner = document.createElement('div');
            spinner.innerHTML = 'Sedang memproses gambar...';
            spinner.style.cssText = `
                background: white;
                padding: 20px;
                border-radius: 5px;
                text-align: center;
            `;
            
            loading.appendChild(spinner);
            document.body.appendChild(loading);
        } else {
            document.getElementById('loading-overlay').style.display = 'flex';
        }
    },

    hideLoading: function() {
        const loading = document.getElementById('loading-overlay');
        if (loading) {
            loading.style.display = 'none';
        }
    },

    // Fungsi untuk log data form
    logFormData: function(formData) {
        console.log('Data yang akan dikirim:');
        for (let pair of formData.entries()) {
            console.log(pair[0] + ': ' + (pair[1] instanceof File ? pair[1].name : pair[1]));
        }
    },
    
    kompres: async function(file) {
        if (!file || !file.type.startsWith('image/')) {
            return file;
        }

        const gambar = new Image();
        const pembaca = new FileReader();

        return new Promise((resolve, reject) => {
            pembaca.onload = (e) => {
                gambar.src = e.target.result;
                gambar.onload = () => {
                    let lebar = gambar.width;
                    let tinggi = gambar.height;
                    const rasio = Math.min(
                        this.maxLebar / lebar,
                        this.maxTinggi / tinggi
                    );

                    if (rasio < 1) {
                        lebar = Math.round(lebar * rasio);
                        tinggi = Math.round(tinggi * rasio);
                    }

                    const canvas = document.createElement('canvas');
                    canvas.width = lebar;
                    canvas.height = tinggi;
                    const ctx = canvas.getContext('2d');

                    ctx.drawImage(gambar, 0, 0, lebar, tinggi);
                    
                    canvas.toBlob(
                        (blob) => {
                            const fileKompres = new File([blob], file.name, {
                                type: 'image/jpeg',
                                lastModified: Date.now()
                            });
                            resolve(fileKompres);
                        },
                        'image/jpeg',
                        this.kualitas
                    );
                };
            };
            pembaca.onerror = reject;
            pembaca.readAsDataURL(file);
        });
    },

    handleSubmit: async function(formElement) {
        try {
            this.showLoading();
            console.log('Mulai proses submit form');
            
            // Buat FormData baru
            const form = new FormData();
            
            // Ambil semua input dari form
            const inputs = formElement.querySelectorAll('input, select, textarea');
            
            // Proses setiap input
            for (const input of inputs) {
                if (!input.name) continue;

                if (input.type === 'file') {
                    const file = input.files[0];
                    if (file) {
                        console.log(`Memproses file: ${input.name}`);
                        const compressedFile = await this.kompres(file);
                        form.append(input.name, compressedFile);
                    }
                }
                else if (input.type === 'checkbox' || input.type === 'radio') {
                    if (input.checked) {
                        form.append(input.name, input.value);
                    }
                }
                else if (input.value) {
                    form.append(input.name, input.value);
                }
            }
//eriiik
            // Log data sebelum dikirim
            this.logFormData(form);
            
            // Log URL tujuan
            console.log('Submit ke URL:', formElement.action);
            
            const response = await fetch(formElement.action, {
                method: 'POST',
                body: form,
                credentials: 'include'
            });
    
            console.log('Response status:', response.status);
    
            if (!response.ok) {
                const errorText = await response.text();
                console.error('Error response:', errorText);
                throw new Error(`Gagal mengirim data: ${response.status}`);
            }
    
            // Redirect dengan protokol yang sama
            const currentProtocol = window.location.protocol;
            const redirectUrl = formElement.action.replace('proses_form.php', 'form-wizard asli.php')
                .replace('http:', currentProtocol)
                .replace('https:', currentProtocol);
                
            console.log('Redirect ke:', redirectUrl);
            window.location.href = redirectUrl;
            
        } catch (error) {
            console.error('Error detail:', error);
            alert('Terjadi kesalahan saat mengirim data: ' + error.message);
        } finally {
            this.hideLoading();
        }
    }
};

// Event listener untuk form
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('vehicle-check-form');
    if (form) {
        console.log('Form ditemukan');
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            console.log('Form disubmit');
            await kompresGambar.handleSubmit(this);
        });
    } else {
        console.error('Form tidak ditemukan!');
    }
});

// Event listener untuk preview gambar
document.addEventListener('change', function(e) {
    if (e.target.type === 'file') {
        const file = e.target.files[0];
        if (file && file.type.startsWith('image/')) {
            const preview = document.querySelector(`[data-preview="${e.target.name}"]`);
            if (preview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    }
});