<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
require_once __DIR__ . '/../controllers/AuthController.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $error = $auth->login($_POST['email'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form method="POST">
            <label>Email
                <input type="email" name="email" placeholder="Email" required>
            </label>
            <label>Mot de passe
                <input type="password" name="password" placeholder="Mot de passe" required>
            </label>
            <button type="submit">Se connecter</button>
        </form>
        <?php if ($error): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <a class="footer-link" href="register.php">Créer un compte</a>
    </div>
</body>
</html>