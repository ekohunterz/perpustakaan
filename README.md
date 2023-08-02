
# Aplikasi Perpustakaan Sekolah

Selamat datang di aplikasi Perpustakaan Sekolah! Aplikasi ini adalah sebuah sistem manajemen perpustakaan yang dibangun untuk membantu sekolah dalam mengelola dan mengatur koleksi buku serta peminjaman buku oleh siswa.


## Tech Stack

- Laravel 10
- SQL
- Jquery
- Mazer Admin Dashboard by [Saugi](https://saugi.me/projects)


## Fitur
1. User Role:
- Admin
- Staff
- Kepsek
- Siswa

2. Kelola Buku
- Tambah, edit, dan hapus buku
- List daftar buku beserta informasi detailnya.
- Peminjaman Buku
- Pengembalian buku 

3. Kelola User
- List Member dan Staff
- Tambah User
- Edit User
- Hapus User

4. Kelola Kelas
- List Kelas
- Tambah Kelas
- Edit Kelas
- Hapus Kelas

5. Kelola Kategori
- List Kategori
- Tambah Kategori
- Edit Kategori
- Hapus Kategori

6. Laporan
- Cetak Laporan Peminjaman Buku
- Cetak Laporan Pengunjung Perpustakaan

7. Pengaturan
- Pengaturan Perpustakaan
- Pengaturan Denda
- Pengaturan Profil



## Installation

Spesifikasi

- PHP ^8.1
- Laravel 10.x
- Database MySQL atau MariaDB

Cara Instal:

1. Pastikan Anda telah menginstal PHP, MySQL, dan web server seperti Apache.
2. Clone repositori ini ke direktori web server Anda.
```bash
  git clone https://github.com/ekohunterz/perpustakaan.git
```
3. Salin file .env.example menjadi .env dan sesuaikan konfigurasi database Anda.
```bash
  cd perpustakaan
  cp .env.example .env
```
4. Jalankan perintah composer install untuk menginstal dependensi PHP.
```bash
  composer install
```
5. Jalankan perintah ```phpartisan key:generate``` untuk menghasilkan kunci aplikasi.
6. Buat database pada mysql untuk aplikasi ini
7. Setting database pada file ```.env```
8. Jalankan perintah ```php artisan migrate --seed``` untuk membuat tabel-tabel database.
9. Jalankan perintah ```php artisan serve``` dan ```npm run dev``` untuk menjalankan aplikasi.
10. Akses aplikasi melalui browser Anda.



    
## License

[MIT](https://choosealicense.com/licenses/mit/)

