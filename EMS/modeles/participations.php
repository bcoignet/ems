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

		foreach ($this->listing as $listing) {
			$membre = $listing['membre'];
			$participe = $listing['participe'];

			if ($participe === '1') {
			$form_membre_participant->add('Checkbox', 'membre_' . $membre->getId())
			->label($membre->getNom() . ' ' . $membre->getPrenom())
			->value($membre->getId())
			->checked();
			} else {
				$form_membre_participant->add('Checkbox', 'membre_' . $membre->getId())
				->label($membre->getNom() . ' ' . $membre->getPrenom())
				->value($membre->getId());
			}
		}

		return $form_membre_participant;
	}

	public function listingMembre () {
		$pdo = PDO2::getInstance();
		$membres = array();

		/*$requete = $pdo->prepare("	SELECT id_membre, date_creation
									FROM participations_courses pc
									WHERE pc.id_course = :id_course");//*/

		$requete = $pdo->prepare("	SELECT pc.id_membre, true as 'participe'
									FROM participations_courses pc
									WHERE pc.id_course = :id_course
									UNION (
										select m.id, false as 'participe'
										from membres m
										where m.id not in (
											select pc.id_membre
											from participations_courses pc
											where pc.id_course = :id_course)
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
		error_log('BCT : $membres ' . var_export($membres, true));
		$this->listing = $membres;

	}

	public function listingCourse () {
		$pdo = PDO2::getInstance();
		$courses = array();

		$requete = $pdo->prepare("	SELECT id_course, date_creation
									FROM participations_courses pc
									WHERE pc.id_membre = :id_membre");
		$requete->bindValue(':id_membre', $this->idMembre);
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$course = new course($result['id_course']);
			$course->load();
			$courses[$result['id_course']] = $course;
		}
		error_log('BCT : $courses' . var_export($courses, true));
		$this->listing =  $courses;
	}

}