<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'courses.php';
	require_once CHEMIN_MODELE.'participations.php';
	require_once CHEMIN_MODELE.'disponibilites.php';
	require_once CHEMIN_LIB.'form.php';

	$idCourse = htmlentities($_GET['id']);

	$course = new course($idCourse);
	$course->load();

	$formCourse =  $course->formulaireEdition();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_course') {
		if ($formCourse->is_valid($_POST)) {
			$course->update($formCourse);
			$message = 'Modification de la course ' . $course->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=modifier&id=' . $course->getId() . '&message=' . $message); //TODO ameliorer
		}

	}

	$participation = new participation('0', $idCourse);
	$formMembreParticipant = $participation->formMembreParticipant();
	//$formMembreParticipant->bound($_POST);

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_membre_participant') {
		if ($formMembreParticipant->is_valid($_POST)) {
			$participation->update();
			$message = 'Mise à jour des participants de la course ' . $course->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=modifier&id=' . $course->getId() . '&message=' . $message); //TODO ameliorer
		}

	}

	$disponibilite = new disponibilite('0', $idCourse);
	$formMembreDisponible = $disponibilite->formMembreDisponible();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_membre_disponible') {
		if ($formMembreDisponible->is_valid($_POST)) {
			$disponibilite->update();
			$message = 'Mise a jour des disponibilités pour la course ' . $course->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=modifier&id=' . $course->getId() . '&message=' . $message); //TODO ameliorer
		}

	}





	require_once CHEMIN_VUE.'modifier.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}