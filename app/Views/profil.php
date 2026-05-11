<?php $title = 'Profil utilisateur' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

<div class="profile-container">
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
        <div class="profile-header">
            <h2>Profil de <?= esc($utilisateur['prenom']) ?> <?= esc($utilisateur['nom']) ?></h2>
        </div>

        <!-- Section: Informations Personnelles -->
        <div class="profile-section">
            <h3>Informations Personnelles</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Nom</strong>
                    <div class="value"><?= esc($utilisateur['nom']) ?></div>
                </div>
                <div class="info-item">
                    <strong>Prénom</strong>
                    <div class="value"><?= esc($utilisateur['prenom']) ?></div>
                </div>
                <div class="info-item">
                    <strong>Email</strong>
                    <div class="value" style="font-size: 0.95rem; word-break: break-all;"><?= esc($utilisateur['email']) ?></div>
                </div>
                <div class="info-item">
                    <strong>Genre</strong>
                    <div class="value"><?= ucfirst(esc($utilisateur['genre'])) ?></div>
                </div>
                <div class="info-item">
                    <strong>Date de naissance</strong>
                    <div class="value" style="font-size: 1rem;"><?= esc($utilisateur['date_naissance']) ?></div>
                </div>
            </div>
        </div>

        <!-- Section: Informations Physiques -->
        <div class="profile-section">
            <h3>Informations Physiques</h3>
            <div class="info-grid">
                <div class="info-item">
                    <strong>Taille</strong>
                    <div class="value"><?= esc($utilisateur['taille_cm']) ?> cm</div>
                </div>
                <div class="info-item">
                    <strong>Poids actuel</strong>
                    <div class="value"><?= esc($utilisateur['poids_actuel']) ?> kg</div>
                </div>
                <?php if (!empty($imc)): ?>
                    <div class="info-item">
                        <strong>IMC</strong>
                        <div class="value"><?= number_format($imc, 2) ?></div>
                    </div>
                <?php endif; ?>
                <div class="info-item">
                    <strong>Objectif</strong>
                    <div class="value" style="font-size: 0.95rem;"><?= esc($utilisateur['objectif_actuel'] ?? 'Non défini') ?></div>
                </div>
            </div>
        </div>

        <!-- Section: Compte -->
        <div class="profile-section">
            <h3>Compte</h3>
            <div class="info-grid">
                <div class="info-item" style="border-left-color: #27ae60;">
                    <strong>Solde</strong>
                    <div class="value" style="color: #27ae60;"><?= number_format($utilisateur['solde'] ?? 0, 2) ?> €</div>
                </div>
                <div class="info-item" style="border-left-color: #ffc107;">
                    <strong>Statut Gold</strong>
                    <div class="value" style="color: #ffc107; font-size: 1rem;">
                        <?= ($utilisateur['est_gold'] ?? 0) ? ' Actif' : ' Inactif' ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section: Actions -->
        <div class="profile-section">
            <h3>Actions</h3>
            <div class="profile-actions">
                <a href="<?= base_url('profil/modifier') ?>" class="btn btn-primary">Modifier profil</a>
                <a href="<?= base_url('suggestions') ?>" class="btn btn-primary">Voir suggestions</a>
                <a href="<?= base_url('gold') ?>" class="btn btn-primary">Passer à Gold</a>
                <a href="<?= base_url('ajoutArgent') ?>" class="btn btn-primary">Ajouter crédit</a>
                <a href="<?= base_url('logout') ?>" class="btn logout-btn">Déconnexion</a>
            </div>
        </div>

    <?php else: ?>
        <div class="card" style="text-align: center; padding: 40px;">
            <h3 style="color: #e74c3c; margin: 0;">Utilisateur introuvable</h3>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>