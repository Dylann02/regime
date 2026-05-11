<?php $title = 'Ajouter un Régime' ?>
<?= $this->extend('modele-admin') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 700px;">
        <div class="card">
            <?php if (!empty($errors) && is_array($errors)): ?>
                <div class="message error">
                    <div style="font-weight: 600; margin-bottom: 6px;"> Erreurs détectées:</div>
                    <?php foreach ($errors as $message): ?>
                        <div>• <?= esc($message) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h2 style="margin-top:0; color:#333; margin-bottom:24px;">Ajouter un regime</h2>
            
            <form action="<?= base_url('admin/regimes/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="nom">Nom du regime *</label>
                    <input type="text" id="nom" name="nom" placeholder="ex: Régime Protéiné" value="<?= esc(old('nom')) ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Décrivez ce régime..." rows="4"><?= esc(old('description')) ?></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="pct_viande">% Viande</label>
                        <input type="number" step="0.01" id="pct_viande" name="pct_viande" placeholder="ex: 40" value="<?= esc(old('pct_viande')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pct_poisson">% Poisson</label>
                        <input type="number" step="0.01" id="pct_poisson" name="pct_poisson" placeholder="ex: 30" value="<?= esc(old('pct_poisson')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pct_volaille">% Volaille</label>
                        <input type="number" step="0.01" id="pct_volaille" name="pct_volaille" placeholder="ex: 30" value="<?= esc(old('pct_volaille')) ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="variation_kg_semaine">Variation (kg/semaine)</label>
                    <input type="number" step="0.01" id="variation_kg_semaine" name="variation_kg_semaine" placeholder="ex: 0.5" value="<?= esc(old('variation_kg_semaine')) ?>" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 24px;">
                    <label>
                        <input type="checkbox" name="est_actif" value="1" <?= old('est_actif') ? 'checked' : '' ?>> Regime actif
                    </label>
                </div>
                
                <div class="actions" style="justify-content: flex-start;">
                    <button class="btn btn-primary btn-icon" type="submit">Enregistrer</button>
                    <a class="btn btn-secondary btn-icon" href="<?= base_url('admin/regimes') ?>">Annuler</a>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>
