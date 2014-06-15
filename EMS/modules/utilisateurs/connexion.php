<?php

// Vérification des droits d'accès de la page
if (utilisateur_est_connecte()) {

	// On affiche la page d'erreur comme quoi l'utilisateur est déjà connecté   
	require_once CHEMIN_VUE_GLOBALE.'erreur_deja_connecte.php';
	
} else {

	// Ne pas oublier d'inclure la librairie Form
	require_once CHEMIN_LIB.'form.php';

	// "formulaire_connexion" est l'ID unique du formulaire
	$form_connexion = new Form('formulaire_connexion');

	$form_connexion->method('POST');

	$form_connexion->add('Text', 'nom_utilisateur')
				   ->label("Votre nom d'utilisateur");

	$form_connexion->add('Password', 'mot_de_passe')
				   ->label("Votre mot de passe");

	$form_connexion->add('Submit', 'submit')
				   ->value("Connectez-moi !");

	// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
	$form_connexion->bound($_POST);

	// Création d'un tableau des erreurs
	$erreurs_connexion = array();

	// Validation des champs suivant les règles
	if ($form_connexion->is_valid($_POST)) {
		
		list($nom_utilisateur, $mot_de_passe) =
			$form_connexion->get_cleaned_data('nom_utilisateur', 'mot_de_passe');
		
		// On veut utiliser le modèle des utilisateurs (~/modeles/utilisateurs.php)
		//require_once_once(CHEMIN_MODELE.'utilisateurs.php');
		
		// combinaison_connexion_valide() est définit dans ~/modeles/utilisateurs.php
		$id_utilisateur = utilisateur::authentifier($nom_utilisateur, sha1($mot_de_passe)); // combinaison_connexion_valide($nom_utilisateur, sha1($mot_de_passe));
		
		// Si les identifiants sont valides
		if (false !== $id_utilisateur) {
		
			$utilisateur = new utilisateur($id_utilisateur);
			$utilisateur->load();

			// On enregistre les informations dans la session
			$_SESSION['id']     = $id_utilisateur; // a changer.
			$_SESSION['utilisateur'] = $utilisateur;
			
			// Affichage de la confirmation de la connexion
			//require_once CHEMIN_VUE.'connexion_ok.php';
			header('Location: ' . CHEMIN_BASE . 'index.php');
		
		} else {

			$erreurs_connexion[] = "Couple nom d'utilisateur / mot de passe inexistant.";
			
			// On réaffiche le formulaire de connexion
			require_once CHEMIN_VUE.'formulaire_connexion.php';
		}
		
	} else {

		// On réaffiche le formulaire de connexion
		require_once CHEMIN_VUE.'formulaire_connexion.php';
	}
}