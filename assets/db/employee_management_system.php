<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 5.2.0
 */

/**
 * Database `employee_management_system`
 */

/* `employee_management_system`.`authentification` */
$authentification = array(
  array('nom_utilisateur' => 'adam_lou','email' => 'adam@gmail.com','mot_de_passe' => '$2y$10$TsiLkJ3xk5esXCwBtANpn.POWH/pvGxGX62b9orZQCU0CCDM1g4/.'),
  array('nom_utilisateur' => 'adil_bendaoui','email' => 'adil@adil.com','mot_de_passe' => '$2y$10$rySagCHrrAmpzvKyxpIFd.7DP5PIhCzpWx5ikoesHThdxlYLXpKsW'),
  array('nom_utilisateur' => 'eren_yeger','email' => 'erenyeger@gmail.com','mot_de_passe' => '$2y$10$Q/aPPUpnIKXWnapWdygbH.GpNqkaDTvPbOnP7EE3U/ssNSsN5EUHO'),
  array('nom_utilisateur' => 'lennon_gardner','email' => 'lennon@gmail.com','mot_de_passe' => '$2y$10$3yvSkQXAqKVc3AkYsL4SbOO8YTfOOeHbLKs5R1dC767WE82RbiWVW'),
  array('nom_utilisateur' => 'lucy_doe','email' => 'lucy@gmail.com','mot_de_passe' => '$2y$10$t9I35EYw7vIxfvNagl4YGOFRo9Wu9t7iKxFnhKdcLxtLFirjrYak2'),
  array('nom_utilisateur' => 'manager_four','email' => 'manager_04@gmail.com','mot_de_passe' => '$2y$10$.dEiZhuZLXiz3tAVKDt/f.6yGSzms7XiBsaDCC7pBWBtuBoaMTrPa'),
  array('nom_utilisateur' => 'manager_one','email' => 'manager_01@gmail.com','mot_de_passe' => '$2y$10$miKZsOFnjpJelq1PLIvupeMQaL.11iXYJ5Lcmx8VFJBbFXhPxFkgi'),
  array('nom_utilisateur' => 'manager_three','email' => 'manager_03@gmail.com','mot_de_passe' => '$2y$10$jr0NUkNv6ByJa5t0.CKTAut7DMvrN.6lRMkWC20FgM9stf7EzxWsC'),
  array('nom_utilisateur' => 'manager_two','email' => 'manager_02@gmail.com','mot_de_passe' => '$2y$10$c0x9JT/7sAmbEkA3874i5e0rboOtjIhq3yRerIOKhCBnJ8O9fi0BG'),
  array('nom_utilisateur' => 'moussa_nye','email' => 'moussa@gmail.com','mot_de_passe' => '$2y$10$xScizyDltL6r7LwwoiiQf.pzl2T8EjNoje6SczaCzRO7/75kQOu0.'),
  array('nom_utilisateur' => 'nok_nobel','email' => 'nobel@gmail.com','mot_de_passe' => '$2y$10$tXMRjVSr3slvAJdPThN4guKUyQ4t9YmgHM3QSpo5rB18rtdohUjd.'),
  array('nom_utilisateur' => 'nora_rizk','email' => 'nora@gmail.com','mot_de_passe' => '$2y$10$822PTomD9zW9n/zcMRrgTOIWAG2LNfkr6x8NtAU.NmRFD.p.nYXZW')
);

/* `employee_management_system`.`contrats` */
$contrats = array(
  array('id_contrat' => '10','id_employe' => '31','date_debut' => '2023-08-01','date_fin' => '2024-01-01','type_contrat' => 'Stage','salaire' => '1500.00','statut_emploi' => 'temps plein','termes_contrat' => 'Le stagiaire rendra compte à Nasima et recevra des conseils et un mentorat tout au long du stage.,
Le stagiaire s\'engage à maintenir la confidentialité de toutes les informations sensibles obtenues au cours du stage.,
Le stagiaire et l\'entreprise ont le droit de mettre fin au stage à tout moment avec un préavis.','congés_jours' => '10'),
  array('id_contrat' => '11','id_employe' => '29','date_debut' => '2023-08-01','date_fin' => '2023-09-01','type_contrat' => 'stage','salaire' => '0.00','statut_emploi' => 'temps plein','termes_contrat' => 'Le stagiaire rendra compte à Nasima et recevra des conseils et un mentorat tout au long du stage.,
Le stagiaire s\'engage à maintenir la confidentialité de toutes les informations sensibles obtenues au cours du stage.,
Le stagiaire et l\'entreprise ont le droit de mettre fin au stage à tout moment avec un préavis.','congés_jours' => '10')
);

/* `employee_management_system`.`demandesconge` */
$demandesconge = array(
  array('id_demande_conge' => '18','id_employe' => '31','id_type_conge' => '2','date_debut' => '2023-08-14','date_fin' => '2023-08-18','jours_totales' => '5.00','statut' => 'Rejeté','commentaires' => 'Maladie')
);

/* `employee_management_system`.`departements` */
$departements = array(
  array('id_departement' => '0','nom_departement' => 'administrateur'),
  array('id_departement' => '1','nom_departement' => 'Ressources Humaines'),
  array('id_departement' => '2','nom_departement' => 'Finance'),
  array('id_departement' => '3','nom_departement' => 'Marketing'),
  array('id_departement' => '4','nom_departement' => 'Opérations'),
  array('id_departement' => '6','nom_departement' => 'Agile Team'),
  array('id_departement' => '7','nom_departement' => 'Programmers')
);

/* `employee_management_system`.`employes` */
$employes = array(
  array('id_employe' => '23','prenom' => 'Nasima','nom' => 'Nobel','email' => 'nobel@gmail.com','titre_poste' => 'Responsable','id_departement' => '4','id_gestionnaire' => NULL,'role' => 'manager','slug' => 'nok-nobel','date_embauché' => '2023-08-15','date_naissance' => '2023-08-13','telephone' => '0641269751','genre' => 'Male','profile' => '64d1bddce1cd6','adresse' => 'loop'),
  array('id_employe' => '25','prenom' => 'alladin','nom' => 'fahmy','email' => 'manager_01@gmail.com','titre_poste' => 'Responsable','id_departement' => '1','id_gestionnaire' => NULL,'role' => 'manager','slug' => 'manager-one','date_embauché' => '2023-01-01','date_naissance' => '1998-01-05','telephone' => '0641269751','genre' => 'Male','profile' => '64d1bddce1cd6','adresse' => 'Adresse 01'),
  array('id_employe' => '26','prenom' => 'tahir','nom' => 'fahmy','email' => 'manager_02@gmail.com','titre_poste' => 'Responsable','id_departement' => '2','id_gestionnaire' => NULL,'role' => 'manager','slug' => 'manager-two','date_embauché' => '2022-05-12','date_naissance' => '1988-01-06','telephone' => '0725698515','genre' => 'Female','profile' => '64d1bddce1cd6','adresse' => 'Adresse 02'),
  array('id_employe' => '27','prenom' => 'mouad','nom' => 'outmani','email' => 'manager_03@gmail.com','titre_poste' => 'Responsable','id_departement' => '3','id_gestionnaire' => NULL,'role' => 'manager','slug' => 'manager-three','date_embauché' => '2023-01-06','date_naissance' => '1978-09-24','telephone' => '0641269751','genre' => 'Female','profile' => '64d1bddce1cd6','adresse' => 'Adresse 03
'),
  array('id_employe' => '28','prenom' => 'adil','nom' => 'bendaoui','email' => 'manager_04@gmail.com','titre_poste' => 'Responsable','id_departement' => '7','id_gestionnaire' => NULL,'role' => 'manager','slug' => 'manager-four','date_embauché' => '2023-01-06','date_naissance' => '1985-09-01','telephone' => '0652364159','genre' => 'Female','profile' => '64d1bddce1cd6','adresse' => 'Adresse 04'),
  array('id_employe' => '29','prenom' => 'Nora','nom' => 'Rizk','email' => 'nora@gmail.com','titre_poste' => 'Operation Maker','id_departement' => '4','id_gestionnaire' => '23','role' => 'employé','slug' => 'nora-rizk','date_embauché' => '2023-08-13','date_naissance' => '1988-08-13','telephone' => '0725698515','genre' => 'Female','profile' => '64d8dc19185f7','adresse' => 'Adresse 05'),
  array('id_employe' => '30','prenom' => 'lennon','nom' => 'gardner','email' => 'lennon@gmail.com','titre_poste' => 'job','id_departement' => '4','id_gestionnaire' => '23','role' => 'employé','slug' => 'lennon-gardner','date_embauché' => '2023-01-01','date_naissance' => '1999-01-01','telephone' => '0641269751','genre' => 'Male','profile' => '64d8dc6f19ed1','adresse' => 'Adresse 06'),
  array('id_employe' => '31','prenom' => 'eren','nom' => 'yeger','email' => 'erenyeger@gmail.com','titre_poste' => 'IT Support','id_departement' => '4','id_gestionnaire' => '23','role' => 'employé','slug' => 'eren-yeger','date_embauché' => '2022-01-01','date_naissance' => '1998-06-12','telephone' => '0765954875','genre' => 'Male','profile' => '64d8dcb6d3c62','adresse' => 'IMM 175 APPRT 5 Temesna'),
  array('id_employe' => '32','prenom' => 'Adam','nom' => 'lou','email' => 'adam@gmail.com','titre_poste' => 'Job','id_departement' => '4','id_gestionnaire' => '23','role' => 'employé','slug' => 'adam-lou','date_embauché' => '2023-01-01','date_naissance' => '1998-01-01','telephone' => '0725698515','genre' => 'Male','profile' => '64d8dd4665270','adresse' => 'Adresse'),
  array('id_employe' => '33','prenom' => 'Moussa','nom' => 'Nye','email' => 'moussa@gmail.com','titre_poste' => 'job','id_departement' => '4','id_gestionnaire' => '23','role' => 'employé','slug' => 'moussa-nye','date_embauché' => '2022-01-01','date_naissance' => '1998-01-01','telephone' => '0641269751','genre' => 'Male','profile' => '64d8dd724460f','adresse' => 'Adresse'),
  array('id_employe' => '34','prenom' => 'Lucy','nom' => 'Doe','email' => 'lucy@gmail.com','titre_poste' => 'job','id_departement' => '4','id_gestionnaire' => '23','role' => 'employé','slug' => 'lucy-doe','date_embauché' => '2023-01-01','date_naissance' => '1999-01-01','telephone' => '0641269751','genre' => 'Female','profile' => '64d8dda597e92','adresse' => 'Adresse')
);

/* `employee_management_system`.`formations` */
$formations = array(
  array('id_formation' => '11','title' => 'Javascript','description' => 'Le programme de formation JavaScript est conçu pour fournir aux participants une compréhension complète de JavaScript, l\'un des langages de programmation les plus populaires utilisés pour créer des applications Web dynamiques et interactives. Ce programme de formation convient aux débutants sans expérience préalable en programmation ainsi qu\'aux développeurs cherchant à améliorer leurs compétences en JavaScript.','date_start' => '2023-08-14','date_end' => '2023-08-21','id_sender' => '23','id_recipient' => '31','status' => 'pending','date_sent' => '2023-08-13 14:54:11'),
  array('id_formation' => '12','title' => 'Javascript','description' => 'Le programme de formation JavaScript est conçu pour fournir aux participants une compréhension complète de JavaScript, l\'un des langages de programmation les plus populaires utilisés pour créer des applications Web dynamiques et interactives. Ce programme de formation convient aux débutants sans expérience préalable en programmation ainsi qu\'aux développeurs cherchant à améliorer leurs compétences en JavaScript.','date_start' => '2023-08-14','date_end' => '2023-08-21','id_sender' => '23','id_recipient' => '34','status' => 'pending','date_sent' => '2023-08-13 14:54:11')
);

/* `employee_management_system`.`horairestravail` */
$horairestravail = array(
  array('id_horaire' => '331','id_employe' => '29','date_travail' => '2023-08-01','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '332','id_employe' => '29','date_travail' => '2023-08-02','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '333','id_employe' => '29','date_travail' => '2023-08-03','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '334','id_employe' => '29','date_travail' => '2023-08-04','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '335','id_employe' => '29','date_travail' => '2023-08-07','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '336','id_employe' => '29','date_travail' => '2023-08-08','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '337','id_employe' => '29','date_travail' => '2023-08-09','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '338','id_employe' => '29','date_travail' => '2023-08-10','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '339','id_employe' => '29','date_travail' => '2023-08-11','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '340','id_employe' => '29','date_travail' => '2023-08-14','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '341','id_employe' => '29','date_travail' => '2023-08-15','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '342','id_employe' => '29','date_travail' => '2023-08-16','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '343','id_employe' => '29','date_travail' => '2023-08-17','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '344','id_employe' => '29','date_travail' => '2023-08-18','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '345','id_employe' => '29','date_travail' => '2023-08-21','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '346','id_employe' => '29','date_travail' => '2023-08-22','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '347','id_employe' => '29','date_travail' => '2023-08-23','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '348','id_employe' => '29','date_travail' => '2023-08-24','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '349','id_employe' => '29','date_travail' => '2023-08-25','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '350','id_employe' => '29','date_travail' => '2023-08-28','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '351','id_employe' => '29','date_travail' => '2023-08-29','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '352','id_employe' => '29','date_travail' => '2023-08-30','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '353','id_employe' => '29','date_travail' => '2023-08-31','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '354','id_employe' => '30','date_travail' => '2023-08-01','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '355','id_employe' => '30','date_travail' => '2023-08-02','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '356','id_employe' => '30','date_travail' => '2023-08-03','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '357','id_employe' => '30','date_travail' => '2023-08-04','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '358','id_employe' => '30','date_travail' => '2023-08-07','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '359','id_employe' => '30','date_travail' => '2023-08-08','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '360','id_employe' => '30','date_travail' => '2023-08-09','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '361','id_employe' => '30','date_travail' => '2023-08-10','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '362','id_employe' => '30','date_travail' => '2023-08-11','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '363','id_employe' => '30','date_travail' => '2023-08-14','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '364','id_employe' => '30','date_travail' => '2023-08-15','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '365','id_employe' => '30','date_travail' => '2023-08-16','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '366','id_employe' => '30','date_travail' => '2023-08-17','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '367','id_employe' => '30','date_travail' => '2023-08-18','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '368','id_employe' => '30','date_travail' => '2023-08-21','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '369','id_employe' => '30','date_travail' => '2023-08-22','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '370','id_employe' => '30','date_travail' => '2023-08-23','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '371','id_employe' => '30','date_travail' => '2023-08-24','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '372','id_employe' => '30','date_travail' => '2023-08-25','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '373','id_employe' => '30','date_travail' => '2023-08-28','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '374','id_employe' => '30','date_travail' => '2023-08-29','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '375','id_employe' => '30','date_travail' => '2023-08-30','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '376','id_employe' => '30','date_travail' => '2023-08-31','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '377','id_employe' => '31','date_travail' => '2023-08-01','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '378','id_employe' => '31','date_travail' => '2023-08-02','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '379','id_employe' => '31','date_travail' => '2023-08-03','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '380','id_employe' => '31','date_travail' => '2023-08-04','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '381','id_employe' => '31','date_travail' => '2023-08-07','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '382','id_employe' => '31','date_travail' => '2023-08-08','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '383','id_employe' => '31','date_travail' => '2023-08-09','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '384','id_employe' => '31','date_travail' => '2023-08-10','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '385','id_employe' => '31','date_travail' => '2023-08-11','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '386','id_employe' => '31','date_travail' => '2023-08-14','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '387','id_employe' => '31','date_travail' => '2023-08-15','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '388','id_employe' => '31','date_travail' => '2023-08-16','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '389','id_employe' => '31','date_travail' => '2023-08-17','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '390','id_employe' => '31','date_travail' => '2023-08-18','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '391','id_employe' => '31','date_travail' => '2023-08-21','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '392','id_employe' => '31','date_travail' => '2023-08-22','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '393','id_employe' => '31','date_travail' => '2023-08-23','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '394','id_employe' => '31','date_travail' => '2023-08-24','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '395','id_employe' => '31','date_travail' => '2023-08-25','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '396','id_employe' => '31','date_travail' => '2023-08-28','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '397','id_employe' => '31','date_travail' => '2023-08-29','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '398','id_employe' => '31','date_travail' => '2023-08-30','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '399','id_employe' => '31','date_travail' => '2023-08-31','heure_entree' => '08:00:00','heure_sortie' => '16:00:00'),
  array('id_horaire' => '400','id_employe' => '32','date_travail' => '2023-08-01','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '401','id_employe' => '32','date_travail' => '2023-08-02','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '402','id_employe' => '32','date_travail' => '2023-08-03','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '403','id_employe' => '32','date_travail' => '2023-08-04','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '404','id_employe' => '32','date_travail' => '2023-08-07','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '405','id_employe' => '32','date_travail' => '2023-08-08','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '406','id_employe' => '32','date_travail' => '2023-08-09','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '407','id_employe' => '32','date_travail' => '2023-08-10','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '408','id_employe' => '32','date_travail' => '2023-08-11','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '409','id_employe' => '32','date_travail' => '2023-08-14','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '410','id_employe' => '32','date_travail' => '2023-08-15','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '411','id_employe' => '32','date_travail' => '2023-08-16','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '412','id_employe' => '32','date_travail' => '2023-08-17','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '413','id_employe' => '32','date_travail' => '2023-08-18','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '414','id_employe' => '32','date_travail' => '2023-08-21','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '415','id_employe' => '32','date_travail' => '2023-08-22','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '416','id_employe' => '32','date_travail' => '2023-08-23','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '417','id_employe' => '32','date_travail' => '2023-08-24','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '418','id_employe' => '32','date_travail' => '2023-08-25','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '419','id_employe' => '32','date_travail' => '2023-08-28','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '420','id_employe' => '32','date_travail' => '2023-08-29','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '421','id_employe' => '32','date_travail' => '2023-08-30','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '422','id_employe' => '32','date_travail' => '2023-08-31','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '423','id_employe' => '33','date_travail' => '2023-08-14','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '424','id_employe' => '33','date_travail' => '2023-08-15','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '425','id_employe' => '33','date_travail' => '2023-08-16','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '426','id_employe' => '33','date_travail' => '2023-08-17','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '427','id_employe' => '33','date_travail' => '2023-08-18','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '428','id_employe' => '33','date_travail' => '2023-08-21','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '429','id_employe' => '33','date_travail' => '2023-08-22','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '430','id_employe' => '33','date_travail' => '2023-08-23','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '431','id_employe' => '33','date_travail' => '2023-08-24','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '432','id_employe' => '33','date_travail' => '2023-08-25','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '433','id_employe' => '33','date_travail' => '2023-08-28','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '434','id_employe' => '33','date_travail' => '2023-08-29','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '435','id_employe' => '33','date_travail' => '2023-08-30','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '436','id_employe' => '33','date_travail' => '2023-08-31','heure_entree' => '09:00:00','heure_sortie' => '17:00:00'),
  array('id_horaire' => '437','id_employe' => '34','date_travail' => '2023-08-14','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '438','id_employe' => '34','date_travail' => '2023-08-15','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '439','id_employe' => '34','date_travail' => '2023-08-16','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '440','id_employe' => '34','date_travail' => '2023-08-17','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '441','id_employe' => '34','date_travail' => '2023-08-18','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '442','id_employe' => '34','date_travail' => '2023-08-21','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '443','id_employe' => '34','date_travail' => '2023-08-22','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '444','id_employe' => '34','date_travail' => '2023-08-23','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '445','id_employe' => '34','date_travail' => '2023-08-24','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '446','id_employe' => '34','date_travail' => '2023-08-25','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '447','id_employe' => '34','date_travail' => '2023-08-28','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '448','id_employe' => '34','date_travail' => '2023-08-29','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '449','id_employe' => '34','date_travail' => '2023-08-30','heure_entree' => '10:00:00','heure_sortie' => '14:00:00'),
  array('id_horaire' => '450','id_employe' => '34','date_travail' => '2023-08-31','heure_entree' => '10:00:00','heure_sortie' => '14:00:00')
);

/* `employee_management_system`.`pointages` */
$pointages = array(
);

/* `employee_management_system`.`reports` */
$reports = array(
  array('id_report' => '17','id_employe' => '31','id_recipient' => '23','recipient_email' => 'nobel@gmail.com','subject' => 'About Stage','content' => 'Some Guys Asked For Stage For Month','date_sent' => '2023-08-13 14:38:50')
);

/* `employee_management_system`.`typesconge` */
$typesconge = array(
  array('id_type_conge' => '1','nom_type_conge' => 'Congé'),
  array('id_type_conge' => '2','nom_type_conge' => 'Maladie'),
  array('id_type_conge' => '3','nom_type_conge' => 'Personnel')
);