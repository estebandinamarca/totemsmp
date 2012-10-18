-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 24, 2012 at 11:46 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS totemmallplaza;
USE `totemmallplaza`;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `totemmallplaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `cambiadorpiso`
--

CREATE TABLE IF NOT EXISTS `cambiadorpiso` (
  `idcambiadorPiso` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `sube` tinyint(1) DEFAULT NULL,
  `baja` tinyint(1) DEFAULT NULL,
  `idnodoSubida` int(11) DEFAULT NULL,
  `idnodoBajada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcambiadorPiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cambiadorpiso`
--

INSERT INTO `cambiadorpiso` (`idcambiadorPiso`, `idnodo`, `tipo`, `sube`, `baja`, `idnodoSubida`, `idnodoBajada`) VALUES
(1, 119, '1', 1, 0, 124, 0),
(2, 120, '2', 1, 0, 125, 0),
(3, 121, '3', 1, 0, 126, 0),
(4, 122, '3', 1, 0, 127, 0),
(5, 123, '2', 1, 0, 128, 0),
(6, 124, '1', 0, 1, 0, 119),
(7, 125, '2', 0, 1, 0, 120),
(8, 126, '3', 0, 1, 0, 121),
(9, 127, '3', 0, 1, 0, 122),
(10, 128, '2', 0, 1, 0, 123);

-- --------------------------------------------------------

--
-- Table structure for table `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detallemarca`
--

CREATE TABLE IF NOT EXISTS `detallemarca` (
  `iddetalleMarca` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleMarca`),
  KEY `fk_dm_idproducto` (`idproducto`),
  KEY `fk_dm_idmarca` (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detalleoferta`
--

CREATE TABLE IF NOT EXISTS `detalleoferta` (
  `iddetalleOferta` int(11) NOT NULL AUTO_INCREMENT,
  `idoferta` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleOferta`),
  KEY `fk_do_idoferta` (`idoferta`),
  KEY `fk_do_idproducto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detallepromocion`
--

CREATE TABLE IF NOT EXISTS `detallepromocion` (
  `iddetallePromocion` int(11) NOT NULL AUTO_INCREMENT,
  `idpromocion` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallePromocion`),
  KEY `fk_dt_idpromocion` (`idpromocion`),
  KEY `fk_dt_idproducto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `detallerubro`
--

CREATE TABLE IF NOT EXISTS `detallerubro` (
  `iddetalleRubro` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idrubro` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleRubro`),
  KEY `fk_dr_idtienda` (`idtienda`),
  KEY `fk_dr_idrubro` (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=234 ;

--
-- Dumping data for table `detallerubro`
--

INSERT INTO `detallerubro` (`iddetalleRubro`, `idtienda`, `idrubro`) VALUES
(1, 85, 15),
(2, 14, 16),
(3, 42, 10),
(4, 99, 15),
(5, 34, 10),
(6, 77, 16),
(7, 51, 6),
(8, 51, 10),
(9, 51, 12),
(10, 37, 10),
(11, 46, 3),
(12, 88, 4),
(13, 83, 15),
(14, 103, 15),
(15, 101, 15),
(16, 91, 16),
(17, 1, 1),
(18, 100, 15),
(19, 89, 15),
(20, 78, 16),
(21, 50, 5),
(22, 12, 5),
(23, 66, 15),
(24, 43, 6),
(25, 43, 10),
(26, 58, 10),
(27, 38, 10),
(28, 105, 15),
(29, 62, 15),
(30, 65, 10),
(31, 33, 12),
(32, 86, 10),
(33, 74, 13),
(34, 21, 13),
(35, 41, 6),
(36, 41, 10),
(37, 26, 12),
(38, 115, 5),
(39, 115, 16),
(40, 27, 10),
(41, 17, 11),
(42, 93, 15),
(43, 64, 6),
(44, 64, 10),
(45, 39, 14),
(46, 20, 16),
(47, 81, 4),
(48, 106, 4),
(49, 55, 6),
(50, 55, 10),
(51, 55, 12),
(52, 67, 2),
(53, 56, 10),
(54, 59, 13),
(55, 57, 10),
(56, 104, 15),
(57, 28, 10),
(58, 102, 15),
(59, 60, 15),
(60, 32, 15),
(61, 22, 11),
(62, 31, 12),
(63, 13, 14),
(64, 69, 2),
(65, 87, 15),
(66, 54, 6),
(67, 54, 12),
(68, 16, 16),
(69, 94, 15),
(70, 48, 6),
(71, 48, 10),
(72, 48, 12),
(73, 53, 10),
(74, 92, 5),
(75, 73, 2),
(76, 73, 16),
(77, 49, 13),
(78, 49, 13),
(79, 44, 13),
(80, 18, 5),
(81, 18, 16),
(82, 45, 3),
(83, 36, 10),
(84, 63, 12),
(85, 30, 12),
(86, 95, 15),
(87, 47, 6),
(88, 24, 13),
(89, 35, 12),
(90, 10, 16),
(91, 68, 6),
(92, 68, 10),
(93, 97, 15),
(94, 75, 16),
(95, 61, 6),
(96, 61, 10),
(97, 80, 17),
(98, 82, 15),
(99, 90, 5),
(100, 90, 16),
(101, 96, 15),
(102, 98, 15),
(103, 40, 6),
(104, 40, 10),
(105, 79, 17),
(106, 52, 10),
(107, 29, 15),
(108, 77, 19),
(109, 77, 18),
(110, 91, 18),
(111, 91, 19),
(112, 74, 23),
(113, 21, 23),
(114, 20, 19),
(115, 63, 23),
(116, 24, 23),
(117, 10, 21),
(118, 24, 22),
(119, 93, 26),
(120, 96, 26),
(121, 98, 26),
(122, 97, 26),
(123, 99, 26),
(124, 100, 26),
(125, 103, 26),
(126, 101, 26),
(127, 102, 26),
(128, 94, 26),
(129, 95, 26),
(130, 105, 26),
(131, 104, 26),
(132, 85, 27),
(133, 14, 27),
(134, 42, 27),
(135, 99, 27),
(136, 31, 27),
(137, 34, 27),
(138, 77, 27),
(139, 51, 27),
(140, 46, 27),
(141, 88, 27),
(142, 83, 27),
(143, 37, 27),
(144, 103, 27),
(145, 101, 27),
(146, 91, 27),
(147, 82, 27),
(148, 23, 27),
(149, 1, 27),
(150, 100, 27),
(151, 89, 27),
(152, 107, 27),
(153, 78, 27),
(154, 50, 27),
(155, 12, 27),
(156, 66, 27),
(157, 43, 27),
(158, 58, 27),
(159, 38, 27),
(160, 105, 27),
(161, 62, 27),
(162, 65, 27),
(163, 33, 27),
(164, 86, 27),
(165, 74, 27),
(166, 21, 27),
(167, 41, 27),
(168, 26, 27),
(169, 115, 27),
(170, 27, 27),
(171, 17, 27),
(172, 93, 27),
(173, 64, 27),
(174, 39, 27),
(175, 20, 27),
(176, 81, 27),
(177, 106, 27),
(178, 55, 27),
(179, 67, 27),
(180, 56, 27),
(181, 15, 27),
(182, 59, 27),
(183, 57, 27),
(184, 70, 27),
(185, 104, 27),
(186, 28, 27),
(187, 102, 27),
(188, 32, 27),
(189, 60, 27),
(190, 22, 27),
(191, 13, 27),
(192, 69, 27),
(193, 87, 27),
(194, 54, 27),
(195, 16, 27),
(196, 94, 27),
(197, 48, 27),
(198, 53, 27),
(199, 92, 27),
(200, 73, 27),
(201, 44, 27),
(202, 49, 27),
(203, 18, 27),
(204, 19, 27),
(205, 45, 27),
(206, 36, 27),
(207, 63, 27),
(208, 30, 27),
(209, 95, 27),
(210, 47, 27),
(211, 24, 27),
(212, 35, 27),
(213, 10, 27),
(214, 68, 27),
(215, 25, 27),
(216, 97, 27),
(217, 75, 27),
(218, 61, 27),
(219, 90, 27),
(220, 96, 27),
(221, 98, 27),
(222, 40, 27),
(223, 52, 27),
(224, 29, 27),
(225, 81, 9),
(226, 82, 9),
(227, 83, 9),
(228, 84, 9),
(229, 85, 9),
(230, 86, 9),
(231, 87, 9),
(232, 88, 9),
(233, 80, 22);

-- --------------------------------------------------------

--
-- Table structure for table `detalletienda`
--

CREATE TABLE IF NOT EXISTS `detalletienda` (
  `iddetalleTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleTienda`),
  KEY `fk_idtienda` (`idtienda`),
  KEY `fk_idproducto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `estacionamiento`
--

CREATE TABLE IF NOT EXISTS `estacionamiento` (
  `idestacionamiento` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idestacionamiento`),
  KEY `fk_estacionamiento_1` (`idnodo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `idlogs` int(11) NOT NULL AUTO_INCREMENT,
  `logscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `mensaje`
--

CREATE TABLE IF NOT EXISTS `mensaje` (
  `idMensaje` int(11) NOT NULL AUTO_INCREMENT,
  `nombreUsuario` varchar(100) DEFAULT NULL,
  `mailUsuario` varchar(100) DEFAULT NULL,
  `fonoContacto` varchar(100) DEFAULT NULL,
  `mensaje` text,
  `idSubMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMensaje`),
  KEY `fk_mensaje_subMotivo` (`idSubMotivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `motivo`
--

CREATE TABLE IF NOT EXISTS `motivo` (
  `idMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreMotivo` varchar(100) DEFAULT NULL,
  `idSubCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idMotivo`),
  KEY `fk_motivo_subCategoria` (`idSubCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `nodos`
--

CREATE TABLE IF NOT EXISTS `nodos` (
  `idnodo` int(11) NOT NULL AUTO_INCREMENT,
  `idcambiadorPiso` int(11) DEFAULT NULL,
  `ubicacionx` varchar(45) NOT NULL,
  `ubicaciony` varchar(45) NOT NULL,
  `piso` varchar(45) NOT NULL,
  `vecino1` int(11) DEFAULT NULL,
  `vecino2` int(11) DEFAULT NULL,
  `vecino3` int(11) DEFAULT NULL,
  `vecino4` int(11) DEFAULT NULL,
  `coordenadaReal` varchar(45) NOT NULL,
  PRIMARY KEY (`idnodo`),
  KEY `fk_nodos_1` (`idcambiadorPiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `nodos`
--

INSERT INTO `nodos` (`idnodo`, `idcambiadorPiso`, `ubicacionx`, `ubicaciony`, `piso`, `vecino1`, `vecino2`, `vecino3`, `vecino4`, `coordenadaReal`) VALUES
(1, NULL, '40', '4', '1', 0, 0, 0, 0, '40_4'),
(2, NULL, '42', '7', '1', 0, 0, 0, 0, '42_7'),
(3, NULL, '40', '10', '1', 0, 0, 0, 0, '40_10'),
(4, NULL, '42', '17', '1', 0, 0, 0, 0, '42_17'),
(5, NULL, '45', '30', '1', 0, 0, 0, 0, '45_30'),
(6, NULL, '40', '17', '1', 0, 0, 0, 0, '40_17'),
(7, NULL, '37', '28', '1', 0, 0, 0, 0, '37_28'),
(8, NULL, '39', '34', '1', 0, 0, 0, 0, '39_34'),
(9, NULL, '43', '36', '1', 0, 0, 0, 0, '43_36'),
(10, NULL, '40', '41', '1', 0, 0, 0, 0, '40_41'),
(11, NULL, '43', '40', '1', 0, 0, 0, 0, '43_40'),
(12, NULL, '43', '44', '1', 0, 0, 0, 0, '43_44'),
(13, NULL, '40', '46', '1', 0, 0, 0, 0, '40_46'),
(14, NULL, '40', '49', '1', 0, 0, 0, 0, '40_49'),
(15, NULL, '43', '48', '1', 0, 0, 0, 0, '43_48'),
(16, NULL, '40', '52', '1', 0, 0, 0, 0, '40_52'),
(17, NULL, '43', '54', '1', 0, 0, 0, 0, '43_54'),
(18, NULL, '43', '56', '1', 0, 0, 0, 0, '43_56'),
(19, NULL, '40', '55', '1', 0, 0, 0, 0, '40_55'),
(20, NULL, '43', '58', '1', 0, 0, 0, 0, '43_58'),
(21, NULL, '40', '62', '1', 0, 0, 0, 0, '40_62'),
(22, NULL, '43', '61', '1', 0, 0, 0, 0, '43_61'),
(23, NULL, '7', '80', '1', 0, 0, 0, 0, '7_80'),
(24, NULL, '13', '80', '1', 0, 0, 0, 0, '13_80'),
(25, NULL, '17', '80', '1', 0, 0, 0, 0, '17_80'),
(26, NULL, '20', '80', '1', 0, 0, 0, 0, '20_80'),
(27, NULL, '23', '80', '1', 0, 0, 0, 0, '23_80'),
(28, NULL, '25', '80', '1', 0, 0, 0, 0, '25_80'),
(29, NULL, '27', '80', '1', 0, 0, 0, 0, '27_80'),
(30, NULL, '29', '80', '1', 0, 0, 0, 0, '29_80'),
(31, NULL, '31', '80', '1', 0, 0, 0, 0, '31_80'),
(32, NULL, '34', '80', '1', 0, 0, 0, 0, '34_80'),
(33, NULL, '46', '77', '1', 0, 0, 0, 0, '46_77'),
(34, NULL, '56', '80', '1', 0, 0, 0, 0, '56_80'),
(35, NULL, '58', '80', '1', 0, 0, 0, 0, '58_80'),
(36, NULL, '60', '80', '1', 0, 0, 0, 0, '60_80'),
(37, NULL, '63', '80', '1', 0, 0, 0, 0, '63_80'),
(38, NULL, '66', '80', '1', 0, 0, 0, 0, '66_80'),
(39, NULL, '69', '80', '1', 0, 0, 0, 0, '69_80'),
(40, NULL, '71', '80', '1', 0, 0, 0, 0, '71_80'),
(41, NULL, '75', '80', '1', 0, 0, 0, 0, '75_80'),
(42, NULL, '79', '80', '1', 0, 0, 0, 0, '79_80'),
(43, NULL, '83', '85', '1', 0, 0, 0, 0, '83_85'),
(44, NULL, '83', '80', '1', 0, 0, 0, 0, '83_80'),
(45, NULL, '89', '80', '1', 0, 0, 0, 0, '89_80'),
(46, NULL, '5', '85', '1', 0, 0, 0, 0, '5_85'),
(47, NULL, '10', '85', '1', 0, 0, 0, 0, '10_85'),
(48, NULL, '12', '85', '1', 0, 0, 0, 0, '12_85'),
(49, NULL, '15', '85', '1', 0, 0, 0, 0, '15_85'),
(50, NULL, '19', '85', '1', 0, 0, 0, 0, '19_85'),
(51, NULL, '25', '85', '1', 0, 0, 0, 0, '25_85'),
(52, NULL, '32', '85', '1', 0, 0, 0, 0, '32_85'),
(53, NULL, '38', '86', '1', 0, 0, 0, 0, '38_86'),
(54, NULL, '45', '86', '1', 0, 0, 0, 0, '45_86'),
(55, NULL, '51', '85', '1', 0, 0, 0, 0, '51_85'),
(56, NULL, '55', '85', '1', 0, 0, 0, 0, '55_85'),
(57, NULL, '57', '85', '1', 0, 0, 0, 0, '57_85'),
(58, NULL, '59', '85', '1', 0, 0, 0, 0, '59_85'),
(59, NULL, '62', '85', '1', 0, 0, 0, 0, '62_85'),
(60, NULL, '64', '85', '1', 0, 0, 0, 0, '64_85'),
(61, NULL, '67', '85', '1', 0, 0, 0, 0, '67_85'),
(62, NULL, '71', '85', '1', 0, 0, 0, 0, '71_85'),
(63, NULL, '74', '85', '1', 0, 0, 0, 0, '74_85'),
(64, NULL, '76', '85', '1', 0, 0, 0, 0, '76_85'),
(65, NULL, '79', '85', '1', 0, 0, 0, 0, '79_85'),
(66, NULL, '80', '85', '1', 0, 0, 0, 0, '80_85'),
(67, NULL, '84', '85', '1', 0, 0, 0, 0, '84_85'),
(68, NULL, '87', '85', '1', 0, 0, 0, 0, '87_85'),
(69, NULL, '90', '85', '1', 0, 0, 0, 0, '90_85'),
(70, NULL, '94', '85', '1', 0, 0, 0, 0, '94_85'),
(72, NULL, '43', '96', '1', 0, 0, 0, 0, '43_96'),
(73, NULL, '40', '100', '1', 0, 0, 0, 0, '40_100'),
(74, NULL, '43', '103', '1', 0, 0, 0, 0, '43_103'),
(75, NULL, '40', '113', '1', 0, 0, 0, 0, '40_113'),
(76, NULL, '43', '114', '1', 0, 0, 0, 0, '43_114'),
(77, NULL, '40', '122', '1', 0, 0, 0, 0, '40_122'),
(78, NULL, '43', '123', '1', 0, 0, 0, 0, '43_123'),
(79, NULL, '32', '70', '1', 0, 0, 0, 0, '32_70'),
(80, NULL, '48', '68', '1', 0, 0, 0, 0, '48_68'),
(81, NULL, '116', '60', '1', 0, 0, 0, 0, '116_60'),
(82, NULL, '112', '66', '1', 0, 0, 0, 0, '112_66'),
(83, NULL, '109', '80', '1', 0, 0, 0, 0, '109_80'),
(84, NULL, '115', '70', '1', 0, 0, 0, 0, '115_70'),
(85, NULL, '115', '78', '1', 0, 0, 0, 0, '115_78'),
(86, NULL, '102', '85', '1', 0, 0, 0, 0, '102_85'),
(87, NULL, '110', '85', '1', 0, 0, 0, 0, '110_85'),
(88, NULL, '106', '85', '1', 0, 0, 0, 0, '106_85'),
(89, NULL, '123', '111', '1', 0, 0, 0, 0, '123_111'),
(90, NULL, '32', '40', '1', 0, 0, 0, 0, '32_40'),
(91, NULL, '32', '51', '1', 0, 0, 0, 0, '32_51'),
(92, NULL, '32', '55', '1', 0, 0, 0, 0, '32_55'),
(93, NULL, '98', '90', '2', 0, 0, 0, 0, '98_90'),
(94, NULL, '102', '78', '2', 0, 0, 0, 0, '102_78'),
(95, NULL, '109', '77', '2', 0, 0, 0, 0, '109_77'),
(96, NULL, '99', '95', '2', 0, 0, 0, 0, '99_95'),
(97, NULL, '105', '96', '2', 0, 0, 0, 0, '105_96'),
(98, NULL, '99', '99', '2', 0, 0, 0, 0, '99_99'),
(99, NULL, '107', '94', '2', 0, 0, 0, 0, '107_94'),
(100, NULL, '111', '89', '2', 0, 0, 0, 0, '111_89'),
(101, NULL, '113', '86', '2', 0, 0, 0, 0, '113_86'),
(102, NULL, '116', '80', '2', 0, 0, 0, 0, '116_80'),
(103, NULL, '116', '76', '2', 0, 0, 0, 0, '116_76'),
(104, NULL, '116', '70', '2', 0, 0, 0, 0, '116_70'),
(105, NULL, '116', '67', '2', 0, 0, 0, 0, '116_67'),
(106, NULL, '114', '47', '2', 0, 0, 0, 0, '114_47'),
(107, NULL, '98', '55', '2', 0, 0, 0, 0, '98_55'),
(108, NULL, '32', '33', '1', 0, 0, 0, 0, '32_33'),
(109, NULL, '32', '35', '1', 0, 0, 0, 0, '32_35'),
(110, NULL, '32', '37', '1', 0, 0, 0, 0, '32_37'),
(111, NULL, '32', '39', '1', 0, 0, 0, 0, '32_39'),
(112, NULL, '32', '45', '1', 0, 0, 0, 0, '32_45'),
(113, NULL, '32', '47', '1', 0, 0, 0, 0, '32_47'),
(114, NULL, '32', '49', '1', 0, 0, 0, 0, '32_49'),
(115, NULL, '32', '59', '1', 0, 0, 0, 0, '32_59'),
(116, NULL, '32', '61', '1', 0, 0, 0, 0, '32_61'),
(117, NULL, '32', '63', '1', 0, 0, 0, 0, '32_63'),
(118, NULL, '32', '66', '1', 0, 0, 0, 0, '32_66'),
(119, 1, '94', '83', '1', 0, 0, 0, 0, '94_83'),
(120, 2, '95', '78', '1', 0, 0, 0, 0, '95_78'),
(121, 3, '103', '101', '1', 0, 0, 0, 0, '103_101'),
(122, 4, '119', '58', '1', 0, 0, 0, 0, '119_58'),
(123, 5, '109', '37', '1', 0, 0, 0, 0, '109_37'),
(124, 6, '94', '83', '2', 0, 0, 0, 0, '94_83'),
(125, 7, '95', '78', '2', 0, 0, 0, 0, '95_78'),
(126, 8, '103', '101', '2', 0, 0, 0, 0, '103_101'),
(127, 9, '119', '58', '2', 0, 0, 0, 0, '119_58'),
(128, 10, '109', '37', '2', 0, 0, 0, 0, '109_37'),
(129, NULL, '42', '31', '1', 0, 0, 0, 0, '42_31'),
(130, NULL, '41', '82', '1', 0, 0, 0, 0, '41_82'),
(131, NULL, '101', '102', '1', 0, 0, 0, 0, '101_102'),
(132, NULL, '97', '82', '2', 0, 0, 0, 0, '97_82');

-- --------------------------------------------------------

--
-- Table structure for table `oferta`
--

CREATE TABLE IF NOT EXISTS `oferta` (
  `idoferta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `oferta` text,
  `stock` int(11) DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idoferta`),
  KEY `fk_of_idtienda` (`idtienda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `perfilusuario`
--

CREATE TABLE IF NOT EXISTS `perfilusuario` (
  `idPerfilUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `id_usuario` int(11) NOT NULL COMMENT 'id del usuario para vincular registro',
  `modulo` varchar(30) NOT NULL COMMENT 'nombre de funcionalidad o modulo',
  `credencial` tinyint(4) NOT NULL COMMENT 'estado, denegado o autorizado',
  PRIMARY KEY (`idPerfilUsuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`modulo`),
  KEY `fk_perfilUsuario_usuario1` (`id_usuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=324 ;

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `promocion`
--

CREATE TABLE IF NOT EXISTS `promocion` (
  `idpromocion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `detalle` text,
  `fechaInicio` timestamp NULL DEFAULT NULL,
  `fechaTermino` timestamp NULL DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpromocion`),
  KEY `idtienda` (`idtienda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `propiedadestienda`
--

CREATE TABLE IF NOT EXISTS `propiedadestienda` (
  `idpropiedadesTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) NOT NULL,
  `idnodo` int(11) NOT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpropiedadesTienda`),
  KEY `fk_propiedadesTienda_1` (`idtienda`),
  KEY `fk_propiedadesTienda_2` (`idnodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `propiedadestienda`
--

INSERT INTO `propiedadestienda` (`idpropiedadesTienda`, `idtienda`, `idnodo`, `modulo`) VALUES
(1, 1, 1, NULL),
(2, 2, 2, NULL),
(3, 3, 3, NULL),
(4, 4, 4, NULL),
(5, 5, 5, NULL),
(6, 6, 6, NULL),
(7, 7, 7, NULL),
(8, 8, 8, NULL),
(9, 9, 9, NULL),
(10, 10, 10, NULL),
(11, 11, 11, NULL),
(12, 12, 12, NULL),
(13, 13, 13, NULL),
(14, 14, 14, NULL),
(15, 15, 15, NULL),
(16, 16, 16, NULL),
(17, 17, 17, NULL),
(18, 18, 18, NULL),
(19, 19, 19, NULL),
(20, 20, 20, NULL),
(21, 21, 21, NULL),
(22, 22, 22, NULL),
(23, 23, 23, NULL),
(24, 24, 24, NULL),
(25, 25, 25, NULL),
(26, 26, 26, NULL),
(27, 27, 27, NULL),
(28, 28, 28, NULL),
(29, 29, 29, NULL),
(30, 30, 30, NULL),
(31, 31, 31, NULL),
(32, 32, 32, NULL),
(33, 33, 33, NULL),
(34, 34, 34, NULL),
(35, 35, 35, NULL),
(36, 36, 36, NULL),
(37, 37, 37, NULL),
(38, 38, 38, NULL),
(39, 39, 39, NULL),
(40, 40, 40, NULL),
(41, 41, 41, NULL),
(42, 42, 42, NULL),
(43, 43, 43, NULL),
(44, 44, 44, NULL),
(45, 45, 45, NULL),
(46, 46, 46, NULL),
(47, 47, 47, NULL),
(48, 48, 48, NULL),
(49, 49, 49, NULL),
(50, 50, 50, NULL),
(51, 51, 51, NULL),
(52, 52, 52, NULL),
(53, 53, 53, NULL),
(54, 54, 54, NULL),
(55, 55, 55, NULL),
(56, 56, 56, NULL),
(57, 57, 57, NULL),
(58, 58, 58, NULL),
(59, 59, 59, NULL),
(60, 60, 60, NULL),
(61, 61, 61, NULL),
(62, 62, 62, NULL),
(63, 63, 63, NULL),
(64, 64, 64, NULL),
(65, 65, 65, NULL),
(66, 66, 66, NULL),
(67, 67, 67, NULL),
(68, 68, 68, NULL),
(69, 69, 69, NULL),
(70, 70, 70, NULL),
(72, 72, 72, NULL),
(73, 73, 73, NULL),
(74, 74, 74, NULL),
(75, 75, 75, NULL),
(76, 76, 76, NULL),
(77, 77, 77, NULL),
(78, 78, 78, NULL),
(79, 79, 79, NULL),
(80, 80, 80, NULL),
(81, 81, 81, NULL),
(82, 82, 82, NULL),
(83, 83, 83, NULL),
(84, 84, 84, NULL),
(85, 85, 85, NULL),
(86, 86, 86, NULL),
(87, 87, 87, NULL),
(88, 88, 88, NULL),
(89, 89, 89, NULL),
(90, 90, 90, NULL),
(92, 92, 92, NULL),
(93, 93, 93, NULL),
(94, 94, 94, NULL),
(95, 95, 95, NULL),
(96, 96, 96, NULL),
(97, 97, 97, NULL),
(98, 98, 98, NULL),
(99, 99, 99, NULL),
(100, 100, 100, NULL),
(101, 101, 101, NULL),
(102, 102, 102, NULL),
(103, 103, 103, NULL),
(104, 104, 104, NULL),
(105, 105, 105, NULL),
(106, 106, 106, NULL),
(107, 107, 107, NULL),
(108, 108, 108, NULL),
(109, 109, 109, NULL),
(110, 110, 110, NULL),
(111, 111, 111, NULL),
(112, 112, 112, NULL),
(113, 113, 113, NULL),
(114, 114, 114, NULL),
(115, 115, 115, NULL),
(116, 116, 116, NULL),
(117, 117, 117, NULL),
(118, 118, 118, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reclamos`
--

CREATE TABLE IF NOT EXISTS `reclamos` (
  `idreclamos` int(11) NOT NULL AUTO_INCREMENT,
  `rut` varchar(45) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `empresa` varchar(45) DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `detalle` text,
  PRIMARY KEY (`idreclamos`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rubro`
--

CREATE TABLE IF NOT EXISTS `rubro` (
  `idrubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `rubro`
--

INSERT INTO `rubro` (`idrubro`, `nombre`, `logo`) VALUES
(1, 'Auto Plaza', 'autoplaza.jpg'),
(2, 'Computación y Electrónica', 'computacion.jpg'),
(3, 'Deporte', 'deporte.jpg'),
(4, 'Entretención y Cultura', 'entretencion.jpg'),
(5, 'Hogar y Regalos', 'hogar.jpg'),
(6, 'Hombre', 'hombre.jpg'),
(7, 'Joyería y Relojerías', 'joyeria.jpg'),
(8, 'Jugueterías', 'jugueteria.jpg'),
(9, 'Las Terrazas', 'terrazas.jpg'),
(10, 'Mujer', 'mujer.jpg'),
(11, 'Música, Fotografía y Librerías', 'musica.jpg'),
(12, 'Niños', 'ninos.jpg'),
(13, 'Ópticas, Perfumerías y Farmacias', 'optica.jpg'),
(14, 'Peluquería y Belleza', 'peluqueria.jpg'),
(15, 'Restauranes, Cafeterías y Heladerías', 'restauranes.jpg'),
(16, 'Servicios', 'servicios.jpg'),
(17, 'Tiendas Departamentales', 'departamentales.jpg'),
(18, 'Bancos', 'bancos.jpg'),
(19, 'Bancos y Casas de Cambio', 'bancos.jpg'),
(20, 'Pago de Cuentas', 'pago.jpg'),
(21, 'Servicios Públicos', 'serviciospublicos.jpg'),
(22, 'Servicios para el Hogar', 'servicioshogar.jpg'),
(23, 'Salud y Belleza', 'saludybelleza.jpg'),
(25, 'Educación', 'educacion.jpg'),
(26, 'Patio de Comidas', 'food.jpg'),
(27, 'Tiendas Menores', 'tiendasmenores.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `subcategoria`
--

CREATE TABLE IF NOT EXISTS `subcategoria` (
  `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubCategoria` varchar(100) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubCategoria`),
  KEY `fk_subCategoria_categoria` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `submotivo`
--

CREATE TABLE IF NOT EXISTS `submotivo` (
  `idSubMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubMotivo` varchar(100) DEFAULT NULL,
  `idMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubMotivo`),
  KEY `fk_subMotivo_motivo` (`idMotivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tienda`
--

CREATE TABLE IF NOT EXISTS `tienda` (
  `idtienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `tienda`
--

INSERT INTO `tienda` (`idtienda`, `nombre`, `logo`) VALUES
(1, 'Chevrolet', 'chevrolet.jpg'),
(2, 'VACANTE', 'opel.jpg'),
(3, 'VACANTE', 'peugeot.jpg'),
(4, 'VACANTE', 'zna.jpg'),
(5, 'VACANTE', 'lifan.jpg'),
(6, 'VACANTE', 'gildemeister.jpg'),
(7, 'VACANTE', 'forum.jpg'),
(8, 'VACANTE', 'fonasa.jpg'),
(9, 'VACANTE', 'null.jpg'),
(10, 'Registro Civil', 'registrocivil.jpg'),
(11, 'VACANTE', 'null.jpg'),
(12, 'Cordonería', 'null.jpg'),
(13, 'Maicao', 'maicao.jpg'),
(14, 'All Nutrition', 'allnutrition.jpg'),
(15, 'Importadora', 'null.jpg'),
(16, 'Maxik', 'maxik.jpg'),
(17, 'Fotostereo', 'fotostereo.jpg'),
(18, 'Ortopedia MasVida', 'ortopedia.jpg'),
(19, 'Palumbo', 'palumbo.jpg'),
(20, 'Guiñazu', 'guinazu.jpg'),
(21, 'Farmacias Salcobrand', 'salcobrand.jpg'),
(22, 'Lápiz López', 'lapizlopez.jpg'),
(23, 'Cannon', 'cannon.jpg'),
(24, 'Preunic', 'preunic.jpg'),
(25, 'Rometsch', 'rometsch.jpg'),
(26, 'Ficcus', 'ficcus.jpg'),
(27, 'Flores', 'flores.jpg'),
(28, 'Kayser', 'kayser.jpg'),
(29, 'Yogen Fruz', 'yogenfruz.jpg'),
(30, 'Pillin', 'pillin.jpg'),
(31, 'B & B / Limonada', 'limonada.jpg'),
(32, 'L´angolo', 'langolo.jpg'),
(33, 'EPK', 'epk.jpg'),
(34, 'Balu Accessorize', 'balu.jpg'),
(35, 'Punto Urbano', 'puntourbano.jpg'),
(36, 'Pensato', 'pensato.jpg'),
(37, 'Bubble Gummers', 'bgummers.jpg'),
(38, 'Do It', 'doit.jpg'),
(39, 'Gema', 'gema.jpg'),
(40, 'Timberland', 'timberland.jpg'),
(41, 'Ferracini', 'ferracini.jpg'),
(42, 'Anastassia', 'anastassia.jpg'),
(43, 'Dakotta', 'dakota.jpg'),
(44, 'Ópticas Place Vendome', 'placevendome.jpg'),
(45, 'Patuelli', 'patuelli.jpg'),
(46, 'Belsport', 'belsport.jpg'),
(47, 'Potros', 'potros.jpg'),
(48, 'Monarch', 'monarch.jpg'),
(49, 'Opticas Rotter & Krauss', 'opticasrotterykrauss.jpg'),
(50, 'Cocinarte', 'cocinarte.jpg'),
(51, 'Bata', 'bata.jpg'),
(52, 'Wados', 'wados.jpg'),
(53, 'Mor', 'mor.jpg'),
(54, 'Maui', 'maui.jpg'),
(55, 'Hush Puppies', 'hushpuppies.jpg'),
(56, 'Imagen', 'imagen.jpg'),
(57, 'Isadora', 'isadora.jpg'),
(58, 'De Togni', 'detogni.jpg'),
(59, 'Intersalon', 'intersalon.jpg'),
(60, 'La Fete', 'lafete.jpg'),
(61, 'Shoes & Piel', 'shoesypiel.jpg'),
(62, 'Dunkin Donuts', 'donkindonuts.jpg'),
(63, 'Perfumame', 'perfumame.jpg'),
(64, 'Funky Fish', 'funkyfish.jpg'),
(65, 'Edith coll', 'edithcoll.jpg'),
(66, 'D´Luisa', 'dluisa.jpg'),
(67, 'I One - Apple', 'ione.jpg'),
(68, 'Rip Curl', 'ripcurl.jpg'),
(69, 'Mall Conection', 'mallconnection.jpg'),
(70, 'Italmod / Sparta', 'sparta.jpg'),
(72, 'VACANTE', 'null.jpg'),
(73, 'Nextel', 'nextel.jpg'),
(74, 'Farmacias Cruz Verde', 'cruzverde.jpg'),
(75, 'Serviestado', 'serviestado.jpg'),
(76, 'VACANTE', 'null.jpg'),
(77, 'Banco Estado', 'bancoestado.jpg'),
(78, 'Claro', 'claro.jpg'),
(79, 'Tottus', 'tottus.jpg'),
(80, 'Homecenter Sodimac', 'homecenter.jpg'),
(81, 'Happyland Piso 1', 'happyland.jpg'),
(82, 'Camyen Sushi', 'sushibar.jpg'),
(83, 'Bravissimo', 'bravissimo.jpg'),
(84, 'VACANTE', 'latitudsur.jpg'),
(85, '82 Grados', '82grados.jpg'),
(86, 'Evita', 'evita.jpg'),
(87, 'Mamut', 'mamut.jpg'),
(88, 'Biblioteca Viva', 'bibliotecaviva.jpg'),
(89, 'Chuck & Cheese', 'chuckcheese.jpg'),
(90, 'Tabaquería', 'null.jpg'),
(91, 'Cajero Banco Falabella', 'bancofalabella.jpg'),
(92, 'Multiservice', 'null.jpg'),
(93, 'Fritz', 'fritz.jpg'),
(94, 'Mc Donalds', 'mcdonalds.jpg'),
(95, 'Pizza Hut', 'pizzahut.jpg'),
(96, 'Tarragona', 'tarragona.jpg'),
(97, 'Savory', 'savory.jpg'),
(98, 'Tijuana', 'tijuana.jpg'),
(99, 'Astoria', 'astoria.jpg'),
(100, 'China Wok', 'chinawok.jpg'),
(101, 'Burger King', 'burgerking.jpg'),
(102, 'KFC', 'kfc.jpg'),
(103, 'Buffet Express', 'buffetexpress.jpg'),
(104, 'Juan Maestro', 'juanmaestro.jpg'),
(105, 'Doggis', 'doggis.jpg'),
(106, 'Happyland Piso 2', 'happyland.jpg'),
(107, 'Cinemark', 'cinemark.jpg'),
(108, 'Vacante 01', 'null.jpg'),
(109, 'Vacante 02', 'null.jpg'),
(110, 'Vacante 03', 'null.jpg'),
(111, 'Vacante 04', 'null.jpg'),
(112, 'Vacante 05', 'null.jpg'),
(113, 'Vacante 06', 'null.jpg'),
(114, 'Vacante 07', 'null.jpg'),
(115, 'Florería Quintral', 'floreriaquintral.jpg'),
(116, 'Vacante 09', 'null.jpg'),
(117, 'Vacante 10', 'null.jpg'),
(118, 'Vacante 11', 'null.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `totem`
--

CREATE TABLE IF NOT EXISTS `totem` (
  `idtotem` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `orientacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtotem`),
  KEY `fk_totem_1` (`idnodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `totem`
--

INSERT INTO `totem` (`idtotem`, `idnodo`, `nombre`, `orientacion`) VALUES
(1, 129, 'T1', 'S'),
(2, 130, 'T2', 'S'),
(3, 131, 'T3', 'S'),
(4, 132, 'T4', 'E');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nomComUsuario` varchar(45) DEFAULT NULL,
  `nomUsuario` varchar(30) DEFAULT NULL,
  `mailUsuario` varchar(60) DEFAULT NULL,
  `passUsuario` varchar(100) DEFAULT NULL,
  `privilegioUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `apellidoPaterno` varchar(45) DEFAULT NULL,
  `apellidoMaterno` varchar(45) DEFAULT NULL,
  `jerarquia` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detallemarca`
--
ALTER TABLE `detallemarca`
  ADD CONSTRAINT `fk_dm_idmarca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dm_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalleoferta`
--
ALTER TABLE `detalleoferta`
  ADD CONSTRAINT `fk_do_idoferta` FOREIGN KEY (`idoferta`) REFERENCES `oferta` (`idoferta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_do_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detallepromocion`
--
ALTER TABLE `detallepromocion`
  ADD CONSTRAINT `fk_dt_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dt_idpromocion` FOREIGN KEY (`idpromocion`) REFERENCES `promocion` (`idpromocion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detallerubro`
--
ALTER TABLE `detallerubro`
  ADD CONSTRAINT `fk_dr_idrubro` FOREIGN KEY (`idrubro`) REFERENCES `rubro` (`idrubro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dr_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalletienda`
--
ALTER TABLE `detalletienda`
  ADD CONSTRAINT `fk_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `estacionamiento`
--
ALTER TABLE `estacionamiento`
  ADD CONSTRAINT `fk_estacionamiento_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_subMotivo` FOREIGN KEY (`idSubMotivo`) REFERENCES `submotivo` (`idSubMotivo`);

--
-- Constraints for table `motivo`
--
ALTER TABLE `motivo`
  ADD CONSTRAINT `fk_motivo_subCategoria` FOREIGN KEY (`idSubCategoria`) REFERENCES `subcategoria` (`idSubCategoria`);

--
-- Constraints for table `nodos`
--
ALTER TABLE `nodos`
  ADD CONSTRAINT `fk_nodos_1` FOREIGN KEY (`idcambiadorPiso`) REFERENCES `cambiadorpiso` (`idcambiadorPiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `fk_of_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `propiedadestienda`
--
ALTER TABLE `propiedadestienda`
  ADD CONSTRAINT `fk_propiedadesTienda_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_propiedadesTienda_2` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `fk_subCategoria_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Constraints for table `submotivo`
--
ALTER TABLE `submotivo`
  ADD CONSTRAINT `fk_subMotivo_motivo` FOREIGN KEY (`idMotivo`) REFERENCES `motivo` (`idMotivo`);

--
-- Constraints for table `totem`
--
ALTER TABLE `totem`
  ADD CONSTRAINT `fk_totem_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
