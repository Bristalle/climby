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
  `diplome` varchar(255),
  `dateInscription` int
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

CREATE TABLE `noteguide` (
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

INSERT INTO `niveau` (`idl`, `nom`) VALUES
(1, 'Débutant');

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
  `hasLead` int,
  `nbPlace` int,
  `niveaux` varchar(255),
  `description` varchar(500),
  `date` int
);

CREATE TABLE `notedestination` (
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
  `description` varchar(500),
  `gps` varchar(255),
  `critere` int,
  `typeDeGrimpe` int,
  `hauteurDuSpot` int,
  `nbVoies` int,
  `cotationMin` varchar(255),
  `cotationMax` varchar(255),
  `pays` varchar(255),
  `region` varchar(255),
  `photo` int
);

CREATE TABLE `typegrimpe` (
  `idt` int PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255)
);

CREATE TABLE `image` (
  `idp` int PRIMARY KEY AUTO_INCREMENT,
  `path` varchar(255)
);