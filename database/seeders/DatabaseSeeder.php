<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\KelompokKeahlian;
use App\Models\DosenStaf;
use App\Models\MataKuliah;
use App\Models\KalenderAkademik;
use App\Models\Prestasi;
use App\Models\Alumni;
use App\Models\Berita;
use App\Models\KerjaSama;
use App\Models\Akreditasi;
use App\Models\Sejarah;
use App\Models\HimaPengurus;
use App\Models\HimaKegiatan;
use App\Models\PengaturanSitus;
use App\Models\PesanKontak;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        // 1. Kelompok Keahlian (KBK)
        $kbkEnterprise = KelompokKeahlian::create([
            'nama' => 'Enterprise Systems & ERP',
            'deskripsi' => 'Fokus pada tata kelola teknologi informasi perusahaan, integrasi arsitektur sistem skala enterprise, dan manajemen modul ERP (SAP/Oracle).',
            'capaian_pembelajaran' => 'Mampu merancang, menganalisis, dan mengimplementasikan tata kelola IT serta solusi sistem terintegrasi skala enterprise.',
            'prospek_karier' => 'ERP Consultant, IT Auditor, Enterprise Architect, Systems Analyst.',
            'ikon' => 'heroicon-o-building-office',
        ]);

        $kbkData = KelompokKeahlian::create([
            'nama' => 'Data Science & Artificial Intelligence',
            'deskripsi' => 'Fokus pada pemrosesan data besar (Big Data), algoritma machine learning, prediktif analytics, dan visualisasi Business Intelligence.',
            'capaian_pembelajaran' => 'Mampu mengolah data tak terstruktur, membangun model prediksi cerdas, dan menyusun dashboard keputusan bisnis.',
            'prospek_karier' => 'Data Scientist, Data Engineer, Machine Learning Engineer, BI Developer.',
            'ikon' => 'heroicon-o-cpu-chip',
        ]);

        $kbkProduct = KelompokKeahlian::create([
            'nama' => 'Digital Product Design & Software',
            'deskripsi' => 'Fokus pada pengembangan aplikasi web dan mobile modern, UI/UX research, Agile project management, serta DevOps deployment.',
            'capaian_pembelajaran' => 'Mampu membangun produk digital yang responsif, teruji usability-nya, dan siap pakai secara publik.',
            'prospek_karier' => 'Fullstack Web Developer, Mobile App Developer, UI/UX Designer, Product Manager.',
            'ikon' => 'heroicon-o-device-phone-mobile',
        ]);

        // 2. Dosen & Staf
        $dosenData = [
            [
                'nama' => 'Dr. Ir. Ahmad Sudrajat, M.T.',
                'nidn' => '0412087501',
                'jabatan' => 'Lektor Kepala',
                'jabatan_struktural' => 'Kepala Program Studi',
                'bidang_keahlian' => 'Enterprise Architecture & IT Governance',
                'riwayat_pendidikan' => 'S1 Teknik Informatika ITB, S2 Teknik Elektro ITB, S3 Sistem Informasi University of Malaya.',
                'kelompok_keahlian_id' => $kbkEnterprise->id,
                'urutan_struktural' => 1,
            ],
            [
                'nama' => 'Siti Rahmawati, M.Kom., Ph.D.',
                'nidn' => '0419058202',
                'jabatan' => 'Lektor',
                'jabatan_struktural' => 'Sekretaris Program Studi',
                'bidang_keahlian' => 'Big Data Mining & Natural Language Processing',
                'riwayat_pendidikan' => 'S1 Ilmu Komputer UI, S2 Magister Teknologi Informasi UI, S3 Data Science Kyushu University.',
                'kelompok_keahlian_id' => $kbkData->id,
                'urutan_struktural' => 2,
            ],
            [
                'nama' => 'Budi Santoso, S.T., M.Sc.',
                'nidn' => '0422118803',
                'jabatan' => 'Lektor',
                'jabatan_struktural' => 'Kepala Laboratorium Software',
                'bidang_keahlian' => 'Cloud Computing & Microservices Architecture',
                'riwayat_pendidikan' => 'S1 Teknik Elektro UKRI, S2 Computer Science University of Manchester.',
                'kelompok_keahlian_id' => $kbkProduct->id,
                'urutan_struktural' => 3,
            ],
            [
                'nama' => 'Dina Fitriani, M.T.',
                'nidn' => '0405019004',
                'jabatan' => 'Asisten Ahli',
                'jabatan_struktural' => 'Koordinator Kerja Sama & Pembina Kemahasiswaan',
                'bidang_keahlian' => 'User Experience Research & Interaction Design',
                'riwayat_pendidikan' => 'S1 Sistem Informasi Telkom University, S2 Desain Komunikasi Visual ITB.',
                'kelompok_keahlian_id' => $kbkProduct->id,
                'urutan_struktural' => 4,
            ],
            [
                'nama' => 'Hendra Setiawan, M.Kom.',
                'nidn' => '0415068905',
                'jabatan' => 'Asisten Ahli',
                'jabatan_struktural' => 'Dosen Pengajar & Pembimbing Skripsi',
                'bidang_keahlian' => 'Database Optimization & Data Warehousing',
                'riwayat_pendidikan' => 'S1 Teknik Informatika UNPAD, S2 Magister Komputer UNIKOM.',
                'kelompok_keahlian_id' => $kbkData->id,
                'urutan_struktural' => 5,
            ],
        ];

        foreach ($dosenData as $d) {
            DosenStaf::create($d);
        }

        // 3. Mata Kuliah
        $mkData = [
            ['kode' => 'SI101', 'nama' => 'Pengantar Sistem Informasi', 'sks' => 3, 'semester' => 1, 'sifat' => 'Wajib', 'prasyarat' => null, 'kelompok_keahlian_id' => $kbkEnterprise->id],
            ['kode' => 'SI102', 'nama' => 'Algoritma & Pemrograman I', 'sks' => 4, 'semester' => 1, 'sifat' => 'Wajib', 'prasyarat' => null, 'kelompok_keahlian_id' => $kbkProduct->id],
            ['kode' => 'SI103', 'nama' => 'Matematika Diskrit', 'sks' => 3, 'semester' => 1, 'sifat' => 'Wajib', 'prasyarat' => null, 'kelompok_keahlian_id' => $kbkData->id],
            ['kode' => 'SI201', 'nama' => 'Sistem Basis Data Enterprise', 'sks' => 4, 'semester' => 2, 'sifat' => 'Wajib', 'prasyarat' => 'SI101', 'kelompok_keahlian_id' => $kbkData->id],
            ['kode' => 'SI202', 'nama' => 'Pemrograman Web Dasar (HTML/CSS/JS)', 'sks' => 3, 'semester' => 2, 'sifat' => 'Wajib', 'prasyarat' => 'SI102', 'kelompok_keahlian_id' => $kbkProduct->id],
            ['kode' => 'SI301', 'nama' => 'Analisis & Perancangan Sistem Informasi', 'sks' => 4, 'semester' => 3, 'sifat' => 'Wajib', 'prasyarat' => 'SI201', 'kelompok_keahlian_id' => $kbkEnterprise->id],
            ['kode' => 'SI302', 'nama' => 'Pemrograman Berorientasi Objek', 'sks' => 3, 'semester' => 3, 'sifat' => 'Wajib', 'prasyarat' => 'SI102', 'kelompok_keahlian_id' => $kbkProduct->id],
            ['kode' => 'SI401', 'nama' => 'Data Science & Machine Learning', 'sks' => 4, 'semester' => 4, 'sifat' => 'Wajib', 'prasyarat' => 'SI201', 'kelompok_keahlian_id' => $kbkData->id],
            ['kode' => 'SI402', 'nama' => 'Desain Interface & UX Research', 'sks' => 3, 'semester' => 4, 'sifat' => 'Wajib', 'prasyarat' => 'SI202', 'kelompok_keahlian_id' => $kbkProduct->id],
            ['kode' => 'SI501', 'nama' => 'Enterprise Resource Planning (ERP)', 'sks' => 3, 'semester' => 5, 'sifat' => 'Pilihan KBK', 'prasyarat' => 'SI301', 'kelompok_keahlian_id' => $kbkEnterprise->id],
            ['kode' => 'SI502', 'nama' => 'Big Data Analytics', 'sks' => 3, 'semester' => 5, 'sifat' => 'Pilihan KBK', 'prasyarat' => 'SI401', 'kelompok_keahlian_id' => $kbkData->id],
            ['kode' => 'SI601', 'nama' => 'Audit & Tata Kelola IT (COBIT 2019)', 'sks' => 3, 'semester' => 6, 'sifat' => 'Wajib', 'prasyarat' => 'SI301', 'kelompok_keahlian_id' => $kbkEnterprise->id],
            ['kode' => 'SI701', 'nama' => 'Metodologi Penelitian & Skripsi I', 'sks' => 2, 'semester' => 7, 'sifat' => 'Wajib', 'prasyarat' => null, 'kelompok_keahlian_id' => null],
            ['kode' => 'SI801', 'nama' => 'Skripsi / Tugas Akhir', 'sks' => 6, 'semester' => 8, 'sifat' => 'Wajib', 'prasyarat' => 'SI701', 'kelompok_keahlian_id' => null],
        ];

        foreach ($mkData as $mk) {
            MataKuliah::create($mk);
        }

        // 4. Kalender Akademik
        $kalenderData = [
            ['judul_kegiatan' => 'Pengisian KRS Online Semester Ganjil 2026/2027', 'tanggal_mulai' => '2026-08-18', 'tanggal_selesai' => '2026-08-30', 'keterangan' => 'Bimbingan Dosen Wali & Approval SIAKAD', 'tahun_akademik' => '2026/2027 Ganjil'],
            ['judul_kegiatan' => 'Awal Perkuliahan Semester Ganjil TA 2026/2027', 'tanggal_mulai' => '2026-09-01', 'tanggal_selesai' => null, 'keterangan' => 'Pertemuan Minggu Ke-1 Perkuliahan Tatap Muka', 'tahun_akademik' => '2026/2027 Ganjil'],
            ['judul_kegiatan' => 'Ujian Tengah Semester (UTS) Ganjil', 'tanggal_mulai' => '2026-10-19', 'tanggal_selesai' => '2026-10-30', 'keterangan' => 'Pelaksanaan UTS Online / Offline', 'tahun_akademik' => '2026/2027 Ganjil'],
            ['judul_kegiatan' => 'Ujian Akhir Semester (UAS) Ganjil', 'tanggal_mulai' => '2026-12-21', 'tanggal_selesai' => '2027-01-08', 'keterangan' => 'Evaluasi Pembelajaran Akhir Semester', 'tahun_akademik' => '2026/2027 Ganjil'],
            ['judul_kegiatan' => 'Wisuda Gelombang I Universitas Kebangsaan RI', 'tanggal_mulai' => '2027-02-15', 'tanggal_selesai' => null, 'keterangan' => 'Pelantikan Kelulusan SarjanaKomputer S1', 'tahun_akademik' => '2026/2027 Genap'],
        ];

        foreach ($kalenderData as $k) {
            KalenderAkademik::create($k);
        }

        // 5. Prestasi
        $prestasiData = [
            ['judul' => 'Juara 1 Gemastik XIX Category Data Mining', 'nama_mahasiswa' => 'Tim Data Analytics UKRI (Rizky, Farah, Kevin)', 'tahun' => 2026, 'kategori' => 'Nasional', 'deskripsi' => 'Pengembangan model AI deteksi dini banjir berbasis data sensor IoT kawasan DAS Citarum.'],
            ['judul' => 'Juara 2 Hackathon National Tech Summit Telkom', 'nama_mahasiswa' => 'Muhammad Arifin', 'tahun' => 2026, 'kategori' => 'Nasional', 'deskripsi' => 'Solusi aplikasi Supply Chain Logistik berbasis Mobile Flutter untuk UMKM Jawa Barat.'],
            ['judul' => 'Best Paper Award International Conference on Information Systems', 'nama_mahasiswa' => 'Nabila Putri & Dr. Ahmad Sudrajat', 'tahun' => 2025, 'kategori' => 'Internasional', 'deskripsi' => 'Publikasi ilmiah bereputasi Scopus Q2 mengenai tata kelola arsitektur ERP BUMN.'],
        ];

        foreach ($prestasiData as $p) {
            Prestasi::create($p);
        }

        // 6. Alumni
        $alumniData = [
            ['nama' => 'Rian Hidayat, S.Kom.', 'angkatan' => 2019, 'posisi_karier' => 'Senior ERP Consultant - PT Telkom Sigma', 'testimoni' => 'Kurikulum ERP dan Data Science di SI UKRI sangat aplikatif dengan dunia kerja aktual. Hanya dalam 1 bulan pasca lulus saya langsung diterima sebagai SAP Consultant.'],
            ['nama' => 'Nabila Putri, S.Kom.', 'angkatan' => 2020, 'posisi_karier' => 'Data Scientist - Bank Mandiri Pusat', 'testimoni' => 'Bimbingan dosen dan fasilitas laboratorium AI sangat mendukung riset skripsi saya hingga menembus jurnal internasional.'],
            ['nama' => 'Farhan Pratama, S.Kom.', 'angkatan' => 2021, 'posisi_karier' => 'UI/UX Designer - Tokopedia', 'testimoni' => 'Proyek mata kuliah yang berbasis riset produk nyata membekali portofolio saya secara profesional.'],
        ];

        foreach ($alumniData as $a) {
            Alumni::create($a);
        }

        // 7. Berita
        $beritaData = [
            [
                'judul' => 'Program Studi SI UKRI Selenggarakan Seminar Nasional Artificial Intelligence & Enterprise Solution 2026',
                'slug' => 'seminar-nasional-ai-enterprise-2026',
                'kategori' => 'Akademik',
                'isi' => '<p>Bandung — Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia (UKRI) bertempat di Aula Utama Kampus menggelar Seminar Nasional bertajuk "Peran Artificial Intelligence dan Enterprise Systems dalam Mengakselerasi Digital Inovasi Indonesia 2030".</p><p>Acara ini dihadiri oleh ratusan mahasiswa, praktisi IT BUMN, akademisi, serta peneliti dari berbagai perguruan tinggi nasional.</p>',
                'tanggal_publikasi' => '2026-08-10',
                'is_penting' => true,
                'penulis' => 'Humas SI UKRI',
            ],
            [
                'judul' => 'Tim Mahasiswa SI UKRI Raih Medali Emas Kompetisi Data Analytics Tingkat Nasional',
                'slug' => 'juara-gemastik-data-analytics-2026',
                'kategori' => 'Prestasi',
                'isi' => '<p>Mahasiswa Program Studi Sistem Informasi UKRI kembali menorehkan prestasi gemilang di kancah nasional dengan meraih Medali Emas pada kategori Data Mining di perhelatan Gemastik 2026.</p>',
                'tanggal_publikasi' => '2026-08-05',
                'is_penting' => true,
                'penulis' => 'Divisi Kemahasiswaan',
            ],
            [
                'judul' => 'Penandatanganan MOU Magang Industri & Sertifikasi Profesi dengan Telkom Indonesia',
                'slug' => 'penandatanganan-mou-magang-telkom-2026',
                'kategori' => 'Kemitraan',
                'isi' => '<p>Program Studi Sistem Informasi UKRI resmi menandatangani kerja sama magang MBKM dan sertifikasi profesi internasional bersama PT Telkom Indonesia Tbk.</p>',
                'tanggal_publikasi' => '2026-08-01',
                'is_penting' => false,
                'penulis' => 'Tim Kerjasama',
            ],
        ];

        foreach ($beritaData as $b) {
            Berita::create($b);
        }

        // 8. Kerja Sama
        $kerjaSamaData = [
            ['nama_mitra' => 'PT Telkom Indonesia Tbk', 'bentuk_kerja_sama' => 'Industri Teknologi', 'deskripsi' => 'Program Magang MBKM 6 Bulan & Sertifikasi Network/Cloud.'],
            ['nama_mitra' => 'Oracle Academy Indonesia', 'bentuk_kerja_sama' => 'Akademik', 'deskripsi' => 'Lisensi kurikulum resmi Oracle Database & Java Programming.'],
            ['nama_mitra' => 'SAP University Alliances', 'bentuk_kerja_sama' => 'Industri Teknologi', 'deskripsi' => 'Sertifikasi modul ERP SAP Fundamentals untuk mahasiswa.'],
            ['nama_mitra' => 'AWS Educate Program', 'bentuk_kerja_sama' => 'Industri Teknologi', 'deskripsi' => 'Penyediaan laboratorium Cloud Computing & DevOps.'],
        ];

        foreach ($kerjaSamaData as $ks) {
            KerjaSama::create($ks);
        }

        // 9. Akreditasi History
        $akreditasiData = [
            [
                'jenis' => 'Sarjana (S1) Sistem Informasi',
                'lembaga' => 'BAN-PT Kemendikbudristek',
                'peringkat' => 'Terakreditasi Minimum',
                'tahun' => 2017,
                'masa_berlaku' => '2017 s.d. 2020',
                'no_sk' => 'SK Kemendikbudristek No. 412/KPT/I/2017',
                'deskripsi' => 'Penyelenggaraan awal Program Studi Sistem Informasi Universitas Kebangsaan Republik Indonesia dengan izin operasional resmi.',
                'file_sertifikat' => 'sertifikat-akreditasi-2017.pdf',
            ],
            [
                'jenis' => 'Sarjana (S1) Sistem Informasi',
                'lembaga' => 'BAN-PT Kemendikbudristek',
                'peringkat' => 'B (Baik)',
                'tahun' => 2020,
                'masa_berlaku' => '2020 s.d. 2023',
                'no_sk' => 'SK BAN-PT No. 2841/SK/BAN-PT/Akred/S/V/2020',
                'deskripsi' => 'Peningkatan kualifikasi mutu kurikulum berbasis OBE, pengembangan laboratorium Data Analytics, dan fasilitas pembelajaran modern.',
                'file_sertifikat' => 'sertifikat-akreditasi-2020.pdf',
            ],
            [
                'jenis' => 'Sarjana (S1) Sistem Informasi',
                'lembaga' => 'BAN-PT Kemendikbudristek',
                'peringkat' => 'A / Unggul',
                'tahun' => 2023,
                'masa_berlaku' => '2023 s.d. 2028',
                'no_sk' => 'SK BAN-PT No. 4281/SK/BAN-PT/Akred/S/X/2023',
                'deskripsi' => 'Raihan standar kualifikasi mutakhir akreditasi tingkat nasional dengan predikat Unggul (A) oleh Badan Akreditasi Nasional Perguruan Tinggi.',
                'file_sertifikat' => 'sertifikat-akreditasi-2023.pdf',
            ],
        ];

        foreach ($akreditasiData as $akred) {
            Akreditasi::create($akred);
        }

        // 10. Sejarah
        $sejarahData = [
            ['tahun' => 2017, 'judul_peristiwa' => 'Izin Operasional & Pendirian Prodi', 'deskripsi' => 'Resmi memperoleh izin pengelenggaraan Kemendikbudristek RI No. 412/KPT/I/2017.'],
            ['tahun' => 2020, 'judul_peristiwa' => 'Peresmian Laboratorium Data Science & AI', 'deskripsi' => 'Pengadaan infrastruktur laboratorium analisis data berkinerja tinggi.'],
            ['tahun' => 2023, 'judul_peristiwa' => 'Raihan Akreditasi A (Unggul) BAN-PT', 'deskripsi' => 'Mencapai kualifikasi mutakhir akreditasi tingkat nasional dengan predikat Unggul.'],
        ];

        foreach ($sejarahData as $s) {
            Sejarah::create($s);
        }

        // 11. HIMA Pengurus
        $himaData = [
            ['nama' => 'Aditya Pratama', 'jabatan' => 'Ketua Himpunan (Kahim)', 'periode' => '2026/2027'],
            ['nama' => 'Siti Nurhaliza', 'jabatan' => 'Wakil Ketua Himpunan', 'periode' => '2026/2027'],
            ['nama' => 'Dwi Handoko', 'jabatan' => 'Kepala Divisi Ristek', 'periode' => '2026/2027'],
        ];

        foreach ($himaData as $hp) {
            HimaPengurus::create($hp);
        }

        // 12. HIMA Kegiatan
        HimaKegiatan::create([
            'judul' => 'SI-CODE Hackathon & Competitive Programming 2026',
            'deskripsi' => 'Kompetisi tahunan koding mahasiswa Sistem Informasi se-Jawa Barat.',
            'tanggal' => '2026-07-20',
        ]);

        // 13. Pengaturan Situs
        $settings = [
            ['key' => 'telepon', 'value' => '(022) 7315175', 'group' => 'kontak'],
            ['key' => 'email', 'value' => 'si@ukri.ac.id', 'group' => 'kontak'],
            ['key' => 'alamat', 'value' => 'Jl. Terusan Halimun No.37, Lengkong, Kota Bandung, Jawa Barat 40263', 'group' => 'kontak'],
            ['key' => 'visi', 'value' => 'Menjadi Program Studi Sistem Informasi yang Unggul di Tingkat Nasional dalam Pengembangan Sistem Informasi Enterprise dan Analytics Berwawasan Kebangsaan pada Tahun 2030.', 'group' => 'general'],
        ];

        foreach ($settings as $st) {
            PengaturanSitus::create($st);
        }

        // 14. Pesan Kontak
        PesanKontak::create([
            'nama' => 'Budi Gunawan',
            'email' => 'budigunawan@gmail.com',
            'subjek' => 'Informasi Beasiswa PMB 2026',
            'pesan' => 'Mohon informasi alur pendaftaran beasiswa kebangsaan untuk prodi SI UKRI.',
            'is_read' => true,
        ]);
    }
}
