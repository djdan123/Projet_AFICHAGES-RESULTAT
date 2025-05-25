<?php

session_start();
include("config.php");
/*
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}
    */



if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];
    $conn->query("DELETE FROM resultat WHERE idResultat=$id");
    header("Location: resultats.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['pourcentage'])) {
    $pourcentage = $conn->real_escape_string($_POST['pourcentage']);
    $conn->query("INSERT INTO resultat (pourcentage) VALUES ('$pourcentage')");
    header("Location: resultats.php");
    exit;
}

$result = $conn->query("SELECT * FROM resultat ORDER BY idResultat DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des résultats</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Gestion des résultats</h1>
    <form method="POST" action="">
        <label>Pourcentage: <input type="text" name="pourcentage" required></label><br><br>
        <button type="submit">Ajouter résultat</button>
    </form>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Pourcentage</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['idResultat'] ?></td>
                    <td><?= htmlspecialchars($row['pourcentage']) ?></td>
                    <td>
                        <a href="?supprimer=<?= $row['idResultat'] ?>" onclick="return confirm('Supprimer ce résultat ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="3">Aucun résultat trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="index.php">Retour au tableau de bord</a></p>
</body>
</html>
