DROP DATABASE IF EXISTS mporio_db; 

CREATE DATABASE mporio_db; 

USE mporio_db; 

DROP TABLE IF EXISTS `Users`;

CREATE TABLE IF NOT EXISTS `Users` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Created` TIMESTAMP NULL DEFAULT NOW(),
  `FirstMiddleName` VARCHAR(255) NULL,
  `Surname` VARCHAR(255) NULL,
  `StateCode` CHAR(16) NOT NULL,
  `BasePoints` INT UNSIGNED ZEROFILL,
  `ActivePoints` INT ZEROFILL UNSIGNED,
  `IsVolunteer` TINYINT DEFAULT 0,
  `Wallet` VARCHAR(45),
  `UserMail` VARCHAR(255) NULL,
  `UserPhone` VARCHAR(16) NULL,
  PRIMARY KEY (`Id`));
  
INSERT INTO `Users` (FirstMiddleName,Surname,StateCode,BasePoints,IsVolunteer,Wallet,UserMail,UserPhone) VALUES
	('ALESSIO','MAGRI','MGRLSS81D02E897Y',100,1,'mypassword','alessio.magri@libero.it','+393498846632'),
    ('PINCO','PALLINO','PLLPNC90F08D233N',150,0,'mypassword','pinco.pallino@libero.it','+393441234578');




DROP TABLE IF EXISTS `Producers`;

CREATE TABLE IF NOT EXISTS `Producers` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `BusinessName` VARCHAR(255),
  `VatId` VARCHAR(45) NOT NULL,
  `Wallet` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`Id`));
  
INSERT INTO `Producers` (BusinessName,VatId,Wallet) VALUES
	('SALAMERIA DI PAESE','012534556646','mypassword'),
	('PELATERIA INGROSSO','012546896549','mypassword');




DROP TABLE IF EXISTS `Products`;

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




DROP TABLE IF EXISTS `Fulfilled`;

CREATE TABLE IF NOT EXISTS `Fulfilled` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Producers_id` INT UNSIGNED NOT NULL,
  `Products_id` INT UNSIGNED NOT NULL,
  `Qty` INT UNSIGNED NULL DEFAULT 0,
  PRIMARY KEY (`Id`),
  FOREIGN KEY (`Producers_id`)
	REFERENCES `Producers` (`Id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION,
  FOREIGN KEY (`Products_id`)
	REFERENCES `Products` (`Id`)
	ON DELETE CASCADE
	ON UPDATE NO ACTION);

INSERT INTO `Fulfilled` (Producers_id,Products_id,Qty) VALUES
	(2,1,10),
	(1,2,28),
	(2,3,17),
	(1,4,23),
	(1,3,35);





DROP TABLE IF EXISTS `Transactions`;

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

INSERT INTO `Transactions` (Qty,TotalTransactionCost,Fulfilled_Id,Users_Id) VALUES
(2,6,1,2),
(1,2,2,2),
(4,10,3,2),
(6,36,2,1);

		
--ELENCO DEI PRODOTTI ASSOCIATI AD UN PARTICOLARE FORNITORE. SOSTITUIRE 1 CON L'ID DEL FORNITORE
SELECT Fulfilled.Id AS Codice, Products.Name AS Nome, Products.Productsdesc AS Descrizione, Products.Cost AS Prezzo FROM Producers
JOIN Fulfilled on Producers.Id=Fulfilled.Producers_id
JOIN Products on Fulfilled.Products_id=Products.Id
WHERE Producers.Id=1;

--ELENCO DEI PRODOTTI E LORO QUANTITA' A MAGAZZINO, SOMMA TUTTI GLI INGRESSI A MAGAZZINO DATI DAI VARI FORNITORI
SELECT Products.Id AS Id, Products.Barcode AS 'Codice a Barre', Products.Name AS Nome, Products.Productsdesc AS Descrizione, Products.Cost AS Prezzo, SUM(Fulfilled.Qty) AS Qta FROM Products
JOIN Fulfilled on Products.Id=Fulfilled.Products_id
GROUP BY Products.Id;

--ELENCO DEI FORNITORI CHE TRATTANO UN PARTICOLARE PRODOTTO, SOSTITUIRE 1 CON L'ID DEL PRODOTTO
SELECT Producers.Id AS Id, Producers.BusinessName AS Fornitore, Fulfilled.Qty AS 'Pezzi Forniti' FROM Products
JOIN Fulfilled on Products.Id=Fulfilled.Products_id
JOIN Producers on Producers.Id=Fulfilled.Producers_id
WHERE Products.Id=1;


--ELENCO DEI PRODOTTI ACQUISTATI DA UN UTENTE, SOSTITUIRE 2 CON L'ID DELL'UTENTE
SELECT Users.Id, Users.FirstMiddleName, Users.Surname,Transactions.Qty, Transactions.TotalTransactionCost, Products.Name FROM Transactions
JOIN Users on Transactions.Users_Id=Users.Id
JOIN Fulfilled on Fulfilled.Id=Transactions.Fulfilled_Id
JOIN Products on Products.Id=Fulfilled.Products_id
WHERE Users.Id=2;

--ELENCO DEI PRODOTTI ACQUISTATI DA UN UTENTE E FILTRO PER DATA, SOSTITUIRE 2 CON L'ID DELL'UTENTE E SOSTITUIRE LE DUE DATE PER IL FILTRO DEL PERIODO DESIDERATO
SELECT date(Transactions.Timestamp),  Users.Id, Users.FirstMiddleName, Users.Surname,Transactions.Qty, Transactions.TotalTransactionCost, Products.Name FROM Transactions
JOIN Users on Transactions.Users_Id=Users.Id
JOIN Fulfilled on Fulfilled.Id=Transactions.Fulfilled_Id
JOIN Products on Products.Id=Fulfilled.Products_id
WHERE Users.Id=2 && (date(Transactions.Timestamp) BETWEEN '2019-06-21' AND '2019-06-22');

--TOTALE DEL GIORNO DI UN UTENTE. Now può essere sostituito con una data particolare
SELECT Users.FirstMiddleName AS Nome, Users.Surname AS Cognome, SUM(Transactions.TotalTransactionCost) AS Punti Scontrinati FROM Transactions
JOIN Users on Transactions.Users_Id=Users.Id
WHERE Users.Id=2 && (date(Transactions.Timestamp)=date(Now()));


--CLASSIFICA DELL'IMPATTO SOCIALE (PUNTI "ACQUISTATI" DAGLI UTENTI NEL PERIODO). VA SOLO IMPOSTATO IL PERIODO DI RIFERIMENTO
SELECT Producers.BusinessName AS Fornitore, SUM(Transactions.TotalTransactionCost) AS `Impatto Sociale` FROM Transactions
JOIN Fulfilled on Transactions.Fulfilled_Id=Fulfilled.Id
JOIN Producers on Fulfilled.Producers_id=Producers.Id
WHERE date(Transactions.Timestamp) BETWEEN '2019-06-21' AND '2019-06-22'
GROUP BY Producers.Id
ORDER BY `Impatto Sociale` DESC;

--QUANTITA TOTALE DI PRODOTTI DONATI DAL FORNITORE E TRANSATI AGLI UTENTI NEL PERIODO. VANNO IMPOSTATI L'ID DEL FORNITORE E IL PERIODO DI RIFERIMENTO
SELECT Producers.BusinessName AS Fornitore, SUM(Transactions.Qty) AS `Qta Transate` FROM Transactions
JOIN Fulfilled on Transactions.Fulfilled_Id=Fulfilled.Id
JOIN Producers on Fulfilled.Producers_id=Producers.Id
WHERE Producers.Id=2 && date(Transactions.Timestamp) BETWEEN '2019-06-21' AND '2019-06-22';

--SPACCATO PER PRODOTTO DEL TOTALE DI PRODOTTI DONATI DAL FORNITORE E TRANSATI AGLI UTENTI NEL PERIODO. VANNO IMPOSTATI l'ID DEL FORNITORE E IL PERIODO DI RIFERIMENTO
SELECT Products.Name AS Prodotto, SUM(Transactions.Qty) AS `Qta Transate` FROM Transactions
JOIN Fulfilled on Transactions.Fulfilled_Id=Fulfilled.Id
JOIN Producers on Fulfilled.Producers_id=Producers.Id
JOIN Products on Fulfilled.Products_id=Products.Id
WHERE Producers.Id=2 && date(Transactions.Timestamp) BETWEEN '2019-06-21' AND '2019-06-22'
GROUP BY Products.Id;
