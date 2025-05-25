<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__.'/config.php';
require_once __DIR__.'/security.php';
session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tableau de bord</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!--<link rel="stylesheet" href="styles.css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>

        :root {
    --primary-color: #3498db;
    --secondary-color: #2c3e50;
    --accent-color: #e74c3c;
    --light-color: #ecf0f1;
    --dark-color: #34495e;
    --success-color: #2ecc71;
    --warning-color: #f39c12;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f7fa;
    color: #333;
}

.admin-container {
    display: grid;
    grid-template-columns: 250px 1fr;
    grid-template-rows: 70px 1fr;
    min-height: 100vh;
}

.admin-header {
    grid-column: 1 / -1;
    background: var(--secondary-color);
    color: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
    height: 100%;
}

.admin-header h1 {
    margin: 0;
    font-size: 1.3rem;
    font-weight: 500;
}

.admin-header h1 i {
    margin-right: 10px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-info i {
    margin-right: 5px;
}

.logout-btn {
    color: white;
    text-decoration: none;
    transition: all 0.3s;
}

.logout-btn:hover {
    color: var(--accent-color);
}

.admin-sidebar {
    background: white;
    box-shadow: 2px 0 10px rgba(0,0,0,0.05);
    padding: 2rem 0;
}

.admin-sidebar nav ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.admin-sidebar nav li {
    margin-bottom: 5px;
}

.admin-sidebar nav a {
    display: block;
    padding: 12px 25px;
    color: var(--dark-color);
    text-decoration: none;
    transition: all 0.3s;
    font-size: 0.95rem;
}

.admin-sidebar nav a:hover,
.admin-sidebar nav a.active {
    background: var(--light-color);
    color: var(--primary-color);
    border-left: 4px solid var(--primary-color);
}

.admin-sidebar nav a i {
    width: 20px;
    margin-right: 10px;
    text-align: center;
}

.admin-main {
    padding: 2rem;
    background: #f5f7fa;
}

.dashboard-cards {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
}

.card {
    background: white;
    border-radius: 8px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.card-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
    color: white;
    font-size: 1.2rem;
}

.blue { background: var(--primary-color); }
.green { background: var(--success-color); }
.orange { background: var(--warning-color); }

.card h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.2rem;
}

.card p {
    margin: 0 0 1.5rem 0;
    color: #666;
    font-size: 0.9rem;
}

.card-link {
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
}

.card-link i {
    margin-left: 5px;
    transition: transform 0.3s;
}

.card-link:hover i {
    transform: translateX(3px);
}

@media (max-width: 768px) {
    .admin-container {
        grid-template-columns: 1fr;
    }
    
    .admin-sidebar {
        display: none;
    }
}
    </style>
    
</head>
<body>
    <div class="admin-container">
        <header class="admin-header">
            <div class="header-content">
                <h1><i class="fas fa-tachometer-alt"></i> Tableau de bord Administratif</h1>
                <div class="user-info">
                    <span><i class="fas fa-user-circle"></i> <?= $_SESSION['username'] ?? 'Admin' ?></span>
                    <a href="logout.php" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </div>
            </div>
        </header>

        <aside class="admin-sidebar">
            <nav>
                <ul>
                    <li><a href="eleves.php"><i class="fas fa-users"></i> Gestion des élèves</a></li>
                    <li><a href="ecoles.php"><i class="fas fa-school"></i> Gestion des écoles</a></li>
                    <li><a href="options.php"><i class="fas fa-list-alt"></i> Gestion des options</a></li>
                    <li><a href="resultats.php"><i class="fas fa-chart-bar"></i> Gestion des résultats</a></li>
                    <li><a href="editions.php"><i class="fas fa-book"></i> Gestion des éditions</a></li>
                </ul>
            </nav>
        </aside>

        <main class="admin-main">
            <div class="dashboard-cards">
                <div class="card">
                    <div class="card-icon blue">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Élèves</h3>
                    <p>Gérer les inscriptions</p>
                    <a href="eleves.php" class="card-link">Accéder <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="card">
                    <div class="card-icon green">
                        <i class="fas fa-school"></i>
                    </div>
                    <h3>Écoles</h3>
                    <p>Gérer les établissements</p>
                    <a href="ecoles.php" class="card-link">Accéder <i class="fas fa-arrow-right"></i></a>
                </div>

                <div class="card">
                    <div class="card-icon orange">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3>Résultats</h3>
                    <p>Consulter les statistiques</p>
                    <a href="resultats.php" class="card-link">Accéder <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
