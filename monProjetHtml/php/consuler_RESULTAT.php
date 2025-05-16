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

 #logo {
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
background-color: #f5f9ff; 
padding: 40px 0;
display: flex;
justify-content: center;
align-items: center;
}

form {
background-color: transparent; 
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
 text-align: center;
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

 </style>
</head>
<body>
  <header>
    <div id="tete">
      <div id="logo">
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

        <div class="formulaire" >
          <form action="index.php" method="POST">
            <input type="text" id="nom" placeholder="Saisissez votre nom complet ou code élève" name="nomm">
            <input type="number" id="ANNE" placeholder="Saisissez l'année du diplôme" name="numbere">
            <input type="submit" value="Rechercher" name="recherche">
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
      <p class="footer-text">
        &copy; 2025 Ministère de l'Éducation Nationale et Nouvelle Citoyenneté - Tous droits réservés
      </p>
    </div>
  </footer>
  
</body>
</html>
