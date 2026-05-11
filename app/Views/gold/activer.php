<?php $title = "Activer l'option Gold" ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 600px;">
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

        <div class="chart-container">
            <?php if (!empty($utilisateur['est_gold'])): ?>
                <div style="text-align: center;">
                    <div style="font-size: 3rem; margin-bottom: 1rem;">⭐</div>
                    <h2 style="color: var(--success); margin: 0 0 1rem 0;">Vous êtes membre Gold!</h2>
                    <p style="color: var(--text-secondary); margin-bottom: 2rem;">Vous bénéficiez maintenant de 15% de réduction sur tous les régimes.</p>
                    <a href="<?= base_url('profil') ?>" class="btn">Retour au profil</a>
                </div>
            <?php else: ?>
                <h2 style="margin-top: 0; color: var(--secondary);">Confirmer l'activation Gold</h2>
                
                <div style="margin-bottom: 2rem; padding: 1.5rem; background: var(--primary-light); border-radius: var(--radius-lg); border-left: 4px solid var(--primary);">
                    <div style="margin-bottom: 1rem;">
                        <strong>Prix de l'option Gold:</strong>
                        <div style="font-size: 1.5rem; color: var(--primary); font-weight: 700;">
                            <?= number_format($goldPrice, 0, ',', ' ') ?> Ar
                        </div>
                    </div>
                    <div>
                        <strong>Votre solde actuel:</strong>
                        <div style="font-size: 1.5rem; color: var(--primary); font-weight: 700;">
                            <?= number_format($utilisateur['solde'] ?? 0, 0, ',', ' ') ?> Ar
                        </div>
                    </div>
                </div>

                <div style="margin-bottom: 2rem; padding: 1rem; background: var(--bg-tertiary); border-radius: var(--radius-md);">
                    <strong>Avantages à partir de maintenant:</strong>
                    <ul style="margin: 1rem 0 0 1.5rem; padding: 0;">
                        <li>✨ 15% de réduction sur tous les régimes</li>
                        <li>📈 Accès aux régimes premium</li>
                        <li>👥 Support client prioritaire</li>
                    </ul>
                </div>

                <form action="<?= base_url('gold/activer') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Confirmer l'activation</button>
                        <a href="<?= base_url('gold') ?>" class="btn btn-secondary" style="text-decoration: none; text-align: center;">Annuler</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>
