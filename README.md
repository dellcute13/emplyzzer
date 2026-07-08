# 📊 Emplyzer - SAW Method Employee Performance Evaluation System

Emplyzer adalah platform web modern Sistem Pendukung Keputusan (SPK) untuk penilaian kinerja pegawai berbasis metode **Simple Additive Weighting (SAW)**. Aplikasi ini mempermudah manajemen SDM (HRD) dalam melakukan evaluasi pegawai secara objektif berdasarkan 11 kriteria kualitatif dan kuantitatif.

---

## 🛠️ Tech Stack & Arsitektur
- **Backend Framework**: Laravel 11
- **Frontend Core**: Tailwind CSS, Alpine.js
- **Assets Bundler**: Vite (Built & Optimized assets)
- **Database**: MySQL / MariaDB
- **State Management**: Reactive JavaScript getters/setters via Alpine Store
- **Date Utilities**: Carbon (Localised for Indonesian Language `id`)

---

## 📐 Alur & Rumus Metode Simple Additive Weighting (SAW)

Metode SAW sering juga dikenal dengan istilah metode penjumlahan terbobot. Konsep dasar metode SAW adalah mencari penjumlahan terbobot dari rating kinerja pada setiap alternatif (pegawai) pada semua atribut/kriteria.

### Langkah 1: Penentuan Kriteria & Bobot ($W$)
Sistem mendukung 11 Kriteria penilaian ($C_1$ s/d $C_{11}$) dengan masing-masing bobot kepentingan ($W_j$) dan sifat atribut:
- **Benefit (Keuntungan)**: Semakin tinggi nilai evaluasi, semakin baik (Contoh: Absensi, Produktivitas).
- **Cost (Biaya)**: Semakin rendah nilai evaluasi, semakin baik (Contoh: Komplain Pelanggan, Tingkat Kesalahan).

### Langkah 2: Matriks Keputusan ($X$)
Membentuk matriks keputusan berdasarkan nilai kinerja alternatif ($A_i$) pada setiap kriteria ($C_j$):

$$X = \begin{pmatrix}
x_{11} & x_{12} & \dots & x_{1n} \\
x_{21} & x_{22} & \dots & x_{2n} \\
\vdots & \vdots & \ddots & \vdots \\
x_{m1} & x_{m2} & \dots & x_{mn}
\end{pmatrix}$$

### Langkah 3: Normalisasi Matriks ($R$)
Normalisasi nilai rating kinerja dilakukan dengan membandingkan nilai kinerja alternatif dengan nilai terbaik (Max/Min) pada kriteria terkait:

- **Kriteria Benefit ($benefit$)**:
  $$r_{ij} = \frac{x_{ij}}{\text{max}(x_{ij})}$$

- **Kriteria Cost ($cost$)**:
  $$r_{ij} = \frac{\text{min}(x_{ij})}{x_{ij}}$$

*Dimana:*
- $r_{ij}$ adalah nilai rating kinerja ternormalisasi.
- $\text{max}(x_{ij})$ adalah nilai terbesar dari setiap kolom kriteria benefit.
- $\text{min}(x_{ij})$ adalah nilai terkecil dari setiap kolom kriteria cost.

### Langkah 4: Perhitungan Nilai Preferensi ($V$)
Menghitung nilai preferensi akhir untuk setiap alternatif ($V_i$) dengan menjumlahkan hasil perkalian matriks ternormalisasi ($R$) dengan bobot kriteria ($W$):

$$V_i = \sum_{j=1}^{n} w_j \cdot r_{ij}$$

Alternatif dengan nilai preferensi $V_i$ terbesar dinobatkan sebagai pegawai dengan kinerja terbaik (peringkat 1).

---

## 🌟 Fitur Utama Aplikasi

### 1. 🔍 General Search Navbar
Pencarian serbaguna di navigasi atas yang terintegrasi dengan AJAX dan Alpine.js:
- Mencari data pegawai secara dinamis berdasarkan nama atau NIP.
- Mencari divisi / departemen dan posisi jabatan.
- Menu navigasi pintas yang responsif.

### 2. 📝 Input Nilai Pegawai Dinamis
Formulir input penilaian pegawai interaktif:
- Pemilihan kandidat pegawai via Autocomplete & Periodik secara real-time.
- Slider & Input Box dinamis sinkron untuk mengisi **11 parameter kriteria (C1-C11)**.
- Kartu Profil Ringkasan Karyawan di sisi kanan untuk validasi identitas fisik sebelum penyimpanan.

### 3. ⚙️ Proses Perhitungan SAW Transparan
Menyediakan halaman kalkulasi step-by-step interaktif:
- **Matriks Keputusan (X)**: Menampilkan nilai mentah awal seluruh pegawai.
- **Matriks Ternormalisasi (R)**: Menampilkan konversi nilai benefit/cost.
- **Matriks Terbobot & Rangking**: Menghitung preferensi akhir secara detail.
- **Fitur Simulasi Auto-Seed**: Membantu uji coba dengan menghasilkan data evaluasi simulasi instan.

### 4. 🏆 Podium & Hasil Perankingan
Visualisasi performa peringkat pegawai:
- Podium 3 Besar (Emas, Perak, Perunggu) dengan avatar dinamis.
- Tabel peringkat detail lengkap dengan nilai preferensi final dan kesimpulan kinerja.

### 5. 📂 Pusat Laporan & Dokumen Kontrol
- **Bento Grid Stats**: Informasi jumlah laporan, laporan terbaru, dan divisi terbaik berbasis SAW.
- **Visual Analytics**: Grafik persentase rata-rata performa kinerja antar divisi secara real-time.
- **Pop-up Preview Modal**: Menampilkan pratinjau lembar laporan fisik (Verified by System).
- **Download Manager**: Mengunduh berkas laporan (PDF/Excel) secara langsung melalui antarmuka web.

### 6. 🔔 Log Aktivitas Notifikasi Drawer
Notifikasi dinamis di pojok kanan atas yang merekam riwayat aktivitas terbaru sistem (seperti penambahan pegawai, penginputan penilaian, dan penerbitan laporan baru).

---

## 🚀 Panduan Instalasi Lokal

### 1. Clone Project
```bash
git clone https://github.com/username/emplyzzer.git
cd emplyzzer
```

### 2. Install Dependensi PHP & JS
```bash
composer install
npm install
```

### 3. Konfigurasi Environment File
Salin berkas `.env.example` menjadi `.env` lalu sesuaikan kredensial database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=emplyzzer
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate App Key & Jalankan Migrasi Database
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Compile Aset & Jalankan Server Lokal
Jalankan dev server Laravel:
```bash
php artisan serve
```
Dan jalankan Vite Bundler (dalam terminal terpisah):
```bash
npm run dev
# Atau untuk versi production build
npm run build
```

---
*Dibuat dengan 💻 & ☕ untuk efisiensi evaluasi kinerja perusahaan yang transparan.*
