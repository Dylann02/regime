<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 2</title>
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
        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0): ?>
            <div class="message error">
                <div style="font-weight: 600; margin-bottom: 0.5rem;">❌ Erreurs détectées:</div>
                <?php foreach ($erreurs as $field => $message): ?>
                    <div>• <?= esc($message) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div style="background: linear-gradient(135deg, #e3f2fd 0%, #d1ecf1 100%); padding: 16px; border-radius: 8px; margin-bottom: 20px; text-align: center; color: #1565c0; font-weight: 600; border-left: 4px solid #2196f3;">
            ⚠️ Étape 2 / 2 - Informations physiques
        </div>

        <div class="card">
            <h2 style="margin-top:0; color:#333; text-align:center; margin-bottom:24px;">Complétez votre profil</h2>
            
            <form action="<?= base_url('inscription/finaliser') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="taille_cm">📏 Taille (cm) *</label>
                    <input type="number" id="taille_cm" step="0.01" name="taille_cm" placeholder="ex: 175" value="<?= set_value('taille_cm') ?>" required>
                </div>

                <div class="form-group" style="margin-bottom: 28px;">
                    <label for="poids_actuel">⚖️ Poids (kg) *</label>
                    <input type="number" id="poids_actuel" step="0.01" name="poids_actuel" placeholder="ex: 75.5" value="<?= set_value('poids_actuel') ?>" required>
                </div>

                <div class="actions" style="margin-top: 28px; justify-content: center;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-size: 1rem;">✓ Finaliser l'inscription</button>
                </div>
            </form>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f0f0f0; text-align: center;">
                <p style="margin:0; color:#666;">Vous avez déjà un compte? <a href="<?= base_url('login') ?>" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>
