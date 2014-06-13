<?php
if (utilisateur_est_connecte() && $_SESSION['utilisateur']->getGrade() <= GRADE_ADMIN && isset($_GET['id'])) {
echo 'test4';

	include CHEMIN_MODELE.'membres.php';
	
	$idMembre = htmlentities($_GET['id']);
	
	$membre = detailsMembre($idMembre);
	
	
	
	/*
	
	foreach ($membre as $k=>$v) {
	echo '<div>
			<label for="' . $k. '" >' . $k . '</label><input type="text" value="' . utf8_encode($v) . '" id="'. $k .'"/>
		</div> ';
}
	
	//*/
	
	/*
	$form_membre = new Form('formulaire_connexion');

	$form_membre->method('POST');

	$form_membre->add('Text', 'nom_utilisateur')
				   ->label("Votre nom d'utilisateur");

	$form_membre->add('Password', 'mot_de_passe')
				   ->label("Votre mot de passe");

	$form_membre->add('Submit', 'submit')
				   ->value("Connectez-moi !");

	// Pré-remplissage avec les valeurs précédemment entrées (s'il y en a)
	$form_membre->bound($_POST);//*/
	
	
	
	
	include CHEMIN_VUE.'modifier.php';
} else {
	header('Location: /test/index.php');
}