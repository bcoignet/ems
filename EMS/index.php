<?php

// Initialisation
require_once 'global/init.php';

// Début de la tamporisation de sortie
ob_start();


// Si un module est specifié, on regarde s'il existe
if (!empty($_GET['module']) && !file_exists(MAINTENANCE_DECLENCHEUR)) {

	$module = dirname(__FILE__).'/modules/'.$_GET['module'].'/';

	// Si l'action est specifiée, on l'utilise, sinon, on tente une action par défaut
	$action = (!empty($_GET['action'])) ? $_GET['action'].'.php' : 'index.php';

	// Si l'action existe, on l'exécute
	if (is_file($module.$action)) {
		require_once $module.$action;

	// Sinon, on affiche la page d'accueil !
	} else {
		require_once 'global/accueil.php';
	}

}elseif(file_exists(MAINTENANCE_DECLENCHEUR)) {

	require_once 'global/maintenance.php';
	exit();

// Module non specifié ou invalide ? On affiche la page d'accueil !
} else {
	require_once 'global/accueil.php';
}

// Fin de la tamporisation de sortie
$contenu = ob_get_clean();

// Début du code HTML
require_once 'global/haut.php';

echo $contenu;

// Fin du code HTML
require_once 'global/bas.php';