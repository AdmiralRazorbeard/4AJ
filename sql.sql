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
        id                     int (11) Auto_increment  NOT NULL ,
        nomFonctionFR          Varchar (255) ,
        nomFonctionEN          Varchar (255) ,
        isAccesJeunes          Bool ,
        isAdminLivreOr         Bool ,
        isAdminActualite       Bool ,
        autorisationMangerMidi Bool ,
        autorisationMangerSoir Bool ,
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


CREATE TABLE mail(
        id                     int (11) Auto_increment  NOT NULL ,
        mailMain               Varchar (255) ,
        mailPlateformeLogement Varchar (255) ,
        PRIMARY KEY (id )
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
(4, 'residenceAnneFrank', ''),
(5, 'residenceClairLogis', ''),
(6, 'residenceNobel', ''),
(7, 'liensUtiles', ''),
(8, 'services', ''),
(9, 'conditions', ''),
(10, 'nosResidences', ''),
(11, 'contact', ''),
(12, 'faq', ''),
(13, 'memento', ''),
(14, '', ''),
(15, 'accueillir_plateformeLogement', ''),
(16, 'informer_plateformeLogement', ''),
(17, 'atelier_plateformeLogement', ''),
(18, 'accompagner_plateformeLogement', ''),
(19, 'documenter_plateformeLogement', ''),
(20, 'contact_plateformeLogement', ''),
(21, 'restauration', '');


INSERT INTO `informationpage` (`id`, `page`, `contenu`, `contenuEN`) VALUES
(1, 'association', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(2, 'quiSommesNous', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>\r\n\r\n\r\n<titre>Qui sommes-nous?</titre>\r\nL''association "4AJ, un tremplin pour les jeunes", a Ã©tÃ© crÃ©e le 7 juin 2010, suite Ã  la fusion des 3 F.J.T. arrageois : Anne Frank, Clair Logis et Nobel.\r\nUn FJT est une structure qui propose un logement peu onÃ©reux Ã  des jeunes, afin que ce soit un tremplin pour une insertion sociale et professionnelle, la mission premiÃ¨re est l''insertion sociale et professionnelle des jeunes par le logement. \r\nDans le Pas-de-Calais, les FJT sont atypiques car 40% des jeunes accueillis sont des jeunes confiÃ©s dans le cadre de l''aide sociale Ã  l''enfance. \r\nPlus de 20 000 jeunes ont Ã©tÃ© accueillis et logÃ©s depuis un demi-siÃ¨cle dans les 3 Ã©tablissements.\r\nCette fusion a part ailleurs permis la mutualisation des moyens, un partage des compÃ©tences, et la mise en oeuvre d''actions communes.\r\nCette association est active dans les parcours des usagers, des jeunes. Elle agit dans le parcours de soins Ã  travers une organisation de coopÃ©ration. \r\nAujourd''hui ce sont 160 places dans les trois Ã©tablissements dont 39 places de centre d''hÃ©bergement en rÃ©insertion sociale (ou CHRS), 33 places dans le cadre de l''aide sociale Ã  l''enfance, 5 places d''urgence, et 8 places dans le cadre de l''implication dans la campagne hivernale. L''originalitÃ©, la transversalitÃ© des dispositifs, la non stigmatisation du public accueilli sont mises en exergue par l''accueil d''une jeunesse large Ã¢gÃ©e de 16 Ã  30 ans.\r\n', NULL),
(3, 'PlateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(4, 'residenceAnneFrank', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(5, 'residenceClairLogis', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(6, 'residenceNobel', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(7, 'liensUtiles', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>\r\n\r\n\r\n<titre>Liens utiles</titre>\r\n<stitre>Pour l''A.P.L. (Aide PersonnalisÃ©e au Logement)</stitre>\r\nPour l''A.P.L. (Aide PersonnalisÃ©e au Logement) c''est par ici: <lien url="http://www.caf.fr/">http://www.caf.fr/</lien>\r\n\r\n<stitre>Differents types d''aides pourront Ãªtre trouvÃ©e sur le site d''action logement</stitre>\r\n<lien url="http://www.actionlogement.fr/">http://www.actionlogement.fr/</lien> Entre autres: AIDE MOBILI-JEUNEÂ® -> Aide destinÃ©e Ã  faciliter l''accÃ¨s Ã  un logement meublÃ© pour les jeunes de moins de 30 ans prenant ou reprenant un emploi nÃ©cessitant une mobilitÃ©. Droit ouvert sous certaines conditions, mis en place par Action Logement. AVANCE LOCA-PASSÂ® -> Avance du dÃ©pÃ´t de garantie pour aider Ã  l''accÃ¨s au logement locatif. Droit ouvert mis en place par Action Logement\r\n\r\n<stitre>Le site de l''union nationale pour l''habitat des jeunes</stitre>\r\n<lien url="http://www.unhaj.org/">http://www.unhaj.org/</lien>\r\n\r\n<stitre>Le site de l''Uriopss Nord-Pas-De-Calais</stitre>\r\n<lien url="http://www.uriopss-npdc.asso.fr/">http://www.uriopss-npdc.asso.fr/</lien>\r\n\r\n<stitre>Le site de la marie d''Arras</stitre>\r\n<lien url="http://www.arras.fr/">http://www.arras.fr/</lien>\r\n\r\n<stitre>Le site de la Mission Locale en Pays d''Artois</stitre>\r\n<lien url="http://site.mlpa.fr/">http://site.mlpa.fr/</lien>\r\n', NULL),
(8, 'services', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(10, 'nosResidences', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(11, 'contact', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(12, 'faq', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(13, 'memento', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>\r\n\r\n\r\n<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>\r\n\r\n\r\n\r\n<titre>MÃ©mento (derniÃ¨re mise Ã  jour : 19/09/2013)</titre>\r\n<stitre>PÃ´le administratif</stitre>\r\n4AJ, un tremplin pour les Jeunes\r\n2 rue du Larcin 62000 ARRAS\r\nTÃ©l. 03 21 71 92 94\r\nFax  03 21 71 92 95\r\ncontact@4aj.fr\r\n<gras>Service dÃ©diÃ© Ã  toute demande concernant la gestion administrative, financiÃ¨re et la gestion du peronnel de l''association.</gras> \r\n\r\n<souligne>Directeur Administratif et Financier:</souligne>\r\nChritophe LEFETZ\r\n<souligne>SecrÃ©taire de Direction:</souligne>\r\nDoryanne LEMAIRE\r\n\r\n<souligne>PrÃ©sident:</souligne> Alfred GRUT\r\n<souligne>Directeur-GÃ©nÃ©ral:</souligne> Jean-Claude GIROT\r\nLes 3 Ã©tablissements accueillent, logent et accompagnent les usagers.\r\nPour tout contact concernant l''activitÃ© et la gestion directe, s''adresser Ã  l''Ã©tablissement concernÃ©.\r\n\r\n<stitre>FJT Anne Frank</stitre>\r\n21 rue du Bloc\r\n62 000 ARRAS\r\nTÃ©l. 03 21 71 24 83\r\nFax  03 21 23 08 44\r\nannefrank@4aj.fr\r\n<souligne>Directrice:</souligne> Sylvie BAUDUIN\r\n\r\n<stitre>FJT Clair Logis</stitre>\r\n30 Grand Place\r\n62 000 ARRAS\r\nTÃ©l. 03 21 55 11 01\r\nFax  03 21 59 12 71\r\nclairlogis@4aj.fr\r\n<souligne>Directeur:</souligne> Patrice SYMCZAK\r\n\r\n<stitre>FJT Nobel</stitre>\r\n7 rue Diderot\r\n62 000 ARRAS\r\nTÃ©l. 03 21 16 11 70\r\nFax  03 21 16 11 71\r\nnobel@4aj.fr\r\n<souligne>Directrice:</souligne> Sonia TERCHANI\r\n', NULL),
(14, '', '', NULL),
(15, 'accueillir_plateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(16, 'informer_plateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(17, 'atelier_plateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(18, 'accompagner_plateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(19, 'documenter_plateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(20, 'contact_plateformeLogement', '<titre>Titre</titre>\r\n<stitre>Sous titre</stitre>\r\n<gras>Gras</gras> <italique>Italique</italique> <souligne>SoulignÃ©</souligne>\r\n<lien url="lien.fr">lien</lien> et <mail url="mail">mail</mail>\r\n\r\n<taille valeur="ttpetit">ttpetit</taille>\r\n<taille valeur="tpetit">tpetit</taille>\r\n<taille valeur="petit">petit</taille>\r\n<taille valeur="gros">gros</taille>\r\n<taille valeur="tgros">tgros</taille>\r\n<taille valeur="ttgros">ttgros</taille>', NULL),
(21, 'restauration', '', NULL);
