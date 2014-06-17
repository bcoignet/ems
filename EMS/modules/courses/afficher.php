<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'courses.php';
	require_once CHEMIN_LIB.'form.php';

	$idCourse = htmlentities($_GET['id']);

	$course = new course($idCourse);
	$course->load();

	require_once CHEMIN_VUE.'afficher.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}