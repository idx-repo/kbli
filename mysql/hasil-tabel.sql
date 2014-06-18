-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jun 2014 pada 06.48
-- Versi Server: 5.5.36
-- PHP Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `kbli`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `gol`
--

CREATE TABLE IF NOT EXISTS `gol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gol_pok` int(11) NOT NULL,
  `gol` char(3) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gol` (`gol`),
  KEY `gol_pok` (`gol_pok`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `gol`
--

INSERT INTO `gol` (`id`, `gol_pok`, `gol`, `judul`, `deskripsi`) VALUES
(1, 1, '011', 'PERTANIAN TANAMAN SEMUSIM', 'Golongan ini mencakup penanaman tanaman yang tidak berlangsung lebih dari\r\ndua musim panen. Termasuk penanaman tanaman dalam berbagai media dan\r\nbudidaya tanaman secara genetik, dan juga penanamanuntuk tujuan\r\npembibitan dan pembenihan.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gol_pok`
--

CREATE TABLE IF NOT EXISTS `gol_pok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` int(11) NOT NULL,
  `gol_pok` char(2) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gol_pok` (`gol_pok`),
  KEY `kategori` (`kategori`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `gol_pok`
--

INSERT INTO `gol_pok` (`id`, `kategori`, `gol_pok`, `judul`, `deskripsi`) VALUES
(1, 1, '01', 'PERTANIAN TANAMAN, PETERNAKAN, PERBURUAN DAN KEGIATAN\r\nYBDI', 'Golongan pokok ini mencakup pertanian tanaman pangan, tanaman\r\nperkebunan dan hortikultura; usaha pemeliharaan hewan ternak dan unggas;\r\nperburuan dan penangkapan hewan dengan perangkap serta kegiatan\r\npenunjang ybdi yang ditujukan untuk dijual. Termasuk budidaya tanaman dan\r\nhewan ternak secara organik dan genetik. Kegiatan konstruksi lahan seperti\r\npembuatan petak-petak sawah, irigasi saluran pembuangan air, serta\r\npembersihan dan perbaikan lahan untuk pertanian tidak termasuk di sini, tetapi\r\ntercakup pada kategori konstruksi (F).');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kd` char(1) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kategori` (`kd`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kd`, `judul`, `deskripsi`) VALUES
(1, 'A', 'PERTANIAN, KEHUTANAN DAN PERIKANAN', 'Kategori ini mencakup semua kegiatan ekonomi/lapangan usaha, yang meliputi\r\npertanian tanaman pangan, tanaman perkebunan, hortikultura, peternakan,\r\npengambilan dan penanaman hasil hutan serta penangkapan dan budidaya\r\nikan/biota air. Kategori ini juga mencakup jasa penunjang masing-masing\r\nkegiatan ekonomi tersebut.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelompok`
--

CREATE TABLE IF NOT EXISTS `kelompok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_gol` int(11) NOT NULL,
  `kelompok` char(5) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kelompok` (`kelompok`),
  KEY `sub_gol` (`sub_gol`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `kelompok`
--

INSERT INTO `kelompok` (`id`, `sub_gol`, `kelompok`, `judul`, `deskripsi`) VALUES
(1, 1, '01111', 'PERTANIAN TANAMAN JAGUNG', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman serealia jagung.'),
(2, 1, '01112', 'PERTANIAN TANAMAN GANDUM', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman serealia gandum, seperti sorgum/cantel,\r\ngandum (wheat/oats), jelai (barley), gandum hitam (rye), jawawut (millet) dan\r\nsejenisnya.'),
(3, 1, '01113', 'PERTANIAN TANAMAN KEDELAI', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman kedelai (kacang palawija).'),
(4, 1, '01114', 'PERTANIAN TANAMAN KACANG TANAH', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman kacang tanah (kacangpalawija).'),
(5, 1, '01115', 'PERTANIAN TANAMAN KACANG HIJAU', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman kacang hijau (kacangpalawija).'),
(6, 1, '01116', 'PERTANIAN TANAMAN KACANG-KACANGAN HORTIKULTURA', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman tanaman kacang-kacangan hortikultura,\r\nseperti buncis, buncis besar, kacang panjang, kacang merah, gude, kara, kapri,\r\nkecipir, cow peas, miju-miju, lupin, kacang polong,pigeon peas dan tanaman\r\nkacang-kacangan lainnya.'),
(7, 1, '01117', 'PERTANIAN TANAMAN BIJI-BIJIAN PENGHASIL MINYAK MAKAN', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman biji-bijian penghasil minyak makan, seperti biji\r\nwijen, biji bunga matahari dan tanaman biji-bijian penghasil minyak makan\r\nlainnya.'),
(8, 1, '01118', 'PERTANIAN TANAMAN BIJI-BIJIAN PENGHASIL BUKAN MINYAKMAKAN', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman biji-bijian penghasil bukan minyak makan,\r\nseperti biji kapas, biji castor, biji rami, biji mustard, niger seeds, biji jarak dan\r\ntanaman biji-bijian penghasil bukan minyak makan lainnya.'),
(9, 1, '01119', 'PERTANIAN TANAMAN SEREALIA LAINNYA, KACANG-KACANGAN DAN\r\nBIJI-BIJIAN PENGHASIL MINYAK LAINNYA', 'Kelompok ini mencakup usaha pertanian mulai dari kegiatan pengolahan lahan,\r\npenanaman, pemeliharaan, dan juga pemanenan dan pasca panen jika menjadi\r\nsatu kesatuan kegiatan tanaman serealia lainnya bukan padi, jagung dan\r\ngandum, tanaman kacang-kacangan palawija lainnya dan pertanian tanaman\r\nlainnya yang belum diklasifikasikan pada kelompok 01111 s.d. 01118.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_gol`
--

CREATE TABLE IF NOT EXISTS `sub_gol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gol` int(11) NOT NULL,
  `sub_gol` char(4) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_gol` (`sub_gol`),
  KEY `gol` (`gol`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `sub_gol`
--

INSERT INTO `sub_gol` (`id`, `gol`, `sub_gol`, `judul`, `deskripsi`) VALUES
(1, 1, '0111', 'PERTANIAN TANAMAN SEREALIA (BUKAN PADI), KACANG-KACANGAN\r\nDAN BIJI-BIJIAN PENGHASIL MINYAK', 'Subgolongan ini mencakup semua tanaman serealia, pertanian\r\nkacang-kacangan dan penghasil minyak di lahan terbuka, termasuk pertanian\r\ntanaman organik dan pertanian tumbuhan yang telah dimodifikasi. Pertanian\r\ntanaman ini sering dikombinasikan dalam unit pertanian.\r\nSubgolongan ini mencakup :\r\n- Pertanian tanaman serealia seperti gandum, jagung, sorgum, gandum\r\nuntuk membuat bir (barley), gandum hitam (rye), oats, millet dan serealia\r\nlainnya\r\n- Pertanian tanaman kacang-kacangan palawija, mencakup kacang kedelai,\r\nkacang tanah dan kacang hijau \r\n- Pertanian tanaman kacang-kacangan hortikultura, mencakup buncis, buncis\r\nbesar, kacang panjang, cow peas, miju-miju, lupin, kacang polong, pigeon peas\r\ndan tanaman kacang-kacangan lainnya\r\n- Pertanian tanaman penghasil minyak, seperti biji kapas, biji castor, biji rami,\r\nbiji mustard, niger seeds, lobak, biji wijen, safflower seeds, biji bunga matahari\r\ndan tanaman penghasil minyak lainnya\r\nSubgolongan ini tidak mencakup :\r\n- Pertanian tanaman jagung (maize) untuk makanan ternak, lihat 0119');
