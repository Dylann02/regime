
-- ============================================================
-- NETTOYAGE DES DONNEES (sauf admins)
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE abonnements;
TRUNCATE TABLE codes_recharge;
TRUNCATE TABLE regime_prix;
TRUNCATE TABLE regimes;
TRUNCATE TABLE activites;
TRUNCATE TABLE utilisateurs;
TRUNCATE TABLE parametres;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- REINSERTION DES PARAMETRES
-- ============================================================

INSERT INTO parametres (cle_param, valeur, description) VALUES
('imc_ideal', '22', 'Valeur cible pour l objectif IMC Idéal'),
('prix_gold', '50000', 'Prix forfaitaire pour devenir membre Gold'),
('remise_gold', '15', 'Pourcentage de réduction pour les membres Gold (%)');

-- ============================================================
-- UTILISATEURS (5)
-- Mot de passe en clair pour tous : password123
-- ============================================================

INSERT INTO utilisateurs (
    nom,
    prenom,
    email,
    mot_de_passe,
    genre,
    date_naissance,
    taille_cm,
    poids_actuel,
    objectif_actuel,
    solde,
    est_gold
) VALUES (
    'Rakoto',
    'Jean',
    'jean@test.mg',
    '$2y$12$DVH5RX/P.FElVmO0Pe.xvuixd8oOCyE5ER6gd2TzcpxCraCngi8jy',
    'homme',
    '1998-05-12',
    175,
    78,
    'reduire',
    120000,
    1
),

(
    'Rabe',
    'Sarah',
    'sarah@test.mg',
    '$2y$12$DVH5RX/P.FElVmO0Pe.xvuixd8oOCyE5ER6gd2TzcpxCraCngi8jy',
    'femme',
    '2001-03-21',
    165,
    55,
    'augmenter',
    80000,
    0
),


(
    'Andry',
    'Lucas',
    'lucas@test.mg',
    '$2y$12$DVH5RX/P.FElVmO0Pe.xvuixd8oOCyE5ER6gd2TzcpxCraCngi8jy',
    'homme',
    '1995-11-10',
    180,
    95,
    'imc_ideal',
    50000,
    1
),


(
    'Mickael',
    'Nina',
    'nina@test.mg',
    '$2y$12$DVH5RX/P.FElVmO0Pe.xvuixd8oOCyE5ER6gd2TzcpxCraCngi8jy',
    'femme',
    '1999-07-18',
    160,
    62,
    'reduire',
    30000,
    0
),


(
    'Rasoanaivo',
    'Kevin',
    'kevin@test.mg',
    '$2y$12$DVH5RX/P.FElVmO0Pe.xvuixd8oOCyE5ER6gd2TzcpxCraCngi8jy',
    'homme',
    '2000-09-30',
    170,
    68,
    'augmenter',
    150000,
    1
);

-- ============================================================
-- REGIMES (5)
-- ============================================================

INSERT INTO regimes (
    nom,
    description,
    pct_viande,
    pct_poisson,
    pct_volaille,
    variation_kg_semaine
) VALUES
(
    'Régime Minceur',
    'Programme pour perte de poids progressive',
    20,
    30,
    20,
    -1.200
),
(
    'Régime Prise de Masse',
    'Programme riche en protéines',
    40,
    20,
    30,
    1.500
),
(
    'Régime Equilibré',
    'Alimentation équilibrée quotidienne',
    25,
    25,
    25,
    0.300
),
(
    'Régime Fitness',
    'Programme pour sportifs',
    35,
    30,
    25,
    -0.500
),
(
    'Régime IMC Ideal',
    'Atteindre un IMC optimal',
    30,
    20,
    20,
    -0.800
);

-- ============================================================
-- PRIX DES REGIMES
-- ============================================================

INSERT INTO regime_prix (
    regime_id,
    nb_semaines,
    prix
) VALUES
(1, 4, 80000),
(1, 8, 150000),

(2, 4, 100000),
(2, 8, 190000),

(3, 4, 70000),
(3, 8, 130000),

(4, 4, 90000),
(4, 8, 170000),

(5, 4, 85000),
(5, 8, 160000);

-- ============================================================
-- ACTIVITES SPORTIVES (5)
-- ============================================================

INSERT INTO activites (
    nom,
    description,
    intensite
) VALUES
(
    'Course à pied',
    'Cardio pour brûler les calories',
    'elevee'
),
(
    'Yoga',
    'Relaxation et souplesse',
    'faible'
),
(
    'Musculation',
    'Développement musculaire',
    'elevee'
),
(
    'Natation',
    'Sport complet pour endurance',
    'moderee'
),
(
    'Cyclisme',
    'Amélioration cardio et endurance',
    'moderee'
);

-- ============================================================
-- CODES DE RECHARGE (15)
-- ============================================================

INSERT INTO codes_recharge (
    code,
    montant,
    est_valide,
    est_utilise
) VALUES
('CODE001', 10000, 1, 0),
('CODE002', 15000, 1, 0),
('CODE003', 20000, 1, 0),
('CODE004', 25000, 1, 0),
('CODE005', 30000, 1, 0),
('CODE006', 35000, 1, 0),
('CODE007', 40000, 1, 0),
('CODE008', 45000, 1, 0),
('CODE009', 50000, 1, 0),
('CODE010', 55000, 1, 0),
('CODE011', 60000, 1, 0),
('CODE012', 65000, 1, 0),
('CODE013', 70000, 1, 0),
('CODE014', 75000, 1, 0),
('CODE015', 80000, 1, 0);

-- ============================================================
-- ABONNEMENTS TEST
-- ============================================================

INSERT INTO abonnements (
    utilisateur_id,
    regime_id,
    activite_id,
    poids_depart,
    poids_cible,
    prix_paye,
    remise_gold_appliquee,
    date_debut,
    date_fin
) VALUES
(
    1,
    1,
    1,
    78,
    70,
    68000,
    12000,
    '2026-05-01',
    '2026-06-01'
),
(
    2,
    2,
    3,
    55,
    62,
    100000,
    0,
    '2026-05-03',
    '2026-06-03'
),
(
    3,
    5,
    4,
    95,
    80,
    136000,
    24000,
    '2026-05-05',
    '2026-07-05'
);