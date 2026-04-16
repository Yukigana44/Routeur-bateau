<?php
require_once __DIR__ . '/../../config/database.php';

class TrajetController
{
    public function create($user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date)
    {
        global $pdo;

        $stmt = $pdo->prepare(
            "INSERT INTO trajets (user_id, bateau_id, meteo_id, depart, arrivee, date)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([$user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date]);
    }

    public function getByUser($user_id)
    {
        global $pdo;

        $stmt = $pdo->prepare(
            "SELECT t.*, b.name AS bateau_name, m.meteo_condition AS meteo_condition, m.temperature, m.vent, m.humidite
             FROM trajets t
             JOIN bateaux b ON t.bateau_id = b.id
             JOIN meteo m ON t.meteo_id = m.id
             WHERE t.user_id = ?"
        );
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}
