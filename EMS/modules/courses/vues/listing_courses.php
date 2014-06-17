<table>
<tr>
	<th>id </th>
	<th> nom </th>
	<th> Type </th>
	<th> Ville </th>
	<th> Orga </th>
	<th> Nb moto </th>
	<th> KM </th>
	<th> Coureurs </th>
	<th> € </th>
	<th> Debut </th>
	<th> h </th>
	<th> Fin </th>
	<th> h </th>
	<th> Statut </th>
	<th> Visibilite </th>
	<th> date_creation </th>
	<th> date_maj </th>
</tr>
<?php

foreach ($courses as $course) {
	$m = $course->getProperties();
	echo '<tr>';
	foreach ($m as $v) {
		echo '<td>' . ($v) . '</td> ';
	}
	echo '<td><a href="' . CHEMIN_BASE . 'index.php?module=courses&action=modifier&id=' . $course->getId() . '">Modifier</a></td>';
	echo '</tr>';


}

?>

</table>