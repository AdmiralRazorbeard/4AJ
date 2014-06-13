#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


CREATE TABLE membre(
        id                    int (11) Auto_increment  NOT NULL ,
        nomMembre             Varchar (255) ,
        prenomMembre          Varchar (255) ,
        adresse               Varchar (255) ,
        dateNaissance         Date ,
        telFixe               Int ,
        telPortable           Int ,
        mail                  Varchar (255) ,
        password              Varchar (255) ,
        recevoirMailQuandNews Bool ,
        isSuperAdmin          Bool ,
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
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE news(
        id            int (11) Auto_increment  NOT NULL ,
        titreNewsFR   Varchar (255) ,
        titreNewsEN   Varchar (255) ,
        contenuNewsFR Text ,
        contenuNewsEN Text ,
        timestampNews TimeStamp ,
        id_membre     Int ,
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
        id                         int (11) Auto_increment  NOT NULL ,
        nombreBilletLivreOrParPage Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE informationPage(
        id        int (11) Auto_increment  NOT NULL ,
        page      Varchar (255) ,
        contenu   Text ,
        contenuEN Text ,
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


CREATE TABLE verouillerJourRepas(
        id             int (11) Auto_increment  NOT NULL ,
        dateVerouiller Date ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE nombreVisiteur(
        id     int (11) Auto_increment  NOT NULL ,
        nombre Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


CREATE TABLE oublieMotDePasseSecurite(
        id               int (11) Auto_increment  NOT NULL ,
        securite         Varchar (255) ,
        CurrentTimestamp Date ,
        id_membre        Int ,
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


ALTER TABLE news ADD CONSTRAINT FK_news_id_membre FOREIGN KEY (id_membre) REFERENCES membre(id);
ALTER TABLE reserveRepas ADD CONSTRAINT FK_reserveRepas_id_membre FOREIGN KEY (id_membre) REFERENCES membre(id);
ALTER TABLE oublieMotDePasseSecurite ADD CONSTRAINT FK_oublieMotDePasseSecurite_id_membre FOREIGN KEY (id_membre) REFERENCES membre(id);
ALTER TABLE membreFonction ADD CONSTRAINT FK_membreFonction_id FOREIGN KEY (id) REFERENCES membre(id);
ALTER TABLE membreFonction ADD CONSTRAINT FK_membreFonction_id_fonction FOREIGN KEY (id_fonction) REFERENCES fonction(id);
ALTER TABLE newsFonction ADD CONSTRAINT FK_newsFonction_id FOREIGN KEY (id) REFERENCES news(id);
ALTER TABLE newsFonction ADD CONSTRAINT FK_newsFonction_id_fonction FOREIGN KEY (id_fonction) REFERENCES fonction(id);

###### TOUT CE QU'IL Y A AU DESSUS PROVIENT DU MCD ######
###### MAINTENANT IL S'AGIT DE L'INITIALISATION #########

ALTER TABLE  `news` CHANGE  `timestampNews`  `timestampNews` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE  `oubliemotdepassesecurite` CHANGE  `CurrentTimestamp`  `CurrentTimestamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE  `livreor` CHANGE  `timestampLivreOr`  `timestampLivreOr` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ;
ALTER TABLE  `livreor` CHANGE  `afficher`  `afficher` TINYINT( 1 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `fonction` CHANGE  `isAdminActualite`  `isAdminActualite` TINYINT( 1 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `fonction` CHANGE  `isAdminLivreOr`  `isAdminLivreOr` TINYINT( 1 ) NOT NULL DEFAULT  '0';
ALTER TABLE  `oubliemotdepassesecurite` ADD UNIQUE (`securite`);
INSERT INTO `4aj`.`nombrevisiteur` (`id`, `nombre`) VALUES (NULL, '1');
INSERT INTO `fonction`(`nomFonctionFR`, `nomFonctionEN`, `isAccesJeunes`, `isAdminLivreOr`) VALUES ('Public','Public',0,0);
INSERT INTO `fonction`(`nomFonctionFR`, `nomFonctionEN`, `isAccesJeunes`, `isAdminLivreOr`) VALUES ('Jeunes','Young',1,0);
INSERT INTO `fonction`(`nomFonctionFR`, `nomFonctionEN`, `isAccesJeunes`, `isAdminLivreOr`, `isAdminActualite`) VALUES ('Directeur','Director',0,1,1);
INSERT INTO `4aj`.`mail` (`id`, `mailMain`, `mailPlateformeLogement`) VALUES (NULL, 'contact@4AJ.fr', 'plateformelogement@4AJ.fr');
INSERT INTO `InfoLivreOrActualite`(`nombreBilletLivreOrParPage`) VALUES (20);
INSERT INTO `informationpage` (`id`, `page`, `contenu`) VALUES
(1, 'association', ''),
(2, 'quiSommesNous', ''),
(3, 'PlateformeLogement', ''),
(5, 'liensUtiles', ''),
(7, 'services', ''),
(9, 'conditions', ''),
(11, 'contact', ''),
(12, 'faq', ''),
(13, 'memento', ''),
(15, 'accueillir_plateformeLogement', ''),
(16, 'informer_plateformeLogement', ''),
(17, 'atelier_plateformeLogement', ''),
(18, 'accompagner_plateformeLogement', ''),
(19, 'documenter_plateformeLogement', ''),
(20, 'contact_plateformeLogement', ''),
(21, 'restauration', '');
