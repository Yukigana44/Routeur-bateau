<?php
require_once __DIR__ . '/../../config/database.php';

class AuthController {

    private function ensureSession()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    private function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    private function validatePassword(string $password): bool
    {
        return mb_strlen($password) >= 8
            && preg_match('/[A-Z]/', $password)
            && preg_match('/[a-z]/', $password)
            && preg_match('/[0-9]/', $password);
    }

    public function login($email, $password) {
        global $pdo;

        if (!$this->validateEmail($email) || $password === '') {
            return "Erreur de connexion";
        }

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->ensureSession();
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            header("Location: dashboard.php");
            exit;
        }

        return "Erreur de connexion";
    }

    public function register($email, $password) {
        global $pdo;

        if (!$this->validateEmail($email)) {
            return "Adresse email invalide";
        }

        if (!$this->validatePassword($password)) {
            return "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre";
        }

        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return "Cette adresse email est déjà utilisée";
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");

        if ($stmt->execute([$email, $hash])) {
            return "Compte créé";
        }

        return "Erreur lors de la création du compte";
    }

    public function logout() {
        $this->ensureSession();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}