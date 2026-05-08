<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Étape 1</title>
</head>
<body>
    <div class="container">
        <h2>Inscription - Étape 1</h2>

        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0): ?>
            <div class="error">
                <?php foreach ($erreurs as $field => $message): ?>
                    <p><?= esc($message) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('inscription/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= set_value('nom') ?>" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?= set_value('prenom') ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= set_value('email') ?>" required>
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe (minimum 8 caractères)</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <select id="genre" name="genre" required>
                    <option value="">-- Choisir --</option>
                    <option value="homme" <?= set_select('genre', 'homme') ?>>Homme</option>
                    <option value="femme" <?= set_select('genre', 'femme') ?>>Femme</option>
                    <option value="autre" <?= set_select('genre', 'autre') ?>>Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_naissance">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" value="<?= set_value('date_naissance') ?>" required>
            </div>

            <button type="submit">Suivant</button>
        </form>

        <div class="links">
            Vous avez déjà un compte? <a href="<?= base_url('login') ?>">Se connecter</a>
        </div>
    </div>
</body>
</html>