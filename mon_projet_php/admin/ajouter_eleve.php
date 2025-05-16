<?php
session_start();
include("config.php");
if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $conn->real_escape_string($_POST["nom"]);
    $prenom = $conn->real_escape_string($_POST["prenom"]);
    $sexe = $_POST["sexe"];
    $ecole = (int)$_POST["ecole"];
    $option = (int)$_POST["option"];
    $resultat = (int)$_POST["resultat"];

    $sql = "INSERT INTO eleve (nomEleve, prenomEleve, sexe, ecole_codeEcode, option_idoption, resultat_idResultat) 
            VALUES ('$nom', '$prenom', '$sexe', $ecole, $option, $resultat)";

    if ($conn->query($sql)) {
        header("Location: eleves.php");
        exit;
    } else {
        $error = "Erreur : " . $conn->error;
    }
}

// Pour afficher les options dans le formulaire
$ecoles = $conn->query("SELECT codeEcode, nom_ecole FROM ecole");
$options = $conn->query("SELECT idoption, nomOption FROM option");
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
        <label>Nom: <input type="text" name="nom" required></label><br><br>
        <label>Prénom: <input type="text" name="prenom" required></label><br><br>
        <label>Sexe:
            <select name="sexe" required>
                <option value="M">Masculin</option>
                <option value="F">Féminin</option>
            </select>
        </label><br><br>
        <label>École:
            <select name="ecole" required>
                <option value="">--Choisir une école--</option>
                <?php while($row = $ecoles->fetch_assoc()): ?>
                    <option value="<?= $row['codeEcode'] ?>"><?= htmlspecialchars($row['nom_ecole']) ?></option>
                <?php endwhile; ?>
            </select>
        </label><br><br>
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
