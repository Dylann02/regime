<?php $title = 'Choix de l\'objectif' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 700px;">
        <div class="chart-container mb-4">
            <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem; color: var(--primary);">📊 Informations de santé</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div class="stat-card">
                    <div class="stat-label">Poids actuel</div>
                    <div class="stat-value"><?= esc($utilisateur['poids_actuel']) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
                
                <?php if (!empty($imc)): ?>
                    <div class="stat-card info">
                        <div class="stat-label">Votre IMC</div>
                        <div class="stat-value"><?= number_format($imc, 1) ?></div>
                        <div class="stat-unit">indice</div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($poidsIdeal)): ?>
                    <div class="stat-card success">
                        <div class="stat-label">Poids idéal</div>
                        <div class="stat-value"><?= number_format($poidsIdeal, 1) ?></div>
                        <div class="stat-unit">kg</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="card">
            <h2 style="margin-top: 0; color: var(--primary); margin-bottom: 1.5rem;">Choisissez votre objectif</h2>
            
            <form action="<?= base_url('inscription/save_objectif') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="form-group">
                    <label for="objectif_actuel">Objectif *</label>
                    <select name="objectif_actuel" id="objectif_actuel" onchange="changerObjectif()" required>
                        <option value="">-- Sélectionnez un objectif --</option>
                        <option value="reduire">📉 Réduire le poids</option>
                        <option value="augmenter">📈 Augmenter le poids</option>
                        <option value="imc_ideal">✨ Atteindre le poids idéal</option>
                    </select>
                </div>
                
                <div id="div_valeur_objectif" style="display: none;">
                    <div class="form-group">
                        <label id="label_valeur_objectif" for="valeur_objectif">Valeur *</label>
                        <input type="number" step="0.01" name="valeur_objectif" id="valeur_objectif" min="0.1">
                    </div>
                </div>

                <div class="actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">Terminer l'inscription ✓</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function changerObjectif() {
            var selectObj = document.getElementById('objectif_actuel');
            var divValeur = document.getElementById('div_valeur_objectif');
            var inputValeur = document.getElementById('valeur_objectif');
            var labelValeur = document.getElementById('label_valeur_objectif');
            
            var poidsIdeal = <?= !empty($poidsIdeal) ? json_encode(number_format($poidsIdeal, 2, '.', '')) : 'null' ?>;

            if (selectObj.value === 'reduire') {
                divValeur.style.display = 'block';
                labelValeur.innerHTML = 'Poids à perdre :';
                inputValeur.value = '';
                inputValeur.readOnly = false;
                inputValeur.required = true;
            } else if (selectObj.value === 'augmenter') {
                divValeur.style.display = 'block';
                labelValeur.innerHTML = 'Poids à gagner :';
                inputValeur.value = '';
                inputValeur.readOnly = false;
                inputValeur.required = true;
            } else if (selectObj.value === 'imc_ideal') {
                divValeur.style.display = 'block';
                labelValeur.innerHTML = 'Poids idéal visé :';
                inputValeur.value = poidsIdeal;
                inputValeur.readOnly = true; // Empêche l'édition manuelle car pre-calc.
                inputValeur.required = false;
            } else {
                divValeur.style.display = 'none';
                inputValeur.required = false;
            }
        }
    </script>
<?= $this->endSection() ?>