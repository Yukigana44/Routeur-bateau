<?php
session_start();
require __DIR__ . '/../controllers/AuthController.php';


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new AuthController();
    $error = $auth->login($_POST['email'], $_POST['password']);
}
?>

<form method="POST">
    <h2>Connexion</h2>
    <input type="email" name="email" placeholder="Email"><br>
    <input type="password" name="password" placeholder="Mot de passe"><br>
    <button type="submit">Se connecter</button>
    <p style="color:red;"><?= $error ?></p>
</form>