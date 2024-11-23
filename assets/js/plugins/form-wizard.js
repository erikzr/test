(function () {
    "use strict";
    
    let currentTab = 0;
    const forms = document.getElementsByTagName("form");
    
    const ActiveTab = (n) => {
        if(n==0){
            document.getElementById("account").classList.add("active");
            document.getElementById("account").classList.remove("done");
            document.getElementById("personal").classList.remove("done");
            document.getElementById("personal").classList.remove("active");
        }
        if(n==1){
            document.getElementById("account").classList.add("done");
            document.getElementById("personal").classList.add("active");
            document.getElementById("personal").classList.remove("done");
            document.getElementById("payment").classList.remove("active");
            document.getElementById("payment").classList.remove("done");
            document.getElementById("confirm").classList.remove("done");
            document.getElementById("confirm").classList.remove("active");
        }
        if(n==2){
            document.getElementById("account").classList.add("done");
            document.getElementById("personal").classList.add("done");
            document.getElementById("payment").classList.add("active");
            document.getElementById("payment").classList.remove("done");
            document.getElementById("confirm").classList.remove("done");
            document.getElementById("confirm").classList.remove("active");
        }
        if(n==3){
            document.getElementById("account").classList.add("done");
            document.getElementById("personal").classList.add("done");
            document.getElementById("payment").classList.add("done");
            document.getElementById("confirm").classList.add("active");
            document.getElementById("confirm").classList.remove("done");
        }
    }

    const showTab = (n) => {
        var x = document.getElementsByTagName("fieldset");
        // Sembunyikan semua fieldset terlebih dahulu
        Array.from(x).forEach(fieldset => {
            fieldset.style.display = "none";
        });
        // Tampilkan fieldset yang aktif
        x[n].style.display = "block";
        ActiveTab(n);
    }

    // Fungsi untuk menghapus semua pesan error
    const removeErrorMessages = () => {
        document.querySelectorAll('.error-message').forEach(el => el.remove());
        document.querySelectorAll('.is-invalid').forEach(el => {
            el.classList.remove('is-invalid');
        });
    }

    // Fungsi validasi yang lebih ketat
    const validateFields = (tabIndex) => {
        const currentFieldset = document.getElementsByTagName("fieldset")[tabIndex];
        const inputs = currentFieldset.querySelectorAll('input[required], select[required], textarea[required]');
        let isValid = true;

        // Hapus semua pesan error sebelumnya
        removeErrorMessages();

        inputs.forEach(input => {
            const value = input.value.trim();
            const inputParent = input.parentElement;
            
            // Validasi field kosong
            if (!value) {
                isValid = false;
                showError(input, 'Field ini wajib diisi');
            }
            
            // Validasi email
            else if (input.type === 'email') {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(value)) {
                    isValid = false;
                    showError(input, 'Format email tidak valid');
                }
            }
            
            // Validasi nomor telepon (jika ada)
            else if (input.type === 'tel') {
                const phonePattern = /^[\d\-+()]{10,}$/;
                if (!phonePattern.test(value)) {
                    isValid = false;
                    showError(input, 'Nomor telepon tidak valid');
                }
            }
        });

        return isValid;
    }

    // Fungsi untuk menampilkan pesan error
    const showError = (input, message) => {
        input.classList.add('is-invalid');
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message text-danger small mt-1';
        errorDiv.textContent = message;
        input.parentElement.appendChild(errorDiv);
    }

    const nextBtnFunction = (n) => {
        // Jika tombol next ditekan (n > 0), lakukan validasi
        if (n > 0) {
            const isValid = validateFields(currentTab);
            if (!isValid) {
                // Jika tidak valid, jangan lanjutkan
                return false;
            }
        }

        var x = document.getElementsByTagName("fieldset");
        // Sembunyikan fieldset saat ini
        x[currentTab].style.display = "none";
        
        // Update currentTab
        currentTab = currentTab + n;
        
        // Pastikan currentTab dalam range yang valid
        if (currentTab >= x.length) {
            currentTab = x.length - 1;
            return false;
        }
        if (currentTab < 0) {
            currentTab = 0;
            return false;
        }

        showTab(currentTab);
    }

    // Event listener untuk input fields (validasi realtime)
    const addInputListeners = () => {
        const allInputs = document.querySelectorAll('input[required], select[required], textarea[required]');
        allInputs.forEach(input => {
            input.addEventListener('blur', function() {
                if (!this.value.trim()) {
                    showError(this, 'Field ini wajib diisi');
                } else {
                    this.classList.remove('is-invalid');
                    const errorMessage = this.parentElement.querySelector('.error-message');
                    if (errorMessage) {
                        errorMessage.remove();
                    }
                }
            });

            input.addEventListener('input', function() {
                this.classList.remove('is-invalid');
                const errorMessage = this.parentElement.querySelector('.error-message');
                if (errorMessage) {
                    errorMessage.remove();
                }
            });
        });
    }

    // Event listeners untuk tombol
    const nextbtn = document.querySelectorAll('.next');
    Array.from(nextbtn, (nbtn) => {
        nbtn.addEventListener('click', function(e) {
            e.preventDefault();
            nextBtnFunction(1);
        });
    });

    const prebtn = document.querySelectorAll('.previous');
    Array.from(prebtn, (pbtn) => {
        pbtn.addEventListener('click', function(e) {
            e.preventDefault();
            nextBtnFunction(-1);
        });
    });

    // Inisialisasi
    showTab(currentTab);
    addInputListeners();
})();