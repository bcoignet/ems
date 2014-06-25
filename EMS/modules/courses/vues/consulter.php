<?php
require_once CHEMIN_MODELE.'membres.php';
?>
<div>


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
<div id="infosCourse">

<div class="div3 infosCourse"> Course: <span class="attributCourse"> <?php echo $course->getNom(); ?></span></div>
<div class="div3 infosCourse"> Organisé par: <span class="attributCourse"> <?php echo $course->getOrganisation(); ?></span></div>
<div class="div3 infosCourse"> à: <span class="attributCourse"> <?php echo $course->getVille(); ?></span></div>

<div class="div2 infosCourse"> Du: <span class="attributCourse"> <?php echo $course->getDebut(true); ?></span></div>
<div class="div2 infosCourse"> au: <span class="attributCourse"> <?php echo $course->getFin(true); ?></span></div>

<div class="div1 infosCourse"> Besoin: <span class="attributCourse"> <?php echo $course->getMotoDemande(); ?></span> Motos
(<?php echo $participation->getNbParticipant(); ?> / <?php echo $course->getMotoDemande(); ?>)
</div>

<div class="div2 infosCourse"> Distance: <span class="attributCourse"> <?php echo $course->getDistance(); ?></span> km</div>
<div class="div2 infosCourse"> avec: <span class="attributCourse"> <?php echo $course->getNbCoureurs(); ?></span> Participants</div>

<div class="div2 infosCourse"> Défraiement: <span class="attributCourse"> <?php echo $course->getDefraiement(); ?></span> €</div>

<div class="div2 infosCourse"> Statut: <span class="attributCourse"> <?php echo $course->getStatut(); ?></span></div>

<div class="div2 infosCourse"> Dernière MAJ: <span class="attributCourse"> <?php echo $course->getDateMAJ(); ?></span></div>
<div class="div2 infosCourse"> Documents: <span> DOC1</span><span> DOC2</span></div>


<div id="clear"></div>

</div>