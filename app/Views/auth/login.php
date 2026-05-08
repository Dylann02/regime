<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>

        <?php if (isset($erreur)): ?>
            <div class="error">
                <?= esc($erreur) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($erreurs) && is_array($erreurs)): ?>
            <div class="error">
                <?php foreach ($erreurs as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= set_value('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe (minimum 8 caractères)</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>

        <div class="links">
            <a href="<?= base_url('inscription') ?>">S'inscrire</a>
        </div>
    </div>
</body>
</html>
