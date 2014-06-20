<div>


	<div>
	<?php
	/*
		if ($participation->getNbParticipant() <= 0) {

		}else {
			echo '<a href="' . CHEMIN_BASE . 'index.php?module=membres&action=supprimer&id=' . $membre->getId() . ' "><button disabled="disabled" title="Pour supprimer ce membre, il faut supprimer les participants">Supprimer</button></a>';
		}//*/
		echo '<a href="' . CHEMIN_BASE . 'index.php?module=membres&action=supprimer&id=' . $membre->getId() . '"><button>Supprimer</button></a>';

	?>
	</div>

	<div id="infosMembre">
	<?php
		echo $formMembre;
	?>
	</div>

	<div id="participationsMembre">

	<span><?php echo $membre->getNom() . ' ' . $membre->getPrenom();?></span>
	est prévu sur les courses suivantes:

	<?php
		echo $formParticipationCourse;
	?>

	</div>

	<div id="disponibilitesMembre">
	<span><?php echo $membre->getNom() . ' ' . $membre->getPrenom();?></span>
	est disponible pour les courses suivantes:
	<?php
		echo $formDisponibiliteCourse;
	?>
	</div>

</div>