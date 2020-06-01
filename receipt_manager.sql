-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 31 mai 2020 à 16:10
-- Version du serveur :  5.7.24
-- Version de PHP :  7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `receipt_manager`
--

-- --------------------------------------------------------

--
-- Structure de la table `ingrediant`
--

DROP TABLE IF EXISTS `ingrediant`;
CREATE TABLE IF NOT EXISTS `ingrediant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `ingrediant`
--

INSERT INTO `ingrediant` (`id`, `name`, `price`) VALUES
(2, '4 tomates', 5),
(3, '300 g de riz', 20),
(4, '200 g de coulis de tomate', 3),
(5, '3 gousses d\'ail', 4),
(6, '3 cm de gingembre frais', 3),
(7, '2 oignons', 5),
(8, '1 c. à café de curcuma', 1),
(9, 'sel', 5),
(10, 'poivre', 6),
(11, 'curcuma', 3),
(12, '10g de viande hachée', 10),
(13, 'filet de poulet', 17);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20200329212600', '2020-05-04 13:05:38'),
('20200403235332', '2020-05-04 13:05:38'),
('20200504130620', '2020-05-04 13:06:36');

-- --------------------------------------------------------

--
-- Structure de la table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instruction` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `preparation` varchar(1500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `picture` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_name` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `receipt`
--

INSERT INTO `receipt` (`id`, `name`, `description`, `instruction`, `preparation`, `level`, `picture`, `image_name`) VALUES
(1, 'Rougail saucisse au Cook expert', 'Le rougail saucisse est un plat typique et populaire à La Réunion, qu\'il soit servi lors d\'un repas de famille ou en plat à emporter, à déguster sur la plage ! Envolez-vous vers cette merveilleuse île, et savourez un plat riche en saveurs et en couleurs. Le dépaysement sera total et pourtant, il ne vous faudra que très peu de temps pour réaliser cette recette.', 'Livraison', 'Pelez le gingembre et les gousses d\'ail. Installez la mini cuve et mettez-y l\'ail et le gingembre. Mixez quelques secondes jusqu\'à ce que l\'ensemble soit bien haché. Réservez.', 5, NULL, 'i91259-poivrons-a-la-poele.jpg'),
(2, 'Poivrons à la poêle', 'Poivrons à la poêle plat rapide pour la maison...', 'livraison', 'ÉTAPE 1: Nettoyez et coupez en deux les poivrons rouges. Retirez les queues, les pépins et le peaux blanches puis tranchez-les en fines lanières.\r\nÉTAPE 2: Pelez et hachez finement l’ail.\r\nÉTAPE 3: Faites chauffer un filet d\'huile d\'olive dans une poêle sur feu vif.', 3, NULL, 'i91259-poivrons-a-la-poele.jpg'),
(3, 'Coq au vin blanc, lardons fumés et champignons', 'Coq au vin blanc, lardons fumés et champignons', 'livraison à domicile', 'ÉTAPE 1: Pelez et émincez les oignons.\r\nÉTAPE 2: Faites revenir le coq avec un peu d’huile dans une cocotte en fonte, puis retirez-le et faites revenir les oignons émincés dans la même cocotte.\r\nÉTAPE 3: Placez à nouveau le coq dans la cocotte. Mouillez avec le vin blanc et l\'eau jusqu\'à hauteur du coq, salez et poivrez.', 5, NULL, 'i87645-coq-au-vin-blanc-lardons-fumes-et-champignons.jpg'),
(4, 'Gigot d\'agneau poêlé à l\'os', 'Le gigot d\'agneau se cuisine traditionnellement entier à la cocotte ou au four. Mais il est également possible de le cuire à la poêle comme le montre cette recette de gigot d\'agneau poêlé à l\'os que nous vous présentons ici en détails. A la fois facile et pratique, ce mode de cuisson conserve bien entendu toute la saveur de la viande.', 'livraison', 'ÉTAPE 1: La première chose à faire pour préparer ce gigot d\'agneau poêlé à l\'os est de monder 2 tomates moyennes, puis de les couper en 4 en éliminant bien les pépins. Concassez ensuite la pulpe.', 5, NULL, '5d1afa632f8e558f57e8ad6e68-large.jpg'),
(5, 'Cassoulet au canard', 'Spécialité culinaire du Languedoc par excellence, le cassoulet est un plat mijoté à base de haricots secs blancs (également appelé lingot ou mogette, selon les régions), proposé accompagné de viande. Il tient son nom du cassolo, le plat creux traditionnel en terre cuite dans lequel il était préparé. Généralement, le cassoulet est cuisiné avec du confit d’oie ou de canard, du lard, de la couenne, du jarret de porc, de la saucisse et de l’agneau. Il peut parfois contenir aussi des légumes comme la tomate, le céleri ou la carotte.', 'livraison', 'ÉTAPE 1: La veille, faites tremper les haricots blancs dans un saladier d’eau.\r\nÉTAPE 2: Le lendemain, égouttez-les et faites-les cuire dans un faitout d’eau froide, avec le thym, l’oignon épluché et piqué de 2 clous de girofle, le sel et le poivre.', 3, NULL, 'i150921-puree-de-celeri.jpeg'),
(6, 'Cassoulet toulousain confit', 'Vous en avez soupé de la volaille et des salades insipides ? Un bon cassoulet, il n’y a que ça de vrai ! Avez-vous déjà cuisiné une recette de cassoulet maison, à base de haricots blancs', 'livraison', 'ÉTAPE 1: 6 heures avant la cuisson du cassoulet, mettez vos haricots à tremper dans un saladier rempli d\'eau pour qu’ils retrouvent de la tendreté. Au moment de la préparation, faites tiédir le confit d\'oie, égouttez-le, et réservez la graisse de côté. Pendant ce temps, égouttez les haricots et mettez-les dans le fond d\'une marmite.', 5, NULL, 'i96959-cassoulet-toulousain-confit.jpeg'),
(7, 'Purée de céleri', 'Aujourd’hui, la purée a souvent une mauvaise image : un plat trop gras (trop de lait et de beurre), trop lourd, peu digeste et très calorique. Certains grands chefs très connus s’y sont attaqués et l’ont même élevée au rang de plat gastronomique. Rassurez-vous, chez Cuisine AZ, nous pensons à vous et à votre ligne : nous vous proposons des purées bien moins caloriques comme la purée de céleri.', 'service', 'ÉTAPE 1: Epluchez le céleri-rave ainsi que la pomme de terre et coupez-les en morceaux. Petite astuce : pensez bien à mettre rapidement les morceaux de céleri dans de l’eau fraîche citronnée afin qu’il ne noircisse pas.\r\nÉTAPE 2: Faites cuire votre céleri et la pomme de terre pendant 15 minutes dans un autocuiseur vapeur.\r\n\r\nÉTAPE 3: Lorsque les cuissons sont parfaites, que votre couteau s’enfonce facilement, mixez le tout en y ajoutant les blancs d’œufs, la noix de muscade, le poivre, le persil et la margarine.\r\n\r\nÉTAPE 4: Mixez jusqu’à obtenir une purée bien lisse.', 5, NULL, 'i150921-puree-de-celeri.jpeg'),
(8, 'Ratatouille niçoise à l\'ancienne', 'La préparer la veille pour le lendemain elle ne sera que meilleur. Vous pouvez la manger tiède ou froide. Elle se conserve très bien au congélateur. N\'hésitez pas à mettre autant d\'herbe fraiches que vous le voulez.', 'à emporter', 'ÉTAPE 1: les courgettes en laissant une peau sur deux avec l\'économe.\r\n\r\nÉTAPE 2: Puis les couper en rondelles pas trop fin ni trop épais.\r\nÉTAPE 3: Ouvrez l\\\'aubergine en deux puis avec une petite cuillére enlevez le centre de la chair où il y a les pépins puis détailler l\'aubergine en cube.\r\n\r\nÉTAPE 4: Emincez l\'oignon et l\'ail \r\nÉTAPE 5: Coupez les poivrons en deux puis enlever les pépins et les parties blanches et détailler les en laniéres.', 3, NULL, 'i75638-ratatouille.jpg'),
(9, 'Osso Bucco facile et rapide', 'Osso Bucco facile et rapide...', 'livraison', 'ÉTAPE 1: Pour la préparation commencez par assaisonner la viande, puis la fariner.\r\nÉTAPE 2: Dans une grande casserole ajoutez le beurre et l\'huile et faites revenir la viande.', 5, NULL, 'i110421-osso-bucco.jpg'),
(10, 'Poulet yassa', 'Plat sénégalais...', 'Poulet yassa', '1h', 1, NULL, 'i87645-coq-au-vin-blanc-lardons-fumes-et-champignons.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `receipt_ingrediant`
--

DROP TABLE IF EXISTS `receipt_ingrediant`;
CREATE TABLE IF NOT EXISTS `receipt_ingrediant` (
  `receipt_id` int(11) NOT NULL,
  `ingrediant_id` int(11) NOT NULL,
  PRIMARY KEY (`receipt_id`,`ingrediant_id`),
  KEY `IDX_96856E472B5CA896` (`receipt_id`),
  KEY `IDX_96856E478AEA29A` (`ingrediant_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `receipt_ingrediant`
--

INSERT INTO `receipt_ingrediant` (`receipt_id`, `ingrediant_id`) VALUES
(1, 5),
(2, 9),
(3, 10),
(4, 6),
(5, 2),
(6, 3),
(7, 3),
(8, 4),
(9, 9),
(10, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Structure de la table `share`
--

DROP TABLE IF EXISTS `share`;
CREATE TABLE IF NOT EXISTS `share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `recipient` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Hello friend i share you this receipt from receipt-manager.com',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Receipt Manager',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EF069D5AA76ED395` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `roles` json NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_active`, `roles`) VALUES
(1, 'ibou', '$2y$13$bsn0lRnBk0wBStEVTtt.p.JrFL5M6vZqt7G/1zzDC/wz9ZhKyll9. ', 'ibouswag64@gmail.com', NULL, '[\"ROLE_ADMIN\"]'),
(2, 'admin', '$2y$13$bsn0lRnBk0wBStEVTtt.p.JrFL5M6vZqt7G/1zzDC/wz9ZhKyll9.', 'admin@mail.com', NULL, '[\"ROLE_USER\"]'),
(3, 'client', '$2y$13$2LGSd4b1FPwPKYdA/zbiU.Zvm29xAuxw0e7hIKpQAarTav/YsIs2C', 'client@mail.com', NULL, '[\"ROLE_USER\"]'),
(4, 'ballas', '$2y$13$fbTPAS/M/jAK8lV.lyClue2iVO7NWxA5sojTNnmrbBrvm5kdL5TGW', 'ballas@gmail.com', NULL, '[\"ROLE_USER\"]'),
(6, 'amelie', '$2y$13$H8frHmnsF3hJ2CBDtKfehOSEcgdZu6FgB2u90tNpfsW2ExYAvgHJ6', 'amelie@mail.com', NULL, '[\"ROLE_USER\"]'),
(7, 'symf', '$2y$13$NbGjg3TZY8vzei6iwiPxMOmd3EQo4VsC.g.xT56fL.Xi/iQKDz9Se', 'symf@mail.com', NULL, '[]'),
(8, 'testuser', '$2y$13$jVdJQMDIAQLA4LnV0MphxO1nUFXmtZkpom1ugMvRqh32bd4QHvYh2', 'testuser@gmail.com', NULL, '[]'),
(9, 'lasttest', '$2y$13$HCl1DpH2rwxQRqJPIMvVeuKUC4A6ClrX8zHIk63adHOk32886C81m', 'lasttest@gmail.com', NULL, '[]');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `receipt_ingrediant`
--
ALTER TABLE `receipt_ingrediant`
  ADD CONSTRAINT `FK_96856E472B5CA896` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_96856E478AEA29A` FOREIGN KEY (`ingrediant_id`) REFERENCES `ingrediant` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `share`
--
ALTER TABLE `share`
  ADD CONSTRAINT `FK_EF069D5AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
