// Fungsi untuk validasi form pemeriksaan oli
function validatePemeriksaanOli() {
    const fieldset = document.getElementById('fieldset-pemeriksaan-oli');
    const radioGroups = {
        'oli_mesin': false,
        'oli_power_steering': false,
        'oli_transmisi': false,
        'minyak_rem': false
    };
    const photoInputs = {
        'oli_mesin_foto': false,
        'oli_power_steering_foto': false,
        'oli_transmisi_foto': false,
        'minyak_rem_foto': false
    };
    
    let isValid = true;
    // Hapus pesan error yang ada
    const existingErrors = fieldset.querySelectorAll('.error-message');
    existingErrors.forEach(error => error.remove());

    // Validasi Radio Buttons
    Object.keys(radioGroups).forEach(name => {
        const radioButtons = fieldset.querySelectorAll(`input[name="${name}"]`);
        const checked = Array.from(radioButtons).some(radio => radio.checked);
        if (!checked) {
            isValid = false;
            const radioGroup = radioButtons[0].closest('.radio-group');
            const error = document.createElement('div');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.fontSize = '12px';
            error.style.marginTop = '5px';
            error.textContent = 'Pilih salah satu opsi';
            radioGroup.appendChild(error);
        }
    });

    // Validasi File Inputs
    Object.keys(photoInputs).forEach(id => {
        const fileInput = document.getElementById(id);
        const preview = document.getElementById(`preview_${id.replace('_foto', '')}`);
        
        if (!fileInput.files.length || !preview.src) {
            isValid = false;
            const error = document.createElement('div');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.fontSize = '12px';
            error.style.marginTop = '5px';
            error.textContent = 'Foto harus diambil';
            fileInput.parentElement.appendChild(error);
        }
    });

    return isValid;
}

// Event listener untuk tombol next
document.querySelector('#fieldset-pemeriksaan-oli .next').addEventListener('click', function(e) {
    e.preventDefault();
    
    if (validatePemeriksaanOli()) {
        // Jika valid, lanjut ke step berikutnya
        // Implementasi navigasi ke step berikutnya di sini
        console.log('Form valid, lanjut ke step berikutnya');
    } else {
        // Scroll ke error pertama
        const firstError = document.querySelector('#fieldset-pemeriksaan-oli .error-message');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
});

// CSS untuk styling error dan validasi
const style = document.createElement('style');
style.textContent = `
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 5px;
        animation: fadeIn 0.3s;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group.has-error {
        border-color: #dc3545 !important;
    }

    .form-control.has-error {
        border-color: #dc3545 !important;
    }
`;
document.head.appendChild(style);

// Fungsi untuk validasi form pemeriksaan penerangan
function validatePemeriksaanPenerangan() {
    const fieldset = document.getElementById('fieldset-pemeriksaan-penerangan');
    const radioGroups = {
        'lampu_utama': false,
        'lampu_sein': false,
        'lampu_rem': false,
        'lampu_klakson': false
    };
    const photoInputs = {
        'lampu_utama_foto': false,
        'lampu_sein_foto': false,
        'lampu_rem_foto': false,
        'lampu_klakson_foto': false
    };
    
    let isValid = true;
    
    // Hapus pesan error yang ada
    const existingErrors = fieldset.querySelectorAll('.error-message');
    existingErrors.forEach(error => error.remove());

    // Reset border style
    const formGroups = fieldset.querySelectorAll('.form-group');
    formGroups.forEach(group => {
        group.style.borderColor = '#e0e0e0';
    });

    // Validasi Radio Buttons
    Object.keys(radioGroups).forEach(name => {
        const radioButtons = fieldset.querySelectorAll(`input[name="${name}"]`);
        const checked = Array.from(radioButtons).some(radio => radio.checked);
        if (!checked) {
            isValid = false;
            const radioGroup = radioButtons[0].closest('.radio-group');
            const formGroup = radioButtons[0].closest('.form-group');
            
            // Tambah border merah
            formGroup.style.borderColor = '#dc3545';
            
            // Tambah pesan error
            const error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'Pilih salah satu kondisi';
            radioGroup.appendChild(error);
        }
    });

    // Validasi File Inputs
    Object.keys(photoInputs).forEach(id => {
        const fileInput = document.getElementById(id);
        const preview = document.getElementById(`preview_${id.replace('_foto', '')}`);
        const inputGroup = fileInput.closest('.input-image');
        
        if (!fileInput.files.length || !preview.src) {
            isValid = false;
            const formGroup = fileInput.closest('.form-group');
            
            // Tambah border merah
            formGroup.style.borderColor = '#dc3545';
            
            // Tambah pesan error
            const error = document.createElement('div');
            error.className = 'error-message';
            error.textContent = 'Foto harus diambil';
            inputGroup.appendChild(error);
        }
    });

    // Tampilkan toast notification jika ada error
    if (!isValid) {
        showToast('Periksa kembali form anda', 'Semua field harus diisi dengan lengkap', 'error');
    }

    return isValid;
}

// Event listener untuk tombol next
document.querySelector('#fieldset-pemeriksaan-penerangan .next').addEventListener('click', function(e) {
    e.preventDefault();
    
    if (validatePemeriksaanPenerangan()) {
        // Jika valid, lanjut ke step berikutnya
        console.log('Form valid, lanjut ke step berikutnya');
        // Implementasi navigasi ke step berikutnya di sini
    } else {
        // Scroll ke error pertama
        const firstError = document.querySelector('#fieldset-pemeriksaan-penerangan .error-message');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
});

// Fungsi untuk menampilkan toast notification
function showToast(title, message, type = 'error') {
    const toastContainer = document.createElement('div');
    toastContainer.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        max-width: 350px;
    `;
    
    const toast = document.createElement('div');
    toast.className = `toast ${type === 'error' ? 'bg-danger' : 'bg-success'} text-white`;
    toast.style.cssText = `
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        margin-bottom: 10px;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    `;
    
    toast.innerHTML = `
        <div class="toast-header bg-transparent text-white">
            <strong class="me-auto">${title}</strong>
            <button type="button" class="btn-close btn-close-white" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
        <div class="toast-body">
            ${message}
        </div>
    `;
    
    toastContainer.appendChild(toast);
    document.body.appendChild(toastContainer);
    
    // Tampilkan toast dengan animasi
    setTimeout(() => {
        toast.style.opacity = '1';
    }, 100);
    
    // Hilangkan toast setelah 5 detik
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => {
            toastContainer.remove();
        }, 300);
    }, 5000);
}

// CSS untuk styling error dan validasi
const style = document.createElement('style');
style.textContent = `
    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .form-group {
        transition: border-color 0.3s ease-in-out;
    }

    .form-group.has-error {
        border-color: #dc3545 !important;
    }

    .input-image {
        transition: border-color 0.3s ease-in-out;
    }

    .toast {
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from { transform: translateX(100%); }
        to { transform: translateX(0); }
    }
`;
document.head.appendChild(style);