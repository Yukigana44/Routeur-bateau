<?php
session_start();
require 'config.php'; 
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Préparation de la requête sécurisée
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Connexion réussie
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nom'];
            header('Location: index.php'); // redirection vers page d'accueil
            exit;
        } else {
            $error = "Email ou mot de passe incorrect";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        body { 
            font-family: Arial; 
            background-color: #f4f4f4; 
            display:flex; 
            justify-content:center; 
            align-items:center; 
            height:100vh; 
        }
        .login-form { 
            background: #fff; 
            padding:20px; 
            border-radius:5px; 
            box-shadow:0 0 10px rgba(0,0,0,0.1); 
            width:300px; 
        }
        input { 
            width:100%; 
            padding:10px; 
            margin:5px 0; 
        }
        button {
            width:100%; 
            padding:10px; 
            background:#007BFF; 
            color:#fff; 
            border:none; 
            cursor:pointer; 
        }
        .error { 
            color:red; 
        }
    </style>
</head>
<body>

<div class="login-form">
    <h2>Connexion</h2>
    <?php if($error) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pas encore inscrit ? 
        <a href="register.php">Créer un compte</a>
    </p>
</div>

</body>
</html>