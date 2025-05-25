<?php
// Initialisation sécurisée
require_once __DIR__."/config.php";
require_once __DIR__."/security.php";

// Vérification supplémentaire des permissions (optionnel)
/*if (!isset($_SESSION['admin_id'])) {
    header("HTTP/1.1 403 Forbidden");
    die("Accès refusé : permissions insuffisantes");
}
*/
    
    

try {
    // Requête préparée pour éviter les injections SQL
    $sql = "SELECT 
                e.idEleve,
                e.nomComplet,
                e.codeEleve,
                c.nom_ecole,
                e.sexe,
                e.cycle,
                e.province,
                e.ecole,
                oe.nomOption, 
                r.pourcentage
            FROM eleve e
            LEFT JOIN ecole c ON e.ecole = c.nom_ecole
            LEFT JOIN options_exam oe ON e.option_idoption = oe.idoption
            LEFT JOIN resultat r ON e.resultat_idResultat = r.idResultat
            ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        throw new Exception("Erreur lors de la récupération des données élèves");
    }

} catch (Exception $e) {
    error_log("ERREUR eleves.php: ".$e->getMessage());
    die("<div class='error'>Un problème est survenu. Veuillez réessayer plus tard.</div>".$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des élèves | Administration</title>
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
            max-width: 1200px;
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
        
        .btn {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 20px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: var(--primary);
            color: white;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .action-link {
            padding: 5px 10px;
            border-radius: 3px;
            margin: 0 5px;
            font-size: 0.9em;
        }
        
        .edit {
            background: var(--primary);
            color: white;
        }
        
        .delete {
            background: var(--danger);
            color: white;
        }
        
        .error {
            color: var(--danger);
            padding: 15px;
            background: #fdd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-users"></i> Gestion des élèves</h1>
        
        <a href="ajouter_eleve.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Ajouter un élève
        </a>
        
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom d'Eleve</th>
                        <th>Sexe</th>
                        <th>Ecole</th>
                        <th>Option</th>
                        <th>Resultat(%)</th>
                        <th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['codeEleve']) ?></td>
                            <td><?= htmlspecialchars($row['nomComplet']) ?></td>
                            <td><?= htmlspecialchars($row['sexe']) ?></td>
                            <td><?= htmlspecialchars($row['nom_ecole']) ?></td>
                            <td><?= htmlspecialchars($row['nomOption']) ?></td>
                            <td><?= htmlspecialchars($row['pourcentage']) ?></td>
                            <td>
                                <a href="modifier_eleve.php?id=<?= $row['idEleve'] ?>" class="action-link edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </a>
                             </td>
                             <td>
                                <a href="supprimer_eleve.php?id=<?= $row['idEleve'] ?>" 
                                   class="action-link delete"
                                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet élève ?');">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="text-align: center;">
                                Aucun élève trouvé dans la base de données
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div style="margin-top: 20px;">
            <a href="index.php" class="btn">
                <i class="fas fa-arrow-left"></i> Retour au tableau de bord
            </a>
        </div>
    </div>

    <script>
        // Confirmation avant suppression
        document.querySelectorAll('.delete').forEach(link => {
            link.addEventListener('click', (e) => {
                if (!confirm('Cette action est irréversible. Confirmer la suppression ?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
<?php /*
//session_start();
require_once "config.php";
require_once "security.php";



$sql = "SELECT e.num_inscript, e.nomEleve, e.prenomEleve, e.sexe, 
               ec.nom_ecole, oe.nomOption, r.pourcentage
        FROM eleve e
        LEFT JOIN ecole ec ON e.ecole_codeEcode = ec.codeEcode
        LEFT JOIN options_exam oe ON e.option_idoption = oe.idoption
        LEFT JOIN resultat r ON e.resultat_idResultat = r.idResultat
        ORDER BY e.num_inscript DESC";

$result = $conn->query($sql);
*/ 
?>