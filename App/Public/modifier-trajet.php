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
$message = '';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$trajet = $controller->get($id, $_SESSION['user_id']);

if (!$trajet) {
    header('Location: dashboard.php');
    exit;
}

$bateaux = $pdo->query("SELECT * FROM bateaux")->fetchAll();
$meteos = $pdo->query("SELECT * FROM meteo")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!csrf_validate($token)) {
        $message = 'Token CSRF invalide.';
    } else {
        $controller->update(
            $id,
            $_SESSION['user_id'],
            $_POST['bateau_id'],
            $_POST['meteo_id'],
            $_POST['depart'],
            $_POST['arrivee'],
            $_POST['date']
        );
        $message = 'Trajet modifié !';
        $trajet = $controller->get($id, $_SESSION['user_id']);
    }
}

$dateValue = date('Y-m-d\TH:i', strtotime($trajet['date']));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un trajet</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Modifier un trajet</h2>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Bateau
                <select name="bateau_id" required>
                    <?php foreach ($bateaux as $bateau): ?>
                        <option value="<?= htmlspecialchars($bateau['id']) ?>" <?= $bateau['id'] == $trajet['bateau_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($bateau['name']) ?> (<?= htmlspecialchars($bateau['type']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Météo
                <select name="meteo_id" required>
                    <?php foreach ($meteos as $meteo): ?>
                        <option value="<?= htmlspecialchars($meteo['id']) ?>" <?= $meteo['id'] == $trajet['meteo_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($meteo['meteo_condition']) ?> - <?= htmlspecialchars($meteo['temperature']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>Départ
                <input type="text" name="depart" value="<?= htmlspecialchars($trajet['depart']) ?>" required>
            </label>
            <label>Arrivée
                <input type="text" name="arrivee" value="<?= htmlspecialchars($trajet['arrivee']) ?>" required>
            </label>
            <label>Date
                <input type="datetime-local" name="date" value="<?= htmlspecialchars($dateValue) ?>" required>
            </label>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrf_token()) ?>">
            <button type="submit">Enregistrer</button>
        </form>

        <a class="footer-link" href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
