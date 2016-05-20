-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-05-2016 a las 22:00:30
-- Versión del servidor: 5.6.17-log
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ribera`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `arbitros`
--

CREATE TABLE IF NOT EXISTS `arbitros` (
  `idarbitro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idarbitro`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `arbitros`
--

INSERT INTO `arbitros` (`idarbitro`, `nombre`, `fecha_baja`, `updated_at`, `created_at`) VALUES
(6, 'Arbitro', NULL, '2015-04-10 00:59:54', '2015-04-10 00:59:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `idequipo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_equipo` varchar(45) DEFAULT NULL,
  `escudo` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `es_libre` tinyint(4) NOT NULL DEFAULT '0',
  `nombre_usuario` varchar(255) DEFAULT NULL,
  `clave` varchar(60) DEFAULT NULL,
  `observaciones` text,
  `mensaje` text,
  `aprobado` tinyint(4) NOT NULL DEFAULT '0',
  `autogestion` tinyint(4) DEFAULT '0',
  `director_tecnico` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idequipo`),
  UNIQUE KEY `NewIndex1` (`nombre_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=80 ;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`idequipo`, `nombre_equipo`, `escudo`, `foto`, `updated_at`, `created_at`, `es_libre`, `nombre_usuario`, `clave`, `observaciones`, `mensaje`, `aprobado`, `autogestion`, `director_tecnico`) VALUES
(14, 'NARICES BLANCAS F.C', 'naricesblancas.jpg', 'NARICES BLANCAS FC.jpg', '2015-04-11 05:40:57', NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(15, 'ASTON BIRRA F.C', 'juventudunida.jpg', 'JUVENTUD UNIDA.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(16, 'LOS GUSANOS F.C', 'losgusanosfc.jpg', 'LOS GUSANOS FC.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(17, 'HAWAII', 'otroequipo.jpg', 'OTRO EQUIPO.jpg', '2015-04-11 01:22:37', NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(21, 'SUDACA F.C', 'tirutiru.jpg', 'TIRU TIRU.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(22, 'ESQUINE F.C', 'esquinefc.jpg', 'ESQUINE FC.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(23, 'BERRACO F.C', 'lajauria.jpg', 'LA JAURIA.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(25, 'BARRIO PARQUE', 'velezgarfield.jpg', 'VELEZ GARFIELD.jpg', '2016-05-20 22:50:47', NULL, 0, NULL, NULL, '', '', 1, 0, 'T BARRIO'),
(27, '(LIBRE)', 'escudo-equipo27.PNG', 'foto-equipo27.PNG', '2016-05-20 22:47:26', NULL, 1, NULL, NULL, 'Equipo Libre q no suma puntos ni resta', 'Sin Mensaje Pendiente', 1, 0, 'Pedro Alfoso'),
(28, 'DEP. CRUCE ALBERDI', 'crucealberdi.jpg', 'DEP. CRUCE ALBERDI.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(29, 'TINTURAZO', 'tinturazo.jpg', 'TINTURAZO.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(30, 'MEMISTONE', 'vilazar.jpg', 'VILAZAR.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(32, 'DOCK SUD', 'docksud.jpg', 'DOCK SUD.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(33, 'SUC TEAM F.C', 'sucteamfc.jpg', 'SUC TEAM FC.jpg', NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(36, 'EL SOGAN', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(38, 'GALATASARAY', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(41, 'SANJO', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(43, 'SIN FIERRO F.C', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(46, 'FILIPO Y SUS PICHONES', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(47, 'DRINK TEAM', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(48, 'MARCELONA', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(49, 'SPARTA F.C', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(50, 'THE REAL TEAM F.C', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(51, 'EL ALMA F.C', NULL, NULL, '2016-05-20 22:51:02', NULL, 0, NULL, NULL, '', '', 1, 0, 'DT EL ALMAA'),
(52, 'ARIZONA', NULL, NULL, '2016-05-20 22:48:01', NULL, 0, NULL, NULL, '', '', 1, 0, 'DT'),
(53, 'ANCHA BANDA F.C', 'escudo-equipo53.PNG', 'foto-equipo53.png', '2016-05-20 22:50:24', NULL, 0, 'ancha', '$2y$10$4IvdZQ2XQ7GUIQttT/OUCe5yExkDyvj/KDChyHQN1nsLZDXIJgttG', '', '', 1, 1, 'DT ancha'),
(54, 'DEP. FAUSTINO', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(56, 'LA POCHI', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(57, 'REAL BAÑIL', NULL, NULL, '2015-05-14 01:24:27', NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(58, 'LOS ZARATE F.C', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(59, 'TORO F.C', NULL, NULL, '2015-05-14 01:19:39', NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(60, 'POPOVACH', NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, 0, NULL),
(61, 'aaaaaa', NULL, NULL, '2016-05-20 22:47:52', '2015-09-09 02:19:16', 0, NULL, NULL, '', '', 1, 0, 'Selefante'),
(62, '', NULL, NULL, '2016-03-24 23:36:40', '2016-03-24 23:36:40', 0, NULL, NULL, 'Desea anotarse en el torneo: ', NULL, 0, 0, NULL),
(63, 'Equipazo', NULL, NULL, '2016-03-25 00:00:17', '2016-03-24 23:44:05', 0, NULL, NULL, 'Desea anotarse en el torneo: ', NULL, 1, 0, NULL),
(64, 'ads', NULL, NULL, '2016-03-24 23:46:02', '2016-03-24 23:46:02', 0, NULL, NULL, 'Desea anotarse en el torneo: ', NULL, 0, 0, NULL),
(66, 'asd', NULL, NULL, '2016-03-24 23:47:37', '2016-03-24 23:47:37', 0, NULL, NULL, 'Desea anotarse en el torneo: ', NULL, 0, 0, NULL),
(67, 'asdads', NULL, NULL, '2016-03-24 23:49:56', '2016-03-24 23:49:56', 0, NULL, NULL, 'asdads', NULL, 0, 0, NULL),
(69, 'rrrr', NULL, NULL, '2016-03-24 23:53:24', '2016-03-24 23:53:24', 0, NULL, NULL, 'asdasd', NULL, 0, 0, NULL),
(70, 'asd', NULL, NULL, '2016-03-24 23:54:20', '2016-03-24 23:54:20', 0, NULL, NULL, 'asd', NULL, 0, 0, NULL),
(71, 'aasd', NULL, NULL, '2016-03-24 23:55:17', '2016-03-24 23:55:17', 0, NULL, NULL, 'asd', NULL, 0, 0, NULL),
(72, 'zsdfasd', NULL, NULL, '2016-03-25 00:01:13', '2016-03-24 23:56:17', 0, NULL, NULL, '', NULL, 1, 0, NULL),
(73, 'asdasd', NULL, NULL, '2016-03-25 00:07:41', '2016-03-25 00:07:41', 0, NULL, NULL, 'asdas', NULL, 0, 0, NULL),
(74, 'adsasd', NULL, NULL, '2016-03-25 00:10:13', '2016-03-25 00:10:13', 0, NULL, NULL, '', NULL, 0, 0, NULL),
(75, 'adasd', NULL, NULL, '2016-03-25 00:11:35', '2016-03-25 00:11:35', 0, NULL, NULL, 'asd', NULL, 0, 0, NULL),
(76, 'adasd', NULL, NULL, '2016-03-25 00:13:01', '2016-03-25 00:13:01', 0, NULL, NULL, '', NULL, 0, 0, NULL),
(77, 'asdasd', NULL, NULL, '2016-03-25 00:14:18', '2016-03-25 00:14:18', 0, NULL, NULL, 'asdasd', NULL, 0, 0, NULL),
(78, 'adsasd', NULL, NULL, '2016-03-25 00:16:00', '2016-03-25 00:16:00', 0, NULL, NULL, '', NULL, 0, 0, NULL),
(79, 'asdasd', NULL, NULL, '2016-03-25 00:17:21', '2016-03-25 00:17:21', 0, NULL, NULL, '', NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechas`
--

CREATE TABLE IF NOT EXISTS `fechas` (
  `idfecha` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `idzona` int(11) NOT NULL,
  `numero_fecha` varchar(45) DEFAULT NULL,
  `imagen_equipo_ideal` varchar(200) DEFAULT NULL,
  `imagen_figura_fecha` varchar(200) DEFAULT NULL,
  `imagen_fecha` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `es_play_off` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idfecha`),
  KEY `fk_fecha_torneo1_idx` (`idzona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=189 ;

--
-- Volcado de datos para la tabla `fechas`
--

INSERT INTO `fechas` (`idfecha`, `fecha`, `observaciones`, `idzona`, `numero_fecha`, `imagen_equipo_ideal`, `imagen_figura_fecha`, `imagen_fecha`, `created_at`, `updated_at`, `es_play_off`) VALUES
(128, '2015-03-14', 'Obs', 1, '1', NULL, NULL, NULL, NULL, '2015-05-27 01:29:27', 0),
(147, '2015-03-28', ' ', 1, '2', NULL, NULL, NULL, NULL, NULL, 0),
(149, '2015-04-04', ' ', 1, '3', NULL, NULL, NULL, NULL, NULL, 0),
(150, '2015-04-11', ' ', 1, '4', NULL, NULL, NULL, NULL, NULL, 0),
(151, '2015-04-18', ' ', 1, '5', NULL, NULL, NULL, NULL, NULL, 0),
(152, '2015-04-25', ' ', 1, '6', NULL, NULL, NULL, NULL, NULL, 0),
(153, '2015-05-02', ' ', 1, '7', NULL, NULL, NULL, NULL, NULL, 0),
(154, '2015-05-09', ' ', 1, '8', NULL, NULL, NULL, NULL, NULL, 0),
(155, '2015-05-16', ' ', 1, '9', NULL, NULL, NULL, NULL, NULL, 0),
(156, '2015-05-23', ' ', 1, '10', NULL, NULL, NULL, NULL, NULL, 0),
(157, '2015-05-30', ' ', 1, '11', NULL, NULL, NULL, NULL, NULL, 0),
(158, '2015-06-06', ' ', 1, '12', NULL, NULL, NULL, NULL, NULL, 0),
(159, '2015-06-13', ' ', 1, '13', NULL, NULL, NULL, NULL, NULL, 0),
(160, '2015-06-20', ' ', 1, '14', NULL, NULL, NULL, NULL, NULL, 0),
(161, '2015-06-27', ' ', 1, '15', NULL, NULL, NULL, NULL, NULL, 0),
(166, '2015-06-02', '', 1, 'Cuartos de Final', NULL, NULL, NULL, '2015-04-11 06:18:07', '2015-06-03 02:08:37', 0),
(167, '1970-01-01', '', 1, '10', NULL, NULL, '167.png', '2015-04-11 06:20:59', '2016-03-07 05:09:16', 0),
(168, '1970-01-01', 'asd', 1, 'ssssssss', NULL, NULL, NULL, '2015-04-11 06:21:51', '2015-06-03 02:08:15', 0),
(178, '2015-04-26', '', 2, '1', NULL, NULL, NULL, '2015-04-27 00:03:40', '2015-06-03 02:11:39', 0),
(179, '2015-06-02', '', 2, '2', NULL, NULL, NULL, '2015-06-03 02:11:48', '2015-06-03 02:11:48', 0),
(180, '2015-06-06', '', 2, '3', NULL, NULL, NULL, '2015-06-03 02:11:56', '2015-06-03 02:11:56', 0),
(182, '2016-03-06', '', 1, 'Fecha 34', NULL, NULL, NULL, '2016-03-07 04:51:23', '2016-03-07 04:51:23', 0),
(184, '2016-03-06', '', 4, 'fecha 78', NULL, NULL, NULL, '2016-03-07 05:23:27', '2016-03-07 05:23:27', 0),
(185, '2016-03-08', '', 7, 'Fecha 1', NULL, NULL, NULL, '2016-03-10 01:27:52', '2016-03-10 01:27:52', 0),
(186, '2016-03-09', '', 7, 'Fecha 2', NULL, NULL, NULL, '2016-03-10 01:28:06', '2016-03-10 01:28:06', 0),
(187, '2016-03-09', '', 8, 'Fecha1', NULL, NULL, NULL, '2016-03-10 01:31:42', '2016-03-10 01:31:42', 0),
(188, '2016-05-22', '', 7, 'Fecha 3', NULL, NULL, NULL, '2016-05-20 17:44:13', '2016-05-20 17:44:13', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE IF NOT EXISTS `imagenes` (
  `idimagen` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `imagen` varchar(200) NOT NULL,
  `mostrar` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idtipo_imagen` int(11) NOT NULL,
  PRIMARY KEY (`idimagen`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  KEY `FK_imagenes` (`idtipo_imagen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idimagen`, `titulo`, `imagen`, `mostrar`, `created_at`, `updated_at`, `idtipo_imagen`) VALUES
(8, 'Sider1', 'Slider Home-8.jpg', 1, '2015-05-28 06:33:30', '2016-03-17 23:57:31', 1),
(9, 'Slider2', 'Slider Home-9.jpg', 1, '2015-05-28 06:34:03', '2016-03-17 23:56:29', 1),
(10, 'Slider3', 'Slider Home-10.jpg', 1, '2015-05-28 06:34:21', '2016-03-17 23:56:46', 1),
(17, '1', 'Figuras Fecha-17.jpg', 1, '2015-05-29 01:35:29', '2015-06-03 06:13:22', 2),
(19, '2', 'Figuras Fecha-19.jpg', 1, '2015-05-29 01:35:51', '2015-05-29 01:35:57', 2),
(20, '3', 'Figuras Fecha-20.jpg', 1, '2015-05-29 01:36:05', '2015-05-29 01:36:11', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE IF NOT EXISTS `jugadores` (
  `idjugador` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_jugador` varchar(45) DEFAULT NULL,
  `dni` varchar(45) DEFAULT NULL,
  `pathfoto` varchar(45) DEFAULT NULL,
  `idequipo` int(11) DEFAULT NULL,
  `observaciones` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `grupo_sanguineo` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `obra_social` varchar(255) DEFAULT NULL,
  `certificado` tinyint(4) DEFAULT NULL,
  `delegado` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `apellido_jugador` varchar(255) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  PRIMARY KEY (`idjugador`),
  KEY `FK_jugador` (`idequipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=857 ;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`idjugador`, `nombre_jugador`, `dni`, `pathfoto`, `idequipo`, `observaciones`, `created_at`, `updated_at`, `telefono`, `grupo_sanguineo`, `mail`, `direccion`, `obra_social`, `certificado`, `delegado`, `deleted_at`, `apellido_jugador`, `fecha_nacimiento`) VALUES
(1, 'LUCIANOS', '31787301', NULL, 14, 'Delegado', NULL, '2015-04-11 05:43:16', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(808, 'Mariano', 'DNI:31787300', NULL, 14, 'CACA', '2015-04-11 03:56:02', '2015-04-11 03:56:02', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(809, 'Pedro', 'qdasd', NULL, 14, 'asdasd', '2015-04-11 03:56:30', '2015-04-11 03:56:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(810, 'PEPE', 'a', NULL, 14, '', '2015-04-11 03:56:49', '2015-04-11 04:38:27', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(811, 'pepe', '', NULL, 36, '', '2015-05-04 05:08:56', '2015-05-04 05:08:56', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(812, 'manuel', '', NULL, 36, '', '2015-05-04 05:09:01', '2015-05-04 05:09:01', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(813, 'eee', '', NULL, 51, '', '2015-05-04 06:25:20', '2015-05-04 06:25:20', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(814, 'QQQQ asdads asd ads ', '', NULL, 25, '', '2015-05-04 06:31:05', '2015-06-10 00:42:42', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(815, 'qqqq', '', NULL, 25, '', '2015-05-14 00:55:30', '2015-05-14 00:55:30', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(816, 'ffff', '', NULL, 25, '', '2015-05-14 00:55:35', '2015-05-14 00:55:35', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(817, 'ffff', '', NULL, 54, '', '2015-05-14 00:55:50', '2015-05-14 00:55:50', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(818, 'asdasd', '', NULL, 54, '', '2015-05-14 00:55:54', '2015-05-14 00:55:54', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(819, 'asdasd', 'asd', NULL, 46, '', '2015-05-27 01:33:06', '2015-05-27 01:33:06', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(820, '', '', NULL, NULL, NULL, '2015-06-26 02:12:36', '2015-06-26 02:12:36', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(821, '', '', NULL, NULL, NULL, '2015-06-26 02:14:38', '2015-06-26 02:14:38', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(822, '', '', NULL, NULL, NULL, '2015-06-26 02:15:19', '2015-06-26 02:15:19', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(823, '', '', NULL, NULL, NULL, '2015-06-26 02:16:14', '2015-06-26 02:16:14', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(824, '', '', NULL, NULL, NULL, '2015-06-26 02:17:29', '2015-06-26 02:17:29', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(825, '', '', NULL, NULL, NULL, '2015-06-26 02:17:55', '2015-06-26 02:17:55', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(826, '', '', NULL, NULL, NULL, '2015-06-26 02:20:29', '2015-06-26 02:20:29', '', '', '', '', '', 0, 0, NULL, NULL, NULL),
(827, 'Pablo Patricio Perez', '31787456', NULL, NULL, NULL, '2015-06-26 05:49:58', '2015-06-26 05:49:58', '34168777', 'A+', '', '', '', NULL, 0, NULL, NULL, NULL),
(828, 'Pablo Patricio Perez', '31787456', NULL, 53, NULL, '2015-06-26 05:51:11', '2015-06-26 05:51:11', '34168777', 'A+', '', '', '', NULL, 0, NULL, NULL, NULL),
(829, 'Pepe', '123123', NULL, 27, '', '2016-03-19 18:58:06', '2016-05-12 04:52:56', 'asdasd', 'asdads', '', '', '', 0, 0, NULL, 'Argentos', '2016-05-11'),
(830, '', NULL, NULL, 62, 'delegado', '2016-03-24 23:36:40', '2016-03-24 23:36:40', ' - ', NULL, '', '', NULL, NULL, 1, NULL, NULL, NULL),
(831, 'Luciano Pecovich', NULL, NULL, 63, 'delegado', '2016-03-24 23:44:05', '2016-03-24 23:44:05', 'asd - asd', NULL, 'asdas@as.com', 'asd', NULL, NULL, 1, NULL, NULL, NULL),
(832, 'asd', NULL, NULL, 64, 'delegado', '2016-03-24 23:46:02', '2016-03-24 23:46:02', 'asd - asdasd', NULL, 'asdads@asd.com', 'asdasasd', NULL, NULL, 1, NULL, NULL, NULL),
(833, 'asd', NULL, NULL, 66, 'delegado', '2016-03-24 23:47:37', '2016-03-24 23:47:37', 'asdasd - asd', NULL, 'asdasd@asdasd.comasd', 'asd', NULL, NULL, 1, NULL, NULL, NULL),
(834, 'asdasd', NULL, NULL, 67, 'delegado', '2016-03-24 23:49:56', '2016-03-24 23:49:56', 'asdasd - asdasd', NULL, 'asdadsasd@asdasd.com', 'asads', NULL, NULL, 1, NULL, NULL, NULL),
(835, 'asd', NULL, NULL, 69, 'delegado', '2016-03-24 23:53:24', '2016-03-24 23:53:24', 'asdasd - asdasdads', NULL, 'asdasd@asd.com', 'asasd', NULL, NULL, 1, NULL, NULL, NULL),
(836, 'asd', NULL, NULL, 70, 'delegado', '2016-03-24 23:54:20', '2016-03-24 23:54:20', 'asdasda - asd', NULL, 'asads@asd.com', 'asd', NULL, NULL, 1, NULL, NULL, NULL),
(837, 'asd', NULL, NULL, 71, 'delegado', '2016-03-24 23:55:17', '2016-03-24 23:55:17', 'asdasd - asdads', NULL, 'asdad@asda.com', 'asads', NULL, NULL, 1, NULL, NULL, NULL),
(838, 'asdasd', NULL, NULL, 72, 'delegado', '2016-03-24 23:56:17', '2016-03-24 23:56:17', 'asdasd - asdasd', NULL, 'asdads@asdasd.com', 'asdasd', NULL, NULL, 1, NULL, NULL, NULL),
(839, 'asdasd', NULL, NULL, 73, 'delegado', '2016-03-25 00:07:41', '2016-03-25 00:07:41', 'asdasd - asdasd', NULL, 'asdasdas@asdasd.com', 'asdasd', NULL, NULL, 1, NULL, NULL, NULL),
(840, 'asdasd', NULL, NULL, 74, 'delegado', '2016-03-25 00:10:13', '2016-03-25 00:10:13', 'asdasd - asdasd', NULL, 'asdasd@asdasd.com', 'asdasd', NULL, NULL, 1, NULL, NULL, NULL),
(841, 'asda', NULL, NULL, 75, 'delegado', '2016-03-25 00:11:35', '2016-03-25 00:11:35', 'asd - asd', NULL, 'asd@asd.com', 'asd', NULL, NULL, 1, NULL, NULL, NULL),
(842, 'asdasd', NULL, NULL, 76, 'delegado', '2016-03-25 00:13:01', '2016-03-25 00:13:01', 'asdas - asdads', NULL, 'asdasd@asd.com', 'asdasd', NULL, NULL, 1, NULL, NULL, NULL),
(843, 'asdads', NULL, NULL, 77, 'delegado', '2016-03-25 00:14:18', '2016-03-25 00:14:18', 'asdasd - asdads', NULL, 'asdasd@asd.com', 'asdasd', NULL, NULL, 1, NULL, NULL, NULL),
(844, 'asdasd', NULL, NULL, 78, 'delegado', '2016-03-25 00:16:00', '2016-03-25 00:16:00', 'asdasd - asasd', NULL, 'asdasd@asdasd.com', 'asdasd', NULL, NULL, 1, NULL, NULL, NULL),
(845, 'adsads', NULL, NULL, 79, 'delegado', '2016-03-25 00:17:21', '2016-03-25 00:17:21', 'asdasd - asdads', NULL, 'asdasdads@asdads.com', 'asdasdasd', NULL, NULL, 1, NULL, NULL, NULL),
(846, 'adsasdasdasdasds', '123123', NULL, 61, '', '2016-05-10 05:20:15', '2016-05-10 05:20:15', '123123123', '123123', '', '', '', 0, 0, NULL, 'asdasdasdasda', NULL),
(847, 'qweqwe', '123123123', NULL, 61, '', '2016-05-10 05:20:27', '2016-05-10 05:20:27', 'qweqwe12', 'qwe', '', '', '', 0, 0, NULL, 'qweqweqwe', NULL),
(848, 'qweqweq', 'adasd', NULL, 61, '', '2016-05-10 05:20:40', '2016-05-10 05:20:40', 'asdasd', 'asd', '', '', '', 0, 0, NULL, 'asdadsads', NULL),
(849, 'ndsfsdf', '123123', NULL, 15, '', '2016-05-10 05:21:01', '2016-05-10 05:21:01', 'asd', 'asd', '', '', '', 0, 0, NULL, 'alfonso', NULL),
(850, 'juan ', '123123', NULL, 15, '', '2016-05-10 05:21:12', '2016-05-10 05:21:12', 'asd', 'asd', '', '', '', 0, 0, NULL, 'elena', NULL),
(851, 'aaa', 'asdasd', NULL, 27, '', '2016-05-12 04:25:24', '2016-05-16 21:43:33', 'asdasd', 'asdasd', '', '', '', 0, 0, NULL, 'aaaa', '2016-05-16'),
(852, 'pepe', 'asd', NULL, 27, '', '2016-05-12 04:40:46', '2016-05-12 04:40:57', 'asd', 'asd', '', '', '', 0, 0, NULL, 'calandria', '0000-00-00'),
(853, 'PEPE', '123123', NULL, 53, NULL, '2016-05-19 17:50:21', '2016-05-19 17:50:21', 'tel', 'asdasd', 'asd@asd.com', 'asdasd', 'asd', NULL, 0, NULL, NULL, NULL),
(854, 'pepe', '3155433', NULL, 53, NULL, '2016-05-19 19:16:17', '2016-05-19 19:16:17', '12123', 'asdads', 'asdasd@asd.com', 'asdasd', 'asdasd', NULL, 0, NULL, 'sarasuquen', '0000-00-00'),
(855, 'mariano', '31', NULL, 53, NULL, '2016-05-19 19:19:33', '2016-05-19 19:19:33', '341', 'a', 'a@a.com', 'dire', 'os', NULL, 0, NULL, 'perez', '2016-05-20'),
(856, 'marcelo', '3123', NULL, 53, NULL, '2016-05-20 18:24:01', '2016-05-20 18:24:01', 'asd', 'asd', 'asdasd@asd.com', 'asd', '', NULL, 0, NULL, 'el conocelo', '2016-05-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE IF NOT EXISTS `noticias` (
  `idnoticia` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `fecha` varchar(45) DEFAULT NULL,
  `texto` text,
  `mostrar_en_home` tinyint(4) NOT NULL DEFAULT '1',
  `mostrar_en_seccion` tinyint(4) NOT NULL DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `orden` int(11) NOT NULL DEFAULT '0',
  `icono` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idnoticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idnoticia`, `titulo`, `fecha`, `texto`, `mostrar_en_home`, `mostrar_en_seccion`, `updated_at`, `created_at`, `imagen`, `link`, `orden`, `icono`) VALUES
(1, 'Nueva Noticia', 'asdasd', '', 1, 0, '2016-05-10 06:50:03', '2015-05-07 05:47:09', 'imagen-noticia1.jpg', '', 1, 'horario.png'),
(2, 'Nueva', 'asdasd', 'asdasdasdasdasdasd\r\nasd\r\nas\r\nd\r\nasd\r\naasdaaaaaaaaaaaaaaaaasdasd', 1, 1, '2016-03-17 07:02:27', '2015-06-05 02:17:03', 'imagen-noticia2.jpg', 'ssssssssss', 12, 'jugador.png'),
(3, 'noticia e4aasd', 'asd', 'asdasdasdfasdfasdfasdasdasd', 1, 1, '2016-03-17 07:02:34', '2016-02-20 22:52:07', NULL, 'asd', 11, 'cancha.png'),
(7, 'sdf', 'sdf', 'sdfsd', 1, 0, '2016-05-10 06:50:11', '2016-03-25 01:15:03', NULL, 'sdf', 5, 'cancha.png'),
(10, 'asdads', 'asd', 'asdasd', 1, 1, '2016-03-25 01:15:56', '2016-03-25 01:15:56', NULL, 'asdasd', 8, 'cancha.png'),
(11, 'asd', 'asd', 'asdasd', 1, 1, '2016-03-25 01:16:03', '2016-03-25 01:16:03', NULL, 'asd', 9, 'cancha.png'),
(12, 'asd', 'asd', 'asdads', 1, 1, '2016-03-25 01:16:09', '2016-03-25 01:16:09', NULL, 'asd', 10, 'cancha.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE IF NOT EXISTS `partidos` (
  `idpartido` int(11) NOT NULL AUTO_INCREMENT,
  `idfecha` int(11) NOT NULL,
  `idequipo_local` int(11) NOT NULL,
  `idequipo_visitante` int(11) NOT NULL,
  `goles_local` int(11) DEFAULT NULL,
  `goles_visitante` int(11) DEFAULT NULL,
  `hora` varchar(200) DEFAULT NULL,
  `orden_mostrar` varchar(45) DEFAULT NULL,
  `idarbitro` int(11) NOT NULL,
  `idzona` int(11) NOT NULL,
  `fue_jugado` int(11) DEFAULT '0',
  `puntos_local` int(11) DEFAULT '0',
  `puntos_visitante` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `empatado_local` int(1) DEFAULT '0',
  `ganado_local` int(1) DEFAULT '0',
  `perdido_local` int(1) DEFAULT '0',
  `empatado_visitante` int(1) DEFAULT '0',
  `ganado_visitante` int(1) DEFAULT '0',
  `perdido_visitante` int(1) DEFAULT '0',
  PRIMARY KEY (`idpartido`),
  UNIQUE KEY `NewIndex3` (`idfecha`,`idequipo_local`,`idequipo_visitante`),
  KEY `fk_partido_fecha1_idx` (`idfecha`),
  KEY `fk_partido_equipo1_idx` (`idequipo_local`),
  KEY `fk_partido_equipo2_idx` (`idequipo_visitante`),
  KEY `fk_partido_arbitro1_idx` (`idarbitro`),
  KEY `fk_partido_torneo` (`idzona`),
  KEY `fk_partido_equipo1` (`idequipo_local`,`idzona`),
  KEY `FK_partidos` (`idzona`,`idequipo_visitante`),
  KEY `FK_partidos_visitante` (`idequipo_visitante`,`idzona`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`idpartido`, `idfecha`, `idequipo_local`, `idequipo_visitante`, `goles_local`, `goles_visitante`, `hora`, `orden_mostrar`, `idarbitro`, `idzona`, `fue_jugado`, `puntos_local`, `puntos_visitante`, `created_at`, `updated_at`, `empatado_local`, `ganado_local`, `perdido_local`, `empatado_visitante`, `ganado_visitante`, `perdido_visitante`) VALUES
(7, 128, 27, 46, 0, 0, '14', NULL, 6, 1, 1, 1, 1, '2015-05-01 02:21:24', '2015-05-27 01:36:05', 0, 0, 0, 0, 0, 0),
(8, 166, 25, 54, 2, 1, '', NULL, 6, 1, 1, 3, 0, '2015-05-14 00:42:23', '2015-05-27 00:20:30', 0, 0, 0, 0, 0, 0),
(9, 166, 51, 46, 1, 0, '13:13', NULL, 6, 1, 1, 3, 0, '2015-05-27 01:30:31', '2015-05-27 01:31:58', 0, 0, 0, 0, 0, 0),
(10, 166, 27, 27, NULL, NULL, '', NULL, 6, 1, 0, 0, 0, '2015-06-02 06:11:11', '2015-06-02 06:11:11', 0, 0, 0, 0, 0, 0),
(11, 166, 36, 36, NULL, NULL, '', NULL, 6, 1, 0, 0, 0, '2015-06-02 06:11:17', '2015-06-02 06:11:17', 0, 0, 0, 0, 0, 0),
(12, 168, 27, 27, NULL, NULL, '', NULL, 6, 1, 0, 0, 0, '2015-06-02 06:15:02', '2015-06-02 06:15:02', 0, 0, 0, 0, 0, 0),
(13, 178, 53, 52, 2, 3, '12:15', NULL, 6, 2, 1, 0, 3, '2015-06-03 02:12:12', '2015-06-03 02:13:10', 0, 0, 0, 0, 0, 0),
(14, 178, 15, 25, 1, 2, '14:50', NULL, 6, 2, 1, 0, 3, '2015-06-03 02:12:31', '2015-06-03 02:12:47', 0, 0, 0, 0, 0, 0),
(15, 178, 23, 28, 1, 1, '16', NULL, 6, 2, 1, 1, 1, '2015-06-03 02:12:41', '2015-06-03 02:12:55', 0, 0, 0, 0, 0, 0),
(16, 179, 53, 28, 1, 0, '12', NULL, 6, 2, 1, 3, 0, '2015-06-03 02:14:33', '2015-06-03 02:15:38', 0, 0, 0, 0, 0, 0),
(17, 179, 15, 23, 1, 1, '', NULL, 6, 2, 1, 1, 1, '2015-06-03 02:14:46', '2015-06-03 02:32:13', 1, 0, 0, 1, 0, 0),
(18, 179, 25, 52, 3, 2, '', NULL, 6, 2, 1, 3, 0, '2015-06-03 02:15:04', '2015-06-03 02:15:28', 0, 0, 0, 0, 0, 0),
(19, 167, 25, 51, 0, 0, '', NULL, 6, 1, 1, 1, 1, '2015-06-12 02:45:22', '2015-06-12 02:45:27', 1, 0, 0, 1, 0, 0),
(21, 161, 25, 54, 1, 1, '13', NULL, 6, 1, 1, 1, 1, '2016-03-07 05:53:17', '2016-03-07 05:53:36', 1, 0, 0, 1, 0, 0),
(25, 167, 54, 36, 1, 1, '12:20', NULL, 6, 1, 1, 1, 1, '2016-03-10 01:23:56', '2016-03-10 01:24:06', 1, 0, 0, 1, 0, 0),
(26, 185, 61, 53, 0, 0, '12', NULL, 6, 7, 1, 1, 1, '2016-03-10 01:28:16', '2016-03-10 01:28:56', 1, 0, 0, 1, 0, 0),
(27, 185, 52, 25, 0, 1, '', NULL, 6, 7, 1, 0, 3, '2016-03-10 01:28:30', '2016-03-10 01:28:37', 0, 0, 1, 0, 1, 0),
(28, 187, 54, 58, 2, 0, '', NULL, 6, 8, 1, 3, 0, '2016-03-10 01:34:09', '2016-03-10 01:34:20', 0, 1, 0, 0, 0, 1),
(29, 184, 61, 15, NULL, NULL, '12', NULL, 6, 4, 0, 0, 0, '2016-03-18 06:21:44', '2016-03-18 06:21:44', 0, 0, 0, 0, 0, 0),
(30, 184, 15, 61, 0, 0, '13', NULL, 6, 4, 1, 1, 1, '2016-03-18 06:23:43', '2016-03-18 06:23:50', 1, 0, 0, 1, 0, 0),
(31, 167, 27, 27, NULL, NULL, '12:10', NULL, 6, 1, 0, 0, 0, '2016-05-16 22:23:47', '2016-05-16 22:23:47', 0, 0, 0, 0, 0, 0),
(32, 186, 53, 61, 0, 0, '', NULL, 6, 7, 1, 1, 1, '2016-05-20 17:43:33', '2016-05-20 17:43:50', 1, 0, 0, 1, 0, 0),
(33, 188, 53, 25, NULL, NULL, '', NULL, 6, 7, 0, 0, 0, '2016-05-20 17:44:32', '2016-05-20 17:44:32', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido_has_jugador`
--

CREATE TABLE IF NOT EXISTS `partido_has_jugador` (
  `idpartido` int(11) NOT NULL,
  `idjugador` int(11) NOT NULL,
  `goles_favor` int(11) DEFAULT '0',
  `goles_contra` int(11) DEFAULT '0',
  `cantidad_fechas_sancion` int(11) NOT NULL DEFAULT '0',
  `tarjeta_amarilla` int(11) NOT NULL DEFAULT '0',
  `tarjeta_azul` int(11) NOT NULL DEFAULT '0',
  `tarjeta_roja` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpartido`,`idjugador`),
  KEY `fk_partido_has_jugador_jugador1` (`idjugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `partido_has_jugador`
--

INSERT INTO `partido_has_jugador` (`idpartido`, `idjugador`, `goles_favor`, `goles_contra`, `cantidad_fechas_sancion`, `tarjeta_amarilla`, `tarjeta_azul`, `tarjeta_roja`) VALUES
(8, 814, 1, 0, 0, 0, 0, 0),
(8, 815, 1, 0, 1, 0, 0, 0),
(8, 817, 1, 0, 0, 0, 0, 0),
(9, 813, 1, 0, 0, 0, 0, 0),
(14, 814, 1, 0, 0, 1, 0, 0),
(14, 815, 1, 0, 0, 0, 0, 0),
(14, 816, 0, 0, 0, 1, 0, 0),
(19, 814, 0, 0, 0, 1, 0, 0),
(19, 816, 0, 0, 0, 4, 0, 0),
(21, 814, 1, 0, 0, 0, 0, 0),
(21, 817, 1, 0, 0, 0, 0, 0),
(25, 817, 1, 0, 0, 0, 0, 0),
(25, 818, 0, 1, 0, 0, 0, 0),
(27, 814, 1, 0, 0, 0, 0, 0),
(28, 817, 2, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sanciones`
--

CREATE TABLE IF NOT EXISTS `sanciones` (
  `idsancion` int(11) NOT NULL AUTO_INCREMENT,
  `descSancion` text NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `fecha` varchar(200) NOT NULL,
  `torneo` varchar(200) NOT NULL,
  `mostrado` int(11) NOT NULL,
  PRIMARY KEY (`idsancion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=89 ;

--
-- Volcado de datos para la tabla `sanciones`
--

INSERT INTO `sanciones` (`idsancion`, `descSancion`, `titulo`, `fecha`, `torneo`, `mostrado`) VALUES
(87, '<b>-&nbsp; LLAUD, NICOLÃS (ANCHA BANDA FC):</b> 2 FECHAS (ROJA DIRECTA)<br>Obs: Comportamiento Inapropiado<br><b><br>-SEGURA, GASTÃ“N (LA POCHI FC):</b>&nbsp;3&nbsp;FECHAS<br><div>Obs: Comportamiento Inapropiado</div><div><br><b>- GÃ“MEZ, EMANUEL (HAWAII):</b> 2 FECHAS (ROJA DIRECTA)<br>Obs: Juego Brusco<br></div>', 'Sancionados Fecha 2', '28/03/2015', 'Segunda Division', 1),
(86, '<b>- BELÃ‰N, SEBASTIÃN (SUDACA FC):</b> 4 FECHAS (ROJA DIRECTA)<br><div>Obs: Conducta violenta<br></div>', 'Sancionados Fecha 1', '21/03/2015', 'Segunda Division', 1),
(85, '<div><b>- VILLAFAÃ‘E, JOAQUÃN (EL ALMA FC):</b> 2 FECHAS (ROJA DIRECTA)</div><div>Obs: Conducta Violenta</div><br>', 'Sancionados Fecha 1', '21/03/2014', 'Primera Division', 0),
(88, '- <b>CIARROCHI, GUIDO (BERRACO FC) </b>- 2 FECHAS (ROJA DIRECTA)<br>Obs: Juego Brusco<br><br>- <b>PAPASERGIO, JHONATAN (DEP. FAUSTINO) </b>- EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>GARCÃA, JUAN PABLO (DEP. FAUSTINO) </b>- EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>DE CAPUA, ANDRÃ‰S (DEP. FAUSTINO) </b>-EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>BATILLANA, IGNACIO (DEP. FAUSTINO) </b>- 10 FECHAS<br>Obs: Comportamiento Inapropiado<br><br>- <b>PEPPE, ANDRES (NARICES BLANCAS) </b>-EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>RIMOLO, MAURO (NARICES BLANCAS) </b>- EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>OLLID, LEANDRO DANIEL (NARICES BLANCAS) </b>-EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>TOMÃS, ALEJANDRO (NARICES BLANCAS) </b>- 10 FECHAS<br>Obs: Comportamiento Inapropiado<br>', 'Sancionados Fecha 2', '28/03/2015', 'Primera Division', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_torneos`
--

CREATE TABLE IF NOT EXISTS `tipos_torneos` (
  `idtipo_torneo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_torneo` varchar(45) NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idtipo_torneo`),
  UNIQUE KEY `nombre_tipo_torneo_UNIQUE` (`nombre_tipo_torneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipos_torneos`
--

INSERT INTO `tipos_torneos` (`idtipo_torneo`, `nombre_tipo_torneo`, `fecha_baja`, `updated_at`, `created_at`) VALUES
(1, 'Hombres', NULL, NULL, NULL),
(2, 'Mujeres', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_imagenes`
--

CREATE TABLE IF NOT EXISTS `tipo_imagenes` (
  `idtipo_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipo_imagen`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tipo_imagenes`
--

INSERT INTO `tipo_imagenes` (`idtipo_imagen`, `descripcion`) VALUES
(1, 'Slider Home'),
(2, 'Destacados Fecha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneos`
--

CREATE TABLE IF NOT EXISTS `torneos` (
  `idtorneo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_torneo` varchar(45) DEFAULT NULL,
  `observaciones_torneo` varchar(45) DEFAULT NULL,
  `idtipo_torneo` int(11) NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `tablas_x_torneo` tinyint(1) NOT NULL DEFAULT '0',
  `estadisticas_x_torneo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idtorneo`),
  KEY `idtipo_torneo_fk_idx` (`idtipo_torneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `torneos`
--

INSERT INTO `torneos` (`idtorneo`, `nombre_torneo`, `observaciones_torneo`, `idtipo_torneo`, `fecha_baja`, `updated_at`, `created_at`, `deleted_at`, `imagen`, `tablas_x_torneo`, `estadisticas_x_torneo`) VALUES
(7, 'Primera División', 'obs', 1, NULL, '2016-05-06 01:10:42', NULL, NULL, NULL, 0, 0),
(15, 'Nuevo Torneo', '', 1, NULL, '2015-09-09 01:04:23', '2015-04-27 00:03:13', NULL, NULL, 0, 0),
(16, 'caca', '', 1, NULL, '2015-09-09 02:18:46', '2015-09-09 02:18:46', NULL, NULL, 0, 0),
(17, 'Zarpado', '', 1, NULL, '2016-03-07 02:29:58', '2016-03-07 02:29:58', NULL, NULL, 1, 0),
(18, 'Torneo de Prueba', 'Zarpado torneo', 1, NULL, '2016-03-10 01:31:01', '2016-03-10 01:26:26', NULL, 'imagen-torneo18.png', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo_equipo`
--

CREATE TABLE IF NOT EXISTS `torneo_equipo` (
  `equipo_idequipo` int(11) NOT NULL,
  `zona_idzona` int(11) NOT NULL,
  PRIMARY KEY (`equipo_idequipo`,`zona_idzona`),
  KEY `fk_torneo_has_equipo_equipo1_idx` (`equipo_idequipo`),
  KEY `FK_torneo_equipo` (`zona_idzona`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `torneo_equipo`
--

INSERT INTO `torneo_equipo` (`equipo_idequipo`, `zona_idzona`) VALUES
(15, 2),
(15, 4),
(23, 2),
(25, 1),
(25, 2),
(25, 7),
(27, 1),
(28, 2),
(36, 1),
(46, 1),
(47, 1),
(48, 2),
(51, 1),
(52, 2),
(52, 7),
(53, 2),
(53, 7),
(54, 1),
(54, 8),
(58, 1),
(58, 8),
(61, 4),
(61, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `created_at`, `updated_at`, `remember_token`) VALUES
(1, 'admin', '$2y$10$pJK.iwoiyVqFVVHa/hDXYeeNyFuANdXfAXR1PFlyeC7ogjtB1U4ya', NULL, NULL, '2016-03-18 06:44:16', 'ypZa6NOObXh7l2hqmyOHntChyp68FV6kQfdkOxZQK1OReMQrWMJvrWbAUi2q');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre_usuario`, `password`, `updated_at`, `created_at`) VALUES
(2, 'liga', 'ribera2013', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonas`
--

CREATE TABLE IF NOT EXISTS `zonas` (
  `idzona` int(11) NOT NULL AUTO_INCREMENT,
  `idtorneo` int(11) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  `orden` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idzona`),
  KEY `FK_zonas` (`idtorneo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `zonas`
--

INSERT INTO `zonas` (`idzona`, `idtorneo`, `nombre`, `deleted_at`, `created_at`, `updated_at`, `orden`) VALUES
(1, 7, 'Zona A', NULL, '2015-04-27 00:13:58', '2016-05-10 06:53:35', 0),
(2, 15, 'Zona A', NULL, '2015-04-21 00:12:00', '2015-04-21 00:12:00', 0),
(3, 16, 'Zona A', NULL, '2015-04-21 00:12:00', '2015-04-21 00:12:00', 0),
(4, 7, 'Zona b', NULL, '2015-04-21 00:12:00', '2016-05-10 06:53:42', 1),
(5, 7, 'Zona C', NULL, '2016-03-07 06:03:14', '2016-03-07 06:03:14', 3),
(6, 7, 'Zona D', NULL, '2016-03-07 06:03:45', '2016-03-07 06:03:45', 4),
(7, 18, 'Zona A', NULL, '2016-03-10 01:26:41', '2016-03-10 01:26:41', 0),
(8, 18, 'Zona B', NULL, '2016-03-10 01:27:04', '2016-03-10 01:27:04', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fechas`
--
ALTER TABLE `fechas`
  ADD CONSTRAINT `FK_fechas` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE;

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_imagenes` FOREIGN KEY (`idtipo_imagen`) REFERENCES `tipo_imagenes` (`idtipo_imagen`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `FK_jugador` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`idequipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partidos`
--
ALTER TABLE `partidos`
  ADD CONSTRAINT `FK_partidos` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_partidos_arbitros` FOREIGN KEY (`idarbitro`) REFERENCES `arbitros` (`idarbitro`),
  ADD CONSTRAINT `FK_partidos_local` FOREIGN KEY (`idequipo_local`, `idzona`) REFERENCES `torneo_equipo` (`equipo_idequipo`, `zona_idzona`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_partidos_visitante` FOREIGN KEY (`idequipo_visitante`, `idzona`) REFERENCES `torneo_equipo` (`equipo_idequipo`, `zona_idzona`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_partido_fecha1` FOREIGN KEY (`idfecha`) REFERENCES `fechas` (`idfecha`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `partido_has_jugador`
--
ALTER TABLE `partido_has_jugador`
  ADD CONSTRAINT `FK_partido_has_jugador` FOREIGN KEY (`idpartido`) REFERENCES `partidos` (`idpartido`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_partido_has_jugador_partido1` FOREIGN KEY (`idjugador`) REFERENCES `jugadores` (`idjugador`);

--
-- Filtros para la tabla `torneos`
--
ALTER TABLE `torneos`
  ADD CONSTRAINT `idtipo_torneo_fk` FOREIGN KEY (`idtipo_torneo`) REFERENCES `tipos_torneos` (`idtipo_torneo`) ON UPDATE NO ACTION;

--
-- Filtros para la tabla `torneo_equipo`
--
ALTER TABLE `torneo_equipo`
  ADD CONSTRAINT `FK_torneo_equipo` FOREIGN KEY (`zona_idzona`) REFERENCES `zonas` (`idzona`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_torneo_has_equipo_equipo1` FOREIGN KEY (`equipo_idequipo`) REFERENCES `equipos` (`idequipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `zonas`
--
ALTER TABLE `zonas`
  ADD CONSTRAINT `FK_zonas` FOREIGN KEY (`idtorneo`) REFERENCES `torneos` (`idtorneo`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
