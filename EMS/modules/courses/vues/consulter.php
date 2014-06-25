<?php
require_once CHEMIN_MODELE.'membres.php';
?>

<div id="infosCourse">

	<div class="div3 infosCourse"> Course: <span class="attributCourse"> <?php echo $course->getNom(); ?></span></div>
	<div class="div3 infosCourse"> Organisé par: <span class="attributCourse"> <?php echo $course->getOrganisation(); ?></span></div>
	<div class="div3 infosCourse"> à: <span class="attributCourse"> <?php echo $course->getVille(); ?></span></div>

	<div class="div2 infosCourse"> Du: <span class="attributCourse"> <?php echo $course->getDebut(true); ?></span></div>
	<div class="div2 infosCourse"> au: <span class="attributCourse"> <?php echo $course->getFin(true); ?></span></div>

	<div class="div2 infosCourse"> Besoin: <span class="attributCourse"> <?php echo $course->getMotoDemande(); ?></span> Motos
	(<?php echo $participation->getNbParticipant(); ?> / <?php echo $course->getMotoDemande(); ?>)
	</div>

	<div class="div2 infosCourse"> Distance: <span class="attributCourse"> <?php echo $course->getDistance(); ?></span> km</div>
	<div class="div2 infosCourse"> avec: <span class="attributCourse"> <?php echo $course->getNbCoureurs(); ?></span> Participants</div>

	<div class="div2 infosCourse"> Défraiement: <span class="attributCourse"> <?php echo $course->getDefraiement(); ?></span> €</div>

	<div class="div2 infosCourse"> Statut: <span class="attributCourse"> <?php echo $course->getStatut(); ?></span></div>

	<div class="div2 infosCourse"> Dernière MAJ: <span class="attributCourse"> <?php echo $course->getDateMAJ(); ?></span></div>
	<div class="div1 infosCourse"> Documents: <span> DOC1</span><span> DOC2</span></div>


	<div id="clear"></div>

</div>


<div id="participationsCourse">
	<?php
	echo '<ul>';
	foreach ($participants as $participant) {
		if ($participant['reponse'] === REPONSE_AFFIRMATIVE) {
			echo '<li class="participe">';
			echo '<span class="intituleParticipant">' . $participant['intitule'] . ' : ' . '</span><span class="participe">' . $participant['reponse']. '</span>';
			echo '</li>';
		}elseif ($participant['reponse'] === REPONSE_NEGATIVE) {
			/*echo '<li>';
			echo '<span class="intituleParticipant">' . $participant['intitule'] . ' : ' . '</span><span>' . $participant['reponse']. '</span>';
			echo '</li>';//*/
		}
	}
	echo '</ul>';
	?>
</div>

<div id="disponibilitesMembre">
	<?php

	echo ' <h3>Prévision de présence </h3><ul>';
	foreach ($disponibles as $disponible) {
		if ($disponible['reponse'] === MEMBRE_PARTICIPE_OUI) {
			echo '<li>';
			echo '<span class="intituleParticipant">' . $disponible['intitule'] . ' : ' . '</span><span class="participe">' . $disponible['reponse']. '</span>';
			echo '</li>';
		}elseif($disponible['reponse'] === MEMBRE_PARTICIPE_AUCUN){
			$disponible['reponse'] = 'Non renseigné';
			echo '<li class="nonRenseigne">';
			echo '<span class="intituleParticipant">' . $disponible['intitule'] . ' : ' . '</span><span class="nonRenseigne">' . $disponible['reponse']. '</span>';
			echo '</li>';
		}else {
			echo '<li>';
			echo '<span class="intituleParticipant">' . $disponible['intitule'] . ' : ' . '</span><span>' . $disponible['reponse']. '</span>';
			echo '</li>';
		}
	}
	echo '</ul>';
	?>
</div>








