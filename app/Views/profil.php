<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil utilisateur</title>
</head>
<body>
    <h2>Profil utilisateur</h2>

    <?php if (!empty($utilisateur)): ?>
        <p><strong>Nom :</strong> <?= esc($utilisateur['nom']) ?></p>
        <p><strong>Prénom :</strong> <?= esc($utilisateur['prenom']) ?></p>
        <p><strong>Email :</strong> <?= esc($utilisateur['email']) ?></p>
        <p><strong>Genre :</strong> <?= esc($utilisateur['genre']) ?></p>
        <p><strong>Date de naissance :</strong> <?= esc($utilisateur['date_naissance']) ?></p>
        <p><strong>Taille :</strong> <?= esc($utilisateur['taille_cm']) ?> cm</p>
        <p><strong>Poids :</strong> <?= esc($utilisateur['poids_actuel']) ?> kg</p>

        <?php if (!empty($utilisateur['taille_cm']) && !empty($utilisateur['poids_actuel'])): ?>
            <p><strong>IMC :</strong> <?= number_format($utilisateur['poids_actuel'] / (($utilisateur['taille_cm']/100) ** 2), 2) ?></p>
        <?php endif; ?>

        <br>
        <a href="<?= base_url('profil/modifier?id=' . $utilisateur['id']) ?>">
            <button type="button">Modifier profil</button>
        </a>
    <?php else: ?>
        <p>Utilisateur introuvable.</p>
    <?php endif; ?>
</body>
</html>
