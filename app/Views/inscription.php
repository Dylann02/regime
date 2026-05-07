<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription - Étape 1</title>
</head>
<body>
    <h2>Inscription - Étape 1</h2>

    <?php if (isset($validation)): ?>
        <div style="color:red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('inscription/store') ?>" method="post">
        <?= csrf_field() ?>

        <label>Nom</label><br>
        <input type="text" name="nom" value="<?= set_value('nom') ?>"><br><br>

        <label>Prénom</label><br>
        <input type="text" name="prenom" value="<?= set_value('prenom') ?>"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="<?= set_value('email') ?>"><br><br>

        <label>Mot de passe</label><br>
        <input type="password" name="mot_de_passe"><br><br>

        <label>Genre</label><br>
        <select name="genre">
            <option value="">-- Choisir --</option>
            <option value="homme" <?= set_select('genre', 'homme') ?>>Homme</option>
            <option value="femme" <?= set_select('genre', 'femme') ?>>Femme</option>
            <option value="autre" <?= set_select('genre', 'autre') ?>>Autre</option>
        </select><br><br>

        <label>Date de naissance</label><br>
        <input type="date" name="date_naissance" value="<?= set_value('date_naissance') ?>"><br><br>

        <button type="submit">Suivant</button>
    </form>
</body>
</html>