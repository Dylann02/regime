<?php $title = 'Paramètres' ?>
<?= $this->extend('modele-admin') ?>
<?= $this->section('content') ?>

    <div class="container">
        <?php if (!empty($success)): ?>
            <div class="message success"><?= esc($success) ?></div>
        <?php endif; ?>
        
        <?php if (!empty($errors) && is_array($errors)): ?>
            <div class="message error">
                <?php foreach($errors as $m): ?>
                    <div>• <?= esc($m) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <div class="actions" style="margin-bottom: 20px;">
            <a class="btn btn-primary" href="<?= base_url('admin/parametres/create') ?>">➕ Ajouter un paramètre</a>
        </div>
        
        <div class="table-container">
        <table>
            <thead>
                    <tr>
                        <th>Clé</th>
                        <th>Valeur</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($params)): ?>
                        <?php foreach($params as $p): ?>
                            <tr>
                                <td><strong><?= esc($p['cle_param']) ?></strong></td>
                                <td><code style="background: #f5f5f5; padding: 2px 6px; border-radius: 3px;"><?= esc($p['valeur']) ?></code></td>
                                <td><?= esc($p['description']) ?></td>
                                <td>
                                    <div class="table-actions">
                                        <a class="btn btn-secondary btn-small" href="<?= base_url('admin/parametres/edit/' . $p['cle_param']) ?>">✏️ Modifier</a>
                                        <form action="<?= base_url('admin/parametres/delete/' . $p['cle_param']) ?>" method="post" onsubmit="return confirm('Supprimer ce paramètre ?');">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-danger btn-small" type="submit">🗑️ Supprimer</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px; color: #999;">🔍 Aucun paramètre défini.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>