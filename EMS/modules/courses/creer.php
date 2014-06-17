<?php

if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN ) {

	require_once CHEMIN_MODELE.'courses.php';
	require_once CHEMIN_LIB.'form.php';

	$course = new course('0');
	//$course->load();

	$formCourse =  $course->formulaireEdition();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_course') {
		if ($formCourse->is_valid($_POST)) {
			$course->update($formCourse);
			$message = 'Modification de la course ' . $course->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=courses&action=listing&message=' . $message); //TODO ameliorer
		}

	}

	require_once CHEMIN_VUE.'modifier.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}