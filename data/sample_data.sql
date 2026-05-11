-- ====================================================================
-- DONNÉES DE TEST POUR L'APPLICATION REGIME
-- Application de gestion de régimes alimentaires et fitness
-- ====================================================================

-- PARTIE 1: RÉGIMES ALIMENTAIRES
-- ====================================================================
INSERT INTO regimes (nom, description, pct_viande, pct_poisson, pct_volaille, variation_kg_semaine, est_actif) VALUES
('Régime Light', 'Régime léger pour une perte de poids progressive', 15, 20, 35, -0.5, 1),
('Régime Standard', 'Régime équilibré pour maintenir le poids', 25, 20, 30, 0, 1),
('Régime Protéiné', 'Régime riche en protéines pour la musculation', 30, 25, 35, 0.3, 1),
('Régime Cétogène', 'Régime pauvre en glucides, riche en lipides', 35, 25, 30, -0.7, 1),
('Régime Végétarien', 'Régime sans viande rouge ni poisson', 0, 0, 40, -0.3, 1),
('Régime Athlète', 'Régime haute performance pour sportifs', 20, 30, 35, 0.5, 1);

-- PARTIE 2: ACTIVITÉS PHYSIQUES
-- ====================================================================
INSERT INTO activites (nom, description, intensite, est_actif) VALUES
-- Intensité Faible
('Marche rapide', 'Marche à un rythme soutenu', 'faible', 1),
('Yoga', 'Séances de yoga et étirements', 'faible', 1),
('Natation relaxante', 'Natation tranquille et détente', 'faible', 1),
('Cyclisme léger', 'Vélo sur terrain plat', 'faible', 1),
('Stretching', 'Exercices d''assouplissement', 'faible', 1),
('Jogging', 'Course à pied modérée', 'moderee', 1),
('Musculation légère', 'Entraînement avec poids légers', 'moderee', 1),
('Danse', 'Cours de danse variée', 'moderee', 1),
('Pilates', 'Entraînement Pilates complet', 'moderee', 1),
('Cyclisme modéré', 'Vélo sur terrain mixte', 'moderee', 1),
('Course intense', 'Course rapide ou sprint', 'elevee', 1),
('Boxe', 'Entraînement de boxe complet', 'elevee', 1),
('HIIT', 'Entraînement par intervalles haute intensité', 'elevee', 1),
('CrossFit', 'Entraînement fonctionnel intense', 'elevee', 1),
('Natation compétition', 'Natation à haut rythme', 'elevee', 1);

-- PARTIE 3: UTILISATEURS
-- ====================================================================
INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe, genre, date_naissance, taille_cm, poids_actuel, objectif_actuel, valeur_objectif, solde, est_gold) VALUES
('Dupont', 'Jean', 'jean.dupont@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'M', '1985-03-15', 180, 85.5, 'reduire', 75, 0.00, 0),
('Martin', 'Sophie', 'sophie.martin@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'F', '1990-07-22', 165, 65.0, 'reduire', 58, 2500.00, 1),
('Bernard', 'Pierre', 'pierre.bernard@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'M', '1988-11-10', 175, 78.0, 'augmenter', 85, 1200.00, 0),
('Thomas', 'Luc', 'luc.thomas@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'M', '1995-05-18', 185, 92.0, 'reduire', 80, 5000.00, 1),
('Robert', 'Claire', 'claire.robert@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'F', '1992-09-30', 168, 72.5, 'maintenir', 70, 3500.00, 0),
('Lefevre', 'Marie', 'marie.lefevre@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'F', '1987-01-25', 162, 68.0, 'reduire', 62, 1800.00, 1),
('Moreau', 'Jacques', 'jacques.moreau@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'M', '1980-12-05', 182, 88.0, 'reduire', 78, 0.00, 0),
('Durand', 'Isabelle', 'isabelle.durand@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'F', '1993-06-14', 170, 75.0, 'augmenter', 80, 2200.00, 0),
('Petit', 'Marc', 'marc.petit@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'M', '1989-04-09', 178, 82.0, 'reduire', 72, 4000.00, 1),
('Gillet', 'Nathalie', 'nathalie.gillet@email.com', '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4rWG2', 'F', '1994-08-20', 166, 70.0, 'maintenir', 70, 800.00, 0);

-- PARTIE 4: CODES DE RECHARGE (CRÉDITS)
-- ====================================================================
INSERT INTO codes_recharge (code, montant, est_valide, est_utilise, utilisateur_id, date_utilisation) VALUES
-- Non utilisés
('CODE1000-GOLD-001', 1000, 1, 0, NULL, NULL),
('CODE1500-GOLD-002', 1500, 1, 0, NULL, NULL),
('CODE2000-PROMO-001', 2000, 1, 0, NULL, NULL),
('CODE500-BASIC-001', 500, 1, 0, NULL, NULL),
('CODE3000-VIP-001', 3000, 1, 0, NULL, NULL),

-- Utilisés
('CODE1000-GOLD-003', 1000, 1, 1, 2, '2026-05-01 10:30:00'),
('CODE1500-PROMO-002', 1500, 1, 1, 5, '2026-04-28 14:15:00'),
('CODE2000-GOLD-004', 2000, 1, 1, 9, '2026-04-25 09:45:00'),
('CODE500-BASIC-002', 500, 1, 1, 1, '2026-04-20 16:20:00'),
('CODE3000-VIP-002', 3000, 1, 1, 4, '2026-04-18 11:00:00');

-- PARTIE 5: ABONNEMENTS
-- ====================================================================
INSERT INTO abonnements (utilisateur_id, regime_id, activite_id, poids_depart, poids_cible, prix_paye, remise_gold_appliquee, date_debut, date_fin) VALUES
-- Utilisateur 1 (Jean Dupont) - Sans gold
(1, 1, 2, 85.5, 75, 199.99, 0, '2026-04-01', '2026-07-01'),

-- Utilisateur 2 (Sophie Martin) - Avec gold (remise appliquée)
(2, 3, 8, 65.0, 62, 149.99, 50, '2026-03-15', '2026-06-15'),

-- Utilisateur 3 (Pierre Bernard) - Sans gold
(3, 3, 11, 78.0, 85, 199.99, 0, '2026-04-10', '2026-07-10'),

-- Utilisateur 4 (Luc Thomas) - Avec gold
(4, 1, 5, 92.0, 80, 149.99, 50, '2026-02-20', '2026-05-20'),

-- Utilisateur 5 (Claire Robert) - Sans gold
(5, 2, 9, 72.5, 70, 179.99, 0, '2026-04-05', '2026-07-05'),

-- Utilisateur 6 (Marie Lefevre) - Avec gold
(6, 1, 3, 68.0, 62, 149.99, 50, '2026-03-01', '2026-06-01'),

-- Utilisateur 8 (Isabelle Durand) - Sans gold
(8, 3, 12, 75.0, 80, 199.99, 0, '2026-04-15', '2026-07-15'),

-- Utilisateur 9 (Marc Petit) - Avec gold
(9, 2, 10, 82.0, 72, 149.99, 50, '2026-03-20', '2026-06-20'),

-- Utilisateur 10 (Nathalie Gillet) - Sans gold
(10, 2, 7, 70.0, 70, 179.99, 0, '2026-04-12', '2026-07-12');

-- PARTIE 6: PRIX DES RÉGIMES PAR DURÉE (EN SEMAINES)
-- ====================================================================
INSERT INTO regime_prix (regime_id, nb_semaines, prix) VALUES
(1,  1,   49.99), (1, 2,   89.99), (1, 4,  159.99), (1, 9,  289.99), (1, 13,  399.99),
(2,  1,   54.99), (2, 2,   99.99), (2, 4,  179.99), (2, 9,  329.99), (2, 13,  449.99),
(3,  1,   64.99), (3, 2,  119.99), (3, 4,  219.99), (3, 9,  399.99), (3, 13,  549.99),
(4,  1,   69.99), (4, 2,  129.99), (4, 4,  239.99), (4, 9,  429.99), (4, 13,  599.99),
(5,  1,   59.99), (5, 2,  109.99), (5, 4,  199.99), (5, 9,  369.99), (5, 13,  499.99),
(6,  1,   79.99), (6, 2,  149.99), (6, 4,  279.99), (6, 9,  499.99), (6, 13,  699.99);
-- ====================================================================
-- FIN DES DONNÉES
-- ====================================================================


$2y$12$DVH5RX/P.FElVmO0Pe.xvuixd8oOCyE5ER6gd2TzcpxCraCngi8jy
