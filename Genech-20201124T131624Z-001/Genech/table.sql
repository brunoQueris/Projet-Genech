-- Base de données

-- Structure de la table de l'utilisateur

CREATE TABLE users(
	id SERIAL NOT NULL PRIMARY KEY,
	login varchar(100) NOT NULL UNIQUE,
	password varchar(200) NOT NULL,
	email varchar(100) NOT NULL,
	nom varchar(100) NOT NULL,
	prenom varchar(60) NOT NULL
);


