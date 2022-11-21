CREATE DATABASE `db_shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

USE db_shop;

CREATE TABLE IF NOT EXISTS `category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) UNIQUE,
  `status` TINYINT DEFAULT 1,
  PRIMARY KEY `pk_id`(`id`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `product` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(150) NOT NULL,
  `image` VARCHAR(150) NOT NULL,
  `price` float(10, 3) NOT NULL,
  `sale` float(10, 3) NOT NULL DEFAULT 0,
  `category_id` int NOT NULL,
  `status` TINYINT DEFAULT 1,
  PRIMARY KEY `pk_id`(`id`)
) ENGINE = InnoDB;

ALTER TABLE `product`
ADD CONSTRAINT `fk_product_far_category`
  FOREIGN KEY (`category_id`)
  REFERENCES `category` (`id`)
  ON DELETE NO ACTION
  ON UPDATE CASCADE