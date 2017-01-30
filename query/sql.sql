-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.7.14


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sis_crm
--

CREATE DATABASE IF NOT EXISTS sis_crm;
USE sis_crm;

--
-- Definition of table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE `carrera` (
  `codigo` int(3) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrera`
--

/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
INSERT INTO `carrera` (`codigo`,`Nombre`) VALUES 
 (1,'Administración'),
 (2,'Negocios Internacionales'),
 (3,'Administración Turismo Y Hotelería'),
 (4,'Alimentación  Y Bebcodigoa'),
 (5,'Arquitectura Y Construcción'),
 (6,'Arquitectura Interiores'),
 (7,'Artes Del Espectáculo'),
 (8,'Artes Grafícas Y Audiovisuales'),
 (9,'Artesanías'),
 (10,'Asistente De Gerencia / Secretariado'),
 (11,'Aviación Comercial'),
 (12,'Bar'),
 (13,'Bellas Artes'),
 (14,'Bibliotecología'),
 (15,'Bienes Raices'),
 (16,'Cajero / Promotor De Servicios'),
 (17,'Chef'),
 (18,'Ciencias'),
 (19,'Ciencias De La Comunicación'),
 (20,'Ciencias Físicas'),
 (21,'Ciencias Politicas'),
 (22,'Ciencias Sociales Y Del Comportamiento'),
 (23,'Comercio Exterior'),
 (24,'Computación E Informática'),
 (25,'Comunicación Audiovisual'),
 (26,'Comunicación Social'),
 (27,'Contabilcodigoad'),
 (28,'Cuero Y Calzado'),
 (29,'Deporte Y Recreación'),
 (30,'Derecho'),
 (31,'Dibujo Arquitectónico'),
 (32,'Dibujo De Construcción Civil'),
 (33,'Dibujo, Pintura Y Escultura'),
 (34,'Dirección Y Realización De Cine Y Tv'),
 (35,'Diseño De Interiores'),
 (36,'Diseño Gráfico'),
 (37,'Diseño Modas'),
 (38,'Diseño Web'),
 (39,'Economía'),
 (40,'Edificaciones'),
 (41,'Edificaciones'),
 (42,'Eduación Secundaria'),
 (43,'Educación Especial'),
 (44,'Educación Física'),
 (45,'Educación codigoiomas'),
 (46,'Educación Inicial'),
 (47,'Educación Militar'),
 (48,'Educación Primaria'),
 (49,'Electriccodigoad Y Electrónica'),
 (50,'Enfermería'),
 (51,'Escribania'),
 (52,'Estética E Imagen Personal'),
 (53,'Finanzas Y Banca'),
 (54,'Formación De Personal Docente'),
 (55,'Fotografía'),
 (56,'Gastronomía'),
 (57,'Género'),
 (58,'Guía Oficial De Turismo'),
 (59,'Hoteleria'),
 (60,'Humancodigoades'),
 (61,'Información Insuficiente O No Especificada'),
 (62,'Informática'),
 (63,'Ingeniería Acuícola'),
 (64,'Ingeniería Agrónoma'),
 (65,'Ingeniería Ambiental'),
 (66,'Ingeniería Biotecnológica'),
 (67,'Ingeniería Civil'),
 (68,'Ingeniería De Sistemas'),
 (69,'Ingeniería De Soncodigoo'),
 (70,'Ingeniería De Transporte'),
 (71,'Ingeniería Eléctrica'),
 (72,'Ingeniería Electrónica'),
 (73,'Ingeniería En Energía'),
 (74,'Ingeniería En Higiene Y Segurcodigoad Industrial'),
 (75,'Ingeniería Forestal'),
 (76,'Ingeniería Geográfica'),
 (77,'Ingeniería Geológica'),
 (78,'Ingeniería Industrial'),
 (79,'Ingenieria De Alimentos'),
 (80,'Ingeniería Mecánica'),
 (81,'Ingeniería Metalúrgica'),
 (82,'Ingeniería Naval'),
 (83,'Ingeniería Pesquera'),
 (84,'Ingeniería Química'),
 (85,'Ingeniería Telecomunicaciones'),
 (86,'Ingeniería Textil'),
 (87,'Madera'),
 (88,'Mantenimiento De Vehículos'),
 (89,'Maquillaje Profesional'),
 (90,'Marketing'),
 (91,'Matemática Y Estadistica'),
 (92,'Medicina'),
 (93,'Medios Digitales'),
 (94,'Metal – Mecánica'),
 (95,'Música'),
 (96,'Negociación Colectiva'),
 (97,'Nutrición'),
 (98,'Obstetricia'),
 (99,'Odontología'),
 (100,'Otras Industrias'),
 (101,'Otras Profesiones Afines'),
 (102,'Otros'),
 (103,'Otros Servicios Personales'),
 (104,'Pastelería'),
 (105,'Periodismo'),
 (106,'Psicología Clínica'),
 (107,'Psicología Educativa'),
 (108,'Psicología Organizacional'),
 (109,'Psicología Social O Comunitaria'),
 (110,'Publiccodigoad'),
 (111,'Radiodifusión'),
 (112,'Relaciones Internacionales'),
 (113,'Relaciones Institucionales'),
 (114,'Relaciones Industriales'),
 (115,'Recursos Humanos'),
 (116,'Servicios A La Producción'),
 (117,'Servicios De Salud'),
 (118,'Servicios De Transporte'),
 (119,'Servicios Sociales'),
 (120,'Sociología'),
 (121,'Tecnología'),
 (122,'Tecnologías De Información'),
 (123,'Tecnólogo'),
 (124,'Teleoperador'),
 (125,'Textiles Y Confección De Vestimenta'),
 (126,'Topografía'),
 (127,'Trabajo Social'),
 (128,'Traductor'),
 (129,'Turismo'),
 (130,'Urbanismo'),
 (131,'Ventas');
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;


--
-- Definition of table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `Codigo_Cliente` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `Profesion` varchar(45) DEFAULT NULL,
  `Edad` int(2) DEFAULT NULL,
  `Estado_Civil` char(1) DEFAULT NULL,
  `Distrito` varchar(100) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Telefono_Casa` varchar(15) DEFAULT NULL,
  `Telefono_Celular` varchar(15) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Traslado` varchar(45) DEFAULT NULL,
  `Tarjeta_De_Credito` int(1) DEFAULT NULL,
  `Promotor` varchar(50) DEFAULT NULL,
  `Local` varchar(100) DEFAULT NULL,
  `Observacion` varchar(200) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`Codigo_Cliente`,`Nombre`,`Apellido`,`Profesion`,`Edad`,`Estado_Civil`,`Distrito`,`Direccion`,`Telefono_Casa`,`Telefono_Celular`,`Email`,`Traslado`,`Tarjeta_De_Credito`,`Promotor`,`Local`,`Observacion`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`) VALUES 
 (1,'2','2','22',2,'2',NULL,NULL,'','','','',NULL,'','',NULL,NULL,NULL,'2017-01-28 12:25:14',NULL,NULL,'admin','0'),
 (2,'Pablo','w','22',2,'1','2',NULL,'','','','',NULL,'','',NULL,NULL,'2017-01-28 12:26:49','2017-01-28 12:27:18',NULL,'admin','admin','0'),
 (3,'w','w','2',3,'2','Chorrillos',NULL,'','','','',NULL,'','',NULL,NULL,NULL,'2017-01-28 12:27:16',NULL,NULL,'admin','0'),
 (4,'Henry Pablo','Vega Ayala','Sistemas',24,'0','Villa El Savador',NULL,'','','','',NULL,'','',NULL,NULL,NULL,'2017-01-28 12:27:13',NULL,NULL,'admin','0'),
 (5,'Henry Pablo','Vega Ayala','Ingeniería De Sistemas / ñ ',23,'2','Villa El Savador',NULL,'01282886','955201758','ingenierovega9321@gmail.com','Si',2147483647,'','',NULL,'2017-01-28 12:28:42','2017-01-28 06:50:43',NULL,'admin','admin',NULL,'1');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Definition of table `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE `combo` (
  `Codigo_Fact_Detalle` int(11) NOT NULL,
  `Codigo_Combo` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` datetime DEFAULT NULL,
  `Usuario_Modificado` datetime DEFAULT NULL,
  `Usuario_Eliminado` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Combo`),
  KEY `fk_combo_detalle_factura1_idx` (`Codigo_Fact_Detalle`),
  CONSTRAINT `fk_combo_detalle_factura1` FOREIGN KEY (`Codigo_Fact_Detalle`) REFERENCES `detalle_factura` (`Codigo_Fact_Detalle`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `combo`
--

/*!40000 ALTER TABLE `combo` DISABLE KEYS */;
/*!40000 ALTER TABLE `combo` ENABLE KEYS */;


--
-- Definition of table `contrato`
--

DROP TABLE IF EXISTS `contrato`;
CREATE TABLE `contrato` (
  `Codigo_Contrato` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellidos` varchar(150) DEFAULT NULL,
  `Titular` varchar(150) DEFAULT NULL,
  `Esposo` varchar(150) DEFAULT NULL,
  `Dni_1` int(8) DEFAULT NULL,
  `Dni_2` int(8) DEFAULT NULL,
  `Estado_Civil_1` char(1) DEFAULT NULL,
  `Estado_Civil_2` char(1) DEFAULT NULL,
  `Domicilio_1` varchar(45) DEFAULT NULL,
  `Domicilio_2` varchar(45) DEFAULT NULL,
  `Ocupacion_1` varchar(45) DEFAULT NULL,
  `Ocupacion_2` varchar(45) DEFAULT NULL,
  `Monto_Pagado` decimal(10,2) DEFAULT NULL,
  `Saldos` decimal(10,2) DEFAULT NULL,
  `N_cuotas` int(8) DEFAULT NULL,
  `causas` varchar(150) DEFAULT NULL,
  `Penalizacion` decimal(8,2) DEFAULT NULL,
  `Formas` varchar(100) DEFAULT NULL,
  `Monto_devol` decimal(8,2) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` datetime DEFAULT NULL,
  `Usuario_Modificado` datetime DEFAULT NULL,
  `Usuario_Eliminado` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Contrato`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contrato`
--

/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
INSERT INTO `contrato` (`Codigo_Contrato`,`Nombre`,`Apellidos`,`Titular`,`Esposo`,`Dni_1`,`Dni_2`,`Estado_Civil_1`,`Estado_Civil_2`,`Domicilio_1`,`Domicilio_2`,`Ocupacion_1`,`Ocupacion_2`,`Monto_Pagado`,`Saldos`,`N_cuotas`,`causas`,`Penalizacion`,`Formas`,`Monto_devol`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`) VALUES 
 (1,'2','2','22','2',22,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;


--
-- Definition of table `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE `detalle_factura` (
  `Codigo_Factura` int(11) NOT NULL,
  `Codigo_Fact_Detalle` int(11) NOT NULL,
  `Descripcion` varchar(85) DEFAULT NULL,
  `precio` decimal(5,2) DEFAULT NULL,
  `igv` int(2) DEFAULT NULL,
  `Subtotal` decimal(5,2) DEFAULT NULL,
  `Total` decimal(5,2) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` datetime DEFAULT NULL,
  `Usuario_Modificado` datetime DEFAULT NULL,
  `Usuario_Eliminado` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Cantidad` int(5) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Fact_Detalle`),
  KEY `fk_detalle_factura_factura1_idx` (`Codigo_Factura`),
  CONSTRAINT `fk_detalle_factura_factura1` FOREIGN KEY (`Codigo_Factura`) REFERENCES `factura` (`Codigo_Factura`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detalle_factura`
--

/*!40000 ALTER TABLE `detalle_factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_factura` ENABLE KEYS */;


--
-- Definition of table `distrito`
--

DROP TABLE IF EXISTS `distrito`;
CREATE TABLE `distrito` (
  `codigo` int(3) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `distrito`
--

/*!40000 ALTER TABLE `distrito` DISABLE KEYS */;
INSERT INTO `distrito` (`codigo`,`descripcion`) VALUES 
 (1,'Ate'),
 (2,'Barranco'),
 (3,'Bellavista'),
 (4,'Breña'),
 (5,'Carmen De La Legua'),
 (6,'Cercado Callao'),
 (7,'Cercado De Lima'),
 (8,'Chorrillos'),
 (9,'Comas'),
 (10,'El Agustino'),
 (11,'Independencia'),
 (12,'Jesús María'),
 (13,'La Molina'),
 (14,'La Perla'),
 (15,'La Punta'),
 (16,'La Victoria'),
 (17,'Lince'),
 (18,'Los Olivos'),
 (19,'Magdalena Del Mar'),
 (20,'Miraflores'),
 (21,'Pueblo Libre'),
 (22,'Puente Piedra'),
 (23,'Rimac'),
 (24,'San Borja'),
 (25,'San Iscodigoro'),
 (26,'San Juan De Lurigancho'),
 (27,'San Juan De Miraflores'),
 (28,'San Luis'),
 (29,'San Martin De Porres'),
 (30,'San Miguel'),
 (31,'Santa Anita'),
 (32,'Santa Rosa'),
 (33,'Santiago De Surco'),
 (34,'Surquillo'),
 (35,'Ventanilla'),
 (36,'Villa El Savador'),
 (37,'Villa María Del Triunfo');
/*!40000 ALTER TABLE `distrito` ENABLE KEYS */;


--
-- Definition of table `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE `documento` (
  `Codigo_Documento` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `archivo` varchar(200) DEFAULT NULL,
  `extension` varchar(4) DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo_Documento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento`
--

/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` (`Codigo_Documento`,`Nombre`,`archivo`,`extension`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Eliminado`,`Usuario_Modificado`,`Estado`,`Fecha_Creado`) VALUES 
 (1,'pdf','pdf201701290103.pdf',NULL,NULL,'2017-01-29 03:23:40','admin','admin',NULL,'0','2017-01-29 01:03:47'),
 (2,'imagen','imagen201701290105.png',NULL,NULL,'2017-01-29 03:23:43','admin','admin',NULL,'0','2017-01-29 01:05:31'),
 (3,'sad','sad201701290105.pdf',NULL,NULL,NULL,'admin',NULL,NULL,'1','2017-01-29 01:05:43'),
 (4,'asdsad','asdsad_201701290106.pdf',NULL,NULL,NULL,'admin',NULL,NULL,'1','2017-01-29 01:06:54'),
 (5,'SFSDF','SFSDF_201701290107.png',NULL,NULL,NULL,'admin',NULL,NULL,'1','2017-01-29 01:07:20'),
 (6,'ASDASD','ASDASD_201701290107.pdf',NULL,NULL,NULL,'admin',NULL,NULL,'1','2017-01-29 01:07:31'),
 (7,'00030','00030_7-201701290324.png','png','2017-01-29 03:24:28',NULL,'admin',NULL,'admin','1','2017-01-29 01:22:10');
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;


--
-- Definition of table `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `Codigo_Factura` int(11) NOT NULL,
  `Codigo_Cliente` int(11) NOT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` datetime DEFAULT NULL,
  `Usuario_Modificado` datetime DEFAULT NULL,
  `Usuario_Eliminado` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Factura`),
  KEY `fk_factura_cliente1_idx` (`Codigo_Cliente`),
  CONSTRAINT `fk_factura_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;


--
-- Definition of table `folio`
--

DROP TABLE IF EXISTS `folio`;
CREATE TABLE `folio` (
  `Codigo_Folio` int(11) NOT NULL,
  `Valor` varchar(100) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Fecha_Creada` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo_Folio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folio`
--

/*!40000 ALTER TABLE `folio` DISABLE KEYS */;
INSERT INTO `folio` (`Codigo_Folio`,`Valor`,`Descripcion`,`Estado`,`Usuario_Creado`,`Usuario_Modificado`,`Fecha_Creada`,`Fecha_Modificada`) VALUES 
 (1,'17','IGV','1',NULL,'admin','2017-01-28 07:07:37','2017-01-28 07:11:23'),
 (2,'20','Comisión','1','admin','admin','2017-01-28 07:09:24','2017-01-28 07:14:19');
/*!40000 ALTER TABLE `folio` ENABLE KEYS */;


--
-- Definition of table `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `Codigo_Producto` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Precio_por_Noche` decimal(10,2) DEFAULT NULL,
  `Vigencia` int(2) DEFAULT NULL,
  `Desc_Afiliado` float DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Producto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producto`
--

/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` (`Codigo_Producto`,`Nombre`,`Precio`,`Precio_por_Noche`,`Vigencia`,`Desc_Afiliado`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`) VALUES 
 (1,'Club 10','2690.00','269.00',1,10,'2017-01-28 08:20:54','2017-01-28 08:39:27','2017-01-28 08:54:07','admin','admin','admin','0'),
 (2,'',NULL,NULL,NULL,NULL,'2017-01-28 09:00:15',NULL,NULL,'admin',NULL,NULL,'1');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;


--
-- Definition of table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE `rol` (
  `Cod_Rol` int(11) NOT NULL,
  `Descripcion` varchar(45) DEFAULT NULL,
  `Fecha_Creada` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Cod_Rol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rol`
--

/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` (`Cod_Rol`,`Descripcion`,`Fecha_Creada`,`Fecha_Modificada`,`Fecha_Eliminada`,`Estado`) VALUES 
 (1,'Anfitrión',NULL,NULL,NULL,'1'),
 (2,'Supervisor',NULL,NULL,NULL,'1'),
 (3,'Digitador',NULL,NULL,NULL,'1'),
 (4,'Director de mercadeo',NULL,NULL,NULL,'1'),
 (5,'Telemarketing',NULL,NULL,NULL,'1'),
 (6,'Confirmador',NULL,NULL,NULL,'1'),
 (7,'Supervisora de telemarketing',NULL,NULL,NULL,'1'),
 (8,'No access liner',NULL,NULL,NULL,'1'),
 (9,'No access closer',NULL,NULL,NULL,'1'),
 (10,'Jefe de contratos',NULL,NULL,NULL,'1'),
 (11,'Jefe de sala',NULL,NULL,NULL,'1'),
 (12,'Jefe de ventas',NULL,NULL,NULL,'1'),
 (13,'Director de proyecto',NULL,NULL,NULL,'1'),
 (14,'Gerente General',NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `Codigo_Usuario` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Apellido` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Contrasena` varchar(250) DEFAULT NULL,
  `AuthKey` varchar(250) DEFAULT NULL,
  `AccessToken` varchar(250) DEFAULT NULL,
  `Activate` tinyint(1) NOT NULL DEFAULT '0',
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(250) DEFAULT NULL,
  `Usuario_Modificado` varchar(250) DEFAULT NULL,
  `Usuario_Eliminado` varchar(250) DEFAULT NULL,
  `Ultima_Sesion` datetime DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Codigo_Rol` int(11) NOT NULL,
  PRIMARY KEY (`Codigo_Usuario`),
  KEY `fk_Usuario_Roles_idx` (`Codigo_Rol`),
  CONSTRAINT `fk_Usuario_Roles` FOREIGN KEY (`Codigo_Rol`) REFERENCES `rol` (`Cod_Rol`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`Codigo_Usuario`,`Nombre`,`Apellido`,`Email`,`Contrasena`,`AuthKey`,`AccessToken`,`Activate`,`Fecha_Creado`,`Fecha_Modificada`,`Fecha_Eliminada`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Ultima_Sesion`,`Estado`,`Codigo_Rol`) VALUES 
 (5,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','b44c3456c1e8c017f38dc04f07f70faa99e23bd4951a1eb8975b75047a500d62ece680c0b7aacab8998679174c1768999d39420a38a7d415f80feb988b3c212dacf953a226f34dd1b6f6aa6718ce48101817d1b862ad13fac24cd89404afcd60d383ae1c','0db547724cef543f5deea01f0c6ee9ee052ad95724f04d28148be12b93a6710e7bfec99b6a6f858f2a858096883c789c3030173c0e2c3a349dee8d6edb30dc7852c0c33cff584e477fb5e9957c938fb2e2bddd895fe1a0c8aed9a2298a43a06ac1094545',0,'2017-01-22 01:29:38','2017-01-27 11:23:21',NULL,NULL,'admin',NULL,NULL,'1',1),
 (6,'Henry Pablo','Vega Ayala','hp.veg2a@hotmail.com','00000000','afffb8c8a25b2327572715cc7a0f5b53c6c0a0b90726b089f9db689f49be53a8d2786d7f41c733c161769059fe4241e3b506012c614e9cefcff7aff88acc15f48e698abe68bbdbe3f35ea36efb1ccfeb2db3ea1644fee0dd1c9a7ec942524fb8b2e33f65','0618eb9c0cbd2efa706eb56b1cf85b89ae27cc32e2b6b512835101f46de45d942d0c73be9e84321f7c39336384b6348481d71010304984e34be73bb7916d024bcb789358a7e4bdacf17b29e274eba5f7ecfffc760564cb3b8cf5fdf34c5f2f79e26d2c7a',0,'2017-01-21 11:01:52','2017-01-22 05:28:52','2017-01-22 05:54:59',NULL,'hp.veg2a@hotmail.com','hp.veg2a@hotmail.com',NULL,'1',2),
 (7,'Henry Pablo','Ayala','ing@hotmail.com','000000','b35db61e3c49db41d02ef0327897ffaeb260775f6a6641044a342b661196c04388690d777d588d9d8b1f2d719f8b87cf44477a646620bf0cb2e10451f3462531d60ccc4836eec751bf99c2283df7a8795da705f1eb72b58ba22675c45e7ff197ab271391','76ec799c6a9aff5754dc309bef8e0816e74d238319e45ecf302f5575f9bbd2613f73b3509e13940de3484035f9dd93a36c8f2a030919bf328b4721dbced629ba7f8166ac4a05c14c093ce8578ab596b86959981b70d6a92d6ef885b91c79e99b3807a060',0,'2017-01-21 11:45:40','2017-01-22 04:53:16','2017-01-22 05:25:08',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',3),
 (8,'Amy','D. Myhre','ings@hotmail.com','000000','76d2236beec6e5ccede0143a3f1c7d8091f7cb7acf6ccab57307272c8ba5cd7b9301495f76e87694e0f51104ad14e44d7af2ad1b134a185842d8e0b2b669e1e548b8e8cc968280f37b919547a494d473ec640843ffafde748a2120c178a59de665e70eb0','2ea311da7ea69211129c4b30c55febf3438d2b1759f2e947a278c0600aaead1c4e4d2b3a09331663182b3b7536c2452c1fe3f122905b2a5564b47c6137dcc401d67fbd010c48132e8623a3231fbd28cc73d14ec66f2be2ec9e78afdadc83627df619c660',0,'2017-01-22 12:05:30',NULL,'2017-01-22 05:55:11',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',4),
 (9,'Henry Pablo','Ayala','hp.vega@hotmail.com','fsqScjqzw.euI','7c663bd53e96b4c153c958a678baf01f77263ae8ffd7e2eec98cc2bca3ee991e48cb00e185fff5d005150397a5f917030f47cccff2eceea837843a698cd97bceadb95e8444c0be664fd937114aa0b57f20f1d52f8d7963fa3d032aaefd4cd6f7791f23af','9b19fe64f114e21277dfdc54b8136706809e6fc5ab0b916cd647b8a7ddfd71335ae9b7fb3bd8169b1c856bc0c8bd71551b2be407a28b819137ba03cfa953465ea132f709ee24c28d49c481b460df023d1e30e1d11093f85e21a5e6700d3194f16113b08f',0,'2017-01-22 12:38:29',NULL,'2017-01-22 05:55:13',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',5),
 (10,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','edafa31ab207da11725d5b56eb4ff2a4d7986ab6f313614a0b7db12adb7327031fef70b1928e56e002fb865c2914cbd0c4a4e31a9f5698e456e7a8fbd514cd0bc8b7b4d0fa8d4936192128e9ef712d853938f405b30158f729d91735573deb7cf9078188','dbf4c515a8df53ef2d56f7c127447c69504490817533fdf651dd7164b2dfd6a733f2b96bbf05066ce4b358769cc88d44740f40a458256c40d4f69ee5e32f924f1379343a4eb32071229832a289d316b81042873ea39f4301de9724dd9df6e77e7b783890',0,'2017-01-22 01:38:20',NULL,'2017-01-22 04:35:53',NULL,NULL,NULL,NULL,'1',6),
 (11,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','e9d9ab6d0632f1cff070ecfc557036b1f1edaeb99e73edd0fbffd1b3d13c152dfed676eb1daabfb8eb539c5033cdda70d2a524f362a76675b19d3dc37b3574a98b5bc8d19d89f4195ebec42ca993e5c72ae632a5ae5268a3e0b4226badc74cbc9057825f','95f1a1024990657087e18886fb9fc9ef6286d14897529e7b47d0ab373dccd54515e1e763ccfb9d5dedb6a4dd44dfd791ae31d265c67972146962824a41c8afc31d58a45cb6dd4da1ca04479c15985ddb72655c1a7d18ef24027cd2c5de4df1b9ad48e9bd',0,'2017-01-22 01:52:26',NULL,'2017-01-22 04:35:33',NULL,NULL,NULL,NULL,'1',7),
 (12,'Henry Pablo','Ayala','hp.vega000@hotmail.com','000000','ebd42a52cdbebdae6d7ed5c487ef5d83e8cd02843cd58f855dd2a061e98112d5bc9cb08c80e23653141c41e421f8bd0e7542447abbc5b4f6c03dc84d4f563d1c04ddce4ecc9d28704233367d438a94018a4e1ee8c33c71dfbb1f79922da4d1ebe5964578','90c1a12509d2929dfd94f39c17c361ee432cb7402e7aa17e9379ec223ed6533adc7ca24238f886251f25cb9f2cc03b5c4b937429295c42c271c78ff10f9fe96590901cf7ef97f345b93f2a2ac8447e53cb83aa9b9bb77aaed68dab3958dff827dc4c1d14',0,'2017-01-22 01:57:04',NULL,NULL,NULL,NULL,NULL,NULL,'1',8),
 (13,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','d8c0998a0a8859e43c0efff2390f4650cd460adaa48ff83d9b77db355ee9609da7a15201345c8d6de1c59e5e59b950bf58d38f2daa0fe8730cea366d3a5f35a8eefa921ff698386e0ef4b442e1dbe1875be88cf718075f30e5e5180e8e3d834bbdcb5ba5','215c5cd8b3ab53bf0175fbe6e684003a1f874f66575773366a924967f5149bb4e39808d9d0da79a399968ccde9990d048d8fb623304256e6be70960ac4e5543a1d6b3b537591180fb930962d74268156831ea668a1b5b01f8ad66c150b4e9548dfa7e754',0,'2017-01-22 01:58:07',NULL,NULL,NULL,NULL,NULL,NULL,'1',9),
 (14,'Henry Pablo','Ayala','hp.vega@hotmail.com','000000','47fb0268b9a0efe08cdd02c46b6d28e333fc0ce69f676b9b6b5900be439f970a04e4fd4b6af4cd3d1facd38df297ec16bca1b3850b7705a5bad49d32868527f94a4560a582d023033be33cce005938c2adcef2acff1f273792e7a23f50032f61f72e5a88','32241150deb20d869683fcf62773a94a5c2fd040f1623eb4a2f9af503c9fcde26b007626faf956c7954538a12891d86140b7f2d2c87653b07d77a7c8fa78c8c51b5454748dc8278f2b7ffbd5a1468f0fbcd79ceb28f1e035bf6d26b82fe93b203330ba49',0,'2017-01-22 01:58:24',NULL,NULL,NULL,NULL,NULL,NULL,'1',10),
 (15,'Henry Pablo','Ayala','hp.vega111@hotmail.com','000000','d64c7ba1be8202fd7fd7683ed5e738208a9f4e706d8a570927942e78766a709825c70825f17892ecb538db98fdc39ef6a6d6a7b17b4ca3b518b16d9f6a02922a0dda1d22cbf69a546211c57bad178c4349a57879017667e99266143dc7124b336c55a9a7','1dec1a43a78238d5d6f3e11965ecc1ba0038a39493844354bbaa6dc53369cea3e86a12bb656b33b88647cf67f8bb9272966266c81c39faf227ca07de93e45b282a5091ab9adca613ae23253c13f2eab3a424a2730e5628191c5329607ae76024f4cea912',0,'2017-01-22 01:59:57',NULL,NULL,NULL,NULL,NULL,NULL,'1',11),
 (16,'Henry Pablo','Ayala','hp.vega2@hotmail.com','000000','0146c87019c3c99116e4a52dc55619f0d0f4c0c4267a9758508528653cf142b98688beff09f83a04710c81839a71504811028200d16cb486777ab187ced845ce82522c0770b513ff53bdd661e8152f29da89bcd405e5694d16d6d131d837d05b07a52287','60fb8462bee5b2d7bd2066721a977e10b0e6867c3cca6953690fd360047f908fd7b86d6d908606b50bc33543d32da9d4d4503b23db3789fd736e6e0c88b2970fc7eedfdffbbee21ac1ef7d9c133c6b1080515852f12b111e04456111858c05073eabb8ca',0,'2017-01-22 02:33:41',NULL,'2017-01-22 05:55:17',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',12),
 (17,'Henry Pablo','Ayala','hp.vega9@hotmail.com','000000','43f01bd02f6c352479f3a16afc632d7f647774fe8dec43b3047d757bc4d7a7f16ae5a4f2b143383975cd1f726320066a4628c9dcdb801294cdf4af4ff8505cb80941c4accba2c3c6fa1015f2536677dda150a542a09b59ed0d02618ba35179e72f355cce','5c7ac6dbf7ea83faca2350d883f1f920fe3e28bec6989c4fc7cb2e9ecea27c6866d951777b2d8a7aba59c24aee29d585b45a600706a75e8b73cc4bcde4960489f7b0548c78f7f8722116ab35c1d9296301fd3fd8cf2d885ea646e08483f224230110ef19',0,'2017-01-22 02:36:14',NULL,'2017-01-22 05:55:08',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',13),
 (18,'Henry Pablo','Vega Ayala','admin','admin','a6e703b3272ea7a9d04d5a6c7000d89ab024ee0f7e543785557d9fbb3229d35ab0479e40ab70ad38c082cbdfda39a4f0863f2568bf62f9c1017ecce9591e6b8c421e9155a83b1b303830a4cabdd908eed3d3f43877f9238534e76190f78a8b265b7d2cf2','2c8d11b02775154d1701d444a9fe3b81b8f7e5c1e0e99ecf1e6e1348ed552f0729578fb89f32fe38fab23822f791fa52708d1f8514623476bcdb33e2f6a4bb93aeaa85488e786faa55da0487ccad41bbb19cc1d1cf5361b5d3cfcb03888bbea8aa64f340',0,'2017-01-22 02:35:49',NULL,'2017-01-22 05:55:04',NULL,NULL,'hp.veg2a@hotmail.com',NULL,'1',14);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
