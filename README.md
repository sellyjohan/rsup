# User Management App (Technical Test)

Aplikasi web sederhana berbasis CodeIgniter 3 dengan fitur login, role-based access, CRUD user dan artikel, serta upload file.

## 🔧 Teknologi
- CodeIgniter 3 (PHP)
- MySQL
- CSS murni (tanpa framework)
- JavaScript
- JWT untuk autentikasi API

## 📸 Screenshot

### Halaman Login
Tampilan halaman login awal dengan ReCaptcha

![Login Screenshot](login_page.png)

Validasi field username dan password

![Login Field Validation Screenshot](login_without_password_or_username.png)

Validasi ketika berusaha login tanpa ReCaptcha

![Login ReCaptcha Validation Screenshot](login_without_recaptcha.png)

### Dashboard
Halaman Dashboard awal ketika berhasil login

![Dashboard Screenshot](dashboard_page.png)

### Halaman Maintenance User
Halaman Maintenance User bagian atas, halaman maintenance user ini hanya bisa diakses dengan login role admin

![Halaman User Screenshot](user_page_1.png)

Halaman Maintenance User bagian bawah

![Halaman User Screenshot](user_page_2.png)

Tampilan tambah User

![Tambah User Screenshot](add_user.png)

Validasi field ketika hendak menambahkan User

![Validasi Field Tambah User Screenshot](add_user_validation.png)

Validasi field email apakah email yang valid atau tidak

![Validasi Field Email Screenshot](add_user_email_validation.png)

### Halaman Maintenance Artikel
Halaman Artikel dengan login sebagai admin, ada fitur tambah artikel, edit artikel, dan hapus artikel

![Halaman Artikel Login Admin Screenshot](artikel_page.png)

Halaman Artikel dengan login sebagai editor, hanya ada tambah dan edit artikel tanpa hapus

![Halaman Artikel Login Editor Screenshot](artikel_page_login_editor.png)

Halaman artikel dengan login sebagai user, user hanya bisa melihat tanpa bisa action apapun

![Halaman Artikel Login User Screenshot](artikel_page_login_user.png)

Halaman tambah artikel

![Tambah Artikel Screenshot](add_artikel.png)

Validasi apakah type file yang diupload sesuai, yakni pdf atau Images

![Validasi Type File Tambah Artikel Screenshot](add_artikel_file_type_validation.png)

Validasi besar file yang diupload tidak boleh lebih dari 2mb
![Validasi Size File Tambah Artikel Screenshot](add_artikel_size_validation.png)

### Other
Halaman yang muncul ketika role tertentu mencoba akses halaman yang tidak diberi akses

![Access Denied Screenshot](access_denied.png)

Ketika ingin memanggil API tapi tidak menyertakan Token yang didapat setelah login maka akan ditolak

![Calling API without Token Screenshot](call_api_without_token.png)

Ketika ingin memanggil API tapi menggunakan Token dari login role yang tidak sesuai maka akan ditolak
![Calling API using Unauthorized Role Screenshot](call_api_using_unauthorized_role.png)

## 💡 Fitur
- Login & Logout dengan ReCaptcha
- Role-based access (Admin, Editor, User)
- CRUD User
- CRUD Artikel + Upload File (PDF/Images)
- Paginasi, Search
- RESTful API dengan autentikasi token menggunakan JWT

## 🗃️ Database

File schema database bisa ditemukan di:  
`/database/rsup_db.sql`  
Silakan import ke MySQL sebelum menjalankan aplikasi.

Atau gunakan tool seperti phpMyAdmin / DBeaver untuk import struktur database.

## ⚙️ Cara Menjalankan
1. Clone repo ini:
   ```bash
   git clone https://github.com/sellyjohan/rsup.git```
   
2. Buat database MySQL dan import database/rsup_db.sql

3. Konfigurasi koneksi DB di application/config/database.php

4. Jalankan server lokal (XAMPP)

5. Akses via browser http://localhost/rsup/

 
