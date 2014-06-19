<?php

if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN ) {

	require_once CHEMIN_MODELE.'membres.php';
	require_once CHEMIN_LIB.'form.php';

	$membre = new membre('0');
	$formMembre = $membre->formulaireEdition();
	$formMembre->bound($_POST);

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_membre') {
		if ($formMembre->is_valid($_POST)) {
			$membre->update($formMembre);
			$message = 'Création du membre ' . $membre->getNom() . ' ' . $membre->getPrenom() . ' effectuée.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=membres&action=modifier&id='.$membre->getId().'&message=' . $message); //TODO ameliorer avec message dans variable session
		}

	}

	require_once CHEMIN_VUE.'creer.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}