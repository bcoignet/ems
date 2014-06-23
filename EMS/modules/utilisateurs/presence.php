<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_MEMBRE) {

	require_once CHEMIN_MODELE.'membres.php';
	require_once CHEMIN_MODELE.'participations.php';
	require_once CHEMIN_MODELE.'disponibilites.php';
	require_once CHEMIN_LIB.'form.php';

	$idUtilisateur = htmlentities($_SESSION['utilisateur']->getId());
	$idMembre = htmlentities($_SESSION['utilisateur']->getIdMembre());

	$membre = new membre($idMembre);
	$membre->load();



	$participation = new participation($idMembre, '0');
	$formParticipationCourse = $participation->formParticipationCourse();


	$disponibilite = new disponibilite($idMembre, '0');
	$formDisponibiliteCourse = $disponibilite->formDisponibiliteCourse();

	if (isset($_POST['uniqid']) && $_POST['uniqid'] === 'formulaire_disponibilite_course') {
		if ($formDisponibiliteCourse->is_valid($_POST)) {
			$disponibilite->update();
			$message =  'Mise à jour de vos disponibilités enregistrée.';
			header('location: ' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=presence&message=' . $message); //TODO ameliorer
		}

	}

	require_once CHEMIN_VUE.'presence.php';
} else {
	header('Location: ' . CHEMIN_BASE . 'index.php');
}