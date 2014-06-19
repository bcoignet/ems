<div id="menu">

		<h2>Menu</h2>

		<?php if (!utilisateur_est_connecte()) {
			echo '<ul>
				<li><a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=connexion">Connexion</a></li>
			</ul>';
		 } else {
			echo '<h3>Espace membre</h3>
			<p>Bienvenue, ' . htmlspecialchars($_SESSION['utilisateur']->getNomUtilisateur()) . '.</p>
			';

				switch($_SESSION['utilisateur']->getGrade()) {
					case '1':
						echo '<ul>Admin';
						echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=membres&action=listing">Liste des membres </a></li>';
						echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=courses&action=listing">Liste des courses </a></li>';
						echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=courses&action=creer">Créer une course </a></li>';
						echo '<li><a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=listing">Liste des utilisateurs </a></li>';
						echo '<li></li>';
						echo '</ul>';

					case '10':
						echo '<ul>Bureau';
						echo '<li><a href="' . CHEMIN_BASE . 'index.php/"> rien 10 </a></li>';
						echo '<li></li>';
						echo '</ul>';

					case '100':
						echo '<ul>Membre';
						echo '<li><a href="' . CHEMIN_BASE . 'index.php/"> rien 100</a></li>';
						echo '</ul>';
					default:
					echo '<a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=deconnexion">Déconnexion</a>';
				}

		 }
		 ?>
</div>



