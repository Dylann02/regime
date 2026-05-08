<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil utilisateur</title>
</head>
<body>
    <div class="profile-container">
        <h2>Profil utilisateur</h2>

        <?php if (isset($message)): ?>
            <div style="color: green; background-color: #d4edda; padding: 10px; border-radius: 3px; margin-bottom: 15px;">
                <?= esc($message) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($utilisateur)): ?>
            <div class="info"><strong>Nom :</strong> <?= esc($utilisateur['nom']) ?></div>
            <div class="info"><strong>Prénom :</strong> <?= esc($utilisateur['prenom']) ?></div>
            <div class="info"><strong>Genre :</strong> <?= esc($utilisateur['genre']) ?></div>
            <div class="info"><strong>Date de naissance :</strong> <?= esc($utilisateur['date_naissance']) ?></div>
            <div class="info"><strong>Taille :</strong> <?= esc($utilisateur['taille_cm']) ?> cm</div>
            <div class="info"><strong>Poids :</strong> <?= esc($utilisateur['poids_actuel']) ?> kg</div>
            <div class="info"><strong>Objectif :</strong> <?= esc($utilisateur['objectif_actuel'] ?? 'Non défini') ?></div>
            <div class="info"><strong>Solde :</strong> <?= number_format($utilisateur['solde'] ?? 0, 2) ?> €</div>
            <div class="info"><strong>Statut Gold :</strong> <?= ($utilisateur['est_gold'] ?? 0) ? 'Oui' : 'Non' ?></div>

            <?php if (!empty($imc)): ?>
                <div class="info"><strong>IMC :</strong> <?= number_format($imc, 2) ?></div>
            <?php endif; ?>

            <div class="actions">
                <a href="<?= base_url('profil/modifier') ?>" class="btn">Modifier profil</a>
                <a href="<?= base_url('suggestions') ?>" class="btn">Voir les suggestions de régime</a>
                <a href="<?= base_url('gold') ?>" class="btn">Passer à l'option Gold</a>
                <a href="<?= base_url('logout') ?>" class="btn logout-btn">Déconnexion</a>
            </div>
        <?php else: ?>
            <p>Utilisateur introuvable.</p>
        <?php endif; ?>
    </div>
</body>
</html>
