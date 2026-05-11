<?php $title = "Activer l'option Gold" ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 800px;">
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

        <div class="gold-container">
            <?php if (!empty($utilisateur['est_gold'])): ?>
                <!-- Already Gold Member -->
                <div class="gold-success-section">
                    <div class="success-animation">⭐</div>
                    <h1 style="color: #ffc107; margin: 1rem 0 0.5rem 0;">Bienvenue, membre Gold!</h1>
                    <p style="color: #666; margin-bottom: 2rem; font-size: 1.05rem;">
                        Vous bénéficiez maintenant de tous les avantages premium. Profitez de votre 15% de réduction sur tous les régimes.
                    </p>
                    <div class="gold-benefits-quick">
                        <div class="quick-benefit">💰 15% de réduction</div>
                        <div class="quick-benefit">⚡ Accès prioritaire</div>
                        <div class="quick-benefit">🎯 Support premium</div>
                        <div class="quick-benefit">📊 Historique illimité</div>
                    </div>
                    <a href="<?= base_url('profil') ?>" class="btn btn-primary btn-lg" style="margin-top: 2rem;">Retour au profil</a>
                </div>
            <?php else: ?>
                <!-- Confirmation Section -->
                <div class="gold-confirmation-section">
                    <div class="confirmation-header">
                        <h1 style="margin: 0 0 1rem 0; color: #333;">Confirmer l'activation Gold</h1>
                        <p style="margin: 0; color: #666;">Revérifiez les détails avant de finaliser votre achat</p>
                    </div>

                    <!-- Summary Section -->
                    <div class="gold-summary-cards">
                        <div class="summary-card primary">
                            <div class="summary-label">Prix de l'option</div>
                            <div class="summary-amount">
                                <span class="amount-value"><?= number_format($goldPrice, 0, ',', ' ') ?></span>
                                <span class="amount-currency">Ar</span>
                            </div>
                            <div class="summary-note">Paiement unique et définitif</div>
                        </div>

                        <div class="summary-card secondary">
                            <div class="summary-label">Solde actuel</div>
                            <div class="summary-amount">
                                <span class="amount-value"><?= number_format($utilisateur['solde'] ?? 0, 0, ',', ' ') ?></span>
                                <span class="amount-currency">Ar</span>
                            </div>
                            <?php if (($utilisateur['solde'] ?? 0) >= $goldPrice): ?>
                                <div class="summary-note" style="color: #27ae60;">✓ Solde suffisant</div>
                            <?php else: ?>
                                <div class="summary-note" style="color: #e74c3c;">✗ Solde insuffisant</div>
                            <?php endif; ?>
                        </div>

                        <div class="summary-card highlight">
                            <div class="summary-label">Solde après achat</div>
                            <div class="summary-amount">
                                <span class="amount-value"><?= number_format(max(0, ($utilisateur['solde'] ?? 0) - $goldPrice), 0, ',', ' ') ?></span>
                                <span class="amount-currency">Ar</span>
                            </div>
                            <div class="summary-note">Solde restant estimé</div>
                        </div>
                    </div>

                    <!-- Benefits Reminder -->
                    <div class="gold-benefits-reminder">
                        <h3 style="margin: 0 0 1rem 0; color: #333;">Vos avantages à partir de maintenant</h3>
                        <div class="benefits-list">
                            <div class="benefit-item">
                                <span class="benefit-icon">💰</span>
                                <div class="benefit-text">
                                    <strong>15% de réduction</strong>
                                    <span>Applicable sur tous les régimes premium</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <span class="benefit-icon">📈</span>
                                <div class="benefit-text">
                                    <strong>Accès aux régimes premium</strong>
                                    <span>Découvrez les régimes exclusifs en avant-première</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <span class="benefit-icon">👥</span>
                                <div class="benefit-text">
                                    <strong>Support prioritaire</strong>
                                    <span>Assistance client rapide et personnalisée</span>
                                </div>
                            </div>
                            <div class="benefit-item">
                                <span class="benefit-icon">📊</span>
                                <div class="benefit-text">
                                    <strong>Historique illimité</strong>
                                    <span>Conservez l'accès à tous vos suivis antérieurs</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <form action="<?= base_url('gold/activer') ?>" method="post" class="gold-form">
                        <?= csrf_field() ?>
                        <div class="actions">
                            <button type="submit" class="btn btn-primary btn-lg">Confirmer l'activation</button>
                            <a href="<?= base_url('gold') ?>" class="btn btn-secondary btn-lg">Annuler</a>
                        </div>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>
