<?php
session_start();
require __DIR__ . '/../config/database.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$trajets = $pdo->prepare("SELECT * FROM trajets WHERE user_id = ?");
$trajets->execute([$_SESSION['user_id']]);
$data = $trajets->fetchAll();
?>

<h2>Dashboard</h2>
<a href="nouveau_trajet.php">Créer un trajet</a>
<a href="logout.php">Déconnexion</a>

<ul>
<?php foreach ($data as $t): ?>
    <li><?= $t['depart'] ?> → <?= $t['arrivee'] ?> (<?= $t['meteo'] ?>)</li>
<?php endforeach; ?>
</ul>