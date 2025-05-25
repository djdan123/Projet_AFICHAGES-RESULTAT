<?php
require_once __DIR__."/config.php";
require_once __DIR__."/security.php";
checkAdminAuth();

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomComplet = $conn->real_escape_string($_POST["nomComplet"]);
    $codeEleve = $conn->real_escape_string($_POST["codeEleve"]);
    $sexe = $conn->real_escape_string($_POST["sexe"]);
    $ecole = $conn->real_escape_string($_POST["ecole"]);
    $cycle = $conn->real_escape_string($_POST["cycle"]);
    $province = $conn->real_escape_string($_POST["province"]);
    $option = (int)$_POST["option"];
    $resultat = (int)$_POST["resultat"];

    $sql = "INSERT INTO eleve (nomComplet, codeEleve, sexe, ecole, cycle, province, option_idoption, resultat_idResultat) 
            VALUES ('$nomComplet', '$codeEleve', '$sexe', '$ecole', '$cycle', '$province', $option, $resultat)";

    if ($conn->query($sql)) {
        header("Location: eleves.php");
        exit;
    } else {
        $error = "Erreur : " . $conn->error;
    }
}

$options = $conn->query("SELECT idoption, nomOption FROM options_exam");
$resultats = $conn->query("SELECT idResultat, pourcentage FROM resultat");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Ajouter un élève</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Ajouter un élève</h1>
    <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST" action="">
        <label>Nom complet: <input type="text" name="nomComplet" required></label><br><br>
        <label>Code élève: <input type="text" name="codeEleve" required></label><br><br>
        <label>Sexe:
            <select name="sexe" required>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </label><br><br>
        <label>École: <input type="text" name="ecole" required></label><br><br>
        <label>Cycle: <input type="text" name="cycle" required></label><br><br>
        <label>Province: <input type="text" name="province" required></label><br><br>
        <label>Option:
            <select name="option" required>
                <option value="">--Choisir une option--</option>
                <?php while($row = $options->fetch_assoc()): ?>
                    <option value="<?= $row['idoption'] ?>"><?= htmlspecialchars($row['nomOption']) ?></option>
                <?php endwhile; ?>
            </select>
        </label><br><br>
        <label>Résultat:
            <select name="resultat" required>
                <option value="">--Choisir un résultat--</option>
                <?php while($row = $resultats->fetch_assoc()): ?>
                    <option value="<?= $row['idResultat'] ?>"><?= htmlspecialchars($row['pourcentage']) ?></option>
                <?php endwhile; ?>
            </select>
        </label><br><br>
        <button type="submit">Ajouter</button>
    </form>
    <p><a href="eleves.php">Retour à la liste</a></p>
</body>
</html>