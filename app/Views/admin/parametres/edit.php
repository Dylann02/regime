<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Paramètre</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="card">
        <h2>✏️ Modifier paramètre</h2>
        <?php if (!empty($errors) && is_array($errors)): ?><div style="background:#fdecea;color:#b71c1c;padding:.6rem;border-radius:6px;margin-bottom:1rem"><?php foreach($errors as $e) echo '<div>'.esc($e).'</div>'; ?></div><?php endif; ?>
        <form method="post" action="<?= base_url('admin/parametres/update/' . $param['cle_param']) ?>">
            <?= csrf_field() ?>
            <label for="cle_param">Clé</label>
            <input id="cle_param" name="cle_param" value="<?= esc($param['cle_param']) ?>" readonly>
            <label for="valeur">Valeur</label>
            <input id="valeur" name="valeur" value="<?= esc($param['valeur']) ?>" required>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3"><?= esc($param['description']) ?></textarea>
            <div style="margin-top:1rem"><button type="submit">Enregistrer</button>
            <a style="margin-left:8px" href="<?= base_url('admin/parametres') ?>">Annuler</a></div>
        </form>
    </div>
</body>
</html>