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

    public function get($id, $user_id)
    {
        global $pdo;

        $stmt = $pdo->prepare(
            "SELECT * FROM trajets WHERE id = ? AND user_id = ?"
        );
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch();
    }

    public function update($id, $user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date)
    {
        global $pdo;

        $stmt = $pdo->prepare(
            "UPDATE trajets SET bateau_id = ?, meteo_id = ?, depart = ?, arrivee = ?, date = ?
             WHERE id = ? AND user_id = ?"
        );
        return $stmt->execute([$bateau_id, $meteo_id, $depart, $arrivee, $date, $id, $user_id]);
    }

    public function delete($id, $user_id)
    {
        global $pdo;

        $stmt = $pdo->prepare(
            "DELETE FROM trajets WHERE id = ? AND user_id = ?"
        );
        return $stmt->execute([$id, $user_id]);
    }
}
