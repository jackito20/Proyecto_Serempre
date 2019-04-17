-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema serempre
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema serempre
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `serempre` DEFAULT CHARACTER SET utf8 ;
USE `serempre` ;

-- -----------------------------------------------------
-- Table `serempre`.`cities`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `serempre`.`cities` ;

CREATE TABLE IF NOT EXISTS `serempre`.`cities` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cod` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `cod_UNIQUE` ON `serempre`.`cities` (`cod` ASC);


-- -----------------------------------------------------
-- Table `serempre`.`clients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `serempre`.`clients` ;

CREATE TABLE IF NOT EXISTS `serempre`.`clients` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cod` VARCHAR(45) NOT NULL,
  `name` VARCHAR(45) NOT NULL,
  `city_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `cod_UNIQUE` ON `serempre`.`clients` (`cod` ASC);


-- -----------------------------------------------------
-- Table `serempre`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `serempre`.`users` ;

CREATE TABLE IF NOT EXISTS `serempre`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `pass` VARCHAR(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8;

CREATE UNIQUE INDEX `name_UNIQUE` ON `serempre`.`users` (`name` ASC);


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


INSERT INTO `serempre`.`cities` (`cod`, `name`) VALUES ('001', 'Bogota');
INSERT INTO `serempre`.`cities` (`cod`, `name`) VALUES ('002', 'Medellin');
INSERT INTO `serempre`.`cities` (`cod`, `name`) VALUES ('003', 'Cucuta');
INSERT INTO `serempre`.`cities` (`cod`, `name`) VALUES ('004', 'Barranquilla');
INSERT INTO `serempre`.`cities` (`cod`, `name`) VALUES ('005', 'Bucaramanga');
INSERT INTO `serempre`.`cities` (`cod`, `name`) VALUES ('006', 'Cali');
