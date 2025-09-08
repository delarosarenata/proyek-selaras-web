-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Sep 2025 pada 09.01
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penilaian_pelayanan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_tamus`
--

CREATE TABLE `buku_tamus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `profesi` varchar(255) DEFAULT NULL,
  `deskripsi_pekerjaan` text DEFAULT NULL,
  `pendidikan` varchar(255) DEFAULT NULL,
  `layanan_dibutuhkan` varchar(255) DEFAULT NULL,
  `detail_layanan` text DEFAULT NULL,
  `pemanfaatan` varchar(255) DEFAULT NULL,
  `tanggal_layanan` date DEFAULT NULL,
  `sarana` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `buku_tamus`
--

INSERT INTO `buku_tamus` (`id`, `timestamp`, `nama_lengkap`, `nomor_hp`, `email`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `profesi`, `deskripsi_pekerjaan`, `pendidikan`, `layanan_dibutuhkan`, `detail_layanan`, `pemanfaatan`, `tanggal_layanan`, `sarana`, `created_at`, `updated_at`) VALUES
(1, '2025-01-14 01:34:05', 'Suryanti Bachtiar', '085298430511', 'imunpinrang@gmail.com', 'Perempuan', 'Pinrang,Sulawesi Selatan', '1978-05-22', 'ASN', 'Wasor Imunisasi Dinkes Pinrang', 'S2', 'Konsultasi Statistik', 'Data Anak Sekolah Kelas 1.2.3 5 dan 6 SD dan Anak SMP kelas 1.2.3 ', 'Perencanaan', '2025-01-14', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(2, '2025-01-14 01:35:45', 'Hanapiah, S. Kep, Ns', '085242094763', 'hanapiahpia84@gmail.com', 'Perempuan', 'Bittoeng, Pinrang Sulawesi Selatan', '1983-09-27', 'ASN', 'Staf di Puskesmas Bungi', 'S1/D4', 'Konsultasi Statistik', 'Data Penduduk Kabupaten Pinrang 2023-2024', 'Bekerja', '2025-01-14', 'Website BPS (bps.go.id) / AllStats BPS', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(3, '2025-01-20 03:40:11', 'Hendrawan. B', '085398370390', 'x.hendrawan.cyber@gmail.com', 'Laki-laki', 'Pinrang', '1989-09-28', 'Pekerja BUMN Bank BRI', 'Petugas Penunjang Bisnis', 'S1/D4', 'Perpustakaan, Konsultasi Statistik', 'Data Penduduk Pinrang Tahun 2024, Data Jumlah Penduduk dan KK per Kelurahan/Desa di Kabupaten Pinrang se detail mungkin bila ada.', 'Penelitian, Perencanaan, Evaluasi, Diskusi', '2025-01-20', 'Pelayanan Statistik Terpadu (PST) datang langsung, Pelayanan Statistik Terpadu online (pst.bps.go.id), Website BPS (bps.go.id) / AllStats BPS, Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(4, '2025-01-30 02:30:54', 'MULYADI', '081355035752', 'dady.bhuceq@gmail.com', 'Laki-laki', 'Pinrang,sulawesi selatan', '1980-05-18', 'Honorer', 'Honorer di kantor camat suppa', 'S1/D4', 'Konsultasi Statistik', 'Data penduduk Kecamatan suppa (suppa dalam angka) ', 'Bekerja', '2025-01-30', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(5, '2025-02-03 07:03:21', 'Erni, S.Sos', '081342276686', 'ernhidjnisacis@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '1982-02-06', 'ASN', 'Penelaah teknis kebijakan sekaligus ketua tim kerja kelembagaan dan analisis jabatan pada bagian organisasi sekretariat daerah kabupaten pinrang', 'S1/D4', 'Rekomendasi Kegiatan Statistik', 'Permintaan indeks kesulitan geografis kabupaten pinrang', 'Bekerja', '2025-03-02', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(6, '2025-02-11 03:01:14', 'Nur fajrianti', '08884712429', 'nur.fajrianti17@gmail.com', 'Perempuan', 'Pinrang,sulawesi selatan', '1997-08-23', 'Honor Kesehatan', 'Imunisasi dinas kesehatan kab.pinrang', 'S1/D4', 'Konsultasi Statistik', 'Berapa persen penduduk Usia 60tahun  ke atas ( dalam % )kabupaten pinrang 2024', 'Permintaan data Kemenkes', '2025-02-11', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(7, '2025-02-11 06:44:53', 'Suci Amriaty Thamrin, SE', '089656636047', 'suciamriaty.ip@gmail.com', 'Perempuan', 'Pinrang', '1994-06-07', 'Pelajar/Mahasiswa', 'Mahasiswa Universitas Hasanuddin', 'S1/D4', 'Konsultasi Statistik', 'Data UMKM Kab.Pinrang 2020-2023', 'Skripsi/Tesis/Disertasi', '2025-02-11', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(8, '2025-02-21 07:08:18', 'MUHAMMAD ANUGERAH RUSTAN', '‪+62 877‑8162‑8510‬', 'anugerahmuhammad02@gmail.com', 'Laki-laki', 'pinrang sulawesi selatan', '2002-06-30', 'Peneliti', 'mahasiswa di universitas muhammadiyah pare ', '<= SMA', 'Konsultasi Statistik', 'data PDRB 2024', 'Penelitian', '2025-02-21', 'Website BPS (bps.go.id) / AllStats BPS', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(9, '2025-02-25 01:24:01', 'Asmaul Husna ', '082311736402', 'husnaasaja02@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan ', '2025-02-09', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Muhammadiyah Barru ', '<= SMA', 'Konsultasi Statistik', 'Data penduduk Pinrang tahun 2024 berdasarkan golongan penghasilan atau golongan pendapatan penduduk kabupaten Pinrang berdasarkan penggolongan tahun 2024', 'Skripsi/Tesis/Disertasi, Penelitian', '2025-02-26', 'Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(10, '2025-02-25 02:43:39', 'Bagian Pemerintahan Setda Kab. Pinrang ', '085256367768', 'sariapriliyawati@gmail.com', 'Perempuan', 'KABUPATEN PINRANG PROV. SULAWESI SELATAN ', '2000-04-29', 'ASN', 'PNS', 'S1/D4', 'Konsultasi Statistik', 'Indikator kinerja makro', 'Evaluasi', '2025-02-25', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(11, '2025-02-26 02:49:38', 'A.Hamsina,S.E,M.M', '085298651715', 'hamsina541@gmail .com', 'Perempuan', 'Pao .kel padaidi kec.Mattiro Bulu.Kab Pinrang', '1976-02-26', 'ASN', 'MAHASISWA S3 UNM', 'S2', 'Konsultasi Statistik', 'Data siswa SMK data jumlah Penganngguran', 'Skripsi/Tesis/Disertasi', '2025-02-26', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(12, '2025-02-27 00:58:06', 'Rahmiani', '085342018149', 'rahmianiany90@gmail.com', 'Perempuan', 'Pinrang', '1990-10-25', 'ASN', 'Dinkes', 'S1/D4', 'Perpustakaan, Konsultasi Statistik, Rekomendasi Kegiatan Statistik', '1. Jumlah kepadatan penduduk kabupaten Pinrang tahun 2024\n2. Jumlah data persentase penduduk kabupaten pinrang usia diatas 60 tahun 2024\n3. Jumlah penduduk kabupaten Pinrang tahun 2024\n4. Persentase rumah tangga dengan luas lantai perkapita kurang dari 7,2 meter persegi kabupaten Pinrang tahun 2024\n5. Persentase penduduk tinggal diwilayah perkotaan (urban) kabupaten Pinrang tahun 2024\n6. Persentase penduduk yang tinggal di perkotaan (urban) kabupaten Pinrang tahun 2024', 'Data untuk pemetaan risiko', '2025-02-27', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(13, '2025-02-27 02:17:03', 'Nurul Azizah ', '085255856912', 'azizahnurul0512@gmail.com', 'Perempuan', 'Parepare, Sulawesi Selatan', '2001-06-05', 'Pelajar/Mahasiswa', 'Mahasiswi di Universitas Hasanuddin', '<= SMA', 'Konsultasi Statistik', 'Data Curah Hujan Pinrang Tahun 2024 ', 'Skripsi/Tesis/Disertasi', '2025-02-27', 'Pelayanan Statistik Terpadu online (pst.bps.go.id), Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(14, '2025-02-28 02:25:38', 'Sartika', '088744536811', 'taqdirfadli@gmail.com', 'Perempuan', 'Pinrang Sulawesi Selatan', '1991-12-31', 'Mengurus rumah tangga', 'Honor kelurahan ', '<= SMA', 'Rekomendasi Kegiatan Statistik', 'Data Penduduk Pinrang ', 'Evaluasi', '2023-09-29', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(15, '2025-03-03 03:16:36', 'Khafifah Indahsari Arif Sulnas', '082296875728', 'khafifahsulnas203@gmail.com', 'Perempuan', 'Pare pare, Sulawesi Selatan', '2003-03-02', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Negeri Malassar', '<= SMA', 'Perpustakaan', 'Data PDRB Harga Konstan Menurut Lapangan Usaha Tahun 2024', 'Skripsi/Tesis/Disertasi', '2025-03-03', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(16, '2025-03-07 17:30:16', 'Abd haris ', '0823 4277 0000 ', 'Abdh52696@gmail.com ', 'Laki-laki', 'Martapura Kalimantan Selatan ', '1970-10-28', 'Polisi ', 'Bhabintamtibmas Kel.pallameang ', '<= SMA', 'Konsultasi Statistik', 'Data wilayah dan jumlah penduduk kec mat.sompe Kab.Pinrang ', 'Penelitian', '2025-03-08', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(17, '2025-03-10 03:59:38', 'Rahmawati', '085242409123', 'rahmakamal347@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '1974-10-31', 'ASN', 'Kasubag Umum Kepegawaian BPKPD', 'S2', 'Perpustakaan', 'Data Penduduk Pinrang Tahun 2023', 'Perencanaan', '2025-03-10', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(18, '2025-03-12 04:25:07', 'LUKMAN, SE', '085242450700', 'llukydj3174@gmail.com', 'Laki-laki', 'Pinrang', '1974-07-31', 'ASN', 'Kasubid Penetapan dan Penagihan Pajak Daerah BPKPD Kab. Pinrang', 'S1/D4', 'Konsultasi Statistik', 'Data Penduduk Miskin Tahun 2024', 'sebagai persyaratan BPHTB', '2025-03-14', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(19, '2025-03-13 02:46:48', 'Nur Ainul Guntur, S.Tr.IP', '085242766637', 'ppepbappelitbangdapinrang@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '2000-04-16', 'ASN', 'Staf di Bidang Makro, Bappelitbangda', 'S1/D4', 'Konsultasi Statistik', 'Data Jumlah Penduduk Usia 15 Tahun Ke Atas Yang Lulus Pendidikan Tinggi Tahun 2019-2024', 'Perencanaan', '2025-03-13', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(20, '2025-03-18 05:47:34', 'Yellia fitriani', '085343634517', 'yellia.fitriani@yahoo.co.id', 'Perempuan', 'Jakarta', '1982-07-23', 'ASN', 'Perencana', 'S1/D4', 'Konsultasi Statistik', 'Data pdrb', 'Perencanaan', '2025-03-18', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(21, '2025-03-19 01:02:19', 'Nasri Nona', '082197200533', 'nasri121202@gmail.com', 'Laki-laki', 'Pinrang', '1976-03-01', 'Karyawan Swasta', 'Kasub Biro/ Jurnalis ', '<= SMA', 'Konsultasi Statistik', 'Jumlah keluarga per kecamatan tahun 2024', 'Bekerja', '2025-03-19', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(22, '2025-03-21 03:29:02', 'Rivaldy yusri putra', '082190915122', 'rivaldyyp.19@gmail.com', 'Laki-laki', 'Makassar', '1987-10-11', 'ASN', 'Analis kebijakan ahli muda pada bagian pemerintahan setda kab. Pinrang', 'S1/D4', 'Konsultasi Statistik', 'Data gini ratio kab. Pinrang tahun 2024', 'Evaluasi', '2025-03-21', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(23, '2025-04-04 12:07:02', 'Akbar', '085391931193', '-', 'Laki-laki', 'Pinrang, Sulawesi Selatan ', '1987-02-11', 'TNI', 'Babinsa Kel Tadokkong', '<= SMA', 'Perpustakaan', 'Daya beli masyarakat Pinrang ', 'Perencanaan, Diskusi', '2025-04-04', 'Menghubungi pegawai BPS', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(24, '2025-04-08 02:10:42', 'Nurul Hafsah ', '082195435127', 'hapsa0794@gmail.com', 'Perempuan', 'Pinrng, Sulawesi Selatan ', '2003-06-29', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Muhammadiyah Makassar ', '<= SMA', 'Konsultasi Statistik', 'Data Pendapatan Asli Daerah dan Jumlah Wisatawan Tahun 2018 - 2024', 'Tugas Sekolah/Kuliah, Skripsi/Tesis/Disertasi, Penelitian', '2025-04-08', 'Pelayanan Statistik Terpadu (PST) datang langsung, Pelayanan Statistik Terpadu online (pst.bps.go.id), Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(25, '2025-04-11 00:55:01', 'Karisma Amir,S.Psi', '081355972339', 'karismakhalid@gmail.com', 'Perempuan', 'Ujung pandang,Sulawesi selatan', '1985-01-13', 'ASN', 'Pegawai di Bapperida Pinrang ', 'S2', 'Konsultasi Statistik', 'Data PTP tahun 2023- 2024 \nData rumah tangga pengguna listrik tahun 2023-2024', 'Perencanaan, Evaluasi', '2025-04-11', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(26, '2025-04-11 01:10:43', 'Andi fatmawati,S.Ap', '08218888018', 'fatmawati.amal@gmail.com', 'Perempuan', 'Pinrang,Sulawesi selatan', '1979-07-12', 'ASN', 'Kepala bidang di bapperida', 'S1/D4', 'Konsultasi Statistik', 'Data PTP tahun 2023-2024\nData rumah tangga yg dialiri listrik tahun 2023-2024', 'Perencanaan, Evaluasi', '2025-04-11', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(27, '2025-04-11 03:02:26', 'Donny Winarto ', '082393722253', 'winartodonny2@gmail.com', 'Laki-laki', 'Tana Toraja, Sulawesi Selatan ', '2002-02-24', 'Pelajar/Mahasiswa', 'Mahasiswa di universitas kristen Indonesia Toraja ', 'S1/D4', 'Perpustakaan', 'Data klimatologi kabupaten Pinrang dari 2014-2024\n', 'Skripsi/Tesis/Disertasi', '2025-04-11', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(28, '2025-04-14 05:43:08', 'Maftuha', '08114499704', 'maftuharidwan@gmail.com', 'Perempuan', 'Pinrang, Sulawesi selatan ', '1971-10-24', 'ASN', 'Kasubag Program Dinas Kesehatan ', 'S2', 'Konsultasi Statistik', 'Data Target Usia Harapan Hidup tahun 2025 s/d 2030', 'Perencanaan', '2024-04-14', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(29, '2025-04-15 14:50:22', 'Hasriana Zaenal', '085696602794', 'hasrianazaenal07@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '2004-05-07', 'Pelajar/Mahasiswa', 'Mahasiswa Di Universitas Negeri Makassar,Prodi Statistika', '<= SMA', 'Konsultasi Statistik', 'Data Pengangguran Perkacamatan di Kabupaten Pinrang tahun 2021-2024\nData Kemiskinan Perkacamatan/Kelurahan Di kabupaten Pinrang 2021- 2024\nData Angka Putus Sekolah Perkacamatan / Kelurahan di kabupaten Pinrang 2021-2024\n', 'Skripsi/Tesis/Disertasi, Penelitian', '2025-04-18', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(30, '2025-04-16 01:56:29', 'Sitti Marhamah Syam, SPi, MSi', '082194358199', 'marhamahpinrang@gmail.com', 'Perempuan', 'Pinrang Sulawesi Selatan', '1969-05-18', 'ASN', 'Kasubag Program Dinas Perikanan', 'S2', 'Konsultasi Statistik', 'Data PDRB sektor Perikanan tahun 2024', 'Perencanaan, Evaluasi', '2025-04-16', 'Pelayanan Statistik Terpadu online (pst.bps.go.id), Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(31, '2025-04-16 07:26:15', 'Sumarni', '082188808334', 'Selmiqadli36@gmail.com', 'Perempuan', 'Lahaddato,', '1984-06-10', 'ASN', 'Kasubag program', 'S1/D4', 'Perpustakaan', 'Data jumlah kontribusi sektor pertanian', 'Perencanaan', '2024-04-16', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(32, '2025-04-17 05:46:37', 'Andi Fitriani ', '085395338957', 'fitriandifitri@gmail.com', 'Perempuan', 'Pinrang,Sulawesi Selatan ', '1985-08-08', 'ASN', 'Staff di Disperindag ', '<= SMA', 'Konsultasi Statistik', 'Konsultasi statistik untuk perhitungan nilai Disperindag ', 'Bekerja', '2025-04-17', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(33, '2025-04-22 01:45:50', 'Rochmiani,S.Pt', '0811461477', 'rochmianispt@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '1977-04-01', 'ASN', 'Bagian Program', 'S2', 'Konsultasi Statistik', 'Data PDRB Pertanian khususnya sektor Peternakan dan Perkebunan', 'Perencanaan', '2025-04-22', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(34, '2025-04-22 03:30:07', 'Andi Fitriani ', '085395338957', 'fitriandifitri@gmail.com', 'Perempuan', 'Pinrang Sulawesi Selatan ', '1979-08-08', 'ASN', 'Pengelola Data Dan Informasi di dinas perindag pinrang', '<= SMA', 'Konsultasi Statistik', 'Data Lajut Pertumbuhan Sektor Perdagangan Terhadap PDRB tahun 2020-2024', 'Perencanaan', '2025-04-22', 'Pelayanan Statistik Terpadu (PST) datang langsung, Website BPS (bps.go.id) / AllStats BPS, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(35, '2025-04-23 02:26:31', 'H. Hasanuddin', '081242631657', 'h.hasanuddin.m@gmail.com', 'Laki-laki', 'Pinrang, Sulawesi Selatan', '1961-12-31', 'Karyawan Swasta', 'Wakil Ketua II Baznas Kab. Pinrang', 'S1/D4', 'Konsultasi Statistik, Rekomendasi Kegiatan Statistik', 'Data penduduk kab. Pinrang tahun 2024 kategori miskin', 'Perencanaan, Evaluasi', '2025-04-23', 'Pelayanan Statistik Terpadu (PST) datang langsung, Pelayanan Statistik Terpadu online (pst.bps.go.id), Website BPS (bps.go.id) / AllStats BPS, Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(36, '2025-04-24 01:42:59', 'Imanuel Makamban pasalli', '089528569770', 'imanpasalli00@gmail.com', 'Laki-laki', 'Tana Toraja, Sulawesi Selatan', '2003-09-15', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Hasanuddin', '<= SMA', 'Konsultasi Statistik', 'Data pola curah hujan kabupaten pinrang 2020-2024', 'Skripsi/Tesis/Disertasi', '2025-04-24', 'Website BPS (bps.go.id) / AllStats BPS', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(37, '2025-04-25 07:21:35', 'Nur Asma,S.sos,M.si', '085340708086', 'nura.office2015@gmail.com', 'Perempuan', 'Pinrang', '1986-02-14', 'ASN', 'Staf Bapperida ', 'S2', 'Konsultasi Statistik', 'Capaian HLS dan RLS tahun 2024', 'Perencanaan', '2025-04-25', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(38, '2025-04-29 01:05:11', 'D. Achmad Ansari A., S.Kom.', '085255695419', 'dachmadansaria@gmail.com', 'Laki-laki', 'Pinrang, Sulawesi Selatan', '2000-10-10', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Handayani Makassar', 'S1/D4', 'Perpustakaan', 'Data Publikasi Pinrang dalam Angka 2024', 'Skripsi/Tesis/Disertasi', '2025-04-29', 'Pelayanan Statistik Terpadu (PST) datang langsung, Website BPS (bps.go.id) / AllStats BPS', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(39, '2025-04-29 07:01:40', 'Benediktus Minto', '085256288172', 'benediktusminto@gmail.com', 'Laki-laki', 'Ato Lamba', '2000-12-24', 'Pelajar/Mahasiswa', 'Mahasiswa di Sekolah Tinggi Teknik Baramuli', 'S1/D4', 'Konsultasi Statistik', 'Peta Kecamatan Watang Sawitto dan Infratruktur serta Data Luas Lahan Pertanian tahun 2014-2024', 'Skripsi/Tesis/Disertasi', '2025-04-29', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(40, '2025-05-06 05:57:39', 'Rabiyatul Adawiah', '085298978278', 'rabiyatuladawiahj@gmail.com', 'Perempuan', 'Pinrang/Sulawesi Selatan', '2002-04-12', 'Pelajar/Mahasiswa', 'Mahasiswi di IAIN Parepare', 'S1/D4', 'Konsultasi Statistik', 'Data petani jagung Manis Desa Padaelo Kecamatan Mattiro Bulu', 'Tugas Sekolah/Kuliah, Skripsi/Tesis/Disertasi, Penelitian', '2025-05-06', 'Pelayanan Statistik Terpadu (PST) datang langsung, Pelayanan Statistik Terpadu online (pst.bps.go.id), Website BPS (bps.go.id) / AllStats BPS, Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(41, '2025-05-20 07:39:14', 'Khafifah Indahsari Arif Sulnas', '082296875728', 'Khafifahharif@gmail.com', 'Perempuan', 'Parepare, Sulawesi Selatan', '2003-03-02', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Negeri Makassar', '<= SMA', 'Konsultasi Statistik', 'Data Luas Lahan Pertanian Kabupaten Pinrang Tahun 2015-2024', 'Skripsi/Tesis/Disertasi', '2025-05-20', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(42, '2025-05-23 00:56:47', 'St Nur Atisa Tahir', '082189562380', 'nuratisatahir111217@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '2002-06-26', 'Pelajar/Mahasiswa', 'Mahasiswa IAIN Parepare', 'S1/D4', 'Konsultasi Statistik', 'Data jumlah pendapatan petani dari tahun 2021-2024 Desa Padakkalawa Kecamatan Mattiro Bulu', 'Skripsi/Tesis/Disertasi', '2025-05-23', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(43, '2025-05-27 05:45:42', 'Mhd. Rizky Iskandar ', '082343673427', 'rizkyiskandar117@gmail.com', 'Laki-laki', 'P.siantar, Sumatera Utara ', '2001-07-20', 'Pelajar/Mahasiswa', 'Mahasiswa STT Baramuli Pinrang ', '<= SMA', 'Konsultasi Statistik', 'Data untuk luas wilayah desa katomporang kec Duampanua kab Pinrang ', 'Tugas Sekolah/Kuliah, Skripsi/Tesis/Disertasi, Penelitian', '2025-05-27', 'Pelayanan Statistik Terpadu (PST) datang langsung, Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(44, '2025-06-03 06:36:54', 'yellia fitriani', '085343634517', 'yellia.fitriani@yahoo.co.id', 'Perempuan', 'Jakarta,', '1982-07-23', 'ASN', 'ASN di Bapperida Pinrang', 'S2', 'Konsultasi Statistik', 'Nilai PDRB ADHB tahun 2020-2024', 'Perencanaan', '2025-06-03', 'Website BPS (bps.go.id) / AllStats BPS', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(45, '2025-06-04 02:24:54', 'Muhammad karya, S.Pd.I, MM', '082193791261', 'pinrangkarya@gmail.com', 'Laki-laki', 'Pinrang kabupaten Pinrang ', '1971-08-06', 'ASN', 'Bidang kebudayaan Dikbud kab Pinrang ', 'S2', 'Konsultasi Statistik', 'Permintaan data kabupaten Pinrang dalam rangka penyusunan pokok pikiran kebudayaan daerah kab Pinrang ', 'Permintaan data kabupaten Pinrang dalam rangka penyusunan pokok pikiran kebudayaan daerah kab Pinrang ', '2025-06-03', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(46, '2025-06-11 03:46:02', 'NURUL SRI SULHAJRIANI', '085240045871', 'nuru', 'Perempuan', 'pinrang', '1994-04-30', 'HONORER', 'STAF DI PERENCANAAN DIKBUD ', 'S1/D4', 'Konsultasi Statistik', 'Jumlah penduduk usia 25 – 60 tahun yang tidak\ntamat SMP pada kelompok ke i, i=1(Miskin),\n2(Rentan), 3(Penduduk usia 25- 60 tahun) DAN Jumlah penduduk usia 25 – 60 tahun pada\nperiode waktu yang sama pada kelompok ke i,\ni=1(Miskin), 2 (Rentan), 3 (Penduduk usia 25-60\ntahun)', 'Perencanaan', '2025-06-09', 'Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(47, '2025-06-22 01:49:23', 'Drs. H. Hasanuddin', '081242631657', 'h. hasanuddin. m@gmail.com', 'Laki-laki', 'Pinrang Sulawesi Selatan, ', '1961-12-31', 'Karyawan Swasta', 'Pimpinan Baznas Kab. Pinrang', 'S1/D4', 'Konsultasi Statistik', 'Data fakir  miskin Kab. Pinrang', 'Perencanaan, Evaluasi', '2025-06-22', 'Pelayanan Statistik Terpadu (PST) datang langsung, Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(48, '2025-06-23 05:41:25', 'muh kahar m', '087805830197', 'muhkaharm3@gmail.com', 'Laki-laki', 'pinrang sulawesi selatan', '2002-07-22', 'Pelajar/Mahasiswa', 'mahasiswa di universitas muhammadiyah pare pare', 'S1/D4', 'Konsultasi Statistik', 'pengaruh pertumbuhan ekonomi', 'Skripsi/Tesis/Disertasi', '2025-06-23', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(49, '2025-06-23 06:13:46', 'Sri mahyuni', '085342783740', 'srimahyuniuni84@gmail.com', 'Perempuan', 'Pinrang , Sulawesi selatan ', '1984-02-23', 'Karyawan Swasta', 'Pca Pinrang timur', 'S1/D4', 'Konsultasi Statistik', 'Data anak putus sekolah ', 'Perencanaan', '2025-06-23', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(50, '2025-06-25 03:58:27', 'Nur Asma, S.Sos,M.Si', '085340708086', 'nura.office2015@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '1986-02-14', 'ASN', 'ASN BApperida Pinrang', 'S2', 'Konsultasi Statistik', 'Laju pertumbuhan PDB per kapita,PDP per kapita,Persentase konsumen Badan Pusat Statistik (BPS) yang merasa puas dengan kualitas data statistik.Persentase konsumen yang menjadikan data dan informasi statistik BPS,Jumlah pengunjung eksternal yang mengakses data dan informasi statistik melalui website,Persentase konsumenyang puas terhadap akses data Badan Pusat Statistik (BPS', 'Evaluasi', '2025-06-25', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(51, '2025-06-25 07:10:17', 'Nur Asma, S.Sos,M.Si', '085340708086', 'nura.office2015@gmail.com', 'Perempuan', 'Pinrang, Sulawesi Selatan', '1986-02-14', 'ASN', 'Staf Bapperida ', 'S2', 'Konsultasi Statistik', 'Laju pertumbuhan PDB per kapita, PDP per kapita, Persentase konsumen Badan Pusat Statistik (BPS) yang merasa puas dengan kualitas data statistik.', 'Evaluasi', '2025-06-25', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(52, '2025-06-30 06:09:15', 'Amang', '085255960567', 'amang@gmail.com', 'Laki-laki', 'Pinrang', '1981-05-07', 'Sekdes sali sali', 'Sekertaris desa sali sali', 'S1/D4', 'Konsultasi Statistik', 'Konsultasi jumlah penduduk kecamatan Lembang dan desa sali sali', 'Perencanaan', '2025-06-30', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(53, '2025-07-01 00:56:36', 'Mutmainnah arham, S.Pd', '085298955762', 'mutmainnaharham@gmail.com', 'Perempuan', 'Corawali Pinrang, sulawesi selatan', '1999-09-11', 'Pelajar/Mahasiswa', 'Mahasiswa pascasarjana di universitas negeri makassar', 'S1/D4', 'Konsultasi Statistik', '1. Data penduduk kelurahan manarang kecamatan mattiro bulu kab.pinrang yang bekerja berdasarkan gender 2021-2024\n2. ⁠data ibu di manarang kecamatan mattiro bulu kabupaten pinrang yang bekerja 2021-2024', 'Skripsi/Tesis/Disertasi', '2025-07-02', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(54, '2025-07-01 01:52:44', 'MA\'DIKA, SH.MM.', '082325444000', 'dickymadika78@gmail.com', 'Laki-laki', 'Pinrang', '1978-09-12', 'ASN', 'Kasubag program', 'S2', 'Konsultasi Statistik, Rekomendasi Kegiatan Statistik', 'PRODUK DOMESTIK REGIONAL BRUTO KAB PINRANG TAHUN 2024', 'Bekerja', '2025-07-01', 'Pelayanan Statistik Terpadu online (pst.bps.go.id), Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(55, '2025-07-01 05:02:03', 'ISMAIL, S. HI', '082348945571', 'am2881308@gmail.com', 'Laki-laki', 'Pinrang Sulawesi Selatan ', '1976-04-14', 'ASN', 'Penyuluh Agama Islam di KUA.KEC.PALETEANG ', 'S1/D4', 'Konsultasi Statistik', 'Data penduduk tahun 2025', 'Diskusi', '2025-07-01', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(56, '2025-07-02 02:11:24', 'Kaharuddin', '085240157811', 'kahardata73@gmail.com', 'Laki-laki', 'Pinrang', '1973-05-24', 'ASN', 'Staf BPS Pinrang', '<= SMA', 'Konsultasi Statistik', 'Data penduduk Tahun 2020-2024, Data pengguna KB Tahun 2020-2024, dan Data PUS Tahun 2020-2024..', 'Tugas Sekolah/Kuliah', '2025-07-02', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(57, '2025-07-02 06:00:01', 'Drs. Hasanuddin ', '081242631657', 'h.hasanuddin.m@gmail.com', 'Laki-laki', 'Pinrang, Sulawesi Selatan', '1961-12-31', 'Karyawan Swasta', 'Wakil ketua II Baznas Pinrang', 'S1/D4', 'Konsultasi Statistik', 'Realisasi pengentasan kemiskinan menurut garis kemiskinan BPS tahun 2024? \nRealisasi pengentasan kemiskinan ekstrem tahun 2024? ', 'Perencanaan', '2025-07-02', 'Surat / Email, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(58, '2025-07-03 02:58:31', 'Syahidan, S.Hiut', '085242824905', 'syasya0701@gmail.com', 'Perempuan', 'Maakssa', '1982-01-07', 'ASN', 'Fungsional ', 'S1/D4', 'Konsultasi Statistik', 'Data Penduduk dan Pendapatan ', 'Perencanaan', '2025-07-03', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(59, '2025-07-08 05:24:55', 'IPDA ABU TAYIB', '085395855355', 'abutayibahmad8@gmail.com', 'Laki-laki', 'SOPPENG SULAWESI SELATAN ', '1973-12-17', 'POLRI', 'PAUR PROGAR BAGREN POLRES PINRANG ', '<= SMA', 'Perpustakaan', 'Data Kecamatan Batulappa dalam angka tahun 2025', 'Perencanaan', '2025-07-08', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(60, '2025-07-09 02:13:42', 'Serda Amiruddin', '082194116863', 'amiruddin091986@gmail.com', 'Laki-laki', 'Tempe -Tempe', '1986-11-09', 'TNI', 'Babinsa', '<= SMA', 'Perpustakaan', 'Data jumlah penduduk Kel.Sawitto', 'Bekerja', '2025-07-09', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(61, '2025-07-10 06:07:25', 'Samsuridal', '085242740047', 'lholosamsuridal@gmail.com', 'Laki-laki', 'Takalar', '1984-08-24', 'ASN', 'Staf Diskominfosandi pinrang', 'S1/D4', 'Konsultasi Statistik', 'Konsultasi dengan BPS', 'Diskusi, Bekerja', '2025-07-10', 'Pelayanan Statistik Terpadu (PST) datang langsung, Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(62, '2025-07-14 03:31:54', 'Asmah', '085255372810', 'Asmah.ammase@gmail.com', 'Perempuan', 'Pinrang', '1976-08-01', 'ASN', 'ASN di Kelurahan Salo', 'S1/D4', 'Konsultasi Statistik', 'Jumlah Kk di wilayah kelurahan Salo perlingkungan', 'Bekerja', '2025-07-14', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(63, '2025-07-25 05:02:30', 'Kaharuddin', '085240157811', 'kahardata73@gmail.com', 'Laki-laki', 'Benteng', '1973-05-24', 'ASN', 'Fungsional Umum\n', '<= SMA', 'Konsultasi Statistik', '1. Data Peserta KB ( pengguna Alat Kontrasepsi) Tahun 2020 - 2024 Provinsi dan Kecamatan di Kab. Pinrang\n2.Data Jumlah PUS Tahun 2020 - 2024 Provinsi dan Kecamatan di Kab. Pinrang\n3. Data Jumlah Kelahiran 2020 - 2024 Provinsi dan Kecamatan di Kab. Pinrang. \n4. Data Jumlah Penduduk tahun 2020 Provinsi dan Kecamatan di Kab. Pinrang\n', 'Tugas Sekolah/Kuliah', '2025-07-25', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(64, '2025-07-28 02:01:02', 'Nur Ainul', '085242766637', 'ppepbappelitbangdapinrang@gmail.com', 'Perempuan', 'Pinrang', '2000-04-16', 'ASN', 'Staf di Kantor Bapperida', 'S1/D4', 'Konsultasi Statistik', 'Data tingkat kemiskinan ekstrem kabupaten pinrang tahun 2020-2024', 'Perencanaan', '2025-07-28', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(65, '2025-07-28 03:05:14', 'Musdalifah Musida', '085341717239', 'musdalifahmusida@gmail.com', 'Perempuan', 'Ujung Pandang', '1993-08-22', 'ASN', 'Staf Dinas Kesehatan Kab. Pinrang', 'S1/D4', 'Perpustakaan, Konsultasi Statistik', 'Data penduduk Tahun 2025 per Kecematan kab. Pinrang', 'Bekerja', '2025-07-28', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(66, '2025-07-28 03:43:39', 'Musdalifah Musida', '085341717239', 'musdalifahmusida@gmail.com', 'Perempuan', 'Ujung Pandang', '1993-08-22', 'ASN', 'Staf Dinas Kesehatan Kab. Pinrang', 'S1/D4', 'Perpustakaan', 'Data anak usia di bawah 15 tahun', 'Bekerja', '2025-07-28', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(67, '2025-08-05 03:43:25', 'ANDI MASITA, S.Pd', '081241319760', 'andimasitaailani@gmail.com', 'Perempuan', 'Pinrang Sulawesi Selatan', '1986-04-14', 'ASN', 'Guru di UPT SDN 1 Pinrang', 'S1/D4', 'Konsultasi Statistik', 'Peta Kabupaten Pinrang ', 'Bekerja', '2025-08-05', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(68, '2025-08-11 01:17:40', 'Herawati Syam, SKM', '085255507931', 'herakama01@gmail.com', 'Perempuan', 'Parepare, Sulawesi Selatan', '1984-07-14', 'ASN', 'Tim kerja di Dinas Kesehatan', 'S1/D4', 'Konsultasi Statistik', 'Usia harapan hidup tahun 2023 dan 2024', 'Bekerja', '2025-08-11', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(69, '2025-08-11 07:44:00', 'M.PARDI', '082189874216', 'm.pardi195@gmail.com', 'Laki-laki', 'Sidenreng Rappang,Sulawesi Selatan', '2004-03-31', 'Pelajar/Mahasiswa', 'Mahasiswa di Universitas Muhammadiyah Parepare', '<= SMA', 'Perpustakaan, Konsultasi Statistik, Rekomendasi Kegiatan Statistik', 'Data Pendapatan Asli Daerah di Kab Pinrang Tahun 2020-2024', 'Skripsi/Tesis/Disertasi', '2025-08-11', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(70, '2025-08-22 03:55:19', 'SUMARWAH', '089646971967', 'vivizakira@gmail.com', 'Perempuan', 'PINRANG', '1985-11-02', 'PERANGKAT DESA', 'KEPALA URUSAN KEUANGAN KANTOR DESA BUNGA', '<= SMA', 'Konsultasi Statistik', 'DATA PENDUDUK DESA BUNGA KECAMATAN MATTIR BULU KAUPATEN PINRANG 2023 - 2025', 'Perencanaan', '1985-08-22', 'Pelayanan Statistik Terpadu online (pst.bps.go.id)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(71, '2025-08-25 01:20:49', 'Aviq Adriansyah', '082157305282', 'aviq.adriansyah@gmail.com', 'Laki-laki', 'Pinrang', '2025-08-25', 'ASN', 'Penelaah Teknis Jabatan', 'S1/D4', 'Konsultasi Statistik', 'Data Pinrang Dalam Angka', 'Perencanaan', '2025-08-25', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(72, '2025-08-25 03:12:49', 'Yusran Arifin', '085240203826', 'yusranarifin84@gmail.com', 'Laki-laki', 'Gorontalo', '1984-06-26', 'ASN', 'BRM Umbi', 'S1/D4', 'Konsultasi Statistik', 'Koordinasi data panen bulan juli', 'Diskusi, ', '2025-08-25', 'Pelayanan Statistik Terpadu (PST) datang langsung, ', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(73, '2025-08-26 02:16:48', 'Nur asma.s.sos.m.si', '085340708086', 'nura.office2015@gmail.com', 'Perempuan', 'PINRANG', '1986-02-14', 'ASN', 'Asn di bappeda', 'S2', 'Konsultasi Statistik', 'Data APS SMA 2020-2024', 'Perencanaan', '2025-08-26', 'Aplikasi chat (WhatsApp, Telegram, ChatUs, dll.)', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(74, '2025-08-27 03:30:05', 'SUMARWAH', '089646971967', 'vivizakira@gmail.com', 'Perempuan', 'PINRANG', '1985-11-02', 'PERANGKAT DESA', 'KAUR KEUANGAN KANTOR DESA BUNGA ', '<= SMA', 'Konsultasi Statistik', 'DATA PENDUDUK DESA BUNGA KECAMATAN MATTIRO BULU KABUPATEN PINRANG TAHUN 2020 - 2025', 'Penelitian', '2025-08-27', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18'),
(75, '2025-09-07 09:07:22', 'Delarosa', '082172201213', 'delarosarenata@gmail.com', 'Perempuan', 'Indonesia', '2000-01-01', 'Peneliti', '-', 'S1/D4', 'Perpustakaan, Lainnya', '-', 'Tugas Sekolah/Kuliah', '2025-09-07', 'Pelayanan Statistik Terpadu (PST) datang langsung', '2025-09-08 05:53:18', '2025-09-08 05:53:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_skds`
--

CREATE TABLE `data_skds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kategori` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nomor_hp` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `blok_1` varchar(255) DEFAULT NULL,
  `blok_2` varchar(255) DEFAULT NULL,
  `blok_3` varchar(255) DEFAULT NULL,
  `blok_4` varchar(255) DEFAULT NULL,
  `tanggal_cacah` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `data_skds`
--

INSERT INTO `data_skds` (`id`, `kategori`, `nama`, `nomor_hp`, `email`, `nama_instansi`, `blok_1`, `blok_2`, `blok_3`, `blok_4`, `tanggal_cacah`, `created_at`, `updated_at`) VALUES
(1, 'Online-Link', 'renata', '82172201213', 'deardo@gmail.com', 'asdfgh', '1', '1', '1', '1', '2025-09-06', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(2, 'Online-Link', 'renata', '82172201213', 'deardo@gmail.com', 'asdfgh', '1', '1', '1', '1', '2025-09-06', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(3, 'Online-Link', 'dasdsd', '25212515515121', 'dsds@gmail.com', 'dvvd', '1', '1', '1', '1', '2025-09-06', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(4, 'Online-Link', 'Chrishelle Sunjoyooo', '81190825454', 'pushme@yahoo.com', 'Universitas Pelita Harapan', '1', '1', '1', '1', '2025-09-05', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(5, 'Online-Link', 'Pimpi', '82345785423', 'pimpi@gmail.com', 'PT. Cetar Membahana', '1', '1', '1', '1', '2025-09-04', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(6, 'Online-Link', 'delarosaaaa', '8534594543', '222011432@stis.ac.id', 'dgdgg', '1', '1', '1', '1', '2025-09-03', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(7, 'Online-Link', 'Nur Asma, S.Sos,M.Si', '85340708086', 'nura.office2015@gmail.com', 'Bapperida', '1', '1', '1', '1', '2025-08-30', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(8, 'Online-Link', 'Sri mahyuni', '85342783740', 'srimahyuniuni84@gmail.com', 'Aisyiyah', '1', '1', '1', '1', '2025-08-30', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(9, 'Online-Link', 'SUMARWAH', '89646971967', 'vivizakira@gmail.com', 'KANTOR DESA BUNGA', '1', '1', '0', '0', '2025-08-27', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(10, 'Online-Link', 'Nur Asma, S.Sos,M.Si', '85340708086', 'nura.office2015@gmail.com', 'Bapperida', '1', '0', '0', '0', '2025-08-26', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(11, 'Online-Link', 'Musdalifah Musida', '85341717239', 'musdalifahmusida@gmail.com', 'Dinas Kesehatan Kab. Pinrang', '1', '1', '0', '0', '2025-07-28', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(12, 'Online-Link', 'Kaharuddin', '85240157811', 'kahardata73@gmail.com', 'Badan Pusat Statistik', '1', '1', '0', '0', '2025-07-02', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(13, 'Online-Link', 'Nur asma', '85340708086', 'nura.office2015@gmail.com', 'Bapperida', '1', '1', '1', '1', '2025-06-29', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(14, 'Online-Link', 'Siti Noramdani. A', '82344999146', 'sitinoramdan@gmail.com', 'Kantor Desa Patobong', '1', '1', '0', '0', '2025-06-26', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(15, 'Online-Link', 'Muh kahar m', '87805830197', 'muhkaharm3@yahoo.com', 'Universitas muhammadiyah pare pare', '1', '1', '1', '1', '2025-06-25', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(16, 'Online-Link', 'Mhd Rizky Iskandar', '82343673427', 'rizkyiskandar117@gmail.com', 'STT Baramuli Pinrang', '1', '1', '1', '1', '2025-06-11', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(17, 'Online-Link', 'Nurul Hafsah', '82195435127', 'hapsa0794@gmail.com', 'Universitas Muhammadiyah Makassar', '1', '1', '1', '1', '2025-06-11', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(18, 'Online-Link', 'Imanuel Makamban pasalli', '89528569770', 'imanuelpasalli@gmail.com', 'Universitas Hasanuddin', '1', '1', '0', '0', '2025-04-24', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(19, 'Online-Link', 'Andi Fitriani', '85395338957', 'fitriandifitri@gmail.com', 'Dinas Perindustrian, Perdagangan, Energi dan Sumber Daya Mineral Kabupaten Pinrang', '1', '1', '1', '1', '2025-04-17', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(20, 'Online-Link', 'Hasriana Zaenal', '85696602794', 'hasrianazaenal07@gmail.com', 'UNIVERSITAS NEGERI MAKASSAR', '1', '0', '0', '0', '2025-04-16', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(21, 'Online-Link', 'Sitti Marhamah Syam', '82194358199', 'marhamahpinrang@gmail.com', 'Dinas Perikanan Pinrang', '1', '1', '1', '1', '2025-04-16', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(22, 'Online-Link', 'Nasri NONA', '82197200533', 'nasri121202@gmail.com', 'Non PNS', '1', '0', '0', '0', '2025-03-21', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(23, 'Online-Link', 'Nurhayati', '82244861067', 'Nurhayatimudaming@gmail.com', 'Kelurahan Mattiro deceng', '1', '0', '0', '0', '2025-03-19', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(24, 'Online-PST', 'Suzianti S. Pd', '85299650806', 'suziantisyamsul@gmail.com', 'Wahdah Islamiyah', '1', '1', '1', '1', '2025-03-11', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(25, 'Online-Email', 'Nuraeni, S.Hut', '85255511340', '', 'UPTD KPH SAWITTO DINAS LINGK.HIDUPDAN KEHUTANAN PROV.SULSEL', '1', '1', '0', '0', '2025-03-07', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(26, 'Online-Link', 'Asrul B. Panrita', '85239228759', 'asrul8073@gmail.com', 'Kelurahan Penrang', '1', '1', '1', '1', '2025-03-07', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(27, 'Manual', 'MUHAMMAD ANUGERAH RUSTAN', '87781628510', 'anugerahmuhammad02@gmail.com', 'universitas muhammadiyah parepare', '1', '1', '1', '1', '2025-02-21', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(28, 'Manual', 'Muhammad Raihan Hidayat', '81944395257', 'muhammadraihanhidayat795@gmail.com', 'IAIN Parepare', '1', '1', '1', '1', '2025-02-12', '2025-09-08 05:53:19', '2025-09-08 05:53:19'),
(29, 'Online-Link', 'Delarosa Renata', '82172201213', 'delarosarenata@gmail.com', 'BPS RI', '1', '1', '1', '1', '2025-09-07', '2025-09-08 05:53:19', '2025-09-08 05:53:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `instansis`
--

CREATE TABLE `instansis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `instansis`
--

INSERT INTO `instansis` (`id`, `nama`) VALUES
(1, 'Lembaga Negara'),
(2, 'Kementerian & Lembaga Pemerintah'),
(3, 'TNI/POLRI/BIN/Kejaksaan'),
(4, 'Pemerintah Daerah'),
(5, 'Lembaga Internasional'),
(6, 'Lembaga Penelitian & Pendidikan'),
(7, 'BUMN/BUMD'),
(8, 'Swasta'),
(9, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebutuhan_data`
--

CREATE TABLE `kebutuhan_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `respondent_id` bigint(20) UNSIGNED NOT NULL,
  `rincian_data` varchar(255) NOT NULL,
  `wilayah_data` varchar(255) NOT NULL,
  `tahun_data` varchar(255) NOT NULL,
  `level_data` enum('Nasional','Provinsi','Kabupaten/Kota','Kecamatan','Desa/Kelurahan','Individu','Lainnya') NOT NULL,
  `periode_data` enum('Sepuluh tahunan','Lima tahunan','Tiga tahunan','Tahunan','Semesteran','Triwulanan','Bulanan','Mingguan','Harian','Lainnya') NOT NULL,
  `data_diperoleh` enum('Ya, sesuai','Ya, tidak sesuai','Tidak diperoleh','Belum diperoleh') NOT NULL,
  `jenis_sumber_data` enum('Publikasi','Data Mikro','Peta','Tabulasi Data','Tabel di Website') DEFAULT NULL,
  `judul_sumber_data` varchar(255) DEFAULT NULL,
  `tahun_publikasi` varchar(4) DEFAULT NULL,
  `digunakan_perencanaan` tinyint(1) DEFAULT NULL,
  `kualitas_data` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuesioners`
--

CREATE TABLE `kuesioners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_07_12_192909_create_respondents_table', 1),
(6, '2025_07_12_205820_create_kebutuhandata_table', 1),
(7, '2025_07_15_125326_create_pendidikans_table', 1),
(8, '2025_07_15_125440_create_pekerjaans_table', 1),
(9, '2025_07_15_125449_create_instansis_table', 1),
(10, '2025_07_15_125458_create_pemanfaatans_table', 1),
(11, '2025_07_15_133457_add_foreign_keys_to_respondents_table', 1),
(12, '2025_07_16_075204_create_kuesioners_table', 1),
(13, '2025_07_23_173703_add_unique_token_to_respondents_table', 1),
(14, '2025_08_04_185840_create_petugas_table', 1),
(15, '2025_08_04_185944_add_penilaian_fields_to_respondents_table', 1),
(16, '2025_08_25_153906_create_buku_tamus_table', 1),
(17, '2025_08_25_154955_create_data_skds_table', 1),
(18, '2025_08_26_181515_remove_unique_from_email_columns', 1),
(19, '2025_08_29_135532_add_status_to_respondents_table', 2),
(20, '2025_09_03_011247_add_role_to_users_table', 3),
(23, '2014_10_12_100000_create_password_resets_table', 5),
(24, '2025_09_03_075830_modify_users_for_username_login', 6),
(25, '2025_09_08_093553_add_run_request_to_respondents_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pekerjaans`
--

CREATE TABLE `pekerjaans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pekerjaans`
--

INSERT INTO `pekerjaans` (`id`, `nama`) VALUES
(1, 'Pelajar/Mahasiswa'),
(2, 'Peneliti/Dosen'),
(3, 'ASN/TNI/POLRI'),
(4, 'Pegawai BUMN/BUMD'),
(5, 'Pegawai Swasta'),
(6, 'Wiraswasta'),
(7, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemanfaatans`
--

CREATE TABLE `pemanfaatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pemanfaatans`
--

INSERT INTO `pemanfaatans` (`id`, `nama`) VALUES
(1, 'Tugas Sekolah/Tugas Kuliah'),
(2, 'Pemerintahan'),
(3, 'Komersial'),
(4, 'Penelitian'),
(5, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikans`
--

CREATE TABLE `pendidikans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendidikans`
--

INSERT INTO `pendidikans` (`id`, `nama`) VALUES
(1, '<= SLTA/Sederajat'),
(2, 'D1/D2/D3'),
(3, 'D4/S1'),
(4, 'S2'),
(5, 'S3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `path_foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `nama`, `path_foto`, `created_at`, `updated_at`) VALUES
(1, 'Fajar', 'fotos_petugas/Fajar.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(2, 'Indah', 'fotos_petugas/Indah.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(3, 'Ismail', 'fotos_petugas/Ismail.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(4, 'Izza', 'fotos_petugas/Izza.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(5, 'Kiki', 'fotos_petugas/Kiki.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(6, 'Naja', 'fotos_petugas/Naja.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(7, 'Renata', 'fotos_petugas/Renata.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(8, 'Taslim', 'fotos_petugas/Taslim.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(9, 'Thomi', 'fotos_petugas/Thomi.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(10, 'Winda', 'fotos_petugas/Winda.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(11, 'Zidan', 'fotos_petugas/Zidan.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53'),
(12, 'Zifah', 'fotos_petugas/Zifah.png', '2025-08-28 09:54:53', '2025-08-28 09:54:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `respondents`
--

CREATE TABLE `respondents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unique_token` char(36) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `pendidikan_id` bigint(20) UNSIGNED NOT NULL,
  `pekerjaan_id` bigint(20) UNSIGNED NOT NULL,
  `instansi_id` bigint(20) UNSIGNED NOT NULL,
  `pemanfaatan_id` bigint(20) UNSIGNED NOT NULL,
  `pekerjaan_lainnya` varchar(255) DEFAULT NULL,
  `instansi_lainnya` varchar(255) DEFAULT NULL,
  `pemanfaatan_lainnya` varchar(255) DEFAULT NULL,
  `nama_instansi` varchar(255) NOT NULL,
  `jenis_layanan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`jenis_layanan`)),
  `sarana_digunakan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sarana_digunakan`)),
  `sarana_lainnya` varchar(255) DEFAULT NULL,
  `pernah_pengaduan` varchar(255) NOT NULL,
  `penilaian` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`penilaian`)),
  `kebutuhan_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`kebutuhan_data`)),
  `catatan` text DEFAULT NULL,
  `status` enum('pending','sukses','gagal') NOT NULL DEFAULT 'pending',
  `run_request` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `petugas_id` bigint(20) UNSIGNED DEFAULT NULL,
  `petugas_lainnya_nama` varchar(255) DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `kritik_saran` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `respondents`
--

INSERT INTO `respondents` (`id`, `unique_token`, `nama`, `email`, `no_hp`, `jenis_kelamin`, `pendidikan_id`, `pekerjaan_id`, `instansi_id`, `pemanfaatan_id`, `pekerjaan_lainnya`, `instansi_lainnya`, `pemanfaatan_lainnya`, `nama_instansi`, `jenis_layanan`, `sarana_digunakan`, `sarana_lainnya`, `pernah_pengaduan`, `penilaian`, `kebutuhan_data`, `catatan`, `status`, `run_request`, `created_at`, `updated_at`, `petugas_id`, `petugas_lainnya_nama`, `rating`, `kritik_saran`) VALUES
(1, 'e8fae70b-c37b-43fd-b4a4-b2d689dc7a76', 'renata', 'deardo@gmail.com', '082172201213', 'Perempuan', 1, 7, 9, 5, 'asdf', 'asdfg', 'asdfghj', 'asdfgh', '[\"Konsultasi Statistik\",\"Rekomendasi Kegiatan\"]', '[\"Website BPS\",\"Surat\\/Email\",\"Aplikasi Chat\",\"Lainnya\"]', 'asdfghjk', 'Ya', '{\"q1\":{\"kepentingan\":\"9\",\"kepuasan\":\"9\"},\"q2\":{\"kepentingan\":\"9\",\"kepuasan\":\"9\"},\"q3\":{\"kepentingan\":\"9\",\"kepuasan\":\"9\"},\"q4\":{\"kepentingan\":\"9\",\"kepuasan\":\"9\"},\"q5\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q6\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q7\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q8\":{\"fasilitas_utama\":\"Surat\\/Email\",\"kepentingan\":\"10\",\"kepuasan\":\"9\"},\"q9\":{\"kepentingan\":\"7\",\"kepuasan\":\"8\"},\"q10\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q11\":{\"kepentingan\":\"7\",\"kepuasan\":\"6\"},\"q12\":{\"kepentingan\":\"6\",\"kepuasan\":\"8\"},\"q13\":{\"kepentingan\":\"8\",\"kepuasan\":\"6\"},\"q14\":{\"kepentingan\":\"6\",\"kepuasan\":\"7\"},\"q15\":{\"kepentingan\":\"7\",\"kepuasan\":\"6\"},\"q16\":{\"kepentingan\":\"6\",\"kepuasan\":\"5\"},\"q17\":{\"kepentingan\":\"6\",\"kepuasan\":\"10\"}}', '[{\"rincian_data\":\"ipm\",\"wilayah_data\":\"pinrang\",\"tahun_data\":\"2024\",\"level_data\":\"nasional\",\"level_data_lainnya\":\"\",\"periode_data\":\"lainnya\",\"periode_data_lainnya\":\"qwerty\",\"data_diperoleh\":\"tidak diperoleh\",\"jenis_publikasi\":\"\",\"judul_publikasi\":\"\",\"tahun_publikasi\":\"\",\"digunakan_perencanaan\":null,\"kualitas_data\":null,\"id\":1756376444306,\"tahun_awal\":\"2020\",\"tahun_akhir\":\"2020\"},{\"rincian_data\":\"dsadsf\",\"wilayah_data\":\"fdsfd\",\"tahun_data\":\"gfdgdfg\",\"level_data\":\"provinsi\",\"level_data_lainnya\":\"\",\"periode_data\":\"semesteran\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"ya sesuai\",\"jenis_publikasi\":\"Data Mikro\",\"judul_publikasi\":\"ipm\",\"tahun_publikasi\":\"2020\",\"digunakan_perencanaan\":null,\"kualitas_data\":\"4\",\"id\":1756376484127,\"tahun_awal\":\"2015\",\"tahun_akhir\":\"2021\"}]', NULL, 'sukses', NULL, '2025-08-28 10:22:50', '2025-09-06 02:35:44', 12, NULL, 5, NULL),
(3, 'af7aee35-6bf9-47d8-be03-b3b8e1c5ba28', 'renata2', '222011432@stis.ac.id', '15102021052', 'Perempuan', 1, 3, 9, 5, NULL, 'dsssf', 'fsdfsdfsdf', 'dsfsdfsdf', '[\"Rekomendasi Kegiatan\"]', '[\"Aplikasi Chat\"]', NULL, 'Tidak', '{\"q1\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q2\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q3\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q4\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q5\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q6\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q7\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q8\":{\"fasilitas_utama\":\"Aplikasi Chat\",\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q9\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q10\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q11\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q13\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q14\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q15\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q16\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"},\"q17\":{\"kepentingan\":\"6\",\"kepuasan\":\"6\"}}', '[{\"rincian_data\":\"ipm\",\"wilayah_data\":\"pinrang\",\"tahun_awal\":\"2020\",\"tahun_akhir\":\"2021\",\"level_data\":\"kabupaten\\/kota\",\"level_data_lainnya\":\"\",\"periode_data\":\"lima tahunan\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"tidak diperoleh\",\"jenis_publikasi\":\"\",\"judul_publikasi\":\"\",\"tahun_publikasi\":\"\",\"digunakan_perencanaan\":null,\"kualitas_data\":null,\"id\":1756386302360}]', NULL, 'sukses', NULL, '2025-08-28 13:05:08', '2025-09-08 04:14:09', 3, NULL, 4, NULL),
(4, '893915d6-047a-4d11-95f8-8c4a29874856', 'dsfsfsf', '222011432@stis.ac.id', '0515202052', 'Perempuan', 2, 3, 3, 3, NULL, NULL, NULL, 'fsdfsdfsd', '[\"Rekomendasi Kegiatan\"]', '[\"PST Online\",\"Website BPS\"]', NULL, 'Tidak', '{\"q1\":{\"kepentingan\":\"8\",\"kepuasan\":\"8\"},\"q2\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q3\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q4\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q5\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q6\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q7\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q8\":{\"fasilitas_utama\":\"Website BPS\",\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q9\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q10\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q11\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q13\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q14\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q15\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q16\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"},\"q17\":{\"kepentingan\":\"7\",\"kepuasan\":\"7\"}}', '[{\"rincian_data\":\"ipm\",\"wilayah_data\":\"dcsdfsd\",\"tahun_awal\":\"2014\",\"tahun_akhir\":\"2020\",\"level_data\":\"provinsi\",\"level_data_lainnya\":\"\",\"periode_data\":\"lima tahunan\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"belum diperoleh\",\"jenis_publikasi\":\"\",\"judul_publikasi\":\"\",\"tahun_publikasi\":\"\",\"digunakan_perencanaan\":null,\"kualitas_data\":null,\"id\":1756387128325}]', NULL, 'sukses', NULL, '2025-08-28 13:18:53', '2025-09-06 02:39:52', NULL, 'andi hary', 5, NULL),
(5, '3bb2cd3a-c183-42d7-8eba-c32b9935480e', 'dsdfdsf', '222011432@stis.ac.id', '125102513236', 'Perempuan', 2, 3, 1, 4, NULL, NULL, NULL, 'sdfsfdsfsd', '[\"Konsultasi Statistik\",\"Rekomendasi Kegiatan\"]', '[\"PST Datang Langsung\",\"Website BPS\"]', NULL, 'Tidak', '{\"q1\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q2\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q3\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q4\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q5\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q6\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q7\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q8\":{\"fasilitas_utama\":\"Website BPS\",\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q9\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q10\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q11\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q13\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q14\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q15\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q16\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q17\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"}}', '[{\"rincian_data\":\"ipm\",\"wilayah_data\":\"pinrang\",\"tahun_awal\":\"2020\",\"tahun_akhir\":\"2022\",\"level_data\":\"nasional\",\"level_data_lainnya\":\"\",\"periode_data\":\"sepuluh tahunan\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"tidak diperoleh\",\"jenis_publikasi\":\"\",\"judul_publikasi\":\"\",\"tahun_publikasi\":\"\",\"digunakan_perencanaan\":null,\"kualitas_data\":null,\"id\":1756388526027}]', NULL, 'sukses', NULL, '2025-08-28 13:42:12', '2025-09-06 03:06:25', NULL, NULL, 5, NULL),
(6, '6cb1cbf3-06d5-4778-9dd1-c4d77c86fbde', 'delarosaaaa', '222011432@stis.ac.id', '8534594543', 'Perempuan', 3, 5, 6, 3, NULL, NULL, NULL, 'dgdgg', '[\"Rekomendasi Kegiatan\"]', '[\"Website BPS\",\"Aplikasi Chat\"]', NULL, 'Tidak', '{\"q1\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q2\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q3\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q4\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q5\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q6\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q7\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q8\":{\"fasilitas_utama\":\"Website BPS\",\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q9\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q10\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q11\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q13\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q14\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q15\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q16\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q17\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"}}', '[]', NULL, 'sukses', NULL, '2025-08-29 22:53:24', '2025-09-06 02:49:03', 1, NULL, 4, NULL),
(7, '0ac993e5-b651-45c5-813d-d3d44f30185b', 'Pimpi', 'pimpi@gmail.com', '082345785423', 'Laki-laki', 3, 6, 8, 3, NULL, NULL, NULL, 'PT. Cetar Membahana', '[\"Perpustakaan\"]', '[\"PST Datang Langsung\"]', NULL, 'Tidak', '{\"q1\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q2\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q3\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q4\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q5\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q6\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q7\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q8\":{\"fasilitas_utama\":\"PST Datang Langsung\",\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q9\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q10\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q11\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q13\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q14\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q15\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q16\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q17\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"}}', '[{\"rincian_data\":\"Indeks Perkembangan Gender\",\"wilayah_data\":\"pinrang\",\"tahun_awal\":2024,\"tahun_akhir\":2024,\"level_data\":\"kabupaten\\/kota\",\"level_data_lainnya\":\"\",\"periode_data\":\"tahunan\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"ya sesuai\",\"jenis_publikasi\":\"Publikasi\",\"judul_publikasi\":\"Indeks Perkembangan Gender\",\"tahun_publikasi\":\"2024\",\"digunakan_perencanaan\":null,\"kualitas_data\":\"10\",\"id\":1756885783745}]', '-', 'sukses', NULL, '2025-09-03 07:49:58', '2025-09-08 02:02:26', 9, NULL, 5, 'Pelayanan Memuaskan'),
(10, 'b1d6b6b5-8d59-4e0d-b7a2-5205e1a2d791', 'Chrishelle Sunjoyooo', 'pushme@yahoo.com', '081190825454', 'Perempuan', 4, 2, 6, 1, NULL, NULL, NULL, 'Universitas Pelita Harapan', '[\"Perpustakaan\"]', '[\"PST Datang Langsung\"]', NULL, 'Ya', '{\"q1\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q2\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q3\":{\"kepentingan\":\"8\",\"kepuasan\":\"9\"},\"q4\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q5\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q6\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q7\":{\"kepentingan\":\"9\",\"kepuasan\":\"9\"},\"q8\":{\"fasilitas_utama\":\"PST Datang Langsung\",\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q9\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q10\":{\"kepentingan\":\"8\",\"kepuasan\":\"10\"},\"q11\":{\"kepentingan\":\"9\",\"kepuasan\":\"10\"},\"q12\":{\"kepentingan\":\"9\",\"kepuasan\":\"9\"},\"q13\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q14\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q15\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q16\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q17\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"}}', '[{\"rincian_data\":\"PDRB Triwulanan\",\"wilayah_data\":\"Pinrang\",\"tahun_awal\":2025,\"tahun_akhir\":2025,\"level_data\":\"kabupaten\\/kota\",\"level_data_lainnya\":\"\",\"periode_data\":\"triwulanan\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"ya sesuai\",\"jenis_publikasi\":\"Tabel di Website\",\"judul_publikasi\":\"Tabel PDRB Triwulanan Menurut Lapangan Usaha\",\"tahun_publikasi\":\"2025\",\"digunakan_perencanaan\":null,\"kualitas_data\":\"10\",\"id\":1756886168642}]', 'Jijik', 'sukses', NULL, '2025-09-03 07:56:35', '2025-09-07 12:38:33', 7, NULL, 5, 'Akhlakless'),
(12, '230d8a64-cbb2-43a0-8acc-a16a72a6a15a', 'Delarosa Renata', 'delarosarenata@gmail.com', '082172201213', 'Perempuan', 3, 2, 1, 1, NULL, NULL, NULL, 'BPS RI', '[\"Perpustakaan\"]', '[\"Website BPS\",\"Surat\\/Email\"]', NULL, 'Tidak', '{\"q1\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q2\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q3\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q4\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q5\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q6\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q7\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q8\":{\"fasilitas_utama\":\"Website BPS\",\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q9\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q10\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q11\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q13\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q14\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q15\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q16\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"},\"q17\":{\"kepentingan\":\"10\",\"kepuasan\":\"10\"}}', '[{\"rincian_data\":\"Indeks Pembangunan Manusia\",\"wilayah_data\":\"Pinrang\",\"tahun_awal\":2020,\"tahun_akhir\":2020,\"level_data\":\"nasional\",\"level_data_lainnya\":\"\",\"periode_data\":\"lima tahunan\",\"periode_data_lainnya\":\"\",\"data_diperoleh\":\"tidak diperoleh\",\"jenis_publikasi\":\"\",\"judul_publikasi\":\"\",\"tahun_publikasi\":\"\",\"digunakan_perencanaan\":null,\"kualitas_data\":null,\"id\":1757236233243}]', 'okai', 'sukses', NULL, '2025-09-07 09:10:45', '2025-09-07 10:02:23', 7, NULL, 5, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'petugas',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Supervisor', 'admin', NULL, '$2y$12$qMH8KVqU3kOf0ip8LecXRuGlHStA2W/22itImSP8Mdd/DCHhHGJrK', 'admin', NULL, '2025-09-03 02:36:44', '2025-09-03 02:36:44'),
(2, 'Petugas PST', 'petugas', NULL, '$2y$12$Ri5ev4QuNCi75QN4Fd5TEe/M.7MDePeEtwwN3xnnHTtdA0qQpwK6O', 'petugas', NULL, '2025-09-03 02:36:45', '2025-09-03 02:36:45'),
(3, 'Supervisor PST', 'supervisorpst', NULL, '$2y$12$O8HVKVfAFvJV/b2pP9rB8eGJCWPoRYl68vIlHjG2D2hmYPpqZSTtG', 'supervisor', NULL, '2025-09-03 02:40:20', '2025-09-03 02:40:20'),
(4, 'Renata De La Rosa Manik', 'renata', NULL, '$2y$12$hJITkLYcDU5TelOjlivRHewKiaqifRvNrbGXz3xnheX34dbwI6tFC', 'petugas', NULL, '2025-09-03 02:40:34', '2025-09-03 02:40:34'),
(5, 'Andi Hary Mulyadi', 'hary', NULL, '$2y$12$GYaw0OpN9zWtNtvHd0m9EuWVrR8UtJGqs6qSvDyj8FzhgyrUX91T6', 'admin', NULL, '2025-09-03 02:40:48', '2025-09-03 02:40:48'),
(9, 'Joko Siswanto', 'joko', NULL, '$2y$12$l63vM73S/JrrAALzCYMkI.DJgWH5dX19yEjvU4wIwBA2i23x/.NxK', 'supervisor', NULL, '2025-09-06 03:07:56', '2025-09-06 03:07:56');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku_tamus`
--
ALTER TABLE `buku_tamus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_skds`
--
ALTER TABLE `data_skds`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `instansis`
--
ALTER TABLE `instansis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kebutuhan_data`
--
ALTER TABLE `kebutuhan_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kebutuhan_data_respondent_id_foreign` (`respondent_id`);

--
-- Indeks untuk tabel `kuesioners`
--
ALTER TABLE `kuesioners`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pekerjaans`
--
ALTER TABLE `pekerjaans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemanfaatans`
--
ALTER TABLE `pemanfaatans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendidikans`
--
ALTER TABLE `pendidikans`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `respondents`
--
ALTER TABLE `respondents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `respondents_unique_token_unique` (`unique_token`),
  ADD KEY `respondents_pendidikan_id_foreign` (`pendidikan_id`),
  ADD KEY `respondents_pekerjaan_id_foreign` (`pekerjaan_id`),
  ADD KEY `respondents_instansi_id_foreign` (`instansi_id`),
  ADD KEY `respondents_pemanfaatan_id_foreign` (`pemanfaatan_id`),
  ADD KEY `respondents_petugas_id_foreign` (`petugas_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku_tamus`
--
ALTER TABLE `buku_tamus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `data_skds`
--
ALTER TABLE `data_skds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `instansis`
--
ALTER TABLE `instansis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kebutuhan_data`
--
ALTER TABLE `kebutuhan_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kuesioners`
--
ALTER TABLE `kuesioners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pekerjaans`
--
ALTER TABLE `pekerjaans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pemanfaatans`
--
ALTER TABLE `pemanfaatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pendidikans`
--
ALTER TABLE `pendidikans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `respondents`
--
ALTER TABLE `respondents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kebutuhan_data`
--
ALTER TABLE `kebutuhan_data`
  ADD CONSTRAINT `kebutuhan_data_respondent_id_foreign` FOREIGN KEY (`respondent_id`) REFERENCES `respondents` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `respondents`
--
ALTER TABLE `respondents`
  ADD CONSTRAINT `respondents_instansi_id_foreign` FOREIGN KEY (`instansi_id`) REFERENCES `instansis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respondents_pekerjaan_id_foreign` FOREIGN KEY (`pekerjaan_id`) REFERENCES `pekerjaans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respondents_pemanfaatan_id_foreign` FOREIGN KEY (`pemanfaatan_id`) REFERENCES `pemanfaatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respondents_pendidikan_id_foreign` FOREIGN KEY (`pendidikan_id`) REFERENCES `pendidikans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `respondents_petugas_id_foreign` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
