<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 2</title>
</head>
<body>
    <div class="container">
        <div class="progress">Étape 2/2</div>
        <h2>Inscription - Étape 2</h2>

        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0): ?>
            <div class="error">
                <?php foreach ($erreurs as $field => $message): ?>
                    <p><?= esc($message) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('inscription/finaliser') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="taille_cm">Taille (cm)</label>
                <input type="number" id="taille_cm" step="0.01" name="taille_cm" value="<?= set_value('taille_cm') ?>" required>
            </div>

            <div class="form-group">
                <label for="poids_actuel">Poids (kg)</label>
                <input type="number" id="poids_actuel" step="0.01" name="poids_actuel" value="<?= set_value('poids_actuel') ?>" required>
            </div>

            <button type="submit">Terminer l'inscription</button>
        </form>
    </div>
</body>
</html>
