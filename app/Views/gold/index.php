<?php $title = 'Option Gold' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 600px;">
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

        <div class="chart-container">
            <h2 style="margin-top: 0; color: var(--secondary);">Avantages de l'option Gold</h2>
            <ul style="list-style: none; padding: 0; margin-bottom: 2rem;">
                <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-light);"><span style="color: var(--secondary); font-weight: 600;">✨ 15%</span> de réduction sur tous les régimes</li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-light);">Accès prioritaire aux nouveaux régimes</li>
                <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--border-light);">Support client premium</li>
                <li style="padding: 0.75rem 0;">Historique illimité de vos suivis</li>
            </ul>

            <div class="stat-card gold mb-3">
                <div class="stat-label">Prix de l'option Gold</div>
                <div class="stat-value"><?= number_format($goldPrice, 0, ',', ' ') ?></div>
                <div class="stat-unit">Ar</div>
            </div>

            <div class="stat-card info mb-3">
                <div class="stat-label">Solde disponible</div>
                <div class="stat-value"><?= number_format($utilisateur['solde'] ?? 0, 0, ',', ' ') ?></div>
                <div class="stat-unit">Ar</div>
            </div>

            <?php if (!empty($utilisateur['est_gold'])): ?>
                <div class="message success" style="text-align: center; font-weight: 600;">
                    ✅ Vous êtes déjà membre Gold!
                </div>
            <?php else: ?>
                <form action="<?= base_url('gold/activer') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Passer à Gold</button>
                        <a href="<?= base_url('profil') ?>" class="btn btn-secondary" style="text-decoration: none; text-align: center;">Annuler</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>
