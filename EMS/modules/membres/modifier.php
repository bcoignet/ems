<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'membres.php';
	require_once CHEMIN_MODELE.'participations.php';
	require_once CHEMIN_MODELE.'disponibilites.php';
	require_once CHEMIN_LIB.'form.php';

	$idMembre = htmlentities($_GET['id']);

	$membre = new membre($idMembre);
	$membre->load();

	$formMembre =  $membre->formulaireEdition();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_membre') {
		if ($formMembre->is_valid($_POST)) {
			$membre->update($formMembre);
			$message = 'Modification du membre ' . $membre->getPrenom() . ' ' . $membre->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=membres&action=modifier&id='.$membre->getId().'&message=' . $message); //TODO ameliorer
		}

	}


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

	}

	require_once CHEMIN_VUE.'modifier.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}