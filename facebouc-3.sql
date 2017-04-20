-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 20 Avril 2017 à 00:06
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `facebouc`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `IDavis` int(11) NOT NULL,
  `avis` varchar(200) NOT NULL COMMENT 'like, love...',
  `IDmembre` int(11) NOT NULL,
  `IDpublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `IDcommentaire` int(11) NOT NULL,
  `commentaire` varchar(10000) NOT NULL,
  `timeStamp` timestamp NOT NULL,
  `IDmembre` int(11) NOT NULL,
  `IDpublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `IDcontenu` int(11) NOT NULL,
  `texte` varchar(10000) NOT NULL,
  `lienPhoto` varchar(200) NOT NULL,
  `lienVideo` varchar(200) NOT NULL,
  `IDpublication` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenu`
--

INSERT INTO `contenu` (`IDcontenu`, `texte`, `lienPhoto`, `lienVideo`, `IDpublication`) VALUES
(1, 'Coucou ça va ?', 'images/13686567_176307279453507_2457480891266410433_n.jpg', '', 1),
(2, 'Voila voilà quoi...', 'images/13690768_169322033485365_4184775337990159796_n.jpg', '', 2),
(3, 'C\'est comme ça.', 'images/13920637_1240814802605129_4778159896970647878_n.jpg', '', 4),
(4, 'Il fait beau.', 'images/13921141_1240814349271841_2383311620150254043_n.jpg', '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `conversation`
--

CREATE TABLE `conversation` (
  `IDconversation` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL COMMENT 'TimeStamp de la creation de la conversation'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `estamisavec`
--

CREATE TABLE `estamisavec` (
  `IDestAmisAvec` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL COMMENT 'timeStamp du debut de l''amitie',
  `degreDAmitie` int(11) NOT NULL COMMENT 'Entre 0 et 5',
  `IDmembre1` int(11) NOT NULL,
  `IDmembre2` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `estamisavec`
--

INSERT INTO `estamisavec` (`IDestAmisAvec`, `timeStamp`, `degreDAmitie`, `IDmembre1`, `IDmembre2`) VALUES
(1, '2017-04-19 07:53:18', 1, 1, 2),
(2, '2017-04-19 07:53:18', 2, 1, 4),
(3, '2017-04-19 07:54:01', 3, 2, 3),
(4, '2017-04-19 07:54:01', 5, 4, 3),
(5, '2017-04-19 09:55:36', 1, 2, 1),
(6, '2017-04-19 09:55:36', 2, 4, 1),
(7, '2017-04-19 09:55:36', 3, 3, 2),
(8, '2017-04-19 09:55:36', 4, 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `IDmembre` int(11) NOT NULL,
  `adresseMail` varchar(200) NOT NULL,
  `pseudo` varchar(200) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `statut` tinyint(1) NOT NULL,
  `dateNaissance` date NOT NULL,
  `lienPhotoProfil` varchar(200) NOT NULL,
  `lienPhotoCouverture` varchar(200) NOT NULL,
  `entrepriseDeTravail` varchar(200) NOT NULL,
  `domaineEntreprise` varchar(200) NOT NULL,
  `stageJob` varchar(200) NOT NULL,
  `ecolesEffectuees` varchar(200) NOT NULL,
  `hobby1` varchar(200) NOT NULL,
  `hobby2` varchar(200) NOT NULL,
  `hobby3` varchar(200) NOT NULL,
  `hobby4` varchar(200) NOT NULL,
  `situationMaritale` varchar(200) NOT NULL,
  `nbrEnfant` varchar(200) NOT NULL,
  `freresEtSoeurs` varchar(200) NOT NULL,
  `telephone` varchar(200) NOT NULL,
  `adresse` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`IDmembre`, `adresseMail`, `pseudo`, `nom`, `prenom`, `statut`, `dateNaissance`, `lienPhotoProfil`, `lienPhotoCouverture`, `entrepriseDeTravail`, `domaineEntreprise`, `stageJob`, `ecolesEffectuees`, `hobby1`, `hobby2`, `hobby3`, `hobby4`, `situationMaritale`, `nbrEnfant`, `freresEtSoeurs`, `telephone`, `adresse`) VALUES
(1, 'salut.coucou@gmail.com', 'test1', 'coucou', 'salut', 0, '2016-03-15', 'images/10670027_10203800203556774_3089741658204265701_n.jpg', 'images/10406402_10204620810511435_7002122038657843683_n.jpg', 'athenes', 'boisson', 'cosmic', 'ECE Paris', 'plonoger', 'nager', 'courir', 'sauter', 'en couple', '0', 'Mathilde', '0123456789', '76 le bout du chemin'),
(2, 'nico.v.44@gmail.com', 'nico.v.44', 'VERHELST', 'Nicolas', 0, '2016-10-11', 'images/13592368_1171883799498765_644222975215620625_n.jpg', 'images/13417677_10208323281427013_40448761209229030_n.jpg', 'technocool', 'danse', 'salsa', 'danceschool', 'danser', 'courir', 'vomir', 'boiter', 'en couple', '0', 'Marion', '7585638542', '85 avenue blanche'),
(3, 'pierre.moulin@gmail.com', 'test3', 'moulin', 'pierre', 0, '2016-08-29', 'images/17799266_10210897642869590_6637179002668605661_n.jpg', 'images/10616496_611274248982434_7582737395185200855_n.jpg', 'safran', 'electronique', 'thales', 'polytechnique', 'parler', 'manger', 'sauter', 'hurler', 'marié', '2', 'Jane, Guy', '0785436853', '83 avenue du grand froid'),
(4, 'bosse.grand@gmail.com', 'test4admin', 'Grand', 'Bosse', 1, '2014-09-17', 'images/17991964_450127798672654_6582715970568460569_n.jpg', 'images/17904435_2254259914798340_1532473128001244745_n.jpg', 'SNCF', 'train', 'pancartage', 'Ensimag', 'compter', 'recompter', 'denombrer', 'danser', 'Célibataire', '0', 'Pierre', '0634569205', '78 rue des maths');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `IDmessage` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL COMMENT 'TimeStamp de l''envoie du message',
  `message` varchar(10000) NOT NULL,
  `IDconversation` int(11) NOT NULL,
  `IDmembre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `participe`
--

CREATE TABLE `participe` (
  `IDparticipe` int(11) NOT NULL,
  `privilege` varchar(200) NOT NULL,
  `IDmembre` int(11) NOT NULL,
  `IDconversation` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `IDpublication` int(11) NOT NULL,
  `type` varchar(200) NOT NULL COMMENT 'Photo, video, message...',
  `timeStamp` timestamp NOT NULL,
  `lieu` varchar(200) NOT NULL,
  `sentiment` varchar(200) NOT NULL,
  `action` varchar(200) NOT NULL,
  `statutPublication` tinyint(1) NOT NULL COMMENT 'Public : 0, Prive : 1',
  `IDmembre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`IDpublication`, `type`, `timeStamp`, `lieu`, `sentiment`, `action`, `statutPublication`, `IDmembre`) VALUES
(1, 'photo', '2017-04-19 22:51:51', '', '', '', 0, 2),
(2, 'photo', '2017-04-19 22:52:41', '', '', '', 0, 2),
(3, 'photo', '2017-04-19 22:52:41', '', '', '', 0, 2),
(4, 'photo', '2017-04-19 22:53:13', '', '', '', 0, 2);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`IDavis`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`IDcommentaire`);

--
-- Index pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`IDcontenu`);

--
-- Index pour la table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`IDconversation`);

--
-- Index pour la table `estamisavec`
--
ALTER TABLE `estamisavec`
  ADD PRIMARY KEY (`IDestAmisAvec`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`IDmembre`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`IDmessage`);

--
-- Index pour la table `participe`
--
ALTER TABLE `participe`
  ADD PRIMARY KEY (`IDparticipe`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`IDpublication`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `IDavis` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `IDcommentaire` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `contenu`
--
ALTER TABLE `contenu`
  MODIFY `IDcontenu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `IDconversation` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `estamisavec`
--
ALTER TABLE `estamisavec`
  MODIFY `IDestAmisAvec` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `IDmembre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `IDmessage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `participe`
--
ALTER TABLE `participe`
  MODIFY `IDparticipe` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `IDpublication` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
