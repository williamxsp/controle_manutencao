-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema controle_manutencao
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema controle_manutencao
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `controle_manutencao` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `controle_manutencao` ;

-- -----------------------------------------------------
-- Table `controle_manutencao`.`marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`marca` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 71
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`procedencia`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`procedencia` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 95
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`setor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`setor` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descricao` VARCHAR(80) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 96
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`equipamento` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'NI',
  `marca_id` INT(11) NULL DEFAULT NULL,
  `setor_id` INT(11) NULL DEFAULT NULL,
  `procedencia_id` INT(11) NULL DEFAULT NULL,
  `nome` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `descricao` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NULL DEFAULT NULL,
  `data_aquisicao` DATETIME NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  UNIQUE INDEX `unique_id` (`id` ASC),
  INDEX `fk_equipamento_marca1_idx` (`marca_id` ASC),
  INDEX `fk_equipamento_setor1_idx` (`setor_id` ASC),
  INDEX `fk_equipamento_procedencia1_idx` (`procedencia_id` ASC),
  CONSTRAINT `fk_equipamento_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `controle_manutencao`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_procedencia1`
    FOREIGN KEY (`procedencia_id`)
    REFERENCES `controle_manutencao`.`procedencia` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_equipamento_setor1`
    FOREIGN KEY (`setor_id`)
    REFERENCES `controle_manutencao`.`setor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 124
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`usuario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NULL DEFAULT NULL,
  `senha` VARCHAR(50) NULL DEFAULT NULL,
  `perfil_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1025701
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`manutencao`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`manutencao` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `equipamento_id` INT(11) NOT NULL,
  `usuario_id` INT(11) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_manutencao_equipamento1_idx` (`equipamento_id` ASC),
  INDEX `fk_manutencao_usuario1_idx` (`usuario_id` ASC),
  CONSTRAINT `fk_manutencao_equipamento1`
    FOREIGN KEY (`equipamento_id`)
    REFERENCES `controle_manutencao`.`equipamento` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_manutencao_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `controle_manutencao`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 44
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`perfil`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`perfil` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(150) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `controle_manutencao`.`servico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `controle_manutencao`.`servico` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `custo` DECIMAL(6,2) NOT NULL,
  `inicio` DATETIME NOT NULL,
  `termino` DATETIME NOT NULL,
  `tempo` INT(11) NOT NULL,
  `manutencao_id` INT(11) NOT NULL,
  `peca` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`id`, `manutencao_id`),
  INDEX `fk_servico_manutencao1_idx` (`manutencao_id` ASC),
  CONSTRAINT `fk_servico_manutencao1`
    FOREIGN KEY (`manutencao_id`)
    REFERENCES `controle_manutencao`.`manutencao` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 6
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
