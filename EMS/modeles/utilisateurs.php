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
	private $dateCreation;
	private $dateMaj;
	
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
}