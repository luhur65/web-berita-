-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 31 Des 2010 pada 20.32
-- Versi Server: 10.1.24-MariaDB
-- PHP Version: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web-berita`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `comment`
--

CREATE TABLE `comment` (
  `comKey` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Comments` text NOT NULL,
  `write` date NOT NULL,
  `berita` int(11) NOT NULL,
  `ditanggapi` int(1) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `comment`
--

INSERT INTO `comment` (`comKey`, `Name`, `Comments`, `write`, `berita`, `ditanggapi`, `img`) VALUES
(1, 'boy', 'Hai , Admin Salam Kenal', '2010-12-31', 1, 1, 'comenters.png'),
(2, 'Sukijat', 'Min saya udah dftar akun udah ada pemberitahuan akun berhasill dibuat tapi kenapa ya saya gk bisa login ?? ada error kah ', '2010-12-31', 2, 1, 'comenters.png'),
(3, 'Japri', 'min gambar berita saya kok gak muncul di home ?? ', '2010-12-31', 2, 1, 'comenters.png'),
(4, 'bot', 'hai admin , salam kenal juga \r\nsaya dari jogja ', '2010-12-31', 3, 0, 'comenters.png'),
(5, 'suweora', 'Min , Webnya bagus . Good Job', '2010-12-31', 3, 1, 'comenters.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penulis`
--

CREATE TABLE `penulis` (
  `id` int(11) NOT NULL,
  `full_name` varchar(288) NOT NULL,
  `tgllahir` date NOT NULL,
  `jenis_gender` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `hp` varchar(50) NOT NULL,
  `icon` varchar(250) NOT NULL,
  `join` date NOT NULL,
  `is_active` int(1) NOT NULL,
  `username` varchar(288) NOT NULL,
  `email` varchar(288) NOT NULL,
  `password` varchar(288) NOT NULL,
  `user_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penulis`
--

INSERT INTO `penulis` (`id`, `full_name`, `tgllahir`, `jenis_gender`, `alamat`, `hp`, `icon`, `join`, `is_active`, `username`, `email`, `password`, `user_role`) VALUES
(2, 'User Public Testing', '2002-01-02', '-', 'Jl.Testing No 56 Sumatera Utara', '0812 XXX XXX', '4d1e3e69d747a.png', '2010-12-31', 1, 'user', 'user_test@gmail.com', '$2y$10$dL2dQ8qP2jYnkPkkpNOWxO6Nz5CIx0.96tHSh9O5ahfM6RuVpGlyS', 2),
(3, 'Admin WebBerita ', '2002-01-17', 'Laki-Laki', 'Jl.Tobanauli', '081265561201', '4d1e1abb33f65.jpg', '2010-12-31', 1, 'admin', 'dharmabakti1202@gmail.com', '$2y$10$yocfov5tVRL87CZEN160xOJgO/QX3egj2TLrtm7ts1hx5ScbSiHcu', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reply_send`
--

CREATE TABLE `reply_send` (
  `idreply` int(11) NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `tujuanPesan` varchar(255) NOT NULL,
  `balasan` text NOT NULL,
  `date` date NOT NULL,
  `id_commentar` int(11) NOT NULL,
  `tempatberita` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reply_send`
--

INSERT INTO `reply_send` (`idreply`, `pengirim`, `tujuanPesan`, `balasan`, `date`, `id_commentar`, `tempatberita`) VALUES
(1, 'user', 'boy', 'Salam Kenal Juga Boy .', '2010-12-31', 1, 1),
(2, 'admin', '', 'Mohon Maaf atas Tidak bisanya akun anda login . Jika akun anda berhasil dibuat maka di dashboard saya list akun yg mendaftar akan bertambah satu tapi disini tidak ada tambah satupun mungkin masalahnya anda menginput karakter yg tidak bisa di inputkan , coba buat akun dengan tidak memasukkan karakter yg aneh \r\nsalam Admin ', '2010-12-31', 2, 2),
(3, 'admin', 'Japri', 'Coba dihapus Berita yg gambarnya tidak kelihatan kemudian upload berita tersebut dan pastikan ukuran gambarnya tidak lebih \r\n 1 MB dan size nya tidak kelebaran atw ketinggian . Terimakasih Semoga bermanfaat \r\n.Salam Admin', '2010-12-31', 3, 2),
(4, 'admin', 'suweora', 'Terimakasih Atas Pendapatnya Yaa', '2010-12-31', 5, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_news`
--

CREATE TABLE `tb_news` (
  `idberita` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `berita` text NOT NULL,
  `tglberita` date NOT NULL,
  `jamberita` time NOT NULL,
  `penulis` int(11) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `isi_lengkap` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_news`
--

INSERT INTO `tb_news` (`idberita`, `judul`, `berita`, `tglberita`, `jamberita`, `penulis`, `gambar`, `isi_lengkap`) VALUES
(1, 'Test Upload Berita', 'Sambutan &amp; Perkenalan ', '2010-12-31', '06:23:32', 2, '4d1e11947fe64.jpg', 'Bagi Yg Baru Bergabung ., Saya Ucapkan Terimakasih '),
(2, 'Welcome To My Web', 'Sambutan &amp; Perkenalan ', '2010-12-31', '06:09:50', 1, '4d1e0e5e7fc60.jpg', 'Ini Web Untuk Have Fun Saja . Banyak Fitur yg bisa anda Coba setelah anda menjadi Member di Website Kami .\r\nTunggu Apa lagi Ayo Buat akun Anda Sekarang Dan Nikmati beragam fitur menarik disini \r\nsalam admin '),
(3, 'Welcome To My Website', 'Introduce My Self', '2010-12-31', '07:50:19', 3, '4d1e25ebf35c5.jpg', 'Hello , Saya Adalah Admin Web Ini , Terimakasih Anda Telah Berkunjung Kemari');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comKey`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_send`
--
ALTER TABLE `reply_send`
  ADD PRIMARY KEY (`idreply`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`idberita`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comKey` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reply_send`
--
ALTER TABLE `reply_send`
  MODIFY `idreply` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `idberita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
