<?php

namespace App\Repository;

class UserRepository
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Récupère un utilisateur par email
     * fetch() : une seule ligne
     */
    public function findByEmail(string $email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    /**
     * Récupère un utilisateur par ID
     */
    public function findById(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Crée un nouvel utilisateur
     * Pour INSERT, on utilise prepare() + execute()
     */
    public function create(string $email, string $hash): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hash]);
    }

    /**
     * Récupère le nombre total d'utilisateurs
     * fetch() pour une seule ligne avec COUNT
     */
    public function countAll(): int
    {
        $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM users");
        $result = $stmt->fetch();
        return (int) $result['total'];
    }

    /**
     * Récupère tous les utilisateurs
     * fetchAll() : plusieurs lignes
     */
    public function findAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }
}
