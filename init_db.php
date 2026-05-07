<?php
// Script d'initialisation de la base de données SQLite

$dbPath = '/home/oxno/4277/S4/TP_GROUPE/regime/writable/database.db';

// Créer la connexion SQLite
$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Créer la table utilisateurs
$pdo->exec('CREATE TABLE IF NOT EXISTS utilisateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    genre ENUM(\'homme\',\'femme\',\'autre\') NOT NULL,
    date_naissance DATE,
    taille_cm DECIMAL(5,2),
    poids_kg DECIMAL(5,2),
    imc DECIMAL(5,2),
    objectif VARCHAR(50) DEFAULT NULL,
    solde DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    est_gold TINYINT(1) NOT NULL DEFAULT 0,
    date_gold DATETIME DEFAULT NULL,
    est_actif TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)');

echo "✓ Table utilisateurs créée avec succès\n";

// Créer les autres tables
$pdo->exec('CREATE TABLE IF NOT EXISTS regimes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    pct_viande DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    pct_poisson DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    pct_volaille DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    variation_poids_kg DECIMAL(5,2) NOT NULL,
    objectif_cible VARCHAR(50) NOT NULL,
    est_actif TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)');

echo "✓ Table regimes créée avec succès\n";

$pdo->exec('CREATE TABLE IF NOT EXISTS regime_prix (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    regime_id INT NOT NULL,
    duree_jours INT NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (regime_id) REFERENCES regimes(id) ON DELETE CASCADE,
    UNIQUE(regime_id, duree_jours)
)');

echo "✓ Table regime_prix créée avec succès\n";

$pdo->exec('CREATE TABLE IF NOT EXISTS activites_sportives (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(150) NOT NULL,
    description TEXT,
    calories_par_heure DECIMAL(7,2),
    intensite VARCHAR(20) NOT NULL DEFAULT \'modérée\',
    est_actif TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)');

echo "✓ Table activites_sportives créée avec succès\n";

$pdo->exec('CREATE TABLE IF NOT EXISTS codes_portefeuille (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    code VARCHAR(50) NOT NULL UNIQUE,
    montant DECIMAL(10,2) NOT NULL,
    est_utilise TINYINT(1) NOT NULL DEFAULT 0,
    utilise_par INT DEFAULT NULL,
    utilise_le DATETIME DEFAULT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilise_par) REFERENCES utilisateurs(id) ON DELETE SET NULL
)');

echo "✓ Table codes_portefeuille créée avec succès\n";

$pdo->exec('CREATE TABLE IF NOT EXISTS abonnements_regime (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    utilisateur_id INT NOT NULL,
    regime_id INT NOT NULL,
    regime_prix_id INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    montant_paye DECIMAL(10,2) NOT NULL,
    remise_gold DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    statut VARCHAR(20) NOT NULL DEFAULT \'en_cours\',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (regime_id) REFERENCES regimes(id),
    FOREIGN KEY (regime_prix_id) REFERENCES regime_prix(id)
)');

echo "✓ Table abonnements_regime créée avec succès\n";

$pdo->exec('CREATE TABLE IF NOT EXISTS abonnements_activite (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    abonnement_id INT NOT NULL,
    activite_id INT NOT NULL,
    seances_par_semaine TINYINT NOT NULL DEFAULT 3,
    duree_seance_min INT NOT NULL DEFAULT 45,
    FOREIGN KEY (abonnement_id) REFERENCES abonnements_regime(id) ON DELETE CASCADE,
    FOREIGN KEY (activite_id) REFERENCES activites_sportives(id)
)');

echo "✓ Table abonnements_activite créée avec succès\n";

$pdo->exec('CREATE TABLE IF NOT EXISTS admins (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL DEFAULT \'admin\',
    est_actif TINYINT(1) NOT NULL DEFAULT 1,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
)');

echo "✓ Table admins créée avec succès\n";

echo "\n✅ Base de données SQLite initialisée avec succès!\n";
