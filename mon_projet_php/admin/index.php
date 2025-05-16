<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "security.php"; 
require_once "config.php";   
session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Admin - Tableau de bord</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <h1>Administration - Tableau de bord</h1>
    <nav>
        <ul>
            <li><a href="eleves.php">Gestion des élèves</a></li>
            <li><a href="ecoles.php">Gestion des écoles</a></li>
            <li><a href="options.php">Gestion des options</a></li>
            <li><a href="resultats.php">Gestion des résultats</a></li>
            <li><a href="editions.php">Gestion des éditions</a></li>
            <li><a href="logout.php">Déconnexion</a></li>
        </ul>
    </nav>
</body>
</html>
