<?php

if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id']) ) {

	require_once CHEMIN_MODELE.'courses.php';
	//require_once CHEMIN_LIB.'form.php';

	$course = new course($_GET['id']);
	$course->load();
	$suppression = $course->delete();
	if ($suppression === TRUE) {
		$message = 'La course ' . $course->getNom() . ' a bien été supprimée.';
	} else {
		$message = 'La course ' . $course->getNom() . ' n\'a pas pu être supprimée.';
	}
	header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=listing&message=' . $message); //TODO ameliorer avec message dans variable session


} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}