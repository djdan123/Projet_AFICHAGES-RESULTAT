<?php

if (isset($_POST['recherche'])) {
    $nom =$_POST['nomm'];
    $annee = $_POST['numbere'];
    $titre = "Résultats de l'utilisateur";
} else {
    
    $nom = "Non défini";
    $annee = "Non défini";
    $titre = "Aucune donnée reçue";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Récupération de variables</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background-color: #f4f4f4;
    }
    table {
      border-collapse: collapse;
      width: 60%;
      margin: auto;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ccc;
      padding: 12px 20px;
      text-align: left;
    }
    tr:nth-child(1) {
      background-color: #007BFF;
      color: white;
      font-weight: bold;
    }
    tr:nth-child(2) {
      background-color: #f9f9f9;
    }
    td {
      font-size: 16px;
    }
    .recherche {
      width: 100%;
      height: 40px;
      background-color: #174186;
      text-align: center;
      padding-top: 20px;
      margin-top: 0px;
    }
    .barRech {
      color: white;
      background-color: #174186;
      height: 70px;
      margin-top: -10px;
    }
    .cherche {
      display: flex;
      align-items: center;
      justify-content: center;
      margin-top: 15px;
    }
    p {
      font-weight: bolder;
      font-size: 18px;
      color: white;
    }
  </style>
</head>
<body>

  <div class="recherche">
    <nav class="barRech">
      <div class="cherche">
        <p>VOICI VOS RESULTATS</p>
      </div>
    </nav>
  </div> 

  <table>
    <tr>
      <td colspan="2"><?php echo $titre; ?></td>
    </tr>
    <tr>
      <td><strong>Nom de l'Eleve</strong></td>
      <td><strong>Edition</strong></td>
    </tr>
    <tr>
      <td><?php echo $nom; ?></td>
      <td><?php echo $annee; ?></td>
    </tr>
  </table>

</body>
</html>
