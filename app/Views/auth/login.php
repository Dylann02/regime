<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
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
        <?php if (isset($erreur)): ?>
            <div class="message error">
                ❌ <?= esc($erreur) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($erreurs) && is_array($erreurs)): ?>
            <div class="message error">
                <div style="font-weight: 600; margin-bottom: 0.5rem;">❌ Erreurs détectées:</div>
                <?php foreach ($erreurs as $error): ?>
                    <div>• <?= esc($error) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <h2 style="margin-top:0; color:#333; text-align:center; margin-bottom:20px;">Connexion à votre compte</h2>
            
            <form action="<?= base_url('login') ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="email">📧 Email *</label>
                    <input type="email" id="email" name="email" placeholder="votre@email.com" value="<?= set_value('email') ?>" required>
                </div>

                <div class="form-group">
                    <label for="mot_de_passe">🔐 Mot de passe *</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez votre mot de passe" required>
                </div>

                <div class="actions" style="margin-top: 24px; justify-content: center;">
                    <button type="submit" class="btn btn-primary" style="padding: 12px 24px; font-size: 1rem;">✓ Se Connecter</button>
                </div>
            </form>

            <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #f0f0f0; text-align: center;">
                <p style="margin:0; color:#666;">Pas encore de compte? <a href="<?= base_url('inscription') ?>" style="color: var(--primary-color); font-weight: 600; text-decoration: none;">S'inscrire maintenant →</a></p>
            </div>
        </div>
    </div>
</body>
</html>
