<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix de l'objectif</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
    <style>
        body { margin: 0; padding: 0; background: linear-gradient(135deg, #f9f3e6 0%, #f5ead0 100%); min-height: 100vh; }
        .login-page { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh; padding: 20px; }
        .login-logo { margin-bottom: 40px; text-align: center; }
        .login-logo img { height: 60px; }
        .login-form { max-width: 800px; width: 100%; }
        .card { box-shadow: 0 8px 24px rgba(0,0,0,0.12); }
        
        .objective-container { 
            background: #fff; 
            border-radius: 12px; 
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        }
        
        .objective-header {
            background: linear-gradient(135deg, #c85a3a 0%, #a84630 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .objective-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            color: white;
        }
        
        .objective-header p {
            margin: 0;
            font-size: 1rem;
            opacity: 0.95;
        }
        
        .health-info-section {
            padding: 40px;
            background: #fafbfc;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .health-info-section h2 {
            margin-top: 0;
            color: #333;
            text-align: center;
            margin-bottom: 24px;
            font-size: 1.3rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            text-align: center;
        }
        
        .stat-card.info {
            background: linear-gradient(135deg, #e3f2fd 0%, #d1ecf1 100%);
        }
        
        .stat-card.success {
            background: linear-gradient(135deg, #e8f5e9 0%, #d4edda 100%);
        }
        
        .stat-label {
            font-size: 0.85rem;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #c85a3a;
            margin-bottom: 4px;
        }
        
        .stat-unit {
            font-size: 0.9rem;
            color: #aaa;
        }
        
        .objectives-form-section {
            padding: 40px;
        }
        
        .objectives-form-section h3 {
            margin-top: 0;
            color: #333;
            font-size: 1.2rem;
            margin-bottom: 24px;
            text-align: center;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }
        
        .form-group select,
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }
        
        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: #c85a3a;
            box-shadow: 0 0 0 3px rgba(200, 90, 59, 0.1);
        }
        
        .actions {
            display: flex;
            justify-content: center;
            margin-top: 28px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #c85a3a 0%, #a84630 100%);
            color: white;
            padding: 12px 32px;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(200, 90, 59, 0.3);
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-logo">
            <a href="<?= base_url('/') ?>"><img src="<?= base_url('logo.png') ?>" alt="logo" /></a>
        </div>
        
        <div class="login-form">
            <div class="objective-container">
                <!-- Header -->
                <div class="objective-header">
                    <h1>Définissez votre objectif</h1>
                    <p>Exprimez votre objectif personnel pour optimiser votre suivi</p>
                </div>
                
                <!-- Health Info Section -->
                <div class="health-info-section">
                    <h2>📊 Vos informations de santé</h2>
                    <div class="stats-grid">
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
                
                <!-- Form Section -->
                <div class="objectives-form-section">
                    <h3>Choisissez votre objectif</h3>
                    
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

                        <div class="actions">
                            <button type="submit" class="btn-primary">Terminer l'inscription ✓</button>
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
                inputValeur.readOnly = true;
                inputValeur.required = false;
            } else {
                divValeur.style.display = 'none';
                inputValeur.required = false;
            }
        }
    </script>
</body>
</html>