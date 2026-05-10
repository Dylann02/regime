<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="header">
        <h1>🔐 Connexion</h1>
    </div>

    <div class="container" style="max-width: 600px;">
        <?php if (isset($erreur)): ?>
            <div class="message error">
                ❌ <?= esc($erreur) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($erreurs) && is_array($erreurs)): ?>
            <div class="message error">
                <div style="font-weight: 600; margin-bottom: 0.5rem;">❌ Erreurs détectées:</div>
                <?php foreach ($erreurs as $error): ?>
                    <div>• <?= esc($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?= set_value('email') ?>" required>
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe *</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>

                <div class="actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn">Se Connecter</button>
                </div>
            </form>

            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); text-align: center;">
                <p style="margin-bottom: 0;">Pas de compte? <a href="<?= base_url('inscription') ?>" style="color: var(--primary); font-weight: 600;">S'inscrire maintenant</a></p>
            </div>
        </div>
    </div>
</body>
</html>
