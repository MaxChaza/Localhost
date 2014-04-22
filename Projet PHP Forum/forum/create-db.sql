-- --------------------------------------------------------------------------------------------------------
-- 				       --DATABASE OF THE FORUM --
-- AUTHOR : Jordan BOUYAT(jordan.bouyatetu.unilim.fr) & Maxime CHAZALVIEL(maxime.chazalviel@etu.unilim.fr)
-- --------------------------------------------------------------------------------------------------------

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `forum` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;

-- ------------------------------------------------------------
-- Categories table
-- ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS category (
  idCategory INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name TEXT NOT NULL,
  description TEXT NOT NULL,
  PRIMARY KEY(idCategory)
);

-- ------------------------------------------------------------
-- User table
-- ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS users (
  idUser INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(30),
  pass VARCHAR(255) NOT NULL,
  email VARCHAR(45) NOT NULL,
  salt VARCHAR(11) NOT NULL,
  PRIMARY KEY(idUser)
);

-- ------------------------------------------------------------
-- Topics table
-- ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS topic (
  idTopic INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idUser INTEGER UNSIGNED NOT NULL,
  idCategory INTEGER UNSIGNED NOT NULL,
  title TEXT NOT NULL,
  date int(11) NOT NULL,
  editDate int(11) NOT NULL,
  PRIMARY KEY(idTopic),
  INDEX topic_FKIndex1(idUser),
  INDEX topic_FKIndex2(idCategory),
  CONSTRAINT `FK_TOPIC_NEED_IDUSER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`),
  CONSTRAINT `FK_TOPIC_NEED_IDCATEGORY` FOREIGN KEY (`IDCATEGORY`) REFERENCES `category` (`IDCATEGORY`)
);

-- ------------------------------------------------------------
-- Messages table
-- ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS message (
  idMessage INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idTopic INTEGER UNSIGNED NOT NULL,
  idUser INTEGER UNSIGNED NOT NULL,
  message TEXT NULL NOT NULL,
  date int(11) NULL NOT NULL,
  PRIMARY KEY(idMessage),
  INDEX message_FKIndex1(idUser),
  INDEX message_FKIndex2(idTopic),
  CONSTRAINT `FK_MESSAGE_NEED_IDUSER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`),
  CONSTRAINT `FK_MESSAGE_NEED_IDTOPIC` FOREIGN KEY (`IDTOPIC`) REFERENCES `topic` (`IDTOPIC`) 
);

-- ------------------------------------------------------------
-- Roles table
-- ------------------------------------------------------------

CREATE TABLE IF NOT EXISTS role (
  idRole INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  idCategory INTEGER UNSIGNED NOT NULL,
  idUser INTEGER UNSIGNED NOT NULL,
  role TEXT NOT NULL,
  PRIMARY KEY(idRole),
  INDEX role_FKIndex1(idUser),
  INDEX role_FKIndex2(idCategory),
  CONSTRAINT `FK_ROLE_NEED_IDUSER` FOREIGN KEY (`IDUSER`) REFERENCES `users` (`IDUSER`),
  CONSTRAINT `FK_ROLE_NEED_IDCATEGORY` FOREIGN KEY (`IDCATEGORY`) REFERENCES `category` (`IDCATEGORY`)
);
