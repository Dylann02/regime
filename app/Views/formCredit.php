<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="header">
        <h1>💳 Ajouter du crédit</h1>
        <div>
            <a href="<?= base_url('profil') ?>" class="header-link" style="color: white; text-decoration: none; margin-left: 1rem;">← Retour</a>
        </div>
    </div>

    <div class="container" style="max-width: 600px;">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="message error">

                 <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2 style="margin-top: 0; margin-bottom: 1rem;">Recharger votre solde</h2>
            
            <div class="stat-card gold mb-3">
                <div class="stat-label">Utilisateur</div>
                <div style="font-size: 1.2rem; font-weight: 600; color: var(--secondary);">
                    <?= esc($utilisateur['prenom'] ?? 'Client') ?>
                </div>
            </div>

            <form action="<?= base_url('traitementCredit') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="credit">Code de recharge *</label>
                    <input type="text" id="credit" name="credit" placeholder="Entrez votre code de recharge" required>
                </div>

                <div class="actions">
                    <button type="submit" class="btn">Recharger le crédit</button>
                    <a href="<?= base_url('profil') ?>" class="btn secondary" style="text-decoration: none; text-align: center;">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>