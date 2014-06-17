<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'courses.php';
	require_once CHEMIN_MODELE.'participations.php';
	require_once CHEMIN_LIB.'form.php';

	$idCourse = htmlentities($_GET['id']);

	$course = new course($idCourse);
	$course->load();

	$formCourse =  $course->formulaireEdition();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_course') {
		if ($formCourse->is_valid($_POST)) {
			$course->update($formCourse);
			$message = 'Modification de la course ' . $course->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=listing&message=' . $message); //TODO ameliorer
		}

	}

	$participation = new participation('0', $idCourse);
	$formMembreParticipant = $participation->formMembreParticipant();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_membre_participant') {
		if ($formMembreParticipant->is_valid($_POST)) {
			$participation->update($formMembreParticipant);
			error_log('BCT : ' . var_export($_POST, true));
			//$message = 'Modification de la course ' . $course->getNom() . ' enregistré.';
			//header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=listing&message=' . $message); //TODO ameliorer
		}

	}



	require_once CHEMIN_VUE.'modifier.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}