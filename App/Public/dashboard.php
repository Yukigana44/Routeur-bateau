<?php
session_start();
require_once __DIR__ . '/../helpers/csrf.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../controllers/TrajetController.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$controller = new TrajetController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_trajet'])) {
    $token = $_POST['csrf_token'] ?? '';
    if (csrf_validate($token)) {
        $controller->delete($_POST['delete_trajet'], $_SESSION['user_id']);
    }
    header('Location: dashboard.php');
    exit;
}

$trajets = $controller->getByUser($_SESSION['user_id']);
$data = $trajets;
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
                    <div class="item-header">
                        <strong><?= htmlspecialchars($t['depart']) ?></strong> → <strong><?= htmlspecialchars($t['arrivee']) ?></strong>
                    </div>
                    <div>Bateau : <?= htmlspecialchars($t['bateau_name']) ?></div>
                    <div>Météo : <?= htmlspecialchars($t['meteo_condition']) ?>,
                        <?= htmlspecialchars($t['temperature']) ?>,
                        <?= htmlspecialchars($t['vent']) ?>,
                        <?= htmlspecialchars($t['humidite']) ?></div>
                    <div class="item-actions">
                        <a class="button button-secondary" href="modifier-trajet.php?id=<?= htmlspecialchars($t['id']) ?>">Modifier</a>
                        <form method="POST" action="dashboard.php" class="inline-form" onsubmit="return confirm('Supprimer ce trajet ?');">
                            <input type="hidden" name="delete_trajet" value="<?= htmlspecialchars($t['id']) ?>">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
                            <button type="submit" class="button button-danger">Supprimer</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>