-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-02-2017 a las 21:22:17
-- Versión del servidor: 5.6.33-cll-lve
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `groupg12_rustica`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `Actualizar_Folio_Factura`$$
CREATE DEFINER=`groupg12`@`localhost` PROCEDURE `Actualizar_Folio_Factura`()
BEGIN

    DECLARE correlativo INT;

    SELECT Valor
    INTO correlativo
    FROM folio
    WHERE Codigo_Folio = 3;

    UPDATE folio
    SET Valor = correlativo + 1
    WHERE Codigo_Folio = 3;

  END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anfitrion`
--

DROP TABLE IF EXISTS `anfitrion`;
CREATE TABLE IF NOT EXISTS `anfitrion` (
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
-- Volcado de datos para la tabla `anfitrion`
--

INSERT INTO `anfitrion` (`Codigo`, `Nombre`, `Apellido`, `DNI`, `Edad`, `Cargo`, `Telefono_Casa`, `Telefono_Celular`, `Turno`, `Descanso`, `Encargado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`, `Fecha_Creado`) VALUES
(3, 'Henry Pablo', 'Vega Ayala', 48429679, 23, 'Desarrollador', '955201758', '955201758', '0', '2', NULL, '2017-02-05 07:21:57', '2017-02-05 07:12:29', 'administrador@gmail.com', 'administrador@gmail.com', 'administrador@gmail.com', '0', '2017-02-05 07:05:44'),
(4, 'Henry Pablo', 'Ayala', 4, 23, 's', '955201758', '955201758', '0', '0', '1', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1', '2017-02-05 08:03:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Administrador', '16', 1486228622),
('Anfitrión', '2', 1486332873),
('Digitador', '17', NULL),
('Digitador', '4', 1486328978),
('Jefe de contratos', '8', 1486329542),
('Jefe de ventas', '10', 1486330473),
('Supervisor', '13', 1486330278),
('Supervisora de telemarketing', '14', 1486357921),
('Supervisora de telemarketing', '17', NULL),
('Telemarketing', '15', 1486329343);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/anfitrion/*', 2, NULL, NULL, NULL, 1486337931, 1486337931),
('/anfitrion/anfitrion', 2, NULL, NULL, NULL, 1486342782, 1486342782),
('/anfitrion/create', 2, NULL, NULL, NULL, 1486337931, 1486337931),
('/anfitrion/delete', 2, NULL, NULL, NULL, 1486337931, 1486337931),
('/anfitrion/index', 2, NULL, NULL, NULL, 1486337931, 1486337931),
('/anfitrion/update', 2, NULL, NULL, NULL, 1486337931, 1486337931),
('/anfitrion/view', 2, NULL, NULL, NULL, 1486337931, 1486337931),
('/cliente/create', 2, NULL, NULL, NULL, 1486089269, 1486089269),
('/cliente/index', 2, NULL, NULL, NULL, 1486241913, 1486241913),
('/contrato/*', 2, NULL, NULL, NULL, 1486090127, 1486090127),
('/contrato/contrato', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/contrato/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/documento/create', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/documento/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/documento/update', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/documento/view', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/factura/factura', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/factura/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/folio/create', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/folio/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/folio/update', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/folio/view', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/producto/create', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/producto/delete', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/producto/index', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/producto/update', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/producto/view', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/reporte/create', 2, NULL, NULL, NULL, 1486314032, 1486314032),
('/telemarketing/create', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/telemarketing/index', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/telemarketing/telemarketing', 2, NULL, NULL, NULL, 1486089278, 1486089278),
('/user/admin/index', 2, NULL, NULL, NULL, 1486090324, 1486090324),
('/user/create', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/user/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/user/update', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/user/view', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/usuario/*', 2, NULL, NULL, NULL, 1486244259, 1486244259),
('/usuario/create', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/usuario/delete', 2, NULL, NULL, NULL, 1486244259, 1486244259),
('/usuario/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/usuario/update', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('/usuario/view', 2, NULL, NULL, NULL, 1485299786, 1485299786),
('Administrador', 1, NULL, 'Test Rule', NULL, 1485300051, 1486097070),
('Anfitrión', 1, NULL, 'Test Rule', NULL, 1485265640, 1485265640),
('Confirmador', 1, NULL, 'Test Rule', NULL, 1485265777, 1485265777),
('Digitador', 1, NULL, 'Test Rule', NULL, 1485265739, 1486329016),
('Director de mercadeo', 1, NULL, 'Test Rule', NULL, 1485265754, 1485265754),
('Director de proyecto', 1, NULL, 'Test Rule', NULL, 1485266367, 1485266367),
('Gerente General', 1, NULL, 'Test Rule', NULL, 1485266379, 1485266379),
('Jefe de contratos', 1, NULL, 'Test Rule', NULL, 1485265848, 1485265848),
('Jefe de sala', 1, NULL, 'Test Rule', NULL, 1485265874, 1485265874),
('Jefe de ventas', 1, NULL, 'Test Rule', NULL, 1485266346, 1485266346),
('No access closer', 1, NULL, 'Test Rule', NULL, 1485265827, 1485265827),
('No access liner', 1, NULL, 'Test Rule', NULL, 1485265812, 1485265812),
('Supervisor', 1, NULL, 'Test Rule', NULL, 1485265655, 1485265655),
('Supervisora de telemarketing', 1, NULL, 'Test Rule', NULL, 1485265800, 1485265800),
('Telemarketing', 1, NULL, 'Test Rule', NULL, 1485265766, 1485265766);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Administrador', '/anfitrion/*'),
('Administrador', '/anfitrion/anfitrion'),
('Administrador', '/anfitrion/create'),
('Administrador', '/anfitrion/delete'),
('Administrador', '/anfitrion/index'),
('Anfitrión', '/anfitrion/index'),
('Administrador', '/anfitrion/update'),
('Administrador', '/anfitrion/view'),
('Administrador', '/cliente/create'),
('Digitador', '/cliente/create'),
('Administrador', '/cliente/index'),
('Digitador', '/cliente/index'),
('Supervisora de telemarketing', '/cliente/index'),
('Telemarketing', '/cliente/index'),
('Administrador', '/contrato/*'),
('Administrador', '/contrato/contrato'),
('Jefe de contratos', '/contrato/contrato'),
('Administrador', '/contrato/index'),
('Jefe de contratos', '/contrato/index'),
('Administrador', '/documento/create'),
('Administrador', '/documento/index'),
('Administrador', '/documento/update'),
('Administrador', '/documento/view'),
('Administrador', '/factura/factura'),
('Administrador', '/factura/index'),
('Administrador', '/folio/create'),
('Administrador', '/folio/index'),
('Administrador', '/folio/update'),
('Administrador', '/folio/view'),
('Administrador', '/producto/create'),
('Administrador', '/producto/delete'),
('Administrador', '/producto/index'),
('Administrador', '/producto/update'),
('Administrador', '/producto/view'),
('Administrador', '/reporte/create'),
('Jefe de ventas', '/reporte/create'),
('Administrador', '/telemarketing/create'),
('Administrador', '/telemarketing/index'),
('Administrador', '/telemarketing/telemarketing'),
('Administrador', '/user/admin/index'),
('Administrador', '/user/create'),
('Administrador', '/user/index'),
('Administrador', '/user/update'),
('Administrador', '/user/view'),
('Administrador', '/usuario/*'),
('Administrador', '/usuario/create'),
('Jefe de contratos', '/usuario/create'),
('Jefe de sala', '/usuario/create'),
('Jefe de ventas', '/usuario/create'),
('Supervisora de telemarketing', '/usuario/create'),
('Administrador', '/usuario/delete'),
('Administrador', '/usuario/index'),
('Jefe de contratos', '/usuario/index'),
('Jefe de sala', '/usuario/index'),
('Jefe de ventas', '/usuario/index'),
('Supervisor', '/usuario/index'),
('Administrador', '/usuario/update'),
('Administrador', '/usuario/view');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('Administrador', 'O:15:"app\\rbac\\MyRule":3:{s:4:"name";s:13:"Administrador";s:9:"createdAt";i:1486097040;s:9:"updatedAt";i:1486097040;}', 1486097040, 1486097040),
('Test Rule', 'O:15:"app\\rbac\\MyRule":3:{s:4:"name";s:9:"Test Rule";s:9:"createdAt";i:1485265539;s:9:"updatedAt";i:1485265615;}', 1485265539, 1485265615);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrera`
--

DROP TABLE IF EXISTS `carrera`;
CREATE TABLE IF NOT EXISTS `carrera` (
  `codigo` int(3) DEFAULT NULL,
  `Nombre` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrera`
--

INSERT INTO `carrera` (`codigo`, `Nombre`) VALUES
(1, 'Administración'),
(2, 'Negocios Internacionales'),
(3, 'Administración Turismo Y Hotelería'),
(4, 'Alimentación  Y Bebcodigoa'),
(5, 'Arquitectura Y Construcción'),
(6, 'Arquitectura Interiores'),
(7, 'Artes Del Espectáculo'),
(8, 'Artes Grafícas Y Audiovisuales'),
(9, 'Artesanías'),
(10, 'Asistente De Gerencia / Secretariado'),
(11, 'Aviación Comercial'),
(12, 'Bar'),
(13, 'Bellas Artes'),
(14, 'Bibliotecología'),
(15, 'Bienes Raices'),
(16, 'Cajero / Promotor De Servicios'),
(17, 'Chef'),
(18, 'Ciencias'),
(19, 'Ciencias De La Comunicación'),
(20, 'Ciencias Físicas'),
(21, 'Ciencias Politicas'),
(22, 'Ciencias Sociales Y Del Comportamiento'),
(23, 'Comercio Exterior'),
(24, 'Computación E Informática'),
(25, 'Comunicación Audiovisual'),
(26, 'Comunicación Social'),
(27, 'Contabilcodigoad'),
(28, 'Cuero Y Calzado'),
(29, 'Deporte Y Recreación'),
(30, 'Derecho'),
(31, 'Dibujo Arquitectónico'),
(32, 'Dibujo De Construcción Civil'),
(33, 'Dibujo, Pintura Y Escultura'),
(34, 'Dirección Y Realización De Cine Y Tv'),
(35, 'Diseño De Interiores'),
(36, 'Diseño Gráfico'),
(37, 'Diseño Modas'),
(38, 'Diseño Web'),
(39, 'Economía'),
(40, 'Edificaciones'),
(41, 'Edificaciones'),
(42, 'Eduación Secundaria'),
(43, 'Educación Especial'),
(44, 'Educación Física'),
(45, 'Educación codigoiomas'),
(46, 'Educación Inicial'),
(47, 'Educación Militar'),
(48, 'Educación Primaria'),
(49, 'Electriccodigoad Y Electrónica'),
(50, 'Enfermería'),
(51, 'Escribania'),
(52, 'Estética E Imagen Personal'),
(53, 'Finanzas Y Banca'),
(54, 'Formación De Personal Docente'),
(55, 'Fotografía'),
(56, 'Gastronomía'),
(57, 'Género'),
(58, 'Guía Oficial De Turismo'),
(59, 'Hoteleria'),
(60, 'Humancodigoades'),
(61, 'Información Insuficiente O No Especificada'),
(62, 'Informática'),
(63, 'Ingeniería Acuícola'),
(64, 'Ingeniería Agrónoma'),
(65, 'Ingeniería Ambiental'),
(66, 'Ingeniería Biotecnológica'),
(67, 'Ingeniería Civil'),
(68, 'Ingeniería De Sistemas'),
(69, 'Ingeniería De Soncodigoo'),
(70, 'Ingeniería De Transporte'),
(71, 'Ingeniería Eléctrica'),
(72, 'Ingeniería Electrónica'),
(73, 'Ingeniería En Energía'),
(74, 'Ingeniería En Higiene Y Segurcodigoad Industrial'),
(75, 'Ingeniería Forestal'),
(76, 'Ingeniería Geográfica'),
(77, 'Ingeniería Geológica'),
(78, 'Ingeniería Industrial'),
(79, 'Ingenieria De Alimentos'),
(80, 'Ingeniería Mecánica'),
(81, 'Ingeniería Metalúrgica'),
(82, 'Ingeniería Naval'),
(83, 'Ingeniería Pesquera'),
(84, 'Ingeniería Química'),
(85, 'Ingeniería Telecomunicaciones'),
(86, 'Ingeniería Textil'),
(87, 'Madera'),
(88, 'Mantenimiento De Vehículos'),
(89, 'Maquillaje Profesional'),
(90, 'Marketing'),
(91, 'Matemática Y Estadistica'),
(92, 'Medicina'),
(93, 'Medios Digitales'),
(94, 'Metal – Mecánica'),
(95, 'Música'),
(96, 'Negociación Colectiva'),
(97, 'Nutrición'),
(98, 'Obstetricia'),
(99, 'Odontología'),
(100, 'Otras Industrias'),
(101, 'Otras Profesiones Afines'),
(102, 'Otros'),
(103, 'Otros Servicios Personales'),
(104, 'Pastelería'),
(105, 'Periodismo'),
(106, 'Psicología Clínica'),
(107, 'Psicología Educativa'),
(108, 'Psicología Organizacional'),
(109, 'Psicología Social O Comunitaria'),
(110, 'Publiccodigoad'),
(111, 'Radiodifusión'),
(112, 'Relaciones Internacionales'),
(113, 'Relaciones Institucionales'),
(114, 'Relaciones Industriales'),
(115, 'Recursos Humanos'),
(116, 'Servicios A La Producción'),
(117, 'Servicios De Salud'),
(118, 'Servicios De Transporte'),
(119, 'Servicios Sociales'),
(120, 'Sociología'),
(121, 'Tecnología'),
(122, 'Tecnologías De Información'),
(123, 'Tecnólogo'),
(124, 'Teleoperador'),
(125, 'Textiles Y Confección De Vestimenta'),
(126, 'Topografía'),
(127, 'Trabajo Social'),
(128, 'Traductor'),
(129, 'Turismo'),
(130, 'Urbanismo'),
(131, 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
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
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Codigo_Cliente`, `Nombre`, `Apellido`, `Profesion`, `Edad`, `Estado_Civil`, `Distrito`, `Direccion`, `Telefono_Casa`, `Telefono_Celular`, `Email`, `Traslado`, `Tarjeta_De_Credito`, `Promotor`, `Local`, `Observacion`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
(1, 'Henry Pablo', 'Vega ayala', 'Ingeniería De Sistemas', 23, '0', 'San Juan De Miraflores', NULL, '012802886', '955201758', 'hp.vega@hotmai.com', '0', 0, '', '', NULL, '2017-02-05 03:56:43', '2017-02-05 04:08:48', NULL, 'digitador@gmail.com', 'digitador@gmail.com', NULL, '1'),
(2, 'Diana Carolina', 'Vega Paz', 'Administración', 20, '0', 'Villa María Del Triunfo', NULL, '', '989377268', '', '0', 1, '', '', NULL, '2017-02-05 03:58:06', NULL, NULL, 'digitador@gmail.com', NULL, NULL, '1'),
(3, 'ANDRES', 'SANCHEZ LINARES', 'INGENIERO CIVIL', 35, '2', 'SAN MIGUEL', NULL, '017394568', '987456321', 'asanchez@demo.com', '0', 0, 'MOISES', 'T-CENTRO CIVICO', NULL, '2017-02-06 11:47:09', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE IF NOT EXISTS `combo` (
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
-- Volcado de datos para la tabla `combo`
--

INSERT INTO `combo` (`Codigo_Combo`, `Nombre`, `Precio`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
(1, '1', '1.00', NULL, NULL, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

DROP TABLE IF EXISTS `contrato`;
CREATE TABLE IF NOT EXISTS `contrato` (
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
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`Codigo_Contrato`, `Nombre`, `Apellidos`, `Titular`, `Esposo`, `Dni_1`, `Dni_2`, `Estado_Civil_1`, `Estado_Civil_2`, `Domicilio_1`, `Domicilio_2`, `Ocupacion_1`, `Ocupacion_2`, `Monto_Pagado`, `Saldos`, `N_cuotas`, `causas`, `Penalizacion`, `Formas`, `Monto_devol`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
(1, '2', '2', '22', '2', 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_factura`
--

DROP TABLE IF EXISTS `d_factura`;
CREATE TABLE IF NOT EXISTS `d_factura` (
  `id` int(222) NOT NULL AUTO_INCREMENT,
  `factura` int(11) NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `fk_detalle_factura_factura1_idx` (`factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

DROP TABLE IF EXISTS `distrito`;
CREATE TABLE IF NOT EXISTS `distrito` (
  `codigo` int(3) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`codigo`, `descripcion`) VALUES
(1, 'Ate'),
(2, 'Barranco'),
(3, 'Bellavista'),
(4, 'Breña'),
(5, 'Carmen De La Legua'),
(6, 'Cercado Callao'),
(7, 'Cercado De Lima'),
(8, 'Chorrillos'),
(9, 'Comas'),
(10, 'El Agustino'),
(11, 'Independencia'),
(12, 'Jesús María'),
(13, 'La Molina'),
(14, 'La Perla'),
(15, 'La Punta'),
(16, 'La Victoria'),
(17, 'Lince'),
(18, 'Los Olivos'),
(19, 'Magdalena Del Mar'),
(20, 'Miraflores'),
(21, 'Pueblo Libre'),
(22, 'Puente Piedra'),
(23, 'Rimac'),
(24, 'San Borja'),
(25, 'San Iscodigoro'),
(26, 'San Juan De Lurigancho'),
(27, 'San Juan De Miraflores'),
(28, 'San Luis'),
(29, 'San Martin De Porres'),
(30, 'San Miguel'),
(31, 'Santa Anita'),
(32, 'Santa Rosa'),
(33, 'Santiago De Surco'),
(34, 'Surquillo'),
(35, 'Ventanilla'),
(36, 'Villa El Savador'),
(37, 'Villa María Del Triunfo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

DROP TABLE IF EXISTS `documento`;
CREATE TABLE IF NOT EXISTS `documento` (
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
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`Codigo_Documento`, `Nombre`, `archivo`, `extension`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Eliminado`, `Usuario_Modificado`, `Estado`, `Fecha_Creado`) VALUES
(1, 'pdf', 'pdf201701290103.pdf', NULL, NULL, '2017-01-29 03:23:40', 'admin', 'admin', NULL, '0', '2017-01-29 01:03:47'),
(2, 'imagen', 'imagen201701290105.png', NULL, NULL, '2017-01-29 03:23:43', 'admin', 'admin', NULL, '0', '2017-01-29 01:05:31'),
(3, 'sad', 'sad201701290105.pdf', NULL, NULL, NULL, 'admin', NULL, NULL, '1', '2017-01-29 01:05:43'),
(4, 'asdsad', 'asdsad_201701290106.pdf', NULL, NULL, NULL, 'admin', NULL, NULL, '1', '2017-01-29 01:06:54'),
(5, 'SFSDF', 'SFSDF_201701290107.png', NULL, NULL, NULL, 'admin', NULL, NULL, '1', '2017-01-29 01:07:20'),
(6, 'ASDASD', 'ASDASD_201701290107.pdf', NULL, NULL, NULL, 'admin', NULL, NULL, '1', '2017-01-29 01:07:31'),
(7, '00030', '00030_7-201701290324.png', 'png', '2017-01-29 03:24:28', NULL, 'admin', NULL, 'admin', '1', '2017-01-29 01:22:10'),
(8, 'prueba de imagen', 'prueba_8-201702040210.png', 'png', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, '1', '2017-02-04 02:10:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id` int(11) NOT NULL,
  `Codigo_Cliente` int(11) NOT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  `Codigo_Combo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_factura_cliente1_idx` (`Codigo_Cliente`),
  KEY `fk_factura_producto1_idx` (`Codigo_Combo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `Codigo_Cliente`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`, `Codigo_Combo`) VALUES
(13, 3, '2017-02-07 02:49:15', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folio`
--

DROP TABLE IF EXISTS `folio`;
CREATE TABLE IF NOT EXISTS `folio` (
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
-- Volcado de datos para la tabla `folio`
--

INSERT INTO `folio` (`Codigo_Folio`, `Valor`, `Descripcion`, `Estado`, `Usuario_Creado`, `Usuario_Modificado`, `Fecha_Creada`, `Fecha_Modificada`) VALUES
(1, '17', 'IGV', '1', NULL, 'admin', '2017-01-28 07:07:37', '2017-01-28 07:11:23'),
(2, '20', 'Comisión', '1', 'admin', 'admin', '2017-01-28 07:09:24', '2017-01-28 07:14:19'),
(3, '13', 'Número correlativo de la Factura', '1', 'administrador@gmail.com', NULL, '2017-02-05 12:29:26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_upload`
--

DROP TABLE IF EXISTS `log_upload`;
CREATE TABLE IF NOT EXISTS `log_upload` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
(4, 'Registrar Cliente', NULL, '/cliente/create', 1, NULL),
(5, 'Registro de Productos y Servicios', NULL, '/producto/create', 1, NULL),
(6, 'Lista de Contratos', NULL, '/contrato/index', 4, NULL),
(8, 'Documentos y Cotizaciones', NULL, '/documento/create', 4, NULL),
(10, 'Administración', NULL, '/folio/index', 6, NULL),
(11, 'Factura', NULL, '/factura/index', 4, NULL),
(12, 'Registrar Usuarios', NULL, '/usuario/create', 10, NULL),
(13, 'Listas de Usuarios a Cargo', NULL, '/usuario/index', 10, NULL),
(14, 'Lista de Cliente', NULL, '/cliente/index', 9, NULL),
(15, 'Lista de Productos y Servicios', NULL, '/producto/index', 10, NULL),
(16, 'Reportes Generales', NULL, '/reporte/create', 13, NULL),
(17, 'Lista de Anfitriones', NULL, '/anfitrion/index', 16, NULL),
(18, 'Nuevo Anfitrion', NULL, '/anfitrion/create', 17, NULL),
(19, 'Reporte Anfitrion', NULL, '/anfitrion/anfitrion', 14, NULL),
(20, 'Lista de Telemarketing', NULL, '/telemarketing/index', 15, NULL),
(21, 'Reporte de Telemarketing', NULL, '/telemarketing/telemarketing', 16, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1485218586),
('m140209_132017_init', 1485218592),
('m140403_174025_create_account_table', 1485218592),
('m140504_113157_update_tables', 1485218592),
('m140504_130429_create_token_table', 1485218592),
('m140830_171933_fix_ip_field', 1485218592),
('m140830_172703_change_account_table_name', 1485218592),
('m141222_110026_update_ip_field', 1485218592),
('m141222_135246_alter_username_length', 1485218592),
('m150614_103145_update_social_account_table', 1485218592),
('m150623_212711_fix_username_notnull', 1485218592),
('m151218_234654_add_timezone_to_profile', 1485218592),
('m160929_103127_add_last_login_at_to_user_table', 1485218592),
('m140602_111327_create_menu_table', 1485220751),
('m160312_050000_create_user', 1485220751);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
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
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Codigo_Producto`, `Nombre`, `Precio`, `Precio_por_Noche`, `Vigencia`, `Desc_Afiliado`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
(1, 'Club 10', '2690.00', '269.00', 1, 10, '2017-01-28 08:20:54', '2017-01-28 08:39:27', '2017-01-28 08:54:07', 'admin', 'admin', 'admin', '0'),
(2, '', NULL, NULL, NULL, NULL, '2017-01-28 09:00:15', NULL, '2017-02-05 12:42:09', 'admin', NULL, 'administrador@gmail.com', '0'),
(3, 'Club 10', '2690.00', '269.00', 1, 10, '2017-02-05 12:42:06', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1'),
(4, 'Club 20', '4980.00', '249.00', 2, 10, '2017-02-05 12:42:31', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1'),
(5, 'Club 30', '6570.00', '269.00', 3, 10, '2017-02-05 12:42:50', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1'),
(6, 'PASAPORTE 10 NOCHES', '2669.00', '266.90', 1, 15, '2017-02-06 11:49:15', '2017-02-06 11:49:50', NULL, 'administrador@gmail.com', 'administrador@gmail.com', NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

DROP TABLE IF EXISTS `reporte`;
CREATE TABLE IF NOT EXISTS `reporte` (
  `id` int(11) NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dynagrid`
--

DROP TABLE IF EXISTS `tbl_dynagrid`;
CREATE TABLE IF NOT EXISTS `tbl_dynagrid` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid setting identifier',
  `filter_id` varchar(100) DEFAULT NULL COMMENT 'Filter setting identifier',
  `sort_id` varchar(100) DEFAULT NULL COMMENT 'Sort setting identifier',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid configuration',
  PRIMARY KEY (`id`),
  KEY `tbl_dynagrid_FK1` (`filter_id`),
  KEY `tbl_dynagrid_FK2` (`sort_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_dynagrid_dtl`
--

DROP TABLE IF EXISTS `tbl_dynagrid_dtl`;
CREATE TABLE IF NOT EXISTS `tbl_dynagrid_dtl` (
  `id` varchar(100) NOT NULL COMMENT 'Unique dynagrid detail setting identifier',
  `category` varchar(10) NOT NULL COMMENT 'Dynagrid detail setting category "filter" or "sort"',
  `name` varchar(150) NOT NULL COMMENT 'Name to identify the dynagrid detail setting',
  `data` varchar(5000) DEFAULT NULL COMMENT 'Json encoded data for the dynagrid detail configuration',
  `dynagrid_id` varchar(100) NOT NULL COMMENT 'Related dynagrid identifier',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tbl_dynagrid_dtl_UK1` (`name`,`category`,`dynagrid_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telemarketing`
--

DROP TABLE IF EXISTS `telemarketing`;
CREATE TABLE IF NOT EXISTS `telemarketing` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
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
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `last_login_at`, `status`, `password_reset_token`, `Fecha_Creado`, `Fecha_Modificada`, `Fecha_Eliminada`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Ultima_Sesion`, `Codigo_Rol`, `pwdDes`, `estado`) VALUES
(2, 'Anfitrión', 'anfitrion@gmail.com', '$2y$10$4W43bly79FLTSQbHp1P4h.pwLENbqgMa0pG2zW0tjniW3XTSBoy2.', '3', NULL, NULL, NULL, NULL, NULL, NULL, 1486229207, 1, NULL, '2017-02-04 12:02:17', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 3, '000000', 1),
(3, 'Confirmador', 'confirmador@gmail.com', '$2y$10$02b56s8XaMiFty6Nke7Jd.0gUQiwaXeV8AmoxQVaAcxAf8i0tmtJK', '6', NULL, NULL, NULL, NULL, NULL, NULL, 1486228376, 1, NULL, '2017-02-04 12:03:03', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 6, '000000', 1),
(4, 'Digitador', 'digitador@gmail.com', '$2y$10$toj/bcVm1k5rWvkjusao0uQqGbGm0lhjTObYcIDPjtfQWPAppMHI.', '1', NULL, NULL, NULL, NULL, NULL, NULL, 1486333044, 1, NULL, '2017-02-04 12:03:17', '2017-02-05 04:08:59', NULL, 'Administrador@gmail.com', 'digitador@gmail.com', NULL, NULL, 1, '000000', 1),
(5, 'Director de mercadeo', 'directordemercadeo@gmail.com', '$2y$10$WJ6qAGwGSUbomruQ/5q/ourvVJNHuUBTE/zie3I1oHUBDa0yDL36i', '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:03:41', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 4, '000000', 1),
(6, 'Director de proyecto', 'directordeproyecto@gmail.com', '$2y$10$CMwjk2IIdcQXTf9650qN5.hjnKB5NF7ke/dvwVAx5b74YFmVrxAHi', '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:04:04', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 13, '000000', 1),
(7, 'Gerente General', 'gerentegeneral@gmail.com', '$2y$10$Ws.srv2sXVLKm01ZWp2IWO8Wu3BTP2zausRipERyWjR1QdKSpsqAS', '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:04:22', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 14, '000000', 1),
(8, 'Jefe de contratos', 'jefedecontratos@gmail.com', '$2y$10$6C8/g5ysmpH/CBscKRJT1.OpmsMLy0HgWx5yh20HCHPga6qoXfKxm', '10', NULL, NULL, NULL, NULL, NULL, NULL, 1486331357, 1, NULL, '2017-02-04 12:09:37', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 10, '000000', 1),
(9, 'Jefe de sala', 'jefedesala@gmail.com', '$2y$10$HRWnViObpuk4EVRj.t3lcuwNtaFt4g.L7DsTvrlz1ngXQhI1Tu/di', '11', NULL, NULL, NULL, NULL, NULL, NULL, 1486239038, 1, NULL, '2017-02-04 12:09:51', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 11, '000000', 1),
(10, 'Jefe de ventas', 'jefedeventas@gmail.com', '$2y$10$8vQXXg065aLY6ty9hEz78uxQIGeFJgnwJP1h7ABijQ/Al37QZPFmu', '12', NULL, NULL, NULL, NULL, NULL, NULL, 1486335616, 1, NULL, '2017-02-04 12:10:11', '2017-02-04 01:58:19', NULL, 'Administrador@gmail.com', 'jefedeventas@gmail.com', NULL, NULL, 12, '000000', 1),
(11, 'No access closer', 'noaccessclose@gmail.com', '$2y$10$o7b5tl7JkF6R5RAe42wmOO3InqHvYll4FJBIIdzvfUNv68wvOjpOS', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:10:34', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 9, '000000', 1),
(12, 'No access liner', 'noaccesslines@gmail.com', '$2y$10$xIPYZ3ioc.WFytshxx0lbe.oPk6.f48fPqESJFbMRbqD4zGHM1K/C', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:11:19', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 8, '000000', 1),
(13, 'Supervisor', 'supervisor@gmail.com', '$2y$10$B.V7k3PpIw1qkINxauIKxeGpKaZ98N2PVeDZJGI.6Dh50MkSBiUJK', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:11:35', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 2, '000000', 1),
(14, 'Supervisora de telemarketing', 'supervisoradetelemasrketing@gmail.com', '$2y$10$xJje1OwTmm8rLHcC3IcrOuoPwYvQi4fyd5OeqExxdn5Av6n95bSTq', '7', NULL, NULL, NULL, NULL, NULL, NULL, 1486358373, 1, NULL, '2017-02-04 12:12:01', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 7, '000000', 1),
(15, 'Telemarketing', 'telemarketing@gmail.com', '$2y$10$l3fsDDawa5VDpbcfCrw4a.XKuP4Kx.Ur7fI47lmCVCDW6lzZe0DEe', '5', NULL, NULL, NULL, NULL, NULL, NULL, 1486358303, 1, NULL, '2017-02-04 12:12:20', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 5, '000000', 1),
(16, 'Administrador', 'administrador@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '20', NULL, NULL, NULL, NULL, NULL, NULL, 1486496234, 1, NULL, '2017-02-04 12:13:56', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 20, '000000', 1),
(17, 'PATRICIA ', 'p.mini@rusticaclub.com', '$2y$10$mDNq74j/oDKjSEydGAdjP.kzNsfJU9Ge1/YjxEmyjJmtuvtJwIKD.', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-06 11:53:01', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 7, 'demo12345', 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `d_factura`
--
ALTER TABLE `d_factura`
  ADD CONSTRAINT `fk_detalle_factura_factura1` FOREIGN KEY (`factura`) REFERENCES `factura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `fk_factura_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_factura_producto1` FOREIGN KEY (`Codigo_Combo`) REFERENCES `producto` (`Codigo_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;