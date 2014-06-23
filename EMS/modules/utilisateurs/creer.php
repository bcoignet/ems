<?php

if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN ) {

	require_once CHEMIN_MODELE.'utilisateurs.php';
	require_once CHEMIN_LIB.'form.php';

	$utilisateur = new utilisateur('0');
	$formUtilisateur = $utilisateur->formulaireEdition();
	$formUtilisateur->bound($_POST);

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_utilisateur') {
		if ($formUtilisateur->is_valid($_POST)) {
			$utilisateur->update($formUtilisateur);
			$message = 'Création du membre ' . $utilisateur->getNom() . ' ' . $utilisateur->getPrenom() . ' effectuée.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=listing&message=' . $message); //TODO ameliorer avec message dans variable session
		}

	}

	require_once CHEMIN_VUE.'creer.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}