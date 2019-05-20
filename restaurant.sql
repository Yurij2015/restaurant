-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE = 'TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema restaurant
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema restaurant
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `restaurant` DEFAULT CHARACTER SET utf8;
USE `restaurant`;

-- -----------------------------------------------------
-- Table `restaurant`.`client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`client`
(
    `id_client`   INT(11)      NOT NULL AUTO_INCREMENT,
    `surname`     VARCHAR(100) NOT NULL,
    `firstname`   VARCHAR(100) NOT NULL,
    `second_name` VARCHAR(100) NOT NULL,
    `date`        DATE         NOT NULL COMMENT 'Дата рождения',
    `pasport`     VARCHAR(100) NOT NULL,
    `email`       CHAR(15)     NOT NULL,
    `telefon`     VARCHAR(15)  NOT NULL,
    PRIMARY KEY (`id_client`)
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`restorans`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`restorans`
(
    `id_restoran`           INT(11)      NOT NULL AUTO_INCREMENT,
    `number_phone_restoran` VARCHAR(10)  NOT NULL,
    `email`                 CHAR(100)    NOT NULL,
    `address`               VARCHAR(100) NOT NULL,
    `description`           TEXT         NULL DEFAULT NULL,
    `resto_title`           VARCHAR(145) NOT NULL,
    PRIMARY KEY (`id_restoran`)
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`menu`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`menu`
(
    `id_item`               INT(11)      NOT NULL AUTO_INCREMENT,
    `del_title`             VARCHAR(100) NULL DEFAULT NULL,
    `class_menu`            VARCHAR(100) NULL DEFAULT NULL,
    `number_peace_menu`     INT(11)      NULL DEFAULT NULL,
    `restorans_id_restoran` INT(11)      NOT NULL,
    PRIMARY KEY (`id_item`),
    INDEX `fk_menu_restorans_idx` (`restorans_id_restoran` ASC),
    CONSTRAINT `fk_menu_restorans`
        FOREIGN KEY (`restorans_id_restoran`)
            REFERENCES `restaurant`.`restorans` (`id_restoran`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`price`
(
    `id_price`     INT(11) NOT NULL AUTO_INCREMENT,
    `price_summer` DOUBLE  NOT NULL,
    `price_fall`   DOUBLE  NOT NULL,
    `price_winter` DOUBLE  NOT NULL,
    `price_spring` DOUBLE  NOT NULL,
    `menu_id_item` INT(11) NOT NULL,
    PRIMARY KEY (`id_price`),
    INDEX `fk_price_menu1_idx` (`menu_id_item` ASC),
    CONSTRAINT `fk_price_menu1`
        FOREIGN KEY (`menu_id_item`)
            REFERENCES `restaurant`.`menu` (`id_item`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`menu_season_price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`menu_season_price`
(
    `menu_id_item`   INT(11) NOT NULL AUTO_INCREMENT,
    `price_id_price` INT(11) NOT NULL,
    PRIMARY KEY (`menu_id_item`, `price_id_price`),
    INDEX `fk_menu_has_price_price1_idx` (`price_id_price` ASC),
    INDEX `fk_menu_has_price_menu1_idx` (`menu_id_item` ASC),
    CONSTRAINT `fk_menu_has_price_menu1`
        FOREIGN KEY (`menu_id_item`)
            REFERENCES `restaurant`.`menu` (`id_item`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_menu_has_price_price1`
        FOREIGN KEY (`price_id_price`)
            REFERENCES `restaurant`.`price` (`id_price`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`service`
(
    `id_service`         INT(11)      NOT NULL AUTO_INCREMENT,
    `service_title`      VARCHAR(100) NULL DEFAULT NULL,
    `servicedescription` VARCHAR(250) NULL DEFAULT NULL,
    PRIMARY KEY (`id_service`)
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`season_price_service`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`season_price_service`
(
    `id_price_service`   INT(11) NOT NULL AUTO_INCREMENT,
    `price_summer`       DOUBLE  NOT NULL,
    `price_fall`         DOUBLE  NOT NULL,
    `price_winter`       DOUBLE  NOT NULL,
    `price_spring`       DOUBLE  NOT NULL,
    `service_id_service` INT(11) NOT NULL,
    PRIMARY KEY (`id_price_service`),
    INDEX `fk_season_price_service_service1_idx` (`service_id_service` ASC),
    CONSTRAINT `fk_season_price_service_service1`
        FOREIGN KEY (`service_id_service`)
            REFERENCES `restaurant`.`service` (`id_service`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`service_season_price`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`service_season_price`
(
    `service_id_service`   INT(11) NOT NULL,
    `season_price_service` INT(11) NOT NULL,
    PRIMARY KEY (`service_id_service`, `season_price_service`),
    INDEX `fk_service_has_season_price_service_season_price_service1_idx` (`season_price_service` ASC),
    INDEX `fk_service_has_season_price_service_service1_idx` (`service_id_service` ASC),
    CONSTRAINT `fk_service_has_season_price_service_season_price_service1`
        FOREIGN KEY (`season_price_service`)
            REFERENCES `restaurant`.`season_price_service` (`id_price_service`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_service_has_season_price_service_service1`
        FOREIGN KEY (`service_id_service`)
            REFERENCES `restaurant`.`service` (`id_service`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`order`
(
    `idorder`           INT(11)     NOT NULL AUTO_INCREMENT,
    `order_numb`        VARCHAR(45) NOT NULL,
    `date_order`        DATE        NOT NULL,
    `client_id_client`  INT(11)     NOT NULL,
    `menu_season_price` INT(11)     NULL DEFAULT NULL,
    `price_menu`        DOUBLE      NULL DEFAULT NULL,
    `service`           INT(11)     NULL DEFAULT NULL,
    `price_service`     DOUBLE      NULL DEFAULT NULL,
    PRIMARY KEY (`idorder`),
    INDEX `fk_order_client1_idx` (`client_id_client` ASC),
    INDEX `fk_order_menu_season_price1_idx` (`menu_season_price` ASC),
    INDEX `fk_order_service_season_price1_idx` (`service` ASC),
    CONSTRAINT `fk_order_client1`
        FOREIGN KEY (`client_id_client`)
            REFERENCES `restaurant`.`client` (`id_client`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_order_menu_season_price1`
        FOREIGN KEY (`menu_season_price`)
            REFERENCES `restaurant`.`menu_season_price` (`price_id_price`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_order_service_season_price1`
        FOREIGN KEY (`service`)
            REFERENCES `restaurant`.`service_season_price` (`service_id_service`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`chek`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`chek`
(
    `id_chek`          INT(11) NOT NULL AUTO_INCREMENT,
    `summa_chek`       DOUBLE  NULL DEFAULT NULL,
    `date_chek`        DATE    NULL DEFAULT NULL,
    `summa_nomer`      DOUBLE  NULL DEFAULT NULL,
    `summa_service`    DOUBLE  NULL DEFAULT NULL,
    `client_id_client` INT(11) NOT NULL,
    `menu_id_item`     INT(11) NOT NULL,
    `order_idorder`    INT(11) NOT NULL,
    PRIMARY KEY (`id_chek`),
    INDEX `fk_chek_client1_idx` (`client_id_client` ASC),
    INDEX `fk_chek_menu1_idx` (`menu_id_item` ASC),
    INDEX `fk_chek_order1_idx` (`order_idorder` ASC),
    CONSTRAINT `fk_chek_client1`
        FOREIGN KEY (`client_id_client`)
            REFERENCES `restaurant`.`client` (`id_client`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_chek_menu1`
        FOREIGN KEY (`menu_id_item`)
            REFERENCES `restaurant`.`menu` (`id_item`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_chek_order1`
        FOREIGN KEY (`order_idorder`)
            REFERENCES `restaurant`.`order` (`idorder`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`service_client`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`service_client`
(
    `id_service`           INT(11)     NOT NULL AUTO_INCREMENT,
    `number_service`       VARCHAR(45) NULL DEFAULT NULL,
    `summa_service`        DOUBLE      NULL DEFAULT NULL,
    `client_id_client`     INT(11)     NOT NULL,
    `season_price_service` INT(11)     NOT NULL,
    PRIMARY KEY (`id_service`),
    INDEX `fk_service_client1_idx` (`client_id_client` ASC),
    INDEX `fk_service_client_season_price_service1_idx` (`season_price_service` ASC),
    CONSTRAINT `fk_service_client1`
        FOREIGN KEY (`client_id_client`)
            REFERENCES `restaurant`.`client` (`id_client`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_service_client_season_price_service1`
        FOREIGN KEY (`season_price_service`)
            REFERENCES `restaurant`.`season_price_service` (`id_price_service`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`ticket`
(
    `id_ticket`    INT(11) NOT NULL AUTO_INCREMENT,
    `chek_id_chek` INT(11) NOT NULL,
    `date`         DATE    NULL DEFAULT NULL,
    PRIMARY KEY (`id_ticket`),
    INDEX `fk_ticket_chek1_idx` (`chek_id_chek` ASC),
    CONSTRAINT `fk_ticket_chek1`
        FOREIGN KEY (`chek_id_chek`)
            REFERENCES `restaurant`.`chek` (`id_chek`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`users`
(
    `id_users`         INT(11)      NOT NULL AUTO_INCREMENT,
    `login`            VARCHAR(50)  NOT NULL,
    `password`         VARCHAR(100) NOT NULL,
    `email`            CHAR(100)    NULL DEFAULT NULL,
    `status`           VARCHAR(10)  NULL DEFAULT NULL,
    `role`             TINYINT(4)   NULL DEFAULT NULL,
    `userscol`         TINYINT(4)   NULL DEFAULT NULL,
    `client_id_client` INT(11)      NULL DEFAULT NULL,
    PRIMARY KEY (`id_users`),
    INDEX `fk_users_client1_idx` (`client_id_client` ASC),
    CONSTRAINT `fk_users_client1`
        FOREIGN KEY (`client_id_client`)
            REFERENCES `restaurant`.`client` (`id_client`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `restaurant`.`online_order`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `restaurant`.`online_order`
(
    `idonline_order` INT     NOT NULL AUTO_INCREMENT,
    `menu_id_item`   INT(11) NOT NULL,
    `count`          INT     NULL,
    `users_id_users` INT(11) NOT NULL,
    `order_date`     DATE    NULL,
    PRIMARY KEY (`idonline_order`),
    INDEX `fk_online_order_users1_idx` (`users_id_users` ASC),
    INDEX `fk_online_order_menu1_idx` (`menu_id_item` ASC),
    CONSTRAINT `fk_online_order_users1`
        FOREIGN KEY (`users_id_users`)
            REFERENCES `restaurant`.`users` (`id_users`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION,
    CONSTRAINT `fk_online_order_menu1`
        FOREIGN KEY (`menu_id_item`)
            REFERENCES `restaurant`.`menu` (`id_item`)
            ON DELETE NO ACTION
            ON UPDATE NO ACTION
)
    ENGINE = InnoDB;


SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
