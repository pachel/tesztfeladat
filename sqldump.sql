-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server Version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server Betriebssystem:        Win64
-- HeidiSQL Version:             10.2.0.5740
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Struktur von Tabelle teszt.celok
CREATE TABLE IF NOT EXISTS `celok` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
    `nev` varchar(50) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle teszt.celok: ~10 rows (ungefähr)
/*!40000 ALTER TABLE `celok` DISABLE KEYS */;
INSERT INTO `celok` (`id`, `deleted`, `nev`) VALUES
                                                 (1, 0, 'Egy cél'),
                                                 (2, 0, 'Másik cél'),
                                                 (3, 0, 'Cél 3'),
                                                 (4, 0, 'Cél 4'),
                                                 (5, 0, 'Cél 5'),
                                                 (6, 0, 'Cél 6'),
                                                 (7, 0, 'Cél 7'),
                                                 (8, 0, 'Cél 8'),
                                                 (9, 0, 'Cél 9'),
                                                 (10, 0, 'Cél 10'),
                                                 (11, 0, 'Cél 11'),
                                                 (12, 0, 'Cél 12');
/*!40000 ALTER TABLE `celok` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle teszt.dolgozok
CREATE TABLE IF NOT EXISTS `dolgozok` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
    `nev` varchar(50) DEFAULT NULL,
    `munkakor` varchar(50) DEFAULT NULL,
    `torzsszam` bigint(20) DEFAULT NULL,
    `vezeto` int(10) unsigned NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle teszt.dolgozok: ~11 rows (ungefähr)
/*!40000 ALTER TABLE `dolgozok` DISABLE KEYS */;
INSERT INTO `dolgozok` (`id`, `deleted`, `nev`, `munkakor`, `torzsszam`, `vezeto`) VALUES
                                                                                       (1, 0, 'Tóth László vez.', 'Vezető', 1, 0),
                                                                                       (2, 0, 'Tóth László', 'Tesztelő', 1, 6),
                                                                                       (3, 1, 'Tóth László', 'Tesztelő', 1, 1),
                                                                                       (4, 1, 'Tóth László', 'Tesztelő', 1, 1),
                                                                                       (5, 0, 'Tóth László324', 'Tesztelő', 1, 1),
                                                                                       (6, 0, 'Vég Béla', 'Vezető', 1, 1),
                                                                                       (7, 1, 'Teszt', 'Nincs', 879797, 1),
                                                                                       (8, 1, 'Vezető 3', 'Vezető', 8797987, 0),
                                                                                       (9, 0, 'Béláé', 'sdfsdf', 1324324, 10),
                                                                                       (10, 0, 'Akárki vezető', 'adasdas', 324234234, 0),
                                                                                       (11, 0, 'sdfadsfasdfasdf', 'dasfasdf', 324234234, 10);
/*!40000 ALTER TABLE `dolgozok` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle teszt.dolgozok_ertekelesei
CREATE TABLE IF NOT EXISTS `dolgozok_ertekelesei` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `deleted` tinyint(3) unsigned DEFAULT 0,
    `id_lezart_ertekelesek` int(10) unsigned DEFAULT 0,
    `id_celok` int(10) unsigned NOT NULL,
    `id_dolgozok` int(10) unsigned NOT NULL,
    `pont` int(10) unsigned NOT NULL,
    `prioritas` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=126 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle teszt.dolgozok_ertekelesei: ~113 rows (ungefähr)
/*!40000 ALTER TABLE `dolgozok_ertekelesei` DISABLE KEYS */;
INSERT INTO `dolgozok_ertekelesei` (`id`, `deleted`, `id_lezart_ertekelesek`, `id_celok`, `id_dolgozok`, `pont`, `prioritas`) VALUES
                                                                                                                                  (1, 0, 1, 10, 5, 0, 1),
                                                                                                                                  (2, 0, 1, 11, 5, 100, 1),
                                                                                                                                  (3, 0, 1, 12, 5, 20, 1),
                                                                                                                                  (4, 0, 1, 10, 6, 100, 1),
                                                                                                                                  (5, 0, 1, 11, 6, 40, 1),
                                                                                                                                  (6, 0, 1, 12, 6, 100, 1),
                                                                                                                                  (7, 0, 2, 11, 9, 20, 1),
                                                                                                                                  (8, 0, 2, 10, 9, 20, 1),
                                                                                                                                  (9, 0, 2, 12, 9, 20, 1),
                                                                                                                                  (10, 0, 2, 10, 11, 100, 1),
                                                                                                                                  (11, 0, 2, 11, 11, 80, 1),
                                                                                                                                  (12, 0, 2, 12, 11, 40, 1);
/*!40000 ALTER TABLE `dolgozok_ertekelesei` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle teszt.ertekek
CREATE TABLE IF NOT EXISTS `ertekek` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `deleted` tinyint(3) unsigned NOT NULL DEFAULT 0,
    `nev` varchar(50) NOT NULL DEFAULT '0',
    `pont` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle teszt.ertekek: ~6 rows (ungefähr)
/*!40000 ALTER TABLE `ertekek` DISABLE KEYS */;
INSERT INTO `ertekek` (`id`, `deleted`, `nev`, `pont`) VALUES
                                                           (1, 0, 'Kiváló', 100),
                                                           (2, 0, 'Jó', 80),
                                                           (3, 0, 'Változó', 60),
                                                           (4, 0, 'Fejlesztendő', 40),
                                                           (5, 0, 'Erősen fejlesztendő', 20),
                                                           (6, 0, 'Kritikus', 0);
/*!40000 ALTER TABLE `ertekek` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle teszt.lezart_ertekelesek
CREATE TABLE IF NOT EXISTS `lezart_ertekelesek` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `vezeto` int(10) unsigned NOT NULL DEFAULT 0,
    `deleted` tinyint(1) unsigned NOT NULL DEFAULT 0,
    `datum` datetime NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle teszt.lezart_ertekelesek: ~0 rows (ungefähr)
/*!40000 ALTER TABLE `lezart_ertekelesek` DISABLE KEYS */;
INSERT INTO `lezart_ertekelesek` (`id`, `vezeto`, `deleted`, `datum`) VALUES
                                                                          (1, 1, 0, '2023-04-03 13:38:45'),
                                                                          (2, 10, 0, '2023-04-03 13:40:33');
/*!40000 ALTER TABLE `lezart_ertekelesek` ENABLE KEYS */;

-- Exportiere Struktur von Tabelle teszt.prioritasok
CREATE TABLE IF NOT EXISTS `prioritasok` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `deleted` tinyint(4) DEFAULT 0,
    `nev` varchar(50) DEFAULT NULL,
    `ertek` int(1) DEFAULT 1,
    `maximum` int(1) DEFAULT 1,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Exportiere Daten aus Tabelle teszt.prioritasok: ~3 rows (ungefähr)
/*!40000 ALTER TABLE `prioritasok` DISABLE KEYS */;
INSERT INTO `prioritasok` (`id`, `deleted`, `nev`, `ertek`, `maximum`) VALUES
                                                                           (1, 0, 'Alacsony', 1, 100),
                                                                           (2, 0, 'Közepes', 2, 30),
                                                                           (3, 0, 'Magas', 3, 25);
/*!40000 ALTER TABLE `prioritasok` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
