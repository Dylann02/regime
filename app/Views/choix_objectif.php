<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Choix de l'objectif</title>
</head>
<body>
    <div class="objectif-container">
        <h2>Informations de santé</h2>
        
        <div class="info"><strong>Poids actuel :</strong> <?= esc($utilisateur['poids_actuel']) ?> kg</div>
        
        <?php if (!empty($imc)): ?>
            <div class="info"><strong>Votre IMC :</strong> <?= number_format($imc, 2) ?></div>
        <?php endif; ?>

        <?php if (!empty($poidsIdeal)): ?>
            <div class="info"><strong>Votre poids idéal :</strong> <?= number_format($poidsIdeal, 2) ?> kg</div>
        <?php endif; ?>

        <h3>Choisissez votre objectif</h3>
        <form action="<?= base_url('inscription/save_objectif') ?>" method="post">
            <?= csrf_field() ?>
            <div>
                <label for="objectif_actuel">Objectif :</label>
                <select name="objectif_actuel" id="objectif_actuel" onchange="changerObjectif()" required>
                    <option value="">-- Sélectionnez un objectif --</option>
                    <option value="reduire">Réduire le poids</option>
                    <option value="augmenter">Augmenter le poids</option>
                    <option value="imc_ideal">Atteindre le poids idéal</option>
                </select>
            </div>
            
            <div id="div_valeur_objectif" style="margin-top: 15px; display: none;">
                <label id="label_valeur_objectif" for="valeur_objectif">Valeur :</label>
                <input type="number" step="0.01" name="valeur_objectif" id="valeur_objectif" min="0.1">
                <span> kg</span>
            </div>
            
            <div style="margin-top: 20px;">
                <button type="submit">Terminer l'inscription</button>
            </div>
        </form>
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
</body>
</html>