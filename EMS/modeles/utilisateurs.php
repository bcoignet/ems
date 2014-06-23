<?php

class utilisateur {

	private $id;
	private $nomUtilisateur;
	private $motDePasse;
	private $adresseMail;
	private $hashValidation;
	private $dateInscription;
	private $avatar;
	private $nom;
	private $grade;
	private $prenom;
	private $mobile;
	private $fixe;
	private $codePostal;
	private $ville;
	private $rue;
	private $batiment;
	private $complement;
	private $statut;
	private $membreRattache;
	private $inactif;
	private $dateCreation;
	private $dateMaj;

	private static $choixGrade = array(	GRADE_ADMIN => 'Admin',
										GRADE_BUREAU => 'Bureau',
										GRADE_MEMBRE => 'Membre');


	public function __construct($id)
	{
		$this->id = $id;
	}

	public function getGrade() {
		return $this->grade;
	}

	public function getNomUtilisateur() {
		return $this->nomUtilisateur;
	}

	public function getId() {
		return $this->id;
	}

	public function load() {

		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("SELECT *
			FROM utilisateurs
			WHERE
			id = :id_utilisateur");

		$requete->bindValue(':id_utilisateur', $this->id);
		$requete->execute();

		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$requete->closeCursor();
			$this->nomUtilisateur = ($result['nom_utilisateur']);
			$this->motDePasse = ($result['mot_de_passe']);
			$this->adresseMail = ($result['adresse_email']);
			$this->hashValidation = ($result['hash_validation']);
			$this->dateInscription = ($result['date_inscription']);
			$this->avatar = ($result['avatar']);
			$this->nom = ($result['nom']);
			$this->grade = ($result['grade']);
			$this->prenom = ($result['prenom']);
			$this->mobile = ($result['mobile']);
			$this->fixe = ($result['fixe']);
			$this->codePostal = ($result['code_postal']);
			$this->ville = ($result['ville']);
			$this->rue = ($result['rue']);
			$this->batiment = ($result['batiment']);
			$this->complement = ($result['complement']);
			$this->statut = ($result['statut']);
			$this->membreRattache = ($result['membre_rattache']);
			$this->inactif = $result['inactif'];
			$this->dateCreation = ($result['date_creation']);
			$this->dateMaj = ($result['date_creation']);
		}
	}

	public static function authentifier($nom_utilisateur, $mot_de_passe) {

		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("SELECT id FROM utilisateurs
			WHERE
			nom_utilisateur = :nom_utilisateur AND
			mot_de_passe = :mot_de_passe");

		$requete->bindValue(':nom_utilisateur', $nom_utilisateur);
		$requete->bindValue(':mot_de_passe', $mot_de_passe);
		$requete->execute();

		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {

			$requete->closeCursor();
			return $result['id'];
		}
		return false;
	}

	public function getProperties() {
		$arrProperties = get_object_vars($this);
		unset($arrProperties['motDePasse']);
		unset($arrProperties['hashValidation']);
		return $arrProperties;
	}

	public static function listing() {

		$utilisateurs = array();
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("SELECT * FROM utilisateurs");
		$requete->execute();

		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$utilisateur = new utilisateur($result['id']);
			$utilisateur->load();
			$utilisateurs[] = $utilisateur;
		}
		$requete->closeCursor();

		return $utilisateurs;
	}

	public function formulaireEdition() {
		$arrGradeMembre = $this->selectGradeMembre();
		$arrMembreDisponible = $this->selectMembreDisponible();

		$form_utilisateur = new Form('formulaire_utilisateur');

		$form_utilisateur->method('POST');

		if ($this->inactif) {
			$form_utilisateur->add('Checkbox', 'inactif')
			->label('Inactif')
			->value($this->inactif)
			->required(false)
			->checked();
		}else {
			$form_utilisateur->add('Checkbox', 'inactif')
			->label('Inactif')
			->value($this->inactif)
			->required(false);
		}

		$form_utilisateur->add('Text', 'nom_utilisateur')
		->label("Pseudo")
		->value($this->nomUtilisateur);

		$form_utilisateur->add('Text', 'nom')
		->label("Nom")
		->value($this->nom);

		$form_utilisateur->add('Text', 'prenom')
		->label("Prenom")
		->value($this->prenom);

		$form_utilisateur->add('Password', 'mot_de_passe')
		->label("Mot de passe")
		->value($this->motDePasse)
		->required(false);

		$form_utilisateur->add('Password', 'mot_de_passe_confirme')
		->label("Mot de passe (confirmation)")
		->required(false);

		$form_utilisateur->add('Text', 'avatar')
		->label("Avatar")
		->value($this->avatar)
		->required(false);

		$form_utilisateur->add('Text', 'mobile')
		->label("Mobile")
		->value($this->mobile)
		->required(false);

		$form_utilisateur->add('Text', 'fixe')
		->label("Fixe")
		->value($this->fixe)
		->required(false);

		$form_utilisateur->add('Text', 'code_postal')
		->label("Cde postal")
		->value($this->codePostal)
		->required(false);

		$form_utilisateur->add('Text', 'ville')
		->label("Ville")
		->value($this->ville)
		->required(false);

		$form_utilisateur->add('Text', 'rue')
		->label("Rue")
		->value($this->rue)
		->required(false);

		$form_utilisateur->add('Text', 'batiment')
		->label("Bâtiment")
		->value($this->batiment)
		->required(false);

		$form_utilisateur->add('Text', 'complement')
		->label("Complément")
		->value($this->complement)
		->required(false);

		$form_utilisateur->add('Text', 'statut')
		->label("Statut")
		->value($this->statut)
		->required(false);

		$form_utilisateur->add('Select', 'membre_rattache')
		->label("Membre rattaché")
		->choices($arrMembreDisponible['choix'])
		->value($this->membreRattache);

		$form_utilisateur->add('Select', 'grade')
		->label("Grade")
		->choices($arrGradeMembre['choix'])
		->value($this->grade);

		$form_utilisateur->add('Submit', 'submit')
		->value("Enregistrer");


		$form_utilisateur->add('Date', 'date_maj')
		->label("Date de MAJ")
		->disabled()
		->value($this->dateMaj)
		->required(false);

		$form_utilisateur->add('Date', 'date_creation')
		->label("Date de création")
		->value($this->dateCreation)
		->disabled()
		->required(false);

		return $form_utilisateur;
	}


	public function selectGradeMembre() {
		return array('choix' => utilisateur::$choixGrade, 'selected' => $this->grade);
	}

	public function selectMembreDisponible() {
		$membresLibre = array();
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("	SELECT id, nom, prenom  from membres
									WHERE id = :id_membre_rattache");
		$requete->bindValue(':id_membre_rattache', $this->membreRattache);
		$requete->execute();
		if ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$membresLibre[$result['id']] = $result['nom']. ' ' .$result['prenom'] . ' (actuel)';
		}
		$requete->closeCursor();

		//

		$requete = $pdo->prepare("	SELECT id, nom, prenom  from membres
									WHERE id NOT IN (
										SELECT membre_rattache
										FROM utilisateurs
										WHERE membre_rattache IS NOT NULL)");

		$requete->execute();
		while ($result = $requete->fetch(PDO::FETCH_ASSOC)) {
			$membresLibre[$result['id']] = $result['nom'] . ' ' . $result['prenom'];
		}
		$requete->closeCursor();

		return array('choix' => $membresLibre, 'selected' => $this->membreRattache);
	}


	public function update($form) {
		list($this->nom, $this->prenom, $this->avatar, $this->dateNaissance, $this->marqueMoto, $this->nomMoto, $this->typeMoto, $this->roleAsso, $this->typeMembre, $this->photo, $this->inactif, $this->nomUtilisateur, $this->membreRattache) =
		$form->get_cleaned_data('nom', 'prenom', 'sexe', 'date_naissance', 'marque_moto', 'nom_moto', 'type_moto', 'role_asso', 'type_membre', 'photo', 'inactif', 'nom_utilisateur', 'membre_rattache');
		if ($this->inactif === 'on') {
			$this->inactif = '1';
		}
		if ($this->id === '0') {
			$this->create();
		}else {
			$this->save();
		}
	}

	private function save($password = FALSE) {
		$pdo = PDO2::getInstance();

		$requete = $pdo->prepare("UPDATE utilisateurs SET
        nom_utilisateur = :nom_utilisateur,
		adresse_email = :adresse_email,
		avatar = :avatar,
		nom = :nom,
		prenom = :prenom,
		mobile = :mobile,
		fixe = :fixe,
		code_postal = :code_postal,
		ville = :ville,
		rue = :rue,
		batiment = :batiment,
		complement = :complement,
		statut = :statut,
		membre_rattache = :membre_rattache,
		grade = :grade,
		inactif = :inactif
		where id = :id");
		$requete->bindValue(':nom_utilisateur', $this->nomUtilisateur);
		$requete->bindValue(':adresse_email', $this->adresseMail);
		$requete->bindValue(':avatar', $this->avatar);
		$requete->bindValue(':nom', $this->nom);
		$requete->bindValue(':prenom', $this->prenom);
		$requete->bindValue(':mobile', $this->mobile);
		$requete->bindValue(':fixe', $this->fixe);
		$requete->bindValue(':code_postal', $this->codePostal);
		$requete->bindValue(':ville', $this->ville);
		$requete->bindValue(':rue', $this->rue);
		$requete->bindValue(':batiment', $this->batiment);
		$requete->bindValue(':complement', $this->complement);
		$requete->bindValue(':statut', $this->statut);
		$requete->bindValue(':membre_rattache', $this->membreRattache);
		$requete->bindValue(':grade', $this->grade);
		$requete->bindValue(':inactif', $this->inactif);
		$requete->bindValue(':id', $this->id);

		if ($requete->execute()) {
			return $pdo->lastInsertId();
		}

		//$requete->closeCursor();
		return $requete->errorInfo();

	}


}