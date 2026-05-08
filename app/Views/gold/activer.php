<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Activer l'option Gold</title>
</head>
<body>
    <h1>Activation de l'option Gold</h1>

    <p>En activant l'option Gold, vous bénéficiez d'une remise de 15% sur vos régimes.</p>
    <p><strong>Prix :</strong> <?= number_format($goldPrice, 0, ',', ' ') ?> Ar</p>
    <p><strong>Solde actuel :</strong> <?= number_format($utilisateur['solde'] ?? 0, 0, ',', ' ') ?> Ar</p>

    <?php if (!empty($utilisateur['est_gold'])): ?>
        <p><strong>Vous êtes déjà membre Gold ✅</strong></p>
        <p><a href="<?= base_url('profil') ?>">Retour au profil</a></p>
    <?php else: ?>
        <form action="<?= base_url('gold/activer') ?>" method="post">
            <?= csrf_field() ?>
            <button type="submit">Confirmer l'activation</button>
        </form>
        <p><a href="<?= base_url('gold') ?>">Annuler</a></p>
    <?php endif; ?>
</body>
</html>
