<table class="beaucoupDeDonnees">
<tr>
	<th> Id </th>
	<th> pseudo </th>
	<th> email </th>
	<th> Inscription</th>
	<th> Avatar </th>
	<th> nom </th>
	<th> grade </th>
	<th> prénom </th>
	<th> mobile </th>
	<th> fixe </th>
	<th> CodeP </th>
	<th> Ville </th>
	<th> Rue </th>
	<th> Batiment </th>
	<th> Complement </th>
	<th> Statut </th>
	<th> Membre </th>
	<th> création </th>
	<th> Maj </th>

</tr>
<?php



foreach ($utilisateurs as $utilisateur) {
	$utilisateurProperties = $utilisateur->getProperties();
	echo '<tr>';
		foreach ($utilisateurProperties as $property) {
			echo '<td>' . ($property) . '</td> ';
		}
		echo '<td><a href="' . CHEMIN_BASE . 'index.php?module=utilisateurs&action=modifier&id=' . $utilisateur->getId() . '">Modifier</a></td>';
	echo '</tr>';


}
?>

</table>