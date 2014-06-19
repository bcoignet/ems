<?php
//require_once CHEMIN_MODELE.'courses.php';
require_once CHEMIN_MODELE.'membres.php';
?>
<div>
	<div>
		<?php

		if ($participation->getNbParticipant() <= 0) {
			echo '<a href="' . CHEMIN_BASE . 'index.php?module=courses&action=supprimer&id=' . $course->getId() . '"><button>Supprimer</button></a>';
		}else {
			echo '<a href="' . CHEMIN_BASE . 'index.php?module=courses&action=supprimer&id=' . $course->getId() . ' "><button disabled="disabled" title="Pour supprimer cette course, il faut supprimer les participants">Supprimer</button></a>';
		}
		?>
	</div>

	<div id="infosCourse">
	<?php
		echo $formCourse;
	?>
	</div>

	<div id="participationsCourse">

	Sont prévu sur cette course:

	<?php
		echo $formMembreParticipant;
	?>

	</div>

	<div id="disponibilitesCourse">
	Sont disponible pour cette course:
	<?php
		echo $formMembreDisponible;
	?>
	</div>


	<div id="clear"></div>



</div>