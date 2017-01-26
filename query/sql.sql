-- MySQL Script generated by MySQL Workbench
-- 01/26/17 01:32:26
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema sis_crm
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sis_crm
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sis_crm` DEFAULT CHARACTER SET latin1 ;
USE `sis_crm` ;

-- -----------------------------------------------------
-- Table `cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cliente` (
  `Codigo_Cliente` INT(11) NOT NULL,
  `Nombre` VARCHAR(100) NULL DEFAULT NULL,
  `Apellido` VARCHAR(100) NULL DEFAULT NULL,
  `Profesion` VARCHAR(45) NULL DEFAULT NULL,
  `Edad` INT(2) NULL DEFAULT NULL,
  `Estado_Civil` CHAR(1) NULL DEFAULT NULL,
  `Distrito` CHAR(1) NULL DEFAULT NULL,
  `Direccion` VARCHAR(200) NULL DEFAULT NULL,
  `Telefono_Casa` VARCHAR(15) NULL DEFAULT NULL,
  `Telefono_Celular` VARCHAR(15) NULL DEFAULT NULL,
  `Email` VARCHAR(45) NULL DEFAULT NULL,
  `Traslado` VARCHAR(45) NULL DEFAULT NULL,
  `Tarjeta_De_Credito` INT(1) NULL DEFAULT NULL,
  `Promotor` VARCHAR(50) NULL DEFAULT NULL,
  `Local` VARCHAR(100) NULL DEFAULT NULL,
  `Observacion` VARCHAR(200) NULL DEFAULT NULL,
  `Fecha_Creado` DATETIME NULL DEFAULT NULL,
  `Fecha_Modificado` DATETIME NULL DEFAULT NULL,
  `Fecha_Eliminado` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  `Usuario_Eliminado` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Cliente`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `folio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `folio` (
  `Codigo_Folio` INT(11) NOT NULL,
  `Valor` VARCHAR(100) NULL DEFAULT NULL,
  `Descripcion` VARCHAR(200) NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  `Fecha_Modificada` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Folio`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `rol`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `rol` (
  `Cod_Rol` INT(11) NOT NULL,
  `Descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `Fecha_Creada` DATETIME NULL DEFAULT NULL,
  `Fecha_Modificada` DATETIME NULL DEFAULT NULL,
  `Fecha_Eliminada` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Cod_Rol`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuario` (
  `Codigo_Usuario` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NULL DEFAULT NULL,
  `Apellido` VARCHAR(45) NULL DEFAULT NULL,
  `Email` VARCHAR(45) NULL DEFAULT NULL,
  `Contrasena` VARCHAR(250) NULL DEFAULT NULL,
  `AuthKey` VARCHAR(250) NULL DEFAULT NULL,
  `AccessToken` VARCHAR(250) NULL DEFAULT NULL,
  `Activate` TINYINT(1) NOT NULL DEFAULT '0',
  `Fecha_Creado` DATETIME NULL DEFAULT NULL,
  `Fecha_Modificada` DATETIME NULL DEFAULT NULL,
  `Fecha_Eliminada` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` VARCHAR(250) NULL DEFAULT NULL,
  `Usuario_Modificado` VARCHAR(250) NULL DEFAULT NULL,
  `Usuario_Eliminado` VARCHAR(250) NULL DEFAULT NULL,
  `Ultima_Sesion` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  `Codigo_Rol` INT(11) NOT NULL,
  PRIMARY KEY (`Codigo_Usuario`),
  INDEX `fk_Usuario_Roles_idx` (`Codigo_Rol` ASC),
  CONSTRAINT `fk_Usuario_Roles`
    FOREIGN KEY (`Codigo_Rol`)
    REFERENCES `rol` (`Cod_Rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `producto` (
  `Codigo_Producto` INT(11) NOT NULL,
  `Nombre` VARCHAR(100) NULL,
  `Precio` DECIMAL(10,2) NULL,
  `Precio_por_Noche` DECIMAL(10,2) NULL,
  `Vigencia` INT(2) NULL,
  `Desc_Afiliado` FLOAT NULL,
  `Combo_Adquirido` VARCHAR(120) NULL,
  `Fecha_Creado` DATETIME NULL DEFAULT NULL,
  `Fecha_Modificado` DATETIME NULL DEFAULT NULL,
  `Fecha_Eliminado` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  `Usuario_Eliminado` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Producto`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `factura` (
  `Codigo_Factura` INT(11) NOT NULL,
  `Codigo_Cliente` INT(11) NOT NULL,
  `Fecha_Creado` DATETIME NULL DEFAULT NULL,
  `Fecha_Modificado` DATETIME NULL,
  `Fecha_Eliminado` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  `Usuario_Eliminado` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Factura`),
  INDEX `fk_factura_cliente1_idx` (`Codigo_Cliente` ASC),
  CONSTRAINT `fk_factura_cliente1`
    FOREIGN KEY (`Codigo_Cliente`)
    REFERENCES `cliente` (`Codigo_Cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `detalle_factura`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `Codigo_Factura` INT(11) NOT NULL,
  `Codigo_Fact_Detalle` INT(11) NOT NULL,
  `Codigo_Producto` INT(11) NOT NULL,
  `Linea` INT(5) NULL,
  `Cantidad` INT(5) NULL,
  `Descripcion` VARCHAR(85) NULL,
  `Total` DECIMAL(5,2) NULL,
  `Subtotal` DECIMAL(5,2) NULL,
  `Fecha_Creado` DATETIME NULL,
  `Fecha_Modificado` DATETIME NULL,
  `Fecha_Eliminado` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  `Usuario_Eliminado` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Fact_Detalle`),
  INDEX `fk_detalle_factura_factura1_idx` (`Codigo_Factura` ASC),
  INDEX `fk_detalle_factura_producto1_idx` (`Codigo_Producto` ASC),
  CONSTRAINT `fk_detalle_factura_factura1`
    FOREIGN KEY (`Codigo_Factura`)
    REFERENCES `factura` (`Codigo_Factura`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalle_factura_producto1`
    FOREIGN KEY (`Codigo_Producto`)
    REFERENCES `producto` (`Codigo_Producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `documento` (
  `Codigo_Documento` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Fecha_Creado` DATETIME NULL,
  `Fecha_Modificado` DATETIME NULL,
  `Fecha_Eliminado` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  `Usuario_Eliminado` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Documento`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `contrato`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contrato` (
  `Codigo_Contrato` INT(11) NOT NULL,
  `Nombre` VARCHAR(45) NULL,
  `Apellidos` VARCHAR(150) NULL,
  `Titular` VARCHAR(150) NULL,
  `Esposo` VARCHAR(150) NULL,
  `Dni_1` INT(8) NULL,
  `Dni_2` INT(8) NULL,
  `Estado_Civil_1` CHAR(1) NULL,
  `Estado_Civil_2` CHAR(1) NULL,
  `Domicilio_1` VARCHAR(45) NULL,
  `Domicilio_2` VARCHAR(45) NULL,
  `Ocupacion_1` VARCHAR(45) NULL,
  `Ocupacion_2` VARCHAR(45) NULL,
  `Monto_Pagado` DECIMAL(10,2) NULL,
  `Saldos` DECIMAL(10,2) NULL,
  `N_cuotas` INT(8) NULL,
  `causas` VARCHAR(150) NULL,
  `Penalizacion` DECIMAL(8,2) NULL,
  `Formas` VARCHAR(100) NULL,
  `Monto_devol` DECIMAL(8,2) NULL,
  `Fecha_Creado` DATETIME NULL,
  `Fecha_Modificado` DATETIME NULL,
  `Fecha_Eliminado` DATETIME NULL DEFAULT NULL,
  `Usuario_Creado` DATETIME NULL DEFAULT NULL,
  `Usuario_Modificado` DATETIME NULL DEFAULT NULL,
  `Usuario_Eliminado` DATETIME NULL DEFAULT NULL,
  `Estado` CHAR(1) NULL DEFAULT NULL,
  PRIMARY KEY (`Codigo_Contrato`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
