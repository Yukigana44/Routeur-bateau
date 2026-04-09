<?php
require __DIR__ . '/../Public/config.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->execute([$email, $hash]);

        $message = "Compte créé !";
    } else {
        $message = "Remplis tous les champs";
    }
}
?>

<form method="POST">
    <h2>Inscription</h2>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Mot de passe"><br>
    <button type="submit">Créer</button>
    <p><?= $message ?></p>
</form>