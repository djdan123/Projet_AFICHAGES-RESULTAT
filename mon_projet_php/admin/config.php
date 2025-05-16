<?php
session_start();
 if (isset($_SESSION['admin_logged'])) {
     exit;
     header("Location: login.php");

} 

$host = "localhost";
$user = "adminphp";
$pass = "admin123";
$db = "base_resultat_examen";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}
?>
