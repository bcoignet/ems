<?php
require_once CHEMIN_MODELE.'membres.php';
require_once CHEMIN_MODELE.'courses.php';
require_once CHEMIN_LIB.'form.php';

class participation {
	private $idMembre;
	private $idCourse;
	private $dateCreation;
	private $listing;

	public function __construct($idMembre = '0', $idCourse = '0') {
		$this->idCourse = $idCourse;
		$this->idMembre = $idMembre;

		if ($idMembre !== '0' && $idCourse !== '0'){
			//$this->load();
		}elseif ($idMembre !== '0' || $idCourse !== '0') {
			if ($this->idCourse !== '0') {
				$this->listingMembre();
			}
			if ($this->idMembre !== '0') {
				$this->listingCourse();
			}
		}else {
			return null;
		}
	}

	public function getListing() {
		return $this->listing;
	}

	public function formMembreParticipant() {
		$form_membre_participant = new Form('formulaire_membre_participant');
		$form_membre_participant->method('POST');

		$i = 0;
		foreach ($this->listing as $listing) {
			$membre = $listing['membre'];
			$participe = $listing['participe'];

			if ($participe === '1') {
				$form_membre_participant->add('Checkbox', 'membre_' . $i)
				->label($membre->getNom() . ' ' . $membre->getPrenom())
				->value($membre->getId())
				->required(false)
				->checked();
			} else {
				$form_membre_participant->add('Checkbox', 'membre_' . $i)
				->label($membre->getNom() . ' ' . $membre->getPrenom())
				->value($membre->getId())
				->required(false);
			}
			$i++;
		}
		$form_membre_participant->add('Submit', 'submit')
		->value("Enregistrer");

		return $form_membre_participant;
	}

	public function update($form) {

		foreach ($_POST as $k => $champ) {

			if (preg_match('/membre_[0-9]+/', $k)) {
				echo  $champ; //id des membre qui participe
			}

		}

		/*
		list(	$this->nom, $this->ville, $this->typeCourse, $this->organisation, $this->motoDemande, $this->distance, $this->nbCoureurs, $this->defraiement,
				$this->dateDebut, $this->heureDebut, $this->dateFin, $this->heureFin, $this->statut, $this->visibilite) =
				$form->get_cleaned_data('nom', 'ville', 'type_course', 'organisation', 'moto_demande', 'distance', 'nb_coureurs', 'defraiement',
						'date_debut', 'heure_debut', 'date_fin', 'heure_fin', 'statut','visibilite');
		error_log('BCT : ' . var_export($this, true));
		//*/
	}

	public function listingMembre () {
		$pdo = PDO2::getInstance();
		$membres = array();

		$requete = $pdo->prepare("	SELECT pc.id_membre, true AS 'participe'
									FROM participations_courses pc
									WHERE pc.id_course = :id_course
									UNION (
										SELECT m.id, false AS 'participe'
										FROM membres m
										WHERE m.id NOT IN (
											SELECT pc.id_membre
											FROM participations_courses pc
											WHERE pc.id_course = :id_course)
									)
								");

		$requete->bindValue(':id_course', $this->idCourse);
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$membre = new membre($result['id_membre']);
			$membre->load();
			$membres[$result['id_membre']]['membre'] = $membre;
			$membres[$result['id_membre']]['participe'] = $result['participe'];
		}
		$this->listing = $membres;

	}

	public function listingCourse () {
		$pdo = PDO2::getInstance();
		$courses = array();

		$requete = $pdo->prepare("	SELECT pc.id_course, true AS 'participe'
									FROM participations_courses pc
									WHERE pc.id_membre = :id_membre
									UNION
									(
										SELECT c.id, false AS 'participe'
										FROM courses c
										WHERE c.id NOT IN (
											SELECT pc.id_course
											FROM participations_courses pc
											WHERE pc.id_membre = :id_membre)

									)");
		$requete->bindValue(':id_membre', $this->idMembre);
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$course = new course($result['id_course']);
			$course->load();
			$courses[$result['id_course']]['course'] = $course;
			$courses[$result['id_course']]['participe'] = $result['participe'];
		}
		$this->listing =  $courses;
	}

}