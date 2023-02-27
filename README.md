# CodeIgniter 4 Sistem Informasi Manajemen Produksi dan Penjualan


## Installation

- clone this project (git clone https://github.com/ngeline/production-sell.git)
- cd production-sell
- composer install / update sama saja
- rubah file .env, pada bagian database.default.database menjadi db_manajemen
- buka phpmyadmin, buat database dengan nama db_manajemen
- lakukan migrate dengan cara : php spark migrate --all
- selanjutnya ketik php spark db:seed Auth, untuk generate users yang sudah disediakan.

## Login

Login menggunakan akun ADMIN
- email: admin@gmail.com
- password: 123456789

Login menggunakan akun PEGAWAI
- email: pegawai@gmail.com
- password: 123456789

Login menggunakan akun OWNER
- email: owner@gmail.com
- password: 123456789
