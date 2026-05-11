<?php $title = 'Suggestions de Régimes' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

<div class="suggestions-container">
    <?php if (session()->getFlashdata('error')): ?>
        <div class="message error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
        <div class="message success">
             <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <!-- Section: Résumé Objectif -->
    <div class="suggestions-section">
        <h3>Résumé de votre objectif</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <span class="stat-label">Poids actuel</span>
                <span class="stat-value"><?= number_format($utilisateur['poids_actuel'], 1) ?></span>
                <span class="stat-unit">kg</span>
            </div>
            <div class="stat-item success">
                <span class="stat-label">Poids cible</span>
                <span class="stat-value"><?= number_format($donneesCalcul['poids_cible'], 1) ?></span>
                <span class="stat-unit">kg</span>
            </div>
            <div class="stat-item gold">
                <span class="stat-label">Variation nécessaire</span>
                <span class="stat-value"><?= number_format(abs($donneesCalcul['delta_kg']), 1) ?></span>
                <span class="stat-unit">kg</span>
            </div>
            <div class="stat-item">
                <span class="stat-label">Direction</span>
                <span class="stat-value">
                    <?php if ($donneesCalcul['direction'] == 'reduire'): ?>
                        🔥 Réduire
                    <?php elseif ($donneesCalcul['direction'] == 'augmenter'): ?>
                        🌱 Augmenter
                    <?php else: ?>
                        ⚖️ Maintenir
                    <?php endif; ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Section: Régimes Adaptés -->
    <div class="suggestions-section">
        <h2>Régimes adaptés à votre objectif</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 20px;">
            <?php foreach ($suggestions as $regime): ?>
                <div class="regime-suggestion-card">
                    <h4><?= esc($regime['nom']) ?></h4>
                    <p><?= esc($regime['description']) ?></p>
                    
                    <div class="regime-details">
                        <div class="regime-detail-item">
                            <strong>Variation</strong>
                            <div class="value"><?= $regime['variation_kg_semaine'] ?> kg/sem</div>
                        </div>
                        <div class="regime-detail-item">
                            <strong>Durée estimée</strong>
                            <div class="value"><?= $regime['duree_calculee'] ?> sem</div>
                        </div>
                    </div>

                    <div class="regime-price-section">
                        <div class="price-item">
                            <span>Prix de base:</span>
                            <span class="price-value"><?= number_format($regime['prix_base'], 0, ',', ' ') ?> Ar</span>
                        </div>
                        <?php if (!empty($regime['remise_gold']) && $regime['remise_gold'] > 0): ?>
                            <div class="price-item">
                                <span>Remise Gold:</span>
                                <span class="price-value">-<?= number_format($regime['remise_gold'], 0, ',', ' ') ?> Ar</span>
                            </div>
                            <div class="final-price">
                                <span>Prix final:</span>
                                <span><?= number_format($regime['prix_final'], 0, ',', ' ') ?> Ar</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="regime-form-section">
                        <form action="<?= base_url('souscrire') ?>" method="post">
                            <?= csrf_field() ?>
                            <input type="hidden" name="regime_id" value="<?= $regime['id'] ?>">
                            
                            <div class="form-group">
                                <label for="activite_<?= $regime['id'] ?>">Activité sportive</label>
                                <select name="activite_id" id="activite_<?= $regime['id'] ?>" required>
                                    <option value="" disabled selected>-- Sélectionner --</option>
                                    <?php foreach ($activites as $activite): ?>
                                        <option value="<?= $activite['id'] ?>">
                                            <?= $activite['nom'] ?> (<?= ucfirst($activite['intensite']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="regime-actions">
                                <button type="submit" class="btn btn-primary">Souscrire</button>
                                <button type="submit" formaction="<?= base_url('suggestions/export-pdf') ?>" formmethod="post" class="btn secondary">PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Section: Activités Sportives -->
    <div class="suggestions-section">
        <h2> Activités sportives recommandées</h2>
        <p style="color: #666; margin-bottom: 20px; font-size: 0.95rem;">
            Pour accompagner votre régime, voici les activités recommandées 
            <strong style="color: var(--primary-color);">
                <?php 
                    if ($donneesCalcul['direction'] == 'reduire') {
                        echo '(🔥 Intensité: Intense)';
                    } elseif ($donneesCalcul['direction'] == 'augmenter') {
                        echo '(🌱 Intensité: Faible)';
                    } else {
                        echo '(⚖️ Intensité: Modérée)';
                    }
                ?>
            </strong>
        </p>
        <div class="activites-grid">
            <?php foreach ($activites as $activite): ?>
                <div class="activite-suggestion-card">
                    <h4><?= esc($activite['nom']) ?></h4>
                    <p><?= esc($activite['description']) ?></p>
                    <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #e0e0e0;">
                        <span class="badge">
                            Intensité: <strong><?= ucfirst(esc($activite['intensite'])) ?></strong>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
