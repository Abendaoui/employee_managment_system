-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 11, 2023 at 08:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `employee_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `authentification`
--

CREATE TABLE `authentification` (
  `nom_utilisateur` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authentification`
--

INSERT INTO `authentification` (`nom_utilisateur`, `email`, `mot_de_passe`) VALUES
('Abendaoui', 'johnsmith@gmail.com', 'adil2001'),
('eren', 'erenyeger@gmail.com', 'adil2001'),
('john', 'luffy@gmail.com', 'adil2001'),
('snow', 'johnsnow@gmail.com', 'adil2001');

-- --------------------------------------------------------

--
-- Table structure for table `contrats`
--

CREATE TABLE `contrats` (
  `id_contrat` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `type_contrat` varchar(50) DEFAULT NULL,
  `salaire` decimal(10,2) DEFAULT NULL,
  `statut_emploi` enum('temps plein','temps partiel') NOT NULL,
  `termes_contrat` text,
  `congés_jours` int DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contrats`
--

INSERT INTO `contrats` (`id_contrat`, `id_employe`, `date_debut`, `date_fin`, `type_contrat`, `salaire`, `statut_emploi`, `termes_contrat`, `congés_jours`) VALUES
(1, 1, '2023-01-15', '2023-12-31', 'Contrat à durée déterminée', '50000.00', 'temps plein', 'Durée: 2 annes', 10),
(2, 2, '2023-03-01', '2024-02-29', 'Stage', '45000.00', 'temps plein', 'Durée: 6 mois', 0),
(3, 3, '2023-02-15', '2023-12-15', 'Contrat à durée indéterminée', '65000.00', 'temps plein', 'Durée: 6 mois,Onle Weekend', 10),
(4, 4, '2023-04-01', '2023-09-30', 'Contrat à durée déterminée', '40000.00', 'temps partiel', 'Durée: 6 mois', 10),
(5, 5, '2023-05-10', '2023-09-30', 'Stage', '20000.00', 'temps partiel', 'Durée: 6 mois', 0),
(6, 6, '2023-05-10', '2023-09-30', 'Contrat à durée déterminée', '20000.00', 'temps plein', 'Durée: 12 mois', 10),
(7, 12, '2023-08-10', '2023-09-10', 'Stage', '1500.00', 'temps plein', 'Term One,Term Two', 0),
(8, 17, '2023-08-01', '2023-08-31', 'Stage', '0.00', 'temps plein', 'Start With 09, End With 17', 10);

-- --------------------------------------------------------

--
-- Table structure for table `demandesconge`
--

CREATE TABLE `demandesconge` (
  `id_demande_conge` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `id_type_conge` int DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `jours_totales` decimal(6,2) DEFAULT NULL,
  `statut` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `commentaires` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `demandesconge`
--

INSERT INTO `demandesconge` (`id_demande_conge`, `id_employe`, `id_type_conge`, `date_debut`, `date_fin`, `jours_totales`, `statut`, `commentaires`) VALUES
(1, 2, 1, '2023-08-10', '2023-08-15', '10.00', 'Approuvé', 'Demande de congé'),
(2, 2, 2, '2023-07-30', '2023-07-31', '12.00', 'Approuvé', 'Congé maladie'),
(3, 3, 1, '2023-09-05', '2023-09-10', '18.00', 'Rejeté', 'Demande de congé'),
(4, 4, 1, '2023-08-05', '2023-08-08', '20.00', 'Rejeté', 'Vacances d\"été'),
(14, 2, 1, '2023-08-08', '2023-08-15', '8.00', 'Rejeté', 'Conge'),
(15, 2, 2, '2023-08-11', '2023-08-14', '4.00', 'En attente', 'Maladie'),
(16, 2, 3, '2023-08-21', '2023-08-28', '8.00', 'En attente', 'Just For Fun'),
(17, 2, 1, '2023-08-10', '2023-08-18', '9.00', 'En attente', 'lol');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id_departement` int NOT NULL,
  `nom_departement` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id_departement`, `nom_departement`) VALUES
(0, 'administrateur'),
(1, 'Ressources Humaines'),
(2, 'Finance'),
(3, 'Marketing'),
(4, 'Opérations'),
(6, 'Agile Team'),
(7, 'Programmer'),
(8, 'Designer'),
(9, 'TechniQue'),
(10, 'Language');

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `id_employe` int NOT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `titre_poste` varchar(100) DEFAULT NULL,
  `id_departement` int DEFAULT NULL,
  `id_gestionnaire` int DEFAULT NULL,
  `role` enum('employé','manager','administrateur') NOT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `date_embauché` date DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `telephone` varchar(25) DEFAULT NULL,
  `genre` enum('Male','Female') NOT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`id_employe`, `prenom`, `nom`, `email`, `titre_poste`, `id_departement`, `id_gestionnaire`, `role`, `slug`, `date_embauché`, `date_naissance`, `telephone`, `genre`, `profile`, `adresse`) VALUES
(0, 'Admin', 'Admin', 'admin@gmail.com', 'administrateur', 0, NULL, 'administrateur', 'admin_admin', '2020-10-10', '1975-07-15', '0652145962', 'Male', 'profile_00', '456 Maple St, Town'),
(1, 'John', 'Doe', 'johnsmith@gmail.com', 'Responsable', 1, NULL, 'manager', 'john_smith', '2023-01-10', '1985-07-15', '0614526975', 'Male', 'profile_01', '21 Boston Street N.Y 12250'),
(2, 'Eren', 'Yeger', 'erenyeger@gmail.com', 'Employee 01 RH', 1, 1, 'employé', 'eren_yeger', '2023-10-10', '1985-07-15', '0652145962', 'Male', 'profile_04', 'Attack On Titan World'),
(3, 'Luffy', 'Monkey D', 'luffy@gmail.com', 'Employee 02 RH', 1, 1, 'employé', 'monkey_d_luffy', '2023-11-10', '1985-07-15', '0752641856', 'Male', 'profile_02', '456 Maple St, Town'),
(4, 'Mikasa', 'Ackerman', 'mikasa@gmail.com', 'Employee 03 RH', 1, 1, 'employé', 'mikasa_ackerman', '2023-09-10', '1985-07-15', '0759864123', 'Male', 'profile_03', '456 Maple St, Town'),
(5, 'judia', 'luke', 'judialuke@gmail.com', 'Employee 04 RH', 1, 1, 'employé', 'judia_luke', '2023-01-10', '1985-07-15', '0635974569', 'Female', 'profile_04', '456 Maple St, Town'),
(6, 'john', 'snow', 'johnsnow@gmail.com', 'responsable Marketing', 2, NULL, 'manager', 'john_snow', '2023-01-10', '1985-07-15', '0756985412', 'Male', 'profile_05', '456 Maple St, Town'),
(9, 'Nadia', 'Stouf', 'nadia@gmail.com', 'Responsable', 3, NULL, 'manager', 'nadia-stouf', '2023-10-08', '2002-01-01', '0725698515', 'Female', '64d1bddce1cd6', 'New York 21 Street 151520'),
(12, 'Neymar', 'Jr', 'neymar@gmail.com', 'Player', 1, 1, 'employé', 'neymar-jr', '2023-01-02', '1988-01-01', '0641269751', 'Male', '64d1cf17bf8b2', 'Brazil'),
(16, 'Lucy', 'Smith', 'lucy@gmail.com', 'Responsable', 4, NULL, 'manager', 'lucy-smith', '2023-01-09', '1998-01-02', '0714256975', 'Female', '64d1bddce1cd6', '21 New Jersey, California 12260'),
(17, 'Nasim', 'Kobal', 'kobal@gmail.com', 'Job', 1, 1, 'employé', 'nasim-kobal', '2023-01-11', '1997-05-12', '0641269751', 'Male', '64d4717534638', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id_formation` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `id_sender` int NOT NULL,
  `id_recipient` int NOT NULL,
  `status` enum('pending','completed') NOT NULL DEFAULT 'pending',
  `date_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `formations`
--

INSERT INTO `formations` (`id_formation`, `title`, `description`, `date_start`, `date_end`, `id_sender`, `id_recipient`, `status`, `date_sent`) VALUES
(1, 'Python Formation', 'In This Course We Will Learn Python Programming Langauge', '2023-08-07', '2023-08-14', 1, 2, 'pending', '2023-08-05 00:00:00'),
(2, 'JavaScript', 'In This Course We Will Learn The latest Verion Of ACMA JS JavaScript ES ', '2023-07-09', '2023-08-01', 1, 2, 'completed', '2023-07-01 00:00:00'),
(3, 'Agile Methologie', 'In This Formation We Will Learn The Project Management Method The Popular One Agile ', '2023-08-10', '2023-08-17', 1, 2, 'pending', '2023-08-07 18:25:35'),
(4, 'Agile Methologie', 'In This Formation We Will Learn The Project Management Method The Popular One Agile ', '2023-08-10', '2023-08-17', 1, 3, 'pending', '2023-08-07 18:25:35'),
(5, 'Scrum Master', 'In This Formation We Will Learn Fundamentals Of Scrum And How To Be Scrum Master', '2023-08-20', '2023-08-30', 1, 4, 'pending', '2023-08-07 18:44:03'),
(6, 'Scrum Master', 'In This Formation We Will Learn Fundamentals Of Scrum And How To Be Scrum Master', '2023-08-20', '2023-08-30', 1, 5, 'pending', '2023-08-07 18:44:03'),
(7, 'Soccer Training', 'Play With Legends', '2023-08-08', '2023-08-10', 1, 12, 'pending', '2023-08-08 06:18:52'),
(8, 'AI', 'About AI', '2023-08-08', '2023-08-10', 1, 2, 'pending', '2023-08-08 23:54:27'),
(9, 'English TechniQue', 'Some Random Description', '2023-08-15', '2023-08-22', 1, 2, 'pending', '2023-08-10 06:06:46'),
(10, 'English TechniQue', 'Some Random Description', '2023-08-15', '2023-08-22', 1, 3, 'pending', '2023-08-10 06:06:46');

-- --------------------------------------------------------

--
-- Table structure for table `horairestravail`
--

CREATE TABLE `horairestravail` (
  `id_horaire` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `date_travail` date DEFAULT NULL,
  `heure_entree` time DEFAULT NULL,
  `heure_sortie` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `horairestravail`
--

INSERT INTO `horairestravail` (`id_horaire`, `id_employe`, `date_travail`, `heure_entree`, `heure_sortie`) VALUES
(216, 2, '2023-08-01', '08:00:00', '16:00:00'),
(218, 2, '2023-08-01', '08:00:00', '17:00:00'),
(219, 2, '2023-08-02', '08:00:00', '17:00:00'),
(220, 2, '2023-08-03', '08:00:00', '17:00:00'),
(221, 2, '2023-08-04', '08:00:00', '17:00:00'),
(222, 2, '2023-08-07', '08:00:00', '17:00:00'),
(223, 2, '2023-08-08', '08:00:00', '17:00:00'),
(224, 2, '2023-08-09', '08:00:00', '17:00:00'),
(225, 2, '2023-08-10', '08:00:00', '17:00:00'),
(226, 2, '2023-08-11', '08:00:00', '17:00:00'),
(227, 2, '2023-08-14', '08:00:00', '17:00:00'),
(228, 2, '2023-08-15', '08:00:00', '17:00:00'),
(229, 2, '2023-08-16', '08:00:00', '17:00:00'),
(230, 2, '2023-08-17', '08:00:00', '17:00:00'),
(231, 2, '2023-08-18', '08:00:00', '17:00:00'),
(232, 2, '2023-08-21', '08:00:00', '17:00:00'),
(233, 2, '2023-08-22', '08:00:00', '17:00:00'),
(234, 2, '2023-08-23', '08:00:00', '17:00:00'),
(235, 2, '2023-08-24', '08:00:00', '17:00:00'),
(236, 2, '2023-08-25', '08:00:00', '17:00:00'),
(237, 2, '2023-08-28', '08:00:00', '17:00:00'),
(238, 2, '2023-08-29', '08:00:00', '17:00:00'),
(239, 2, '2023-08-30', '08:00:00', '17:00:00'),
(240, 2, '2023-08-31', '08:00:00', '17:00:00'),
(262, 3, '2023-08-01', '08:30:00', '16:30:00'),
(263, 3, '2023-08-02', '08:30:00', '16:30:00'),
(264, 3, '2023-08-03', '08:30:00', '16:30:00'),
(265, 3, '2023-08-04', '08:30:00', '16:30:00'),
(266, 3, '2023-08-07', '08:30:00', '16:30:00'),
(267, 3, '2023-08-08', '08:30:00', '16:30:00'),
(268, 3, '2023-08-09', '08:30:00', '16:30:00'),
(269, 3, '2023-08-10', '08:30:00', '16:30:00'),
(270, 3, '2023-08-11', '08:30:00', '16:30:00'),
(271, 3, '2023-08-14', '08:30:00', '16:30:00'),
(272, 3, '2023-08-15', '08:30:00', '16:30:00'),
(273, 3, '2023-08-16', '08:30:00', '16:30:00'),
(274, 3, '2023-08-17', '08:30:00', '16:30:00'),
(275, 3, '2023-08-18', '08:30:00', '16:30:00'),
(276, 3, '2023-08-21', '08:30:00', '16:30:00'),
(277, 3, '2023-08-22', '08:30:00', '16:30:00'),
(278, 3, '2023-08-23', '08:30:00', '16:30:00'),
(279, 3, '2023-08-24', '08:30:00', '16:30:00'),
(280, 3, '2023-08-25', '08:30:00', '16:30:00'),
(281, 3, '2023-08-28', '08:30:00', '16:30:00'),
(282, 3, '2023-08-29', '08:30:00', '16:30:00'),
(283, 3, '2023-08-30', '08:30:00', '16:30:00'),
(284, 3, '2023-08-31', '08:30:00', '16:30:00'),
(285, 17, '2023-08-01', '09:00:00', '17:00:00'),
(286, 17, '2023-08-02', '09:00:00', '17:00:00'),
(287, 17, '2023-08-03', '09:00:00', '17:00:00'),
(288, 17, '2023-08-04', '09:00:00', '17:00:00'),
(289, 17, '2023-08-07', '09:00:00', '17:00:00'),
(290, 17, '2023-08-08', '09:00:00', '17:00:00'),
(291, 17, '2023-08-09', '09:00:00', '17:00:00'),
(292, 17, '2023-08-10', '09:00:00', '17:00:00'),
(293, 17, '2023-08-11', '09:00:00', '17:00:00'),
(294, 17, '2023-08-14', '09:00:00', '17:00:00'),
(295, 17, '2023-08-15', '09:00:00', '17:00:00'),
(296, 17, '2023-08-16', '09:00:00', '17:00:00'),
(297, 17, '2023-08-17', '09:00:00', '17:00:00'),
(298, 17, '2023-08-18', '09:00:00', '17:00:00'),
(299, 17, '2023-08-21', '09:00:00', '17:00:00'),
(300, 17, '2023-08-22', '09:00:00', '17:00:00'),
(301, 17, '2023-08-23', '09:00:00', '17:00:00'),
(302, 17, '2023-08-24', '09:00:00', '17:00:00'),
(303, 17, '2023-08-25', '09:00:00', '17:00:00'),
(304, 17, '2023-08-28', '09:00:00', '17:00:00'),
(305, 17, '2023-08-29', '09:00:00', '17:00:00'),
(306, 17, '2023-08-30', '09:00:00', '17:00:00'),
(307, 17, '2023-08-31', '09:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pointages`
--

CREATE TABLE `pointages` (
  `id_pointage` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure_entree` time DEFAULT NULL,
  `heure_sortie` time DEFAULT NULL,
  `heures_totales` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pointages`
--

INSERT INTO `pointages` (`id_pointage`, `id_employe`, `date`, `heure_entree`, `heure_sortie`, `heures_totales`) VALUES
(1, 2, '2023-07-24', '08:00:00', '16:00:00', '8.00'),
(2, 2, '2023-07-25', '09:00:00', '17:00:00', '8.00'),
(3, 2, '2023-07-26', '08:30:00', '16:30:00', '8.00'),
(4, 3, '2023-07-24', '09:30:00', '17:30:00', '8.00'),
(5, 3, '2023-07-25', '09:00:00', '17:00:00', '8.00');

-- --------------------------------------------------------

--
-- Table structure for table `previousmonthtodelete`
--

CREATE TABLE `previousmonthtodelete` (
  `id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `previousmonthtodelete`
--

INSERT INTO `previousmonthtodelete` (`id`) VALUES
(190),
(191),
(192),
(193),
(194),
(195),
(196),
(197),
(198),
(199),
(200),
(201),
(202),
(203),
(204),
(205),
(206),
(207),
(208),
(209),
(210);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id_report` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `id_recipient` int DEFAULT NULL,
  `recipient_email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `content` text,
  `date_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id_report`, `id_employe`, `id_recipient`, `recipient_email`, `subject`, `content`, `date_sent`) VALUES
(1, 2, 1, 'manager@gmail.com', 'About Stage', 'lol', '2023-08-04 22:00:37'),
(3, 2, 1, 'manager@gmail.com', 'About Stage', 'Some Report Content One', '2023-08-05 01:18:42'),
(4, 3, 2, 'eren@gmail.com', 'About Stage', 'Some Random Content Two', '2023-08-05 01:22:18'),
(5, 2, 3, 'luffy@gmail.com', 'Message', 'I reveived Ur Meassage', '2023-08-05 01:40:31'),
(6, 3, 2, 'eren@gmail.com', 'Message', 'Me Too', '2023-08-05 01:47:19'),
(7, 3, 2, 'eren@gmail.com', 'Just Message', 'Hello There', '2023-08-05 01:56:22'),
(8, 1, 2, 'eren@gmail.com', 'About Stage', 'We Offer Stage To Ista Trainings', '2023-08-08 18:49:43'),
(9, 2, 1, 'manager@gmail.com', 'About Stage', 'Okey We Will Do It Right Now', '2023-08-08 18:52:06'),
(10, 1, 5, 'judialuke@gmail.com', 'About Stage', 'Stop Accecpting In Stage', '2023-08-08 19:07:45'),
(13, 1, 2, 'erenyeger@gmail.com', 'About Stage', 'We Have An Stagaire Now', '2023-08-10 06:18:31'),
(14, 2, 1, 'johnsmith@gmail.com', 'Stage', 'lol', '2023-08-10 07:08:01'),
(15, 1, 2, 'erenyeger@gmail.com', 'About Stage', 'ok', '2023-08-11 17:58:40');

-- --------------------------------------------------------

--
-- Table structure for table `salaires`
--

CREATE TABLE `salaires` (
  `id_salaire` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `salaire_base` decimal(10,2) DEFAULT NULL,
  `primes` decimal(10,2) DEFAULT NULL,
  `deductions` decimal(10,2) DEFAULT NULL,
  `salaire_net` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `salaires`
--

INSERT INTO `salaires` (`id_salaire`, `id_employe`, `salaire_base`, `primes`, `deductions`, `salaire_net`) VALUES
(1, 2, '50000.00', '2000.00', '1500.00', '50500.00'),
(2, 3, '45000.00', '1500.00', '1000.00', '45500.00'),
(3, 4, '65000.00', '3000.00', '2000.00', '66000.00'),
(4, 5, '45000.00', '1500.00', '1000.00', '45500.00'),
(5, 6, '65000.00', '3000.00', '2000.00', '66000.00'),
(6, 1, '40000.00', '1000.00', '800.00', '40300.00');

-- --------------------------------------------------------

--
-- Table structure for table `typesconge`
--

CREATE TABLE `typesconge` (
  `id_type_conge` int NOT NULL,
  `nom_type_conge` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `typesconge`
--

INSERT INTO `typesconge` (`id_type_conge`, `nom_type_conge`) VALUES
(1, 'Congé'),
(2, 'Maladie'),
(3, 'Personnel');

-- --------------------------------------------------------

--
-- Table structure for table `workscheduletemplate`
--

CREATE TABLE `workscheduletemplate` (
  `id_template` int NOT NULL,
  `id_employe` int DEFAULT NULL,
  `day_of_week` int DEFAULT NULL,
  `heure_entree` time DEFAULT NULL,
  `heure_sortie` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authentification`
--
ALTER TABLE `authentification`
  ADD PRIMARY KEY (`nom_utilisateur`);

--
-- Indexes for table `contrats`
--
ALTER TABLE `contrats`
  ADD PRIMARY KEY (`id_contrat`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `demandesconge`
--
ALTER TABLE `demandesconge`
  ADD PRIMARY KEY (`id_demande_conge`),
  ADD KEY `id_employe` (`id_employe`),
  ADD KEY `id_type_conge` (`id_type_conge`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id_departement`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id_employe`),
  ADD KEY `id_departement` (`id_departement`),
  ADD KEY `id_gestionnaire` (`id_gestionnaire`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `id_sender` (`id_sender`),
  ADD KEY `id_recipient` (`id_recipient`);

--
-- Indexes for table `horairestravail`
--
ALTER TABLE `horairestravail`
  ADD PRIMARY KEY (`id_horaire`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `pointages`
--
ALTER TABLE `pointages`
  ADD PRIMARY KEY (`id_pointage`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `previousmonthtodelete`
--
ALTER TABLE `previousmonthtodelete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `salaires`
--
ALTER TABLE `salaires`
  ADD PRIMARY KEY (`id_salaire`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `typesconge`
--
ALTER TABLE `typesconge`
  ADD PRIMARY KEY (`id_type_conge`);

--
-- Indexes for table `workscheduletemplate`
--
ALTER TABLE `workscheduletemplate`
  ADD PRIMARY KEY (`id_template`),
  ADD KEY `id_employe` (`id_employe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id_contrat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `demandesconge`
--
ALTER TABLE `demandesconge`
  MODIFY `id_demande_conge` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id_departement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id_employe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `horairestravail`
--
ALTER TABLE `horairestravail`
  MODIFY `id_horaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `pointages`
--
ALTER TABLE `pointages`
  MODIFY `id_pointage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id_report` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `salaires`
--
ALTER TABLE `salaires`
  MODIFY `id_salaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `typesconge`
--
ALTER TABLE `typesconge`
  MODIFY `id_type_conge` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `contrats_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`) ON DELETE CASCADE;

--
-- Constraints for table `demandesconge`
--
ALTER TABLE `demandesconge`
  ADD CONSTRAINT `demandesconge_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`),
  ADD CONSTRAINT `demandesconge_ibfk_2` FOREIGN KEY (`id_type_conge`) REFERENCES `typesconge` (`id_type_conge`);

--
-- Constraints for table `employes`
--
ALTER TABLE `employes`
  ADD CONSTRAINT `employes_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departements` (`id_departement`),
  ADD CONSTRAINT `employes_ibfk_2` FOREIGN KEY (`id_gestionnaire`) REFERENCES `employes` (`id_employe`);

--
-- Constraints for table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_ibfk_1` FOREIGN KEY (`id_sender`) REFERENCES `employes` (`id_employe`),
  ADD CONSTRAINT `formations_ibfk_2` FOREIGN KEY (`id_recipient`) REFERENCES `employes` (`id_employe`);

--
-- Constraints for table `horairestravail`
--
ALTER TABLE `horairestravail`
  ADD CONSTRAINT `horairestravail_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`);

--
-- Constraints for table `pointages`
--
ALTER TABLE `pointages`
  ADD CONSTRAINT `pointages_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`);

--
-- Constraints for table `salaires`
--
ALTER TABLE `salaires`
  ADD CONSTRAINT `salaires_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`);

--
-- Constraints for table `workscheduletemplate`
--
ALTER TABLE `workscheduletemplate`
  ADD CONSTRAINT `workscheduletemplate_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employes` (`id_employe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
