<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN) {

	require_once CHEMIN_MODELE.'courses.php';
	$courses = course::listing();
	require_once CHEMIN_VUE.'listing_courses.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}