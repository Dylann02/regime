<?php $title = 'Suggestions de Régimes' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>


    <div class="container">
        <?php if (session()->getFlashdata('error')): ?>
            <div class="message error">
                ❌ <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="message success">
                ✅ <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="chart-container mb-4">
            <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem;">📊 Résumé de votre objectif</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div class="stat-card">
                    <div class="stat-label">Poids actuel</div>
                    <div class="stat-value"><?= number_format($utilisateur['poids_actuel'], 1) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-label">Poids cible</div>
                    <div class="stat-value"><?= number_format($donneesCalcul['poids_cible'], 1) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
                <div class="stat-card gold">
                    <div class="stat-label">Variation nécessaire</div>
                    <div class="stat-value"><?= abs(number_format($donneesCalcul['delta_kg'], 1)) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
            </div>
        </div>

        <h2 style="border-bottom: 3px solid var(--primary); padding-bottom: 0.75rem; margin-bottom: 1.5rem;">🍽️ Régimes adaptés</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <?php foreach ($suggestions as $regime): ?>
                <div class="chart-container">
                    <h4 style="color: var(--primary); margin-top: 0; margin-bottom: 1rem;"><?= $regime['nom'] ?></h4>
                    <p style="color: var(--text-secondary); margin-bottom: 1rem;"><?= $regime['description'] ?></p>
                    
                    <div style="display: grid; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <div><strong>Variation:</strong> <span style="color: var(--primary);"><?= $regime['variation_kg_semaine'] ?> kg/semaine</span></div>
                        <div><strong>Durée estimée:</strong> <span style="color: var(--primary);"><?= $regime['duree_calculee'] ?> semaines</span></div>
                        <div><strong>Prix:</strong> <span style="color: var(--secondary);"><?= number_format($regime['prix_base'], 0, ',', ' ') ?> Ar</span></div>
                        <?php if (!empty($regime['remise_gold']) && $regime['remise_gold'] > 0): ?>
                            <div>
                                <strong>Remise Gold:</strong> 
                                <span style="color: var(--success);">-<?= number_format($regime['remise_gold'], 0, ',', ' ') ?> Ar</span>
                            </div>
                            <div style="background: var(--primary-light); padding: 0.75rem; border-radius: var(--radius-md); font-weight: 600; color: var(--primary);">
                                Prix final: <?= number_format($regime['prix_final'], 0, ',', ' ') ?> Ar
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="<?= base_url('souscrire') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                        
                        <div class="form-group">
                            <label for="activite_<?= $regime['id'] ?>">Choisir une activité *</label>
                            <select name="activite_id" id="activite_<?= $regime['id'] ?>" required>
                                <option value="" disabled selected>-- Sélectionner --</option>
                                <?php foreach ($activites as $activite): ?>
                                    <option value="<?= $activite['id'] ?>">
                                        <?= $activite['nom'] ?> (<?= ucfirst($activite['intensite']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="actions">
                            <button type="submit" class="btn">Souscrire à ce régime</button>
                            <button type="submit" formaction="<?= base_url('suggestions/export-pdf') ?>" formmethod="post" class="btn secondary">Exporter PDF</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 style="border-bottom: 3px solid var(--primary); padding-bottom: 0.75rem; margin-bottom: 1.5rem;">🏃 Activités sportives recommandées</h2>
        <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
            Pour accompagner votre régime, voici les activités recommandées (Intensité: 
            <strong style="color: var(--primary);">
                <?= $donneesCalcul['direction'] == 'reduire' ? '🔥 Intense' : ($donneesCalcul['direction'] == 'augmenter' ? '🌱 Faible' : '⚖️ Modérée') ?>
            </strong>):
        </p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <?php foreach ($activites as $activite): ?>
                <div class="stat-card success">
                    <h4 style="margin-top: 0; margin-bottom: 0.5rem; color: var(--text-primary);"><?= $activite['nom'] ?></h4>
                    <p style="color: var(--text-secondary); margin: 0.5rem 0; font-size: 0.9rem;"><?= $activite['description'] ?></p>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-light);">
                        <span class="badge success">Intensité: <?= ucfirst($activite['intensite']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

        <div class="chart-container mb-4">
            <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem;">📊 Résumé de votre objectif</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                <div class="stat-card">
                    <div class="stat-label">Poids actuel</div>
                    <div class="stat-value"><?= number_format($utilisateur['poids_actuel'], 1) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
                <div class="stat-card success">
                    <div class="stat-label">Poids cible</div>
                    <div class="stat-value"><?= number_format($donneesCalcul['poids_cible'], 1) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
                <div class="stat-card gold">
                    <div class="stat-label">Variation nécessaire</div>
                    <div class="stat-value"><?= abs(number_format($donneesCalcul['delta_kg'], 1)) ?></div>
                    <div class="stat-unit">kg</div>
                </div>
            </div>
        </div>

        <h2 style="border-bottom: 3px solid var(--primary); padding-bottom: 0.75rem; margin-bottom: 1.5rem;">🍽️ Régimes adaptés</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 1.5rem; margin-bottom: 3rem;">
            <?php foreach ($suggestions as $regime): ?>
                <div class="chart-container">
                    <h4 style="color: var(--primary); margin-top: 0; margin-bottom: 1rem;"><?= $regime['nom'] ?></h4>
                    <p style="color: var(--text-secondary); margin-bottom: 1rem;"><?= $regime['description'] ?></p>
                    
                    <div style="display: grid; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <div><strong>Variation:</strong> <span style="color: var(--primary);"><?= $regime['variation_kg_semaine'] ?> kg/semaine</span></div>
                        <div><strong>Durée estimée:</strong> <span style="color: var(--primary);"><?= $regime['duree_calculee'] ?> semaines</span></div>
                        <div><strong>Prix:</strong> <span style="color: var(--secondary);"><?= number_format($regime['prix_base'], 0, ',', ' ') ?> Ar</span></div>
                        <?php if (!empty($regime['remise_gold']) && $regime['remise_gold'] > 0): ?>
                            <div>
                                <strong>Remise Gold:</strong> 
                                <span style="color: var(--success);">-<?= number_format($regime['remise_gold'], 0, ',', ' ') ?> Ar</span>
                            </div>
                            <div style="background: var(--primary-light); padding: 0.75rem; border-radius: var(--radius-md); font-weight: 600; color: var(--primary);">
                                Prix final: <?= number_format($regime['prix_final'], 0, ',', ' ') ?> Ar
                            </div>
                        <?php endif; ?>
                    </div>

                    <form action="<?= base_url('souscrire') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                        
                        <div class="form-group">
                            <label for="activite_<?= $regime['id'] ?>">Choisir une activité *</label>
                            <select name="activite_id" id="activite_<?= $regime['id'] ?>" required>
                                <option value="" disabled selected>-- Sélectionner --</option>
                                <?php foreach ($activites as $activite): ?>
                                    <option value="<?= $activite['id'] ?>">
                                        <?= $activite['nom'] ?> (<?= ucfirst($activite['intensite']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="actions">
                            <button type="submit" class="btn btn-primary">Souscrire à ce régime</button>
                            <button type="submit" formaction="<?= base_url('suggestions/export-pdf') ?>" formmethod="post" class="btn btn-secondary">Exporter PDF</button>
                        </div>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 style="border-bottom: 3px solid var(--primary); padding-bottom: 0.75rem; margin-bottom: 1.5rem;">🏃 Activités sportives recommandées</h2>
        <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">
            Pour accompagner votre régime, voici les activités recommandées (Intensité: 
            <strong style="color: var(--primary);">
                <?= $donneesCalcul['direction'] == 'reduire' ? '🔥 Intense' : ($donneesCalcul['direction'] == 'augmenter' ? '🌱 Faible' : '⚖️ Modérée') ?>
            </strong>):
        </p>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
            <?php foreach ($activites as $activite): ?>
                <div class="stat-card success">
                    <h4 style="margin-top: 0; margin-bottom: 0.5rem; color: var(--text-primary);"><?= $activite['nom'] ?></h4>
                    <p style="color: var(--text-secondary); margin: 0.5rem 0; font-size: 0.9rem;"><?= $activite['description'] ?></p>
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border-light);">
                        <span class="badge success">Intensité: <?= ucfirst($activite['intensite']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?= $this->endSection() ?>
