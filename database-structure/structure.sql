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

-- -----------------------------------------------------
-- Table `ticketShare`.`offers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ticketShare`.`offers` (
    `offerId` INT NOT NULL AUTO_INCREMENT,
    `creatorId` INT NOT NULL,
    `departure` INT NOT NULL,
    `arrival` INT NOT NULL,
    `time` DATETIME NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`offerId`),
    CONSTRAINT `fk_creatorId_userId`
    FOREIGN KEY (`creatorId`)
    REFERENCES `ticketShare`.`users` (`userId`),
    CONSTRAINT `fk_departure_cityId`
    FOREIGN KEY (`departure`)
    REFERENCES `ticketShare`.`cities` (`cityId`),
    CONSTRAINT `fk_arrival_cityId`
    FOREIGN KEY (`arrival`)
    REFERENCES `ticketShare`.`cities` (`cityId`)
    ) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;