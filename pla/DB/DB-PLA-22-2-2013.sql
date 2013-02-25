-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 22-02-2013 a las 16:39:40
-- Versión del servidor: 5.5.23
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `totemMallPlazaPla`
--
CREATE DATABASE `totemMallPlazaPla` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `totemMallPlazaPla`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areaNegocios`
--

CREATE TABLE IF NOT EXISTS `areaNegocios` (
  `idareaNegocio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idareaNegocio`),
  KEY `idareaNegocio` (`idareaNegocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Areas de negocio como Aires' AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `areaNegocios`
--

INSERT INTO `areaNegocios` (`idareaNegocio`, `nombre`) VALUES
(1, 'Anclas'),
(2, 'Autoplaza'),
(3, 'Food'),
(4, 'Terrazas'),
(5, 'Aires'),
(6, 'Boulevard');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambiadorPiso`
--

CREATE TABLE IF NOT EXISTS `cambiadorPiso` (
  `idcambiadorPiso` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `sube` tinyint(1) DEFAULT NULL,
  `baja` tinyint(1) DEFAULT NULL,
  `idnodoSubida` int(11) DEFAULT NULL,
  `idnodoBajada` int(11) DEFAULT NULL,
  PRIMARY KEY (`idcambiadorPiso`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `cambiadorPiso`
--

INSERT INTO `cambiadorPiso` (`idcambiadorPiso`, `idnodo`, `tipo`, `sube`, `baja`, `idnodoSubida`, `idnodoBajada`) VALUES
(1, 113, '2', 1, 0, 117, 0),
(2, 114, '2', 1, 0, 118, 0),
(3, 115, '2', 1, 0, 119, 0),
(4, 116, '2', 1, 0, 120, 0),
(5, 117, '2', 0, 1, 0, 113),
(6, 118, '2', 1, 1, 122, 114),
(7, 119, '2', 1, 1, 123, 115),
(8, 120, '2', 0, 1, 0, 116),
(9, 121, '2', 1, 0, 124, 0),
(10, 122, '2', 1, 1, 126, 118),
(11, 123, '2', 1, 1, 127, 119),
(12, 124, '2', 1, 1, 128, 121),
(13, 125, '2', 1, 0, 129, 0),
(14, 126, '2', 0, 1, 0, 122),
(15, 127, '2', 0, 1, 0, 123),
(16, 128, '2', 0, 1, 0, 124),
(17, 129, '2', 0, 1, 0, 125);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCategoria` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos`
--

CREATE TABLE IF NOT EXISTS `correos` (
  `idcorreo` int(11) NOT NULL AUTO_INCREMENT,
  `tipoCorreo` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `rut` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `correoDestino` varchar(45) NOT NULL,
  `cuerpoMensaje` text NOT NULL,
  `fecha` date NOT NULL,
  `estado` tinyint(1) NOT NULL COMMENT '1:enviado, 0:no-enviado',
  PRIMARY KEY (`idcorreo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleOferta`
--

CREATE TABLE IF NOT EXISTS `detalleOferta` (
  `iddetalleOferta` int(11) NOT NULL AUTO_INCREMENT,
  `idoferta` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleOferta`),
  KEY `fk_do_idoferta` (`idoferta`),
  KEY `fk_do_idproducto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallePromocion`
--

CREATE TABLE IF NOT EXISTS `detallePromocion` (
  `iddetallePromocion` int(11) NOT NULL AUTO_INCREMENT,
  `idpromocion` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetallePromocion`),
  KEY `fk_dt_idpromocion` (`idpromocion`),
  KEY `fk_dt_idproducto` (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleRubro`
--

CREATE TABLE IF NOT EXISTS `detalleRubro` (
  `iddetalleRubro` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idrubro` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleRubro`),
  KEY `fk_dr_idtienda` (`idtienda`),
  KEY `fk_dr_idrubro` (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=181 ;

--
-- Volcado de datos para la tabla `detalleRubro`
--

INSERT INTO `detalleRubro` (`iddetalleRubro`, `idtienda`, `idrubro`) VALUES
(1, 1, 16),
(2, 1, 18),
(3, 2, 27),
(4, 2, 6),
(5, 3, 10),
(6, 3, 12),
(7, 3, 6),
(8, 3, 27),
(9, 4, 11),
(10, 4, 27),
(11, 5, 13),
(12, 5, 27),
(13, 6, 6),
(14, 6, 10),
(15, 6, 12),
(16, 6, 27),
(17, 7, 13),
(18, 7, 27),
(19, 8, 3),
(20, 8, 10),
(21, 8, 12),
(22, 8, 6),
(23, 8, 27),
(24, 9, 7),
(25, 9, 27),
(26, 10, 13),
(27, 10, 27),
(28, 11, 13),
(29, 11, 27),
(30, 12, 15),
(31, 14, 15),
(32, 16, 11),
(33, 16, 27),
(34, 19, 14),
(35, 19, 27),
(36, 20, 5),
(37, 20, 26),
(38, 22, 13),
(39, 22, 27),
(40, 22, 23),
(41, 23, 12),
(42, 23, 27),
(43, 24, 11),
(44, 24, 27),
(45, 25, 6),
(46, 25, 10),
(47, 25, 12),
(48, 25, 27),
(49, 26, 17),
(50, 41, 17),
(52, 44, 12),
(53, 44, 27),
(54, 45, 6),
(55, 45, 10),
(56, 45, 27),
(57, 46, 13),
(58, 46, 27),
(59, 47, 10),
(60, 47, 27),
(61, 48, 10),
(62, 48, 27),
(63, 49, 12),
(64, 49, 27),
(65, 50, 27),
(66, 50, 6),
(67, 51, 6),
(68, 51, 27),
(69, 52, 6),
(70, 52, 27),
(71, 53, 6),
(72, 53, 10),
(73, 53, 12),
(74, 53, 27),
(75, 55, 13),
(76, 55, 27),
(77, 55, 23),
(78, 56, 10),
(79, 56, 6),
(80, 56, 27),
(81, 58, 8),
(82, 58, 12),
(83, 58, 27),
(84, 58, 5),
(85, 59, 3),
(86, 59, 10),
(87, 59, 12),
(88, 59, 6),
(89, 59, 27),
(90, 61, 6),
(91, 61, 10),
(92, 61, 12),
(93, 61, 27),
(94, 62, 6),
(95, 62, 10),
(96, 62, 27),
(97, 63, 10),
(98, 63, 27),
(99, 64, 15),
(100, 64, 27),
(101, 67, 6),
(102, 67, 10),
(103, 67, 27),
(104, 68, 10),
(105, 68, 27),
(106, 69, 3),
(107, 69, 10),
(108, 69, 12),
(109, 69, 6),
(110, 69, 17),
(111, 70, 6),
(112, 70, 10),
(113, 70, 27),
(114, 71, 6),
(115, 71, 10),
(116, 71, 12),
(117, 71, 27),
(118, 73, 9),
(119, 73, 15),
(120, 74, 17),
(121, 79, 27),
(122, 79, 10),
(123, 83, 11),
(124, 83, 27),
(125, 84, 10),
(126, 84, 12),
(127, 84, 6),
(128, 84, 27),
(129, 85, 27),
(130, 85, 6),
(131, 86, 10),
(132, 86, 27),
(133, 87, 10),
(134, 87, 27),
(135, 88, 10),
(136, 88, 27),
(137, 88, 14),
(138, 90, 12),
(139, 90, 27),
(140, 91, 12),
(141, 91, 27),
(142, 93, 6),
(143, 93, 10),
(144, 93, 12),
(145, 93, 27),
(146, 94, 27),
(147, 94, 10),
(148, 95, 27),
(149, 95, 10),
(150, 96, 9),
(151, 96, 15),
(152, 97, 4),
(153, 97, 9),
(154, 98, 15),
(155, 99, 3),
(156, 99, 10),
(157, 99, 12),
(158, 99, 6),
(159, 99, 17),
(160, 100, 15),
(161, 101, 4),
(162, 101, 9),
(163, 102, 4),
(164, 102, 9),
(165, 103, 26),
(166, 104, 26),
(167, 105, 6),
(168, 105, 10),
(169, 105, 27),
(170, 106, 26),
(171, 108, 26),
(172, 109, 26),
(173, 110, 26),
(174, 111, 15),
(175, 111, 27),
(176, 112, 3),
(177, 112, 10),
(178, 112, 12),
(179, 112, 6),
(180, 112, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleTienda`
--

CREATE TABLE IF NOT EXISTS `detalleTienda` (
  `iddetalleTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleTienda`),
  KEY `fk_idtienda` (`idtienda`),
  KEY `fk_idproducto` (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=312 ;

--
-- Volcado de datos para la tabla `detalleTienda`
--

INSERT INTO `detalleTienda` (`iddetalleTienda`, `idtienda`, `idproducto`) VALUES
(1, 1, 141),
(2, 1, 143),
(3, 1, 142),
(4, 1, 136),
(5, 1, 363),
(6, 2, 112),
(7, 2, 103),
(8, 2, 83),
(9, 2, 320),
(10, 2, 280),
(11, 3, 307),
(12, 3, 54),
(13, 3, 379),
(14, 4, 396),
(15, 4, 39),
(16, 4, 140),
(17, 4, 139),
(18, 4, 95),
(19, 4, 288),
(20, 5, 235),
(21, 5, 237),
(22, 5, 236),
(23, 6, 307),
(24, 6, 380),
(25, 6, 79),
(26, 6, 254),
(27, 6, 63),
(28, 7, 235),
(29, 7, 237),
(30, 7, 236),
(31, 8, 37),
(32, 8, 439),
(33, 8, 248),
(34, 8, 57),
(35, 8, 427),
(37, 9, 217),
(38, 9, 336),
(39, 10, 158),
(40, 10, 221),
(41, 10, 402),
(42, 11, 235),
(43, 11, 237),
(44, 11, 236),
(45, 12, 202),
(46, 14, 202),
(47, 16, 317),
(48, 16, 356),
(49, 16, 398),
(50, 16, 114),
(51, 19, 299),
(52, 20, 244),
(53, 22, 137),
(54, 22, 256),
(55, 22, 423),
(56, 22, 146),
(57, 22, 284),
(58, 23, 77),
(59, 23, 416),
(60, 23, 2),
(61, 24, 80),
(62, 24, 235),
(63, 24, 249),
(64, 24, 205),
(65, 25, 427),
(66, 25, 438),
(67, 25, 200),
(68, 25, 93),
(69, 25, 63),
(70, 26, 163),
(71, 26, 262),
(72, 41, 163),
(73, 41, 262),
(74, 44, 378),
(75, 44, 413),
(76, 44, 425),
(77, 44, 368),
(78, 44, 318),
(79, 45, 72),
(80, 45, 70),
(81, 45, 71),
(82, 45, 69),
(83, 45, 67),
(84, 46, 235),
(85, 46, 237),
(86, 46, 236),
(87, 47, 380),
(88, 47, 79),
(89, 47, 343),
(90, 47, 86),
(91, 47, 279),
(92, 48, 215),
(93, 48, 318),
(94, 48, 106),
(95, 48, 45),
(96, 48, 176),
(97, 48, 413),
(98, 49, 431),
(99, 49, 430),
(100, 49, 429),
(101, 49, 432),
(102, 50, 282),
(103, 50, 112),
(104, 50, 386),
(105, 50, 106),
(106, 50, 83),
(107, 51, 70),
(108, 51, 65),
(109, 51, 76),
(110, 51, 63),
(111, 51, 112),
(112, 51, 50),
(113, 51, 130),
(114, 52, 83),
(115, 52, 83),
(116, 52, 318),
(117, 52, 280),
(118, 52, 386),
(119, 52, 96),
(120, 52, 44),
(121, 52, 215),
(122, 52, 404),
(123, 52, 2),
(124, 53, 245),
(125, 53, 88),
(126, 53, 49),
(127, 53, 93),
(128, 53, 264),
(129, 55, 233),
(130, 55, 330),
(131, 55, 256),
(132, 55, 208),
(133, 55, 284),
(134, 56, 440),
(135, 56, 264),
(136, 56, 2),
(137, 58, 113),
(138, 58, 369),
(139, 58, 354),
(140, 58, 252),
(141, 59, 37),
(142, 59, 49),
(143, 59, 57),
(144, 59, 427),
(145, 59, 319),
(146, 61, 283),
(147, 61, 63),
(148, 61, 380),
(149, 61, 86),
(150, 61, 307),
(151, 62, 434),
(152, 62, 435),
(153, 62, 102),
(154, 62, 63),
(155, 63, 318),
(156, 63, 413),
(157, 64, 202),
(158, 67, 280),
(159, 67, 318),
(160, 67, 195),
(161, 67, 45),
(162, 67, 427),
(163, 68, 406),
(164, 68, 107),
(165, 68, 377),
(166, 68, 93),
(167, 68, 47),
(168, 69, 163),
(169, 69, 262),
(170, 69, 416),
(171, 69, 154),
(172, 69, 224),
(173, 70, 215),
(174, 70, 399),
(175, 70, 8),
(176, 71, 63),
(177, 71, 254),
(178, 71, 283),
(179, 71, 86),
(180, 73, 290),
(181, 73, 402),
(182, 73, 43),
(183, 74, 163),
(184, 74, 262),
(185, 74, 416),
(186, 74, 154),
(187, 74, 224),
(188, 79, 380),
(189, 79, 79),
(190, 79, 343),
(191, 79, 86),
(192, 79, 279),
(193, 83, 317),
(194, 83, 356),
(195, 83, 398),
(196, 83, 114),
(197, 84, 307),
(198, 84, 54),
(199, 84, 379),
(200, 85, 112),
(201, 85, 103),
(202, 85, 83),
(203, 85, 320),
(204, 85, 280),
(205, 86, 176),
(206, 86, 280),
(207, 86, 115),
(208, 86, 286),
(209, 87, 318),
(210, 87, 425),
(211, 87, 280),
(212, 87, 78),
(213, 87, 47),
(214, 88, 174),
(215, 88, 99),
(216, 88, 16),
(217, 88, 367),
(218, 90, 77),
(219, 90, 112),
(220, 90, 280),
(221, 90, 318),
(222, 90, 103),
(223, 91, 408),
(224, 91, 275),
(225, 91, 77),
(226, 91, 57),
(227, 91, 195),
(228, 93, 405),
(229, 93, 388),
(230, 93, 106),
(231, 93, 321),
(232, 93, 318),
(233, 94, 77),
(234, 95, 186),
(235, 95, 51),
(236, 95, 93),
(237, 95, 102),
(238, 95, 77),
(239, 95, 52),
(240, 96, 118),
(241, 96, 316),
(242, 96, 168),
(243, 96, 101),
(244, 96, 387),
(245, 97, 327),
(246, 97, 144),
(247, 97, 166),
(248, 97, 157),
(249, 97, 239),
(250, 97, 241),
(251, 98, 202),
(252, 99, 163),
(253, 99, 262),
(254, 99, 416),
(255, 99, 154),
(256, 99, 224),
(257, 100, 160),
(258, 100, 60),
(259, 101, 297),
(260, 101, 182),
(261, 101, 1),
(262, 102, 220),
(263, 102, 178),
(264, 102, 325),
(265, 102, 43),
(266, 102, 221),
(267, 102, 347),
(268, 102, 93),
(269, 102, 77),
(270, 102, 187),
(271, 103, 101),
(272, 103, 108),
(273, 103, 43),
(274, 104, 323),
(275, 104, 287),
(276, 104, 43),
(277, 104, 360),
(278, 105, 280),
(279, 105, 318),
(280, 105, 195),
(281, 105, 45),
(282, 105, 427),
(283, 106, 199),
(284, 106, 18),
(285, 106, 324),
(286, 106, 43),
(287, 106, 329),
(288, 108, 312),
(289, 108, 43),
(290, 108, 56),
(291, 109, 360),
(292, 109, 287),
(293, 109, 168),
(294, 109, 221),
(295, 109, 43),
(296, 110, 118),
(297, 110, 358),
(298, 110, 287),
(299, 110, 202),
(300, 110, 164),
(301, 111, 201),
(302, 111, 255),
(303, 111, 43),
(304, 111, 221),
(305, 111, 38),
(306, 111, 127),
(307, 112, 163),
(308, 112, 262),
(309, 112, 416),
(310, 112, 154),
(311, 112, 224);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallemarca`
--

CREATE TABLE IF NOT EXISTS `detallemarca` (
  `iddetalleMarca` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `idtienda` int(11) DEFAULT NULL,
  PRIMARY KEY (`iddetalleMarca`),
  KEY `fk_dm_idproducto` (`idproducto`),
  KEY `fk_dm_idmarca` (`idmarca`),
  KEY `idtienda` (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=164 ;

--
-- Volcado de datos para la tabla `detallemarca`
--

INSERT INTO `detallemarca` (`iddetalleMarca`, `idproducto`, `idmarca`, `idtienda`) VALUES
(1, NULL, 31, 1),
(2, NULL, 338, 2),
(3, NULL, 222, 3),
(4, NULL, 381, 4),
(5, NULL, 405, 4),
(6, NULL, 114, 4),
(7, NULL, 395, 4),
(8, NULL, 8, 4),
(9, NULL, 307, 5),
(10, NULL, 117, 5),
(11, NULL, 276, 5),
(12, NULL, 375, 5),
(13, NULL, 274, 6),
(14, NULL, 346, 7),
(15, NULL, 423, 7),
(16, NULL, 426, 7),
(17, NULL, 19, 7),
(18, NULL, 344, 8),
(19, NULL, 348, 8),
(20, NULL, 4, 8),
(21, NULL, 294, 8),
(22, NULL, 375, 8),
(23, NULL, 270, 8),
(24, NULL, 190, 8),
(25, NULL, 500, 9),
(26, NULL, 323, 10),
(27, NULL, 331, 11),
(28, NULL, 18, 11),
(29, NULL, 199, 11),
(30, NULL, 4, 11),
(31, NULL, 55, 11),
(32, NULL, 19, 11),
(33, NULL, 410, 12),
(34, NULL, 60, 14),
(35, NULL, 77, 16),
(36, NULL, 295, 16),
(37, NULL, 123, 16),
(38, NULL, 224, 19),
(39, NULL, 248, 19),
(40, NULL, 83, 20),
(41, NULL, 236, 22),
(42, NULL, 104, 22),
(43, NULL, 211, 22),
(44, NULL, 248, 22),
(45, NULL, 234, 22),
(46, NULL, 105, 23),
(47, NULL, 455, 24),
(48, NULL, 37, 25),
(49, NULL, 294, 25),
(50, NULL, 344, 25),
(51, NULL, 301, 25),
(52, NULL, 339, 25),
(53, NULL, 315, 26),
(54, NULL, 313, 26),
(55, NULL, 315, 41),
(56, NULL, 313, 41),
(57, NULL, 245, 44),
(58, NULL, 401, 45),
(59, NULL, 177, 46),
(60, NULL, 132, 46),
(61, NULL, 345, 46),
(62, NULL, 322, 46),
(63, NULL, 406, 46),
(64, NULL, 9, 46),
(65, NULL, 482, 47),
(66, NULL, 483, 47),
(67, NULL, 484, 47),
(68, NULL, 428, 48),
(69, NULL, 66, 49),
(70, NULL, 294, 49),
(71, NULL, 375, 49),
(72, NULL, 44, 50),
(73, NULL, 183, 51),
(74, NULL, 152, 52),
(75, NULL, 190, 53),
(76, NULL, 392, 55),
(77, NULL, 421, 55),
(78, NULL, 102, 55),
(79, NULL, 264, 55),
(80, NULL, 51, 55),
(81, NULL, 612, 55),
(82, NULL, 488, 55),
(83, NULL, 472, 55),
(84, NULL, 618, 55),
(85, NULL, 595, 55),
(86, NULL, 352, 56),
(87, NULL, 207, 58),
(88, NULL, 62, 58),
(89, NULL, 95, 58),
(90, NULL, 26, 58),
(91, NULL, 294, 59),
(92, NULL, 344, 59),
(93, NULL, 4, 59),
(94, NULL, 348, 59),
(95, NULL, 73, 61),
(96, NULL, 191, 61),
(97, NULL, 288, 61),
(98, NULL, 366, 61),
(99, NULL, 57, 61),
(100, NULL, 200, 62),
(101, NULL, 435, 64),
(102, NULL, 354, 67),
(103, NULL, 86, 67),
(104, NULL, 265, 67),
(105, NULL, 106, 67),
(106, NULL, 370, 67),
(107, NULL, 258, 68),
(108, NULL, 15, 69),
(109, NULL, 377, 69),
(110, NULL, 313, 69),
(111, NULL, 362, 69),
(112, NULL, 242, 70),
(113, NULL, 273, 71),
(114, NULL, 36, 73),
(115, NULL, 315, 74),
(116, NULL, 313, 74),
(117, NULL, 407, 74),
(118, NULL, 15, 74),
(119, NULL, 377, 74),
(120, NULL, 362, 74),
(121, NULL, 162, 79),
(122, NULL, 77, 83),
(123, NULL, 295, 83),
(124, NULL, 123, 83),
(125, NULL, 222, 84),
(126, NULL, 338, 85),
(127, NULL, 620, 86),
(128, NULL, 205, 87),
(129, NULL, 238, 88),
(130, NULL, 287, 88),
(131, NULL, 144, 88),
(132, NULL, 160, 88),
(133, NULL, 327, 90),
(134, NULL, 306, 91),
(135, NULL, 259, 93),
(136, NULL, 171, 95),
(137, NULL, 369, 96),
(138, NULL, 48, 97),
(139, NULL, 60, 98),
(140, NULL, 15, 99),
(141, NULL, 377, 99),
(142, NULL, 313, 99),
(143, NULL, 362, 99),
(144, NULL, 130, 100),
(145, NULL, 100, 101),
(146, NULL, 496, 101),
(147, NULL, 188, 102),
(148, NULL, 170, 103),
(149, NULL, 223, 104),
(150, NULL, 354, 105),
(151, NULL, 86, 105),
(152, NULL, 265, 105),
(153, NULL, 106, 105),
(154, NULL, 370, 105),
(155, NULL, 68, 106),
(156, NULL, 396, 108),
(157, NULL, 220, 109),
(158, NULL, 127, 110),
(159, NULL, 367, 111),
(160, NULL, 15, 112),
(161, NULL, 377, 112),
(162, NULL, 313, 112),
(163, NULL, 362, 112);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estacionamiento`
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
-- Estructura de tabla para la tabla `estadisticasPagina`
--

CREATE TABLE IF NOT EXISTS `estadisticasPagina` (
  `idestadisticasPagina` int(11) NOT NULL AUTO_INCREMENT,
  `nomPagina` varchar(45) DEFAULT NULL COMMENT 'nombre de la pagina',
  `contadorVisitas` int(11) DEFAULT '0' COMMENT 'cantidad de veces que se ha abierto la pagina',
  `fechaVisita` date DEFAULT NULL COMMENT 'cuando se accedio a la pagina',
  PRIMARY KEY (`idestadisticasPagina`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='estadisticas de visitas por pagina' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticasTienda`
--

CREATE TABLE IF NOT EXISTS `estadisticasTienda` (
  `idestadisticasTienda` int(11) NOT NULL AUTO_INCREMENT,
  `nomTienda` varchar(45) DEFAULT NULL COMMENT 'nombre de la tienda',
  `contadorVisitas` int(11) DEFAULT '0' COMMENT 'cantidad de visitas',
  `fechaVisita` date DEFAULT NULL COMMENT 'cuando se visito',
  PRIMARY KEY (`idestadisticasTienda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `idlogs` int(11) NOT NULL AUTO_INCREMENT,
  `logscol` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idlogs`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE IF NOT EXISTS `marca` (
  `idmarca` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=621 ;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`idmarca`, `nombre`) VALUES
(4, 'Adidas'),
(8, 'Alo'),
(9, 'Amchi'),
(15, 'AOC'),
(18, 'Arizona'),
(19, 'Arnette'),
(26, 'Avent'),
(31, 'Banco Falabella'),
(36, 'Bariloche'),
(37, 'Bata'),
(44, 'Bellota'),
(48, 'Biblioteca Viva'),
(51, 'Biocure'),
(55, 'Bolle'),
(57, 'Borghi'),
(60, 'Bresler'),
(62, 'Britax'),
(66, 'Bubble Gummers'),
(68, 'Buffet Express'),
(73, 'Caffarena'),
(77, 'Cannon'),
(83, 'Casa & Ideas'),
(86, 'Cat'),
(95, 'Chicco'),
(100, 'Cinemark'),
(102, 'Cluny'),
(104, 'Colgate'),
(105, 'Colloky'),
(106, 'Columbia'),
(114, 'CYR'),
(117, 'Davison'),
(123, 'Disney'),
(127, 'Doggis'),
(130, 'Dunkin Donut''S'),
(132, 'DYG'),
(144, 'Eurostil'),
(152, 'Ferouch'),
(160, 'Finger Paint'),
(162, 'Flores'),
(170, 'Fritz'),
(171, 'Gacel'),
(177, 'GMO'),
(183, 'Guante'),
(188, 'Happyland'),
(190, 'Head'),
(191, 'Hering'),
(199, 'Hugo Boss'),
(200, 'Hush Puppies'),
(205, 'Imagen'),
(207, 'Infanti'),
(211, 'Isdin'),
(220, 'Juan Maestro'),
(222, 'Kayser'),
(223, 'Kentucky Friend Chicken'),
(224, 'Kerastase'),
(234, 'La Roche Posa'),
(236, 'Laboratorio Chile'),
(238, 'Lakine'),
(242, 'Levi´S'),
(245, 'Limonada'),
(248, 'Loreal'),
(258, 'Matthew'),
(259, 'Maui & Sons'),
(264, 'Medipharm'),
(265, 'Merrel'),
(270, 'Mitre'),
(273, 'Moletto'),
(274, 'Monarch'),
(276, 'Montini'),
(287, 'Neo Extension'),
(288, 'Nero'),
(294, 'Nike'),
(295, 'Ninbus'),
(301, 'North Star'),
(306, 'Opaline'),
(307, 'Opticas Schilling'),
(313, 'Panasonic'),
(315, 'París'),
(322, 'Pepe Jeans'),
(323, 'Perfúmame'),
(327, 'Pillin'),
(331, 'Place Vendome'),
(338, 'Potros'),
(339, 'Power'),
(344, 'Puma'),
(345, 'Ralph'),
(346, 'Ray Ban'),
(348, 'Reebok'),
(352, 'Rip Curl'),
(354, 'Rockford'),
(362, 'Samsung'),
(366, 'Sara'),
(367, 'Savory'),
(369, 'Schop Dog'),
(370, 'Sebago'),
(375, 'Skechers'),
(377, 'Sony'),
(381, 'Stadler'),
(392, 'Tarjeta Salco'),
(395, 'Tegmaph'),
(396, 'Telepizza'),
(401, 'Todo Piel'),
(405, 'Torre'),
(406, 'Toscani'),
(407, 'Toshiba'),
(410, 'Trendy'),
(421, 'Vitamin Life'),
(423, 'Vogue'),
(426, 'Volpantie'),
(428, 'Wado''s'),
(435, 'Yogen Fruz'),
(455, 'Kodak'),
(472, 'Chia'),
(482, 'Haby'),
(483, 'Fergie'),
(484, 'Body Line'),
(488, 'Daily One Gold'),
(496, 'Cinemundo'),
(500, 'Accesory Place'),
(595, 'Secure'),
(612, 'Termofat'),
(618, 'Triline'),
(620, 'Umbrale');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
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
-- Estructura de tabla para la tabla `motivo`
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
-- Estructura de tabla para la tabla `nodos`
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
-- Volcado de datos para la tabla `nodos`
--

INSERT INTO `nodos` (`idnodo`, `idcambiadorPiso`, `ubicacionx`, `ubicaciony`, `piso`, `vecino1`, `vecino2`, `vecino3`, `vecino4`, `coordenadaReal`) VALUES
(1, NULL, '15', '62', '1', 0, 0, 0, 0, '15_62'),
(2, NULL, '15', '58', '1', 0, 0, 0, 0, '15_58'),
(3, NULL, '15', '56', '1', 0, 0, 0, 0, '15_56'),
(4, NULL, '15', '54', '1', 0, 0, 0, 0, '15_54'),
(5, NULL, '15', '51', '1', 0, 0, 0, 0, '15_51'),
(6, NULL, '15', '48', '1', 0, 0, 0, 0, '15_48'),
(7, NULL, '15', '45', '1', 0, 0, 0, 0, '15_45'),
(8, NULL, '15', '41', '1', 0, 0, 0, 0, '15_41'),
(9, NULL, '23', '37', '1', 0, 0, 0, 0, '23_37'),
(10, NULL, '31', '38', '1', 0, 0, 0, 0, '31_38'),
(11, NULL, '34', '36', '1', 0, 0, 0, 0, '34_36'),
(12, NULL, '38', '35', '1', 0, 0, 0, 0, '38_35'),
(13, NULL, '47', '34', '1', 0, 0, 0, 0, '47_34'),
(14, NULL, '55', '34', '1', 0, 0, 0, 0, '55_34'),
(15, NULL, '60', '34', '1', 0, 0, 0, 0, '60_34'),
(16, NULL, '53', '31', '1', 0, 0, 0, 0, '53_31'),
(17, NULL, '52', '21', '1', 0, 0, 0, 0, '52_21'),
(18, NULL, '52', '13', '1', 0, 0, 0, 0, '52_13'),
(19, NULL, '50', '13', '1', 0, 0, 0, 0, '50_13'),
(20, NULL, '49', '31', '1', 0, 0, 0, 0, '49_31'),
(21, NULL, '43', '32', '1', 0, 0, 0, 0, '43_32'),
(22, NULL, '39', '32', '1', 0, 0, 0, 0, '39_32'),
(23, NULL, '33', '33', '1', 0, 0, 0, 0, '33_33'),
(24, NULL, '28', '33', '1', 0, 0, 0, 0, '28_33'),
(25, NULL, '24', '33', '1', 0, 0, 0, 0, '24_33'),
(26, NULL, '17', '32', '1', 0, 0, 0, 0, '17_32'),
(27, NULL, '77', '16', '1', 0, 0, 0, 0, '77_16'),
(28, NULL, '103', '16', '1', 0, 0, 0, 0, '103_16'),
(29, NULL, '115', '15', '1', 0, 0, 0, 0, '115_15'),
(30, NULL, '112', '15', '1', 0, 0, 0, 0, '112_15'),
(31, NULL, '110', '15', '1', 0, 0, 0, 0, '110_15'),
(32, NULL, '107', '14', '1', 0, 0, 0, 0, '107_14'),
(33, NULL, '102', '14', '1', 0, 0, 0, 0, '102_14'),
(34, NULL, '99', '15', '1', 0, 0, 0, 0, '99_15'),
(35, NULL, '96', '15', '1', 0, 0, 0, 0, '96_15'),
(36, NULL, '90', '15', '1', 0, 0, 0, 0, '90_15'),
(37, NULL, '88', '15', '1', 0, 0, 0, 0, '88_15'),
(38, NULL, '86', '15', '1', 0, 0, 0, 0, '86_15'),
(39, NULL, '84', '15', '1', 0, 0, 0, 0, '84_15'),
(40, NULL, '81', '15', '1', 0, 0, 0, 0, '81_15'),
(41, NULL, '45', '20', '2', 0, 0, 0, 0, '45_20'),
(42, NULL, '14', '32', '2', 0, 0, 0, 0, '14_32'),
(43, NULL, '16', '32', '2', 0, 0, 0, 0, '16_32'),
(44, NULL, '19', '32', '2', 0, 0, 0, 0, '19_32'),
(45, NULL, '23', '32', '2', 0, 0, 0, 0, '23_32'),
(46, NULL, '25', '32', '2', 0, 0, 0, 0, '25_32'),
(47, NULL, '28', '32', '2', 0, 0, 0, 0, '28_32'),
(48, NULL, '32', '32', '2', 0, 0, 0, 0, '32_32'),
(49, NULL, '35', '32', '2', 0, 0, 0, 0, '35_32'),
(50, NULL, '38', '32', '2', 0, 0, 0, 0, '38_32'),
(51, NULL, '40', '32', '2', 0, 0, 0, 0, '40_32'),
(52, NULL, '44', '32', '2', 0, 0, 0, 0, '44_32'),
(53, NULL, '48', '25', '2', 0, 0, 0, 0, '48_25'),
(54, NULL, '46', '16', '2', 0, 0, 0, 0, '46_16'),
(55, NULL, '52', '16', '2', 0, 0, 0, 0, '52_16'),
(56, NULL, '54', '17', '2', 0, 0, 0, 0, '54_17'),
(57, NULL, '54', '20', '2', 0, 0, 0, 0, '54_20'),
(58, NULL, '54', '24', '2', 0, 0, 0, 0, '54_24'),
(59, NULL, '54', '28', '2', 0, 0, 0, 0, '54_28'),
(60, NULL, '54', '31', '2', 0, 0, 0, 0, '54_31'),
(61, NULL, '54', '33', '2', 0, 0, 0, 0, '54_33'),
(62, NULL, '50', '33', '2', 0, 0, 0, 0, '50_33'),
(63, NULL, '45', '33', '2', 0, 0, 0, 0, '45_33'),
(64, NULL, '38', '34', '2', 0, 0, 0, 0, '38_34'),
(66, NULL, '36', '34', '2', 0, 0, 0, 0, '36_34'),
(67, NULL, '31', '37', '2', 0, 0, 0, 0, '31_37'),
(68, NULL, '27', '38', '2', 0, 0, 0, 0, '27_38'),
(69, NULL, '23', '43', '2', 0, 0, 0, 0, '23_43'),
(70, NULL, '20', '43', '2', 0, 0, 0, 0, '20_43'),
(71, NULL, '20', '40', '2', 0, 0, 0, 0, '20_40'),
(72, NULL, '19', '37', '2', 0, 0, 0, 0, '19_37'),
(73, NULL, '27', '31', '3', 0, 0, 0, 0, '27_31'),
(74, NULL, '31', '29', '3', 0, 0, 0, 0, '31_29'),
(75, NULL, '35', '31', '3', 0, 0, 0, 0, '35_31'),
(76, NULL, '46', '31', '3', 0, 0, 0, 0, '46_31'),
(77, NULL, '47', '25', '3', 0, 0, 0, 0, '47_25'),
(78, NULL, '47', '20', '3', 0, 0, 0, 0, '47_20'),
(79, NULL, '47', '16', '3', 0, 0, 0, 0, '47_16'),
(80, NULL, '46', '13', '3', 0, 0, 0, 0, '46_13'),
(81, NULL, '49', '13', '3', 0, 0, 0, 0, '49_13'),
(82, NULL, '52', '13', '3', 0, 0, 0, 0, '52_13'),
(83, NULL, '54', '13', '3', 0, 0, 0, 0, '54_13'),
(84, NULL, '54', '15', '3', 0, 0, 0, 0, '54_15'),
(85, NULL, '54', '18', '3', 0, 0, 0, 0, '54_18'),
(86, NULL, '52', '21', '3', 0, 0, 0, 0, '52_21'),
(87, NULL, '54', '23', '3', 0, 0, 0, 0, '54_23'),
(88, NULL, '54', '26', '3', 0, 0, 0, 0, '54_26'),
(89, NULL, '54', '28', '3', 0, 0, 0, 0, '54_28'),
(90, NULL, '54', '30', '3', 0, 0, 0, 0, '54_30'),
(91, NULL, '54', '32', '3', 0, 0, 0, 0, '54_32'),
(93, NULL, '51', '32', '3', 0, 0, 0, 0, '51_32'),
(94, NULL, '48', '32', '3', 0, 0, 0, 0, '48_32'),
(95, NULL, '45', '33', '3', 0, 0, 0, 0, '45_33'),
(96, NULL, '36', '33', '3', 0, 0, 0, 0, '36_33'),
(97, NULL, '27', '36', '3', 0, 0, 0, 0, '27_36'),
(98, NULL, '26', '39', '3', 0, 0, 0, 0, '26_39'),
(99, NULL, '22', '40', '3', 0, 0, 0, 0, '22_40'),
(100, NULL, '19', '37', '3', 0, 0, 0, 0, '19_37'),
(101, NULL, '34', '32', '4', 0, 0, 0, 0, '34_32'),
(102, NULL, '23', '29', '4', 0, 0, 0, 0, '23_29'),
(103, NULL, '36', '25', '4', 0, 0, 0, 0, '36_25'),
(104, NULL, '36', '19', '4', 0, 0, 0, 0, '36_19'),
(105, NULL, '36', '16', '4', 0, 0, 0, 0, '36_16'),
(106, NULL, '37', '14', '4', 0, 0, 0, 0, '37_14'),
(107, NULL, '47', '14', '4', 0, 0, 0, 0, '47_14'),
(108, NULL, '54', '27', '4', 0, 0, 0, 0, '54_27'),
(109, NULL, '51', '29', '4', 0, 0, 0, 0, '51_29'),
(110, NULL, '46', '29', '4', 0, 0, 0, 0, '46_29'),
(111, NULL, '39', '32', '4', 0, 0, 0, 0, '39_32'),
(112, NULL, '27', '38', '1', 0, 0, 0, 0, '27_38'),
(113, 1, '30', '36', '1', 0, 0, 0, 0, '30_36'),
(114, 2, '40', '35', '1', 0, 0, 0, 0, '40_35'),
(115, 3, '42', '35', '1', 0, 0, 0, 0, '42_35'),
(116, 4, '54', '37', '1', 0, 0, 0, 0, '54_37'),
(117, 5, '30', '36', '2', 0, 0, 0, 0, '30_36'),
(118, 6, '40', '35', '2', 0, 0, 0, 0, '40_35'),
(119, 7, '42', '35', '2', 0, 0, 0, 0, '42_35'),
(120, 8, '54', '37', '2', 0, 0, 0, 0, '54_37'),
(121, 9, '51', '30', '2', 0, 0, 0, 0, '51_30'),
(122, 10, '40', '35', '3', 0, 0, 0, 0, '40_35'),
(123, 11, '42', '35', '3', 0, 0, 0, 0, '42_35'),
(124, 12, '50', '23', '3', 0, 0, 0, 0, '50_23'),
(125, 13, '11', '31', '3', 0, 0, 0, 0, '11_31'),
(126, 14, '40', '35', '4', 0, 0, 0, 0, '40_35'),
(127, 15, '42', '35', '4', 0, 0, 0, 0, '42_35'),
(128, 16, '50', '23', '4', 0, 0, 0, 0, '50_23'),
(129, 17, '11', '31', '4', 0, 0, 0, 0, '11_31'),
(130, NULL, '50', '32', '1', 0, 0, 0, 0, '50_32'),
(131, NULL, '97', '13', '1', 0, 0, 0, 0, '97_13'),
(132, NULL, '42', '22', '4', 0, 0, 0, 0, '42_22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
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
-- Estructura de tabla para la tabla `perfilUsuario`
--

CREATE TABLE IF NOT EXISTS `perfilUsuario` (
  `idPerfilUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'identificador',
  `id_usuario` int(11) NOT NULL COMMENT 'id del usuario para vincular registro',
  `modulo` varchar(30) NOT NULL COMMENT 'nombre de funcionalidad o modulo',
  `credencial` tinyint(4) NOT NULL COMMENT 'estado, denegado o autorizado',
  PRIMARY KEY (`idPerfilUsuario`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`modulo`),
  KEY `fk_perfilUsuario_usuario1` (`id_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posAreaNegocio`
--

CREATE TABLE IF NOT EXISTS `posAreaNegocio` (
  `idposAreaNegocio` int(11) NOT NULL AUTO_INCREMENT,
  `idareaNegocio` int(11) DEFAULT NULL,
  `idnodo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idposAreaNegocio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `posAreaNegocio`
--

INSERT INTO `posAreaNegocio` (`idposAreaNegocio`, `idareaNegocio`, `idnodo`) VALUES
(1, 6, 131),
(2, 3, 132);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `genero` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=441 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `genero`, `tipo`) VALUES
(1, '3D', 'NULL', 'NULL'),
(2, 'Accesorios', 'NULL', 'NULL'),
(8, 'Accesorios Para Mujer Y Hombre', 'NULL', 'NULL'),
(16, 'Alisadoras', 'NULL', 'NULL'),
(18, 'Almuerzo', 'NULL', 'NULL'),
(37, 'Balones', 'NULL', 'NULL'),
(38, 'Barquillos', 'NULL', 'NULL'),
(39, 'Bastidores', 'NULL', 'NULL'),
(43, 'Bebidas', 'NULL', 'NULL'),
(44, 'Bermudas', 'NULL', 'NULL'),
(45, 'Billeteras', 'NULL', 'NULL'),
(47, 'Blusas', 'NULL', 'NULL'),
(49, 'Bolsos', 'NULL', 'NULL'),
(50, 'Bolsos De Cuero', 'NULL', 'NULL'),
(51, 'Botas', 'NULL', 'NULL'),
(52, 'Botines', 'NULL', 'NULL'),
(54, 'Boxer', 'NULL', 'NULL'),
(56, 'Burritos', 'NULL', 'NULL'),
(57, 'Buzos', 'NULL', 'NULL'),
(60, 'Café', 'NULL', 'NULL'),
(63, 'Calcetines', 'NULL', 'NULL'),
(65, 'Calzado De Vestir', 'NULL', 'NULL'),
(67, 'Calzado Descanso', 'NULL', 'NULL'),
(69, 'Calzado Fiesta', 'NULL', 'NULL'),
(70, 'Calzado Formal', 'NULL', 'NULL'),
(71, 'Calzado Informal', 'NULL', 'NULL'),
(72, 'Calzado Mujer', 'NULL', 'NULL'),
(76, 'Calzado Tipo Zapatillas', 'NULL', 'NULL'),
(77, 'Calzados', 'NULL', 'NULL'),
(78, 'Calzas', 'NULL', 'NULL'),
(79, 'Calzones', 'NULL', 'NULL'),
(80, 'Camaras', 'NULL', 'NULL'),
(83, 'Camisas', 'NULL', 'NULL'),
(86, 'Camisetas', 'NULL', 'NULL'),
(88, 'Candados', 'NULL', 'NULL'),
(93, 'Carteras', 'NULL', 'NULL'),
(95, 'Cartones', 'NULL', 'NULL'),
(96, 'Casacas', 'NULL', 'NULL'),
(99, 'Cepillos', 'NULL', 'NULL'),
(101, 'Cervezas', 'NULL', 'NULL'),
(102, 'Chalas', 'NULL', 'NULL'),
(103, 'Chalecos', 'NULL', 'NULL'),
(106, 'Chaquetas', 'NULL', 'NULL'),
(107, 'Chaquetas De Cuero', 'NULL', 'NULL'),
(108, 'Churrascos', 'NULL', 'NULL'),
(112, 'Cinturones', 'NULL', 'NULL'),
(113, 'Coches', 'NULL', 'NULL'),
(114, 'Cojines', 'NULL', 'NULL'),
(115, 'Collares', 'NULL', 'NULL'),
(118, 'Completos', 'NULL', 'NULL'),
(127, 'Copas Helado', 'NULL', 'NULL'),
(130, 'Cordones', 'NULL', 'NULL'),
(136, 'Créditos', 'NULL', 'NULL'),
(137, 'Cremas', 'NULL', 'NULL'),
(139, 'Cuadernillos', 'NULL', 'NULL'),
(140, 'Cuadernos', 'NULL', 'NULL'),
(141, 'Cuentas Corrientes', 'NULL', 'NULL'),
(142, 'Cuentas De Ahorro', 'NULL', 'NULL'),
(143, 'Cuentas Vista', 'NULL', 'NULL'),
(144, 'Cuentos', 'NULL', 'NULL'),
(146, 'Cuidado Personal', 'NULL', 'NULL'),
(154, 'Deporte', 'NULL', 'NULL'),
(157, 'Diccionarios', 'NULL', 'NULL'),
(158, 'Discoteque', 'NULL', 'NULL'),
(160, 'Donuts And Late', 'NULL', 'NULL'),
(163, 'Electronica', 'NULL', 'NULL'),
(164, 'Empanadas', 'NULL', 'NULL'),
(166, 'Enciclopedia', 'NULL', 'NULL'),
(168, 'Ensaladas', 'NULL', 'NULL'),
(174, 'Extensiones', 'NULL', 'NULL'),
(176, 'Faldas', 'NULL', 'NULL'),
(178, 'Fichas Juego', 'NULL', 'NULL'),
(182, 'Formatos Digitales', 'NULL', 'NULL'),
(186, 'Gacel', 'NULL', 'NULL'),
(187, 'Gafas', 'NULL', 'NULL'),
(195, 'Gorros', 'NULL', 'NULL'),
(199, 'Hamburguesas', 'NULL', 'NULL'),
(200, 'Hawaianas', 'NULL', 'NULL'),
(201, 'Heladeria', 'NULL', 'NULL'),
(202, 'Helados', 'NULL', 'NULL'),
(205, 'Impresiones Fotograficas', 'NULL', 'NULL'),
(208, 'Insumos', 'NULL', 'NULL'),
(215, 'Jeans', 'NULL', 'NULL'),
(217, 'Joyas', 'NULL', 'NULL'),
(220, 'Juegos Infantiles', 'NULL', 'NULL'),
(221, 'Jugos', 'NULL', 'NULL'),
(224, 'Juguetes', 'NULL', 'NULL'),
(233, 'Leche', 'NULL', 'NULL'),
(235, 'Lentes', 'NULL', 'NULL'),
(236, 'Lentes De Sol', 'NULL', 'NULL'),
(237, 'Lentes Opticos', 'NULL', 'NULL'),
(239, 'Libros Entretenimiento', 'NULL', 'NULL'),
(241, 'Literatura General', 'NULL', 'NULL'),
(244, 'Loza', 'NULL', 'NULL'),
(245, 'Maletas', 'NULL', 'NULL'),
(248, 'Maquinas De Ejercicios', 'NULL', 'NULL'),
(249, 'Marcos', 'NULL', 'NULL'),
(252, 'Mecedoras', 'NULL', 'NULL'),
(254, 'Medias', 'NULL', 'NULL'),
(255, 'Medias Luna', 'NULL', 'NULL'),
(256, 'Medicamentos', 'NULL', 'NULL'),
(262, 'Menaje', 'NULL', 'NULL'),
(264, 'Mochilas', 'NULL', 'NULL'),
(275, 'Ositos', 'NULL', 'NULL'),
(279, 'Pantaletas', 'NULL', 'NULL'),
(280, 'Pantalones', 'NULL', 'NULL'),
(282, 'Pantalones De Vestir', 'NULL', 'NULL'),
(283, 'Pantys', 'NULL', 'NULL'),
(284, 'Pañales', 'NULL', 'NULL'),
(286, 'Pañuelos', 'NULL', 'NULL'),
(287, 'Papas Fritas', 'NULL', 'NULL'),
(288, 'Papeles', 'NULL', 'NULL'),
(290, 'Parrilladas', 'NULL', 'NULL'),
(297, 'Peliculas 35 mm', 'NULL', 'NULL'),
(299, 'Peluquería', 'NULL', 'NULL'),
(307, 'Pijamas', 'NULL', 'NULL'),
(312, 'Pizzas', 'NULL', 'NULL'),
(316, 'Platos Preparados', 'NULL', 'NULL'),
(317, 'Plumones', 'NULL', 'NULL'),
(318, 'Polera', 'NULL', 'NULL'),
(319, 'Poleras Deportivas', 'NULL', 'NULL'),
(320, 'Poleras Piqué', 'NULL', 'NULL'),
(321, 'Polerones', 'NULL', 'NULL'),
(323, 'Pollo Frito', 'NULL', 'NULL'),
(324, 'Postres', 'NULL', 'NULL'),
(325, 'Premios', 'NULL', 'NULL'),
(327, 'Prestamo De Libros E Internet', 'NULL', 'NULL'),
(329, 'Productos Ligth', 'NULL', 'NULL'),
(330, 'Productos Maternales', 'NULL', 'NULL'),
(336, 'Pulseras', 'NULL', 'NULL'),
(343, 'Reductoras', 'NULL', 'NULL'),
(347, 'Relojes', 'NULL', 'NULL'),
(354, 'Ropa Infantil', 'NULL', 'NULL'),
(356, 'Sabanas', 'NULL', 'NULL'),
(358, 'Salchipapas', 'NULL', 'NULL'),
(360, 'Sandwichs', 'NULL', 'NULL'),
(363, 'Seguros', 'NULL', 'NULL'),
(367, 'Shampoo', 'NULL', 'NULL'),
(368, 'Shorts', 'NULL', 'NULL'),
(369, 'Sillas De Comer', 'NULL', 'NULL'),
(377, 'Sombreros', 'NULL', 'NULL'),
(378, 'Sombrillas', 'NULL', 'NULL'),
(379, 'Sostenes Calzones', 'NULL', 'NULL'),
(380, 'Sostenes', 'NULL', 'NULL'),
(386, 'Sweaters', 'NULL', 'NULL'),
(387, 'Tablas', 'NULL', 'NULL'),
(388, 'Tablas De Surf', 'NULL', 'NULL'),
(396, 'Tintas Impresora', 'NULL', 'NULL'),
(398, 'Toallas', 'NULL', 'NULL'),
(399, 'Tops', 'NULL', 'NULL'),
(402, 'Tragos', 'NULL', 'NULL'),
(404, 'Trajes De Baño', 'NULL', 'NULL'),
(405, 'Trajes De Surf', 'NULL', 'NULL'),
(406, 'Trajes Formales', 'NULL', 'NULL'),
(408, 'Tutos', 'NULL', 'NULL'),
(413, 'Vestidos', 'NULL', 'NULL'),
(416, 'Vestuario', 'NULL', 'NULL'),
(423, 'Vitaminas', 'NULL', 'NULL'),
(425, 'Voleros', 'NULL', 'NULL'),
(427, 'Zapatillas', 'NULL', 'NULL'),
(429, 'Zapatillas Deportivas', 'NULL', 'NULL'),
(430, 'Zapatillas Niñas', 'NULL', 'NULL'),
(431, 'Zapatillas Niño', 'NULL', 'NULL'),
(432, 'Zapatillas Primeros Pasos', 'NULL', 'NULL'),
(434, 'Calzados Hombre', 'NULL', 'NULL'),
(435, 'Calzados Mujer', 'NULL', 'NULL'),
(438, 'Calzados De Vestir', 'NULL', 'NULL'),
(439, 'Camisetas Futbol', 'NULL', 'NULL'),
(440, 'Ropa De Nieve', 'NULL', 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promocion`
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
-- Estructura de tabla para la tabla `propiedadesTienda`
--

CREATE TABLE IF NOT EXISTS `propiedadesTienda` (
  `idpropiedadesTienda` int(11) NOT NULL AUTO_INCREMENT,
  `idtienda` int(11) DEFAULT NULL,
  `idnodo` int(11) DEFAULT NULL,
  `modulo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpropiedadesTienda`),
  KEY `fk_propiedadesTienda_1` (`idtienda`),
  KEY `fk_propiedadesTienda_2` (`idnodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=111 ;

--
-- Volcado de datos para la tabla `propiedadesTienda`
--

INSERT INTO `propiedadesTienda` (`idpropiedadesTienda`, `idtienda`, `idnodo`, `modulo`) VALUES
(1, 1, 1, 'NULL'),
(2, 2, 2, 'NULL'),
(3, 3, 3, 'NULL'),
(4, 4, 4, 'NULL'),
(5, 5, 5, 'NULL'),
(6, 6, 6, 'NULL'),
(7, 7, 7, 'NULL'),
(8, 8, 8, 'NULL'),
(9, 9, 9, 'NULL'),
(10, 10, 10, 'NULL'),
(11, 11, 11, 'NULL'),
(12, 12, 12, 'NULL'),
(13, 13, 13, 'NULL'),
(14, 14, 14, 'NULL'),
(15, 15, 15, 'NULL'),
(16, 16, 16, 'NULL'),
(17, 17, 17, 'NULL'),
(18, 18, 18, 'NULL'),
(19, 19, 19, 'NULL'),
(20, 20, 20, 'NULL'),
(21, 21, 21, 'NULL'),
(22, 22, 22, 'NULL'),
(23, 23, 23, 'NULL'),
(24, 24, 24, 'NULL'),
(25, 25, 25, 'NULL'),
(26, 26, 26, 'NULL'),
(27, 27, 27, 'NULL'),
(28, 28, 28, 'NULL'),
(29, 29, 29, 'NULL'),
(30, 30, 30, 'NULL'),
(31, 31, 31, 'NULL'),
(32, 32, 32, 'NULL'),
(33, 33, 33, 'NULL'),
(34, 34, 34, 'NULL'),
(35, 35, 35, 'NULL'),
(36, 36, 36, 'NULL'),
(37, 37, 37, 'NULL'),
(38, 38, 38, 'NULL'),
(39, 39, 39, 'NULL'),
(40, 40, 40, 'NULL'),
(41, 41, 41, 'NULL'),
(42, 42, 42, 'NULL'),
(43, 43, 43, 'NULL'),
(44, 44, 44, 'NULL'),
(45, 45, 45, 'NULL'),
(46, 46, 46, 'NULL'),
(47, 47, 47, 'NULL'),
(48, 48, 48, 'NULL'),
(49, 49, 49, 'NULL'),
(50, 50, 50, 'NULL'),
(51, 51, 51, 'NULL'),
(52, 52, 52, 'NULL'),
(53, 53, 53, 'NULL'),
(54, 54, 54, 'NULL'),
(55, 55, 55, 'NULL'),
(56, 56, 56, 'NULL'),
(57, 57, 57, 'NULL'),
(58, 58, 58, 'NULL'),
(59, 59, 59, 'NULL'),
(60, 60, 60, 'NULL'),
(61, 61, 61, 'NULL'),
(62, 62, 62, 'NULL'),
(63, 63, 63, 'NULL'),
(64, 64, 64, 'NULL'),
(65, 66, 66, 'NULL'),
(66, 67, 67, 'NULL'),
(67, 68, 68, 'NULL'),
(68, 69, 69, 'NULL'),
(69, 70, 70, 'NULL'),
(70, 71, 71, 'NULL'),
(71, 72, 72, 'NULL'),
(72, 73, 73, 'NULL'),
(73, 74, 74, 'NULL'),
(74, 75, 75, 'NULL'),
(75, 76, 76, 'NULL'),
(76, 77, 77, 'NULL'),
(77, 78, 78, 'NULL'),
(78, 79, 79, 'NULL'),
(79, 80, 80, 'NULL'),
(80, 81, 81, 'NULL'),
(81, 82, 82, 'NULL'),
(82, 83, 83, 'NULL'),
(83, 84, 84, 'NULL'),
(84, 85, 85, 'NULL'),
(85, 86, 86, 'NULL'),
(86, 87, 87, 'NULL'),
(87, 88, 88, 'NULL'),
(88, 89, 89, 'NULL'),
(89, 90, 90, 'NULL'),
(90, 91, 91, 'NULL'),
(91, 93, 93, 'NULL'),
(92, 94, 94, 'NULL'),
(93, 95, 95, 'NULL'),
(94, 96, 96, 'NULL'),
(95, 97, 97, 'NULL'),
(96, 98, 98, 'NULL'),
(97, 99, 99, 'NULL'),
(98, 100, 100, 'NULL'),
(99, 101, 101, 'NULL'),
(100, 102, 102, 'NULL'),
(101, 103, 103, 'NULL'),
(102, 104, 104, 'NULL'),
(103, 105, 105, 'NULL'),
(104, 106, 106, 'NULL'),
(105, 107, 107, 'NULL'),
(106, 108, 108, 'NULL'),
(107, 109, 109, 'NULL'),
(108, 110, 110, 'NULL'),
(109, 111, 111, 'NULL'),
(110, 112, 112, 'NULL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
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
-- Estructura de tabla para la tabla `rubro`
--

CREATE TABLE IF NOT EXISTS `rubro` (
  `idrubro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrubro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `rubro`
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
(24, 'Pasajes, Giros y Encomiendas', 'pasajes.jpg'),
(25, 'Educación', 'educacion.jpg'),
(26, 'Patio de Comidas', 'food.jpg'),
(27, 'Tiendas Menores', 'tiendasmenores.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subCategoria`
--

CREATE TABLE IF NOT EXISTS `subCategoria` (
  `idSubCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubCategoria` varchar(100) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubCategoria`),
  KEY `fk_subCategoria_categoria` (`idCategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subMotivo`
--

CREATE TABLE IF NOT EXISTS `subMotivo` (
  `idSubMotivo` int(11) NOT NULL AUTO_INCREMENT,
  `nombreSubMotivo` varchar(100) DEFAULT NULL,
  `idMotivo` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSubMotivo`),
  KEY `fk_subMotivo_motivo` (`idMotivo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE IF NOT EXISTS `tienda` (
  `idtienda` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `logo` varchar(45) DEFAULT NULL,
  `areaNegocio` int(11) DEFAULT '0' COMMENT 'areas de negocio, numericas segun mapa',
  PRIMARY KEY (`idtienda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`idtienda`, `nombre`, `logo`, `areaNegocio`) VALUES
(1, 'Banco Falabella', 'bancofalabella.jpg', 0),
(2, 'Potros', 'potros.jpg', 0),
(3, 'Kayser', 'kayser.jpg', 0),
(4, 'Librería Lápiz López', 'libreríalápizlópez.jpg', 0),
(5, 'Opticas Schilling', 'opticasschilling.jpg', 0),
(6, 'Monarch', 'monarch.jpg', 0),
(7, 'Opticas Econópticas', 'opticaseconópticas.jpg', 0),
(8, 'Sparta', 'sparta.jpg', 0),
(9, 'Accesory Place', 'accesoryplace.jpg', 0),
(10, 'Perfúmame', 'perfúmame.jpg', 0),
(11, 'Opticas Place Vendome', 'opticasplacevendome.jpg', 0),
(12, 'Trendy', 'trendy.jpg', 0),
(13, 'Vacante 01', 'vacante01.jpg', 0),
(14, 'Bresler ', 'bresler.jpg', 0),
(15, 'Vacante 02', 'vacante02.jpg', 0),
(16, 'Cannon', 'cannon.jpg', 0),
(17, 'Vacante 03', 'vacante03.jpg', 0),
(18, 'Vacante 04', 'vacante04.jpg', 0),
(19, 'Peluquería Glam & Co', 'peluqueriaglam&co.jpg', 0),
(20, 'Casa & Ideas', 'casa&ideas.jpg', 0),
(21, 'Vacante 05', 'vacante05.jpg', 0),
(22, 'Farmacias Cruz Verde', 'farmaciascruzverde.jpg', 0),
(23, 'Colloky', 'colloky.jpg', 0),
(24, 'Kodak', 'kodak.jpg', 0),
(25, 'Bata', 'bata.jpg', 0),
(26, 'París', 'parís.jpg', 1),
(27, 'Vacante 06', 'vacante06.jpg', 0),
(28, 'Vacante 07', 'vacante07.jpg', 0),
(29, 'Vacante 08', 'vacante08.jpg', 6),
(30, 'Vacante 09', 'vacante09.jpg', 6),
(31, 'Vacante 10', 'vacante10.jpg', 6),
(32, 'Vacante 11', 'vacante11.jpg', 6),
(33, 'Vacante 12', 'vacante12.jpg', 6),
(34, 'Vacante 13', 'vacante13.jpg', 6),
(35, 'Vacante 14', 'vacante14.jpg', 6),
(36, 'Vacante 15', 'vacante15.jpg', 6),
(37, 'Vacante 16', 'vacante16.jpg', 6),
(38, 'Vacante 17', 'vacante17.jpg', 6),
(39, 'Vacante 18', 'vacante18.jpg', 6),
(40, 'Vacante 19', 'vacante19.jpg', 6),
(41, 'París', 'parís.jpg', 1),
(42, 'Vacante 27', 'vacante27.jpg', 0),
(43, 'Vacante 20', 'vacante20.jpg', 0),
(44, 'Limonada ', 'limonada.jpg', 0),
(45, 'Todo Piel', 'todopiel.jpg', 0),
(46, 'Opticas GMO', 'opticasgmo.jpg', 0),
(47, 'Gema', 'gema.jpg', 0),
(48, 'Wado´s', 'wado´s.jpg', 0),
(49, 'Bubble Gummers ', 'bubblegummers.jpg', 0),
(50, 'Bellota', 'bellota.jpg', 0),
(51, 'Guante ', 'guante.jpg', 0),
(52, 'Ferouch', 'ferouch.jpg', 0),
(53, 'Head ', 'head.jpg', 0),
(54, 'Regalopolis', 'regalopolis.jpg', 0),
(55, 'Farmacias Salcobrand ', 'farmaciassalcobrand.jpg', 0),
(56, 'Rip Curl ', 'ripcurl.jpg', 0),
(57, 'Vacante 26', 'vacante26.jpg', 0),
(58, 'Baby Infanti ', 'babyinfanti.jpg', 0),
(59, 'Belsport', 'belsport.jpg', 0),
(60, 'Vacante 21', 'vacante21.jpg', 0),
(61, 'Caffarena ', 'caffarena.jpg', 0),
(62, 'Hush Puppies', 'hushpuppies.jpg', 0),
(63, 'Anastassia', 'anastassia.jpg', 0),
(64, 'Yoguen Fruz', 'yoguenfruz.jpg', 0),
(66, 'Cachemiras ', 'cachemiras.jpg', 0),
(67, 'Rockford', 'rockford.jpg', 0),
(68, 'Matthew', 'matthew.jpg', 0),
(69, 'Falabella', 'falabella.jpg', 1),
(70, 'Battery Street', 'batterystreet.jpg', 0),
(71, 'Moletto', 'moletto.jpg', 0),
(72, 'Cafe Cantabria ', 'cafecantabria.jpg', 0),
(73, 'Bariloche', 'bariloche.jpg', 0),
(74, 'París', 'parís.jpg', 1),
(75, 'Vacante 22 ', 'vacante22.jpg', 0),
(76, 'We Love Shoes ', 'weloveshoes.jpg', 0),
(77, 'Columbia ', 'columbia.jpg', 0),
(78, 'Feria Chilena Del Libro ', 'feriachilenadellibro.jpg', 0),
(79, 'Flores', 'flores.jpg', 0),
(80, 'Vacante 23', 'vacante23.jpg', 0),
(81, 'Vacante 24', 'vacante24.jpg', 0),
(82, 'Vacante 25', 'vacante25.jpg', 0),
(83, 'Cannon', 'cannon.jpg', 0),
(84, 'Kayser', 'kayser.jpg', 0),
(85, 'Potros', 'potros.jpg', 0),
(86, 'Umbrale', 'umbrale.jpg', 0),
(87, 'Imagen', 'imagen.jpg', 0),
(88, 'Intersalon', 'intersalon.jpg', 0),
(89, 'Muzza ', 'muzza.jpg', 0),
(90, 'Pillin', 'pillin.jpg', 0),
(91, 'Opaline', 'opaline.jpg', 0),
(93, 'Maui & Sons', 'maui&sons.jpg', 0),
(94, 'Calandre ', 'calandre.jpg', 0),
(95, 'Gacel', 'gacel.jpg', 0),
(96, 'Schop Dog ', 'schopdog.jpg', 0),
(97, 'Biblioteca Viva ', 'bibliotecaviva.jpg', 0),
(98, 'Bresler ', 'bresler.jpg', 0),
(99, 'Falabella', 'falabella.jpg', 0),
(100, 'Dunkin Donut''s', 'dunkindonuts.jpg', 0),
(101, 'Cinemundo ', 'cinemundo.jpg', 1),
(102, 'Happyland', 'happyland.jpg', 0),
(103, 'Fritz', 'fritz.jpg', 3),
(104, 'Kentucky Fried Chicken', 'kentuckyfriedchicken.jpg', 3),
(105, 'China Wok', 'chinawok.jpg', 3),
(106, 'Buffet Express', 'buffetexpress.jpg', 3),
(107, 'Astoria', 'astoria.jpg', 3),
(108, 'Telepizza ', 'telepizza.jpg', 3),
(109, 'Juan Maestro ', 'juanmaestro.jpg', 3),
(110, 'Doggi''s ', 'doggis.jpg', 3),
(111, 'Savory ', 'savory.jpg', 3),
(112, 'Falabella', 'falabella.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `totem`
--

CREATE TABLE IF NOT EXISTS `totem` (
  `idtotem` int(11) NOT NULL AUTO_INCREMENT,
  `idnodo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `orientacion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtotem`),
  KEY `fk_totem_1` (`idnodo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `totem`
--

INSERT INTO `totem` (`idtotem`, `idnodo`, `nombre`, `orientacion`) VALUES
(1, 130, 'T1', 'N');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
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
-- Estructura de tabla para la tabla `usuarios`
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
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalleOferta`
--
ALTER TABLE `detalleOferta`
  ADD CONSTRAINT `fk_do_idoferta` FOREIGN KEY (`idoferta`) REFERENCES `oferta` (`idoferta`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_do_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallePromocion`
--
ALTER TABLE `detallePromocion`
  ADD CONSTRAINT `fk_dt_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dt_idpromocion` FOREIGN KEY (`idpromocion`) REFERENCES `promocion` (`idpromocion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleRubro`
--
ALTER TABLE `detalleRubro`
  ADD CONSTRAINT `fk_dr_idrubro` FOREIGN KEY (`idrubro`) REFERENCES `rubro` (`idrubro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dr_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleTienda`
--
ALTER TABLE `detalleTienda`
  ADD CONSTRAINT `fk_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallemarca`
--
ALTER TABLE `detallemarca`
  ADD CONSTRAINT `detallemarca_ibfk_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dm_idmarca` FOREIGN KEY (`idmarca`) REFERENCES `marca` (`idmarca`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_dm_idproducto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `estacionamiento`
--
ALTER TABLE `estacionamiento`
  ADD CONSTRAINT `fk_estacionamiento_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_subMotivo` FOREIGN KEY (`idSubMotivo`) REFERENCES `subMotivo` (`idSubMotivo`);

--
-- Filtros para la tabla `motivo`
--
ALTER TABLE `motivo`
  ADD CONSTRAINT `fk_motivo_subCategoria` FOREIGN KEY (`idSubCategoria`) REFERENCES `subCategoria` (`idSubCategoria`);

--
-- Filtros para la tabla `nodos`
--
ALTER TABLE `nodos`
  ADD CONSTRAINT `fk_nodos_1` FOREIGN KEY (`idcambiadorPiso`) REFERENCES `cambiadorPiso` (`idcambiadorPiso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `oferta`
--
ALTER TABLE `oferta`
  ADD CONSTRAINT `fk_of_idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `promocion`
--
ALTER TABLE `promocion`
  ADD CONSTRAINT `idtienda` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `propiedadesTienda`
--
ALTER TABLE `propiedadesTienda`
  ADD CONSTRAINT `fk_propiedadesTienda_1` FOREIGN KEY (`idtienda`) REFERENCES `tienda` (`idtienda`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_propiedadesTienda_2` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `subCategoria`
--
ALTER TABLE `subCategoria`
  ADD CONSTRAINT `fk_subCategoria_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`);

--
-- Filtros para la tabla `subMotivo`
--
ALTER TABLE `subMotivo`
  ADD CONSTRAINT `fk_subMotivo_motivo` FOREIGN KEY (`idMotivo`) REFERENCES `motivo` (`idMotivo`);

--
-- Filtros para la tabla `totem`
--
ALTER TABLE `totem`
  ADD CONSTRAINT `fk_totem_1` FOREIGN KEY (`idnodo`) REFERENCES `nodos` (`idnodo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
