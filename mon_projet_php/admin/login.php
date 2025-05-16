<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("config.php");

if (isset($_SESSION['admin_logged'])) {
    header("Location: index.php"); // Évite la boucle
    exit;
}
$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Requête préparée pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT id, password FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        // Vérifie le mot de passe hashé
        if (password_verify($password, $user['password'])) {
            $_SESSION['admin_logged'] = true;
            $_SESSION['admin_id'] = $user['id'];
            header("Location: index.php");
            exit;
        }
    }
   
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Connexion Admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-form">
        <h2>Connexion Administrateur</h2>
        <?php if ($error) echo "<p class='error'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Nom d'utilisateur" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>