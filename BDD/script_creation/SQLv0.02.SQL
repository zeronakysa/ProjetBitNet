#------------------------------------------------------------
#        Script MySQL. Création BDD projet_BitNet
#------------------------------------------------------------

CREATE DATABASE projet_BitNet CHARACTER SET 'utf8';
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
);

#------------------------------------------------------------
# Table: PROJET
#------------------------------------------------------------

CREATE TABLE PROJET(
        ID_projet          int (11) Auto_increment  NOT NULL,
        nom_projet         Varchar (50),
        ID_createur        Varchar (255),
        date_creation      Datetime,
        date_update        Datetime,
        description_projet Varchar (255),
        is_deleted         Boolean DEFAULT FALSE,
        PRIMARY KEY (ID_projet)
);

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
);

#------------------------------------------------------------
# Table: FICHIER
#------------------------------------------------------------

CREATE TABLE FICHIER(
        ID_fichier        int (11) Auto_increment  NOT NULL,
        ID_projet         int (11),
        chemin_fichier    Varchar (255),
        proprietaire      Varchar (255),
        nom_fichier       Varchar (255),
        extension         Varchar (25),
        date_creation     Datetime,
        date_modification Datetime,
        content           text,
        PRIMARY KEY (ID_fichier)
);

#------------------------------------------------------------
# Table: SUCCES
#------------------------------------------------------------

CREATE TABLE SUCCES(
        ID_succes          int (11) Auto_increment  NOT NULL,
        nom_succes         Varchar (150),
        description_succes Text,
        xp_donnee          Int,
        goal               INT DEFAULT 1,
        PRIMARY KEY (ID_succes)
);

#------------------------------------------------------------
# Table: participe_projet
#------------------------------------------------------------

CREATE TABLE participe_projet(
        email       Varchar (255) NOT NULL,
        ID_projet   Int NOT NULL,
        role_projet Varchar (50),
        PRIMARY KEY (email, ID_projet)
);

#------------------------------------------------------------
# Table: creation_fichier
#------------------------------------------------------------

CREATE TABLE creation_fichier(
        ID_fichier Int NOT NULL,
        ID_projet  Int NOT NULL,
        PRIMARY KEY (ID_fichier, ID_projet)
);

#------------------------------------------------------------
# Table: succes_reussi
#------------------------------------------------------------

CREATE TABLE succes_reussi(
        email     Varchar (255) NOT NULL ,
        ID_succes Int NOT NULL ,
        progression INT DEFAULT 1,
        PRIMARY KEY (email, ID_succes)
);

#------------------------------------------------------------
# Table: SHOUTBOX
#------------------------------------------------------------

CREATE TABLE SHOUTBOX_MESSAGE(
        ID_shoutbox_message int (11) Auto_increment NOT NULL,
        ID_sender           Varchar (255) NOT NULL,
        pseudo              Varchar (255),
        date_send           Datetime,
        message             text,
        PRIMARY KEY (ID_shoutbox_message)
);

#------------------------------------------------------------
# Contraintes:
#------------------------------------------------------------

ALTER TABLE SHOUTBOX_MESSAGE ADD CONSTRAINT FK_SHOUTBOX_MESSAGE_ID_sender FOREIGN KEY (ID_sender) REFERENCES MEMBRE(ID_membre);
ALTER TABLE CODELIVE ADD CONSTRAINT FK_CODELIVE_ID_fichier FOREIGN KEY (ID_fichier) REFERENCES FICHIER(ID_fichier);
ALTER TABLE participe_projet ADD CONSTRAINT FK_participe_projet_ID_projet FOREIGN KEY (ID_projet) REFERENCES PROJET(ID_projet);
ALTER TABLE participe_projet ADD CONSTRAINT FK_participe_projet_email FOREIGN KEY (email) REFERENCES MEMBRE(email);
ALTER TABLE creation_fichier ADD CONSTRAINT FK_creation_fichier_ID_fichier FOREIGN KEY (ID_fichier) REFERENCES FICHIER(ID_fichier);
ALTER TABLE creation_fichier ADD CONSTRAINT FK_creation_fichier_ID_projet FOREIGN KEY (ID_projet) REFERENCES PROJET(ID_projet);
ALTER TABLE succes_reussi ADD CONSTRAINT FK_reussi_email FOREIGN KEY (email) REFERENCES MEMBRE(email);
ALTER TABLE succes_reussi ADD CONSTRAINT FK_reussi_ID_succes FOREIGN KEY (ID_succes) REFERENCES SUCCES(ID_succes);
