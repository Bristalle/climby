CREATE TABLE `utilisateur` (
  `idu` int PRIMARY KEY AUTO_INCREMENT,
  `email` varchar(255),
  `mdp` varchar(255),
  `pseudo` varchar(255),
  `addresse` varchar(255),
  `codePost` varchar(255),
  `ville` varchar(255),
  `telephone` varchar(255),
  `solde` float,
  `acces` int,
  `niveau` int,
  `historique` varchar(255),
  `diplome` varchar(255)
);

INSERT INTO `utilisateur` VALUES
(1, 'admin@admin.fr', '$2y$10$SGHx9ChnYPvyFymoUPhm0eokQygS6FUFMrhUwW.Rj6YlgdWEWZ0wm', 'Admin', '', '', '', '', '', 4, '', '', '');

CREATE TABLE `acces` (
  `ida` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255)
);

INSERT INTO `acces` (`ida`, `nom`) VALUES
(1, 'Inscrit'),
(2, 'Guide'),
(3, 'Moderateur'),
(4, 'Administrateur');

CREATE TABLE `notesguide` (
  `idng` int PRIMARY KEY AUTO_INCREMENT,
  `ciblenote` int,
  `noteur` int,
  `note` int,
  `commentaire` varchar(255)
);

CREATE TABLE `niveau` (
  `idl` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255)
);

CREATE TABLE `inscription` (
  `idi` int PRIMARY KEY AUTO_INCREMENT,
  `participant` int,
  `event` int,
  `date` date
);

CREATE TABLE `inscriptionannulee` (
  `idi` int,
  `participant` int,
  `event` int,
  `date` date,
  `dateannul` date
);

CREATE TABLE `event` (
  `ide` int PRIMARY KEY AUTO_INCREMENT,
  `destination` int,
  `createur` int,
  `hasLead` boolean,
  `nbPlace` int,
  `niveaux` varchar(255),
  `types` varchar(255),
  `critere` varchar(255)
);

CREATE TABLE `notesdestination` (
  `idnd` int PRIMARY KEY AUTO_INCREMENT,
  `noteur` int,
  `destination` int,
  `note` int,
  `commentaire` varchar(255)
);

CREATE TABLE `critere` (
  `idc` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255)
);

CREATE TABLE `destination` (
  `idd` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255),
  `description` varchar(255),
  `adresse` varchar(255),
  `gps` varchar(255),
  `pointEau` boolean,
  `photo` varchar(255)
);

CREATE TABLE `typegrimpe` (
  `idt` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255)
);

ALTER TABLE `acces` ADD FOREIGN KEY (`ida`) REFERENCES `utilisateur` (`acces`);

ALTER TABLE `niveau` ADD FOREIGN KEY (`idl`) REFERENCES `utilisateur` (`niveau`);

ALTER TABLE `notesguide` ADD FOREIGN KEY (`ciblenote`) REFERENCES `utilisateur` (`idu`);

ALTER TABLE `notesguide` ADD FOREIGN KEY (`noteur`) REFERENCES `utilisateur` (`idu`);

ALTER TABLE `event` ADD FOREIGN KEY (`createur`) REFERENCES `utilisateur` (`idu`);

ALTER TABLE `inscription` ADD FOREIGN KEY (`participant`) REFERENCES `utilisateur` (`idu`);

ALTER TABLE `inscriptionannulee` ADD FOREIGN KEY (`participant`) REFERENCES `utilisateur` (`idu`);

ALTER TABLE `inscriptionannulee` ADD FOREIGN KEY (`idi`) REFERENCES `inscription` (`idi`);

ALTER TABLE `event` ADD FOREIGN KEY (`ide`) REFERENCES `inscription` (`event`);

ALTER TABLE `event` ADD FOREIGN KEY (`ide`) REFERENCES `inscriptionannulee` (`event`);

ALTER TABLE `event` ADD FOREIGN KEY (`types`) REFERENCES `typegrimpe` (`idt`);

ALTER TABLE `event` ADD FOREIGN KEY (`critere`) REFERENCES `critere` (`idc`);

ALTER TABLE `destination` ADD FOREIGN KEY (`idd`) REFERENCES `event` (`destination`);

ALTER TABLE `utilisateur` ADD FOREIGN KEY (`idu`) REFERENCES `notesdestination` (`noteur`);

ALTER TABLE `destination` ADD FOREIGN KEY (`idd`) REFERENCES `notesdestination` (`destination`);
