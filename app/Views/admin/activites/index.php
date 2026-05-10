<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Activités</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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
