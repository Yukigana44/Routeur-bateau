-- Schéma de base de données application routage maritime

CREATE DATABASE IF NOT EXISTS routeur-bateau
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE routeur-bateau;

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
) ENGINE=InnoDB;

CREATE TABLE bateaux (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50),
    vitesse FLOAT,
) ENGINE=InnoDB;

CREATE TABLE trajets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    bateau_id INT UNSIGNED NOT NULL,
    depart VARCHAR(255) NOT NULL,
    arrivee VARCHAR(255) NOT NULL,
    météo VARCHAR(255),
    date DATETIME NOT NULL,
) ENGINE=InnoDB;
