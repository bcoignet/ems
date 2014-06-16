<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {

	require_once CHEMIN_MODELE.'membres.php';
	require_once CHEMIN_LIB.'form.php';

	$idMembre = htmlentities($_GET['id']);

	$membre = new membre($idMembre);
	$membre->load();

	$formMembre =  $membre->formulaireEdition();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_modifier_membre') {
		if ($formMembre->is_valid($_POST)) {
			$membre->update($formMembre);
			$message = 'Modification du membre ' . $membre->getPrenom() . ' ' . $membre->getNom() . ' enregistré.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=membres&action=listing&message=' . $message); //TODO ameliorer
		}

	}

	require_once CHEMIN_VUE.'modifier.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}