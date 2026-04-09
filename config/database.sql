CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100),
    password VARCHAR(100),
)

CREATE TABLE bateaux (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    type VARCHAR(50),
    vitesse FLOAT,
)

CREATE TABLE trajets (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    bateau_id INT,
    depart VARCHAR(100),
    arrivee VARCHAR(100),
    météo VARCHAR(100),
    date DATETIME,
)
