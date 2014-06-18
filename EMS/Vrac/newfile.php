<?php
//requete pour récupérer les membres disponible pour une course.
SELECT id_membre, date_maj, date_creation from disponibilites_courses where id_course = 1
union
(
SELECT id, '0000-00-00 00:00:00', '0000-00-00 00:00:00'
		from membres where id not in (
		SELECT id_membre from disponibilites_courses where id_course = 1
		)

)