<?php
$pdo = new PDO('mysql:host=localhost;dbname=examens', 'root', '');
$stmt = $pdo->prepare("INSERT INTO resultats (nom_ecole, option, cycle, pourcentage) VALUES (?, ?, ?, ?)");
$stmt->execute([
  $_POST['nom_ecole'],
  $_POST['option'],
  $_POST['cycle'],
  $_POST['pourcentage']
]);
header('Location: liste_resultats.php');
exit();
?>
