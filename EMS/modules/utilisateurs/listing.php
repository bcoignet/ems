<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN) {

	require_once CHEMIN_MODELE.'utilisateurs.php';
	$utilisateurs = utilisateur::listing();
	require_once CHEMIN_VUE.'listing.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}