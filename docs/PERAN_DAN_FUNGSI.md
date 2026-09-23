# DOKUMENTASI PERAN, TUPOKSI, DAN HAK AKSES PENGGUNA (RBAC)
## Sistem Informasi & Learning Management System (LMS) Terpadu
### Program Studi Sistem Informasi — Universitas Kebangsaan Republik Indonesia (UKRI)

---

## 1. Pendahuluan & Prinsip Pemisahan Tugas (*Separation of Duties*)

Sistem Informasi Terpadu UKRI menerapkan arsitektur **Role-Based Access Control (RBAC)** berbasis **Filament v3** dan **Spatie Permission**. 

Setiap peran dirancang dengan **Tugas Pokok dan Fungsi (Tupoksi) yang berbeda dan spesifik**, sehingga saat pengguna masuk (*login*), antarmuka navigasi yang tampil hanya berisi menu yang relevan dengan tanggung jawabnya. Hal ini bertujuan untuk:
1. **Mencegah Kesalahan (*Human Error*)**: Mencegah staf mengubah atau menghapus data di luar wewenangnya (misalnya: editor berita tidak sengaja menyunting kurikulum).
2. **Efisiensi Kerja**: Antarmuka bersih, fokus, dan tidak membingungkan.
3. **Keamanan & Akuntabilitas**: Jejak pengubahan data terisolasi sesuai unit kerja terkait.

---

## 2. Ringkasan Akun Pengujian Bawaan (*Default Seeder*)

Untuk keperluan pengujian lokal, sistem telah menyediakan akun contoh untuk setiap peran melalui `RolePermissionSeeder`:

| No | Peran (*Role*) | Panel Akses | URL Akses | Email Akun | Kata Sandi Bawaan | Tupoksi Singkat |
|:---|:---|:---|:---|:---|:---|:---|
| 1 | **Super Admin** | Admin & CMS Portal | `/superadmin` | `superadmin@ukri.ac.id` | `password` | **Otoritas Sistem, Manajemen User & Konfigurasi** |
| 2 | **Admin Akademik** | Admin & CMS Portal | `/superadmin` | `akademik@ukri.ac.id` | `password` | **Kurikulum, Mata Kuliah, Dosen, & Data Siswa (Mhs)** |
| 3 | **Admin Kemahasiswaan** | Admin & CMS Portal | `/superadmin` | `kemahasiswaan@ukri.ac.id` | `password` | **Ormawa HIMA, Alumni (Tracer Study), & Inbox** |
| 4 | **Editor Konten** | Admin & CMS Portal | `/superadmin` | `humas@ukri.ac.id` | `password` | **Berita, Publikasi Mitra, & Konten Landing Page** |
| 5 | **Dosen** | LMS Dosen Pengajar | `/dosen` | `dosen@ukri.ac.id` | `password` | **Pengajaran Kelas, Materi, & Penilaian Tugas** |
| 6 | **Mahasiswa** | LMS & Portal Mhs | `/mahasiswa` | `mahasiswa@ukri.ac.id` | `password` | **Mengikuti Kuliah, Unduh Materi, & Kirim Tugas** |

> **Catatan:** Halaman login tunggal di `/login` secara otomatis mengarahkan pengguna ke panel yang tepat sesuai peran akun yang digunakan.

---

## 3. Rincian Tupoksi Masing-Masing Peran

### 1. Super Admin (Administrator Tunggal Sistem & IT)
* **Tupoksi Utama:** Bertanggung jawab atas kelaikan teknis portal, keamanan sistem, pembuatan akun, dan konfigurasi master website.
* **Menu & Modul yang Dikelola:**
  - **Manajemen Pengguna (*Users*)**: Mendaftarkan akun dosen, staf, dan mahasiswa serta menetapkan perannya.
  - **Peran & Izin (*Roles & Permissions*)**: Mengatur struktur grup hak akses sistem.
  - **Pengaturan Situs**: Mengonfigurasi kontak resmi prodi, tautan PMB, visi-misi, dan identitas kampus.
  - **Latar Belakang Login**: Mengatur foto slideshow carousel, gradasi warna, dan efek visual halaman login.
  - *Catatan:* Super Admin dibebaskan dari input perkuliahan harian agar fokus pada pemeliharaan teknis sistem.

---

### 2. Admin Akademik (Tupoksi: Kurikulum, Dosen, & Data Mahasiswa/Siswa)
* **Tupoksi Utama:** Mengelola seluruh aspek akademik formal prodi, kurikulum pendidikan tinggi, profil dosen pengajar, kalender akademik, serta **pengelolaan data mahasiswa (siswa) dan pendaftaran perkuliahan (KRS)**.
* **Menu & Modul yang Dikelola:**
  - **Mata Kuliah & Silabus**: Menambah kode MK, nama mata kuliah, bobot SKS, semester penawaran, dan silabus RPS.
  - **Kelompok Keahlian Dosen (KK)**: Mengelompokkan dosen berdasarkan bidang kepakaran keilmuan.
  - **Dosen & Tenaga Pengajar**: Mengelola data profil dosen, gelar, NIDN/NIP, dan riwayat pengajaran.
  - **Kalender Akademik**: Mengatur jadwal registrasi, periode KRS, masa perkuliahan, dan jadwal UTS/UAS.
  - **Data Mahasiswa (Siswa)**: Mengelola rekam data mahasiswa aktif, registrasi NPM/NIM, dan status akademik.
  - **KRS Enrollment & Kelas**: Mengatur pembagian rombel kelas perkuliahan dan memvalidasi pendaftaran mata kuliah mahasiswa.
  - **Akreditasi & Sejarah Prodi**: Memperbarui status sertifikat akreditasi (BAN-PT/LAM INFOKOM) dan profil sejarah.

---

### 3. Admin Kemahasiswaan (Tupoksi: Ormawa, Prestasi, Alumni, & Layanan Tamu)
* **Tupoksi Utama:** Fokus pada pembinaan kegiatan non-akademik mahasiswa, keorganisasian himpunan (HIMA), pelacakan alumni, pencatatan prestasi lomba, serta menindaklanjuti pertanyaan calon mahasiswa dari formulir kontak.
* **Menu & Modul yang Dikelola:**
  - **Pengurus HIMA**: Mengelola struktur kepengurusan ormawa Himpunan Mahasiswa Sistem Informasi.
  - **Kegiatan HIMA**: Mendokumentasikan agenda kegiatan, program kerja, dan event kemahasiswaan.
  - **Prestasi Mahasiswa**: Mendaftarkan capaian kejuaraan kompetisi akademik maupun non-akademik tingkat regional hingga internasional.
  - **Alumni & Tracer Study**: Mendata lulusan, riwayat masa tunggu kerja, tempat bekerja, dan testimoni alumni.
  - **Pesan Masuk Tamu (*Inbox*)**: Membaca dan menindaklanjuti pesan formulir dari calon mahasiswa/publik di landing page.
  - **Data Mahasiswa**: Memiliki akses *Read-Only* untuk memvalidasi status keaktifan mahasiswa yang ikut HIMA/lomba.

---

### 4. Editor Konten / Humas (Tupoksi: Berita & Publikasi Landing Page)
* **Tupoksi Utama:** Khusus bertanggung jawab memproduksi artikel berita, pengumuman, dan materi publikasi visual yang tampil di **Landing Page utama SI-UKRI**.
* **Menu & Modul yang Dikelola:**
  - **Berita & Pengumuman**: Menulis artikel kegiatan, mengunggah foto dokumentasi beresolusi baik, menyunting siaran pers, dan mempublikasikan pengumuman resmi.
  - **Kerja Sama & Kemitraan**: Mengelola logo mitra industri, kampus rekanan, dan instansi yang bekerja sama dengan prodi.
  - **Prestasi Mahasiswa**: Memiliki akses *Read-Only* untuk mengambil data prestasi sebagai bahan penulisan artikel berita.
  - *Batasan:* Disembunyikan sepenuhnya dari data kurikulum, nilai, KRS, dan pengaturan akun.

---

### 5. Dosen (Tupoksi: Tenaga Pengajar LMS)
* **Tupoksi Utama:** Melaksanakan proses pembelajaran digital (LMS) interaktif pada kelas mata kuliah yang diampu.
* **Menu & Modul yang Dikelola (Panel `/dosen`):**
  - **Kelas Perkuliahan**: Melihat kelas-kelas yang diampu pada semester berjalan.
  - **Materi Pertemuan**: Mengunggah modul bahan ajar (PDF/PPT), video pembelajaran, dan instruksi perkuliahan per minggu.
  - **Tugas Kuliah**: Membuat tugas, menetapkan tenggat waktu (*deadline*), dan kriteria penilaian.
  - **Penilaian Tugas**: Memeriksa berkas yang diunggah mahasiswa serta memberikan nilai dan catatan perbaikan.
  - **Daftar Mahasiswa**: Melihat daftar presensi mahasiswa yang mengambil kelas tersebut.

---

### 6. Mahasiswa (Tupoksi: Peserta Didik LMS & Akademik)
* **Tupoksi Utama:** Mengikuti perkuliahan daring, mengakses modul materi, dan mengumpulkan tugas akademik.
* **Menu & Modul yang Dikelola (Panel `/mahasiswa`):**
  - **Kelas Perkuliahan**: Melihat jadwal dan ruang kelas mata kuliah yang dikontrak.
  - **Materi Belajar**: Membaca dan mengunduh bahan materi yang diunggah oleh dosen pengampu.
  - **Pengumpulan Tugas (*Submission*)**: Mengunggah file tugas sebelum batas waktu berakhir dan melihat status pengumpulan.
  - **Evaluasi & Nilai**: Melihat hasil nilai tugas dan umpan balik (*feedback*) dari dosen.

---

## 4. Matriks Perizinan Akses Modul Berdasarkan Tupoksi

Keterangan simbol:
- **CRUD** : Hak Akses Penuh (*Create, Read, Update, Delete*)
- **CRU**  : Buat, Lihat, Edit (*Tanpa Izin Hapus*)
- **R**    : Hanya Melihat (*Read-Only*)
- **-**    : Tidak Ada Akses / Modul Disembunyikan

| Kategori Modul | Nama Resource / Modul | Super Admin | Admin Akademik | Admin Kemahasiswaan | Editor Konten | Dosen (LMS) | Mahasiswa (LMS) |
|:---|:---|:---:|:---:|:---:|:---:|:---:|:---:|
| **Sistem & IT** | Manajemen Pengguna (*Users*) | **CRUD** | - | - | - | - | - |
| | Peran & Izin (*Roles & Permissions*) | **CRUD** | - | - | - | - | - |
| | Pengaturan Situs & Kontak Master | **CRUD** | - | - | - | - | - |
| | Latar Belakang Login (Carousel) | **CRUD** | - | - | - | - | - |
| **Akademik & Kurikulum**| Mata Kuliah & Silabus RPS | **CRUD** | **CRUD** | - | - | - | - |
| | Kelompok Keahlian Dosen (KK) | **CRUD** | **CRUD** | - | - | - | - |
| | Dosen & Tenaga Pengajar | **CRUD** | **CRUD** | - | - | - | - |
| | Kalender Akademik & Jadwal | **CRUD** | **CRUD** | - | - | - | - |
| | Akreditasi & Sejarah Prodi | **CRUD** | **CRUD** | - | - | - | - |
| **Data Siswa & Kelas** | **Data Mahasiswa (Siswa)** | **CRUD** | **CRUD** | **R** (Validasi) | - | **R** (Kelasnya)| **R** (Diri) |
| | **KRS Enrollment & Kelas Kuliah** | **CRUD** | **CRUD** | - | - | **R** (Kelasnya)| **R** (KRS Diri)|
| **Kemahasiswaan & Alumni**| Organisasi & Pengurus HIMA | **CRUD** | - | **CRUD** | - | - | - |
| | Agenda Kegiatan HIMA | **CRUD** | - | **CRUD** | - | - | - |
| | Alumni & Tracer Study | **CRUD** | - | **CRUD** | - | - | - |
| | Prestasi Mahasiswa | **CRUD** | **R** | **CRUD** | **R** (Bahan Berita)| - | - |
| | Pesan Masuk Tamu (*Inbox*) | **CRUD** | - | **CRUD** | - | - | - |
| **Publikasi Landing Page**| Berita & Pengumuman | **CRUD** | - | - | **CRUD** | - | - |
| | Kerja Sama & Kemitraan (Logo) | **CRUD** | **R** | - | **CRUD** | - | - |
| **LMS Perkuliahan**| Materi Pertemuan Kuliah | **CRUD** | **CRUD** | - | - | **CRUD** (Kelasnya)| **R** |
| | Tugas Perkuliahan | **CRUD** | **CRUD** | - | - | **CRUD** (Kelasnya)| **R** |
| | Pengumpulan Tugas Siswa | **CRUD** | **R** | - | - | **CRU** (Beri Nilai)| **CRU** (Kumpul)|

---

## 5. Panduan Menambah Pengguna Sesuai Tupoksi (Super Admin)

1. Masuk ke panel Super Admin di `http://localhost:8000/superadmin`.
2. Buka menu **Peran dan Izin ➔ Users**.
3. Klik tombol **Buat Pengguna Baru** (*New User*).
4. Masukkan Nama, Email resmi UKRI, dan Password.
5. **Centang 1 Peran yang sesuai dengan Tupoksinya**:
   - Berikan `Admin Akademik` untuk bagian kurikulum, dosen, & data siswa perkuliahan.
   - Berikan `Admin Kemahasiswaan` untuk pembina himpunan, tracer study, & prestasi.
   - Berikan `Editor Konten` untuk staf publikasi berita landing page.
   - Berikan `Dosen` untuk tenaga pendidik LMS.
   - Berikan `Mahasiswa` untuk peserta didik LMS.
6. Klik **Simpan**. Ketika pengguna tersebut masuk, sistem otomatis hanya menampilkan modul yang sesuai dengan tugasnya.

---

*Dokumentasi ini disinkronkan langsung dengan Policy & RBAC terpasang pada SI-UKRI.*
