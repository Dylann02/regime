<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Activité</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="header">
        <h1>➕ Ajouter une Activité</h1>
        <div>
            <a class="btn secondary" href="<?= base_url('admin/activites') ?>">Retour</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <?php if (!empty($errors) && is_array($errors)): ?>
                <div class="message">
                    <?php foreach ($errors as $message): ?>
                        <div><?= esc($message) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('admin/activites/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= esc(old('nom')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"><?= esc(old('description')) ?></textarea>
                </div>
                <div class="form-group">
                    <label for="intensite">Intensité</label>
                    <select id="intensite" name="intensite" required>
                        <option value="">-- Choisir --</option>
                        <option value="faible" <?= old('intensite') === 'faible' ? 'selected' : '' ?>>Faible</option>
                        <option value="moderee" <?= old('intensite') === 'moderee' ? 'selected' : '' ?>>Modérée</option>
                        <option value="elevee" <?= old('intensite') === 'elevee' ? 'selected' : '' ?>>Élevée</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="est_actif" value="1" <?= old('est_actif') ? 'checked' : '' ?>> Actif
                    </label>
                </div>
                <div class="actions">
                    <button class="btn" type="submit">Enregistrer</button>
                    <a class="btn secondary" href="<?= base_url('admin/activites') ?>">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
