<?php $title = 'Gestion des Régimes' ?>
<?= $this->extend('modele-admin') ?>
<?= $this->section('content') ?>

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
            <a class="btn btn-primary" href="<?= base_url('admin/regimes/create') ?>"> Ajouter un régime</a>
            <a class="btn btn-secondary" href="<?= base_url('admin/activites') ?>">Voir les activités</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Viande %</th>
                        <th>Poisson %</th>
                        <th>Volaille %</th>
                        <th>Variation (kg/sem)</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($regimes)): ?>
                        <?php foreach ($regimes as $regime): ?>
                            <tr>
                                <td><?= esc($regime['id']) ?></td>
                                <td><?= esc($regime['nom']) ?></td>
                                <td><?= esc($regime['description']) ?></td>
                                <td><?= esc($regime['pct_viande']) ?></td>
                                <td><?= esc($regime['pct_poisson']) ?></td>
                                <td><?= esc($regime['pct_volaille']) ?></td>
                                <td><?= esc($regime['variation_kg_semaine']) ?></td>
                                <td>
                                    <?php if (!empty($regime['est_actif'])): ?>
                                        <span class="badge success">Actif</span>
                                    <?php else: ?>
                                        <span class="badge muted">Inactif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <a class="btn btn-secondary btn-small" href="<?= base_url('admin/regimes/edit/' . $regime['id']) ?>">Modifier</a>
                                        <form action="<?= base_url('admin/regimes/delete/' . $regime['id']) ?>" method="post" onsubmit="return confirm('Supprimer ce régime ?');">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-danger btn-small" type="submit">Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">Aucun régime trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>
