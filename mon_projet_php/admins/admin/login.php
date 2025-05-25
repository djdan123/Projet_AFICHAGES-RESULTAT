<?php 

//Détruit complètement la session existante
session_start();
session_unset();
session_destroy();

// Nouvelle session propre
session_start([
    'name' => 'AdminSecureSession',
    'cookie_lifetime' => 86400,
    'cookie_secure' => isset($_SERVER['HTTPS']),
    'cookie_httponly' => true,
    'use_strict_mode' => true
]);

require_once __DIR__.'/config.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Vérification simple (à remplacer par une vérification réelle)
    if ($username === 'adminphp' && $password === 'admin123') {
        $_SESSION['admin_logged'] = true;
        $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        
        // Redirection avec en-têtes propres
        header('Location: index.php');
        exit();
    } else {
        $error = 'Identifiants incorrects';
    }
}
    
/*
session_start();
session_destroy();
session_start();

include("config.php");

// Solution temporaire - Contournement de la vérification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['username'] === 'adminphp' && $_POST['password'] === 'admin123') {
        $_SESSION['admin_logged'] = true;
        $_SESSION['admin_id'] = 1; // ID arbitraire
        header("Location: index.php");
        exit;
    } else {
        $error = "Identifiants incorrects (adminphp/admin123 attendus)";
    }
}
    */

?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .login-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <h2>Connexion Administrateur</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
