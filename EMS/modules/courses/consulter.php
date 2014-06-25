<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_MEMBRE && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'courses.php';
	require_once CHEMIN_MODELE.'participations.php';
	require_once CHEMIN_MODELE.'disponibilites.php';
	require_once CHEMIN_LIB.'form.php';

	$idCourse = htmlentities($_GET['id']);

	$course = new course($idCourse);
	$course->load();

	//$formCourse =  $course->formulaireEdition();

	$participation = new participation('0', $idCourse);
	$participants = $participation->getParticipants();


	$disponibilite = new disponibilite('0', $idCourse);
	$disponibles = $disponibilite->getDisponible();


	require_once CHEMIN_VUE.'consulter.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}