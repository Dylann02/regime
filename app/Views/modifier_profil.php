<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier profil</title>
</head>
<body>
    <div class="container">
        <h2>Modifier profil</h2>

        <?php if (isset($erreurs) && is_array($erreurs) && count($erreurs) > 0): ?>
            <div class="error">
                <?php foreach ($erreurs as $field => $message): ?>
                    <p><?= esc($message) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('profil/modifier') ?>" method="post">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" value="<?= esc($utilisateur['nom']) ?>" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?= esc($utilisateur['prenom']) ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= esc($utilisateur['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <select id="genre" name="genre" required>
                    <option value="homme" <?= $utilisateur['genre'] === 'homme' ? 'selected' : '' ?>>Homme</option>
                    <option value="femme" <?= $utilisateur['genre'] === 'femme' ? 'selected' : '' ?>>Femme</option>
                    <option value="autre" <?= $utilisateur['genre'] === 'autre' ? 'selected' : '' ?>>Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_naissance">Date de naissance</label>
                <input type="date" id="date_naissance" name="date_naissance" value="<?= esc($utilisateur['date_naissance']) ?>" required>
            </div>

            <div class="form-group">
                <label for="taille_cm">Taille (cm)</label>
                <input type="number" id="taille_cm" step="0.01" name="taille_cm" value="<?= esc($utilisateur['taille_cm']) ?>" required>
            </div>

            <div class="form-group">
                <label for="poids_actuel">Poids (kg)</label>
                <input type="number" id="poids_actuel" step="0.01" name="poids_actuel" value="<?= esc($utilisateur['poids_actuel']) ?>" required>
            </div>

            <div class="button-group">
                <button type="submit">Enregistrer</button>
                <a href="<?= base_url('profil') ?>">
                    <button type="button" class="cancel-btn">Annuler</button>
                </a>
                <a href="<?= base_url('dashboard') ?>">
                    <button type="button" class="dashboard-btn">📊 Tableau de Bord</button>
                </a>
            </div>
        </form>
    </div>
</body>
</html>
