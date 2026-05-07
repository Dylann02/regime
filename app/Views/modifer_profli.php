<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier profil</title>
</head>
<body>
    <h2>Modifier profil</h2>

    <?php if (isset($validation)): ?>
        <div style="color:red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="<?= base_url('profil/modifier') ?>" method="post">
        <?= csrf_field() ?>

        <input type="hidden" name="id" value="<?= esc($utilisateur['id']) ?>">

        <label>Nom</label><br>
        <input type="text" name="nom" value="<?= esc($utilisateur['nom']) ?>"><br><br>

        <label>Prénom</label><br>
        <input type="text" name="prenom" value="<?= esc($utilisateur['prenom']) ?>"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="<?= esc($utilisateur['email']) ?>"><br><br>

        <label>Genre</label><br>
        <select name="genre">
            <option value="homme" <?= $utilisateur['genre'] === 'homme' ? 'selected' : '' ?>>Homme</option>
            <option value="femme" <?= $utilisateur['genre'] === 'femme' ? 'selected' : '' ?>>Femme</option>
            <option value="non_binaire" <?= $utilisateur['genre'] === 'non_binaire' ? 'selected' : '' ?>>Non binaire</option>
        </select><br><br>

        <label>Date de naissance</label><br>
        <input type="date" name="date_naissance" value="<?= esc($utilisateur['date_naissance']) ?>"><br><br>

        <label>Taille (cm)</label><br>
        <input type="number" step="0.01" name="taille_cm" value="<?= esc($utilisateur['taille_cm']) ?>"><br><br>

        <label>Poids (kg)</label><br>
        <input type="number" step="0.01" name="poids_actuel" value="<?= esc($utilisateur['poids_actuel']) ?>"><br><br>

        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>