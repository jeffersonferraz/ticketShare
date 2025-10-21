SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `ticketShare` DEFAULT CHARACTER SET utf8 ;
USE `ticketShare`;

-- -----------------------------------------------------
-- Table `ticketShare`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketShare`.`users` (
    `userId` INT NOT NULL AUTO_INCREMENT,
    `firstname` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`userId`)
    ) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

-- -----------------------------------------------------
-- Table `ticketShare`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketShare`.`cities` (
    `cityId` INT NOT NULL AUTO_INCREMENT,
    `cityName` VARCHAR(100) NOT NULL,
    `state` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`cityId`)
    ) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;