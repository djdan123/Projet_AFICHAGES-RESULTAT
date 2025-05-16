<?php
session_start();
include("config.php");

if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}


// Suppression si demandé
if (isset($_GET['supprimer'])) {
    $id = (int)$_GET['supprimer'];
    $conn->query("DELETE FROM ecole WHERE codeEcode=$id");
    header("Location: ecoles.php");
    exit;
}

// Ajout
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['nom_ecole'])) {
    $nom = $conn->real_escape_string($_POST['nom_ecole']);
    $dpe = (int)$_POST['code_DPE'];
    $dce = (int)$_POST['code_DCE'];
    $conn->query("INSERT INTO ecole (nom_ecole, code_DPE, code_DCE) VALUES ('$nom', $dpe, $dce)");
    header("Location: ecoles.php");
    exit;
}

$result = $conn->query("SELECT * FROM ecole ORDER BY codeEcode DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des écoles</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Gestion des écoles</h1>
    <form method="POST" action="">
        <label>Nom de l'école: <input type="text" name="nom_ecole" required></label><br><br>
        <label>Code DPE: <input type="number" name="code_DPE" required></label><br><br>
        <label>Code DCE: <input type="number" name="code_DCE" required></label><br><br>
        <button type="submit">Ajouter école</button>
    </form>
    <hr>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr><th>ID</th><th>Nom</th><th>Code DPE</th><th>Code DCE</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['codeEcode'] ?></td>
                    <td><?= htmlspecialchars($row['nom_ecole']) ?></td>
                    <td><?= $row['code_DPE'] ?></td>
                    <td><?= $row['code_DCE'] ?></td>
                    <td>
                        <a href="?supprimer=<?= $row['codeEcode'] ?>" onclick="return confirm('Supprimer cette école ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">Aucune école trouvée.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="index.php">Retour au tableau de bord</a></p>
</body>
</html>
