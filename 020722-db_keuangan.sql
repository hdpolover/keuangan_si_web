/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - db_keuangan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `tb_auth` */

DROP TABLE IF EXISTS `tb_auth`;

CREATE TABLE `tb_auth` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL DEFAULT 'User',
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(5) NOT NULL DEFAULT 2 COMMENT '1: Admin; 2: Pengguna',
  `log_time` int(11) NOT NULL DEFAULT 0,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_auth` */

insert  into `tb_auth`(`user_id`,`nama`,`email`,`password`,`role`,`log_time`,`created_at`,`is_deleted`) values 
(3,'Mahendra','mahendradwipurwanto@gmail.com','$2y$10$5mLHXQU1HlxAlU4ckCvWc.fXhyDLTl5RzngEFmF6BzV2rTUa6GiZ6',2,0,1656234898,0);

/*Table structure for table `tb_keuangan` */

DROP TABLE IF EXISTS `tb_keuangan`;

CREATE TABLE `tb_keuangan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT 'keuangan',
  `nominal` int(11) NOT NULL DEFAULT 0,
  `kategori` int(5) NOT NULL DEFAULT 1 COMMENT '1: Pengeluaran; 2: Pemasukan; 3: Tabungan',
  `keterangan` text DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tb_keuangan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`),
  CONSTRAINT `tb_keuangan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `tb_keuangan` */

insert  into `tb_keuangan`(`id`,`user_id`,`nama`,`nominal`,`kategori`,`keterangan`,`created_at`,`modified_at`,`is_deleted`) values 
(1,3,'Tabungan awal',2500000,3,'Tabungankuuu',1656242480,1656244856,0),
(2,3,'Gaji bulanan',3150000,2,'Gaji pertama nih boss',1656242511,0,0),
(3,3,'Beli speaker',250000,1,'',1656244940,0,0);

/*Table structure for table `tb_pengingat` */

DROP TABLE IF EXISTS `tb_pengingat`;

CREATE TABLE `tb_pengingat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT 'Pengingat',
  `tanggal` int(11) NOT NULL DEFAULT 0,
  `tagihan` int(11) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0: Belum Dibayar; 1: Sudah Dibayar',
  `created_at` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tb_pengingat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`),
  CONSTRAINT `tb_pengingat_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tb_auth` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `tb_pengingat` */

insert  into `tb_pengingat`(`id`,`user_id`,`nama`,`tanggal`,`tagihan`,`status`,`created_at`,`created_by`,`is_deleted`) values 
(1,3,'Tagihan listrik bulanan',1656176400,250000,1,0,0,0),
(2,3,'Tagihan air',1656349200,54000,0,0,0,0);

/*Table structure for table `tb_settings` */

DROP TABLE IF EXISTS `tb_settings`;

CREATE TABLE `tb_settings` (
  `key` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL DEFAULT 0,
  `modified_at` int(11) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tb_settings` */

insert  into `tb_settings`(`key`,`value`,`desc`,`created_at`,`modified_at`,`is_deleted`) values 
('mailer_alias','Manajemen Keuangan Mandiri',NULL,1656230855,0,0),
('mailer_host','smtp.gmail.com',NULL,1656230855,0,0),
('mailer_mode','0',NULL,1656230855,0,0),
('mailer_password','lacoaghdgrabbmli',NULL,1656230855,0,0),
('mailer_port','587',NULL,1656230855,0,0),
('mailer_username','ngodingin.indonesia@gmail.com',NULL,1656230855,0,0),
('web_desc','Website manajemen keuangan mandiri',NULL,1656230855,0,0),
('web_icon','favicon.png',NULL,1656230855,0,0),
('web_logo','favicon.png',NULL,1656230855,0,0),
('web_title','Manajemen Keuangan',NULL,1656230855,0,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
