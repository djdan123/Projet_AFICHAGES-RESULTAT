<?php include('header.php'); ?>
<div class="container">
  <h2>Liste des R\u00e9sultats</h2>
  <?php
  // Connexion DB
  $pdo = new PDO('mysql:host=localhost;dbname=examens', 'root', '');
  $stmt = $pdo->query("SELECT * FROM resultats ORDER BY id DESC");
  echo "<table><tr><th>\u00c9cole</th><th>Option</th><th>Cycle</th><th>Pourcentage</th></tr>";
  while ($row = $stmt->fetch()) {
    echo "<tr><td>{$row['nom_ecole']}</td><td>{$row['option']}</td><td>{$row['cycle']}</td><td>{$row['pourcentage']}%</td></tr>";
  }
  echo "</table>";
  ?>
</div>
<?php include('footer.php'); ?>
