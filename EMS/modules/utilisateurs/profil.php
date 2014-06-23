<?php

if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_MEMBRE ) {

	require_once CHEMIN_MODELE.'utilisateurs.php';
	require_once CHEMIN_LIB.'form.php';

	$utilisateur = new utilisateur($_SESSION['utilisateur']->getId());
	$utilisateur->load();
	$formUtilisateur =  $utilisateur->formulaireProfil();

	$formUtilisateur->bound($_POST);

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_utilisateur_profil') {
		if ($formUtilisateur->is_valid($_POST)) {
			$utilisateur->update($formUtilisateur);
			$message = 'Modification de votre profil effectuée.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=profil&message=' . $message); //TODO ameliorer avec message dans variable session
		}

	}

	require_once CHEMIN_VUE.'profil.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}