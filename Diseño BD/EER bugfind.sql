-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema bdbugfind
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema bdbugfind
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `bdbugfind` DEFAULT CHARACTER SET utf8 ;
USE `bdbugfind` ;

-- -----------------------------------------------------
-- Table `bdbugfind`.`Jugador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Jugador` (
  `IdJugador` INT NOT NULL AUTO_INCREMENT,
  `NombreJugador` VARCHAR(45) NOT NULL,
  `Avatar` VARCHAR(45) NULL,
  PRIMARY KEY (`IdJugador`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`Sesion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Sesion` (
  `IdSesion` INT NOT NULL AUTO_INCREMENT,
  `Partida` VARCHAR(6) NULL,
  `TipoSesion` INT(1) NULL COMMENT '1:Publica\n2:Privada',
  `Jugador_IdJugador` INT NOT NULL,
  PRIMARY KEY (`IdSesion`),
  INDEX `fk_Sesion_Jugador2_idx` (`Jugador_IdJugador` ASC) INVISIBLE,
  CONSTRAINT `fk_Sesion_Jugador2`
    FOREIGN KEY (`Jugador_IdJugador`)
    REFERENCES `bdbugfind`.`Jugador` (`IdJugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`Partida`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Partida` (
  `IdPartida` INT NOT NULL AUTO_INCREMENT,
  `Jugador_IdJugador` INT NOT NULL,
  `Sesion_IdSesion` INT NOT NULL,
  PRIMARY KEY (`IdPartida`),
  INDEX `fk_Partida_Jugador1_idx` (`Jugador_IdJugador` ASC) INVISIBLE,
  INDEX `fk_Partida_Sesion1_idx` (`Sesion_IdSesion` ASC) INVISIBLE,
  CONSTRAINT `fk_Partida_Jugador1`
    FOREIGN KEY (`Jugador_IdJugador`)
    REFERENCES `bdbugfind`.`Jugador` (`IdJugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Partida_Sesion1`
    FOREIGN KEY (`Sesion_IdSesion`)
    REFERENCES `bdbugfind`.`Sesion` (`IdSesion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`TipoCarta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`TipoCarta` (
  `IdTipoCarta` INT NOT NULL AUTO_INCREMENT,
  `TipoCarta` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`IdTipoCarta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`Carta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Carta` (
  `IdCarta` INT NOT NULL,
  `Carta` VARCHAR(100) NOT NULL,
  `Imagen` BLOB NULL,
  `TipoCarta_IdTipoCarta` INT NOT NULL,
  PRIMARY KEY (`IdCarta`),
  INDEX `fk_Carta_TipoCarta1_idx` (`TipoCarta_IdTipoCarta` ASC) INVISIBLE,
  CONSTRAINT `fk_Carta_TipoCarta1`
    FOREIGN KEY (`TipoCarta_IdTipoCarta`)
    REFERENCES `bdbugfind`.`TipoCarta` (`IdTipoCarta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`Tarjeta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Tarjeta` (
  `Partida_IdPartida` INT NOT NULL,
  `Jugador_IdJugador` INT NOT NULL,
  `Carta_IdCarta` INT NOT NULL,
  `IdJugadorNota` INT NULL,
  `Nota` VARCHAR(100) NULL,
  INDEX `fk_Sesion_Partida1_idx` (`Partida_IdPartida` ASC) VISIBLE,
  INDEX `fk_Sesion_Jugador1_idx` (`Jugador_IdJugador` ASC) INVISIBLE,
  INDEX `fk_Tarjeta_Carta1_idx` (`Carta_IdCarta` ASC) INVISIBLE,
  CONSTRAINT `fk_Sesion_Partida1`
    FOREIGN KEY (`Partida_IdPartida`)
    REFERENCES `bdbugfind`.`Partida` (`IdPartida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Sesion_Jugador1`
    FOREIGN KEY (`Jugador_IdJugador`)
    REFERENCES `bdbugfind`.`Jugador` (`IdJugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Tarjeta_Carta1`
    FOREIGN KEY (`Carta_IdCarta`)
    REFERENCES `bdbugfind`.`Carta` (`IdCarta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`Bug`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Bug` (
  `Partida_IdPartida` INT NOT NULL,
  `Carta_IdCarta` INT NOT NULL,
  INDEX `fk_Bug_Partida1_idx` (`Partida_IdPartida` ASC) INVISIBLE,
  INDEX `fk_Bug_Carta1_idx` (`Carta_IdCarta` ASC) INVISIBLE,
  CONSTRAINT `fk_Bug_Partida1`
    FOREIGN KEY (`Partida_IdPartida`)
    REFERENCES `bdbugfind`.`Partida` (`IdPartida`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Bug_Carta1`
    FOREIGN KEY (`Carta_IdCarta`)
    REFERENCES `bdbugfind`.`Carta` (`IdCarta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`LanzaJugada`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`LanzaJugada` (
  `Carta_IdCarta` INT NOT NULL,
  `Jugador_IdJugador` INT NOT NULL,
  INDEX `fk_LanzaJugada_Carta1_idx` (`Carta_IdCarta` ASC) INVISIBLE,
  INDEX `fk_LanzaJugada_Jugador1_idx` (`Jugador_IdJugador` ASC) INVISIBLE,
  CONSTRAINT `fk_LanzaJugada_Carta1`
    FOREIGN KEY (`Carta_IdCarta`)
    REFERENCES `bdbugfind`.`Carta` (`IdCarta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_LanzaJugada_Jugador1`
    FOREIGN KEY (`Jugador_IdJugador`)
    REFERENCES `bdbugfind`.`Jugador` (`IdJugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bdbugfind`.`Acusacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bdbugfind`.`Acusacion` (
  `Jugador_IdJugador` INT NOT NULL,
  `Carta_IdCarta` INT NOT NULL,
  INDEX `fk_Acusacion_Jugador1_idx` (`Jugador_IdJugador` ASC) INVISIBLE,
  INDEX `fk_Acusacion_Carta1_idx` (`Carta_IdCarta` ASC) INVISIBLE,
  CONSTRAINT `fk_Acusacion_Jugador1`
    FOREIGN KEY (`Jugador_IdJugador`)
    REFERENCES `bdbugfind`.`Jugador` (`IdJugador`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Acusacion_Carta1`
    FOREIGN KEY (`Carta_IdCarta`)
    REFERENCES `bdbugfind`.`Carta` (`IdCarta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
