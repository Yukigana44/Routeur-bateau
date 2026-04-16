<?php
require_once __DIR__ . '/../../config/database.php';

class User {

    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

// Trouver un utilisateur par email
    public function findByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

// Créer un utilisateur
    public function create($email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        return $stmt->execute([$email, $hash]);
    }
}