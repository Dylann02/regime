<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Paramètre</title>
    <style>body{font-family:Segoe UI,Arial;background:#f5f7fa;margin:0}.card{max-width:700px;margin:2rem auto;background:#fff;padding:1.2rem;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.05)}label{display:block;margin:.6rem 0}input,textarea{width:100%;padding:.6rem;border:1px solid #ddd;border-radius:6px}button{background:#667eea;color:#fff;padding:.6rem 1rem;border-radius:6px;border:0}</style>
</head>
<body>
    <div class="card">
        <h2>✏️ Modifier le paramètre "<?= esc($param['cle_param']) ?>"</h2>
        <?php if (!empty($errors) && is_array($errors)): ?><div style="background:#fdecea;color:#b71c1c;padding:.6rem;border-radius:6px;margin-bottom:1rem"><?php foreach($errors as $e) echo '<div>'.esc($e).'</div>'; ?></div><?php endif; ?>
        <form method="post" action="<?= base_url('admin/parametres/update/' . $param['cle_param']) ?>">
            <?= csrf_field() ?>
            <label for="valeur">Valeur</label>
            <input id="valeur" name="valeur" value="<?= esc($param['valeur']) ?>" required>
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="3"><?= esc($param['description']) ?></textarea>
            <div style="margin-top:1rem"><button type="submit">Enregistrer</button>
            <a style="margin-left:8px" href="<?= base_url('admin/parametres') ?>">Annuler</a></div>
        </form>
    </div>
</body>
</html><!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modifier Paramètre</title>
    <style>body{font-family:Segoe UI,Arial;background:#f5f7fa;margin:0}.card{max-width:700px;margin:2rem auto;background:#fff;padding:1.2rem;border-radius:8px;box-shadow:0 2px 10px rgba(0,0,0,0.05)}label{display:block;margin:.6rem 0}input,textarea{width:100%;padding:.6rem;border:1px solid #ddd;border-radius:6px}button{background:#667eea;color:#fff;padding:.6rem 1rem;border-radius:6px;border:0}</style>
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