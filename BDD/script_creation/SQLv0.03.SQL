#------------------------------------------------------------
#        Script MySQL. Création BDD projet_BitNet
#------------------------------------------------------------

CREATE DATABASE projet_BitNet CHARACTER SET 'utf8_unicode_ci';
use projet_BitNet;

#------------------------------------------------------------
# Table: CODELIVE
#------------------------------------------------------------

CREATE TABLE CODELIVE(
        ID_codelive int(11) Auto_increment,
        token_session       Char (6),
        nom_createur        Varchar (255),
        last_update         Datetime DEFAULT CURRENT_TIMESTAMP,
        ID_fichier          Int,
        contenu_codelive    Text,
        PRIMARY KEY (ID_codelive, token_session)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: PROJET
#------------------------------------------------------------

CREATE TABLE PROJET(
        ID_projet          int (11) Auto_increment  NOT NULL,
        nom_projet         Varchar (50),
        nom_createur       Varchar (255),
        date_creation      Datetime,
        description_projet Varchar (255),
        PRIMARY KEY (ID_projet)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: MEMBRE
#------------------------------------------------------------

CREATE TABLE MEMBRE(
        ID_membre       int (11) Auto_increment,
        email           Varchar (255) NOT NULL,
        pseudo          Varchar (100) NOT NULL,
        pwd             Varchar (255) NOT NULL,
        nom             Varchar (150),
        prenom          Varchar (150),
        langages        Varchar (150),
        date_naissance  Datetime,
        ville           Int,
        date_creation   Datetime,
        date_update     Datetime,
        is_deleted      Boolean DEFAULT FALSE,
        succes_reussi   Varchar (255),
        role            Varchar (255) DEFAULT "user",
        profile_picture Varchar (512) DEFAULT "https://yt3.ggpht.com/-GwF5o-xhRg8/AAAAAAAAAAI/AAAAAAAAAAA/A5Mm8Rw8XeI/s900-c-k-no-mo-rj-c0xffffff/photo.jpg",
        experience      Int DEFAULT "0",
        PRIMARY KEY (ID_membre, email)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: FICHIER
#------------------------------------------------------------

CREATE TABLE FICHIER(
        ID_fichier     int (11) Auto_increment  NOT NULL,
        nom_fichier    Varchar (255),
        chemin_fichier Varchar (255),
        langages       Varchar (25),
        visibilite     Boolean,
        date_creation  Datetime,
        PRIMARY KEY (ID_fichier)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: SUCCES
#------------------------------------------------------------

CREATE TABLE SUCCES(
        ID_succes          int (11) Auto_increment  NOT NULL,
        nom_succes         Varchar (150),
        description_succes Text,
        xp_donnee          Int,
        PRIMARY KEY (ID_succes)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: creation_projet
#------------------------------------------------------------

CREATE TABLE creation_projet(
        email     Varchar (255) NOT NULL,
        ID_projet Int NOT NULL,
        PRIMARY KEY (email, ID_projet)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: creation_fichier
#------------------------------------------------------------

CREATE TABLE creation_fichier(
        ID_fichier Int NOT NULL,
        ID_projet  Int NOT NULL,
        PRIMARY KEY (ID_fichier, ID_projet)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: succes_reussi
#------------------------------------------------------------

CREATE TABLE succes_reussi(
        email     Varchar (255) NOT NULL ,
        ID_succes Int NOT NULL ,
        PRIMARY KEY (email, ID_succes)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Table: SHOUTBOX
#------------------------------------------------------------

CREATE TABLE SHOUTBOX_MESSAGE(
        ID_shoutbox_message int (11) Auto_increment NOT NULL,
        pseudo              Varchar (255) NOT NULL,
        message             text,
        PRIMARY KEY (ID_shoutbox_message)
)ENGINE = InnoDB;

#------------------------------------------------------------
# Contraintes:
#------------------------------------------------------------

ALTER TABLE SHOUTBOX_MESSAGE ADD CONSTRAINT FK_SHOUTBOX_MESSAGE_pseudo FOREIGN KEY (pseudo) REFERENCES MEMBRE(pseudo);
ALTER TABLE CODELIVE ADD CONSTRAINT FK_CODELIVE_ID_fichier FOREIGN KEY (ID_fichier) REFERENCES FICHIER(ID_fichier);
ALTER TABLE creation_projet ADD CONSTRAINT FK_creation_projet_email FOREIGN KEY (email) REFERENCES MEMBRE(email);
ALTER TABLE creation_projet ADD CONSTRAINT FK_creation_projet_ID_projet FOREIGN KEY (ID_projet) REFERENCES PROJET(ID_projet);
ALTER TABLE creation_fichier ADD CONSTRAINT FK_creation_fichier_ID_fichier FOREIGN KEY (ID_fichier) REFERENCES FICHIER(ID_fichier);
ALTER TABLE creation_fichier ADD CONSTRAINT FK_creation_fichier_ID_projet FOREIGN KEY (ID_projet) REFERENCES PROJET(ID_projet);
ALTER TABLE succes_reussi ADD CONSTRAINT FK_reussi_email FOREIGN KEY (email) REFERENCES MEMBRE(email);
ALTER TABLE succes_reussi ADD CONSTRAINT FK_reussi_ID_succes FOREIGN KEY (ID_succes) REFERENCES SUCCES(ID_succes);
