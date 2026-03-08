<p align="center">
<img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/laravel-logolockup-red.svg" width="220" alt="Laravel Logo">
</p>

<h1 align="center">Sistem Toko </h1>

<p align="center">
Aplikasi e-commerce berbasis <b>Laravel</b> & <b>Filament Admin</b>
</p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-Framework-red">
<img src="https://img.shields.io/badge/Filament-Admin-blue">
<img src="https://img.shields.io/badge/PHP-8.x-purple">
<img src="https://img.shields.io/badge/License-MIT-green">
</p>

---

---
## Preview Aplikasi
![Preview Aplikasi](final.png)

---
## 🚀 Fitur Utama

✅ Manajemen Produk  
✅ Sistem Keranjang Belanja  
✅ Checkout satu item & massal  
✅ Pengurangan stok otomatis  
✅ Panel admin menggunakan Filament  
✅ Sistem verifikasi pembelian  

---

## 🛒 Modul Keranjang

Fitur keranjang memungkinkan pengguna:

- menambahkan produk ke keranjang
- melihat isi keranjang
- checkout produk
- validasi stok otomatis
- transaksi database untuk menjaga konsistensi data

---


## 📦 Instalasi

```bash
git clone https://github.com/username/nama-project.git
cd nama-project
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
npm install && npm run build
php artisan serve
