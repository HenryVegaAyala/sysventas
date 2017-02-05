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
-- Definition of table `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES 
 ('Administrador','1',1485353042),
 ('Digitador','2',1486097094);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;


--
-- Definition of table `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES 
 ('/cliente/create',2,NULL,NULL,NULL,1486089269,1486089269),
 ('/contrato/*',2,NULL,NULL,NULL,1486090127,1486090127),
 ('/contrato/contrato',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/contrato/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/factura/factura',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/factura/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/producto/create',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/delete',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/index',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/update',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/view',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/user/admin/index',2,NULL,NULL,NULL,1486090324,1486090324),
 ('/user/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/user/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/user/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/user/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('Administrador',1,NULL,'Test Rule',NULL,1485300051,1486097070),
 ('Anfitrión',1,NULL,'Test Rule',NULL,1485265640,1485265640),
 ('Confirmador',1,NULL,'Test Rule',NULL,1485265777,1485265777),
 ('Digitador',1,NULL,'Test Rule',NULL,1485265739,1485265739),
 ('Director de mercadeo',1,NULL,'Test Rule',NULL,1485265754,1485265754),
 ('Director de proyecto',1,NULL,'Test Rule',NULL,1485266367,1485266367),
 ('Gerente General',1,NULL,'Test Rule',NULL,1485266379,1485266379),
 ('Jefe de contratos',1,NULL,'Test Rule',NULL,1485265848,1485265848),
 ('Jefe de sala',1,NULL,'Test Rule',NULL,1485265874,1485265874),
 ('Jefe de ventas',1,NULL,'Test Rule',NULL,1485266346,1485266346),
 ('No access closer',1,NULL,'Test Rule',NULL,1485265827,1485265827),
 ('No access liner',1,NULL,'Test Rule',NULL,1485265812,1485265812),
 ('Supervisor',1,NULL,'Test Rule',NULL,1485265655,1485265655),
 ('Supervisora de telemarketing',1,NULL,'Test Rule',NULL,1485265800,1485265800),
 ('Telemarketing',1,NULL,'Test Rule',NULL,1485265766,1485265766);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;


--
-- Definition of table `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item_child`
--

/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES 
 ('Administrador','/cliente/create'),
 ('Digitador','/cliente/create'),
 ('Administrador','/contrato/index'),
 ('Administrador','/documento/index'),
 ('Administrador','/factura/factura'),
 ('Administrador','/factura/index'),
 ('Administrador','/folio/index'),
 ('Administrador','/producto/create'),
 ('Administrador','/user/update');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;


--
-- Definition of table `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_rule`
--

/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
INSERT INTO `auth_rule` (`name`,`data`,`created_at`,`updated_at`) VALUES 
 ('Administrador','O:15:\"app\\rbac\\MyRule\":3:{s:4:\"name\";s:13:\"Administrador\";s:9:\"createdAt\";i:1486097040;s:9:\"updatedAt\";i:1486097040;}',1486097040,1486097040),
 ('Test Rule','O:15:\"app\\rbac\\MyRule\":3:{s:4:\"name\";s:9:\"Test Rule\";s:9:\"createdAt\";i:1485265539;s:9:\"updatedAt\";i:1485265615;}',1485265539,1485265615);
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;


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
 (5,'Henry Pablo','Vega Ayala','Ingeniería De Sistemas / ñ ',23,'2','Villa El Savador',NULL,'01282886','955201758','ingenierovega9321@gmail.com','Si',2147483647,'','',NULL,'2017-01-28 12:28:42','2017-01-28 06:50:43',NULL,'admin','admin',NULL,'1'),
 (6,'Henry Pablo','Vega Ayala','Ingeniería De Sistemas',23,'0','Villa El Savador',NULL,'012802886','955201758','ingenierovega9321@gmail.com','0',0,'','',NULL,'2017-02-02 11:31:12',NULL,NULL,'admin',NULL,NULL,'1');
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
-- Definition of table `log_upload`
--

DROP TABLE IF EXISTS `log_upload`;
CREATE TABLE `log_upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `title` varchar(128) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `fileori` varchar(255) DEFAULT NULL,
  `params` longblob,
  `values` longblob,
  `warning` longblob,
  `keys` text,
  `type` tinyint(1) DEFAULT NULL,
  `userCreate` int(11) DEFAULT NULL,
  `userUpdate` int(11) DEFAULT NULL,
  `updateDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `createDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log_upload`
--

/*!40000 ALTER TABLE `log_upload` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_upload` ENABLE KEYS */;


--
-- Definition of table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`,`name`,`parent`,`route`,`order`,`data`) VALUES 
 (4,'Registrar Cliente',NULL,'/cliente/create',1,NULL),
 (5,'Registro de Productos y Servicios',NULL,'/producto/create',1,NULL),
 (6,'Contratos',NULL,'/contrato/index',4,NULL),
 (8,'Documentos y Cotizaciones',NULL,'/documento/index',4,NULL),
 (9,'Registro de Usuario',NULL,NULL,5,NULL),
 (10,'Administracion',NULL,'/folio/index',6,NULL),
 (11,'Factura',NULL,'/factura/index',4,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


--
-- Definition of table `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` (`version`,`apply_time`) VALUES 
 ('m000000_000000_base',1485218586),
 ('m140209_132017_init',1485218592),
 ('m140403_174025_create_account_table',1485218592),
 ('m140504_113157_update_tables',1485218592),
 ('m140504_130429_create_token_table',1485218592),
 ('m140830_171933_fix_ip_field',1485218592),
 ('m140830_172703_change_account_table_name',1485218592),
 ('m141222_110026_update_ip_field',1485218592),
 ('m141222_135246_alter_username_length',1485218592),
 ('m150614_103145_update_social_account_table',1485218592),
 ('m150623_212711_fix_username_notnull',1485218592),
 ('m151218_234654_add_timezone_to_profile',1485218592),
 ('m160929_103127_add_last_login_at_to_user_table',1485218592),
 ('m140602_111327_create_menu_table',1485220751),
 ('m160312_050000_create_user',1485220751);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;


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
-- Definition of table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`user_id`,`name`,`public_email`,`gravatar_email`,`gravatar_id`,`location`,`website`,`bio`,`timezone`) VALUES 
 (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (2,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;


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
-- Definition of table `social_account`
--

DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `social_account`
--

/*!40000 ALTER TABLE `social_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_account` ENABLE KEYS */;


--
-- Definition of table `tbl_dynagrid`
--

DROP TABLE IF EXISTS `tbl_dynagrid`;
CREATE TABLE `tbl_dynagrid` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid setting identifier',
  `filter_id` varchar(100) DEFAULT NULL COMMENT 'Filter setting identifier',
  `sort_id` varchar(100) DEFAULT NULL COMMENT 'Sort setting identifier',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid configuration',
  PRIMARY KEY (`id`),
  KEY `tbl_dynagrid_FK1` (`filter_id`),
  KEY `tbl_dynagrid_FK2` (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dynagrid`
--

/*!40000 ALTER TABLE `tbl_dynagrid` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_dynagrid` ENABLE KEYS */;


--
-- Definition of table `tbl_dynagrid_dtl`
--

DROP TABLE IF EXISTS `tbl_dynagrid_dtl`;
CREATE TABLE `tbl_dynagrid_dtl` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid detail setting identifier',
  `category` varchar(10) NOT NULL COMMENT 'Dynagrid detail setting category "filter" or "sort"',
  `name` varchar(150) NOT NULL COMMENT 'Name to identify the dynagrid detail setting',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid detail configuration',
  `dynagrid_id` varchar(100) NOT NULL COMMENT 'Related dynagrid identifier',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_dynagrid_dtl_UK1` (`name`,`category`,`dynagrid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dynagrid_dtl`
--

/*!40000 ALTER TABLE `tbl_dynagrid_dtl` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_dynagrid_dtl` ENABLE KEYS */;


--
-- Definition of table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

/*!40000 ALTER TABLE `token` DISABLE KEYS */;
/*!40000 ALTER TABLE `token` ENABLE KEYS */;


--
-- Definition of table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `password_reset_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`username`,`email`,`password_hash`,`auth_key`,`confirmed_at`,`unconfirmed_email`,`blocked_at`,`registration_ip`,`created_at`,`updated_at`,`flags`,`last_login_at`,`status`,`password_reset_token`) VALUES 
 (1,'Administrador','Administrador@gmail.com','$2y$10$yUzxtAzmgk6uVMpq/te1OO9mMH7qPDedH2bqGJribNfwnyDDOrRHS','QhKUuILWchtosO9r-X2lLa4Hn4J8qyxU',1485221857,'',NULL,'',1485221832,1485221832,0,1486098756,10,''),
 (2,'Henry Vega','hp.vega@hotmail.com','$2y$10$Uz1U2coJSLJ7yLkxsjQ.6eR2OY51yob51wsnY35D/4NO6pe6uW4ES','1vI692Rlpl0flUn1NKCrN59NoS1zk4-Y',1486090857,'',NULL,'::1',1486090857,1486090857,0,1486096650,10,'');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
