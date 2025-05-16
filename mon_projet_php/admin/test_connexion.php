<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$user = "adminphp";
$password = "admin123"; 
$dbname = "base_resultat_examen";

try {
    $conn = new mysqli($host, $user, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Échec de la connexion : " . $conn->connect_error);
    }
    
    echo "<h2 style='color:green'>Connexion réussie !</h2>";
    echo "<p>Informations sur le serveur MySQL :</p>";
    echo "<ul>";
    echo "<li>Version MySQL : " . $conn->server_info . "</li>";
    echo "<li>Nom d'hôte : " . $conn->host_info . "</li>";
    echo "<li>Base de données sélectionnée : ". $dbname . "</li>";
    echo "</ul>";
    
    // Test supplémentaire : lister les tables
    $result = $conn->query("SHOW TABLES");
    echo "<h3>Tables disponibles :</h3>";
    echo "<ul>";
    while ($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
    
    $conn->close();

   
} catch (Exception $e) {
    echo "<h2 style='color:red'>Erreur de connexion</h2>";
    echo "<p>nn" . $e->getMessage() . "</p>";
    echo "<h3>Vérifiez :</h3>";
    echo "<ul>";
    echo "<li>Le serveur MySQL est-il démarré ?</li>";
    echo "<li>Le nom d'utilisateur et mot de passe sont-ils corrects ?</li>";
    echo "<li>La base de données '".$dbname."' existe-t-elle ?</li>";
    echo "</ul>";
}
?>