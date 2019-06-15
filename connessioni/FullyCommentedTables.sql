-- -----------------------------------------------------
-- Table`Users`: Gli Utenti
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Users` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `FirstMiddleName` VARCHAR(255) NULL,
  `Surname` VARCHAR(255) NULL,
  `StateCode` CHAR(16) NOT NULL COMMENT 'il codice fiscale dell\'utente, E\' necessario specificarne uno',
  `BasePoints` INT UNSIGNED ZEROFILL NULL COMMENT 'i Punti di base di ripartenza mensile che vengono assegnati dal Caf o dai servizi sociali',
  `ActivePoints` INT ZEROFILL UNSIGNED NULL COMMENT 'I punti attivi attualmente che possono essere modificati anche manualmente oltre che dagli acquisti',
  `IsVolunteer` TINYINT NULL COMMENT 'Flag per identificare i volontari che hanno accesso amministrativo al software',
  `Wallet` VARCHAR(45) NULL COMMENT 'N° di tessera o Wallet da utilizzare come password per l\'account che viene identificato dall\'ID',
  PRIMARY KEY (`Id`));


-- -----------------------------------------------------
-- Table `Producers`: I Fornitori
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Producers` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `BusinessName` VARCHAR(255) NULL,
  `VatId` VARCHAR(45) NOT NULL,
  `Wallet` VARCHAR(45) NOT NULL COMMENT 'Da usare come password assieme all\'ID che è l\'utente',
  PRIMARY KEY (`Id`));


-- -----------------------------------------------------
-- Table `Products`: I Prodotti, solo i dati che li identificano all'esterno
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Products` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Name` VARCHAR(255) NOT NULL,
  `Cost` INT NOT NULL,
  `Barcode` VARCHAR(45) NULL COMMENT 'Il Codice a barre per identificare il prodotto su database informativi esterni. NON E\' il codice da strisciare sullo scontrino',
  `Productsdesc` VARCHAR(255) NULL COMMENT 'Descrizione del proddotto',
  PRIMARY KEY (`Id`));


-- -----------------------------------------------------
-- Table `Fulfilled`: I Prodotti che vengono caricati a magazzino. Sono le Entità da passare a scontrino
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Fulfilled` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Non è il codice a barre, ma il codice assegnato alla merce caricata. Questo perchè un Prodotto può essere rifornito da più fornitori differenti! Diventa quindi necessario creare un codice interno che identifichi il prodotto, che sarà quello da leggere o digitare',
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


-- -----------------------------------------------------
-- Table `Transactions`: Le righe di scontrino
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Transactions` (
  `Id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `Timestamp` TIMESTAMP NULL DEFAULT now() COMMENT 'Quando è avvenuta la transazione',
  `Qty` INT NULL COMMENT 'Quanti prodotti dello stesso tipo sono passati',
  `TotalTransactionCost` INT NULL COMMENT 'Costo totale della transazione di quel prodotto. Utile segnarlo nella riga di scontrino perchè se dovesse cambiare il prezzo del prodotto fulfilled (arrivato a magazzino), lo scontrino non cambia',
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