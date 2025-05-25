<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'name' => 'AdminSecureSession',
        'cookie_lifetime' => 86400,
        'cookie_secure' => isset($_SERVER['HTTPS']),
        'cookie_httponly' => true,
        'use_strict_mode' => true
    ]);
}

// Vérification triple sécurité
$session_valid = isset(
    $_SESSION['admin_logged'],
    $_SESSION['IP'],
    $_SESSION['user_agent']
);
// security.php
function checkAdminAuth() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    /*
    if (!isset($_SESSION['admin_logged']) {
        header("Location: login.php");
        exit;
    }
        */
}

if (!$session_valid || 
    $_SESSION['IP'] !== $_SERVER['REMOTE_ADDR'] || 
    $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
    
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
/*

session_start();

if (!isset($_SESSION['admin_logged'])) {
    header("Location: login.php");
    exit;
}


// Démarre la session si elle n'existe pas
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'name' => 'AdminSecureSession',
        'cookie_lifetime' => 86400, // 24h
        'cookie_secure' => isset($_SERVER['HTTPS']), // SSL seulement
        'cookie_httponly' => true, // Anti-vol de cookie
        'use_strict_mode' => true // Protection avancée
    ]);
    
    // Enregistre l'IP pour prévenir les vols de session
    if (empty($_SESSION['IP'])) {
        $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
    }
}

// Vérifie l'authentification ET que l'IP n'a pas changé (anti-hijacking)
if (empty($_SESSION['admin_logged']) || $_SESSION['IP'] !== $_SERVER['REMOTE_ADDR']) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
    */
?>