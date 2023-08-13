-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2023 at 02:07 PM
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
('adam_lou', 'adam@gmail.com', '$2y$10$TsiLkJ3xk5esXCwBtANpn.POWH/pvGxGX62b9orZQCU0CCDM1g4/.'),
('adil_bendaoui', 'adil@adil.com', '$2y$10$rySagCHrrAmpzvKyxpIFd.7DP5PIhCzpWx5ikoesHThdxlYLXpKsW'),
('eren_yeger', 'erenyeger@gmail.com', '$2y$10$Q/aPPUpnIKXWnapWdygbH.GpNqkaDTvPbOnP7EE3U/ssNSsN5EUHO'),
('lennon_gardner', 'lennon@gmail.com', '$2y$10$3yvSkQXAqKVc3AkYsL4SbOO8YTfOOeHbLKs5R1dC767WE82RbiWVW'),
('lucy_doe', 'lucy@gmail.com', '$2y$10$t9I35EYw7vIxfvNagl4YGOFRo9Wu9t7iKxFnhKdcLxtLFirjrYak2'),
('manager_four', 'manager_04@gmail.com', '$2y$10$.dEiZhuZLXiz3tAVKDt/f.6yGSzms7XiBsaDCC7pBWBtuBoaMTrPa'),
('manager_one', 'manager_01@gmail.com', '$2y$10$miKZsOFnjpJelq1PLIvupeMQaL.11iXYJ5Lcmx8VFJBbFXhPxFkgi'),
('manager_three', 'manager_03@gmail.com', '$2y$10$jr0NUkNv6ByJa5t0.CKTAut7DMvrN.6lRMkWC20FgM9stf7EzxWsC'),
('manager_two', 'manager_02@gmail.com', '$2y$10$c0x9JT/7sAmbEkA3874i5e0rboOtjIhq3yRerIOKhCBnJ8O9fi0BG'),
('moussa_nye', 'moussa@gmail.com', '$2y$10$xScizyDltL6r7LwwoiiQf.pzl2T8EjNoje6SczaCzRO7/75kQOu0.'),
('nok_nobel', 'nobel@gmail.com', '$2y$10$tXMRjVSr3slvAJdPThN4guKUyQ4t9YmgHM3QSpo5rB18rtdohUjd.'),
('nora_rizk', 'nora@gmail.com', '$2y$10$822PTomD9zW9n/zcMRrgTOIWAG2LNfkr6x8NtAU.NmRFD.p.nYXZW');

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
(10, 31, '2023-08-01', '2024-01-01', 'Stage', '1500.00', 'temps plein', 'Le stagiaire rendra compte à Nasima et recevra des conseils et un mentorat tout au long du stage.,\r\nLe stagiaire s\'engage à maintenir la confidentialité de toutes les informations sensibles obtenues au cours du stage.,\r\nLe stagiaire et l\'entreprise ont le droit de mettre fin au stage à tout moment avec un préavis.', 10),
(11, 29, '2023-08-01', '2023-09-01', 'stage', '0.00', 'temps plein', 'Le stagiaire rendra compte à Nasima et recevra des conseils et un mentorat tout au long du stage.,\r\nLe stagiaire s\'engage à maintenir la confidentialité de toutes les informations sensibles obtenues au cours du stage.,\r\nLe stagiaire et l\'entreprise ont le droit de mettre fin au stage à tout moment avec un préavis.', 10);

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
(18, 31, 2, '2023-08-14', '2023-08-18', '5.00', 'Rejeté', 'Maladie');

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
(7, 'Programmers');

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
(23, 'Nasima', 'Nobel', 'nobel@gmail.com', 'Responsable', 4, NULL, 'manager', 'nok-nobel', '2023-08-15', '2023-08-13', '0641269751', 'Male', '64d1bddce1cd6', 'loop'),
(25, 'alladin', 'fahmy', 'manager_01@gmail.com', 'Responsable', 1, NULL, 'manager', 'manager-one', '2023-01-01', '1998-01-05', '0641269751', 'Male', '64d1bddce1cd6', 'Adresse 01'),
(26, 'tahir', 'fahmy', 'manager_02@gmail.com', 'Responsable', 2, NULL, 'manager', 'manager-two', '2022-05-12', '1988-01-06', '0725698515', 'Female', '64d1bddce1cd6', 'Adresse 02'),
(27, 'mouad', 'outmani', 'manager_03@gmail.com', 'Responsable', 3, NULL, 'manager', 'manager-three', '2023-01-06', '1978-09-24', '0641269751', 'Female', '64d1bddce1cd6', 'Adresse 03\r\n'),
(28, 'adil', 'bendaoui', 'manager_04@gmail.com', 'Responsable', 7, NULL, 'manager', 'manager-four', '2023-01-06', '1985-09-01', '0652364159', 'Female', '64d1bddce1cd6', 'Adresse 04'),
(29, 'Nora', 'Rizk', 'nora@gmail.com', 'Operation Maker', 4, 23, 'employé', 'nora-rizk', '2023-08-13', '1988-08-13', '0725698515', 'Female', '64d8dc19185f7', 'Adresse 05'),
(30, 'lennon', 'gardner', 'lennon@gmail.com', 'job', 4, 23, 'employé', 'lennon-gardner', '2023-01-01', '1999-01-01', '0641269751', 'Male', '64d8dc6f19ed1', 'Adresse 06'),
(31, 'eren', 'yeger', 'erenyeger@gmail.com', 'IT Support', 4, 23, 'employé', 'eren-yeger', '2022-01-01', '1998-06-12', '0765954875', 'Male', '64d8dcb6d3c62', 'IMM 175 APPRT 5 Temesna'),
(32, 'Adam', 'lou', 'adam@gmail.com', 'Job', 4, 23, 'employé', 'adam-lou', '2023-01-01', '1998-01-01', '0725698515', 'Male', '64d8dd4665270', 'Adresse'),
(33, 'Moussa', 'Nye', 'moussa@gmail.com', 'job', 4, 23, 'employé', 'moussa-nye', '2022-01-01', '1998-01-01', '0641269751', 'Male', '64d8dd724460f', 'Adresse'),
(34, 'Lucy', 'Doe', 'lucy@gmail.com', 'job', 4, 23, 'employé', 'lucy-doe', '2023-01-01', '1999-01-01', '0641269751', 'Female', '64d8dda597e92', 'Adresse');

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
(11, 'Javascript', 'Le programme de formation JavaScript est conçu pour fournir aux participants une compréhension complète de JavaScript, l\'un des langages de programmation les plus populaires utilisés pour créer des applications Web dynamiques et interactives. Ce programme de formation convient aux débutants sans expérience préalable en programmation ainsi qu\'aux développeurs cherchant à améliorer leurs compétences en JavaScript.', '2023-08-14', '2023-08-21', 23, 31, 'pending', '2023-08-13 14:54:11'),
(12, 'Javascript', 'Le programme de formation JavaScript est conçu pour fournir aux participants une compréhension complète de JavaScript, l\'un des langages de programmation les plus populaires utilisés pour créer des applications Web dynamiques et interactives. Ce programme de formation convient aux débutants sans expérience préalable en programmation ainsi qu\'aux développeurs cherchant à améliorer leurs compétences en JavaScript.', '2023-08-14', '2023-08-21', 23, 34, 'pending', '2023-08-13 14:54:11');

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
(331, 29, '2023-08-01', '09:00:00', '17:00:00'),
(332, 29, '2023-08-02', '09:00:00', '17:00:00'),
(333, 29, '2023-08-03', '09:00:00', '17:00:00'),
(334, 29, '2023-08-04', '09:00:00', '17:00:00'),
(335, 29, '2023-08-07', '09:00:00', '17:00:00'),
(336, 29, '2023-08-08', '09:00:00', '17:00:00'),
(337, 29, '2023-08-09', '09:00:00', '17:00:00'),
(338, 29, '2023-08-10', '09:00:00', '17:00:00'),
(339, 29, '2023-08-11', '09:00:00', '17:00:00'),
(340, 29, '2023-08-14', '09:00:00', '17:00:00'),
(341, 29, '2023-08-15', '09:00:00', '17:00:00'),
(342, 29, '2023-08-16', '09:00:00', '17:00:00'),
(343, 29, '2023-08-17', '09:00:00', '17:00:00'),
(344, 29, '2023-08-18', '09:00:00', '17:00:00'),
(345, 29, '2023-08-21', '09:00:00', '17:00:00'),
(346, 29, '2023-08-22', '09:00:00', '17:00:00'),
(347, 29, '2023-08-23', '09:00:00', '17:00:00'),
(348, 29, '2023-08-24', '09:00:00', '17:00:00'),
(349, 29, '2023-08-25', '09:00:00', '17:00:00'),
(350, 29, '2023-08-28', '09:00:00', '17:00:00'),
(351, 29, '2023-08-29', '09:00:00', '17:00:00'),
(352, 29, '2023-08-30', '09:00:00', '17:00:00'),
(353, 29, '2023-08-31', '09:00:00', '17:00:00'),
(354, 30, '2023-08-01', '08:00:00', '16:00:00'),
(355, 30, '2023-08-02', '08:00:00', '16:00:00'),
(356, 30, '2023-08-03', '08:00:00', '16:00:00'),
(357, 30, '2023-08-04', '08:00:00', '16:00:00'),
(358, 30, '2023-08-07', '08:00:00', '16:00:00'),
(359, 30, '2023-08-08', '08:00:00', '16:00:00'),
(360, 30, '2023-08-09', '08:00:00', '16:00:00'),
(361, 30, '2023-08-10', '08:00:00', '16:00:00'),
(362, 30, '2023-08-11', '08:00:00', '16:00:00'),
(363, 30, '2023-08-14', '08:00:00', '16:00:00'),
(364, 30, '2023-08-15', '08:00:00', '16:00:00'),
(365, 30, '2023-08-16', '08:00:00', '16:00:00'),
(366, 30, '2023-08-17', '08:00:00', '16:00:00'),
(367, 30, '2023-08-18', '08:00:00', '16:00:00'),
(368, 30, '2023-08-21', '08:00:00', '16:00:00'),
(369, 30, '2023-08-22', '08:00:00', '16:00:00'),
(370, 30, '2023-08-23', '08:00:00', '16:00:00'),
(371, 30, '2023-08-24', '08:00:00', '16:00:00'),
(372, 30, '2023-08-25', '08:00:00', '16:00:00'),
(373, 30, '2023-08-28', '08:00:00', '16:00:00'),
(374, 30, '2023-08-29', '08:00:00', '16:00:00'),
(375, 30, '2023-08-30', '08:00:00', '16:00:00'),
(376, 30, '2023-08-31', '08:00:00', '16:00:00'),
(377, 31, '2023-08-01', '08:00:00', '16:00:00'),
(378, 31, '2023-08-02', '08:00:00', '16:00:00'),
(379, 31, '2023-08-03', '08:00:00', '16:00:00'),
(380, 31, '2023-08-04', '08:00:00', '16:00:00'),
(381, 31, '2023-08-07', '08:00:00', '16:00:00'),
(382, 31, '2023-08-08', '08:00:00', '16:00:00'),
(383, 31, '2023-08-09', '08:00:00', '16:00:00'),
(384, 31, '2023-08-10', '08:00:00', '16:00:00'),
(385, 31, '2023-08-11', '08:00:00', '16:00:00'),
(386, 31, '2023-08-14', '08:00:00', '16:00:00'),
(387, 31, '2023-08-15', '08:00:00', '16:00:00'),
(388, 31, '2023-08-16', '08:00:00', '16:00:00'),
(389, 31, '2023-08-17', '08:00:00', '16:00:00'),
(390, 31, '2023-08-18', '08:00:00', '16:00:00'),
(391, 31, '2023-08-21', '08:00:00', '16:00:00'),
(392, 31, '2023-08-22', '08:00:00', '16:00:00'),
(393, 31, '2023-08-23', '08:00:00', '16:00:00'),
(394, 31, '2023-08-24', '08:00:00', '16:00:00'),
(395, 31, '2023-08-25', '08:00:00', '16:00:00'),
(396, 31, '2023-08-28', '08:00:00', '16:00:00'),
(397, 31, '2023-08-29', '08:00:00', '16:00:00'),
(398, 31, '2023-08-30', '08:00:00', '16:00:00'),
(399, 31, '2023-08-31', '08:00:00', '16:00:00'),
(400, 32, '2023-08-01', '09:00:00', '17:00:00'),
(401, 32, '2023-08-02', '09:00:00', '17:00:00'),
(402, 32, '2023-08-03', '09:00:00', '17:00:00'),
(403, 32, '2023-08-04', '09:00:00', '17:00:00'),
(404, 32, '2023-08-07', '09:00:00', '17:00:00'),
(405, 32, '2023-08-08', '09:00:00', '17:00:00'),
(406, 32, '2023-08-09', '09:00:00', '17:00:00'),
(407, 32, '2023-08-10', '09:00:00', '17:00:00'),
(408, 32, '2023-08-11', '09:00:00', '17:00:00'),
(409, 32, '2023-08-14', '09:00:00', '17:00:00'),
(410, 32, '2023-08-15', '09:00:00', '17:00:00'),
(411, 32, '2023-08-16', '09:00:00', '17:00:00'),
(412, 32, '2023-08-17', '09:00:00', '17:00:00'),
(413, 32, '2023-08-18', '09:00:00', '17:00:00'),
(414, 32, '2023-08-21', '09:00:00', '17:00:00'),
(415, 32, '2023-08-22', '09:00:00', '17:00:00'),
(416, 32, '2023-08-23', '09:00:00', '17:00:00'),
(417, 32, '2023-08-24', '09:00:00', '17:00:00'),
(418, 32, '2023-08-25', '09:00:00', '17:00:00'),
(419, 32, '2023-08-28', '09:00:00', '17:00:00'),
(420, 32, '2023-08-29', '09:00:00', '17:00:00'),
(421, 32, '2023-08-30', '09:00:00', '17:00:00'),
(422, 32, '2023-08-31', '09:00:00', '17:00:00'),
(423, 33, '2023-08-14', '09:00:00', '17:00:00'),
(424, 33, '2023-08-15', '09:00:00', '17:00:00'),
(425, 33, '2023-08-16', '09:00:00', '17:00:00'),
(426, 33, '2023-08-17', '09:00:00', '17:00:00'),
(427, 33, '2023-08-18', '09:00:00', '17:00:00'),
(428, 33, '2023-08-21', '09:00:00', '17:00:00'),
(429, 33, '2023-08-22', '09:00:00', '17:00:00'),
(430, 33, '2023-08-23', '09:00:00', '17:00:00'),
(431, 33, '2023-08-24', '09:00:00', '17:00:00'),
(432, 33, '2023-08-25', '09:00:00', '17:00:00'),
(433, 33, '2023-08-28', '09:00:00', '17:00:00'),
(434, 33, '2023-08-29', '09:00:00', '17:00:00'),
(435, 33, '2023-08-30', '09:00:00', '17:00:00'),
(436, 33, '2023-08-31', '09:00:00', '17:00:00'),
(437, 34, '2023-08-14', '10:00:00', '14:00:00'),
(438, 34, '2023-08-15', '10:00:00', '14:00:00'),
(439, 34, '2023-08-16', '10:00:00', '14:00:00'),
(440, 34, '2023-08-17', '10:00:00', '14:00:00'),
(441, 34, '2023-08-18', '10:00:00', '14:00:00'),
(442, 34, '2023-08-21', '10:00:00', '14:00:00'),
(443, 34, '2023-08-22', '10:00:00', '14:00:00'),
(444, 34, '2023-08-23', '10:00:00', '14:00:00'),
(445, 34, '2023-08-24', '10:00:00', '14:00:00'),
(446, 34, '2023-08-25', '10:00:00', '14:00:00'),
(447, 34, '2023-08-28', '10:00:00', '14:00:00'),
(448, 34, '2023-08-29', '10:00:00', '14:00:00'),
(449, 34, '2023-08-30', '10:00:00', '14:00:00'),
(450, 34, '2023-08-31', '10:00:00', '14:00:00');

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
(17, 31, 23, 'nobel@gmail.com', 'About Stage', 'Some Guys Asked For Stage For Month', '2023-08-13 14:38:50');

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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id_report`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `typesconge`
--
ALTER TABLE `typesconge`
  ADD PRIMARY KEY (`id_type_conge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contrats`
--
ALTER TABLE `contrats`
  MODIFY `id_contrat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `demandesconge`
--
ALTER TABLE `demandesconge`
  MODIFY `id_demande_conge` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id_departement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id_employe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_formation` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `horairestravail`
--
ALTER TABLE `horairestravail`
  MODIFY `id_horaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=451;

--
-- AUTO_INCREMENT for table `pointages`
--
ALTER TABLE `pointages`
  MODIFY `id_pointage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id_report` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `employes_ibfk_2` FOREIGN KEY (`id_gestionnaire`) REFERENCES `employes` (`id_employe`),
  ADD CONSTRAINT `fk_id_gestionnaire` FOREIGN KEY (`id_gestionnaire`) REFERENCES `employes` (`id_employe`) ON DELETE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
