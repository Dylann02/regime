<?php $title = 'Ajouter une Activité' ?>
<?= $this->extend('modele-admin') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 700px;">
        <div class="card">
            <?php if (!empty($errors) && is_array($errors)): ?>
                <div class="message error">
                    <div style="font-weight: 600; margin-bottom: 6px;">❌ Erreurs détectées:</div>
                    <?php foreach ($errors as $message): ?>
                        <div>• <?= esc($message) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h2 style="margin-top:0; color:#333; margin-bottom:24px;">Ajouter une activite</h2>
            
            <form action="<?= base_url('admin/activites/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="nom">Nom de l'activite *</label>
                    <input type="text" id="nom" name="nom" placeholder="ex: Marche rapide" value="<?= esc(old('nom')) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez cette activité..." rows="4"><?= esc(old('description')) ?></textarea>
                </div>
                
                <div class="form-group">
                    <label for="intensite">Intensite *</label>
                    <select id="intensite" name="intensite" required>
                        <option value="">-- Choisir --</option>
                        <option value="faible" <?= old('intensite') === 'faible' ? 'selected' : '' ?>>Faible</option>
                        <option value="moderee" <?= old('intensite') === 'moderee' ? 'selected' : '' ?>>Moderee</option>
                        <option value="elevee" <?= old('intensite') === 'elevee' ? 'selected' : '' ?>>Elevee</option>
                    </select>
                </div>
                
                <div class="form-group" style="margin-bottom: 24px;">
                    <label>
                        <input type="checkbox" name="est_actif" value="1" <?= old('est_actif') ? 'checked' : '' ?>> Activite active
                    </label>
                </div>
                
                <div class="actions" style="justify-content: flex-start;">
                    <button class="btn btn-primary btn-icon" type="submit">Enregistrer</button>
                    <a class="btn btn-secondary btn-icon" href="<?= base_url('admin/activites') ?>">Annuler</a>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>
