<div id="menu">
	
		<h2>Menu</h2>
		
		<?php if (!utilisateur_est_connecte()) { 
			echo '<ul>
				<li><a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=connexion">Connexion</a></li>
			</ul>';
		 } else { 
			echo '<h3>Espace membre</h3>
			<p>Bienvenue, ' . htmlspecialchars($_SESSION['utilisateur']->getNomUtilisateur()) . '.</p>
			<ul>';
			
				switch($_SESSION['utilisateur']->getGrade()) {
					case '1':
					echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=membres&action=listing">Liste des membres </a></li>';
					echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=listing">Liste des utilisateurs </a></li>';
					echo '<li></li>';
					
					case '10':
					echo '<li><a href="' . CHEMIN_BASE . 'index.php/"> rien 10 </a></li>';
					echo '<li></li>';
					
					case '100':
					echo '<li><a href="' . CHEMIN_BASE . 'index.php/"> rien 100</a></li>';
					default:
					echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=deconnexion">Déconnexion</a></li>';
				}
			
			echo '</ul>';
		 }
		 ?>
</div>
	
	

