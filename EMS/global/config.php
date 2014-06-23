<?php

define ('CHEMIN_LIB', 'libs/');
define ('CHEMIN_VUE', 'vues/');
define ('CHEMIN_MODELE', 'modeles/');
define ('CHEMIN_VUE_GLOBALE', 'vues_globales/');
define ('CHEMIN_BASE', '/EMS/');

define ('MAINTENANCE_DECLENCHEUR', 'maintenance.txt');

define ('SQL_USERNAME', 'root');
define ('SQL_PASSWORD', '');
define ('SQL_DSN', 'mysql:host=127.0.0.1;port=3306;dbname=test2');

define ('SEXE_MASCULIN', 'm');
define ('SEXE_FEMININ', 'f');

define ('TYPE_MEMBRE_MOTARD', 'Motard');
define ('TYPE_MEMBRE_PIETON', 'Piéton');

define ('TYPE_MOTO_ROUTIERE', 'Routière');
define ('TYPE_MOTO_ROADSTER', 'Roadster');
define ('TYPE_MOTO_GT', 'GT');
define ('TYPE_MOTO_CUSTOM', 'Custom');
define ('TYPE_MOTO_TRAIL', 'Trail');
define ('TYPE_MOTO_SPORTIVE', 'Sportive');
define ('TYPE_MOTO_AUCUNE', '');

define ('TYPE_COURSE_TRIATHLON', 'Triathlon');
define ('TYPE_COURSE_EN_LIGNE', 'Ligne');
define ('TYPE_COURSE_CIRCUIT', 'Circuit');
define ('TYPE_COURSE_AUCUN', '');

define ('TYPE_STATUT_COURSE_ANNONCE', 'Annoncée');
define ('TYPE_STATUT_COURSE_NEGOCIATION', 'Négociation');
define ('TYPE_STATUT_COURSE_SIGNE', 'Signée');
define ('TYPE_STATUT_COURSE_PERDU', 'Perdue');

define ('TYPE_VISIBILITE_TOUS', 'Tous');
define ('TYPE_VISIBILITE_ADMIN', 'Admin');
define ('TYPE_VISIBILITE_NON', 'Non');

define ('MEMBRE_PARTICIPE_OUI',  'Oui');
define ('MEMBRE_PARTICIPE_NON',  'Non');
define ('MEMBRE_PARTICIPE_PEUT_ETRE',  'Peut être');
define ('MEMBRE_PARTICIPE_AUCUN',  '');

define ('MEMBRE_INACTIF_OUI' , 'Oui');
define ('MEMBRE_INACTIF_NON' , 'Non');

define ('GRADE_ADMIN', '1');
define ('GRADE_BUREAU', '10');
define ('GRADE_MEMBRE', '100');

date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, "");
