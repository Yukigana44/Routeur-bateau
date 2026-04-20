<?php

namespace App\Controllers;

require_once __DIR__ . '/../../config/database.php';

use App\Repository\UserRepository;

class AuthController {

    private UserRepository $userRepository;

    public function __construct()
    {
        global $pdo;
        $this->userRepository = new UserRepository($pdo);
    }

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
        if (!$this->validateEmail($email) || $password === '') {
            return "Erreur de connexion";
        }

        // fetch() : une seule ligne
        $user = $this->userRepository->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $this->ensureSession();
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            header("Location: /dashboard");
            exit;
        }

        return "Erreur de connexion";
    }

    public function register($email, $password) {
        if (!$this->validateEmail($email)) {
            return "Adresse email invalide";
        }

        if (!$this->validatePassword($password)) {
            return "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre";
        }

        // fetch() : vérifier si l'email existe
        $existingUser = $this->userRepository->findByEmail($email);
        if ($existingUser) {
            return "Cette adresse email est déjà utilisée";
        }

        // execute() pour l'INSERT
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($this->userRepository->create($email, $hash)) {
            return "Compte créé";
        }

        return "Erreur lors de la création du compte";
    }

    public function logout() {
        $this->ensureSession();
        session_destroy();
        header("Location: /login");
        exit;
    }
}
