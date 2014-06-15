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
			$this->nomUtilisateur = utf8_encode($result['nom_utilisateur']);
			$this->motDePasse = utf8_encode($result['mot_de_passe']);
			$this->adresseMail = utf8_encode($result['adresse_email']);
			$this->hashValidation = utf8_encode($result['hash_validation']);
			$this->dateInscription = utf8_encode($result['date_inscription']);
			$this->avatar = utf8_encode($result['avatar']);
			$this->nom = utf8_encode($result['nom']);
			$this->grade = utf8_encode($result['grade']);
			$this->prenom = utf8_encode($result['prenom']);
			$this->mobile = utf8_encode($result['mobile']);
			$this->fixe = utf8_encode($result['fixe']);
			$this->codePostal = utf8_encode($result['code_postal']);
			$this->ville = utf8_encode($result['ville']);
			$this->rue = utf8_encode($result['rue']);
			$this->batiment = utf8_encode($result['batiment']);
			$this->complement = utf8_encode($result['complement']);
			$this->statut = utf8_encode($result['statut']);
			$this->membreRattache = utf8_encode($result['membre_rattache']);
			$this->dateCreation = utf8_encode($result['date_creation']);
			$this->dateMaj = utf8_encode($result['date_creation']);
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