<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de l'objectif</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
    <style>
        .login-page { display:flex; flex-direction:column; align-items:center; justify-content:center; min-height:100vh; padding:20px; }
        .login-logo { margin-bottom:40px; text-align:center; }
        .login-logo img { height:60px; }
        .login-form { max-width:500px; width:100%; }
        .login-form .card { box-shadow:0 8px 24px rgba(0,0,0,0.12); }
    </style>
</head>
<body style="padding-top:0;">
    <div class="login-page">
        <div class="login-logo">
            <a href="<?= base_url('/') ?>"><img src="<?= base_url('logo.png') ?>" alt="logo" /></a>
        </div>
        
        <div class="login-form">
            <div class="container">
                <div style="background: linear-gradient(135deg, #e3f2fd 0%, #d1ecf1 100%); padding: 16px; border-radius: 8px; margin-bottom: 20px; text-align: center; color: #1565c0; font-weight: 600; border-left: 4px solid #2196f3;">
                    Finalisation - Choisissez votre objectif
                </div>

                <div class="card">
                    <h2 style="margin-top:0; color:#333; text-align:center; margin-bottom:24px;">📊 Informations de santé</h2>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                        <div style="text-align: center; padding: 15px; background: #f5f5f5; border-radius: 8px;">
                            <div style="color: #666; font-size: 0.9rem; margin-bottom: 0.5rem;">Poids actuel</div>
                            <div style="font-size: 1.5rem; font-weight: bold; color: var(--primary);"><?= esc($utilisateur['poids_actuel']) ?></div>
                            <div style="color: #999; font-size: 0.85rem;">kg</div>
                        </div>
                        
                        <?php if (!empty($imc)): ?>
                            <div style="text-align: center; padding: 15px; background: #e3f2fd; border-radius: 8px;">
                                <div style="color: #666; font-size: 0.9rem; margin-bottom: 0.5rem;">Votre IMC</div>
                                <div style="font-size: 1.5rem; font-weight: bold; color: #1976d2;"><?= number_format($imc, 1) ?></div>
                                <div style="color: #999; font-size: 0.85rem;">indice</div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($poidsIdeal)): ?>
                            <div style="text-align: center; padding: 15px; background: #e8f5e9; border-radius: 8px;">
                                <div style="color: #666; font-size: 0.9rem; margin-bottom: 0.5rem;">Poids idéal</div>
                                <div style="font-size: 1.5rem; font-weight: bold; color: #388e3c;"><?= number_format($poidsIdeal, 1) ?></div>
                                <div style="color: #999; font-size: 0.85rem;">kg</div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <h3 style="margin-top: 0; color: #333; margin-bottom: 1.5rem;">Choisissez votre objectif</h3>
                    
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

                        <div class="actions" style="margin-top: 2rem; justify-content: center;">
                            <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-size: 1rem;">Terminer l'inscription ✓</button>
                        </div>
                    </form>
                </div>
            </div>
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