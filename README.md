# ENHA Water - Web Ordering & Management System 💧📦

**ENHA Water** adalah sistem informasi berbasis web yang dirancang untuk mempermudah pemesanan serta pengelolaan usaha isi ulang air mineral, air minum kemasan gelas, dan gas LPG. Web ini menyediakan antarmuka terpisah untuk pembeli (*buyer*) dan penjual (*seller*), lengkap dengan fitur *chatbot* bantuan interaktif.

---

## 🚀 Fitur Utama

* **Landing Page Interaktif:** Informasi layanan, produk, serta kontak utama usaha.
* **Sistem Pemesanan Online (`order.php`):** Memudahkan pelanggan memesan isi ulang air mineral, air kemasan, dan gas secara langsung.
* **Multi-Role Dashboard:**
  * **Dashboard Pembeli (`buyer_dashboard.php`):** Mengelola riwayat dan memantau status pemesanan.
  * **Dashboard Penjual (`seller_dashboard.php`):** Mengelola pesanan masuk, pembaruan status, dan data transaksi.
* **Fitur Chatbot (`chatbot.php`):** Layanan bantuan otomatis untuk merespons pertanyaan pelanggan.
* **Manajemen Pengguna:** Halaman pendaftaran (*register.php*) dan masuk (*login.php*) yang aman.
* **Form Kontak (`contact.php` & `send_contact.php`):** Fitur pengiriman pesan langsung dari pelanggan ke pengelola.

---

## 🛠️ Teknologi yang Digunakan

* **Frontend:** HTML5, CSS3, JavaScript
* **Backend:** PHP (Native)
* **Database:** MySQL
* **Web Server:** Apache (XAMPP / Laragon / Localhost)

---

## 📁 Struktur Repositori

```text
.
├── css/
│   ├── buyer_dashboard.css   # Styling halaman dashboard pembeli
│   ├── login.css             # Styling halaman login
│   ├── order.css             # Styling halaman pemesanan
│   ├── register.css          # Styling halaman registrasi
│   ├── seller_dashboard.css  # Styling halaman dashboard penjual
│   ├── style.css             # Styling utama website
│   └── styles.css            # Styling tambahan
├── images/                   # Asset gambar & logo
├── includes/                 # Komponen modular PHP (koneksi database, header, footer)
├── js/                       # Script JavaScript interaktif
├── buyer_dashboard.php       # Halaman dashboard khusus pembeli
├── chatbot.php               # Modul chatbot bantuan pelanggan
├── contact.php               # Halaman informasi kontak usaha
├── enha_water.sql            # File dump struktur & data database MySQL
├── index.php                 # Halaman utama (Landing Page)
├── login.php                 # Halaman otentikasi masuk
├── order.php                 # Halaman form pemesanan produk
├── register.php              # Halaman pendaftaran akun baru
├── seller_dashboard.php      # Halaman dashboard khusus penjual/admin
└── send_contact.php          # Handler pemroses pesan kontak
```

---

## 🔧 Panduan Instalasi & Penggunaan

### 1. Pengaturan Database
1. Jalankan **MySQL Server** (via XAMPP, Laragon, atau phpMyAdmin).
2. Buat database baru dengan nama `enha_water`.
3. *Import* file `enha_water.sql` ke dalam database `enha_water` tersebut.

### 2. Pengaturan Web Server
1. Pindahkan folder projek `ENHA_WATER` ke direktori web server kamu:
   * **XAMPP:** `C:/xampp/htdocs/ENHA_WATER`
   * **Laragon:** `C:/laragon/www/ENHA_WATER`
2. Buka *browser* lalu akses websitenya melalui URL:
   ```text
   http://localhost/ENHA_WATER
   ```

---

## 📞 Informasi Usaha (ENHA Water)

* **Layanan:** Isi ulang air mineral, air minum kemasan gelas, dan gas LPG
* **Phone / WhatsApp:** [085799556222](https://wa.me/6285799556222)
* **Alamat:** Jebres, Kec. Jebres, Kota Surakarta, Jawa Tengah 57126

---

## 📝 Catatan & Lisensi

Projek ini dikembangkan untuk mendukung digitalisasi pemesanan pada unit usaha **ENHA Water**.