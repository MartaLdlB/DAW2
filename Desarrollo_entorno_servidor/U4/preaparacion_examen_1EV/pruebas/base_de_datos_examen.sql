-- MySQL Script generated by MySQL Workbench
-- Tue Nov 19 18:31:56 2024
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`empresas`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`empresas` ;

CREATE TABLE IF NOT EXISTS `mydb`.`empresas` (
  `id_empresa` INT NOT NULL AUTO_INCREMENT,
  `razon_social` VARCHAR(45) NOT NULL,
  `cif_empresa` VARCHAR(9) NOT NULL,
  `pais_empresa` VARCHAR(20) NOT NULL,
  `direccion_empresa` VARCHAR(45) NOT NULL,
  `codigo_postal_empresa` INT NOT NULL,
  PRIMARY KEY (`id_empresa`),
  UNIQUE INDEX `id_empresa_UNIQUE` (`id_empresa` ASC),
  UNIQUE INDEX `cif_empresa_UNIQUE` (`cif_empresa` ASC),
  UNIQUE INDEX `razon_social_UNIQUE` (`razon_social` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`carrito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`carrito` ;

CREATE TABLE IF NOT EXISTS `mydb`.`carrito` (
  `id_carrito` INT NOT NULL AUTO_INCREMENT,
  `id_empresa` INT NOT NULL,
  `estado_carrito` ENUM('activo', 'completado') NOT NULL,
  PRIMARY KEY (`id_carrito`),
  UNIQUE INDEX `id_carrito_UNIQUE` (`id_carrito` ASC) ,
  INDEX `fk_carrito_empresas1_idx` (`id_empresa` ASC) ,
  CONSTRAINT `fk_carrito_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `mydb`.`empresas` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pedidos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`pedidos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`pedidos` (
  `id_pedido` INT NOT NULL AUTO_INCREMENT,
  `estado_de_envio` VARCHAR(2) NOT NULL,
  `cuenta_de_pago` VARCHAR(45) NOT NULL,
  `fecha_pedido` DATETIME NOT NULL,
  `id_producto` INT NOT NULL,
  `carrito_id_carrito` INT NOT NULL,
  PRIMARY KEY (`id_pedido`),
  UNIQUE INDEX `id_pedido_UNIQUE` (`id_pedido` ASC) ,
  INDEX `fk_pedidos_carrito1_idx` (`carrito_id_carrito` ASC) ,
  CONSTRAINT `fk_pedidos_carrito1`
    FOREIGN KEY (`carrito_id_carrito`)
    REFERENCES `mydb`.`carrito` (`id_carrito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categorias`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`categorias` ;

CREATE TABLE IF NOT EXISTS `mydb`.`categorias` (
  `id_categorias` INT NOT NULL,
  `tipo_categoria` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_categorias`),
  UNIQUE INDEX `id_categorias_UNIQUE` (`id_categorias` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`productos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`productos` ;

CREATE TABLE IF NOT EXISTS `mydb`.`productos` (
  `id_producto` INT NOT NULL AUTO_INCREMENT,
  `nombre_producto` VARCHAR(45) NOT NULL,
  `descripcion_producto` VARCHAR(45) NOT NULL,
  `peso_producto` VARCHAR(45) NULL,
  `tamanio_producto` VARCHAR(45) NULL,
  `imagen_producto` LONGBLOB NOT NULL,
  `precio_producto` FLOAT NOT NULL,
  `id_categorias` INT NOT NULL,
  PRIMARY KEY (`id_producto`),
  UNIQUE INDEX `id_producto_UNIQUE` (`id_producto` ASC),
  INDEX `fk_productos_categorias1_idx` (`id_categorias` ASC),
  CONSTRAINT `fk_productos_categorias1`
    FOREIGN KEY (`id_categorias`)
    REFERENCES `mydb`.`categorias` (`id_categorias`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`credenciales`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`credenciales` ;

CREATE TABLE IF NOT EXISTS `mydb`.`credenciales` (
  `correo` VARCHAR(45) NOT NULL,
  `contrasenia` VARCHAR(16) NOT NULL,
  `id_empresa` INT NOT NULL,
  PRIMARY KEY (`correo`),
  INDEX `fk_credenciales_empresas1_idx` (`id_empresa` ASC) ,
  CONSTRAINT `fk_credenciales_empresas1`
    FOREIGN KEY (`id_empresa`)
    REFERENCES `mydb`.`empresas` (`id_empresa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`detalle_carrito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`detalle_carrito` ;

CREATE TABLE IF NOT EXISTS `mydb`.`detalle_carrito` (
  `id_producto` INT NOT NULL,
  `id_carrito` INT NOT NULL,
  `cantidad_producto` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_producto`, `id_carrito`),
  INDEX `fk_productos_has_carrito_carrito1_idx` (`id_carrito` ASC) ,
  INDEX `fk_productos_has_carrito_productos1_idx` (`id_producto` ASC) ,
  CONSTRAINT `fk_productos_has_carrito_productos1`
    FOREIGN KEY (`id_producto`)
    REFERENCES `mydb`.`productos` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_productos_has_carrito_carrito1`
    FOREIGN KEY (`id_carrito`)
    REFERENCES `mydb`.`carrito` (`id_carrito`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- Inserción de categorías en la tabla `categorias`
INSERT INTO `mydb`.`categorias` 
(`id_categorias`, `tipo_categoria`) 
VALUES
(2, 'Papelería'),
(3, 'Mobiliario');

-- Inserción de productos en la tabla `productos`
INSERT INTO `mydb`.`productos` 
(`nombre_producto`, `descripcion_producto`, `peso_producto`, `tamanio_producto`, `imagen_producto`, `id_categorias`) 
VALUES
('Lápiz', 'Lápiz de madera HB', '10g', '19cm', NULL, 2),
('Bolígrafo', 'Bolígrafo tinta azul', '12g', '14cm', NULL, 2),
('Mesa', 'Mesa de oficina de madera', '15kg', '120x60x75cm', NULL, 3),
('Silla', 'Silla ergonómica', '8kg', '50x50x100cm', NULL, 3);

