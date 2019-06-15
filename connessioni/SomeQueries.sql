DROP DATABASE IF EXISTS mporio_db; 

CREATE DATABASE mporio_db; 

USE mporio_db; 


CREATE TABLE IF NOT EXISTS `Users` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `FirstMiddleName` VARCHAR(255) NULL,
  `Surname` VARCHAR(255) NULL,
  `StateCode` CHAR(16) NOT NULL,
  `BasePoints` INT UNSIGNED ZEROFILL,
  `ActivePoints` INT ZEROFILL UNSIGNED,
  `IsVolunteer` TINYINT,
  `Wallet` VARCHAR(45),
  PRIMARY KEY (`Id`));
  
INSERT INTO `Users` (FirstMiddleName,Surname,StateCode,BasePoints,IsVolunteer,Wallet) VALUES
	('ALESSIO','MAGRI','MGRLSS81D02E897Y',100,1,'mypassword'),
    ('PINCO','PALLINO','PLLPNC90F08D233N',150,0,'mypassword');

CREATE TABLE IF NOT EXISTS `Producers` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `BusinessName` VARCHAR(255),
  `VatId` VARCHAR(45) NOT NULL,
  `Wallet` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id`));
  
INSERT INTO `Producers` (BusinessName,VatId,Wallet) VALUES
	('SALAMERIA DI PAESE','012534556646','mypassword'),
	('PELATERIA INGROSSO','012546896549','mypassword');

CREATE TABLE IF NOT EXISTS `Products` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NOT NULL,
  `Cost` INT NOT NULL,
  `Barcode` VARCHAR(45),
  `Productsdesc` VARCHAR(255),
  PRIMARY KEY (`Id`));

INSERT INTO `Products` (Name,Cost,Barcode,Productsdesc) VALUES
	('pelati cirio 250g',10,'00000000000','scatole pelati cirio da 250g, confezione da 6'),
	('luganega mantovana',7,'00544505505','luganega confezionata da mezzo Kg'),
	('passata di pomodoro mutti',8,'0541546546','bottiglia di passata di pomodoro da 300g in vetro'),
	('pesto mantovano per risotto',15,'054461879165','pesto mantovano confezionato da 1 Kg');

CREATE TABLE IF NOT EXISTS `Fulfilled` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Producers_id` INT UNSIGNED NOT NULL,
  `Products_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`),
    FOREIGN KEY (`Producers_id`)
		REFERENCES `Producers` (`Id`)
		ON DELETE CASCADE
		ON UPDATE NO ACTION,
    FOREIGN KEY (`Products_id`)
		REFERENCES `Products` (`Id`)
		ON DELETE CASCADE
		ON UPDATE NO ACTION);

INSERT INTO `Fulfilled` (Producers_id,Products_id) VALUES
	(2,1),
	(1,2),
	(2,3),
	(1,4),
	(1,3);


CREATE TABLE IF NOT EXISTS `Transactions` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Timestamp` TIMESTAMP NULL DEFAULT NOW(),
  `Qty` INT,
  `TotalTransactionCost` INT,
  `Fulfilled_Id` INT UNSIGNED NOT NULL,
  `Users_Id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`Id`),
    FOREIGN KEY (`Fulfilled_Id`)
		REFERENCES `Fulfilled` (`Id`)
		ON DELETE NO ACTION
		ON UPDATE NO ACTION,
    FOREIGN KEY (`Users_Id`)
		REFERENCES `Users` (`Id`)
		ON DELETE CASCADE
		ON UPDATE NO ACTION);