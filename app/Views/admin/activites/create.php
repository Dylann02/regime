<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Activité</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; margin: 0; }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white; padding: 1rem 2rem; display: flex; justify-content: space-between; align-items: center;
        }
        .container { max-width: 800px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.4rem; font-weight: 600; }
        input, textarea, select { width: 100%; padding: 0.7rem; border-radius: 6px; border: 1px solid #ddd; }
        .actions { display: flex; gap: 1rem; margin-top: 1rem; }
        .btn { background: #667eea; color: white; border: none; padding: 0.6rem 1rem; border-radius: 6px; cursor: pointer; text-decoration: none; }
        .btn.secondary { background: #6c757d; }
        .message { padding: 0.8rem 1rem; border-radius: 6px; margin-bottom: 1rem; background: #fdecea; color: #b71c1c; }
    </style>
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
