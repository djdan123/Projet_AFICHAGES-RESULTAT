<?php
session_start();
include("config.php");
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}


if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];
    $conn->query("DELETE FROM edition WHERE idedition=$id");
    header("Location: editions.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['annee'])) {
    $annee = (int)$_POST['annee'];
    $resultat_id = (int)$_POST['resultat_idResultat'];
    $conn->query("INSERT INTO edition (annee, resultat_idResultat) VALUES ($annee, $resultat_id)");
    header("Location: editions.php");
    exit;
}

$result = $conn->query("SELECT ed.idedition, ed.annee, r.pourcentage FROM edition ed LEFT JOIN resultat r ON ed.resultat_idResultat = r.idResultat ORDER BY ed.idedition DESC");

$allResultats = $conn->query("SELECT idResultat, pourcentage FROM resultat");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des éditions</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Gestion des éditions</h1>
    <form method="POST" action="">
        <label>Année: <input type="number" name="annee" required></label><br><br>
        <label>Résultat:
            <select name="resultat_idResultat" required>
                <option value="">--Choisir un résultat--</option>
                <?php while ($row = $allResultats->fetch_assoc()): ?>
                    <option value="<?= $row['idResultat'] ?>"><?= htmlspecialchars($row['pourcentage']) ?></option>
                <?php endwhile; ?>
            </select>
        </label><br><br>
        <button type="submit">Ajouter édition</button>
    </form>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Année</th><th>Résultat (%)</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['idedition'] ?></td>
                    <td><?= $row['annee'] ?></td>
                    <td><?= htmlspecialchars($row['pourcentage']) ?></td>
                    <td>
                        <a href="?supprimer=<?= $row['idedition'] ?>" onclick="return confirm('Supprimer cette édition ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4">Aucune édition trouvée.</td></tr>
            <?php endif; ?>
        </tbody>
    </table
