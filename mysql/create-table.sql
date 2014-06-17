DROP DATABASE IF EXISTS `kbli`;
CREATE DATABASE `kbli`;
USE `kbli`;
CREATE TABLE `kategori` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `kd` CHAR(1) NOT NULL,
 `judul` VARCHAR(200) NOT NULL,
 `deskripsi` TEXT,
 PRIMARY KEY (`id`),
 UNIQUE INDEX `kategori` (`kd`)
) ENGINE=MyISAM;
CREATE TABLE `gol_pok` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `kategori` INT NOT NULL,
 `gol_pok` CHAR(2) NOT NULL,
 `judul` VARCHAR(200) NOT NULL,
 `deskripsi` TEXT,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE,
 UNIQUE INDEX `gol_pok` (`gol_pok`)
) ENGINE=MyISAM;
CREATE TABLE `gol` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `gol_pok` INT NOT NULL,
 `gol` CHAR(3) NOT NULL,
 `judul` VARCHAR(200) NOT NULL,
 `deskripsi` TEXT,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`gol_pok`) REFERENCES `gol_pok` (`id`) ON DELETE CASCADE,
 UNIQUE INDEX `gol` (`gol`)
) ENGINE=MyISAM;
CREATE TABLE `sub_gol` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `gol` INT NOT NULL,
 `sub_gol` CHAR(4) NOT NULL,
 `judul` VARCHAR(200) NOT NULL,
 `deskripsi` TEXT,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`gol`) REFERENCES `gol` (`id`) ON DELETE CASCADE,
 UNIQUE INDEX `sub_gol` (`sub_gol`)
) ENGINE=MyISAM;
CREATE TABLE `kelompok` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `sub_gol` INT NOT NULL,
 `kelompok` CHAR(5) NOT NULL,
 `judul` VARCHAR(200) NOT NULL,
 `deskripsi` TEXT,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`sub_gol`) REFERENCES `sub_gol` (`id`) ON DELETE CASCADE,
 UNIQUE INDEX `kelompok` (`kelompok`)
) ENGINE=MyISAM;

