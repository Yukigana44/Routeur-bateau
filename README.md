# 🚤 Routeur Bateau

## 📌 Description

Ce projet est une application web développée en PHP permettant de gérer des trajets de bateaux.

---

## 🧠 Architecture

Le projet suit une architecture **MVC (Modèle - Vue - Contrôleur)** :

* **Models** : gestion des données (base de données)
* **Controllers** : logique métier (qui vont faire l'interface entre les infos et les données)
* **Public** : interface utilisateur (pages accessibles)

---

## ⚙️ Fonctionnalités

* Inscription utilisateur
* Connexion / Déconnexion
* Création de trajets
* Modification de trajets
* Affichage des trajets dans un tableau de bord

---

## 📁 Structure du projet

* `App/Public/` : pages accessibles par le navigateur

  * `nouveau-trajet.php` : formulaire d’ajout de trajet
  * `dashboard.php` : affichage des trajets
  * `login.php`, `register.php`, `logout.php` : authentification
  * `style.css` : design du site

* `App/controllers/` : logique métier

  * `TrajetController.php` : gestion des trajets

* `App/models/` : accès aux données

  * `trajet.php`, `User.php` : interaction avec la base de données

* `config/` : configuration

  * `config.php` : paramètres de connexion
  * `database.sql` : structure de base

* `schema.sql` : script de création des tables et données initiales

---

## 🗄️ Base de données

Le projet utilise **MySQL**

---

## 🚀 Installation

### 1. Cloner le projet

```bash
gh repo clone Yukigana44/Routeur-bateau
cd Routeur-bateau
```

### 2. Configurer la base de données

Modifier le fichier :

```
config/config.php
```

avec :

* hôte
* nom de la base
* utilisateur
* mot de passe

### 3. Créer la base et les tables

```bash
mysql -u root -p < schema.sql
```

### 4. Lancer le serveur PHP

```bash
php -S localhost:8000 -t App/Public
```

---

## 🌐 Accès

Ouvrir dans le navigateur :

```
http://localhost:8000
```

---

## 🛠️ Commandes SQL utiles

### Créer une table

```sql
CREATE TABLE trajet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255),
    depart VARCHAR(255),
    arrivee VARCHAR(255)
);
```

### Ajouter une donnée

```sql
INSERT INTO trajet (nom, depart, arrivee)
VALUES ('Trajet 1', 'Paris', 'Lyon');
```

### Modifier une table

```sql
ALTER TABLE trajet ADD COLUMN date DATETIME;
```

### Supprimer une table

```sql
DROP TABLE trajet;
```

---

## 🔐 Sécurité

* Protection CSRF sur les formulaires
* Organisation MVC
* Utilisation de PDO pour sécuriser les requêtes SQL

Améliorations possibles :

* Hash sécurisé des mot de passe (`password_hash`)
* Validation renforcée des formulaires
* Sécurisation des sessions

---

## 🌦️ Données météo

Une table `meteo` est utilisée avec plusieurs modèles :

* AROME
* ARPEGE
* ICON
* GFS

Chaque entrée contient :

* température
* vitesse du vent
* humidité

---

## ⚙️ Commandes utiles

### Lancer le serveur

```bash
php -S localhost:8000 -t App/Public
```

### Vérifier un fichier PHP

```bash
php -l App/Public/nouveau-trajet.php
```

### Réinitialiser la base

```bash
mysql -u root -p < schema.sql
```

---

## 🧪 Gestion des tables (MySQL)

```sql
SHOW TABLES;
DESCRIBE meteo;
```

Ajouter une colonne :

```sql
ALTER TABLE meteo ADD COLUMN created_at DATETIME DEFAULT CURRENT_TIMESTAMP;
```

Mettre à jour une donnée :

```sql
UPDATE meteo SET meteo_condition = 'AROME' WHERE id = 1;
```

---

## 💡 Ce que j’ai mis en place

* Formulaire d’ajout de trajet fonctionnel
* Enregistrement des données en base
* Affichage des trajets
* Structure MVC
* Base de données avec script SQL
* Interface simple et claire

---

## ⚠️ Difficultés rencontrées

* Organisation des fichiers (architecture MVC)
* Liaison entre les différentes couches (model / controller / view)
* Gestion de la base de données via le terminal
* Simplification du projet (suppression de la carte Leaflet)

---

## ➕ Points forts du projet

* Formulaires fonctionnels
* Utilisation concrète de SQL
* Bonne compréhension du lien entre PHP et base de données
