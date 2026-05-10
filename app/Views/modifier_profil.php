<?php $title = 'Modifier profil' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <?php
        $utilisateur = $utilisateur ?? [];
        $erreurs = $erreurs ?? [];
        $poidsIdeal = $poidsIdeal ?? null;
        $objectifActuel = old('objectif_actuel', $utilisateur['objectif_actuel'] ?? '');
        $valeurObjectif = old('valeur_objectif', $utilisateur['valeur_objectif'] ?? '');
    ?>
    <div class="container" style="max-width: 700px;">
        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0): ?>
            <div class="message error">
                <div style="font-weight: 600; margin-bottom: 0.5rem;">❌ Erreurs détectées:</div>
                <?php foreach ($erreurs as $message): ?>
                    <div>• <?= esc(is_array($message) ? implode(' ', $message) : $message) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <form action="<?= base_url('profil/modifier') ?>" method="post">
                <?= csrf_field() ?>

                <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem; color: var(--primary);">👤 Informations Personnelles</h3>

                <div class="form-group">
                    <label for="nom">Nom *</label>
                    <input type="text" id="nom" name="nom" value="<?= esc(old('nom', $utilisateur['nom'] ?? '')) ?>" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom *</label>
                    <input type="text" id="prenom" name="prenom" value="<?= esc(old('prenom', $utilisateur['prenom'] ?? '')) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="<?= esc(old('email', $utilisateur['email'] ?? '')) ?>" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre *</label>
                    <select id="genre" name="genre" required>
                        <option value="homme" <?= old('genre', $utilisateur['genre'] ?? '') === 'homme' ? 'selected' : '' ?>>Homme</option>
                        <option value="femme" <?= old('genre', $utilisateur['genre'] ?? '') === 'femme' ? 'selected' : '' ?>>Femme</option>
                        <option value="autre" <?= old('genre', $utilisateur['genre'] ?? '') === 'autre' ? 'selected' : '' ?>>Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date_naissance">Date de naissance *</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="<?= esc(old('date_naissance', $utilisateur['date_naissance'] ?? '')) ?>" required>
                </div>

                <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem; margin-top: 2rem; color: var(--primary);">⚖️ Données Physiques</h3>

                <div class="form-group">
                    <label for="taille_cm">Taille (cm) *</label>
                    <input type="number" id="taille_cm" step="0.01" name="taille_cm" value="<?= esc(old('taille_cm', $utilisateur['taille_cm'] ?? '')) ?>" required>
                </div>

                <div class="form-group">
                    <label for="poids_actuel">Poids (kg) *</label>
                    <input type="number" id="poids_actuel" step="0.01" name="poids_actuel" value="<?= esc(old('poids_actuel', $utilisateur['poids_actuel'] ?? '')) ?>" required>
                </div>

                <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem; margin-top: 2rem; color: var(--primary);">🎯 Objectif</h3>

                <div class="form-group">
                    <label for="objectif_actuel">Objectif *</label>
                    <select id="objectif_actuel" name="objectif_actuel" onchange="changerObjectif()" required>
                        <option value="">-- Sélectionnez un objectif --</option>
                        <option value="reduire" <?= $objectifActuel === 'reduire' ? 'selected' : '' ?>>📉 Réduire le poids</option>
                        <option value="augmenter" <?= $objectifActuel === 'augmenter' ? 'selected' : '' ?>>📈 Augmenter le poids</option>
                        <option value="imc_ideal" <?= $objectifActuel === 'imc_ideal' ? 'selected' : '' ?>>✨ Atteindre le poids idéal</option>
                    </select>
                </div>

                <div class="form-group" id="div_valeur_objectif" style="display: none;">
                    <label id="label_valeur_objectif" for="valeur_objectif">Valeur objectif</label>
                    <input type="number" step="0.01" name="valeur_objectif" id="valeur_objectif" min="0.1" value="<?= esc($valeurObjectif) ?>">
                    <small style="color: var(--text-light);"><span id="suffixe_valeur">kg</span></small>
                </div>

                <div class="actions" style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">💾 Enregistrer les modifications</button>
                    <a href="<?= base_url('profil') ?>" class="btn btn-secondary" style="text-decoration: none; text-align: center;">Annuler</a>
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
            var suffixeValeur = document.getElementById('suffixe_valeur');
            var poidsIdeal = <?= $poidsIdeal !== null ? json_encode(number_format((float) $poidsIdeal, 2, '.', '')) : 'null' ?>;

            if (selectObj.value === 'reduire') {
                divValeur.style.display = 'block';
                labelValeur.innerHTML = 'Poids à perdre :';
                suffixeValeur.innerHTML = 'kg';
                inputValeur.readOnly = false;
                inputValeur.required = true;
            } else if (selectObj.value === 'augmenter') {
                divValeur.style.display = 'block';
                labelValeur.innerHTML = 'Poids à gagner :';
                suffixeValeur.innerHTML = 'kg';
                inputValeur.readOnly = false;
                inputValeur.required = true;
            } else if (selectObj.value === 'imc_ideal') {
                divValeur.style.display = 'block';
                labelValeur.innerHTML = 'Poids idéal visé :';
                suffixeValeur.innerHTML = 'kg';
                inputValeur.value = poidsIdeal ?? inputValeur.value;
                inputValeur.readOnly = true;
                inputValeur.required = false;
            } else {
                divValeur.style.display = 'none';
                inputValeur.required = false;
                inputValeur.readOnly = false;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            changerObjectif();
        });
    </script>
<?= $this->endSection() ?>
