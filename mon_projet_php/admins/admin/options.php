<?php
require_once __DIR__."/config.php";
require_once __DIR__."/security.php";
/*

if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}
    */



if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];
    $conn->query("DELETE FROM options_exam WHERE idoption=$id");
    header("Location: options.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nomOption'])) {
    $nom = $conn->real_escape_string($_POST['nomOption']);
    $conn->query("INSERT INTO options_exam (nomOption) VALUES ('$nom')");
    header("Location: options.php");
    exit;
}

$result = $conn->query("SELECT * FROM options_exam ORDER BY idoption DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des options</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Gestion des options</h1>
    <form method="POST" action="">
        <label>Nom de l'option: <input type="text" name="nomOption" required></label><br><br>
        <button type="submit">Ajouter option</button>
    </form>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Nom option</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['idoption'] ?></td>
                    <td><?= htmlspecialchars($row['nomOption']) ?></td>
                    <td>
                        <a href="?supprimer=<?= $row['idoption'] ?>" onclick="return confirm('Supprimer cette option ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">Aucune option trouvée.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="index.php">Retour au tableau de bord</a></p>
</body>
</html>
