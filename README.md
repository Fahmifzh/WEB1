# 🍰 SweetSip Studio – Dessert & Drinks Recipe  
## UAS Web 1

---

## 📌 Deskripsi Proyek
**SweetSip Studio** adalah aplikasi web berbasis **PHP dan MySQL** yang digunakan untuk menyimpan, mengelola, dan menampilkan resep makanan serta minuman manis.  
Aplikasi ini dirancang dengan tampilan yang menarik menggunakan **Framework CSS (Bootstrap)** serta menerapkan integrasi **frontend dan backend** dalam satu sistem.

Proyek ini dikembangkan sebagai **Ujian Akhir Semester (UAS)** mata kuliah **Web 1**.

🌐 **Link Website (Hosting):**  
http://agri.web.id

---

## 🎯 Studi Kasus
Berdasarkan pengalaman pribadi penulis dalam mengumpulkan resep makanan dan minuman manis dari media sosial seperti Instagram, TikTok, dan website, resep-resep tersebut umumnya hanya disimpan dalam bentuk bookmark atau tangkapan layar. Hal ini menyebabkan data resep menjadi tidak terorganisir dan sulit dicari kembali.

Oleh karena itu, SweetSip Studio dibuat sebagai solusi untuk menyimpan dan mengelola resep makanan dan minuman manis secara terstruktur dalam satu aplikasi web dengan tampilan yang menarik serta pemisahan hak akses antara admin dan pengguna.

---

## 👥 Role / Aktor dalam Sistem

### 1️⃣ Guest (Pengunjung)
- Mengakses landing page
- Melihat daftar dan detail resep
- Tidak perlu login
- Tidak dapat mengelola data

### 2️⃣ User
- Melakukan register dan login
- Mengakses halaman user
- Menyimpan resep ke menu favorit
- Tidak memiliki akses CRUD data utama

### 3️⃣ Admin
- Login ke sistem melalui halaman admin
- Mengakses dashboard
- Mengelola data resep (CRUD)
- Mengekspor laporan ke format PDF dan Excel

---

## 🔄 Alur Sistem Aplikasi
1. Pengguna mengakses landing page
2. Guest dapat melihat resep tanpa login
3. User melakukan register dan login
4. Admin login melalui halaman admin
5. Sistem melakukan validasi session atau cookie
6. Admin diarahkan ke dashboard
7. Admin mengelola data resep
8. Admin mengekspor laporan PDF dan Excel

---

## 🏗️ Arsitektur Sistem
- **Frontend:** HTML, CSS, Bootstrap
- **Backend:** PHP
- **Database:** MySQL

Frontend berfungsi sebagai antarmuka pengguna, backend menangani logika aplikasi, autentikasi session/cookie, serta pengolahan data, dan database digunakan sebagai media penyimpanan data.

---

## Pemenuhan Ketentuan Proyek UAS

### a. Backend dan Frontend Terintegrasi
Aplikasi mengintegrasikan frontend dan backend dalam satu sistem berbasis web menggunakan PHP dan MySQL.

### b. Dashboard
Sistem menyediakan dashboard admin sebagai pusat pengelolaan dan informasi data resep.

### c. Fitur Register dan Login
Aplikasi menyediakan fitur login untuk admin dan user serta register hanya untuk user.

### d. Laporan (PDF dan Excel)
Admin dapat mengekspor laporan data resep ke dalam format PDF dan Excel di dashboard admin.

Informasi Akses Admin (Khusus Penguji)
Untuk keperluan pengujian fitur laporan (Export PDF & Excel) pada dashboard admin, berikut disediakan akun admin yang dapat digunakan oleh dosen penguji:
- Username: admin
- Password: Sw33t!9xQ#A2v

Akun ini digunakan untuk mengakses dashboard admin, termasuk fitur:
- Pengelolaan data resep (CRUD)
- Ekspor laporan resep ke format PDF dan Excel

Informasi akun ini disediakan hanya untuk keperluan evaluasi dan penilaian UAS.

### e. CRUD (Create, Read, Update, Delete)
Sistem menerapkan fungsi CRUD pada data resep yang dikelola oleh admin.

### f. Session / Cookies
Sistem menerapkan autentikasi menggunakan session dan cookie yang diverifikasi di sisi frontend dan backend.

### g. Studi Kasus Nyata
Proyek dikembangkan berdasarkan kebiasaan nyata dalam menyimpan resep makanan dan minuman dari media sosial.

### h. Hosting Online
Aplikasi telah dihosting dan dapat diakses secara online melalui:
http://agri.web.id

### i. Footer
Setiap halaman aplikasi menampilkan footer dengan format:
@Copyright by 23552011314_Fahmi Fauziah Nur Fadillah_TIF RP 23 CNS A_UASWEB1

---

## 🔗 DOKUMENTASI
- **Link Github:** https://github.com/Fahmifzh/WEB1/
- **Link Drive Dokumentasi:** https://drive.google.com/drive/folders/114kW7Bo3iMNWqoZBOlSRku0bSxvUR7VP?usp=sharing
- **Link Website:** http://agri.web.id
---

## 🧪 Teknologi yang Digunakan
- PHP
- MySQL
- HTML5
- CSS3
- Bootstrap

---

## 👤 Pengembang
**Nama:** Fahmi Fauziah Nur Fadillah  
**Mata Kuliah:** PEMROGRAMAN WEBSITE 1  
**Jenis Proyek:** Ujian Akhir Semester (UAS)
