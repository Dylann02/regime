<?php $title = 'Option Gold' ?>
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
            <!-- Header Section -->
            <div class="gold-header">
                <h1 style="margin: 0 0 0.5rem 0; color: #ffc107;">Devenir membre Gold</h1>
                <p style="margin: 0; color: #666; font-size: 1rem;">Accédez aux avantages premium et optimisez votre suivi</p>
            </div>

            <!-- Status Badge -->
            <?php if (!empty($utilisateur['est_gold'])): ?>
                <div class="gold-status-badge">
                    <span class="status-icon">⭐</span>
                    <span>Vous êtes déjà membre Gold!</span>
                </div>
            <?php endif; ?>

            <!-- Benefits Section -->
            <div class="gold-benefits-section">
                <h2 style="margin-top: 0; color: #333; margin-bottom: 1.5rem;">Vos avantages</h2>
                <div class="gold-benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">💰</div>
                        <div class="benefit-content">
                            <h3>15% de réduction</h3>
                            <p>Sur tous les régimes premium</p>
                        </div>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">⚡</div>
                        <div class="benefit-content">
                            <h3>Accès prioritaire</h3>
                            <p>Aux nouveaux régimes en avant-première</p>
                        </div>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">🎯</div>
                        <div class="benefit-content">
                            <h3>Support premium</h3>
                            <p>Assistance prioritaire en continu</p>
                        </div>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">📊</div>
                        <div class="benefit-content">
                            <h3>Historique illimité</h3>
                            <p>Accès complet à vos suivis archivés</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing Section -->
            <div class="gold-pricing-section">
                <div class="pricing-cards-wrapper">
                    <div class="pricing-card gold-featured">
                        <div class="pricing-header">
                            <span class="pricing-label">Prix de l'option</span>
                            <span class="badge-gold">GOLD</span>
                        </div>
                        <div class="pricing-amount">
                            <span class="currency">Ar</span>
                            <span class="amount"><?= number_format($goldPrice, 0, ',', ' ') ?></span>
                        </div>
                        <div class="pricing-note">Paiement unique</div>
                    </div>

                    <div class="pricing-card balance-card">
                        <div class="pricing-header">
                            <span class="pricing-label">Votre solde</span>
                        </div>
                        <div class="pricing-amount">
                            <span class="currency">Ar</span>
                            <span class="amount" id="balance-display"><?= number_format($utilisateur['solde'] ?? 0, 0, ',', ' ') ?></span>
                        </div>
                        <?php if (($utilisateur['solde'] ?? 0) >= $goldPrice): ?>
                            <div class="status-ok">✓ Solde suffisant</div>
                        <?php else: ?>
                            <div class="status-warning">⚠ Solde insuffisant</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Action Section -->
            <?php if (!empty($utilisateur['est_gold'])): ?>
                <div class="gold-actions">
                    <div class="success-message-large">
                        <div class="success-icon"></div>
                        <div>
                            <h3>Merci d'être membre Gold!</h3>
                            <p>Profitez de tous les avantages exclusifs dès maintenant.</p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <form action="<?= base_url('gold/activer') ?>" method="post" class="gold-form">
                    <?= csrf_field() ?>
                    <div class="actions">
                        <button type="submit" class="btn btn-primary btn-lg">Activer Gold maintenant</button>
                        <a href="<?= base_url('profil') ?>" class="btn btn-secondary btn-lg">Retour au profil</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>
