<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres</title>
    <style>
        body{font-family:Segoe UI, Tahoma, Arial; background:#f5f7fa; margin:0}
        .header{background:linear-gradient(135deg,#667eea,#764ba2);color:#fff;padding:1rem 2rem;display:flex;justify-content:space-between}
        .container{max-width:1100px;margin:2rem auto;padding:0 1rem}
        table{width:100%;border-collapse:collapse;background:#fff;border-radius:8px;overflow:hidden}
        th,td{padding:0.9rem;border-bottom:1px solid #eee;text-align:left}
        th{background:#f8f9fa;color:#667eea}
        .actions{display:flex;gap:8px}
        .btn{background:#667eea;color:#fff;padding:0.5rem 0.8rem;border-radius:6px;text-decoration:none}
    </style>
</head>
<body>
    <div class="header">
        <h1>⚙️ Paramètres</h1>
        <div>
            <a class="btn" href="<?= base_url('admin/parametres/create') ?>">➕ Ajouter</a>
            <a class="btn" href="<?= base_url('dashboard') ?>">← Retour</a>
        </div>
    </div>
    <div class="container">
        <?php if (!empty($success)): ?><div style="background:#e6f4ea;color:#1e7e34;padding:.8rem;border-radius:6px;margin-bottom:1rem"><?= esc($success) ?></div><?php endif; ?>
        <?php if (!empty($errors) && is_array($errors)): ?><div style="background:#fdecea;color:#b71c1c;padding:.8rem;border-radius:6px;margin-bottom:1rem"><?php foreach($errors as $m) echo '<div>'.esc($m).'</div>'; ?></div><?php endif; ?>
        <table>
            <thead><tr><th>Clé</th><th>Valeur</th><th>Description</th><th>Actions</th></tr></thead>
            <tbody>
                <?php if (!empty($params)): foreach($params as $p): ?>
                    <tr>
                        <td><?= esc($p['cle_param']) ?></td>
                        <td><?= esc($p['valeur']) ?></td>
                        <td><?= esc($p['description']) ?></td>
                        <td class="actions">
                            <a class="btn" href="<?= base_url('admin/parametres/edit/' . $p['cle_param']) ?>">Modifier</a>
                            <form style="display:inline" method="post" action="<?= base_url('admin/parametres/delete/' . $p['cle_param']) ?>" onsubmit="return confirm('Supprimer ?');"><?= csrf_field() ?><button class="btn" type="submit">Supprimer</button></form>
                        </td>
                    </tr>
                <?php endforeach; else: ?>
                    <tr><td colspan="4">Aucun paramètre.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>