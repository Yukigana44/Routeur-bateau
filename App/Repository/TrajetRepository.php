<?php

namespace App\Repository;

class TrajetRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Crée un nouveau trajet
     * Pour INSERT, on utilise prepare() + execute()
     */
    public function create(int $user_id, int $bateau_id, int $meteo_id, string $depart, string $arrivee, string $date): bool
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO trajets (user_id, bateau_id, meteo_id, depart, arrivee, date)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date]);
    }

    /**
     * Récupère tous les trajets d'un utilisateur
     * fetchAll() : plusieurs lignes avec jointures
     */
    public function findByUser(int $user_id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT t.*, b.name AS bateau_name, m.meteo_condition, m.temperature, m.vent, m.humidite
             FROM trajets t
             JOIN bateaux b ON t.bateau_id = b.id
             JOIN meteo m ON t.meteo_id = m.id
             WHERE t.user_id = ?
             ORDER BY t.date DESC"
        );
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    /**
     * Récupère un seul trajet
     * fetch() : une seule ligne
     */
    public function findById(int $id, int $user_id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM trajets WHERE id = ? AND user_id = ?"
        );
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch();
    }

    /**
     * Met à jour un trajet existant
     * Pour UPDATE, on utilise prepare() + execute()
     */
    public function update(int $id, int $user_id, int $bateau_id, int $meteo_id, string $depart, string $arrivee, string $date): bool
    {
        $stmt = $this->pdo->prepare(
            "UPDATE trajets SET bateau_id = ?, meteo_id = ?, depart = ?, arrivee = ?, date = ?
             WHERE id = ? AND user_id = ?"
        );
        return $stmt->execute([$bateau_id, $meteo_id, $depart, $arrivee, $date, $id, $user_id]);
    }

    /**
     * Supprime un trajet
     * Pour DELETE, on utilise prepare() + execute()
     */
    public function delete(int $id, int $user_id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM trajets WHERE id = ? AND user_id = ?"
        );
        return $stmt->execute([$id, $user_id]);
    }

    /**
     * Récupère le nombre total de trajets d'un utilisateur
     * fetch() pour une seule ligne avec COUNT
     */
    public function countByUser(int $user_id): int
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*) as total FROM trajets WHERE user_id = ?"
        );
        $stmt->execute([$user_id]);
        $result = $stmt->fetch();
        return (int) $result['total'];
    }

    /**
     * Récupère tous les bateaux
     * query() : pour les requêtes sans paramètres
     */
    public function findAllBoats()
    {
        $stmt = $this->pdo->query("SELECT * FROM bateaux");
        return $stmt->fetchAll();
    }

    /**
     * Récupère toutes les conditions météo
     * query() : pour les requêtes sans paramètres
     */
    public function findAllWeather()
    {
        $stmt = $this->pdo->query("SELECT * FROM meteo");
        return $stmt->fetchAll();
    }
}
