<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 1</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="header">
        <h1>📝 Inscription - Étape 1</h1>
    </div>

    <div class="container" style="max-width: 600px;">
        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0): ?>
            <div class="message error">
                <div style="font-weight: 600; margin-bottom: 0.5rem;">❌ Erreurs détectées:</div>
                <?php foreach ($erreurs as $field => $message): ?>
                    <div>• <?= esc($message) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <form action="<?= base_url('inscription/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="<?= set_value('nom') ?>" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" value="<?= set_value('prenom') ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?= set_value('email') ?>" required>
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe (minimum 8 caractères) *</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre *</label>
                    <select id="genre" name="genre" required>
                        <option value="">-- Choisir --</option>
                        <option value="homme" <?= set_select('genre', 'homme') ?>>Homme</option>
                        <option value="femme" <?= set_select('genre', 'femme') ?>>Femme</option>
                        <option value="autre" <?= set_select('genre', 'autre') ?>>Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_naissance">Date de naissance *</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?= set_value('date_naissance') ?>" required>
                </div>

                <div class="actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn">Suivant ➜</button>
                </div>
            </form>

            <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color); text-align: center;">
                <p style="margin-bottom: 0;">Vous avez déjà un compte? <a href="<?= base_url('login') ?>" style="color: var(--primary); font-weight: 600;">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>