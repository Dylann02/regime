<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Suggestions de Régimes</title>
</head>
<body>
    <h1>Nos suggestions pour votre objectif</h1>

    <?php if (session()->getFlashdata('error')): ?>
        <p style="color: red;"><strong><?= session()->getFlashdata('error') ?></strong></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <p style="color: green;"><strong><?= session()->getFlashdata('success') ?></strong></p>
    <?php endif; ?>

    <div class="resume-objectif">
        <p>Poids actuel : <?= number_format($utilisateur['poids_actuel'], 2) ?> kg</p>
        <p>Poids cible : <?= number_format($donneesCalcul['poids_cible'], 2) ?> kg</p>
        <p>Variation nécessaire : <?= number_format($donneesCalcul['delta_kg'], 2) ?> kg</p>
    </div>

    <h2>Régimes adaptés</h2>
    <div class="regimes-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($suggestions as $regime): ?>
            <div class="card" style="border: 1px solid #ccc; padding: 15px; width: 300px; border-radius: 8px;">
                <h3><?= $regime['nom'] ?></h3>
                <p><?= $regime['description'] ?></p>
                <p><strong>Variation :</strong> <?= $regime['variation_kg_semaine'] ?> kg/semaine</p>
                <p><strong>Durée estimée :</strong> <?= $regime['duree_calculee'] ?> semaines</p>
                <p><strong>Prix :</strong> <?= number_format($regime['prix_base'], 0, ',', ' ') ?> Ar</p>
                <?php if (!empty($regime['remise_gold']) && $regime['remise_gold'] > 0): ?>
                    <p><strong>Remise Gold :</strong> -<?= number_format($regime['remise_gold'], 0, ',', ' ') ?> Ar</p>
                    <p><strong>Prix final :</strong> <?= number_format($regime['prix_final'], 0, ',', ' ') ?> Ar</p>
                <?php endif; ?>
                
                <form action="<?= base_url('souscrire') ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                    <label for="activite_<?= $regime['id'] ?>">Choisir une activité :</label>
                    <select name="activite_id" id="activite_<?= $regime['id'] ?>" required>
                        <option value="" disabled selected>-- Sélectionner --</option>
                        <?php foreach ($activites as $activite): ?>
                            <option value="<?= $activite['id'] ?>">
                                <?= $activite['nom'] ?> (<?= ucfirst($activite['intensite']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit">Choisir ce régime</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <h2>Activités sportives recommandées</h2>
    <p>Pour accompagner votre régime, nous vous conseillons les activités suivantes (Intensité : <?= $donneesCalcul['direction'] == 'reduire' ? 'Intense' : ($donneesCalcul['direction'] == 'augmenter' ? 'Faible' : 'Modérée') ?>) :</p>
    <div class="activites-container" style="display: flex; flex-wrap: wrap; gap: 20px;">
        <?php foreach ($activites as $activite): ?>
            <div class="card" style="border: 1px solid #eee; padding: 15px; width: 250px; border-radius: 8px; background-color: #fafafa;">
                <h4><?= $activite['nom'] ?></h4>
                <p><?= $activite['description'] ?></p>
                <p><small>Intensité: <?= ucfirst($activite['intensite']) ?></small></p>
            </div>
        <?php endforeach; ?>
    </div>

    <p><a href="<?= base_url('profil') ?>">Retour au profil</a></p>
</body>
</html>
