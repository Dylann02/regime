<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Étape 2</title>
</head>
<body>
    <h2>Inscription - Étape 2</h2>

    <?php if (isset($validation)): ?>
        <div style="color:red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('inscription/finaliser') ?>" method="post">
        <?= csrf_field() ?>

        <input type="hidden" name="user_id" value="<?= esc($userId) ?>">

        <label>Taille (cm)</label><br>
        <input type="number" step="0.01" name="taille_cm" value="<?= set_value('taille_cm') ?>"><br><br>

        <label>Poids (kg)</label><br>
        <input type="number" step="0.01" name="poids_actuel" value="<?= set_value('poids_actuel') ?>"><br><br>

        <button type="submit">Validez</button>
    </form>
</body>
</html>
