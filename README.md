Berikut adalah versi README yang diperbarui sesuai dengan permintaan Anda, dengan menyesuaikan bahwa tidak ada fitur notifikasi, dan hanya admin yang perlu login.

---

# Website Pengecekan Kendaraan Harian

Website ini digunakan untuk mencatat dan mengecek kondisi kendaraan setiap hari. Sistem ini dapat membantu memastikan kendaraan dalam kondisi yang baik sebelum digunakan, serta mendokumentasikan riwayat perawatan dan pemeriksaan kendaraan.

## Fitur

- **Pencatatan Harian:** Admin dapat mencatat kondisi kendaraan setiap hari, termasuk pengecekan mesin, ban, oli, dan komponen lainnya.
- **Riwayat Pemeriksaan:** Menyimpan data riwayat pemeriksaan untuk setiap kendaraan yang dapat diakses kapan saja oleh admin.
- **Laporan Kondisi:** Menghasilkan laporan kondisi kendaraan berdasarkan data yang tercatat.

## Teknologi yang Digunakan

- **Frontend:** HTML, CSS, JavaScript
- **Backend:** PHP
- **Database:** MySQL

## Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/username/repo-name.git
   ```
   
2. **Instalasi Dependensi**
   - Pastikan server web (misalnya XAMPP, WAMP, atau LAMP) sudah terinstal dan berjalan.
   - Pindahkan folder project ke dalam direktori `htdocs` (untuk XAMPP) atau direktori root server lainnya.

3. **Setup Database**
   - Buat database baru di MySQL.
   - Import file SQL yang terdapat di folder `/database` ke dalam database yang baru dibuat.
   
4. **Konfigurasi**
   - Edit file `config.php` dan sesuaikan pengaturan database (`DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`).

5. **Menjalankan Aplikasi**
   - Akses aplikasi melalui browser dengan URL: `http://localhost/nama-folder-project`.

## Penggunaan

1. **Login Admin:**
   - Hanya admin yang perlu login untuk mengelola dan mencatat kondisi kendaraan. Tidak ada registrasi atau login untuk pengguna biasa.
   
2. **Pengecekan Kendaraan:**
   - Admin dapat melakukan pengecekan kendaraan dengan mengisi formulir yang tersedia setelah login.
   
3. **Melihat Riwayat:**
   - Admin dapat melihat riwayat pengecekan kendaraan di halaman riwayat.

## Kekeliruan yang Diketahui


## Kontribusi

Kontribusi sangat diterima! Anda dapat mengikuti langkah-langkah berikut:

1. Fork repository ini.
2. Buat branch baru (`git checkout -b fitur-baru`).
3. Commit perubahan Anda (`git commit -am 'Menambahkan fitur baru'`).
4. Push ke branch tersebut (`git push origin fitur-baru`).
5. Buat Pull Request.

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT - lihat file `LICENSE` untuk detail lebih lanjut.

## Kontak

Jika ada pertanyaan atau masalah, silakan hubungi: [email@example.com](mailto:muhammaderikzubairrohman@gmail.com)

---

Silakan sesuaikan README ini dengan detail tambahan atau penyesuaian spesifik sesuai proyek Anda!