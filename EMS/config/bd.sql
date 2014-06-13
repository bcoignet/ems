
CREATE TABLE membres (
	id					int(10) unsigned 	NOT NULL 	AUTO_INCREMENT,
	nom					VARCHAR(32)			NOT NULL,
	prenom				VARCHAR(32)			NOT NULL,
	nom_moto			VARCHAR(50)			NOT NULL,
	marque_moto			VARCHAR(50)			NOT NULL,
	type_moto			VARCHAR(50)			NOT NULL,
	role_asso			VARCHAR(128) 		NOT NULL,
	date_naissance		date 				NOT NULL,
	photo				VARCHAR(128)		NOT NULL,
	sexe				char(1)				NOT NULL,
	type_membre			VARCHAR(50)			NOT NULL,
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	
	PRIMARY KEY (id)	

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE utilisateurs (
	id               	int(10) unsigned 	NOT NULL 	AUTO_INCREMENT,
	nom_utilisateur  	varchar(32)  		NOT NULL,
	mot_de_passe      	char(40)     		NOT NULL,
	adresse_email    	varchar(128) 		NOT NULL,
	hash_validation   	char(32)     		NOT NULL,
	date_inscription 	date 				NOT NULL,
	avatar           	varchar(128) 		NOT NULL 	DEFAULT '',
	nom					varchar(50)  		NOT NULL,
	prenom				varchar(50)  		NOT NULL,
	mobile				char(10)  			NOT NULL,
	fixe				char(10)  			NOT NULL,
	code_postal			varchar(8)  		NOT NULL,
	ville				varchar(50)  		NOT NULL,
	rue					varchar(128)  		NOT NULL,
	batiment			varchar(100)  		NOT NULL,
	complement			varchar(128)  		NOT NULL,
	statut				varchar(50)			NOT NULL,
	grade				int(3)				NOT NULL DEFAULT '100',
	membre_rattache		int(10)	unsigned	NOT NULL,
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',

	PRIMARY KEY (id),
	UNIQUE KEY unique_utilisateur (nom_utilisateur, adresse_email),
	KEY mot_de_passe (mot_de_passe),
	FOREIGN KEY (membre_rattache) REFERENCES membres(id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- Courses, participations et disponibilités

CREATE TABLE courses (
	id					int(10) unsigned 	NOT NULL 	AUTO_INCREMENT,
	nom					VARCHAR(32)			NOT NULL,
	ville				VARCHAR(32)			NOT NULL 	DEFAULT '-1',
	organisation		VARCHAR(50)			NOT NULL 	DEFAULT '-1',	
	date_debut			date				NOT NULL,
	heure_debut			char(5)				NOT NULL 	DEFAULT '08:00',
	date_fin			date				NOT NULL,
	heure_fin			char(5)				NOT NULL 	DEFAULT '17:00',
	moto_demande		int(3)				NOT NULL 	DEFAULT '-1',
	type_course			VARCHAR(50)			NOT NULL 	DEFAULT '-1',
	defraiement			VARCHAR(50)			NOT NULL 	DEFAULT '-1',
	distance			VARCHAR(50)			NOT NULL 	DEFAULT '-1',
	nb_coureurs			VARCHAR(50)			NOT NULL 	DEFAULT '-1',
	statut				VARCHAR(50)			NOT NULL	DEFAULT '-1',
	visibilite			VARCHAR(50)			NOT NULL	DEFAULT 'tous',
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	
	PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; 

CREATE TABLE disponibilites_courses (
	id_membre			int(10) unsigned 	NOT NULL,
	id_course			int(10) unsigned 	NOT NULL,
	reponse				VARCHAR(50) 		NOT NULL,
	
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
	PRIMARY KEY unique_disponible_course (id_membre, id_course),
	FOREIGN KEY (id_membre) REFERENCES membres(id),
	FOREIGN KEY (id_course) REFERENCES courses(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE participations_courses (
	id_membre			int(10) unsigned 	NOT NULL,
	id_course			int(10) unsigned 	NOT NULL,
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
	PRIMARY KEY unique_participant_course (id_membre, id_course),
	FOREIGN KEY (id_membre) REFERENCES membres(id),
	FOREIGN KEY (id_course) REFERENCES courses(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


 
--  Sorties, participations et disponibilités

CREATE TABLE sorties (
	id					int(10) unsigned 	NOT NULL 	AUTO_INCREMENT,
	nom					VARCHAR(32)			NOT NULL,
	date_debut			date				NOT NULL,
	date_fin			date				NOT NULL,
	statut				VARCHAR(50)			NOT NULL	DEFAULT '-1',
	visibilite			VARCHAR(50)			NOT NULL	DEFAULT 'tous',
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	
	PRIMARY KEY (id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE disponibilites_sorties (
	id_membre			int(10) unsigned 	NOT NULL,
	id_sortie			int(10) unsigned 	NOT NULL,
	reponse				VARCHAR(50) 		NOT NULL,
	
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
	PRIMARY KEY unique_disponible_sortie (id_membre, id_sortie),
	FOREIGN KEY (id_sortie) REFERENCES sorties(id),
	FOREIGN KEY (id_membre) REFERENCES membres(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE participations_sortie (
	id_membre			int(10) unsigned 	NOT NULL,
	id_sortie			int(10) unsigned 	NOT NULL,
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
	PRIMARY KEY unique_participant_sortie (id_membre, id_sortie),
	FOREIGN KEY (id_sortie) REFERENCES sorties(id),
	FOREIGN KEY (id_membre) REFERENCES membres(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- documentations
CREATE TABLE documents (
	id					int(10) unsigned 	NOT NULL 	AUTO_INCREMENT,
	nom					VARCHAR(50)			NOT NULL	DEFAULT '-1',
	chemin				VARCHAR(50)			NOT NULL,
	proprietaire		int(10) unsigned	NOT NULL,

	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	
	PRIMARY KEY (id)

) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; 

CREATE TABLE documenter_courses (
	id_document			int(10) unsigned 	NOT NULL,
	id_course			int(10) unsigned 	NOT NULL,
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	
	PRIMARY KEY unique_document (id_document, id_course),
	FOREIGN KEY (id_document) REFERENCES documents(id),
	FOREIGN KEY (id_course) REFERENCES courses(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; 

CREATE TABLE documenter_sorties (
	id_document			int(10) unsigned 	NOT NULL,
	id_sortie			int(10) unsigned 	NOT NULL,
	
	date_creation		TIMESTAMP			NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_maj			TIMESTAMP 			NOT NULL DEFAULT '0000-00-00 00:00:00',
	
	PRIMARY KEY unique_document (id_document, id_sortie),
	FOREIGN KEY (id_document) REFERENCES documents(id),
	FOREIGN KEY (id_sortie) REFERENCES sorties(id)
	
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- trigger membres
DELIMITER $$
CREATE TRIGGER membres_update BEFORE UPDATE ON membres
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;


-- trigger utilisateurs
DELIMITER $$
CREATE TRIGGER utilisateurs_update BEFORE UPDATE ON utilisateurs
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;

-- trigger courses
DELIMITER $$
CREATE TRIGGER courses_update BEFORE UPDATE ON courses
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;

-- trigger dispo_courses
DELIMITER $$
CREATE TRIGGER disponibilites_courses_update BEFORE UPDATE ON disponibilites_courses
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;

-- trigger sorties
DELIMITER $$
CREATE TRIGGER sorties_update BEFORE UPDATE ON sorties
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;

-- trigger dispo_sorties
DELIMITER $$
CREATE TRIGGER disponibilites_sorties_update BEFORE UPDATE ON disponibilites_sorties
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;

-- trigger documents
DELIMITER $$
CREATE TRIGGER documents_update BEFORE UPDATE ON documents
FOR EACH ROW BEGIN
SET NEW.date_maj = NOW();
END;$$
DELIMITER ;







