#------------------------------------------------------------
#        Script MySQL. Création BDD projet_BitNet.
#------------------------------------------------------------

CREATE DATABASE projet_BitNet CHARACTER SET 'utf8';

#------------------------------------------------------------
# Table: CODELIVE
#------------------------------------------------------------

CREATE TABLE CODELIVE(
        ID_session    int (11) Auto_increment  NOT NULL,
        nom_session   Varchar (255),
        nom_createur  Varchar (255),
        date_creation Date,
        ID_fichier    Int,
        PRIMARY KEY (ID_session)
);

#------------------------------------------------------------
# Table: PROJET
#------------------------------------------------------------

CREATE TABLE PROJET(
        ID_projet     int (11) Auto_increment  NOT NULL,
        nom_projet    Varchar (255),
        nom_createur  Varchar (25),
        date_creation Date,
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
        date_naissance  Date,
        ville           Int,
        date_creation   Date,
        date_update     Date,
        is_deleted      Boolean,
        succes_reussi   Int,
        profile_picture Varchar (255),
        PRIMARY KEY (email)
);

#------------------------------------------------------------
# Table: FICHIER
#------------------------------------------------------------

CREATE TABLE FICHIER(
        ID_fichier     int (11) Auto_increment  NOT NULL,
        chemin_fichier Varchar (255),
        langages       Varchar (25),
        visibilite     Boolean,
        date_creation  Date,
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
        PRIMARY KEY (ID_succes)
);

#------------------------------------------------------------
# Table: creation_projet
#------------------------------------------------------------

CREATE TABLE creation_projet(
        email     Varchar (255) NOT NULL,
        ID_projet Int NOT NULL,
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
        PRIMARY KEY (email, ID_succes)
);

ALTER TABLE CODELIVE ADD CONSTRAINT FK_CODELIVE_ID_fichier FOREIGN KEY (ID_fichier) REFERENCES FICHIER(ID_fichier);
ALTER TABLE creation_projet ADD CONSTRAINT FK_creation_projet_email FOREIGN KEY (email) REFERENCES MEMBRE(email);
ALTER TABLE creation_projet ADD CONSTRAINT FK_creation_projet_ID_projet FOREIGN KEY (ID_projet) REFERENCES PROJET(ID_projet);
ALTER TABLE creation_fichier ADD CONSTRAINT FK_creation_fichier_ID_fichier FOREIGN KEY (ID_fichier) REFERENCES FICHIER(ID_fichier);
ALTER TABLE creation_fichier ADD CONSTRAINT FK_creation_fichier_ID_projet FOREIGN KEY (ID_projet) REFERENCES PROJET(ID_projet);
ALTER TABLE succes_reussi ADD CONSTRAINT FK_reussi_email FOREIGN KEY (email) REFERENCES MEMBRE(email);
ALTER TABLE succes_reussi ADD CONSTRAINT FK_reussi_ID_succes FOREIGN KEY (ID_succes) REFERENCES SUCCES(ID_succes);
