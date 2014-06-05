#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


CREATE TABLE membre(
	id            int (11) Auto_increment  NOT NULL ,
	nomMembre     Varchar (255) ,
	prenomMembre  Varchar (255) ,
	adresse       Varchar (255) ,
	dateNaissance Date ,
	telFixe       Varchar (12) ,
	telPortable   Varchar (12) ,
	mail          Varchar (255) ,
	password      Varchar (255) ,
	isSuperAdmin  Bool ,
	PRIMARY KEY (id ) ,
	UNIQUE (mail )
)ENGINE=InnoDB;


CREATE TABLE fonction(
	id               int (11) Auto_increment  NOT NULL ,
	nomFonctionFR    Varchar (255) ,
	nomFonctionEN    Varchar (255) ,
	isAccesJeunes    Bool ,
	isAdminLivreOr   Bool ,
	isAdminActualite Bool ,
	isAdminRepas	 Bool ,q
	autorisationMangerMidi Bool,
	autorisationMangerSoir Bool
	PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE news(
	id                  int (11) Auto_increment  NOT NULL ,
	titreNewsFR         Varchar (255) ,
	titreNewsEN         Varchar (255) ,
	contenuNewsFR       Text ,
	contenuNewsEN       Text ,
	timestampNews       TimeStamp ,
	id_membre           Int ,
	id_Type_d_actualite Int ,
	PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE Type_d_actualite(
	id  int (11) Auto_increment  NOT NULL ,
	nom Varchar (255) ,
	PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE residenceRepas(
        id           int (11) Auto_increment  NOT NULL ,
        nomResidence Varchar (255) ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE verouillerJourRepas(
        id             int (11) Auto_increment  NOT NULL ,
        dateVerouiller Date ,
        midi           Bool ,
        residence      Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE livreOr(
        id               int (11) Auto_increment  NOT NULL ,
        nom              Varchar (255) ,
        mail             Varchar (255) ,
        contenu          Text ,
        timestampLivreOr TimeStamp ,
        afficher         Bool ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE InfoLivreOrActualite(
        id                           int (11) Auto_increment  NOT NULL ,
        nombreBilletLivreOrParPage   Int ,
        nombreBilletActualiteParPage Int ,
        nombreTotalBilletActualite   Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE membreFonction(
	id          Int NOT NULL ,
	id_fonction Int NOT NULL ,
	PRIMARY KEY (id ,id_fonction )
)ENGINE=InnoDB;


CREATE TABLE newsFonction(
	id          Int NOT NULL ,
	id_fonction Int NOT NULL ,
	PRIMARY KEY (id ,id_fonction )
)ENGINE=InnoDB;


CREATE TABLE informationPage(
        id      int (11) Auto_increment  NOT NULL ,
        page    Varchar (255) ,
        contenu Text ,
        PRIMARY KEY (id ) ,
        UNIQUE (page )
)ENGINE=InnoDB;


CREATE TABLE reserveRepas(
        id          int (11) Auto_increment  NOT NULL ,
        dateReserve Date ,
        midi        Int ,
        residence   Int ,
        id_membre   Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;



CREATE TABLE oublieMotDePasseSecurite(
        id               int (11) Auto_increment  NOT NULL ,
        securite         Varchar (255) ,
        CurrentTimestamp Date ,
        id_membre        Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


ALTER TABLE oublieMotDePasseSecurite ADD CONSTRAINT FK_oublieMotDePasseSecurite_id_membre FOREIGN KEY (id_membre) REFERENCES membre(id);
ALTER TABLE news ADD CONSTRAINT FK_news_id_membre FOREIGN KEY (id_membre) REFERENCES membre(id);
ALTER TABLE news ADD CONSTRAINT FK_news_id_Type_d_actualite FOREIGN KEY (id_Type_d_actualite) REFERENCES Type_d_actualite(id);
ALTER TABLE membreFonction ADD CONSTRAINT FK_membreFonction_id FOREIGN KEY (id) REFERENCES membre(id);
ALTER TABLE membreFonction ADD CONSTRAINT FK_membreFonction_id_fonction FOREIGN KEY (id_fonction) REFERENCES fonction(id);
ALTER TABLE newsFonction ADD CONSTRAINT FK_newsFonction_id FOREIGN KEY (id) REFERENCES news(id);
ALTER TABLE newsFonction ADD CONSTRAINT FK_newsFonction_id_fonction FOREIGN KEY (id_fonction) REFERENCES fonction(id);
ALTER TABLE reserveRepas ADD CONSTRAINT FK_reserveRepas_id_membre FOREIGN KEY (id_membre) REFERENCES membre(id);

ALTER TABLE  `news` CHANGE  `timestampNews`  `timestampNews` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE  `livreor` CHANGE  `afficher`  `afficher` TINYINT( 1 ) NOT NULL DEFAULT  '0';
INSERT INTO `fonction`(`nomFonctionFR`, `nomFonctionEN`, `isAccesJeunes`, `isAdminLivreOr`) VALUES ('Public','Public',0,0);
INSERT INTO `fonction`(`nomFonctionFR`, `nomFonctionEN`, `isAccesJeunes`, `isAdminLivreOr`) VALUES ('Jeunes','Young',1,0);
INSERT INTO `fonction`(`nomFonctionFR`, `nomFonctionEN`, `isAccesJeunes`, `isAdminLivreOr`, `isAdminActualite`) VALUES ('Directeur','Director',0,1,1);

INSERT INTO `InfoLivreOrActualite`(`nombreBilletLivreOrParPage`,`nombreBilletActualiteParPage`, `nombreTotalBilletActualite`) VALUES (20, 10, 100);
INSERT INTO `Type_d_actualite`(`nom`) VALUES ("ActualitÃ©");
ALTER TABLE  `livreor` CHANGE  `timestampLivreOr`  `timestampLivreOr` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE  `fonction` CHANGE  `isAdminActualite`  `isAdminActualite` TINYINT( 1 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `fonction` CHANGE  `isAdminLivreOr`  `isAdminLivreOr` TINYINT( 1 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `news` CHANGE  `id_Type_d_actualite`  `id_Type_d_actualite` INT( 11 ) NOT NULL DEFAULT  '1';
ALTER TABLE  `oubliemotdepassesecurite` ADD UNIQUE (
`securite`
);
