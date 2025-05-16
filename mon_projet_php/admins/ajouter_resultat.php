<?php include('header.php'); ?>
<div class="container">
  <h2>Ajouter un Résultat</h2>
  <form method="POST" action="traitement_resultat.php">
    <input type="text" name="nom_ecole" placeholder="Nom de l'\u00e9cole" required>
    <input type="text" name="option" placeholder="Option" required>
    <input type="number" name="pourcentage" placeholder="Pourcentage obtenu" required>
    <select name="cycle" required>
      <option value="">--S\u00e9lectionnez le cycle--</option>
      <option value="court">Court</option>
      <option value="long">Long</option>
    </select>
    <input type="submit" value="Enregistrer">
  </form>
</div>
<?php include('footer.php'); ?>