# Digital Perpustakaan

Digital Perpustakaan adalah sebuah platform manajemen buku berbasis web dengan menggunakan framework laravel. Dalam aplikasi ini terdapat 2 role yaitu "admin" dan "user", hak akses admin adalah full (dapat mengakses/melihat/mengedit/menghapus semua data dari user), sedangkan hak akses user hanya terbatas (mengakses/melihat/mengedit/menghapus data sendiri).

## Instalasi

1. Clone/download repositori ini. (ekstrak jika anda mendownload dengan ekstensi zip)
2. Install dependensi dengan menjalankan `composer install` dan `npm install`.
3. Salin file `.env.example` menjadi `.env` dan atur konfigurasi database.
4. Generate key aplikasi dengan menjalankan `php artisan key:generate`.
5. Jalankan migrasi database dan lakukan seeding dengan `php artisan migrate --seed`.
6. Jalankan server pengembangan dengan `php artisan serve`.
7. Jika gambar tidak muncul, hapus folder `storage` pada path `public` dan jalankan symlink ulang `php artisan storage:link`

## Penggunaan

Gunakan kredensial dibawah ini untuk melihat perbedaan hak akses admin dan user:
Admin:
email: fallahibagaskara@gmail.com
password: 12345678

User:
email: user1@gmail.com
password: 12345678

email: user2@gmail.com
password: 12345678

## Struktur Direktori

- /app              # Kode aplikasi utama
- /config           # Konfigurasi aplikasi
- /database         # Migrasi dan Seeder
- /public           # File publik, seperti CSS, JavaScript, dan gambar
- /resources        # Template dan tampilan
- /routes           # Rute aplikasi
- /storage          # File yang dihasilkan oleh aplikasi (log, file upload, dll.)
- /tests            # Unit dan tes fungsional
- /vendor           # Dependensi eksternal
- /node_modules     # Node.js dependencies
