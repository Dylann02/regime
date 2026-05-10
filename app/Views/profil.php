<?php $title = 'Profil utilisateur' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="message success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <?php if (isset($message)): ?>
            <div class="message success">
                <?= esc($message) ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($utilisateur)): ?>
            <div class="chart-container mb-4">
                <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem;">📋 Informations Personnelles</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div class="stat-card">
                        <div class="stat-label">Nom</div>
                        <div style="font-size: 1.3rem; font-weight: 600; color: var(--text-primary);"><?= esc($utilisateur['nom']) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Prénom</div>
                        <div style="font-size: 1.3rem; font-weight: 600; color: var(--text-primary);"><?= esc($utilisateur['prenom']) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Genre</div>
                        <div style="font-size: 1.3rem; font-weight: 600; color: var(--text-primary);"><?= ucfirst(esc($utilisateur['genre'])) ?></div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-label">Date de naissance</div>
                        <div style="font-size: 1.3rem; font-weight: 600; color: var(--text-primary);"><?= esc($utilisateur['date_naissance']) ?></div>
                    </div>
                </div>
            </div>

            <div class="chart-container mb-4">
                <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem;">⚖️ Données Physiques</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div class="stat-card success">
                        <div class="stat-label">Taille</div>
                        <div class="stat-value"><?= esc($utilisateur['taille_cm']) ?></div>
                        <div class="stat-unit">cm</div>
                    </div>
                    <div class="stat-card gold">
                        <div class="stat-label">Poids Actuel</div>
                        <div class="stat-value"><?= esc($utilisateur['poids_actuel']) ?></div>
                        <div class="stat-unit">kg</div>
                    </div>
                    <?php if (!empty($imc)): ?>
                    <div class="stat-card info">
                        <div class="stat-label">IMC</div>
                        <div class="stat-value"><?= number_format($imc, 1) ?></div>
                        <div class="stat-unit">indice</div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="chart-container mb-4">
                <h3 style="border-bottom: 3px solid var(--primary); padding-bottom: 1rem; margin-bottom: 1.5rem;">🎯 Objectif & Statut</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem;">
                    <div class="stat-card">
                        <div class="stat-label">Objectif</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--primary);">
                            <?php
                                $obj = $utilisateur['objectif_actuel'] ?? 'Non défini';
                                $icons = ['reduire' => '📉', 'augmenter' => '📈', 'imc_ideal' => '✨'];
                                echo ($icons[$obj] ?? '❓') . ' ' . ucfirst(str_replace('_', ' ', $obj));
                            ?>
                        </div>
                    </div>
                    <div class="stat-card gold">
                        <div class="stat-label">Statut Gold</div>
                        <div style="font-size: 1.1rem; font-weight: 600; color: var(--secondary);">
                            <?= ($utilisateur['est_gold'] ?? 0) ? '⭐ Oui (Actif)' : '⭕ Non' ?>
                        </div>
                    </div>
                    <div class="stat-card success">
                        <div class="stat-label">Solde Disponible</div>
                        <div class="stat-value" style="color: var(--success);"><?= number_format($utilisateur['solde'] ?? 0, 2) ?></div>
                        <div class="stat-unit">€</div>
                    </div>
                </div>
            </div>

            <div class="actions mb-4">
                <a href="<?= base_url('profil/modifier') ?>" class="btn btn-primary"> Modifier profil</a>
                <a href="<?= base_url('suggestions') ?>" class="btn btn-secondary"> Suggestions de régime</a>
                <a href="<?= base_url('gold') ?>" class="btn btn-primary">Option Gold</a>
                <a href="<?= base_url('ajoutArgent') ?>" class="btn btn-secondary"> Ajouter du crédit</a>
            </div>
        <?php else: ?>
            <div class="message error">
                 Utilisateur introuvable.
            </div>
        <?php endif; ?>
    </div>
<?= $this->endSection() ?>