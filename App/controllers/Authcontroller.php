<?php
require_once '../config.php';

class AuthController {

    public function login($email, $password) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../dashboard.php");
        } else {
            return "Erreur de connexion";
        }
    }

    public function register($email, $password) {
        global $pdo;

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hash]);

        return "Compte créé";
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: ../login.php");
    }
}