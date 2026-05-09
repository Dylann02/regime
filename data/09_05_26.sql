

CREATE DATABASE IF NOT EXISTS projet_diet_s4 
    CHARACTER SET utf8mb4 
    COLLATE utf8mb4_unicode_ci;

USE projet_diet_s4;

-- ------------------------------------------------------------
-- 1. TABLE : parametres (Pour le "CRUD des paramètres") 
-- ------------------------------------------------------------
CREATE TABLE parametres (
    cle_param    VARCHAR(50) PRIMARY KEY,
    valeur       VARCHAR(255) NOT NULL,
    description  VARCHAR(255)
) ENGINE=InnoDB;

-- Données initiales pour les calculs globaux 
INSERT INTO parametres (cle_param, valeur, description) VALUES
('imc_ideal', '22', 'Valeur cible pour l objectif IMC Idéal'),
('prix_gold', '50000', 'Prix forfaitaire pour devenir membre Gold'),
('remise_gold', '15', 'Pourcentage de réduction pour les membres Gold (%)'); 

-- ------------------------------------------------------------
-- 2. TABLE : utilisateurs 
-- ------------------------------------------------------------
CREATE TABLE utilisateurs (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    -- Page 1 de l'inscription 
    nom             VARCHAR(100) NOT NULL,
    prenom          VARCHAR(100) NOT NULL,
    email           VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe    VARCHAR(255) NOT NULL,
    genre           ENUM('homme', 'femme', 'autre') NOT NULL,
    date_naissance  DATE,
    -- Page 2 de l'inscription (Santé) 
    taille_cm       DECIMAL(5,2) NULL,
    poids_actuel    DECIMAL(5,2) NULL, 
    -- Objectif choisi 
    objectif_actuel ENUM('augmenter', 'reduire', 'imc_ideal') DEFAULT NULL,
    valeur_objectif DECIMAL(5,2) NULL, -- Poids à perdre/gagner, ou Poids idéalcible
    -- Portefeuille et Statut Gold 
    solde           DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    est_gold        TINYINT(1) DEFAULT 0,
    created_at      DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ------------------------------------------------------------
-- 3. TABLE : regimes 
-- ------------------------------------------------------------
CREATE TABLE regimes (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nom             VARCHAR(100) NOT NULL,
    description     TEXT,
    -- Composition alimentaire 
    pct_viande      DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    pct_poisson     DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    pct_volaille    DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    -- Logique de variation de poids par semaine
    variation_kg_semaine DECIMAL(5,3) NOT NULL COMMENT 'Négatif pour perte, Positif pour prise', 
    est_actif       INT DEFAULT 1,
    CONSTRAINT chk_composition CHECK (pct_viande + pct_poisson + pct_volaille <= 100) 
);

-- ------------------------------------------------------------
-- 4. TABLE : regime_prix (Prix variant selon la durée) 
-- ------------------------------------------------------------
CREATE TABLE regime_prix (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    regime_id   INT NOT NULL,
    nb_semaines INT NOT NULL,
    prix        DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (regime_id) REFERENCES regimes(id) ON DELETE CASCADE
);

-- ------------------------------------------------------------
-- 5. TABLE : activites_sportives 
-- ------------------------------------------------------------
CREATE TABLE activites (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nom         VARCHAR(100) NOT NULL,
    description TEXT,
    intensite   ENUM('faible', 'moderee', 'elevee') DEFAULT 'moderee',
    est_actif   TINYINT(1) DEFAULT 1
);

-- ------------------------------------------------------------
-- 6. TABLE : abonnements (Choix final et historique PDF) 
-- ------------------------------------------------------------
CREATE TABLE abonnements (
    id                  INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id      INT NOT NULL,
    regime_id           INT NOT NULL,
    activite_id         INT NOT NULL,
    -- Snapshots pour l'export PDF et les statistiques 
    poids_depart        DECIMAL(5,2) NOT NULL,
    poids_cible         DECIMAL(5,2) NOT NULL,
    prix_paye           DECIMAL(10,2) NOT NULL,
    remise_gold_appliquee DECIMAL(10,2) DEFAULT 0.00,
    date_debut          DATE NOT NULL,
    date_fin            DATE NOT NULL,
    created_at          DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (regime_id) REFERENCES regimes(id),
    FOREIGN KEY (activite_id) REFERENCES activites(id)
);

-- ------------------------------------------------------------
-- 7. TABLE : codes_recharge (Porte-monnaie) 
-- ------------------------------------------------------------
CREATE TABLE codes_recharge (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    code        VARCHAR(20) NOT NULL UNIQUE,
    montant     DECIMAL(10,2) NOT NULL,
    est_valide  TINYINT(1) DEFAULT 1, -- Pour la "Validation des codes" 
    est_utilise TINYINT(1) DEFAULT 0,
    utilisateur_id INT NULL,
    date_utilisation DATETIME NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id)
);

-- ------------------------------------------------------------
-- 8. TABLE : admins (Back Office) 
-- ------------------------------------------------------------
CREATE TABLE admins (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    nom          VARCHAR(100),
    email        VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL
);
