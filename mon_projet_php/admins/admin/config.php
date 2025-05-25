<?php
// Configuration sécurisée de la base de données et gestion de session

// Niveau de rapport d'erreurs (à désactiver en production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // 1 en développement, 0 en production
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php-errors.log');

// Démarrer la session avec des paramètres sécurisés
/*session_start([
    'name' => 'SecureSession',
    'cookie_lifetime' => 86400, // 1 jour
    'cookie_secure' => isset($_SERVER['HTTPS']), // HTTPS seulement
    'cookie_httponly' => true,
    'cookie_samesite' => 'Strict',
    'use_strict_mode' => true
]);
*/

// Paramètres de connexion à la base de données
define('DB_HOST', 'localhost');
define('DB_USER', 'adminphp');
define('DB_PASS', 'admin123');
define('DB_NAME', 'base_resultat_examen');
define('DB_CHARSET', 'utf8mb4');

// Établir la connexion MySQLi
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    if ($conn->connect_error) {
        throw new Exception("Échec de la connexion MySQL: " . $conn->connect_error);
    }
    
    if (!$conn->set_charset(DB_CHARSET)) {
        throw new Exception("Erreur de charset MySQL: " . $conn->error);
    }
    
    // Configuration SQL stricte
    $conn->query("SET SQL_MODE='STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION'");
    
} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    die("Erreur système. Veuillez réessayer plus tard.");
}

// Protection contre la fixation de session
if (empty($_SESSION['__validated'])) {
    session_regenerate_id(true);
    $_SESSION['__validated'] = true;
    $_SESSION['__ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['__ua'] = $_SERVER['HTTP_USER_AGENT'];
}


// Vérification d'intégrité de session
if ($_SESSION['__ip'] !== $_SERVER['REMOTE_ADDR'] 
    || $_SESSION['__ua'] !== $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    die("Activité suspecte détectée.");
}

// Fonction de nettoyage de base pour l'affichage HTML
function cleanForOutput($data) {
    if (!isset($data) || $data === null) {
        return '';
    }
    return htmlspecialchars(trim((string)$data), ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
?>