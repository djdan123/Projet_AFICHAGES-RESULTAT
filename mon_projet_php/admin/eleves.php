<?php
require_once "security.php";
require_once "config.php";



$sql = "SELECT e.num_inscript, e.nomEleve, e.prenomEleve, e.sexe, 
               ec.nom_ecole, o.nomOption, r.pourcentage
        FROM eleve e
        LEFT JOIN ecole ec ON e.ecole_codeEcode = ec.codeEcode
        LEFT JOIN option o ON e.option_idoption = o.idoption
        LEFT JOIN resultat r ON e.resultat_idResultat = r.idResultat
        ORDER BY e.num_inscript DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Gestion des élèves</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Liste des élèves</h1>
    <a href="ajouter_eleve.php">Ajouter un élève</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th><th>Nom</th><th>Prénom</th><th>Sexe</th>
                <th>École</th><th>Option</th><th>Résultat (%)</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['num_inscript'] ?></td>
                    <td><?= htmlspecialchars($row['nomEleve']) ?></td>
                    <td><?= htmlspecialchars($row['prenomEleve']) ?></td>
                    <td><?= $row['sexe'] ?></td>
                    <td><?= htmlspecialchars($row['nom_ecole']) ?></td>
                    <td><?= htmlspecialchars($row['nomOption']) ?></td>
                    <td><?= htmlspecialchars($row['pourcentage']) ?></td>
                    <td>
                        <a href="modifier_eleve.php?id=<?= $row['num_inscript'] ?>">Modifier</a> |
                        <a href="supprimer_eleve.php?id=<?= $row['num_inscript'] ?>" onclick="return confirm('Supprimer cet élève ?');">Supprimer</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="8">Aucun élève trouvé.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
    <p><a href="index.php">Retour au tableau de bord</a></p>
</body>
</html>
