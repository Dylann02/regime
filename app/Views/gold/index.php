<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Option Gold</title>
</head>
<body>
    <h1>Option Gold</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><strong><?= session()->getFlashdata('error') ?></strong></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><strong><?= session()->getFlashdata('success') ?></strong></p>
    <?php endif; ?>

    <p>Devenez membre Gold pour bénéficier d'une remise de 15% sur vos abonnements.</p>
    <p><strong>Prix :</strong> <?= number_format($goldPrice, 0, ',', ' ') ?> Ar</p>
    <p><strong>Solde actuel :</strong> <?= number_format($utilisateur['solde'] ?? 0, 0, ',', ' ') ?> Ar</p>

    <?php if (!empty($utilisateur['est_gold'])): ?>
        <p><strong>Vous êtes déjà membre Gold ✅</strong></p>
    <?php else: ?>
        <a href="<?= base_url('gold/activer') ?>">
            <button type="button">Passer à l'option Gold</button>
        </a>
    <?php endif; ?>

    <p><a href="<?= base_url('profil') ?>">Retour au profil</a></p>
</body>
</html>
