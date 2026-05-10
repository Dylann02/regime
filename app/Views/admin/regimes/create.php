<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Régime</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="header">
        <h1>➕ Ajouter un Régime</h1>
        <div>
            <a class="btn secondary" href="<?= base_url('admin/regimes') ?>">Retour</a>
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

            <form action="<?= base_url('admin/regimes/store') ?>" method="post">
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
                    <label for="pct_viande">Pourcentage viande</label>
                    <input type="number" step="0.01" id="pct_viande" name="pct_viande" value="<?= esc(old('pct_viande')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="pct_poisson">Pourcentage poisson</label>
                    <input type="number" step="0.01" id="pct_poisson" name="pct_poisson" value="<?= esc(old('pct_poisson')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="pct_volaille">Pourcentage volaille</label>
                    <input type="number" step="0.01" id="pct_volaille" name="pct_volaille" value="<?= esc(old('pct_volaille')) ?>" required>
                </div>
                <div class="form-group">
                    <label for="variation_kg_semaine">Variation (kg/semaine)</label>
                    <input type="number" step="0.01" id="variation_kg_semaine" name="variation_kg_semaine" value="<?= esc(old('variation_kg_semaine')) ?>" required>
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="est_actif" value="1" <?= old('est_actif') ? 'checked' : '' ?>> Actif
                    </label>
                </div>
                <div class="actions">
                    <button class="btn" type="submit">Enregistrer</button>
                    <a class="btn secondary" href="<?= base_url('admin/regimes') ?>">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
