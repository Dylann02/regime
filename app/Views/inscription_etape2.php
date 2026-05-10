<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 2</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="header">
        <h1>📝 Inscription - Étape 2/2</h1>
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

        <div style="background: var(--accent-light); padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; text-align: center; color: #1e40af; font-weight: 600;">
            ⚠️ Dernière étape - Informations physiques
        </div>

        <div class="card">
            <form action="<?= base_url('inscription/finaliser') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="taille_cm">Taille (cm) *</label>
                    <input type="number" id="taille_cm" step="0.01" name="taille_cm" value="<?= set_value('taille_cm') ?>" required>
                </div>

                <div class="form-group">
                    <label for="poids_actuel">Poids (kg) *</label>
                    <input type="number" id="poids_actuel" step="0.01" name="poids_actuel" value="<?= set_value('poids_actuel') ?>" required>
                </div>

                <div class="actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn">Terminer l'inscription ✓</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
