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
-- Definition of table `anfitrion`
--

DROP TABLE IF EXISTS `anfitrion`;
CREATE TABLE `anfitrion` (
  `Codigo` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Apellido` varchar(100) DEFAULT NULL,
  `DNI` int(8) DEFAULT NULL,
  `Edad` int(2) DEFAULT NULL,
  `Cargo` varchar(100) DEFAULT NULL,
  `Telefono_Casa` varchar(15) DEFAULT NULL,
  `Telefono_Celular` varchar(15) DEFAULT NULL,
  `Turno` varchar(45) DEFAULT NULL,
  `Descanso` varchar(45) DEFAULT NULL,
  `Encargado` char(1) DEFAULT '0',
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anfitrion`
--

/*!40000 ALTER TABLE `anfitrion` DISABLE KEYS */;
/*!40000 ALTER TABLE `anfitrion` ENABLE KEYS */;


--
-- Definition of table `asig_tlmk_cliente`
--

DROP TABLE IF EXISTS `asig_tlmk_cliente`;
CREATE TABLE `asig_tlmk_cliente` (
  `codigo_asig` int(255) NOT NULL,
  `codigo_tlmk_cliente` int(255) NOT NULL AUTO_INCREMENT,
  `Codigo_Usuario` int(11) NOT NULL,
  `Codigo_Cliente` int(11) NOT NULL,
  `Fecha_Creada` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(45) DEFAULT NULL,
  `Usuario_Modificado` varchar(45) DEFAULT NULL,
  `Usuario_Eliminado` varchar(45) DEFAULT NULL,
  `Fecha_Llamado` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo_tlmk_cliente`),
  KEY `fk_Asig_Tlmk_Cliente_cliente1_idx` (`Codigo_Cliente`),
  KEY `fk_asig_tlmk_cliente_fecha_asignacion1_idx` (`codigo_asig`),
  KEY `fk_asig_tlmk_cliente_user1_idx` (`Codigo_Usuario`),
  CONSTRAINT `fk_Asig_Tlmk_Cliente_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asig_tlmk_cliente_fecha_asignacion1` FOREIGN KEY (`codigo_asig`) REFERENCES `fecha_asignacion` (`codigo_asig`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_asig_tlmk_cliente_user1` FOREIGN KEY (`Codigo_Usuario`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asig_tlmk_cliente`
--

/*!40000 ALTER TABLE `asig_tlmk_cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `asig_tlmk_cliente` ENABLE KEYS */;


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
 ('Administrador','16',1486840433),
 ('Anfitrión','2',1486858823),
 ('Confirmador','3',1486939658),
 ('Digitador','4',1486852629),
 ('Director Comercial','21',1486885651),
 ('Director de mercadeo','5',1486877704),
 ('Director de Planemiento y Administracion','20',1486885640),
 ('Director de Telemarketing','19',1486885627),
 ('Jefe de contratos','8',1487031211),
 ('Jefe Promotor','18',1486861308),
 ('No access closer','11',1486876850),
 ('No access liner','12',1486877048),
 ('Supervisor Promotor','17',1486862527),
 ('Supervisora de telemarketing','14',1486921402);
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
 ('/anfitrion/*',2,NULL,NULL,NULL,1486337931,1486337931),
 ('/anfitrion/anfitrion',2,NULL,NULL,NULL,1486342782,1486342782),
 ('/anfitrion/create',2,NULL,NULL,NULL,1486337931,1486337931),
 ('/anfitrion/delete',2,NULL,NULL,NULL,1486337931,1486337931),
 ('/anfitrion/index',2,NULL,NULL,NULL,1486337931,1486337931),
 ('/anfitrion/update',2,NULL,NULL,NULL,1486337931,1486337931),
 ('/anfitrion/view',2,NULL,NULL,NULL,1486337931,1486337931),
 ('/asig-tlmk-cliente/*',2,NULL,NULL,NULL,1486785732,1486785732),
 ('/asig-tlmk-cliente/create',2,NULL,NULL,NULL,1486785732,1486785732),
 ('/asig-tlmk-cliente/delete',2,NULL,NULL,NULL,1486785732,1486785732),
 ('/asig-tlmk-cliente/index',2,NULL,NULL,NULL,1486785732,1486785732),
 ('/asig-tlmk-cliente/update',2,NULL,NULL,NULL,1486785732,1486785732),
 ('/asig-tlmk-cliente/view',2,NULL,NULL,NULL,1486785732,1486785732),
 ('/certificado/*',2,NULL,NULL,NULL,1486956356,1486956356),
 ('/certificado/create',2,NULL,NULL,NULL,1486956356,1486956356),
 ('/certificado/delete',2,NULL,NULL,NULL,1486956356,1486956356),
 ('/certificado/index',2,NULL,NULL,NULL,1486956356,1486956356),
 ('/certificado/update',2,NULL,NULL,NULL,1486956356,1486956356),
 ('/certificado/view',2,NULL,NULL,NULL,1486956356,1486956356),
 ('/cliente/*',2,NULL,NULL,NULL,1486877658,1486877658),
 ('/cliente/confirmador',2,NULL,NULL,NULL,1486939633,1486939633),
 ('/cliente/create',2,NULL,NULL,NULL,1486089269,1486089269),
 ('/cliente/delete',2,NULL,NULL,NULL,1486877658,1486877658),
 ('/cliente/index',2,NULL,NULL,NULL,1486241913,1486241913),
 ('/cliente/lista',2,NULL,NULL,NULL,1486852916,1486852916),
 ('/cliente/update',2,NULL,NULL,NULL,1486877658,1486877658),
 ('/cliente/view',2,NULL,NULL,NULL,1486877658,1486877658),
 ('/club/*',2,NULL,NULL,NULL,1486956366,1486956366),
 ('/club/create',2,NULL,NULL,NULL,1486956366,1486956366),
 ('/club/delete',2,NULL,NULL,NULL,1486956366,1486956366),
 ('/club/index',2,NULL,NULL,NULL,1486956366,1486956366),
 ('/club/update',2,NULL,NULL,NULL,1486956366,1486956366),
 ('/club/view',2,NULL,NULL,NULL,1486956366,1486956366),
 ('/comision/*',2,NULL,NULL,NULL,1486856976,1486856976),
 ('/comision/index',2,NULL,NULL,NULL,1486856974,1486856974),
 ('/comision/view',2,NULL,NULL,NULL,1486856974,1486856974),
 ('/contrato/*',2,NULL,NULL,NULL,1486090127,1486090127),
 ('/contrato/contrato',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/contrato/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/documento/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/factura/factura',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/factura/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/fecha-asignacion/*',2,NULL,NULL,NULL,1486837996,1486837996),
 ('/fecha-asignacion/create',2,NULL,NULL,NULL,1486837995,1486837995),
 ('/fecha-asignacion/delete',2,NULL,NULL,NULL,1486837996,1486837996),
 ('/fecha-asignacion/index',2,NULL,NULL,NULL,1486837995,1486837995),
 ('/fecha-asignacion/update',2,NULL,NULL,NULL,1486837996,1486837996),
 ('/fecha-asignacion/view',2,NULL,NULL,NULL,1486837995,1486837995),
 ('/folio/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/folio/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/pasaporte/*',2,NULL,NULL,NULL,1486956376,1486956376),
 ('/pasaporte/create',2,NULL,NULL,NULL,1486956376,1486956376),
 ('/pasaporte/delete',2,NULL,NULL,NULL,1486956376,1486956376),
 ('/pasaporte/index',2,NULL,NULL,NULL,1486956376,1486956376),
 ('/pasaporte/update',2,NULL,NULL,NULL,1486956376,1486956376),
 ('/pasaporte/view',2,NULL,NULL,NULL,1486956376,1486956376),
 ('/producto/create',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/delete',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/index',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/update',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/producto/view',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/reporte/*',2,NULL,NULL,NULL,1486921183,1486921183),
 ('/reporte/confirmador',2,NULL,NULL,NULL,1486886815,1486886815),
 ('/reporte/create',2,NULL,NULL,NULL,1486314032,1486314032),
 ('/reporte/supervisor',2,NULL,NULL,NULL,1486921296,1486921296),
 ('/telemarketing/create',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/telemarketing/index',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/telemarketing/telemarketing',2,NULL,NULL,NULL,1486089278,1486089278),
 ('/user/admin/index',2,NULL,NULL,NULL,1486090324,1486090324),
 ('/user/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/user/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/user/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/user/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/*',2,NULL,NULL,NULL,1486244259,1486244259),
 ('/usuario/create',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/delete',2,NULL,NULL,NULL,1486244259,1486244259),
 ('/usuario/index',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/update',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/usuario/view',2,NULL,NULL,NULL,1485299786,1485299786),
 ('/venta/*',2,NULL,NULL,NULL,1486956386,1486956386),
 ('/venta/create',2,NULL,NULL,NULL,1486956386,1486956386),
 ('/venta/delete',2,NULL,NULL,NULL,1486956386,1486956386),
 ('/venta/index',2,NULL,NULL,NULL,1486956386,1486956386),
 ('/venta/update',2,NULL,NULL,NULL,1486956386,1486956386),
 ('/venta/view',2,NULL,NULL,NULL,1486956386,1486956386),
 ('Administrador',1,NULL,'Test Rule',NULL,1485300051,1486097070),
 ('Anfitrión',1,NULL,'Test Rule',NULL,1485265640,1485265640),
 ('Confirmador',1,NULL,'Test Rule',NULL,1485265777,1485265777),
 ('Digitador',1,NULL,'Test Rule',NULL,1485265739,1486329016),
 ('Director Comercial',1,NULL,'Test Rule',NULL,1486885605,1486885605),
 ('Director de mercadeo',1,NULL,'Test Rule',NULL,1485265754,1485265754),
 ('Director de Planemiento y Administracion',1,NULL,'Test Rule',NULL,1486885593,1486885593),
 ('Director de proyecto',1,NULL,'Test Rule',NULL,1485266367,1485266367),
 ('Director de Telemarketing',1,NULL,'Test Rule',NULL,1486885540,1486885540),
 ('Gerente General',1,NULL,'Test Rule',NULL,1485266379,1485266379),
 ('Jefe de contratos',1,NULL,'Test Rule',NULL,1485265848,1485265848),
 ('Jefe de sala',1,NULL,'Test Rule',NULL,1485265874,1485265874),
 ('Jefe de ventas',1,NULL,'Test Rule',NULL,1485266346,1485266346),
 ('Jefe Promotor',1,NULL,'Test Rule',NULL,1486861071,1486861071),
 ('No access closer',1,NULL,'Test Rule',NULL,1485265827,1485265827),
 ('No access liner',1,NULL,'Test Rule',NULL,1485265812,1485265812),
 ('Supervisor',1,NULL,'Test Rule',NULL,1485265655,1485265655),
 ('Supervisor Promotor',1,NULL,'Test Rule',NULL,1486861102,1486862514),
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
 ('Administrador','/anfitrion/*'),
 ('Administrador','/anfitrion/anfitrion'),
 ('Administrador','/anfitrion/create'),
 ('Administrador','/anfitrion/delete'),
 ('Administrador','/anfitrion/index'),
 ('Administrador','/anfitrion/update'),
 ('Administrador','/anfitrion/view'),
 ('Administrador','/asig-tlmk-cliente/*'),
 ('Administrador','/asig-tlmk-cliente/create'),
 ('Administrador','/asig-tlmk-cliente/delete'),
 ('Administrador','/asig-tlmk-cliente/index'),
 ('Telemarketing','/asig-tlmk-cliente/index'),
 ('Administrador','/asig-tlmk-cliente/update'),
 ('Administrador','/asig-tlmk-cliente/view'),
 ('Administrador','/certificado/*'),
 ('Administrador','/certificado/create'),
 ('Administrador','/certificado/delete'),
 ('Administrador','/certificado/index'),
 ('Administrador','/certificado/update'),
 ('Administrador','/certificado/view'),
 ('Confirmador','/cliente/confirmador'),
 ('Jefe de contratos','/cliente/confirmador'),
 ('Administrador','/cliente/create'),
 ('Digitador','/cliente/create'),
 ('Director de mercadeo','/cliente/create'),
 ('Jefe de contratos','/cliente/create'),
 ('Administrador','/cliente/index'),
 ('Director de mercadeo','/cliente/index'),
 ('Jefe de contratos','/cliente/index'),
 ('Digitador','/cliente/lista'),
 ('Telemarketing','/cliente/lista'),
 ('Director de mercadeo','/cliente/update'),
 ('Jefe de contratos','/cliente/update'),
 ('Director de mercadeo','/cliente/view'),
 ('Administrador','/club/*'),
 ('Administrador','/club/create'),
 ('Administrador','/club/delete'),
 ('Administrador','/club/index'),
 ('Administrador','/club/update'),
 ('Administrador','/club/view'),
 ('Administrador','/comision/index'),
 ('Anfitrión','/comision/index'),
 ('Jefe Promotor','/comision/index'),
 ('No access closer','/comision/index'),
 ('No access liner','/comision/index'),
 ('Supervisor Promotor','/comision/index'),
 ('Anfitrión','/comision/view'),
 ('Jefe Promotor','/comision/view'),
 ('No access closer','/comision/view'),
 ('No access liner','/comision/view'),
 ('Supervisor Promotor','/comision/view'),
 ('Administrador','/contrato/*'),
 ('Administrador','/contrato/contrato'),
 ('Administrador','/contrato/index'),
 ('Administrador','/documento/create'),
 ('Administrador','/documento/index'),
 ('Administrador','/documento/update'),
 ('Administrador','/documento/view'),
 ('Administrador','/factura/factura'),
 ('Administrador','/factura/index'),
 ('Administrador','/fecha-asignacion/*'),
 ('Administrador','/fecha-asignacion/create'),
 ('Director de Telemarketing','/fecha-asignacion/create'),
 ('Administrador','/fecha-asignacion/delete'),
 ('Administrador','/fecha-asignacion/index'),
 ('Administrador','/fecha-asignacion/update'),
 ('Administrador','/fecha-asignacion/view'),
 ('Administrador','/folio/create'),
 ('Administrador','/folio/index'),
 ('Administrador','/folio/update'),
 ('Administrador','/folio/view'),
 ('Administrador','/pasaporte/*'),
 ('Administrador','/pasaporte/create'),
 ('Administrador','/pasaporte/delete'),
 ('Administrador','/pasaporte/index'),
 ('Administrador','/pasaporte/update'),
 ('Administrador','/pasaporte/view'),
 ('Director de Telemarketing','/reporte/confirmador'),
 ('Administrador','/reporte/create'),
 ('Director de mercadeo','/reporte/create'),
 ('Director de Telemarketing','/reporte/create'),
 ('Jefe de ventas','/reporte/create'),
 ('Supervisora de telemarketing','/reporte/supervisor'),
 ('Administrador','/telemarketing/create'),
 ('Administrador','/telemarketing/index'),
 ('Administrador','/telemarketing/telemarketing'),
 ('Administrador','/user/admin/index'),
 ('Administrador','/user/create'),
 ('Administrador','/user/index'),
 ('Administrador','/user/update'),
 ('Administrador','/user/view'),
 ('Administrador','/usuario/*'),
 ('Administrador','/usuario/create'),
 ('Jefe de sala','/usuario/create'),
 ('Jefe de ventas','/usuario/create'),
 ('Administrador','/usuario/delete'),
 ('Administrador','/usuario/index'),
 ('Jefe de sala','/usuario/index'),
 ('Jefe de ventas','/usuario/index'),
 ('Supervisor','/usuario/index'),
 ('Administrador','/usuario/update'),
 ('Administrador','/usuario/view'),
 ('Administrador','/venta/*'),
 ('Administrador','/venta/create'),
 ('Jefe de contratos','/venta/create'),
 ('Administrador','/venta/delete'),
 ('Administrador','/venta/index'),
 ('Jefe de contratos','/venta/index'),
 ('Administrador','/venta/update'),
 ('Administrador','/venta/view');
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
-- Definition of table `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
CREATE TABLE `beneficiario` (
  `Codigo_Cliente` int(11) NOT NULL,
  `Codigo_Beneficiario` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`Codigo_Beneficiario`),
  KEY `fk_beneficiario_cliente1_idx` (`Codigo_Cliente`),
  CONSTRAINT `fk_beneficiario_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beneficiario`
--

/*!40000 ALTER TABLE `beneficiario` DISABLE KEYS */;
INSERT INTO `beneficiario` (`Codigo_Cliente`,`Codigo_Beneficiario`,`Nombre`,`Apellido`,`Profesion`,`Edad`,`Estado_Civil`,`Distrito`,`Direccion`,`Telefono_Casa`,`Telefono_Celular`,`Email`,`Traslado`,`Tarjeta_De_Credito`,`Promotor`,`Local`,`Observacion`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`) VALUES 
 (4,28,'sssssss','ssssssss',NULL,34,'0',NULL,NULL,'34343434','34343434','ssss',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (5,32,'ssssss','ssssssss',NULL,34,'0',NULL,NULL,'234234','94234324','asdSDAS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (5,33,'zzzzzzzzzzzzz','',NULL,34,'1',NULL,NULL,'43242','34343','424234',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (5,34,'xxxxxxxxxxxxxx','',NULL,34,'1',NULL,NULL,'4234324','2342432','ADSASDADSAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (6,35,'Henry Pablossssssssssss','Ayala',NULL,33,'0',NULL,NULL,'955201758','955201758','hp.vega@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (6,36,'dddd','Dddd',NULL,33,'1',NULL,NULL,'955201758','955201758','hp.vega@hotmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `beneficiario` ENABLE KEYS */;


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
-- Definition of table `certificado`
--

DROP TABLE IF EXISTS `certificado`;
CREATE TABLE `certificado` (
  `Codigo_certificado` int(255) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Vigencia` int(2) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Stock` int(2) DEFAULT NULL,
  `Codigo_pasaporte_afiliado` int(255) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_certificado`),
  KEY `fk_certificado_pasaporte1_idx` (`Codigo_pasaporte_afiliado`),
  CONSTRAINT `fk_certificado_pasaporte1` FOREIGN KEY (`Codigo_pasaporte_afiliado`) REFERENCES `pasaporte` (`Codigo_pasaporte`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `certificado`
--

/*!40000 ALTER TABLE `certificado` DISABLE KEYS */;
/*!40000 ALTER TABLE `certificado` ENABLE KEYS */;


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
  `Estado` char(2) DEFAULT NULL COMMENT 'Estados\n0 = Inactivo\n1 = Activo\n2 = Cita Concretada\n3 = Cita Pendiente\n4 = N/Q\n5 = N/I\n6 = D/F\n7 = N/C\n8 = Apagado\n--------------------\n9  = Asignado\n10 = No Asignado\n11 = Confirmado\n12 = No Confirmado\n13 = Venta Efectuada\n--------------------\nAgendado\n3 - 7 - 8 - 10\n \n',
  `Agendado` datetime DEFAULT NULL,
  `Telefono_Casa2` varchar(15) DEFAULT NULL,
  `Telefono_Celular2` varchar(15) DEFAULT NULL,
  `Telefono_Celular3` varchar(15) DEFAULT NULL,
  `dni` int(8) DEFAULT NULL,
  `Super_Promotor` varchar(100) DEFAULT NULL,
  `Jefe_Promotor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Codigo_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cliente`
--

/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`Codigo_Cliente`,`Nombre`,`Apellido`,`Profesion`,`Edad`,`Estado_Civil`,`Distrito`,`Direccion`,`Telefono_Casa`,`Telefono_Celular`,`Email`,`Traslado`,`Tarjeta_De_Credito`,`Promotor`,`Local`,`Observacion`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`,`Agendado`,`Telefono_Casa2`,`Telefono_Celular2`,`Telefono_Celular3`,`dni`,`Super_Promotor`,`Jefe_Promotor`) VALUES 
 (1,'Henry Pablo','Ayala','Diseño Web',22,'2','Comas','Sector 8 mz m lote 13','955201758','955201758','hp.vega@hotmail.com','',NULL,'','',NULL,'2017-02-13 06:33:32',NULL,NULL,'digitador@gmail.com',NULL,NULL,'10',NULL,'955201758','955201758','955201758',22222222,'',''),
 (2,'Henry Pablo','Ayala','Computación E Informática',45,'1','Puente Piedra','Sector 8 mz m lote 13','955201758','955201758','hp.vega@hotmail.com','1',0,'','',NULL,'2017-02-13 06:33:52',NULL,NULL,'digitador@gmail.com',NULL,NULL,'11',NULL,'955201758','955201758','955201758',55555555,'',''),
 (3,'Henry Pablo','Ayala','Artes Grafícas Y Audiovisuales',34,'0','Cercado Callao','Sector 8 mz m lote 13','955201758','955201758','hp.vega@hotmail.com','0',1,'','',NULL,'2017-02-13 06:34:28',NULL,NULL,'digitador@gmail.com',NULL,NULL,'10',NULL,'955201758','955201758','955201758',34333333,'',''),
 (4,'Amy','D. Myhre','Administración Turismo Y Hotelería',34,'1','El Agustino','53 Park Terrace','983647590','983647590','','0',1,'','',NULL,'2017-02-13 06:35:35',NULL,NULL,'digitador@gmail.com',NULL,NULL,'10',NULL,'983647590','983647590','983647590',44444444,'',''),
 (5,'Henry Pablo','Ayala','Arquitectura Interiores',34,'0','El Agustino','Sector 8 mz m lote 13','955201758','955201758','hp.vega@hotmail.com','1',0,'','',NULL,'2017-02-13 06:36:41',NULL,NULL,'digitador@gmail.com',NULL,NULL,'10',NULL,'955201758','955201758','955201758',33333333,'',''),
 (6,'Henry Pablod','Ayala','Artes Grafícas Y Audiovisuales',23,'1','Cercado Callao','Sector 8 mz m lote 13','955201758','955201758','hp.vega@hotmail.com','',NULL,'','',NULL,'2017-02-13 07:12:04',NULL,NULL,'digitador@gmail.com',NULL,NULL,'10',NULL,'955201758','955201758','955201758',34333333,'',''),
 (7,'Diana Carolina','Vega Paz','Administración Turismo Y Hotelería',23,'2','Cercado Callao','dddd','','955201758','','1',1,'','',NULL,'2017-02-14 10:35:14',NULL,NULL,'administrador@gmail.com',NULL,NULL,'10',NULL,'','','',33333333,'','');
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;


--
-- Definition of table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE `club` (
  `Codigo_club` int(255) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Precio` decimal(10,2) DEFAULT NULL,
  `Precio_por_Noche` decimal(10,2) DEFAULT NULL,
  `Vigencia` int(2) DEFAULT NULL,
  `Desc_Afiliado` float DEFAULT NULL,
  `Codigo_certificado` int(255) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_club`),
  KEY `fk_club_certificado1_idx` (`Codigo_certificado`),
  CONSTRAINT `fk_club_certificado1` FOREIGN KEY (`Codigo_certificado`) REFERENCES `certificado` (`Codigo_certificado`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

/*!40000 ALTER TABLE `club` DISABLE KEYS */;
INSERT INTO `club` (`Codigo_club`,`Nombre`,`Precio`,`Precio_por_Noche`,`Vigencia`,`Desc_Afiliado`,`Codigo_certificado`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`) VALUES 
 (1,'Club 10','2690.00','269.00',1,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1'),
 (2,'Club 20','4980.00','249.00',2,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1'),
 (3,'Club 30','6570.00','269.00',3,10,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `club` ENABLE KEYS */;


--
-- Definition of table `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE `combo` (
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
  PRIMARY KEY (`Codigo_Combo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `combo`
--

/*!40000 ALTER TABLE `combo` DISABLE KEYS */;
/*!40000 ALTER TABLE `combo` ENABLE KEYS */;


--
-- Definition of table `comision`
--

DROP TABLE IF EXISTS `comision`;
CREATE TABLE `comision` (
  `Codigo` int(255) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(11) DEFAULT NULL,
  `monto` decimal(10,2) DEFAULT NULL,
  `porcentaje` decimal(10,2) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `codigo_anfitrion` varchar(100) DEFAULT NULL,
  `codigo_supervisor_anfitrion` varchar(100) DEFAULT NULL,
  `codigo_jefe_anfitrion` varchar(100) DEFAULT NULL,
  `no_access_closer` varchar(100) DEFAULT NULL,
  `no_access_liner` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comision`
--

/*!40000 ALTER TABLE `comision` DISABLE KEYS */;
/*!40000 ALTER TABLE `comision` ENABLE KEYS */;


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
  `Codigo_venta` int(255) NOT NULL,
  PRIMARY KEY (`Codigo_Contrato`),
  KEY `fk_contrato_venta1_idx` (`Codigo_venta`),
  CONSTRAINT `fk_contrato_venta1` FOREIGN KEY (`Codigo_venta`) REFERENCES `venta` (`Codigo_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contrato`
--

/*!40000 ALTER TABLE `contrato` DISABLE KEYS */;
/*!40000 ALTER TABLE `contrato` ENABLE KEYS */;


--
-- Definition of table `d_factura`
--

DROP TABLE IF EXISTS `d_factura`;
CREATE TABLE `d_factura` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `factura` int(11) NOT NULL,
  `Descripcion` varchar(85) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `Cantidad` int(5) DEFAULT NULL,
  `igv` decimal(10,2) DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Pasaporte` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detalle_factura_factura1_idx` (`factura`),
  CONSTRAINT `fk_detalle_factura_factura1` FOREIGN KEY (`factura`) REFERENCES `factura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_factura`
--

/*!40000 ALTER TABLE `d_factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_factura` ENABLE KEYS */;


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
  `Codigo_venta` int(255) NOT NULL,
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
  PRIMARY KEY (`Codigo_Documento`),
  KEY `fk_documento_venta1_idx` (`Codigo_venta`),
  CONSTRAINT `fk_documento_venta1` FOREIGN KEY (`Codigo_venta`) REFERENCES `venta` (`Codigo_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documento`
--

/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;


--
-- Definition of table `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `Codigo_Cliente` int(11) NOT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Codigo_Combo` int(11) NOT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Subtotal` decimal(10,2) DEFAULT NULL,
  `igv` decimal(10,2) DEFAULT NULL,
  `Total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_factura_cliente1_idx` (`Codigo_Cliente`),
  KEY `fk_factura_producto1_idx` (`Codigo_Combo`),
  CONSTRAINT `fk_factura_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_factura_producto1` FOREIGN KEY (`Codigo_Combo`) REFERENCES `producto` (`Codigo_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `factura`
--

/*!40000 ALTER TABLE `factura` DISABLE KEYS */;
/*!40000 ALTER TABLE `factura` ENABLE KEYS */;


--
-- Definition of table `fecha_asignacion`
--

DROP TABLE IF EXISTS `fecha_asignacion`;
CREATE TABLE `fecha_asignacion` (
  `codigo_asig` int(255) NOT NULL,
  `Fecha_Creada` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(45) DEFAULT NULL,
  `Usuario_Modificado` varchar(45) DEFAULT NULL,
  `Usuario_Eliminado` varchar(45) DEFAULT NULL,
  `Fecha_Llamado` varchar(45) DEFAULT NULL,
  `Estado` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`codigo_asig`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fecha_asignacion`
--

/*!40000 ALTER TABLE `fecha_asignacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `fecha_asignacion` ENABLE KEYS */;


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
 (2,'20','Comisión','1','admin','admin','2017-01-28 07:09:24','2017-01-28 07:14:19'),
 (3,'24','Número correlativo de la Factura','1','administrador@gmail.com',NULL,'2017-02-05 12:29:26',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`,`name`,`parent`,`route`,`order`,`data`) VALUES 
 (4,'Registrar Cliente',NULL,'/cliente/create',1,NULL),
 (5,'Registro de Productos y Servicios',NULL,'/producto/create',2,NULL),
 (6,'Lista de Contratos',NULL,'/contrato/index',3,NULL),
 (8,'Documentos y Cotizaciones',NULL,'/documento/create',4,NULL),
 (10,'Administración',NULL,'/folio/index',5,NULL),
 (11,'Factura',NULL,'/factura/index',6,NULL),
 (12,'Registrar Usuarios',NULL,'/usuario/create',7,NULL),
 (13,'Listas de Usuarios a Cargo',NULL,'/usuario/index',8,NULL),
 (14,'Lista de Cliente',NULL,'/cliente/index',9,NULL),
 (15,'Lista de Productos y Servicios',NULL,'/producto/index',10,NULL),
 (16,'Reportes Generales',NULL,'/reporte/create',19,NULL),
 (17,'Lista de Anfitriones',NULL,'/anfitrion/index',12,NULL),
 (18,'Nuevo Anfitrion',NULL,'/anfitrion/create',13,NULL),
 (19,'Reporte Anfitrion',NULL,'/anfitrion/anfitrion',14,NULL),
 (20,'Lista de Telemarketing',NULL,'/telemarketing/index',15,NULL),
 (21,'Reporte de Telemarketing',NULL,'/telemarketing/telemarketing',16,NULL),
 (22,'Lista de Documentos',NULL,'/documento/index',17,NULL),
 (23,'Asignar Cliente',NULL,'/fecha-asignacion/create',18,NULL),
 (24,'Lista de Clientes',NULL,'/cliente/lista',11,NULL),
 (25,'Comisiones',NULL,'/comision/index',20,NULL),
 (26,'Reportes Confirmados',NULL,'/reporte/confirmador',21,NULL),
 (27,'Reporte General',NULL,'/reporte/supervisor',22,NULL),
 (28,'Clientes Asignados',NULL,'/asig-tlmk-cliente/index',23,NULL),
 (29,'Lista de Cita Concretada',NULL,'/cliente/confirmador',24,NULL),
 (30,'Registrar  Certificado',NULL,'/certificado/index',25,NULL),
 (31,'Registrar  Club',NULL,'/club/index',26,NULL),
 (32,'Registrar  Pasaporte',NULL,'/pasaporte/index',27,NULL),
 (33,'Registrar Ventas',NULL,'/venta/create',28,NULL),
 (34,'Listas de ventas',NULL,'/venta/index',30,NULL);
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
-- Definition of table `pasaporte`
--

DROP TABLE IF EXISTS `pasaporte`;
CREATE TABLE `pasaporte` (
  `Codigo_pasaporte` int(255) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Stock` int(255) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_pasaporte`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasaporte`
--

/*!40000 ALTER TABLE `pasaporte` DISABLE KEYS */;
INSERT INTO `pasaporte` (`Codigo_pasaporte`,`Nombre`,`Stock`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`) VALUES 
 (1,'prueba',123,NULL,NULL,NULL,NULL,NULL,NULL,'1');
/*!40000 ALTER TABLE `pasaporte` ENABLE KEYS */;


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
 (3,'Club 10','2690.00','269.00',1,10,'2017-02-05 12:42:06',NULL,NULL,'administrador@gmail.com',NULL,NULL,'1'),
 (4,'Club 20','4980.00','249.00',2,10,'2017-02-05 12:42:31',NULL,NULL,'administrador@gmail.com',NULL,NULL,'1'),
 (5,'Club 30','6570.00','269.00',3,10,'2017-02-05 12:42:50',NULL,NULL,'administrador@gmail.com',NULL,NULL,'1');
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;


--
-- Definition of table `reporte`
--

DROP TABLE IF EXISTS `reporte`;
CREATE TABLE `reporte` (
  `id` int(11) NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reporte`
--

/*!40000 ALTER TABLE `reporte` DISABLE KEYS */;
/*!40000 ALTER TABLE `reporte` ENABLE KEYS */;


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
-- Definition of table `telemarketing`
--

DROP TABLE IF EXISTS `telemarketing`;
CREATE TABLE `telemarketing` (
  `Codigo` int(255) NOT NULL AUTO_INCREMENT,
  `item` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `profesion` varchar(100) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` int(8) DEFAULT NULL,
  `CodOPC` int(11) DEFAULT NULL,
  `codTLMK` int(11) DEFAULT NULL,
  `observacion` varchar(180) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `telemarketing`
--

/*!40000 ALTER TABLE `telemarketing` DISABLE KEYS */;
/*!40000 ALTER TABLE `telemarketing` ENABLE KEYS */;


--
-- Definition of table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `last_login_at` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `password_reset_token` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificada` datetime DEFAULT NULL,
  `Fecha_Eliminada` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Usuario_Modificado` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Usuario_Eliminado` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Ultima_Sesion` datetime DEFAULT NULL,
  `Codigo_Rol` int(11) DEFAULT NULL,
  `pwdDes` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`,`username`,`email`,`password_hash`,`auth_key`,`confirmed_at`,`unconfirmed_email`,`blocked_at`,`registration_ip`,`created_at`,`updated_at`,`last_login_at`,`status`,`password_reset_token`,`Fecha_Creado`,`Fecha_Modificada`,`Fecha_Eliminada`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Ultima_Sesion`,`Codigo_Rol`,`pwdDes`,`estado`) VALUES 
 (2,'Anfitrión','anfitrion@gmail.com','$2y$10$4W43bly79FLTSQbHp1P4h.pwLENbqgMa0pG2zW0tjniW3XTSBoy2.','3',NULL,NULL,NULL,NULL,NULL,NULL,1487025207,1,NULL,'2017-02-04 12:02:17',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,3,'000000',1),
 (3,'Confirmador','confirmador@gmail.com','$2y$10$02b56s8XaMiFty6Nke7Jd.0gUQiwaXeV8AmoxQVaAcxAf8i0tmtJK','6',NULL,NULL,NULL,NULL,NULL,NULL,1487029997,1,NULL,'2017-02-04 12:03:03',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,6,'000000',1),
 (4,'Digitador','digitador@gmail.com','$2y$10$toj/bcVm1k5rWvkjusao0uQqGbGm0lhjTObYcIDPjtfQWPAppMHI.','1',NULL,NULL,NULL,NULL,NULL,NULL,1487129739,1,NULL,'2017-02-04 12:03:17','2017-02-05 04:08:59',NULL,'Administrador@gmail.com','',NULL,NULL,1,'000000',1),
 (5,'Director de mercadeo','directordemercadeo@gmail.com','$2y$10$WJ6qAGwGSUbomruQ/5q/ourvVJNHuUBTE/zie3I1oHUBDa0yDL36i','4',NULL,NULL,NULL,NULL,NULL,NULL,1487024640,1,NULL,'2017-02-04 12:03:41',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,4,'000000',1),
 (6,'Director de proyecto','directordeproyecto@gmail.com','$2y$10$CMwjk2IIdcQXTf9650qN5.hjnKB5NF7ke/dvwVAx5b74YFmVrxAHi','13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2017-02-04 12:04:04',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,13,'000000',1),
 (7,'Gerente General','gerentegeneral@gmail.com','$2y$10$Ws.srv2sXVLKm01ZWp2IWO8Wu3BTP2zausRipERyWjR1QdKSpsqAS','14',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2017-02-04 12:04:22',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,14,'000000',1),
 (8,'Jefe de contratos','jefedecontratos@gmail.com','$2y$10$6C8/g5ysmpH/CBscKRJT1.OpmsMLy0HgWx5yh20HCHPga6qoXfKxm','10',NULL,NULL,NULL,NULL,NULL,NULL,1487121658,1,NULL,'2017-02-04 12:09:37',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,10,'000000',1),
 (9,'Jefe de sala','jefedesala@gmail.com','$2y$10$HRWnViObpuk4EVRj.t3lcuwNtaFt4g.L7DsTvrlz1ngXQhI1Tu/di','11',NULL,NULL,NULL,NULL,NULL,NULL,1486239038,1,NULL,'2017-02-04 12:09:51',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,11,'000000',1),
 (10,'Jefe de ventas','jefedeventas@gmail.com','$2y$10$8vQXXg065aLY6ty9hEz78uxQIGeFJgnwJP1h7ABijQ/Al37QZPFmu','12',NULL,NULL,NULL,NULL,NULL,NULL,1486335616,1,NULL,'2017-02-04 12:10:11','2017-02-04 01:58:19',NULL,'Administrador@gmail.com','',NULL,NULL,12,'000000',1),
 (11,'No access closer','noaccessclose@gmail.com','$2y$10$o7b5tl7JkF6R5RAe42wmOO3InqHvYll4FJBIIdzvfUNv68wvOjpOS','9',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2017-02-04 12:10:34',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,9,'000000',1),
 (12,'No access liner','noaccesslines@gmail.com','$2y$10$xIPYZ3ioc.WFytshxx0lbe.oPk6.f48fPqESJFbMRbqD4zGHM1K/C','8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2017-02-04 12:11:19',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,8,'000000',1),
 (13,'Supervisor','supervisor@gmail.com','$2y$10$B.V7k3PpIw1qkINxauIKxeGpKaZ98N2PVeDZJGI.6Dh50MkSBiUJK','2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,'2017-02-04 12:11:35',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,2,'000000',1),
 (14,'Supervisora de telemarketing','supervisoradetelemasrketing@gmail.com','$2y$10$xJje1OwTmm8rLHcC3IcrOuoPwYvQi4fyd5OeqExxdn5Av6n95bSTq','7',NULL,NULL,NULL,NULL,NULL,NULL,1486920786,1,NULL,'2017-02-04 12:12:01',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,7,'000000',1),
 (15,'Telemarketing','telemarketing@gmail.com','$2y$10$l3fsDDawa5VDpbcfCrw4a.XKuP4Kx.Ur7fI47lmCVCDW6lzZe0DEe','5',NULL,NULL,NULL,NULL,NULL,NULL,1486329301,1,NULL,'2017-02-04 12:12:20',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,5,'000000',1),
 (16,'Administrador','administrador@gmail.com','$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6','20',NULL,NULL,NULL,NULL,NULL,NULL,1487129656,1,NULL,'2017-02-04 12:13:56',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,20,'000000',1),
 (17,'Supervisor Promotor','supervisordepromotor@gmail.com','$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6','15',NULL,NULL,NULL,NULL,NULL,NULL,1486703860,1,NULL,'2017-02-11 19:45:26',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,15,'000000',1),
 (18,'Jefe Promotor','jefepromotor@gmail.com','$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6','16',NULL,NULL,NULL,NULL,NULL,NULL,1486703860,1,NULL,'2017-02-11 19:45:26',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,16,'000000',1),
 (19,'Director de Telemarketing','directordetelemarketing@gmail.com','$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6','17',NULL,NULL,NULL,NULL,NULL,NULL,1486915487,1,NULL,'2017-02-11 19:45:26',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,17,'000000',1),
 (20,'Director de Planemiento y Administracion','directordeplaneamientoyadministracion@gmail.com','$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6','18',NULL,NULL,NULL,NULL,NULL,NULL,1486703860,1,NULL,'2017-02-12 02:43:59',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,18,'000000',1),
 (21,'Director Comercial','directorcomercial@gmail.com','$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6','19',NULL,NULL,NULL,NULL,NULL,NULL,1486889469,1,NULL,'2017-02-12 02:44:56',NULL,NULL,'Administrador@gmail.com',NULL,NULL,NULL,19,'000000',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


--
-- Definition of table `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE `venta` (
  `Codigo_venta` int(255) NOT NULL,
  `Codigo_club` int(255) NOT NULL,
  `Codigo_Cliente` int(11) NOT NULL,
  `medio_pago` int(1) DEFAULT NULL,
  `Estado_pago` int(1) DEFAULT NULL,
  `porcentaje_pagado` int(3) DEFAULT NULL,
  `cod_barra_pasaporte` varchar(45) DEFAULT NULL,
  `cod_barra_pasaporte_manual` varchar(45) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` int(1) DEFAULT NULL,
  `Factura_emitida` int(1) DEFAULT NULL,
  `Codigo_pasaporte` int(255) DEFAULT NULL,
  PRIMARY KEY (`Codigo_venta`),
  KEY `fk_venta_cliente1_idx` (`Codigo_Cliente`),
  KEY `fk_venta_club1_idx` (`Codigo_club`),
  CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_venta_club1` FOREIGN KEY (`Codigo_club`) REFERENCES `club` (`Codigo_club`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `venta`
--

/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` (`Codigo_venta`,`Codigo_club`,`Codigo_Cliente`,`medio_pago`,`Estado_pago`,`porcentaje_pagado`,`cod_barra_pasaporte`,`cod_barra_pasaporte_manual`,`Fecha_Creado`,`Fecha_Modificado`,`Fecha_Eliminado`,`Usuario_Creado`,`Usuario_Modificado`,`Usuario_Eliminado`,`Estado`,`Factura_emitida`,`Codigo_pasaporte`) VALUES 
 (1,0,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
 (2,1,1,0,0,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1),
 (3,1,1,0,1,23,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1),
 (4,2,6,0,1,100,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1),
 (5,1,1,1,1,20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,1);
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;


--
-- Definition of procedure `Actualizar_Folio_Factura`
--

DROP PROCEDURE IF EXISTS `Actualizar_Folio_Factura`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Actualizar_Folio_Factura`()
BEGIN

    DECLARE correlativo INT;

    SELECT Valor
    INTO correlativo
    FROM folio
    WHERE Codigo_Folio = 3;
    
    UPDATE folio
    SET Valor = correlativo + 1
    WHERE Codigo_Folio = 3;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `Asignar_AU`
--

DROP PROCEDURE IF EXISTS `Asignar_AU`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Asignar_AU`()
BEGIN

    DECLARE v_Cliente INT(99);
    DECLARE v_Usuario INT(99);

    -- Cantidad de clientes
    SELECT count(*) AS Cantidad_Cliente
    INTO v_Cliente
    FROM cliente;

    -- Cantidad de Usuario
    SELECT count(*) AS Cantidad_Usuario
    INTO v_Usuario
    FROM user
    WHERE auth_key = 5 and estado = 2 and status = 1;


  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `Confirmar`
--

DROP PROCEDURE IF EXISTS `Confirmar`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Confirmar`(
  IN Codigo INT
)
BEGIN

    UPDATE cliente
    SET Estado = '11'
    WHERE Codigo_Cliente = Codigo;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `Delete_Beneficiario`
--

DROP PROCEDURE IF EXISTS `Delete_Beneficiario`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Delete_Beneficiario`(
  IN Codigo INT
)
BEGIN

    DELETE FROM beneficiario
    WHERE Codigo_Cliente = Codigo;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `Delete_Factura`
--

DROP PROCEDURE IF EXISTS `Delete_Factura`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Delete_Factura`(
  IN Codigo INT
)
BEGIN

    DELETE FROM d_factura
    WHERE factura = Codigo;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `Estado_Cliente`
--

DROP PROCEDURE IF EXISTS `Estado_Cliente`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Estado_Cliente`(
  IN Codigo INT
)
BEGIN

    DECLARE v_CodCliente VARCHAR(20);
    DECLARE fin INTEGER DEFAULT 0;

    DECLARE ActualizarEstado_cursor CURSOR FOR
      SELECT Codigo_Cliente
      FROM asig_tlmk_cliente
      WHERE codigo_asig = Codigo;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin = 1;

    OPEN ActualizarEstado_cursor;
    GET_ActualizarEstado_cursor:

    LOOP FETCH ActualizarEstado_cursor
    INTO v_CodCliente;
      IF fin = 1
      THEN
        LEAVE GET_ActualizarEstado_cursor;
      END IF;

      UPDATE cliente
      SET Estado = 9
      WHERE Codigo_Cliente = v_CodCliente;

    END LOOP GET_ActualizarEstado_cursor;
    CLOSE ActualizarEstado_cursor;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `Factura`
--

DROP PROCEDURE IF EXISTS `Factura`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Factura`(
  IN Codigo INT
)
BEGIN

    DECLARE var_cantidad INT(5);
    DECLARE var_precio DECIMAL(10, 2);
    DECLARE var_total DECIMAL(10, 2);
    DECLARE var_pasaporte INT(2);
    DECLARE conf_igv INT;
    DECLARE pro_cantidad INT(1);
    DECLARE pro_descripcion VARCHAR(150);
    DECLARE pro_precio DECIMAL(10, 2);
    DECLARE cli_codigo INT(11);
    DECLARE cli_direccion VARCHAR(50);

    SELECT Valor
    INTO conf_igv
    FROM folio
    WHERE Codigo_Folio = 1;

    SET pro_cantidad = 1;

    SELECT
      f.Codigo_Combo   AS Pasaporte,
      f.Codigo_Cliente AS Cliente
    INTO var_pasaporte, cli_codigo
    FROM factura f
    WHERE f.id = Codigo;

    SELECT
      Nombre,
      Precio
    INTO pro_descripcion, pro_precio
    FROM producto
    WHERE Codigo_Producto = var_pasaporte;

    INSERT INTO d_factura (
      factura,
      Descripcion,
      precio,
      Cantidad,
      igv,
      Subtotal,
      Total,
      Fecha_Creado,
      Estado,
      Pasaporte)
    VALUES (
      Codigo,
      pro_descripcion,
      pro_precio,
      pro_cantidad,
      ((pro_precio * pro_cantidad) * (conf_igv / 100)),
      ((pro_precio * pro_cantidad) - ((pro_precio * pro_cantidad) * (conf_igv / 100))),
      (pro_precio * pro_cantidad),
      now(),
      1,
      var_pasaporte);

    UPDATE d_factura
    SET
      igv          = ((precio * Cantidad) * (conf_igv / 100)),
      Subtotal     = ((precio * Cantidad) - ((precio * Cantidad) * (conf_igv / 100))),
      Total        = (precio * Cantidad),
      Fecha_Creado = NOW()
    WHERE factura = Codigo;

    SELECT
      sum(df.Cantidad)               AS Cantidad,
      sum(df.precio)                 AS Precio,
      sum((df.Cantidad * df.precio)) AS Total
    INTO var_cantidad, var_precio, var_total
    FROM factura f
      INNER JOIN d_factura df ON f.id = df.factura
    WHERE f.id = Codigo;

    SELECT Distrito
    INTO cli_direccion
    FROM cliente
    WHERE Codigo_Cliente = cli_codigo;

    UPDATE factura
    SET
      direccion = cli_direccion,
      Subtotal  = (var_total - (var_total * (conf_igv / 100))),
      igv       = var_total * (conf_igv / 100),
      Total     = var_total
    WHERE id = Codigo;

  END $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
