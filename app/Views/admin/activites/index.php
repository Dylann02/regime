<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Activités</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
            margin: 0;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .header a { color: white; text-decoration: none; margin-left: 1rem; }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .actions { display: flex; gap: 1rem; margin-bottom: 1rem; flex-wrap: wrap; }
        .btn {
            background: #667eea;
            color: white;
            padding: 0.6rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
        }
        .btn.secondary { background: #6c757d; }
        .btn.danger { background: #dc3545; }
        .table-container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow-x: auto;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 1rem; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #f8f9fa; color: #667eea; }
        .badge {
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.8rem;
        }
        .badge.success { background: #e6f4ea; color: #28a745; }
        .badge.muted { background: #f0f0f0; color: #777; }
        .message {
            padding: 0.8rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
        }
        .message.success { background: #e6f4ea; color: #1e7e34; }
        .message.error { background: #fdecea; color: #b71c1c; }
        form.inline { display: inline; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏃 Gestion des Activités</h1>
        <div>
            <a href="<?= base_url('dashboard') ?>">Dashboard</a>
            <a href="<?= base_url('admin/regimes') ?>">Régimes</a>
            <a href="<?= base_url('logout') ?>">Déconnexion</a>
        </div>
    </div>

    <div class="container">
        <?php if (!empty($success)): ?>
            <div class="message success"><?= esc($success) ?></div>
        <?php endif; ?>

        <?php if (!empty($errors) && is_array($errors)): ?>
            <div class="message error">
                <?php foreach ($errors as $message): ?>
                    <div><?= esc($message) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="actions">
            <a class="btn" href="<?= base_url('admin/activites/create') ?>">➕ Ajouter une activité</a>
            <a class="btn secondary" href="<?= base_url('admin/regimes') ?>">Voir les régimes</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Intensité</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($activites)): ?>
                        <?php foreach ($activites as $activite): ?>
                            <tr>
                                <td><?= esc($activite['id']) ?></td>
                                <td><?= esc($activite['nom']) ?></td>
                                <td><?= esc($activite['description']) ?></td>
                                <td><?= esc(ucfirst($activite['intensite'])) ?></td>
                                <td>
                                    <?php if (!empty($activite['est_actif'])): ?>
                                        <span class="badge success">Actif</span>
                                    <?php else: ?>
                                        <span class="badge muted">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a class="btn secondary" href="<?= base_url('admin/activites/edit/' . $activite['id']) ?>">Modifier</a>
                                    <form class="inline" action="<?= base_url('admin/activites/delete/' . $activite['id']) ?>" method="post" onsubmit="return confirm('Supprimer cette activité ?');">
                                        <?= csrf_field() ?>
                                        <button class="btn danger" type="submit">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Aucune activité trouvée.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
