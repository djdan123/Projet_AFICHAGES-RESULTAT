<?php
session_start();
require_once "config.php";

// Générer un token CSRF s'il n'existe pas
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = trim($conn->real_escape_string($_POST['nom']));
    $annee = trim($conn->real_escape_string($_POST['annee']));
    
    try {
        $sql = "SELECT e.nomComplet, e.codeEleve, e.sexe, r.resultatFinal, 
                o.nomOption, ec.nomEcole, p.nomProvince, ed.annee
                FROM eleve e
                JOIN resultat r ON e.resultat_idResultat = r.idResultat
                JOIN option o ON e.option_idOption = o.idOption
                JOIN ecole ec ON e.ecole_idEcole = ec.idEcole
                JOIN province p ON ec.province_idProvince = p.idProvince
                JOIN edition ed ON r.edition_idEdition = ed.idEdition
                WHERE e.nomComplet LIKE ? AND ed.annee = ?";
                
        $stmt = $conn->prepare($sql);
        $searchNom = "%$nom%";
        $stmt->bind_param("ss", $searchNom, $annee);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $etudiant = $result->fetch_assoc();
            $_SESSION['etudiant_data'] = $etudiant;
            header("Location: afficher_Resultat.php");
            exit();
        } else {
            $error_message = "Aucun résultat trouvé pour ces critères.";
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        $error_message = "Une erreur est survenue. Veuillez réessayer plus tard.";
    }
}

/*
$results = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $search = $conn->real_escape_string($_POST['search']);
  $annee = (int)$_POST['annee'];
  
  $sql = "SELECT e.*, r.resultatFinal 
          FROM eleve e
          JOIN resultat r ON e.resultat_idResultat = r.idResultat
          WHERE (e.nomComplet LIKE '%$search%' OR e.codeEleve = '$search')
          AND r.annee = $annee";
  
  $results = $conn->query($sql);
}
  */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Résultats Examen d'État</title>
  <link rel="stylesheet" href="CONSULTER_RESULTAT.CSS">
 
  <style>
    body {
   height: 100vh;
   margin: 0;
   background-color: black;
   font-family: 'Times New Roman', Times, serif;
 }

 header {
   height: 13%;
   width: 100%;
   background-color: #e30613;
 }

 .logo {
   padding-left: 200px;
   display: flex;
   align-items: center;
   gap: 10px;
   height: 100%;
   width: 500px;
   overflow: hidden;
 }

 h1 {
   font-size: 15px;
   font-family: 'Times New Roman', Times, serif;
   font-weight: bold;
 }

 #logo img {
   height: 80px;
   width: 100px;
   object-fit: contain;
 }

 #corps {
   width: 100%;
   background-color: white;
 }

 .corps1 {
   height: 100%;
   width: 100%;
 }

 .torace1 {
  background-color: #174186;
   width: 100%;
   height: 100%;
   overflow: hidden;
 }

 .torace1 img {
   width: 100%;
   height: 100%;
   object-fit: cover;
 }

 .corps2 {
   width: 100%;

 }

 .corps3 {
   width: 100%;
 }

 .recherche {
   width: 100%;
   height: 40px;
   background-color: #174186;
   text-align: center;
   padding-top: 20px;
   margin-top: 0px;

 }
 .barRech{
   color: white;
   background-color: #174186;
   height: 70px;
   margin-top: -10px;
 }
 .cherche{
   display:flex;
   flex-wrap:inherit;
   align-items: center;
   justify-content: space-between;
   margin-top: 15px;
 }
 p{
   margin: top 10px;
   margin: auto;
   font-weight: bolder;
   font-size:18px;

 }

 .formulaire {
width: 100%;
background-color: #f5f9ff; /* couleur de fond du bloc formulaire (ex: bleu très clair) */
padding: 40px 0;
display: flex;
justify-content: center;
align-items: center;
}

form {
background-color: transparent; /* même couleur que le conteneur */
display: flex;
flex-direction: column;
gap: 20px;
width: 100%;
max-width: 400px; /* pour éviter que ça dépasse */
padding: 20px;
box-sizing: border-box;
}

form input[type="text"],
form input[type="number"] {
padding: 12px;
font-size: 16px;
border-radius: 6px;
border: 1px solid #ccc;
width: 100%;
box-sizing: border-box;
}

form input[type="submit"] {
background-color: #198754;
color: white;
border: none;
border-radius: 6px;
padding: 12px;
font-size: 16px;
cursor: pointer;
transition: background-color 0.3s;
}

form input[type="submit"]:hover {
background-color: #146c43;
}
line{
   -webkit-box-flex:0 ;
   flex: 0027.3333%;
   width: 27.33333%;
   background-color: #009fe3;

}
.line2{
   -webkit-box-flex:0 ;
   flex: 0027.3333%;
   width: 27.33333%;
   background-color: #ffed00;
   
}
.line3{
   -webkit-box-flex:0 ;
   flex: 0027.3333%;
   width: 27.33333%;
   background-color: #e30613;
   
}
footer {
 background-color: #198754;
 color: white;
 padding: 30px 20px;
 padding-top: 0px;
 text-align: center;
 font-size: 10px;
}

.footer-content {
 max-width: 1200px;
 margin: auto;
}

.footer-lines {
 display: flex;
 justify-content: center;
 margin-bottom: 20px;
}

.footer-lines .line,
.footer-lines .line2,
.footer-lines .line3 {
 height: 10px;
 flex: 1;
 margin: 0 5px;
 gap: 0px;
}

.footer-lines .line {
 background-color: #009fe3;
}
.footer-lines .line2 {
 background-color: #ffed00;
}
.footer-lines .line3 {
 background-color: #e30613;
}

.footer-text {
 font-size: 14px;
 margin-top: 10px;
}
#logo{
  margin-bottom: 40px;
  padding-left: 0px;
  display: flex;
  align-items: center;
  gap: 4px;
  height: 100%;
  width: 30%;
  overflow: hidden;
  text-align: start;
  
}
.conteneurpied{
  background-color: #198754;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  gap: 10px;

}
#logo h2 {
  font-size: 15px;
  font-family: 'Times New Roman', Times, serif;
  font-weight: bold;
  font-style: normal;
  color: rgb(255, 255, 255);
}
.piedm{
margin-bottom: 65px;
height: 100%;
width: 20%;
font-weight: bold;
text-align: start;

}
.piedlie{
  margin-bottom: 65px;
  height: 100%;
  width: 20%;
  text-align: start;

}
.piedC{
  margin-bottom: 10px;
  height: 100%;
  width: 20%;
  text-align: start;

}
.piedlie a{
  text-decoration: none;
  text-decoration-color: #ccc;
  color: #ccc;
  font-weight: bold;
  font-size: 20px;
  
}
.piedm a{
  text-decoration: none;
  font-size: 20px;
  text-decoration-color: #ccc;
  color: #ccc;
}
froms_select{
  display: block;
  width: 100%;
  padding: .375rem 2.25rem .375rem .75rem;
  -moz-padding-start: calc(.75rem - 3px);
  font-size: .9rem;
  font-weight: 400;
  line-height: 1.6;
  color: #212529;
  background-color: #f8fafc;
  background-repeat: no-repeat;
  background-position: right .75rem center;
  background-size: 16px 12px;
  border: 1px solid #ced4da;
  border-radius: .375rem;
  transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
  appearance: none; 
}

.error-message {
    background-color: #ffe6e6;
    color: #dc3545;
    padding: 10px;
    border-radius: 5px;
    margin: 10px 0;
    text-align: center;
}

.loading {
    display: none;
    text-align: center;
    margin: 10px 0;
}

.loading::after {
    content: "⌛";
    animation: loading 1s infinite;
}

@keyframes loading {
    0% { content: "⌛"; }
    50% { content: "⏳"; }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .logo {
        padding-left: 20px;
    }
    
    form {
        padding: 10px;
    }
    
    .conteneurpied {
        flex-direction: column;
        text-align: center;
    }
    
    #logo, .piedm, .piedlie, .piedC {
        width: 100%;
        margin-bottom: 20px;
    }
}
  </style>
</head>

<body>

  <header>
    <div id="tete">
      <div class="logo" >
        <img src="images/Screenshot from 2025-05-11 13-51-37.png" alt="logo du ministere">
        <h1>MINISTÈRE DE L'ÉDUCATION <br> NATIONALE ET NOUVELLE <br> CITOYENNETÉ (EDU-NC)</h1>
      </div>
    </div>
  </header>

  <main id="corps">
    <div class="corps1">

      <div class="corps2">
        <div class="torace1">
          <img src="images/exetat.jpg" alt="images Étudiants">
        </div>
      </div>

      <div class="corps3">
        <div class="recherche">
          <nav class="barRech">
            <div class="cherche">
              <p>Recherchez votre résultat</p>
            </div>
        </nav>
        </div>

        <div class="formulaire">
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <input type="text" name="nom" placeholder="Saisissez votre nom complet" required>
                <input type="number" name="annee" placeholder="Écrivez votre année de diplôme (ex: 2025)" required>
                <input type="submit" value="Rechercher">
                <div class="loading" id="loadingIndicator">Recherche en cours...</div>
            </form>
        </div>
      </div>

    </div>
  </main>

  <footer>
    <div class="footer-content">
      <div class="footer-lines">
        <div class="line"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>
      <div class="conteneurpied">

          <div id="logo" class="logo">
            <img src="images/Screenshot from 2025-05-11 13-51-37.png" alt="logo du ministere">
            <h2>MINISTÈRE DE L'ÉDUCATION <br> NATIONALE ET NOUVELLE <br> CITOYENNETÉ (EDU-NC)</h2>
          </div>
        
        <div class="piedm"><h2>MENU</h2><a href="#">Acceuil</a></div>
        <div class="piedlie"><h2>Liens Vers</h2> 
          <a href="#">site web</a>
        </div>
        <div class="piedC"><h2> Contact </h2>
        <p>Q.kigobe des ambasadeurs/Bujumbura</p>
        <p> contact@minepst.gouv.Bi</p>
        <p>+256 66575334</p>
        </div>
        

      </div>
      <hr>
      <p class="footer-text">
        &copy; 2025 copyright : Ministère de l'Éducation Nationale et Nouvelle Citoyenneté - Tous droits réservés
      </p>
    </div>
  </footer>
  
  <script>
    function showLoading() {
        document.getElementById('loadingIndicator').style.display = 'block';
        return true;
    }
  </script>
</body>
</html>
