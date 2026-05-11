<?php $title = 'Modifier Paramètre' ?>
<?= $this->extend('modele-admin') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 700px;">
        <div class="card">
            <h2 style="margin-top:0; color:#333; margin-bottom:24px;"> <?= $title ?></h2>
            
            <?php if (!empty($errors) && is_array($errors)): ?>
                <div class="message error">
                    <div style="font-weight: 600; margin-bottom: 6px;"> Erreurs détectées:</div>
                    <?php foreach($errors as $e): ?>
                        <div>• <?= esc($e) ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?= base_url('admin/parametres/update/' . $param['cle_param']) ?>">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="cle_param">🔍 Clé du paramètre</label>
                    <input id="cle_param" name="cle_param" value="<?= esc($param['cle_param']) ?>" readonly style="background-color: #f5f5f5; cursor: not-allowed;">
                    <small style="color: #999; display: block; margin-top: 4px;">Cette valeur ne peut pas être modifiée</small>
                </div>
                
                <div class="form-group">
                    <label for="valeur"> Valeur *</label>
                    <input id="valeur" name="valeur" placeholder="Entrez la valeur" value="<?= esc($param['valeur']) ?>" required>
                </div>
                
                <div class="form-group" style="margin-bottom: 24px;">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Expliquez ce paramètre..." rows="3"><?= esc($param['description']) ?></textarea>
                </div>
                
                <div class="actions" style="justify-content: flex-start;">
                    <button class="btn btn-primary btn-icon" type="submit">✓ Enregistrer</button>
                    <a class="btn btn-secondary btn-icon" href="<?= base_url('admin/parametres') ?>">✕ Annuler</a>
                </div>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>
