<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'utilisateurs.php';
	require_once CHEMIN_MODELE.'participations.php';
	require_once CHEMIN_MODELE.'disponibilites.php';
	require_once CHEMIN_LIB.'form.php';

	$idUtilisateur = htmlentities($_GET['id']);

	$utilisateur = new utilisateur($idUtilisateur);
	$utilisateur->load();

	$formUtilisateur =  $utilisateur->formulaireEdition();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_utilisateur') {
		if ($formUtilisateur->is_valid($_POST)) {
			$utilisateur->update($formUtilisateur);
			$message = 'Modification du membre ' . $utilisateur->getPrenom() . ' ' . $utilisateur->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=modifier&id='.$utilisateur->getId().'&message=' . $message); //TODO ameliorer
		}

	}

/*
	$participation = new participation($idMembre, '0');
	$formParticipationCourse = $participation->formParticipationCourse();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_participation_course') {
		if ($formParticipationCourse->is_valid($_POST)) {
			$participation->update();
			$message = 'Mise à jour des participations de ' . $membre->getNom() . ' ' .  $membre->getPrenom() .' enregistrée.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=membres&action=modifier&id='.$membre->getId().'&message=' . $message); //TODO ameliorer
		}

	}

	$disponibilite = new disponibilite($idMembre, '0');
	$formDisponibiliteCourse = $disponibilite->formDisponibiliteCourse();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_disponibilite_course') {
		if ($formDisponibiliteCourse->is_valid($_POST)) {
			$disponibilite->update();
			$message =  'Mise à jour des disponibilités de ' . $membre->getNom() . ' ' .  $membre->getPrenom() .' enregistrée.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=membres&action=modifier&id='.$membre->getId().'&message=' . $message); //TODO ameliorer
		}

	}//*/

	require_once CHEMIN_VUE.'modifier.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}