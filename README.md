# Routeur-bateau

## Présentation du projet

Routeur-bateau est une application PHP simple permettant de gérer des trajets en mer. L'objectif est de pouvoir enregistrer un trajet avec un bateau, sélectionner un modèle météo et stocker ces informations dans une base de données.

## Structure de l'application

- `App/Public/`: pages accessibles par le navigateur
  - `nouveau-trajet.php` : formulaire pour ajouter un trajet
  - `dashboard.php` : affichage des trajets enregistrés
  - `login.php`, `register.php`, `logout.php` : gestion de l'authentification
  - `style.css` : styles du site
- `App/controllers/`: logique de traitement
  - `TrajetController.php` :  création et lecture des trajets
- `App/models/`: accès aux données
  - `trajet.php` et `User.php` : modèles pour la base de données
- `config/`: configuration et schéma SQL
  - `config.php` : connexion PDO à la base
  - `database.sql` : structure et données de base
- `schema.sql`: script de création des tables et jeu de données initial

## Installation

1. Cloner le dépôt :
   ```bash
   git clone <URL_DU_DEPOT>
   cd Routeur-bateau
   ```
2. Configurer la connexion à la base dans `config/config.php` :
   - hôte
   - nom de la base
   - utilisateur
   - mot de passe
3. Créer la base de données et les tables avec le script SQL :
   ```bash
   mysql -u root -p < schema.sql
   ```
   ou si la base existe déjà :
   ```bash
   mysql -u root -p projet_php < config/database.sql
   ```
4. Lancer le serveur PHP intégré :
   ```bash
   php -S localhost:8000 -t App/Public
   ```
5. Ouvrir le navigateur :
   - `http://localhost:8000`

## Commandes importantes

- Vérifier la syntaxe PHP :
  ```bash
  php -l App/Public/nouveau-trajet.php
  ```
- Lancer le serveur local :
  ```bash
  php -S localhost:8000 -t App/Public
  ```
- Réinitialiser la base avec le fichier SQL :
  ```bash
  mysql -u root -p < schema.sql
  ```

## Gestion des tables SQL dans le terminal

1. Se connecter à MySQL :
   ```bash
   mysql -u root -p
   ```
2. Créer la base si nécessaire :
   ```sql
   CREATE DATABASE projet_php;
   USE projet_php;
   SOURCE schema.sql;
   ```
3. Voir les tables :
   ```sql
   SHOW TABLES;
   ```
4. Voir la structure d'une table :
   ```sql
   DESCRIBE meteo;
   ```
5. Modifier une table existante :
   ```sql
   ALTER TABLE meteo ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
   ```
6. Mettre à jour une valeur dans une table :
   ```sql
   UPDATE meteo SET meteo_condition = 'AROME' WHERE id = 1;
   ```

## Ce que j'ai mis en place

- `App/Public/nouveau-trajet.php` : formulaire de saisie du trajet
- `App/controllers/TrajetController.php` et `App/models/trajet.php` : gestion de l'enregistrement en base
- `config/database.sql` et `schema.sql` : création des tables et données initiales
- `App/Public/dashboard.php` : affichage des trajets enregistrés
- `App/Public/style.css` : mise en page sobre en tons bleus

## Données météo

La table `meteo` contient aujourd'hui des modèles nominaux :
- AROME
- ARPEGE
- ICON
- GFS

Chaque entrée stocke aussi une température, une vitesse de vent et une humidité.

## Difficultés rencontrées

- organisation des dossiers et fichiers du projet
- connexion entre les différents fichiers
- suppression de la simulation et de la carte Leaflet pour garder une page de trajet plus claire
- gestion de la base de données et des valeurs initiales dans les différents fichiers SQL avec le terminal

## Les + du projet

- formulaires fonctionnels
- schéma SQL créé et utilisé
- meilleure compréhension du SQL et du terminal

