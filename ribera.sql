/*
SQLyog Ultimate v8.61 
MySQL - 5.6.17-log : Database - ribera
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `arbitros` */

DROP TABLE IF EXISTS `arbitros`;

CREATE TABLE `arbitros` (
  `idarbitro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `fecha_baja` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idarbitro`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `arbitros` */

insert  into `arbitros`(`idarbitro`,`nombre`,`fecha_baja`,`updated_at`,`created_at`) values (6,'Arbitro',NULL,'2015-04-09 21:59:54','2015-04-09 21:59:54');

/*Table structure for table `equipos` */

DROP TABLE IF EXISTS `equipos`;

CREATE TABLE `equipos` (
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
  PRIMARY KEY (`idequipo`),
  UNIQUE KEY `NewIndex1` (`nombre_usuario`),
  UNIQUE KEY `NewIndex2` (`nombre_equipo`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `equipos` */

insert  into `equipos`(`idequipo`,`nombre_equipo`,`escudo`,`foto`,`updated_at`,`created_at`,`es_libre`,`nombre_usuario`,`clave`,`observaciones`,`mensaje`,`aprobado`,`autogestion`) values (14,'NARICES BLANCAS F.C','naricesblancas.jpg','NARICES BLANCAS FC.jpg','2015-04-11 02:40:57',NULL,0,NULL,NULL,NULL,NULL,1,0),(15,'ASTON BIRRA F.C','juventudunida.jpg','JUVENTUD UNIDA.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(16,'LOS GUSANOS F.C','losgusanosfc.jpg','LOS GUSANOS FC.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(17,'HAWAII','otroequipo.jpg','OTRO EQUIPO.jpg','2015-04-10 22:22:37',NULL,0,NULL,NULL,NULL,NULL,1,0),(21,'SUDACA F.C','tirutiru.jpg','TIRU TIRU.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(22,'ESQUINE F.C','esquinefc.jpg','ESQUINE FC.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(23,'BERRACO F.C','lajauria.jpg','LA JAURIA.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(25,'BARRIO PARQUE','velezgarfield.jpg','VELEZ GARFIELD.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(27,'(LIBRE)','escudo-equipo27.PNG','foto-equipo27.PNG','2015-06-23 23:32:32',NULL,1,NULL,NULL,'Equipo Libre q no suma puntos ni resta','Sin Mensaje Pendiente',1,0),(28,'DEP. CRUCE ALBERDI','crucealberdi.jpg','DEP. CRUCE ALBERDI.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(29,'TINTURAZO','tinturazo.jpg','TINTURAZO.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(30,'MEMISTONE','vilazar.jpg','VILAZAR.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(32,'DOCK SUD','docksud.jpg','DOCK SUD.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(33,'SUC TEAM F.C','sucteamfc.jpg','SUC TEAM FC.jpg',NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(36,'EL SOGAN',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(38,'GALATASARAY',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(41,'SANJO',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(43,'SIN FIERRO F.C',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(46,'FILIPO Y SUS PICHONES',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(47,'DRINK TEAM',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(48,'MARCELONA',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(49,'SPARTA F.C',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(50,'THE REAL TEAM F.C',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(51,'EL ALMA F.C',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(52,'ARIZONA',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(53,'ANCHA BANDA F.C',NULL,NULL,'2015-06-25 23:04:46',NULL,0,'ancha','$2y$10$MMdQz6Qtfno6qErhRap1Kuemu62Qm8C1lpUDSnOeWN2ztaXkPAzR6','','',1,1),(54,'DEP. FAUSTINO',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(56,'LA POCHI',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(57,'REAL BAÑIL',NULL,NULL,'2015-05-13 22:24:27',NULL,0,NULL,NULL,NULL,NULL,1,0),(58,'LOS ZARATE F.C',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(59,'TORO F.C',NULL,NULL,'2015-05-13 22:19:39',NULL,0,NULL,NULL,NULL,NULL,1,0),(60,'POPOVACH',NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,1,0),(61,'aaaaaa',NULL,NULL,'2015-09-08 23:19:16','2015-09-08 23:19:16',0,NULL,NULL,'','',1,0);

/*Table structure for table `fechas` */

DROP TABLE IF EXISTS `fechas`;

CREATE TABLE `fechas` (
  `idfecha` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `observaciones` varchar(45) DEFAULT NULL,
  `idtorneo` int(11) NOT NULL,
  `numero_fecha` varchar(45) DEFAULT NULL,
  `imagen_equipo_ideal` varchar(200) DEFAULT NULL,
  `imagen_figura_fecha` varchar(200) DEFAULT NULL,
  `imagen_fecha` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `es_play_off` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idfecha`),
  KEY `fk_fecha_torneo1_idx` (`idtorneo`),
  CONSTRAINT `fk_fecha_torneo1` FOREIGN KEY (`idtorneo`) REFERENCES `torneos` (`idtorneo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

/*Data for the table `fechas` */

insert  into `fechas`(`idfecha`,`fecha`,`observaciones`,`idtorneo`,`numero_fecha`,`imagen_equipo_ideal`,`imagen_figura_fecha`,`imagen_fecha`,`created_at`,`updated_at`,`es_play_off`) values (128,'2015-03-14','Obs',7,'1',NULL,NULL,NULL,NULL,'2015-05-26 22:29:27',0),(147,'2015-03-28',' ',7,'2',NULL,NULL,NULL,NULL,NULL,0),(149,'2015-04-04',' ',7,'3',NULL,NULL,NULL,NULL,NULL,0),(150,'2015-04-11',' ',7,'4',NULL,NULL,NULL,NULL,NULL,0),(151,'2015-04-18',' ',7,'5',NULL,NULL,NULL,NULL,NULL,0),(152,'2015-04-25',' ',7,'6',NULL,NULL,NULL,NULL,NULL,0),(153,'2015-05-02',' ',7,'7',NULL,NULL,NULL,NULL,NULL,0),(154,'2015-05-09',' ',7,'8',NULL,NULL,NULL,NULL,NULL,0),(155,'2015-05-16',' ',7,'9',NULL,NULL,NULL,NULL,NULL,0),(156,'2015-05-23',' ',7,'10',NULL,NULL,NULL,NULL,NULL,0),(157,'2015-05-30',' ',7,'11',NULL,NULL,NULL,NULL,NULL,0),(158,'2015-06-06',' ',7,'12',NULL,NULL,NULL,NULL,NULL,0),(159,'2015-06-13',' ',7,'13',NULL,NULL,NULL,NULL,NULL,0),(160,'2015-06-20',' ',7,'14',NULL,NULL,NULL,NULL,NULL,0),(161,'2015-06-27',' ',7,'15',NULL,NULL,NULL,NULL,NULL,0),(166,'2015-06-02','',7,'Cuartos de Final',NULL,NULL,NULL,'2015-04-11 03:18:07','2015-06-02 23:08:37',0),(167,'1970-01-01','',7,'12',NULL,NULL,NULL,'2015-04-11 03:20:59','2015-06-02 23:08:10',0),(168,'1970-01-01','asd',7,'ssssssss',NULL,NULL,NULL,'2015-04-11 03:21:51','2015-06-02 23:08:15',0),(178,'2015-04-26','',15,'1',NULL,NULL,NULL,'2015-04-26 21:03:40','2015-06-02 23:11:39',0),(179,'2015-06-02','',15,'2',NULL,NULL,NULL,'2015-06-02 23:11:48','2015-06-02 23:11:48',0),(180,'2015-06-06','',15,'3',NULL,NULL,NULL,'2015-06-02 23:11:56','2015-06-02 23:11:56',0);

/*Table structure for table `imagenes` */

DROP TABLE IF EXISTS `imagenes`;

CREATE TABLE `imagenes` (
  `idimagen` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(45) DEFAULT NULL,
  `imagen` varchar(200) NOT NULL,
  `mostrar` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idtipo_imagen` int(11) NOT NULL,
  PRIMARY KEY (`idimagen`),
  UNIQUE KEY `titulo_UNIQUE` (`titulo`),
  KEY `FK_imagenes` (`idtipo_imagen`),
  CONSTRAINT `FK_imagenes` FOREIGN KEY (`idtipo_imagen`) REFERENCES `tipo_imagenes` (`idtipo_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `imagenes` */

insert  into `imagenes`(`idimagen`,`titulo`,`imagen`,`mostrar`,`created_at`,`updated_at`,`idtipo_imagen`) values (8,'Sider1','Slider Home-8.jpg',0,'2015-05-28 03:33:30','2015-05-28 21:44:03',1),(9,'Slider2','Slider Home-9.jpg',1,'2015-05-28 03:34:03','2015-05-28 03:34:09',1),(10,'Slider3','Slider Home-10.jpg',1,'2015-05-28 03:34:21','2015-05-28 03:35:14',1),(13,'Equipo Ideal','Equipo Ideal-13.PNG',1,'2015-05-28 21:11:09','2015-05-28 21:20:26',3),(17,'1','Figuras Fecha-17.jpg',1,'2015-05-28 22:35:29','2015-06-03 03:13:22',2),(19,'2','Figuras Fecha-19.jpg',1,'2015-05-28 22:35:51','2015-05-28 22:35:57',2),(20,'3','Figuras Fecha-20.jpg',1,'2015-05-28 22:36:05','2015-05-28 22:36:11',2);

/*Table structure for table `jugadores` */

DROP TABLE IF EXISTS `jugadores`;

CREATE TABLE `jugadores` (
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
  PRIMARY KEY (`idjugador`),
  KEY `FK_jugador` (`idequipo`),
  CONSTRAINT `FK_jugador` FOREIGN KEY (`idequipo`) REFERENCES `equipos` (`idequipo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=829 DEFAULT CHARSET=utf8;

/*Data for the table `jugadores` */

insert  into `jugadores`(`idjugador`,`nombre_jugador`,`dni`,`pathfoto`,`idequipo`,`observaciones`,`created_at`,`updated_at`,`telefono`,`grupo_sanguineo`,`mail`,`direccion`,`obra_social`,`certificado`,`delegado`,`deleted_at`) values (1,'LUCIANOS','31787301',NULL,14,'Delegado',NULL,'2015-04-11 02:43:16',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(808,'Mariano','DNI:31787300',NULL,14,'CACA','2015-04-11 00:56:02','2015-04-11 00:56:02',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(809,'Pedro','qdasd',NULL,14,'asdasd','2015-04-11 00:56:30','2015-04-11 00:56:30',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(810,'PEPE','a',NULL,14,'','2015-04-11 00:56:49','2015-04-11 01:38:27',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(811,'pepe','',NULL,36,'','2015-05-04 02:08:56','2015-05-04 02:08:56',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(812,'manuel','',NULL,36,'','2015-05-04 02:09:01','2015-05-04 02:09:01',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(813,'eee','',NULL,51,'','2015-05-04 03:25:20','2015-05-04 03:25:20',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(814,'QQQQ asdads asd ads ','',NULL,25,'','2015-05-04 03:31:05','2015-06-09 21:42:42',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(815,'qqqq','',NULL,25,'','2015-05-13 21:55:30','2015-05-13 21:55:30',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(816,'ffff','',NULL,25,'','2015-05-13 21:55:35','2015-05-13 21:55:35',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(817,'ffff','',NULL,54,'','2015-05-13 21:55:50','2015-05-13 21:55:50',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(818,'asdasd','',NULL,54,'','2015-05-13 21:55:54','2015-05-13 21:55:54',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(819,'asdasd','asd',NULL,46,'','2015-05-26 22:33:06','2015-05-26 22:33:06',NULL,NULL,NULL,NULL,NULL,NULL,0,NULL),(820,'','',NULL,NULL,NULL,'2015-06-25 23:12:36','2015-06-25 23:12:36','','','','','',0,0,NULL),(821,'','',NULL,NULL,NULL,'2015-06-25 23:14:38','2015-06-25 23:14:38','','','','','',0,0,NULL),(822,'','',NULL,NULL,NULL,'2015-06-25 23:15:19','2015-06-25 23:15:19','','','','','',0,0,NULL),(823,'','',NULL,NULL,NULL,'2015-06-25 23:16:14','2015-06-25 23:16:14','','','','','',0,0,NULL),(824,'','',NULL,NULL,NULL,'2015-06-25 23:17:29','2015-06-25 23:17:29','','','','','',0,0,NULL),(825,'','',NULL,NULL,NULL,'2015-06-25 23:17:55','2015-06-25 23:17:55','','','','','',0,0,NULL),(826,'','',NULL,NULL,NULL,'2015-06-25 23:20:29','2015-06-25 23:20:29','','','','','',0,0,NULL),(827,'Pablo Patricio Perez','31787456',NULL,NULL,NULL,'2015-06-26 02:49:58','2015-06-26 02:49:58','34168777','A+','','','',NULL,0,NULL),(828,'Pablo Patricio Perez','31787456',NULL,53,NULL,'2015-06-26 02:51:11','2015-06-26 02:51:11','34168777','A+','','','',NULL,0,NULL);

/*Table structure for table `noticias` */

DROP TABLE IF EXISTS `noticias`;

CREATE TABLE `noticias` (
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
  PRIMARY KEY (`idnoticia`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `noticias` */

insert  into `noticias`(`idnoticia`,`titulo`,`fecha`,`texto`,`mostrar_en_home`,`mostrar_en_seccion`,`updated_at`,`created_at`,`imagen`,`link`) values (1,'Nueva Noticia',NULL,NULL,1,1,'2015-06-05 00:00:02','2015-05-07 02:47:09','imagen-noticia1.jpg',NULL),(2,'Nueva','','asdasdasdasd',1,1,'2015-06-05 00:00:19','2015-06-04 23:17:03','imagen-noticia2.jpg','ssssssssss');

/*Table structure for table `partido_has_jugador` */

DROP TABLE IF EXISTS `partido_has_jugador`;

CREATE TABLE `partido_has_jugador` (
  `idpartido` int(11) NOT NULL,
  `idjugador` int(11) NOT NULL,
  `goles_favor` int(11) DEFAULT '0',
  `goles_contra` int(11) DEFAULT '0',
  `cantidad_fechas_sancion` int(11) NOT NULL DEFAULT '0',
  `tarjeta_amarilla` int(11) NOT NULL DEFAULT '0',
  `tarjeta_azul` int(11) NOT NULL DEFAULT '0',
  `tarjeta_roja` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpartido`,`idjugador`),
  KEY `fk_partido_has_jugador_jugador1` (`idjugador`),
  CONSTRAINT `FK_partido_has_jugador` FOREIGN KEY (`idpartido`) REFERENCES `partidos` (`idpartido`) ON DELETE CASCADE,
  CONSTRAINT `fk_partido_has_jugador_partido1` FOREIGN KEY (`idjugador`) REFERENCES `jugadores` (`idjugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `partido_has_jugador` */

insert  into `partido_has_jugador`(`idpartido`,`idjugador`,`goles_favor`,`goles_contra`,`cantidad_fechas_sancion`,`tarjeta_amarilla`,`tarjeta_azul`,`tarjeta_roja`) values (8,814,1,0,0,0,0,0),(8,815,1,0,1,0,0,0),(8,817,1,0,0,0,0,0),(9,813,1,0,0,0,0,0),(14,814,1,0,0,1,0,0),(14,815,1,0,0,0,0,0),(14,816,0,0,0,1,0,0),(19,814,0,0,0,1,0,0),(19,816,0,0,0,4,0,0);

/*Table structure for table `partidos` */

DROP TABLE IF EXISTS `partidos`;

CREATE TABLE `partidos` (
  `idpartido` int(11) NOT NULL AUTO_INCREMENT,
  `idfecha` int(11) NOT NULL,
  `idequipo_local` int(11) NOT NULL,
  `idequipo_visitante` int(11) NOT NULL,
  `goles_local` int(11) DEFAULT NULL,
  `goles_visitante` int(11) DEFAULT NULL,
  `hora` varchar(200) DEFAULT NULL,
  `orden_mostrar` varchar(45) DEFAULT NULL,
  `idarbitro` int(11) NOT NULL,
  `idtorneo` int(11) NOT NULL,
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
  UNIQUE KEY `NewIndex1` (`idfecha`,`idequipo_local`),
  UNIQUE KEY `NewIndex2` (`idfecha`,`idequipo_visitante`),
  UNIQUE KEY `NewIndex3` (`idfecha`,`idequipo_local`,`idequipo_visitante`),
  KEY `fk_partido_fecha1_idx` (`idfecha`),
  KEY `fk_partido_equipo1_idx` (`idequipo_local`),
  KEY `fk_partido_equipo2_idx` (`idequipo_visitante`),
  KEY `fk_partido_arbitro1_idx` (`idarbitro`),
  KEY `fk_partido_torneo` (`idtorneo`),
  KEY `fk_partido_equipo1` (`idequipo_local`,`idtorneo`),
  KEY `FK_partidos` (`idtorneo`,`idequipo_visitante`),
  CONSTRAINT `FK_partidos` FOREIGN KEY (`idtorneo`, `idequipo_visitante`) REFERENCES `torneo_equipo` (`torneo_idtorneo`, `equipo_idequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_partidos_arbitros` FOREIGN KEY (`idarbitro`) REFERENCES `arbitros` (`idarbitro`),
  CONSTRAINT `FK_partidos_torneo` FOREIGN KEY (`idtorneo`) REFERENCES `torneos` (`idtorneo`) ON DELETE CASCADE,
  CONSTRAINT `fk_partido_equipo1` FOREIGN KEY (`idequipo_local`, `idtorneo`) REFERENCES `torneo_equipo` (`equipo_idequipo`, `torneo_idtorneo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_partido_fecha1` FOREIGN KEY (`idfecha`) REFERENCES `fechas` (`idfecha`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `partidos` */

insert  into `partidos`(`idpartido`,`idfecha`,`idequipo_local`,`idequipo_visitante`,`goles_local`,`goles_visitante`,`hora`,`orden_mostrar`,`idarbitro`,`idtorneo`,`fue_jugado`,`puntos_local`,`puntos_visitante`,`created_at`,`updated_at`,`empatado_local`,`ganado_local`,`perdido_local`,`empatado_visitante`,`ganado_visitante`,`perdido_visitante`) values (7,128,27,46,0,0,'14',NULL,6,7,1,1,1,'2015-04-30 23:21:24','2015-05-26 22:36:05',0,0,0,0,0,0),(8,166,25,54,2,1,'',NULL,6,7,1,3,0,'2015-05-13 21:42:23','2015-05-26 21:20:30',0,0,0,0,0,0),(9,166,51,46,1,0,'13:13',NULL,6,7,1,3,0,'2015-05-26 22:30:31','2015-05-26 22:31:58',0,0,0,0,0,0),(10,166,27,27,NULL,NULL,'',NULL,6,7,0,0,0,'2015-06-02 03:11:11','2015-06-02 03:11:11',0,0,0,0,0,0),(11,166,36,36,NULL,NULL,'',NULL,6,7,0,0,0,'2015-06-02 03:11:17','2015-06-02 03:11:17',0,0,0,0,0,0),(12,168,27,27,NULL,NULL,'',NULL,6,7,0,0,0,'2015-06-02 03:15:02','2015-06-02 03:15:02',0,0,0,0,0,0),(13,178,53,52,2,3,'12:15',NULL,6,15,1,0,3,'2015-06-02 23:12:12','2015-06-02 23:13:10',0,0,0,0,0,0),(14,178,15,25,1,2,'14:50',NULL,6,15,1,0,3,'2015-06-02 23:12:31','2015-06-02 23:12:47',0,0,0,0,0,0),(15,178,23,28,1,1,'16',NULL,6,15,1,1,1,'2015-06-02 23:12:41','2015-06-02 23:12:55',0,0,0,0,0,0),(16,179,53,28,1,0,'12',NULL,6,15,1,3,0,'2015-06-02 23:14:33','2015-06-02 23:15:38',0,0,0,0,0,0),(17,179,15,23,1,1,'',NULL,6,15,1,1,1,'2015-06-02 23:14:46','2015-06-02 23:32:13',1,0,0,1,0,0),(18,179,25,52,3,2,'',NULL,6,15,1,3,0,'2015-06-02 23:15:04','2015-06-02 23:15:28',0,0,0,0,0,0),(19,167,25,51,0,0,'',NULL,6,7,1,1,1,'2015-06-11 23:45:22','2015-06-11 23:45:27',1,0,0,1,0,0);

/*Table structure for table `sanciones` */

DROP TABLE IF EXISTS `sanciones`;

CREATE TABLE `sanciones` (
  `idsancion` int(11) NOT NULL AUTO_INCREMENT,
  `descSancion` text NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `fecha` varchar(200) NOT NULL,
  `torneo` varchar(200) NOT NULL,
  `mostrado` int(11) NOT NULL,
  PRIMARY KEY (`idsancion`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

/*Data for the table `sanciones` */

insert  into `sanciones`(`idsancion`,`descSancion`,`titulo`,`fecha`,`torneo`,`mostrado`) values (87,'<b>-&nbsp; LLAUD, NICOLÃS (ANCHA BANDA FC):</b> 2 FECHAS (ROJA DIRECTA)<br>Obs: Comportamiento Inapropiado<br><b><br>-SEGURA, GASTÃ“N (LA POCHI FC):</b>&nbsp;3&nbsp;FECHAS<br><div>Obs: Comportamiento Inapropiado</div><div><br><b>- GÃ“MEZ, EMANUEL (HAWAII):</b> 2 FECHAS (ROJA DIRECTA)<br>Obs: Juego Brusco<br></div>','Sancionados Fecha 2','28/03/2015','Segunda Division',1),(86,'<b>- BELÃ‰N, SEBASTIÃN (SUDACA FC):</b> 4 FECHAS (ROJA DIRECTA)<br><div>Obs: Conducta violenta<br></div>','Sancionados Fecha 1','21/03/2015','Segunda Division',1),(85,'<div><b>- VILLAFAÃ‘E, JOAQUÃN (EL ALMA FC):</b> 2 FECHAS (ROJA DIRECTA)</div><div>Obs: Conducta Violenta</div><br>','Sancionados Fecha 1','21/03/2014','Primera Division',0),(88,'- <b>CIARROCHI, GUIDO (BERRACO FC) </b>- 2 FECHAS (ROJA DIRECTA)<br>Obs: Juego Brusco<br><br>- <b>PAPASERGIO, JHONATAN (DEP. FAUSTINO) </b>- EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>GARCÃA, JUAN PABLO (DEP. FAUSTINO) </b>- EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>DE CAPUA, ANDRÃ‰S (DEP. FAUSTINO) </b>-EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>BATILLANA, IGNACIO (DEP. FAUSTINO) </b>- 10 FECHAS<br>Obs: Comportamiento Inapropiado<br><br>- <b>PEPPE, ANDRES (NARICES BLANCAS) </b>-EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>RIMOLO, MAURO (NARICES BLANCAS) </b>- EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>OLLID, LEANDRO DANIEL (NARICES BLANCAS) </b>-EXPULSADO DEL TORNEO SIN POSIBILIDAD DE REINSCRIPCIÃ“N NI ACCESO AL PREDIO<br>Obs: Conducta Violenta<br><br>- <b>TOMÃS, ALEJANDRO (NARICES BLANCAS) </b>- 10 FECHAS<br>Obs: Comportamiento Inapropiado<br>','Sancionados Fecha 2','28/03/2015','Primera Division',1);

/*Table structure for table `tipo_imagenes` */

DROP TABLE IF EXISTS `tipo_imagenes`;

CREATE TABLE `tipo_imagenes` (
  `idtipo_imagen` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) NOT NULL,
  PRIMARY KEY (`idtipo_imagen`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_imagenes` */

insert  into `tipo_imagenes`(`idtipo_imagen`,`descripcion`) values (1,'Slider Home'),(2,'Figuras Fecha'),(3,'Equipo Ideal');

/*Table structure for table `tipos_torneos` */

DROP TABLE IF EXISTS `tipos_torneos`;

CREATE TABLE `tipos_torneos` (
  `idtipo_torneo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_tipo_torneo` varchar(45) NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idtipo_torneo`),
  UNIQUE KEY `nombre_tipo_torneo_UNIQUE` (`nombre_tipo_torneo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tipos_torneos` */

insert  into `tipos_torneos`(`idtipo_torneo`,`nombre_tipo_torneo`,`fecha_baja`,`updated_at`,`created_at`) values (1,'Hombres',NULL,NULL,NULL),(2,'Mujeres',NULL,NULL,NULL);

/*Table structure for table `torneo_equipo` */

DROP TABLE IF EXISTS `torneo_equipo`;

CREATE TABLE `torneo_equipo` (
  `torneo_idtorneo` int(11) NOT NULL,
  `equipo_idequipo` int(11) NOT NULL,
  PRIMARY KEY (`torneo_idtorneo`,`equipo_idequipo`),
  KEY `fk_torneo_has_equipo_equipo1_idx` (`equipo_idequipo`),
  KEY `fk_torneo_has_equipo_torneo1_idx` (`torneo_idtorneo`),
  CONSTRAINT `fk_torneo_has_equipo_equipo1` FOREIGN KEY (`equipo_idequipo`) REFERENCES `equipos` (`idequipo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_torneo_has_equipo_torneo1` FOREIGN KEY (`torneo_idtorneo`) REFERENCES `torneos` (`idtorneo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `torneo_equipo` */

insert  into `torneo_equipo`(`torneo_idtorneo`,`equipo_idequipo`) values (15,15),(15,23),(7,25),(15,25),(7,27),(15,28),(7,36),(7,46),(15,48),(7,51),(15,52),(15,53),(7,54),(7,58);

/*Table structure for table `torneos` */

DROP TABLE IF EXISTS `torneos`;

CREATE TABLE `torneos` (
  `idtorneo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_torneo` varchar(45) DEFAULT NULL,
  `observaciones_torneo` varchar(45) DEFAULT NULL,
  `idtipo_torneo` int(11) NOT NULL,
  `fecha_baja` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` date DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtorneo`),
  KEY `idtipo_torneo_fk_idx` (`idtipo_torneo`),
  CONSTRAINT `idtipo_torneo_fk` FOREIGN KEY (`idtipo_torneo`) REFERENCES `tipos_torneos` (`idtipo_torneo`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `torneos` */

insert  into `torneos`(`idtorneo`,`nombre_torneo`,`observaciones_torneo`,`idtipo_torneo`,`fecha_baja`,`updated_at`,`created_at`,`deleted_at`,`imagen`) values (7,'Primera División','obs',1,NULL,'2015-04-26 21:13:58',NULL,NULL,NULL),(15,'Nuevo Torneo','',1,NULL,'2015-09-08 22:04:23','2015-04-26 21:03:13',NULL,NULL),(16,'caca','',1,NULL,'2015-09-08 23:18:46','2015-09-08 23:18:46',NULL,NULL);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`password`,`email`,`created_at`,`updated_at`,`remember_token`) values (1,'admin','$2y$10$pJK.iwoiyVqFVVHa/hDXYeeNyFuANdXfAXR1PFlyeC7ogjtB1U4ya',NULL,NULL,'2015-05-07 02:45:34',NULL);

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`nombre_usuario`,`password`,`updated_at`,`created_at`) values (2,'liga','ribera2013',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
