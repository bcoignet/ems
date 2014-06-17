<?php
//require_once CHEMIN_MODELE.'courses.php';
require_once CHEMIN_MODELE.'membres.php';
?>
<div>

<div id="infosCourse">
	<?php
		echo $formCourse;
	?>
	</div>

	<div id="disponibilitesCourse">

	Sont prévu sur cette course:

	<?php
	echo $formMembreParticipant;
	?>

	</div>

	<div id="participationsCourse">
	</div>


	<div id="clear"></div>



</div>