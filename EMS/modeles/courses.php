<?php
require_once CHEMIN_LIB.'form.php';
class course {

	private $id;
	private $nom;
	private $typeCourse;
	private $ville;
	private $organisation;
	private $motoDemande;
	private $distance;
	private $nbCoureurs;
	private $defraiement;
	private $dateDebut;
	private $heureDebut;
	private $dateFin;
	private $heureFin;
	private $statut;
	private $visibilite;
	private $dateCreation;
	private $dateMaj;

	private static $choixTypeCourse = array(TYPE_COURSE_CIRCUIT => 'Circuit',
											TYPE_COURSE_EN_LIGNE => 'Ligne',
											TYPE_COURSE_TRIATHLON => 'Triathlon');

	private static $choixStatutCourse = array(	TYPE_STATUT_COURSE_ANNONCE => 'Annoncé',
												TYPE_STATUT_COURSE_NEGOCIATION => 'Négociation',
												TYPE_STATUT_COURSE_SIGNE => 'Signée',
												TYPE_STATUT_COURSE_PERDU => 'Perdue');

	private static $choixVisibiliteCourse = array(	TYPE_VISIBILITE_TOUS => 'Tous',
													TYPE_VISIBILITE_ADMIN => 'Admin',
													TYPE_VISIBILITE_NON => 'Non');

	public function __construct($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

	public function getNom() {
		return $this->nom;
	}

	public function load() {
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("SELECT * FROM courses where id = :id_course");
		$requete->bindValue(':id_course', $this->id);
		$requete->execute();

		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$requete->closeCursor();
			$this->nom = $result['nom'];
			$this->ville = $result['ville'];
			$this->dateCreation = $result['date_creation'];
			$this->dateDebut = $result['date_debut'];
			$this->dateFin = $result['date_fin'];
			$this->dateMaj = $result['date_maj'];
			$this->defraiement = $result['defraiement'];
			$this->distance = $result['distance'];
			$this->heureDebut = $result['heure_debut'];
			$this->heureFin = $result['heure_fin'];
			$this->motoDemande = $result['moto_demande'];
			$this->nbCoureurs = $result['nb_coureurs'];
			$this->organisation = $result['organisation'];
			$this->statut = $result['statut'];
			$this->typeCourse = $result['type_course'];
			$this->visibilite = $result['visibilite'];

		}
	}

	/**
	 * Dresse le listing des courses
	 * @return multitype:courses
	 */
	public static function listing() {

		$courses = array();
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("SELECT * FROM courses");
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$course = new course($result['id']);
			$course->load();
			$courses[] = $course;
		}
		$requete->closeCursor();

		return $courses;
	}

	/**
	 * Retourne la liste des propri�t�s de l'objet sous forme de tableau
	 * @return multitype:array
	 */
	public function getProperties() {
		return get_object_vars($this);
	}


	/**
	 * Crée le formulaire permettant l'édition d'un membre
	 */
	public function formulaireEdition() {

		$arrTypeCourse = $this->selectTypeCourse();
		$arrStatutCourse = $this->selectStatutCourse();
		$arrVisibiliteCourse = $this->selectVisibiliteCourse();

		$form_course = new Form('formulaire_course');

		$form_course->method('POST');

		$form_course->add('Text', 'nom')
		->label("Nom")
		->value($this->nom);

		$form_course->add('Text', 'ville')
		->label("Ville")
		->value($this->ville)
		->required(false);

		$form_course->add('Select', 'type_course')
		->label("Type")
		->choices($arrTypeCourse['choix'])
		->value($this->typeCourse)
		->required(false);

		$form_course->add('Text', 'organisation')
		->label("Organisation")
		->value($this->organisation)
		->required(false);

		$form_course->add('Text', 'moto_demande')
		->label("Moto demandées")
		->value($this->motoDemande)
		->required(false);

		$form_course->add('Text', 'distance')
		->label("Distance")
		->value($this->distance)
		->required(false);

		$form_course->add('Text', 'nb_coureurs')
		->label("Nombre de coureur")
		->value($this->nbCoureurs)
		->required(false);

		$form_course->add('Text', 'defraiement')
		->label("Defraiement")
		->value($this->defraiement)
		->required(false);

		$form_course->add('Text', 'date_debut')
		->label("Début")
		->value($this->dateDebut);

		$form_course->add('Text', 'heure_debut')
		->label("Heure début")
		->value($this->heureDebut);

		$form_course->add('Text', 'date_fin')
		->label("Fin")
		->value($this->dateFin);

		$form_course->add('Text', 'heure_fin')
		->label("Heure fin")
		->value($this->heureFin);

		$form_course->add('Select', 'statut')
		->label("Statut")
		->choices($arrStatutCourse['choix'])
		->value($this->statut);

		$form_course->add('Select', 'visibilite')
		->label("Visibilité")
		->choices($arrVisibiliteCourse['choix'])
		->value($this->visibilite);

		$form_course->add('Submit', 'submit')
		->value("Enregistrer");


		$form_course->add('Date', 'date_maj')
		->label("Date de MAJ")
		->disabled()
		->value($this->dateMaj)
		->required(false);

		$form_course->add('Date', 'date_creation')
		->label("Date de création")
		->value($this->dateCreation)
		->disabled()
		->required(false);


		return $form_course;

	}

	public function selectTypeCourse() {
		return array('choix' => course::$choixTypeCourse, 'selected' => $this->typeCourse);
	}

	public function selectStatutCourse() {
		return array('choix' => course::$choixStatutCourse, 'selected' => $this->statut);
	}

	public function selectVisibiliteCourse() {
		return array('choix' => course::$choixVisibiliteCourse, 'selected' => $this->visibilite);
	}


	/**
	 * Met a jour la course courante d'apres les informations contenu dans le formulaire $form
	 */
	public function update($form) {
		list(	$this->nom, $this->ville, $this->typeCourse, $this->organisation, $this->motoDemande, $this->distance, $this->nbCoureurs, $this->defraiement,
				$this->dateDebut, $this->heureDebut, $this->dateFin, $this->heureFin, $this->statut, $this->visibilite) =
		$form->get_cleaned_data('nom', 'ville', 'type_course', 'organisation', 'moto_demande', 'distance', 'nb_coureurs', 'defraiement',
				'date_debut', 'heure_debut', 'date_fin', 'heure_fin', 'statut','visibilite');
		error_log('BCT : ' . var_export($this, true));
		if ($this->id === '0') {
			$this->create();
		}else {
			$this->save();
		}
	}

	/**
	 * Enregistre la course en BD
	 * @return string|multitype:
	 */
	private function save() {
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("UPDATE courses SET
        nom = :nom,
		ville = :ville,
		organisation = :organisation,
		type_course = :type_course,
		date_debut = :date_debut,
		date_fin = :date_fin,
		heure_debut = :heure_debut,
		heure_fin = :heure_fin,
		moto_demande = :moto_demande,
		defraiement = :defraiement,
		distance = :distance,
		nb_coureurs = :nb_coureurs,
		statut = :statut,
		visibilite = :visibilite
		where id = :id");
		$requete->bindValue(':nom', $this->nom);
		$requete->bindValue(':ville',    $this->ville);
		$requete->bindValue(':organisation',    $this->organisation);
		$requete->bindValue(':type_course',    $this->typeCourse);
		$requete->bindValue(':date_debut',    $this->dateDebut);
		$requete->bindValue(':date_fin',    $this->dateFin);
		$requete->bindValue(':heure_debut',    $this->heureDebut);
		$requete->bindValue(':heure_fin',    $this->heureFin);
		$requete->bindValue(':moto_demande',    $this->motoDemande);
		$requete->bindValue(':defraiement',    $this->defraiement);
		$requete->bindValue(':distance',    $this->distance);
		$requete->bindValue(':nb_coureurs',    $this->nbCoureurs);
		$requete->bindValue(':statut',    $this->statut);
		$requete->bindValue(':visibilite',    $this->visibilite);

		$requete->bindValue(':id',    $this->id);

		if ($requete->execute()) {
			return $pdo->lastInsertId();
		}

		$requete->closeCursor();
		return $requete->errorInfo();

	}

	private function create() {
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("INSERT INTO courses (	nom,
														ville,
														organisation,
														type_course,
														date_debut,
														date_fin,
														heure_debut,
														heure_fin,
														moto_demande,
														defraiement,
														distance,
														nb_coureurs,
														statut,
														visibilite)
												values(
												        :nom,
														:ville,
														:organisation,
														:type_course,
														:date_debut,
														:date_fin,
														:heure_debut,
														:heure_fin,
														:moto_demande,
														:defraiement,
														:distance,
														:nb_coureurs,
														:statut,
														:visibilite
												)");
		$requete->bindValue(':nom', $this->nom);
		$requete->bindValue(':ville',    $this->ville);
		$requete->bindValue(':organisation',    $this->organisation);
		$requete->bindValue(':type_course',    $this->typeCourse);
		$requete->bindValue(':date_debut',    $this->dateDebut);
		$requete->bindValue(':date_fin',    $this->dateFin);
		$requete->bindValue(':heure_debut',    $this->heureDebut);
		$requete->bindValue(':heure_fin',    $this->heureFin);
		$requete->bindValue(':moto_demande',    $this->motoDemande);
		$requete->bindValue(':defraiement',    $this->defraiement);
		$requete->bindValue(':distance',    $this->distance);
		$requete->bindValue(':nb_coureurs',    $this->nbCoureurs);
		$requete->bindValue(':statut',    $this->statut);
		$requete->bindValue(':visibilite',    $this->visibilite);

		if ($requete->execute()) {
			$this->id = $pdo->lastInsertId();
			return $pdo->lastInsertId();
		}

		$requete->closeCursor();
		return $requete->errorInfo();

	}

}