<?php
require_once __DIR__."/config.php";
require_once __DIR__."/security.php";
checkAdminAuth();

// Récupérer l'ID de l'élève à modifier
$idEleve = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($idEleve <= 0) {
    header("Location: eleves.php");
    exit;
}

// Initialisation des variables
$error = "";
$success = "";
$eleve = null;

// Récupérer les données de l'élève
$stmt = $conn->prepare("SELECT * FROM eleve WHERE idEleve = ?");
$stmt->bind_param("i", $idEleve);
$stmt->execute();
$result = $stmt->get_result();
$eleve = $result->fetch_assoc();
$stmt->close();

if (!$eleve) {
    header("Location: eleves.php");
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération et nettoyage des données
    $nomComplet = $conn->real_escape_string($_POST["nomComplet"]);
    $codeEleve = $conn->real_escape_string($_POST["codeEleve"]);
    $sexe = $conn->real_escape_string($_POST["sexe"]);
    $ecole = $conn->real_escape_string($_POST["ecole"]);
    $cycle = $conn->real_escape_string($_POST["cycle"]);
    $province = $conn->real_escape_string($_POST["province"]);
    $option = (int)$_POST["option"];
    $resultat = (int)$_POST["resultat"];

    // Mise à jour des données
    $stmt = $conn->prepare("UPDATE eleve SET 
                          nomComplet = ?, 
                          codeEleve = ?, 
                          sexe = ?, 
                          ecole = ?, 
                          cycle = ?, 
                          province = ?, 
                          option_idoption = ?, 
                          resultat_idResultat = ? 
                          WHERE idEleve = ?");
    
    $stmt->bind_param("ssssssiii", 
                     $nomComplet, 
                     $codeEleve, 
                     $sexe, 
                     $ecole, 
                     $cycle, 
                     $province, 
                     $option, 
                     $resultat, 
                     $idEleve);

    if ($stmt->execute()) {
        $success = "Les informations de l'élève ont été mises à jour avec succès.";
        // Rafraîchir les données de l'élève
        $stmt = $conn->prepare("SELECT * FROM eleve WHERE idEleve = ?");
        $stmt->bind_param("i", $idEleve);
        $stmt->execute();
        $result = $stmt->get_result();
        $eleve = $result->fetch_assoc();
        $stmt->close();
    } else {
        $error = "Erreur lors de la mise à jour : " . $conn->error;
    }
    
}

// Récupérer les options et résultats pour les listes déroulantes
$options = $conn->query("SELECT idoption, nomOption FROM options_exam");
$resultats = $conn->query("SELECT idResultat, pourcentage FROM resultat");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un élève</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #3498db;
            --danger: #e74c3c;
            --success: #2ecc71;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2c3e50;
            border-bottom: 2px solid var(--primary);
            padding-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            border: none;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-danger {
            background: var(--danger);
            color: white;
        }
        
        .alert {
            padding: 10px 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        .retour-valider{

            width:50px;
            height: 30px;
            background-color:rgb(235, 213, 22);
            border: 1px solid #e74c3c;

        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-user-edit"></i> Modifier un élève</h1>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="nomComplet">Nom complet</label>
                <input type="text" id="nomComplet" name="nomComplet" value="<?= htmlspecialchars($eleve['nomComplet'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="codeEleve">Code élève</label>
                <input type="text" id="codeEleve" name="codeEleve" value="<?= htmlspecialchars($eleve['codeEleve'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="sexe">Sexe</label>
                <select id="sexe" name="sexe" required>
                    <option value="M" <?= ($eleve['sexe'] ?? '') == 'M' ? 'selected' : '' ?>>Masculin</option>
                    <option value="F" <?= ($eleve['sexe'] ?? '') == 'F' ? 'selected' : '' ?>>Féminin</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="ecole">École</label>
                <input type="text" id="ecole" name="ecole" value="<?= htmlspecialchars($eleve['ecole'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="cycle">Cycle</label>
                <input type="text" id="cycle" name="cycle" value="<?= htmlspecialchars($eleve['cycle'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="province">Province</label>
                <input type="text" id="province" name="province" value="<?= htmlspecialchars($eleve['province'] ?? '') ?>" required>
            </div>
            
            <div class="form-group">
                <label for="option">Option</label>
                <select id="option" name="option" required>
                    <option value="">-- Sélectionner une option --</option>
                    <?php while($row = $options->fetch_assoc()): ?>
                        <option value="<?= $row['idoption'] ?>" <?= ($eleve['option_idoption'] ?? 0) == $row['idoption'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['nomOption']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="resultat">Résultat (%)</label>
                <select id="resultat" name="resultat" required>
                    <option value="">-- Sélectionner un résultat --</option>
                    <?php while($row = $resultats->fetch_assoc()): ?>
                        <option value="<?= $row['idResultat'] ?>" <?= ($eleve['resultat_idResultat'] ?? 0) == $row['idResultat'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($row['pourcentage']) ?>%
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            
            <div class="action-buttons">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Enregistrer les modifications
                </button>
                <a href="eleves.php" class="btn btn-danger">
                    <i class="fas fa-times"></i> Annuler
                </a>
            </div>

         <div style="margin-top: 20px;" class="retour-button">
            <a href="eleves.php" class="btn">
                <i class="fas fa-arrow-left"></i> Valider et retour
            </a>
         </div>
        </form>
        
    </div>
</body>
</html>