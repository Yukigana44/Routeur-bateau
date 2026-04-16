# Routeur-bateau

Projet cours PHP

## Objectif

Créer un parcours de navigation avec :
- un système d'authentification simple (connexion / inscription)
- une page pour ajouter un trajet
- un choix de bateau et un choix de modèle météo
- une base de données pour stocker les utilisateurs, bateaux, météo et trajets

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
- simulateur de résultat pour visualiser la route et la météo suite au formulaire de création (avec Leaflet et Météo France) je sais pas pourquoi ça ne s'affichait pas donc j'ai supprimé
- gestion de la base de données et des valeurs initiales dans les différents fichiers SQL avec le terminal 

## Les + du projet

- j'ai réussi à faire des formulaires, créer des tableeau et faire un schema SQL
- j'ai appris à faire du SQL et mieux utiliser le terminal

