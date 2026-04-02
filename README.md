# Routeur-bateau

Bienvenue sur mon projet de routage bateau pour le cours de PHP.

## La structure du projet
app/
│── composer.json
│── config/
│    └── database.php
│
│── src/
│    ├── Controller/
│    │    ├── AuthController.php
│    │    └── TrajetController.php
│    │
│    ├── Repository/
│    │    ├── UserRepository.php
│    │    └── TrajetRepository.php
│
│── views/
│    ├── layout.php
│    ├── auth/
│    │    ├── login.php
│    │    └── register.php
│    │
│    └── trajet/
│         ├── list.php
│         └── create.php
│
│── public/
│    ├── index.php
│    └── style.css
│
│── schema.sql