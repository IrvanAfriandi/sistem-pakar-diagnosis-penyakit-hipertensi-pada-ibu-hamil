🩺 Sistem Pakar Diagnosa Penyakit (Laravel)
Ini adalah project Laravel untuk sistem pakar diagnosa penyakit dengan fitur role pengguna admin dan petugas, serta pengelolaan data seperti pasien, penyakit, gejala, basis pengetahuan, dan riwayat konsultasi.

✅ Cara Menjalankan Project
Ikuti langkah-langkah berikut untuk menjalankan sistem ini secara lokal:

1. Clone Repository
bash
Copy
Edit
git clone https://github.com/username/nama-project.git
cd nama-project
2. Install Dependency
Pastikan kamu sudah menginstall composer.

bash
Copy
Edit
composer install
3. Salin File .env
bash
Copy
Edit
cp .env.example .env
4. Atur Konfigurasi Database
Buka file .env, dan sesuaikan bagian berikut sesuai pengaturan MySQL lokal kamu:

env
Copy
Edit
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
Pastikan database tersebut sudah dibuat di MySQL kamu.

5. Generate Key Aplikasi
bash
Copy
Edit
php artisan key:generate
6. Jalankan Migrasi Database
bash
Copy
Edit
php artisan migrate
7. Jalankan Seeder untuk Buat Admin & Petugas
bash
Copy
Edit
php artisan db:seed --class=AdminSeeder
Seeder ini akan membuat:

Admin
Email: admin123@gmail.com
Password: admin1234

Petugas
Email: petugas123@gmail.com
Password: petugas1234

8. Jalankan Server
bash
Copy
Edit
php artisan serve
Akses aplikasi di: http://127.0.0.1:8000

🛠 Fitur Utama
Manajemen Data Pasien

Manajemen Penyakit & Gejala

Manajemen Basis Pengetahuan

Riwayat Konsultasi

Role-based Access Control (Admin dan Petugas)

📌 Catatan
Petugas tidak dapat mengakses menu: Data Admin, Data Pasien, dan Riwayat Konsultasi.

Pastikan koneksi database dan konfigurasi sudah benar sebelum menjalankan migrasi.