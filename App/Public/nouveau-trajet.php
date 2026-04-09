<?php
session_start();
require __DIR__ . '/../Public/config.php';
require __DIR__ . '/../controllers/TrajetController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = '';

$bateaux = $pdo->query("SELECT * FROM bateaux")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trajet = new TrajetController();
    $trajet->create(
        $_SESSION['user_id'],
        $_POST['bateau_id'],
        $_POST['depart'],
        $_POST['arrivee'],
        $_POST['meteo'],
        $_POST['date']
    );

    $message = "Trajet ajouté !";
}
?>