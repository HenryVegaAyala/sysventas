-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 14-02-2017 a las 19:58:12
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

drop DATABASE sis_crm;
CREATE DATABASE sis_crm;
USE sis_crm;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `Actualizar_Folio_Factura`$$
CREATE  PROCEDURE `Actualizar_Folio_Factura`()
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

DROP PROCEDURE IF EXISTS `Asignar_AU`$$
CREATE  PROCEDURE `Asignar_AU`()
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


  END$$

DROP PROCEDURE IF EXISTS `Confirmar`$$
CREATE  PROCEDURE `Confirmar`(
  IN Codigo INT
)
  BEGIN

    UPDATE cliente
    SET Estado = '11'
    WHERE Codigo_Cliente = Codigo;

  END$$

DROP PROCEDURE IF EXISTS `Delete_Beneficiario`$$
CREATE  PROCEDURE `Delete_Beneficiario`(
  IN Codigo INT
)
  BEGIN

    DELETE FROM beneficiario
    WHERE Codigo_Cliente = Codigo;

  END$$

DROP PROCEDURE IF EXISTS `Delete_Factura`$$
CREATE  PROCEDURE `Delete_Factura`(
  IN Codigo INT
)
  BEGIN

    DELETE FROM d_factura
    WHERE factura = Codigo;

  END$$

DROP PROCEDURE IF EXISTS `Estado_Cliente`$$
CREATE  PROCEDURE `Estado_Cliente`(
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

  END$$

DROP PROCEDURE IF EXISTS `Factura`$$
CREATE  PROCEDURE `Factura`(
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
-- Truncar tablas antes de insertar `anfitrion`
--

TRUNCATE TABLE `anfitrion`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_tlmk_cliente`
--

DROP TABLE IF EXISTS `asig_tlmk_cliente`;
CREATE TABLE IF NOT EXISTS `asig_tlmk_cliente` (
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
  KEY `fk_asig_tlmk_cliente_user1_idx` (`Codigo_Usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Truncar tablas antes de insertar `asig_tlmk_cliente`
--

TRUNCATE TABLE `asig_tlmk_cliente`;
--
-- Volcado de datos para la tabla `asig_tlmk_cliente`
--

INSERT INTO `asig_tlmk_cliente` (`codigo_asig`, `codigo_tlmk_cliente`, `Codigo_Usuario`, `Codigo_Cliente`, `Fecha_Creada`, `Fecha_Modificada`, `Fecha_Eliminada`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Fecha_Llamado`, `Estado`) VALUES
  (1, 35, 27, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (1, 36, 27, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (1, 37, 27, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Truncar tablas antes de insertar `auth_assignment`
--

TRUNCATE TABLE `auth_assignment`;
--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
  ('Administrador', '16', 1486840433),
  ('Anfitrión', '2', 1486858823),
  ('Confirmador', '26', NULL),
  ('Confirmador', '3', 1486939658),
  ('Digitador', '22', NULL),
  ('Digitador', '30', NULL),
  ('Digitador', '4', 1486852629),
  ('Director Comercial', '21', 1486885651),
  ('Director Comercial', '28', NULL),
  ('Director de mercadeo', '23', NULL),
  ('Director de mercadeo', '5', 1486877704),
  ('Director de Planemiento y Administracion', '20', 1486885640),
  ('Director de Telemarketing', '19', 1486885627),
  ('Director de Telemarketing', '24', NULL),
  ('Jefe de contratos', '29', NULL),
  ('Jefe de contratos', '8', 1487029857),
  ('Jefe Promotor', '18', 1486861308),
  ('No access closer', '11', 1486876850),
  ('No access liner', '12', 1486877048),
  ('Supervisor Promotor', '17', 1486862527),
  ('Supervisora de telemarketing', '14', 1486921402),
  ('Supervisora de telemarketing', '25', NULL),
  ('Telemarketing', '27', NULL);

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
-- Truncar tablas antes de insertar `auth_item`
--

TRUNCATE TABLE `auth_item`;
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
  ('/asig-tlmk-cliente/*', 2, NULL, NULL, NULL, 1486785732, 1486785732),
  ('/asig-tlmk-cliente/create', 2, NULL, NULL, NULL, 1486785732, 1486785732),
  ('/asig-tlmk-cliente/delete', 2, NULL, NULL, NULL, 1486785732, 1486785732),
  ('/asig-tlmk-cliente/index', 2, NULL, NULL, NULL, 1486785732, 1486785732),
  ('/asig-tlmk-cliente/update', 2, NULL, NULL, NULL, 1486785732, 1486785732),
  ('/asig-tlmk-cliente/view', 2, NULL, NULL, NULL, 1486785732, 1486785732),
  ('/certificado/*', 2, NULL, NULL, NULL, 1486956356, 1486956356),
  ('/certificado/create', 2, NULL, NULL, NULL, 1486956356, 1486956356),
  ('/certificado/delete', 2, NULL, NULL, NULL, 1486956356, 1486956356),
  ('/certificado/index', 2, NULL, NULL, NULL, 1486956356, 1486956356),
  ('/certificado/update', 2, NULL, NULL, NULL, 1486956356, 1486956356),
  ('/certificado/view', 2, NULL, NULL, NULL, 1486956356, 1486956356),
  ('/cliente/*', 2, NULL, NULL, NULL, 1486877658, 1486877658),
  ('/cliente/confirmador', 2, NULL, NULL, NULL, 1486939633, 1486939633),
  ('/cliente/create', 2, NULL, NULL, NULL, 1486089269, 1486089269),
  ('/cliente/delete', 2, NULL, NULL, NULL, 1486877658, 1486877658),
  ('/cliente/index', 2, NULL, NULL, NULL, 1486241913, 1486241913),
  ('/cliente/lista', 2, NULL, NULL, NULL, 1486852916, 1486852916),
  ('/cliente/update', 2, NULL, NULL, NULL, 1486877658, 1486877658),
  ('/cliente/view', 2, NULL, NULL, NULL, 1486877658, 1486877658),
  ('/club/*', 2, NULL, NULL, NULL, 1486956366, 1486956366),
  ('/club/create', 2, NULL, NULL, NULL, 1486956366, 1486956366),
  ('/club/delete', 2, NULL, NULL, NULL, 1486956366, 1486956366),
  ('/club/index', 2, NULL, NULL, NULL, 1486956366, 1486956366),
  ('/club/update', 2, NULL, NULL, NULL, 1486956366, 1486956366),
  ('/club/view', 2, NULL, NULL, NULL, 1486956366, 1486956366),
  ('/comision/*', 2, NULL, NULL, NULL, 1486856976, 1486856976),
  ('/comision/index', 2, NULL, NULL, NULL, 1486856974, 1486856974),
  ('/comision/view', 2, NULL, NULL, NULL, 1486856974, 1486856974),
  ('/contrato/*', 2, NULL, NULL, NULL, 1486090127, 1486090127),
  ('/contrato/contrato', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/contrato/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/documento/create', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/documento/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/documento/update', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/documento/view', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/factura/factura', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/factura/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/fecha-asignacion/*', 2, NULL, NULL, NULL, 1486837996, 1486837996),
  ('/fecha-asignacion/create', 2, NULL, NULL, NULL, 1486837995, 1486837995),
  ('/fecha-asignacion/delete', 2, NULL, NULL, NULL, 1486837996, 1486837996),
  ('/fecha-asignacion/index', 2, NULL, NULL, NULL, 1486837995, 1486837995),
  ('/fecha-asignacion/update', 2, NULL, NULL, NULL, 1486837996, 1486837996),
  ('/fecha-asignacion/view', 2, NULL, NULL, NULL, 1486837995, 1486837995),
  ('/folio/create', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/folio/index', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/folio/update', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/folio/view', 2, NULL, NULL, NULL, 1485299786, 1485299786),
  ('/pasaporte/*', 2, NULL, NULL, NULL, 1486956376, 1486956376),
  ('/pasaporte/create', 2, NULL, NULL, NULL, 1486956376, 1486956376),
  ('/pasaporte/delete', 2, NULL, NULL, NULL, 1486956376, 1486956376),
  ('/pasaporte/index', 2, NULL, NULL, NULL, 1486956376, 1486956376),
  ('/pasaporte/update', 2, NULL, NULL, NULL, 1486956376, 1486956376),
  ('/pasaporte/view', 2, NULL, NULL, NULL, 1486956376, 1486956376),
  ('/producto/create', 2, NULL, NULL, NULL, 1486089278, 1486089278),
  ('/producto/delete', 2, NULL, NULL, NULL, 1486089278, 1486089278),
  ('/producto/index', 2, NULL, NULL, NULL, 1486089278, 1486089278),
  ('/producto/update', 2, NULL, NULL, NULL, 1486089278, 1486089278),
  ('/producto/view', 2, NULL, NULL, NULL, 1486089278, 1486089278),
  ('/reporte/*', 2, NULL, NULL, NULL, 1486921183, 1486921183),
  ('/reporte/confirmador', 2, NULL, NULL, NULL, 1486886815, 1486886815),
  ('/reporte/create', 2, NULL, NULL, NULL, 1486314032, 1486314032),
  ('/reporte/supervisor', 2, NULL, NULL, NULL, 1486921296, 1486921296),
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
  ('/venta/*', 2, NULL, NULL, NULL, 1486956386, 1486956386),
  ('/venta/create', 2, NULL, NULL, NULL, 1486956386, 1486956386),
  ('/venta/delete', 2, NULL, NULL, NULL, 1486956386, 1486956386),
  ('/venta/index', 2, NULL, NULL, NULL, 1486956386, 1486956386),
  ('/venta/update', 2, NULL, NULL, NULL, 1486956386, 1486956386),
  ('/venta/view', 2, NULL, NULL, NULL, 1486956386, 1486956386),
  ('Administrador', 1, NULL, 'Test Rule', NULL, 1485300051, 1486097070),
  ('Anfitrión', 1, NULL, 'Test Rule', NULL, 1485265640, 1485265640),
  ('Confirmador', 1, NULL, 'Test Rule', NULL, 1485265777, 1485265777),
  ('Digitador', 1, NULL, 'Test Rule', NULL, 1485265739, 1486329016),
  ('Director Comercial', 1, NULL, 'Test Rule', NULL, 1486885605, 1486885605),
  ('Director de mercadeo', 1, NULL, 'Test Rule', NULL, 1485265754, 1485265754),
  ('Director de Planemiento y Administracion', 1, NULL, 'Test Rule', NULL, 1486885593, 1486885593),
  ('Director de proyecto', 1, NULL, 'Test Rule', NULL, 1485266367, 1485266367),
  ('Director de Telemarketing', 1, NULL, 'Test Rule', NULL, 1486885540, 1486885540),
  ('Gerente General', 1, NULL, 'Test Rule', NULL, 1485266379, 1485266379),
  ('Jefe de contratos', 1, NULL, 'Test Rule', NULL, 1485265848, 1485265848),
  ('Jefe de sala', 1, NULL, 'Test Rule', NULL, 1485265874, 1485265874),
  ('Jefe de ventas', 1, NULL, 'Test Rule', NULL, 1485266346, 1485266346),
  ('Jefe Promotor', 1, NULL, 'Test Rule', NULL, 1486861071, 1486861071),
  ('No access closer', 1, NULL, 'Test Rule', NULL, 1485265827, 1485265827),
  ('No access liner', 1, NULL, 'Test Rule', NULL, 1485265812, 1485265812),
  ('Supervisor', 1, NULL, 'Test Rule', NULL, 1485265655, 1485265655),
  ('Supervisor Promotor', 1, NULL, 'Test Rule', NULL, 1486861102, 1486862514),
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
-- Truncar tablas antes de insertar `auth_item_child`
--

TRUNCATE TABLE `auth_item_child`;
--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
  ('Administrador', '/anfitrion/*'),
  ('Administrador', '/anfitrion/anfitrion'),
  ('Administrador', '/anfitrion/create'),
  ('Administrador', '/anfitrion/delete'),
  ('Administrador', '/anfitrion/index'),
  ('Administrador', '/anfitrion/update'),
  ('Administrador', '/anfitrion/view'),
  ('Administrador', '/asig-tlmk-cliente/*'),
  ('Administrador', '/asig-tlmk-cliente/create'),
  ('Administrador', '/asig-tlmk-cliente/delete'),
  ('Administrador', '/asig-tlmk-cliente/index'),
  ('Telemarketing', '/asig-tlmk-cliente/index'),
  ('Administrador', '/asig-tlmk-cliente/update'),
  ('Administrador', '/asig-tlmk-cliente/view'),
  ('Administrador', '/certificado/*'),
  ('Administrador', '/certificado/create'),
  ('Administrador', '/certificado/delete'),
  ('Administrador', '/certificado/index'),
  ('Administrador', '/certificado/update'),
  ('Administrador', '/certificado/view'),
  ('Confirmador', '/cliente/confirmador'),
  ('Jefe de contratos', '/cliente/confirmador'),
  ('Administrador', '/cliente/create'),
  ('Digitador', '/cliente/create'),
  ('Director de mercadeo', '/cliente/create'),
  ('Jefe de contratos', '/cliente/create'),
  ('Administrador', '/cliente/index'),
  ('Director de mercadeo', '/cliente/index'),
  ('Jefe de contratos', '/cliente/index'),
  ('Digitador', '/cliente/lista'),
  ('Telemarketing', '/cliente/lista'),
  ('Director de mercadeo', '/cliente/update'),
  ('Jefe de contratos', '/cliente/update'),
  ('Director de mercadeo', '/cliente/view'),
  ('Jefe de contratos', '/cliente/view'),
  ('Administrador', '/club/*'),
  ('Administrador', '/club/create'),
  ('Administrador', '/club/delete'),
  ('Administrador', '/club/index'),
  ('Administrador', '/club/update'),
  ('Administrador', '/club/view'),
  ('Administrador', '/comision/index'),
  ('Anfitrión', '/comision/index'),
  ('Jefe Promotor', '/comision/index'),
  ('No access closer', '/comision/index'),
  ('No access liner', '/comision/index'),
  ('Supervisor Promotor', '/comision/index'),
  ('Anfitrión', '/comision/view'),
  ('Jefe Promotor', '/comision/view'),
  ('No access closer', '/comision/view'),
  ('No access liner', '/comision/view'),
  ('Supervisor Promotor', '/comision/view'),
  ('Administrador', '/contrato/*'),
  ('Administrador', '/contrato/contrato'),
  ('Administrador', '/contrato/index'),
  ('Administrador', '/documento/create'),
  ('Administrador', '/documento/index'),
  ('Administrador', '/documento/update'),
  ('Administrador', '/documento/view'),
  ('Administrador', '/factura/factura'),
  ('Administrador', '/factura/index'),
  ('Administrador', '/fecha-asignacion/*'),
  ('Administrador', '/fecha-asignacion/create'),
  ('Director de Telemarketing', '/fecha-asignacion/create'),
  ('Administrador', '/fecha-asignacion/delete'),
  ('Administrador', '/fecha-asignacion/index'),
  ('Administrador', '/fecha-asignacion/update'),
  ('Administrador', '/fecha-asignacion/view'),
  ('Administrador', '/folio/create'),
  ('Administrador', '/folio/index'),
  ('Administrador', '/folio/update'),
  ('Administrador', '/folio/view'),
  ('Administrador', '/pasaporte/*'),
  ('Administrador', '/pasaporte/create'),
  ('Administrador', '/pasaporte/delete'),
  ('Administrador', '/pasaporte/index'),
  ('Administrador', '/pasaporte/update'),
  ('Administrador', '/pasaporte/view'),
  ('Director de Telemarketing', '/reporte/confirmador'),
  ('Administrador', '/reporte/create'),
  ('Director de mercadeo', '/reporte/create'),
  ('Director de Telemarketing', '/reporte/create'),
  ('Jefe de ventas', '/reporte/create'),
  ('Supervisora de telemarketing', '/reporte/supervisor'),
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
  ('Jefe de sala', '/usuario/create'),
  ('Jefe de ventas', '/usuario/create'),
  ('Administrador', '/usuario/delete'),
  ('Administrador', '/usuario/index'),
  ('Jefe de sala', '/usuario/index'),
  ('Jefe de ventas', '/usuario/index'),
  ('Supervisor', '/usuario/index'),
  ('Administrador', '/usuario/update'),
  ('Administrador', '/usuario/view'),
  ('Administrador', '/venta/*'),
  ('Administrador', '/venta/create'),
  ('Jefe de contratos', '/venta/create'),
  ('Administrador', '/venta/delete'),
  ('Administrador', '/venta/index'),
  ('Jefe de contratos', '/venta/index'),
  ('Administrador', '/venta/update'),
  ('Administrador', '/venta/view');

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
-- Truncar tablas antes de insertar `auth_rule`
--

TRUNCATE TABLE `auth_rule`;
--
-- Volcado de datos para la tabla `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
  ('Administrador', 'O:15:"app\\rbac\\MyRule":3:{s:4:"name";s:13:"Administrador";s:9:"createdAt";i:1486097040;s:9:"updatedAt";i:1486097040;}', 1486097040, 1486097040),
  ('Test Rule', 'O:15:"app\\rbac\\MyRule":3:{s:4:"name";s:9:"Test Rule";s:9:"createdAt";i:1485265539;s:9:"updatedAt";i:1485265615;}', 1485265539, 1485265615);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficiario`
--

DROP TABLE IF EXISTS `beneficiario`;
CREATE TABLE IF NOT EXISTS `beneficiario` (
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
  KEY `fk_beneficiario_cliente1_idx` (`Codigo_Cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Truncar tablas antes de insertar `beneficiario`
--

TRUNCATE TABLE `beneficiario`;
--
-- Volcado de datos para la tabla `beneficiario`
--

INSERT INTO `beneficiario` (`Codigo_Cliente`, `Codigo_Beneficiario`, `Nombre`, `Apellido`, `Profesion`, `Edad`, `Estado_Civil`, `Distrito`, `Direccion`, `Telefono_Casa`, `Telefono_Celular`, `Email`, `Traslado`, `Tarjeta_De_Credito`, `Promotor`, `Local`, `Observacion`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
  (3, 21, 'ADRIANA', 'LUNA PIZARRO', NULL, 32, '0', NULL, NULL, '0123456789', '987456321', 'adriana@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (4, 22, 'ANTHONY ', 'PECEROS', NULL, 30, '1', NULL, NULL, '', '', 'a.peceros@sgconta.com.pe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
  (6, 23, '', '', NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Truncar tablas antes de insertar `carrera`
--

TRUNCATE TABLE `carrera`;
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
-- Estructura de tabla para la tabla `certificado`
--

DROP TABLE IF EXISTS `certificado`;
CREATE TABLE IF NOT EXISTS `certificado` (
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
  KEY `fk_certificado_pasaporte1_idx` (`Codigo_pasaporte_afiliado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `certificado`
--

TRUNCATE TABLE `certificado`;
--
-- Volcado de datos para la tabla `certificado`
--

INSERT INTO `certificado` (`Codigo_certificado`, `Nombre`, `Vigencia`, `Precio`, `Stock`, `Codigo_pasaporte_afiliado`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
  (1, 'NOCHE RUSTICA CLUB', NULL, NULL, 1500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1');

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
  `Estado` char(2) DEFAULT NULL COMMENT 'Estados\n0 = Inactivo\n1 = Activo\n2 = Cita Concretada\n3 = Cita Pendiente\n4 = N/Q\n5 = N/I\n6 = D/F\n7 = N/C\n8 = Apagado\n--------------------\n9  = Asignado\n10 = No Asignado\n11 = Confirmado\n12 = No Confirmado\n--------------------\nAgendado\n3 - 7 - 8 - 10\n \n',
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
-- Truncar tablas antes de insertar `cliente`
--

TRUNCATE TABLE `cliente`;
--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Codigo_Cliente`, `Nombre`, `Apellido`, `Profesion`, `Edad`, `Estado_Civil`, `Distrito`, `Direccion`, `Telefono_Casa`, `Telefono_Celular`, `Email`, `Traslado`, `Tarjeta_De_Credito`, `Promotor`, `Local`, `Observacion`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`, `Agendado`, `Telefono_Casa2`, `Telefono_Celular2`, `Telefono_Celular3`, `dni`, `Super_Promotor`, `Jefe_Promotor`) VALUES
  (1, 'LUISA', 'AREVALO LOPEZ', 'Ciencias De La Comunicación', 26, '3', 'Breña', 'AV. TINGOMARIA 857', '017392654', '996634129', 'luisa@gmail.com', '1', 0, '', '', NULL, '2017-02-13 04:12:59', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '11', '0000-00-00 00:00:00', '013256478', '987456123', '978546312', 46712337, '', ''),
  (2, 'LUISA', 'AREAVALO LOPEZ', 'Ciencias De La Comunicación', 26, '3', 'Breña', 'AV. BREÑA 586 ', '12345675', '', 'luisa@gmail.com', '1', 0, '', '', NULL, '2017-02-13 04:18:59', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '3', '0000-00-00 00:00:00', '013254656', '', '', 45678912, '', ''),
  (3, 'LUISA', 'AREAVALO LOPEZ', 'Ciencias De La Comunicación', 26, '3', 'Breña', 'AV. BREÑA 586 ', '12345675', '', 'luisa@gmail.com', '1', 0, '', '', NULL, '2017-02-13 04:20:03', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '10', NULL, '013254656', '', '', 45678912, '', ''),
  (4, 'CRISTIAN ', 'CARLOS', 'Ingeniería De Sistemas', 35, '2', 'La Perla', 'Jr Union', '4175645', '', 'c.carlos@sgconta.com.pe', '1', 0, '', '', NULL, '2017-02-13 05:09:09', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '11', '0000-00-00 00:00:00', '', '981054221', '', 40955211, '', ''),
  (5, 'JIM VINCE', 'MALCA BASULTO', 'Administración', 24, '0', 'Cercado De Lima', 'LIMA CERCADO', '', '983320324', 'malcabasulto.92@hotmail.com', '1', 0, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 12:14:28', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', ''),
  (6, 'JUAN ANTONIO', 'VILLAREYES REYES', 'NSS', 29, '0', 'S.M.P', 'S.M.P', '3824669', '', '', '0', 0, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 12:27:18', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '987542623', '', '', 0, 'DANIELA ESPINAR', ''),
  (7, 'DULCE SHEYLA', 'CHOQUE ALVARADO ', 'NSS', 22, '0', 'S.J.L', 'S.J.L', '', '978075447', 'sugarlays@gmail.com', '1', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 12:41:32', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', ''),
  (8, 'ELVITA', 'HIDALGO', 'NSS', 24, '0', 'S.M.P', 'S.M.P', '3078154', '92650171', '', '1', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 12:43:50', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', ''),
  (9, 'ABRAHAM CLAUDIO', 'CALDERON  CRISOSTOMO', 'NSS', 32, '0', 'La Victoria', 'LA VICTORIA ', '', '997594231', '', '1', 0, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 12:52:14', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', ''),
  (10, 'HELIO ', 'ESPINOZA MARTINEZ', 'NSS', 40, '2', 'Ate', 'ATE', '', '975513360', '', '', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 12:56:19', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (11, 'MERY ', 'MARROQUIN LAPA', 'NSS', 26, '0', 'Santa Anita', 'SANTA ANITA', '', '957324175', '', '1', 0, '29282', 'CENTRO CIVICO', NULL, '2017-02-14 01:03:28', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (12, 'HERNAN RICHARD ', 'PAREDES MAMANI', 'NSS', 43, '1', 'El Agustino', 'AGUSTINO', '', '9431273236', '', '', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 01:05:40', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (13, 'EDUARDO ', 'CAJAVILCA', 'NSS', 34, '0', 'CHOSICA', 'CHOSICA', '', '961438114', 'ecajavilcam@gmail.com', '1', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 02:15:41', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (14, 'JORGE LUIS ', 'GALLARDO BARBOZA ', 'NSS', 32, '0', 'Miraflores', 'MIRAFLORES', '', '', '', '0', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 02:18:04', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (15, 'SAMY  DANIEL', 'LOPEZ RIBBECK', 'NSS', 25, '0', 'RIMAC', 'RIMAC', '', '986500840', '', '0', NULL, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 02:22:33', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (16, 'FRANK  ROBERT ', 'COSME OROPEZA ', 'NSS', 30, '0', 'Santa Anita', 'SANTA ANITA', '3628835', '987246454', '', '1', 0, 'WENDY ORTEGA', 'CENTRO CIVICO', NULL, '2017-02-14 02:26:37', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, 'DANIELA ESPINAR', 'ABIGAIL'),
  (17, 'ARNALDO ', 'NAVARRO  CHIROQUE', 'NSS', 37, '0', 'San Juan De Lurigancho', 'S.J.L', '', '984319963', 'contratista.navarro@hotmail.com', '', NULL, '', '', NULL, '2017-02-14 02:35:00', NULL, NULL, 'j.rodriguez@rusticaclub.com', NULL, NULL, '10', NULL, '', '', '', 0, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
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
  KEY `fk_club_certificado1_idx` (`Codigo_certificado`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `club`
--

TRUNCATE TABLE `club`;
--
-- Volcado de datos para la tabla `club`
--

INSERT INTO `club` (`Codigo_club`, `Nombre`, `Precio`, `Precio_por_Noche`, `Vigencia`, `Desc_Afiliado`, `Codigo_certificado`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
  (1, 'CLUB 10', '2699.00', '269.90', 1, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1'),
  (2, 'CLUB 20', '4899.00', '489.90', 2, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1'),
  (3, 'CLUB 30', '6790.00', '248.00', 3, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1');

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
-- Truncar tablas antes de insertar `combo`
--

TRUNCATE TABLE `combo`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comision`
--

DROP TABLE IF EXISTS `comision`;
CREATE TABLE IF NOT EXISTS `comision` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Truncar tablas antes de insertar `comision`
--

TRUNCATE TABLE `comision`;
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
-- Truncar tablas antes de insertar `contrato`
--

TRUNCATE TABLE `contrato`;
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
-- Truncar tablas antes de insertar `distrito`
--

TRUNCATE TABLE `distrito`;
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
-- Truncar tablas antes de insertar `documento`
--

TRUNCATE TABLE `documento`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_factura`
--

DROP TABLE IF EXISTS `d_factura`;
CREATE TABLE IF NOT EXISTS `d_factura` (
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
  KEY `fk_detalle_factura_factura1_idx` (`factura`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

--
-- Truncar tablas antes de insertar `d_factura`
--

TRUNCATE TABLE `d_factura`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
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
  KEY `fk_factura_producto1_idx` (`Codigo_Combo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `factura`
--

TRUNCATE TABLE `factura`;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha_asignacion`
--

DROP TABLE IF EXISTS `fecha_asignacion`;
CREATE TABLE IF NOT EXISTS `fecha_asignacion` (
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
-- Truncar tablas antes de insertar `fecha_asignacion`
--

TRUNCATE TABLE `fecha_asignacion`;
--
-- Volcado de datos para la tabla `fecha_asignacion`
--

INSERT INTO `fecha_asignacion` (`codigo_asig`, `Fecha_Creada`, `Fecha_Modificada`, `Fecha_Eliminada`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Fecha_Llamado`, `Estado`) VALUES
  (1, '2017-02-13 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
-- Truncar tablas antes de insertar `folio`
--

TRUNCATE TABLE `folio`;
--
-- Volcado de datos para la tabla `folio`
--

INSERT INTO `folio` (`Codigo_Folio`, `Valor`, `Descripcion`, `Estado`, `Usuario_Creado`, `Usuario_Modificado`, `Fecha_Creada`, `Fecha_Modificada`) VALUES
  (1, '17', 'IGV', '1', NULL, 'admin', '2017-01-28 07:07:37', '2017-01-28 07:11:23'),
  (2, '20', 'Comisión', '1', 'admin', 'admin', '2017-01-28 07:09:24', '2017-01-28 07:14:19'),
  (3, '22', 'Número correlativo de la Factura', '1', 'administrador@gmail.com', NULL, '2017-02-05 12:29:26', NULL);

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

--
-- Truncar tablas antes de insertar `log_upload`
--

TRUNCATE TABLE `log_upload`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Truncar tablas antes de insertar `menu`
--

TRUNCATE TABLE `menu`;
--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id`, `name`, `parent`, `route`, `order`, `data`) VALUES
  (4, 'Registrar Cliente', NULL, '/cliente/create', 1, NULL),
  (5, 'Registro de Productos y Servicios', NULL, '/producto/create', 2, NULL),
  (6, 'Lista de Contratos', NULL, '/contrato/index', 3, NULL),
  (8, 'Documentos y Cotizaciones', NULL, '/documento/create', 4, NULL),
  (10, 'Administración', NULL, '/folio/index', 5, NULL),
  (11, 'Factura', NULL, '/factura/index', 6, NULL),
  (12, 'Registrar Usuarios', NULL, '/usuario/create', 7, NULL),
  (13, 'Listas de Usuarios a Cargo', NULL, '/usuario/index', 8, NULL),
  (14, 'Lista de Cliente', NULL, '/cliente/index', 9, NULL),
  (15, 'Lista de Productos y Servicios', NULL, '/producto/index', 10, NULL),
  (16, 'Reportes Generales', NULL, '/reporte/create', 19, NULL),
  (17, 'Lista de Anfitriones', NULL, '/anfitrion/index', 12, NULL),
  (18, 'Nuevo Anfitrion', NULL, '/anfitrion/create', 13, NULL),
  (19, 'Reporte Anfitrion', NULL, '/anfitrion/anfitrion', 14, NULL),
  (20, 'Lista de Telemarketing', NULL, '/telemarketing/index', 15, NULL),
  (21, 'Reporte de Telemarketing', NULL, '/telemarketing/telemarketing', 16, NULL),
  (22, 'Lista de Documentos', NULL, '/documento/index', 17, NULL),
  (23, 'Asignar Cliente', NULL, '/fecha-asignacion/create', 18, NULL),
  (24, 'Lista de Clientes', NULL, '/cliente/lista', 11, NULL),
  (25, 'Comisiones', NULL, '/comision/index', 20, NULL),
  (26, 'Reportes Confirmados', NULL, '/reporte/confirmador', 21, NULL),
  (27, 'Reporte General', NULL, '/reporte/supervisor', 22, NULL),
  (28, 'Clientes Asignados', NULL, '/asig-tlmk-cliente/index', 23, NULL),
  (29, 'Lista de Cita Concretada', NULL, '/cliente/confirmador', 24, NULL),
  (30, 'Registrar  Certificado', NULL, '/certificado/index', 25, NULL),
  (31, 'Registrar  Club', NULL, '/club/index', 26, NULL),
  (32, 'Registrar  Pasaporte', NULL, '/pasaporte/index', 27, NULL),
  (33, 'Registrar Ventas', NULL, '/venta/create', 28, NULL),
  (34, 'Listas de ventas', NULL, '/venta/index', 30, NULL);

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
-- Truncar tablas antes de insertar `migration`
--

TRUNCATE TABLE `migration`;
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
-- Estructura de tabla para la tabla `pasaporte`
--

DROP TABLE IF EXISTS `pasaporte`;
CREATE TABLE IF NOT EXISTS `pasaporte` (
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
-- Truncar tablas antes de insertar `pasaporte`
--

TRUNCATE TABLE `pasaporte`;
--
-- Volcado de datos para la tabla `pasaporte`
--

INSERT INTO `pasaporte` (`Codigo_pasaporte`, `Nombre`, `Stock`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
  (1, 'PASAPORTE VACACIONES SOÑADAS', 100, NULL, NULL, NULL, NULL, NULL, NULL, '1');

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
-- Truncar tablas antes de insertar `producto`
--

TRUNCATE TABLE `producto`;
--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`Codigo_Producto`, `Nombre`, `Precio`, `Precio_por_Noche`, `Vigencia`, `Desc_Afiliado`, `Fecha_Creado`, `Fecha_Modificado`, `Fecha_Eliminado`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Estado`) VALUES
  (3, 'Club 10', '2690.00', '269.00', 1, 10, '2017-02-05 12:42:06', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1'),
  (4, 'Club 20', '4980.00', '249.00', 2, 10, '2017-02-05 12:42:31', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1'),
  (5, 'Club 30', '6570.00', '269.00', 3, 10, '2017-02-05 12:42:50', NULL, NULL, 'administrador@gmail.com', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte`
--

DROP TABLE IF EXISTS `reporte`;
CREATE TABLE IF NOT EXISTS `reporte` (
  `id` int(11) NOT NULL,
  `fecha_final` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `reporte`
--

TRUNCATE TABLE `reporte`;
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

--
-- Truncar tablas antes de insertar `tbl_dynagrid`
--

TRUNCATE TABLE `tbl_dynagrid`;
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

--
-- Truncar tablas antes de insertar `tbl_dynagrid_dtl`
--

TRUNCATE TABLE `tbl_dynagrid_dtl`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Truncar tablas antes de insertar `telemarketing`
--

TRUNCATE TABLE `telemarketing`;
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
-- Truncar tablas antes de insertar `user`
--

TRUNCATE TABLE `user`;
--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `last_login_at`, `status`, `password_reset_token`, `Fecha_Creado`, `Fecha_Modificada`, `Fecha_Eliminada`, `Usuario_Creado`, `Usuario_Modificado`, `Usuario_Eliminado`, `Ultima_Sesion`, `Codigo_Rol`, `pwdDes`, `estado`) VALUES
  (2, 'Anfitrión', 'anfitrion@gmail.com', '$2y$10$4W43bly79FLTSQbHp1P4h.pwLENbqgMa0pG2zW0tjniW3XTSBoy2.', '3', NULL, NULL, NULL, NULL, NULL, NULL, 1486883098, 1, NULL, '2017-02-04 12:02:17', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 3, '000000', 1),
  (3, 'Confirmador', 'confirmador@gmail.com', '$2y$10$02b56s8XaMiFty6Nke7Jd.0gUQiwaXeV8AmoxQVaAcxAf8i0tmtJK', '6', NULL, NULL, NULL, NULL, NULL, NULL, 1487029350, 1, NULL, '2017-02-04 12:03:03', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 6, '000000', 1),
  (4, 'Digitador', 'digitador@gmail.com', '$2y$10$toj/bcVm1k5rWvkjusao0uQqGbGm0lhjTObYcIDPjtfQWPAppMHI.', '1', NULL, NULL, NULL, NULL, NULL, NULL, 1487092453, 1, NULL, '2017-02-04 12:03:17', '2017-02-05 04:08:59', NULL, 'Administrador@gmail.com', '', NULL, NULL, 1, '000000', 1),
  (5, 'Director de mercadeo', 'directordemercadeo@gmail.com', '$2y$10$WJ6qAGwGSUbomruQ/5q/ourvVJNHuUBTE/zie3I1oHUBDa0yDL36i', '4', NULL, NULL, NULL, NULL, NULL, NULL, 1487024847, 1, NULL, '2017-02-04 12:03:41', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 4, '000000', 1),
  (6, 'Director de proyecto', 'directordeproyecto@gmail.com', '$2y$10$CMwjk2IIdcQXTf9650qN5.hjnKB5NF7ke/dvwVAx5b74YFmVrxAHi', '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:04:04', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 13, '000000', 1),
  (7, 'Gerente General', 'gerentegeneral@gmail.com', '$2y$10$Ws.srv2sXVLKm01ZWp2IWO8Wu3BTP2zausRipERyWjR1QdKSpsqAS', '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:04:22', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 14, '000000', 1),
  (8, 'Jefe de contratos', 'jefedecontratos@gmail.com', '$2y$10$6C8/g5ysmpH/CBscKRJT1.OpmsMLy0HgWx5yh20HCHPga6qoXfKxm', '10', NULL, NULL, NULL, NULL, NULL, NULL, 1487029769, 1, NULL, '2017-02-04 12:09:37', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 10, '000000', 1),
  (9, 'Jefe de sala', 'jefedesala@gmail.com', '$2y$10$HRWnViObpuk4EVRj.t3lcuwNtaFt4g.L7DsTvrlz1ngXQhI1Tu/di', '11', NULL, NULL, NULL, NULL, NULL, NULL, 1486239038, 1, NULL, '2017-02-04 12:09:51', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 11, '000000', 1),
  (10, 'Jefe de ventas', 'jefedeventas@gmail.com', '$2y$10$8vQXXg065aLY6ty9hEz78uxQIGeFJgnwJP1h7ABijQ/Al37QZPFmu', '12', NULL, NULL, NULL, NULL, NULL, NULL, 1486335616, 1, NULL, '2017-02-04 12:10:11', '2017-02-04 01:58:19', NULL, 'Administrador@gmail.com', '', NULL, NULL, 12, '000000', 1),
  (11, 'No access closer', 'noaccessclose@gmail.com', '$2y$10$o7b5tl7JkF6R5RAe42wmOO3InqHvYll4FJBIIdzvfUNv68wvOjpOS', '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:10:34', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 9, '000000', 1),
  (12, 'No access liner', 'noaccesslines@gmail.com', '$2y$10$xIPYZ3ioc.WFytshxx0lbe.oPk6.f48fPqESJFbMRbqD4zGHM1K/C', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:11:19', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 8, '000000', 1),
  (13, 'Supervisor', 'supervisor@gmail.com', '$2y$10$B.V7k3PpIw1qkINxauIKxeGpKaZ98N2PVeDZJGI.6Dh50MkSBiUJK', '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-04 12:11:35', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 2, '000000', 1),
  (14, 'Supervisora de telemarketing', 'supervisoradetelemasrketing@gmail.com', '$2y$10$xJje1OwTmm8rLHcC3IcrOuoPwYvQi4fyd5OeqExxdn5Av6n95bSTq', '7', NULL, NULL, NULL, NULL, NULL, NULL, 1486920786, 1, NULL, '2017-02-04 12:12:01', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 7, '000000', 1),
  (15, 'Telemarketing', 'telemarketing@gmail.com', '$2y$10$l3fsDDawa5VDpbcfCrw4a.XKuP4Kx.Ur7fI47lmCVCDW6lzZe0DEe', '5', NULL, NULL, NULL, NULL, NULL, NULL, 1487092167, 1, NULL, '2017-02-04 12:12:20', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 5, '000000', 1),
  (16, 'Administrador', 'administrador@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '20', NULL, NULL, NULL, NULL, NULL, NULL, 1487093884, 1, NULL, '2017-02-04 12:13:56', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 20, '000000', 1),
  (17, 'Supervisor Promotor', 'supervisordepromotor@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '15', NULL, NULL, NULL, NULL, NULL, NULL, 1486703860, 1, NULL, '2017-02-11 19:45:26', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 15, '000000', 1),
  (18, 'Jefe Promotor', 'jefepromotor@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '16', NULL, NULL, NULL, NULL, NULL, NULL, 1486703860, 1, NULL, '2017-02-11 19:45:26', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 16, '000000', 1),
  (19, 'Director de Telemarketing', 'directordetelemarketing@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '17', NULL, NULL, NULL, NULL, NULL, NULL, 1486915487, 1, NULL, '2017-02-11 19:45:26', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 17, '000000', 1),
  (20, 'Director de Planemiento y Administracion', 'directordeplaneamientoyadministracion@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '18', NULL, NULL, NULL, NULL, NULL, NULL, 1486703860, 1, NULL, '2017-02-12 02:43:59', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 18, '000000', 1),
  (21, 'Director Comercial', 'directorcomercial@gmail.com', '$2y$10$fUr/LqNiAuuHk5/j2MqSROnaoh0G6z2roz3nJjEsJuTHFWdQEaXw6', '19', NULL, NULL, NULL, NULL, NULL, NULL, 1486889469, 1, NULL, '2017-02-12 02:44:56', NULL, NULL, 'Administrador@gmail.com', NULL, NULL, NULL, 19, '000000', 1),
  (22, 'Luis', 'l.1@sgconta.com.pe', '$2y$10$WhGOZCoAMxEOwCbl0Y6RqedUqTiWMhG4SZ4xrP4HHx4pFCfOJ2AAO', '1', NULL, NULL, NULL, NULL, NULL, NULL, 1487023953, 1, NULL, '2017-02-13 05:12:04', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 1, 'l123456', 2),
  (23, 'Abigail', 'abi@rusticaclub.com.pe', '$2y$10$ENG40mqpjUCBzOQg/eSdCuM65XfJGmZfyqpUarL5OCGssat/USPg.', '4', NULL, NULL, NULL, NULL, NULL, NULL, 1487024490, 1, NULL, '2017-02-13 05:21:04', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 4, 'abi123456', 2),
  (24, 'Paty', 'paty@rusticaclub.com', '$2y$10$tWnaDyfA9rjbr.AMh0Jbl.FuD/HHSv5yeL8qfc7jbu2dfxO5JpnJi', '17', NULL, NULL, NULL, NULL, NULL, NULL, 1487025338, 1, NULL, '2017-02-13 05:30:23', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 17, '012345', 2),
  (25, 'Supervisor de elemarketing', 'supertel@rusticaclub.com', '$2y$10$2m..r.CAr9Lf/wPGNcpLxu61.L3GskfDXJK9VocOH.AsOeBdHOe1q', '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-13 05:31:19', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 7, '123456', 2),
  (26, 'Confirmadorcitas', 'confirmador@rusticaclub.com', '$2y$10$4ATCyxVuuFtVbhDSA4tr7.r91Fky9YwkPWqyJPZqvdLEF0Opt0m4i', '6', NULL, NULL, NULL, NULL, NULL, NULL, 1487029291, 1, NULL, '2017-02-13 05:32:08', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 6, '123456', 2),
  (27, 'operador tel', 'operador@rusticaclub.com', '$2y$10$GiE3SWlZZUxhVY4HMR02SeDiqpv5C1AdG2q4XyVN659ZW5Fvgbr0K', '5', NULL, NULL, NULL, NULL, NULL, NULL, 1487025564, 1, NULL, '2017-02-13 05:32:48', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 5, '123456', 2),
  (28, 'Miguel Valcarcel', 'miguel@rusticaclub.com', '$2y$10$mU6ssgeUrzCxqEFbbK7.VuMNK6xMIIOPf4Td/8juzNLxcpvVNlBsi', '19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-02-13 05:33:38', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 19, '123456', 2),
  (29, 'jefede contrato', 'contratos@rusticaclub.com', '$2y$10$sMiE0TZW9OklcZL.B1/x0.Ib8h8akrpneiT2km.PgiPIjZ.nv3TQK', '10', NULL, NULL, NULL, NULL, NULL, NULL, 1487080213, 1, NULL, '2017-02-13 05:34:21', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 10, '123456', 2),
  (30, 'JOVANA RODRIGUEZ', 'j.rodriguez@rusticaclub.com', '$2y$10$dVxkvHcNM38JU2pUXamRpeS8kb6xO/eJeLhO.mT22PnZlim5W3Zam', '1', NULL, NULL, NULL, NULL, NULL, NULL, 1487092272, 1, NULL, '2017-02-14 12:10:16', NULL, NULL, 'administrador@gmail.com', NULL, NULL, NULL, 1, 'renzo140320', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

DROP TABLE IF EXISTS `venta`;
CREATE TABLE IF NOT EXISTS `venta` (
  `Codigo_venta` int(255) NOT NULL,
  `Codigo_pasaporte` int(255) NOT NULL,
  `Codigo_Cliente` int(11) NOT NULL,
  `medio_pago` char(1) DEFAULT NULL,
  `Estado_pago` char(1) DEFAULT NULL,
  `porcentaje_pagado` float DEFAULT NULL,
  `cod_barra_pasaporte` varchar(45) DEFAULT NULL,
  `cod_barra_pasaporte_manual` varchar(45) DEFAULT NULL,
  `Fecha_Creado` datetime DEFAULT NULL,
  `Fecha_Modificado` datetime DEFAULT NULL,
  `Fecha_Eliminado` datetime DEFAULT NULL,
  `Usuario_Creado` varchar(100) DEFAULT NULL,
  `Usuario_Modificado` varchar(100) DEFAULT NULL,
  `Usuario_Eliminado` varchar(100) DEFAULT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`Codigo_venta`),
  KEY `fk_venta_pasaporte1_idx` (`Codigo_pasaporte`),
  KEY `fk_venta_cliente1_idx` (`Codigo_Cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncar tablas antes de insertar `venta`
--

TRUNCATE TABLE `venta`;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asig_tlmk_cliente`
--
ALTER TABLE `asig_tlmk_cliente`
  ADD CONSTRAINT `fk_Asig_Tlmk_Cliente_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asig_tlmk_cliente_fecha_asignacion1` FOREIGN KEY (`codigo_asig`) REFERENCES `fecha_asignacion` (`codigo_asig`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asig_tlmk_cliente_user1` FOREIGN KEY (`Codigo_Usuario`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Filtros para la tabla `beneficiario`
--
ALTER TABLE `beneficiario`
  ADD CONSTRAINT `fk_beneficiario_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `fk_certificado_pasaporte1` FOREIGN KEY (`Codigo_pasaporte_afiliado`) REFERENCES `pasaporte` (`Codigo_pasaporte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `fk_club_certificado1` FOREIGN KEY (`Codigo_certificado`) REFERENCES `certificado` (`Codigo_certificado`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `fk_venta_cliente1` FOREIGN KEY (`Codigo_Cliente`) REFERENCES `cliente` (`Codigo_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_venta_pasaporte1` FOREIGN KEY (`Codigo_pasaporte`) REFERENCES `pasaporte` (`Codigo_pasaporte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
