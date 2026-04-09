<?php
require_once 'config.php';

class Trajets {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

// Créer un trajet
    public function create($user_id, $bateau_id, $depart, $arrivee, $meteo, $date) {
        $stmt = $this->pdo->prepare("
            INSERT INTO trajets (user_id, bateau_id, depart, arrivee, meteo, date)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([$user_id, $bateau_id, $depart, $arrivee, $meteo, $date]);
    }

// Récupérer les trajets d’un utilisateur
    public function getByUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM trajets WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}