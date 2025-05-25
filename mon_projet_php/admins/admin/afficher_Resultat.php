<?php
session_start();

// Redirect if no data is available
if (!isset($_SESSION['etudiant_data'])) {
    $_SESSION['error_message'] = "Veuillez d'abord effectuer une recherche.";
    header("Location: CONSULTER _RESULTAT.php");
    exit();
}

$etudiant = $_SESSION['etudiant_data'];
// Clear the session data after retrieving it
unset($_SESSION['etudiant_data']);

// Determine if the student passed or failed
$hasSucceeded = floatval($etudiant['resultatFinal']) >= 50;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des Résultats</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
            padding: 20px;
        }

        .container_R {
            width: 90%;
            max-width: 1000px;
            background-color: #000;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .Resultat_e {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .Resulta_eleve {
            background-color: <?php echo $hasSucceeded ? '#ffd700' : '#ff9999'; ?>;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .Resulta_eleve:hover {
            transform: scale(1.02);
        }

        .Resulta_eleve h1 {
            font-size: 20px;
            text-align: center;
            color: #000;
        }

        .eleve {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .eleve ul {
            list-style-type: none;
            font-size: 16px;
            line-height: 1.8;
            color: #333;
        }

        .eleve li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .eleve li:last-child {
            border-bottom: none;
        }

        .eleve strong {
            color: #174186;
            min-width: 200px;
        }

        .eleve span {
            color: #333;
            font-weight: 500;
        }

        .btn-retour {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: #174186;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-retour:hover {
            background-color: #0d2b5e;
        }

        @media (max-width: 768px) {
            .container_R {
                width: 95%;
                padding: 10px;
            }

            .Resultat_e {
                padding: 15px;
            }

            .eleve li {
                flex-direction: column;
                align-items: flex-start;
            }

            .eleve strong {
                min-width: auto;
                margin-bottom: 5px;
            }

            .Resulta_eleve h1 {
                font-size: 18px;
            }
        }

        @media print {
            .btn-retour {
                display: none;
            }

            .container_R {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <main class="container_R">
        <div class="Resultat_e">
            <div class="Resulta_eleve">
                <h1>
                    <?php if ($hasSucceeded): ?>
                        🎉 Toutes nos félicitations ! Vous avez réussi l'examen d'État 🎓
                    <?php else: ?>
                        Résultats de l'examen d'État
                    <?php endif; ?>
                </h1>
            </div>
            <div class="eleve">
                <ul>
                    <li><strong>Nom :</strong> <span><?php echo htmlspecialchars($etudiant['nomComplet']); ?></span></li>
                    <li><strong>Code Élève :</strong> <span><?php echo htmlspecialchars($etudiant['codeEleve']); ?></span></li>
                    <li><strong>Sexe :</strong> <span><?php echo htmlspecialchars($etudiant['sexe']); ?></span></li>
                    <li><strong>Pourcentage :</strong> <span><?php echo htmlspecialchars($etudiant['resultatFinal']); ?>%</span></li>
                    <li><strong>Option :</strong> <span><?php echo htmlspecialchars($etudiant['nomOption']); ?></span></li>
                    <li><strong>École :</strong> <span><?php echo htmlspecialchars($etudiant['nomEcole']); ?></span></li>
                    <li><strong>Province Éducationnelle :</strong> <span><?php echo htmlspecialchars($etudiant['nomProvince']); ?></span></li>
                    <li><strong>Édition :</strong> <span><?php echo htmlspecialchars($etudiant['annee']); ?></span></li>
                </ul>
                <a href="CONSULTER _RESULTAT.php" class="btn-retour">Retour à la recherche</a>
            </div>
        </div>
    </main>
</body>
</html>