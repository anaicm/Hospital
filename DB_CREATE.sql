-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema Hospital
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema Hospital
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `Hospital` DEFAULT CHARACTER SET utf8 ;
USE `Hospital` ;

-- -----------------------------------------------------
-- Table `Hospital`.`Centro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Centro` (
  `idCentro` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(150) NOT NULL,
  `Direccion` VARCHAR(150) NOT NULL,
  `Ciudad` VARCHAR(100) NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  `Provincia` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idCentro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Hospital`.`Departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Departamento` (
  `idDepartamento` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(150) NOT NULL,
  `Descripcion` VARCHAR(10000) NOT NULL,
  PRIMARY KEY (`idDepartamento`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Hospital`.`Centro_Departamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Centro_Departamento` (
  `idCentro` INT NOT NULL,
  `idDepartamento` INT NOT NULL,
  PRIMARY KEY (`idCentro`, `idDepartamento`),
  CONSTRAINT `fk_Centro_has_Departamento_Centro`
    FOREIGN KEY (`idCentro`)
    REFERENCES `Hospital`.`Centro` (`idCentro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Centro_has_Departamento_Departamento1`
    FOREIGN KEY (`idDepartamento`)
    REFERENCES `Hospital`.`Departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Hospital`.`Personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Personal` (
  `idPersonal` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(150) NOT NULL,
  `Apellido` VARCHAR(150) NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPersonal`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `Hospital`.`Departamento_Personal`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Departamento_Personal` (
  `idDepartamento` INT NOT NULL,
  `idPersonal` INT NOT NULL,
  PRIMARY KEY (`idDepartamento`, `idPersonal`),
  CONSTRAINT `fk_Departamento_has_Personal_Departamento1`
    FOREIGN KEY (`idDepartamento`)
    REFERENCES `Hospital`.`Departamento` (`idDepartamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Departamento_has_Personal_Personal1`
    FOREIGN KEY (`idPersonal`)
    REFERENCES `Hospital`.`Personal` (`idPersonal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Hospital`.`Familiar`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Familiar` (
  `idFamiliar` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(100) NOT NULL,
  `Apellido` VARCHAR(150) NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idFamiliar`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Hospital`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `Nombre` VARCHAR(45) NOT NULL,
  `Apellido` VARCHAR(150) NOT NULL,
  `Telefono` VARCHAR(45) NOT NULL,
  `Email` VARCHAR(45) NOT NULL,
  `Contrasenia` VARCHAR(45) NOT NULL,
  `Roll` VARCHAR(45) NOT NULL,
  `idFamiliar` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  CONSTRAINT `fk_Usuario_Familiar1`
    FOREIGN KEY (`idFamiliar`)
    REFERENCES `Hospital`.`Familiar` (`idFamiliar`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `Hospital`.`Cita`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Hospital`.`Cita` (
  `idCita` INT NOT NULL AUTO_INCREMENT,
  `Hora` DATETIME NOT NULL,
  `idPersonal` INT NOT NULL,
  `idPaciente` INT NOT NULL,
  PRIMARY KEY (`idCita`, `idPersonal`, `idPaciente`),
  CONSTRAINT `fk_Cita_Personal1`
    FOREIGN KEY (`idPersonal`)
    REFERENCES `Hospital`.`Personal` (`idPersonal`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cita_Paciente1`
    FOREIGN KEY (`idPaciente`)
    REFERENCES `Hospital`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
