<?php
session_start();
require_once __DIR__ . '/../../config/database.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$trajets = $pdo->prepare(
    "SELECT t.*, b.name AS bateau_name, m.meteo_condition AS meteo_condition, m.temperature, m.vent, m.humidite
     FROM trajets t
     JOIN bateaux b ON t.bateau_id = b.id
     JOIN meteo m ON t.meteo_id = m.id
     WHERE t.user_id = ?"
);
$trajets->execute([$_SESSION['user_id']]);
$data = $trajets->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Dashboard</h2>
        <nav>
            <a href="nouveau-trajet.php">Créer un trajet</a>
            <a href="logout.php">Déconnexion</a>
        </nav>
        <?php if (empty($data)): ?>
            <p>Aucun trajet enregistré pour le moment.</p>
        <?php else: ?>
            <ul>
            <?php foreach ($data as $t): ?>
                <li>
                    <strong><?= htmlspecialchars($t['depart']) ?></strong> → <strong><?= htmlspecialchars($t['arrivee']) ?></strong><br>
                    Bateau : <?= htmlspecialchars($t['bateau_name']) ?><br>
                    Météo : <?= htmlspecialchars($t['meteo_condition']) ?>,
                    <?= htmlspecialchars($t['temperature']) ?>,
                    <?= htmlspecialchars($t['vent']) ?>,
                    <?= htmlspecialchars($t['humidite']) ?>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>