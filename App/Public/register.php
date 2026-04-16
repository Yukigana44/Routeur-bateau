<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
require_once __DIR__ . '/../controllers/AuthController.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $auth = new AuthController();
        $message = $auth->register($email, $password);
        if ($message === 'Compte créé') {
            header('Location: login.php');
            exit;
        }
    } else {
        $message = "Remplis tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Inscription</h2>
        <form method="POST">
            <label>Email
                <input type="email" name="email" placeholder="Email" required>
            </label>
            <label>Mot de passe
                <input type="password" name="password" placeholder="Mot de passe" required>
            </label>
            <button type="submit">Créer</button>
        </form>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <a class="footer-link" href="login.php">Déjà inscrit ? Connectez-vous</a>
    </div>
</body>
</html>