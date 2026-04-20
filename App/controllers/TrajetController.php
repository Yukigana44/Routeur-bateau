<?php

namespace App\Controllers;

require_once __DIR__ . '/../../config/database.php';

use App\Repository\TrajetRepository;

class TrajetController
{
    private TrajetRepository $trajetRepository;

    public function __construct()
    {
        global $pdo;
        $this->trajetRepository = new TrajetRepository($pdo);
    }

    /**
     * Crée un nouveau trajet avec execute()
     */
    public function create($user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date)
    {
        return $this->trajetRepository->create($user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date);
    }

    /**
     * Récupère tous les trajets d'un utilisateur avec fetchAll()
     */
    public function getByUser($user_id)
    {
        return $this->trajetRepository->findByUser($user_id);
    }

    /**
     * Recupère un seul trajet avec fetch()
     */
    public function get($id, $user_id)
    {
        return $this->trajetRepository->findById($id, $user_id);
    }

    /**
     * Met à jour un trajet existant avec execute()
     */
    public function update($id, $user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date)
    {
        return $this->trajetRepository->update($id, $user_id, $bateau_id, $meteo_id, $depart, $arrivee, $date);
    }

    /**
     * Supprime un trajet avec execute()
     */
    public function delete($id, $user_id)
    {
        return $this->trajetRepository->delete($id, $user_id);
    }

    /**
     * Récupère tous les bateaux avec query()
     */
    public function getBateaux()
    {
        return $this->trajetRepository->findAllBoats();
    }

    /**
     * Récupère toutes les conditions météo avec query()
     */
    public function getWeather()
    {
        return $this->trajetRepository->findAllWeather();
    }

    /**
     * Récupère le nombre total de trajets avec fetch()
     */
    public function countByUser($user_id): int
    {
        return $this->trajetRepository->countByUser($user_id);
    }
}
