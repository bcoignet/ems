<?php

if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id']) ) {

	require_once CHEMIN_MODELE.'membres.php';

	$membre = new membre($_GET['id']);
	$membre->load();
	$suppression = $membre->delete();
	if ($suppression === TRUE) {
		$message = 'Le membre ' . $membre->getNom() . ' a bien été supprimée.';
	} else {
		$message = 'Le membre ' . $membre->getNom() . ' n\'a pas pu être supprimée.';
	}
	header('location: ' . CHEMIN_BASE . 'index.php?module=membres&action=listing&message=' . $message); //TODO ameliorer avec message dans variable session


} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}