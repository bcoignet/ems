<?php
require_once CHEMIN_MODELE.'membres.php';
require_once CHEMIN_MODELE.'courses.php';
require_once CHEMIN_LIB.'form.php';

class disponibilite {
	private $idMembre;
	private $idCourse;
	private $dateCreation;
	private $reponse;
	private $listing;

	private static $choixDisponibilite = array(	MEMBRE_PARTICIPE_OUI => 'Oui',
												MEMBRE_PARTICIPE_NON => 'Non',
												MEMBRE_PARTICIPE_PEUT_ETRE => 'Peut être',
												MEMBRE_PARTICIPE_AUCUN => 'Non consulté');

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

	public function formMembreDisponible() {
		$form_membre_disponible = new Form('formulaire_membre_disponible');
		$form_membre_disponible->method('POST');

		foreach ($this->listing as $listing) {
			$membre = $listing['membre'];
			$choixReponse = $this->selectReponse();
				$form_membre_disponible->add('SELECT', 'membre_' . $membre->getId())
				->label($membre->getNom() . ' ' . $membre->getPrenom())
				->value($listing['reponse'])
				->choices($choixReponse['choix'])
				->required(false);
		}
		$form_membre_disponible->add('Submit', 'submit')
		->value("Enregistrer");

		return $form_membre_disponible;
	}

	public function selectReponse() {
		return array('choix' => disponibilite::$choixDisponibilite);
	}

	public function update() {
		//error_log('BCT : ' . var_export($this->listing, true));
		foreach ($this->listing as $k => $data) {
			if (array_key_exists('membre_' . $k, $_POST)) {
				$this->listing[$k]['reponse'] = $_POST['membre_' . $k];
			}
		}
		//error_log('BCT : ' . var_export($this->listing, true));
		$this->save();
	}

	public function listingMembre () {
		$pdo = PDO2::getInstance();
		$membres = array();

		$requete = $pdo->prepare("	SELECT id_membre, reponse, date_maj, date_creation from disponibilites_courses WHERE id_course = :id_course
									union
									(
										SELECT id, '' as reponse, '0000-00-00 00:00:00', '0000-00-00 00:00:00'
										FROM membres WHERE id NOT IN (
											SELECT id_membre from disponibilites_courses WHERE id_course = :id_course
										)
									)
									ORDER BY id_membre
								");

		$requete->bindValue(':id_course', $this->idCourse);
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$membre = new membre($result['id_membre']);
			$membre->load();
			$membres[$result['id_membre']]['membre'] = $membre;
			$membres[$result['id_membre']]['reponse'] = $result['reponse'];
		}
		error_log('BCT : ' . var_export($membres, true));
		$this->listing = $membres;

	}

	public function listingCourse () {
		$pdo = PDO2::getInstance();
		$courses = array();

		$requete = $pdo->prepare("	SELECT id_course, reponse, date_maj, date_creation FROM disponibilites_courses WHERE id_membre = :id_membre
									UNION
									(
									SELECT id, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'
									FROM courses where id not in (
										SELECT id_course FROM disponibilites_courses WHERE id_membre = :id_membre
										)

									)
				");
		$requete->bindValue(':id_membre', $this->idMembre);
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$course = new course($result['id_course']);
			$course->load();
			$courses[$result['id_course']]['course'] = $course;
			$courses[$result['id_course']]['reponse'] = $result['reponse'];
		}
		$this->listing =  $courses;
	}

	private function save() {
		if ($this->cleanDisponibilite()) {
			$pdo = PDO2::getInstance();
			$result = array();
			foreach ($this->listing as $idMembre => $value) {
				if ($value['reponse'] !== '') {
					$requete = $pdo->prepare("INSERT INTO disponibilites_courses (id_membre, id_course, reponse) values(:id_membre,:id_course,:reponse)");
					$requete->bindValue('id_membre', $idMembre);
					$requete->bindValue('id_course', $this->idCourse);
					$requete->bindValue('reponse', $value['reponse']);
					if ($requete->execute()) {
						$result['inserted'][] = $pdo->lastInsertId();
					}else {
						$result['error'][] = $requete->errorInfo();
					}
					$requete->closeCursor();
				}
			}

		}
		return $result;
	}

	private function cleanParticipation() {
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare("DELETE FROM participations_courses
		where id_course = :id_course");
		//AND id_membre IN (:id_membre)");
		$requete->bindValue(':id_course', $this->idCourse);

		//$requete->bindValue(':id_membre', $idMembreList);

		return $requete->execute();
	}

	private function cleanDisponibilite() {
		$pdo = PDO2::getInstance();
		$requete = $pdo->prepare("DELETE FROM disponibilites_courses
		where id_course = :id_course");
		$requete->bindValue(':id_course', $this->idCourse);
		return $requete->execute();
	}

}