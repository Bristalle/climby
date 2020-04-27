-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 29 Mars 2017 à 21:35
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pjtter`
--

-- --------------------------------------------------------

--
-- Structure de la table `acces`
--

CREATE TABLE `acces` (
  `ida` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `acces`
--

INSERT INTO `acces` (`ida`, `nom`) VALUES
(1, 'Abonne'),
(2, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `critere`
--

CREATE TABLE `critere` (
  `idc` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `diner`
--

CREATE TABLE `diner` (
  `idd` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `nom` varchar(120) NOT NULL,
  `date` date NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `prix` int(11) NOT NULL,
  `capacite` int(11) NOT NULL,
  `idc` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `idi` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `adresse` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `notehote`
--

CREATE TABLE `notehote` (
  `idn_Hot` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `idu_Hot` int(11) NOT NULL,
  `idu_Inv` int(11) NOT NULL,
  `note` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `noteinvite`
--

CREATE TABLE `noteinvite` (
  `idn_Inv` int(11) NOT NULL,
  `idu_Inv` int(11) NOT NULL,
  `idu_Hot` int(11) NOT NULL,
  `note` float NOT NULL,
  `idd` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resaannulee`
--

CREATE TABLE `resaannulee` (
  `idra` int(11) NOT NULL,
  `idr` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `jour` date NOT NULL,
  `dateAnnulation` date NOT NULL,
  `montantRembourse` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `idr` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `idd` int(11) NOT NULL,
  `jour` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idu` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `addresse` varchar(50) NOT NULL,
  `codePost` varchar(5) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `solde` float NOT NULL,
  `ida` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idu`, `email`, `mdp`, `nom`, `prenom`, `addresse`, `codePost`, `ville`, `telephone`, `solde`, `ida`) VALUES
(1, 'admin@admin.fr', '1c6d66a83a2a06ba491464cb9dced2c2832f3675', 'Admin', 'Admin', 'Admin', '0', 'Admin', '0000000000', 0, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `acces`
--
ALTER TABLE `acces`
  ADD PRIMARY KEY (`ida`);

--
-- Index pour la table `critere`
--
ALTER TABLE `critere`
  ADD PRIMARY KEY (`idc`);

--
-- Index pour la table `diner`
--
ALTER TABLE `diner`
  ADD PRIMARY KEY (`idd`),
  ADD KEY `idu` (`idu`),
  ADD KEY `idc` (`idc`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idi`),
  ADD KEY `idd` (`idd`);

--
-- Index pour la table `notehote`
--
ALTER TABLE `notehote`
  ADD PRIMARY KEY (`idn_Hot`),
  ADD KEY `idd` (`idd`),
  ADD KEY `idu_Hot` (`idu_Hot`),
  ADD KEY `idu_Inv` (`idu_Inv`);

--
-- Index pour la table `noteinvite`
--
ALTER TABLE `noteinvite`
  ADD PRIMARY KEY (`idn_Inv`),
  ADD KEY `idu_Inv` (`idu_Inv`),
  ADD KEY `idu_Hot` (`idu_Hot`),
  ADD KEY `idd` (`idd`);

--
-- Index pour la table `resaannulee`
--
ALTER TABLE `resaannulee`
  ADD PRIMARY KEY (`idra`),
  ADD KEY `idr` (`idr`),
  ADD KEY `idu` (`idu`),
  ADD KEY `idd` (`idd`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`idr`),
  ADD KEY `idu` (`idu`),
  ADD KEY `idd` (`idd`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idu`),
  ADD KEY `ida` (`ida`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `acces`
--
ALTER TABLE `acces`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `critere`
--
ALTER TABLE `critere`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `diner`
--
ALTER TABLE `diner`
  MODIFY `idd` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `image`
--
ALTER TABLE `image`
  MODIFY `idi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `notehote`
--
ALTER TABLE `notehote`
  MODIFY `idn_Hot` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `noteinvite`
--
ALTER TABLE `noteinvite`
  MODIFY `idn_Inv` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `resaannulee`
--
ALTER TABLE `resaannulee`
  MODIFY `idra` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
