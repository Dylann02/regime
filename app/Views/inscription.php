<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 1</title>
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

        <div style="background: linear-gradient(135deg, #e8f5e9 0%, #d4edda 100%); padding: 16px; border-radius: 8px; margin-bottom: 20px; text-align: center; color: #2e7d32; font-weight: 600; border-left: 4px solid #4caf50;">
            Étape 1 / 2 - Informations personnelles
        </div>

        <div class="card">
            <h2 style="margin-top:0; color:#333; text-align:center; margin-bottom:24px;">Créez votre compte</h2>
            
            <form action="<?= base_url('inscription/store') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nom">Nom *</label>
                        <input type="text" id="nom" name="nom" placeholder="ex: Dupont" value="<?= set_value('nom') ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prénom *</label>
                        <input type="text" id="prenom" name="prenom" placeholder="ex: Jean" value="<?= set_value('prenom') ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" value="<?= set_value('email') ?>" required>
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">Mot de passe *</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Minimum 8 caractères" required>
                    <small style="color: #999; display: block; margin-top: 4px;">Au moins 8 caractères pour sécuriser votre compte</small>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="genre">Genre *</label>
                        <select id="genre" name="genre" required>
                            <option value="">-- Choisir --</option>
                            <option value="homme" <?= set_select('genre', 'homme') ?>>Homme</option>
                            <option value="femme" <?= set_select('genre', 'femme') ?>>Femme</option>
                            <option value="autre" <?= set_select('genre', 'autre') ?>>Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="date_naissance">Date de naissance *</label>
                        <input type="date" id="date_naissance" name="date_naissance" value="<?= set_value('date_naissance') ?>" required>
                    </div>
                </div>

                <div class="actions" style="margin-top: 24px; justify-content: center;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-size: 1rem;">Continuer</button>
                </div>
            </form>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f0f0f0; text-align: center;">
                <p style="margin:0; color:#666;">Vous avez déjà un compte? <a href="<?= base_url('login') ?>" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html>