CREATE DATABASE IF NOT EXISTS projet_php
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE projet_php;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS bateaux (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50),
    vitesse FLOAT
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS meteo (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    meteo_condition VARCHAR(100) NOT NULL,
    temperature VARCHAR(50),
    vent VARCHAR(50),
    humidite VARCHAR(50),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS trajets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    bateau_id INT UNSIGNED NOT NULL,
    meteo_id INT UNSIGNED NOT NULL,
    depart VARCHAR(100) NOT NULL,
    arrivee VARCHAR(100) NOT NULL,
    date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (bateau_id) REFERENCES bateaux(id),
    FOREIGN KEY (meteo_id) REFERENCES meteo(id)
) ENGINE=InnoDB;

INSERT IGNORE INTO bateaux (id, name, type, vitesse) VALUES
    (1, 'Nautilus', 'Voilier', 18.5),
    (2, 'Mistral', 'Bateau de pêche', 12.0),
    (3, 'Clipper', 'Bateau de course', 30.0);

INSERT IGNORE INTO meteo (id, meteo_condition, temperature, vent, humidite) VALUES
    (1, 'AROME', '22°C', '10 km/h', '45%'),
    (2, 'ARPEGE', '18°C', '30 km/h', '55%'),
    (3, 'ICON', '20°C', '40 km/h', '70%'),
    (4, 'GFS', '10°C', '5 km/h', '90%');