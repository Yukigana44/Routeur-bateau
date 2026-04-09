<?php
require_once __DIR__ . '/../../config/database.php';

class TrajetController {

    public function create($user_id, $bateau_id, $depart, $arrivee, $meteo, $date) {
        global $pdo;

        $stmt = $pdo->prepare("INSERT INTO trajets (user_id, bateau_id, depart, arrivee, meteo, date)
                               VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_id, $bateau_id, $depart, $arrivee, $meteo, $date]);
    }

    public function getByUser($user_id) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM trajets WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}