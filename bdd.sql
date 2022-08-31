DROP DATABASE IF EXISTS katakatani;

CREATE DATABASE IF NOT EXISTS katakatani;

CREATE TABLE katakatani (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    matricule VARCHAR(255),
    acheter_at DATETIME,
    prix_achat INT NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE chauffeur (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    prenom VARCHAR(255) NOT NULL,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    telephone1 VARCHAR(23) NOT NULL,
    telephone2 VARCHAR(23),
    debut_at DATETIME NOT NULL,
    fin_at DATETIME,
    katakatani_id INT UNSIGNED,
    PRIMARY KEY(id),
    FOREIGN KEY (katakatani_id)
        REFERENCES katakatani (id)
);

CREATE TABLE comptabilite (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    motif ENUM('Dépense', 'Recette') NOT NULL,
    montant INT NOT NULL,
    date_at DATETIME NOT NULL,
    details TEXT(650000),
    katakatani_id INT UNSIGNED,
    PRIMARY KEY(id),
    FOREIGN KEY (katakatani_id)
        REFERENCES katakatani (id)
);

CREATE TABLE users (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    roles VARCHAR(255),
    PRIMARY KEY(id)
);