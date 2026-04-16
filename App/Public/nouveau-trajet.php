<?php
session_start();
require_once __DIR__ . '/../helpers/csrf.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../controllers/TrajetController.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$message = '';

$bateaux = $pdo->query("SELECT * FROM bateaux")->fetchAll();
if (empty($bateaux)) {
    $pdo->exec("INSERT INTO bateaux (name, type, vitesse) VALUES
        ('Nautilus', 'Voilier', 18.5),
        ('Mistral', 'Bateau de pêche', 12.0),
        ('Clipper', 'Bateau de course', 30.0)");
    $bateaux = $pdo->query("SELECT * FROM bateaux")->fetchAll();
}

$meteos = $pdo->query("SELECT * FROM meteo")->fetchAll();
if (empty($meteos)) {
    $pdo->exec("INSERT INTO meteo (meteo_condition, temperature, vent, humidite) VALUES
        ('AROME', '22°C', '10 km/h', '45%'),
        ('ARPEGE', '18°C', '30 km/h', '55%'),
        ('ICON', '20°C', '40 km/h', '70%'),
        ('GFS', '10°C', '5 km/h', '90%')");
    $meteos = $pdo->query("SELECT * FROM meteo")->fetchAll();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($bateaux) && !empty($meteos)) {
    $token = $_POST['csrf_token'] ?? '';
    if (!csrf_validate($token)) {
        $message = 'Token CSRF invalide.';
    } else {
        $trajet = new TrajetController();
        $trajet->create(
            $_SESSION['user_id'],
            $_POST['bateau_id'],
            $_POST['meteo_id'],
            $_POST['depart'],
            $_POST['arrivee'],
            $_POST['date']
        );

        $message = "Trajet ajouté !";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un trajet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Ajouter un trajet</h2>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <?php if (empty($bateaux) || empty($meteos)): ?>
            <p class="error">Aucune donnée de bateau ou météo disponible pour le moment. Réessaie plus tard.</p>
        <?php else: ?>
            <form method="POST">
                <label>Bateau
                    <select name="bateau_id" required>
                        <?php foreach ($bateaux as $bateau): ?>
                            <option value="<?= htmlspecialchars($bateau['id']) ?>"><?= htmlspecialchars($bateau['name']) ?> (<?= htmlspecialchars($bateau['type']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>Météo
                    <select id="meteo-select" name="meteo_id" required>
                        <?php foreach ($meteos as $meteo): ?>
                            <option value="<?= htmlspecialchars($meteo['id']) ?>"><?= htmlspecialchars($meteo['meteo_condition']) ?> - <?= htmlspecialchars($meteo['temperature']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>Départ
                    <input type="text" name="depart" required>
                </label>
                <label>Arrivée
                    <input type="text" name="arrivee" required>
                </label>
                <label>Date
                    <input type="datetime-local" name="date" required>
                </label>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                <button type="submit">Ajouter</button>
            </form>
        <?php endif; ?>

        <a class="footer-link" href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>