# Belajar Login CRUD PHP Native

Project sederhana untuk latihan ujian:
1. Koneksi database
2. Form registrasi
3. Form login
4. Session
5. Logout
6. Halaman admin CRUD

## Struktur

```text
belajar_login_crud/
├── database.sql
├── koneksi.php
├── register.php
├── login.php
├── admin.php
├── logout.php
└── README.md
```

## Cara menjalankan

### 1. Buat database

Buka phpMyAdmin, pilih menu SQL, lalu jalankan seluruh isi `database.sql`.

### 2. Simpan project

Untuk XAMPP:

```text
C:/xampp/htdocs/belajar_login_crud
```

Untuk Laragon:

```text
C:/laragon/www/belajar_login_crud
```

### 3. Cek koneksi

Default `koneksi.php`:

- Host: localhost
- User: root
- Password: kosong
- Database: belajar_login

Jika konfigurasi MySQL kamu berbeda, ubah bagian tersebut.

### 4. Buka website

```text
http://localhost/belajar_login_crud/register.php
```

### 5. Alur

```text
register.php
    ↓
users database
    ↓
login.php
    ↓
session
    ↓
admin.php
    ↓
CREATE / READ / UPDATE / DELETE
    ↓
logout.php
```

## CRUD

- Create = INSERT
- Read = SELECT
- Update = UPDATE
- Delete = DELETE

## Catatan

Password registrasi menggunakan `password_hash()` dan login menggunakan `password_verify()`.
Project ini dibuat sederhana untuk latihan dan bukan template produksi.
