<h2>Page d'accueil</h2>
<?php
if (utilisateur_est_connecte()) {
	echo 'Bonjour ' . $_SESSION['utilisateur']->getNomUtilisateur();
}
?>
<p>test!<br />
</p>