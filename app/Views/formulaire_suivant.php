<?php $title = 'Inscription réussie' ?>
<?= $this->extend('modele') ?>
<?= $this->section('content') ?>

    <div class="container" style="max-width: 600px;">
        <div class="chart-container" style="text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1.5rem;">🎉</div>
            
            <h2 style="color: var(--success); margin-top: 0; margin-bottom: 1rem;">Données enregistrées avec succès!</h2>
            
            <p style="font-size: 1.1rem; color: var(--text-secondary); margin-bottom: 2rem;">
                Bienvenue, passez à l'étape suivante de votre parcours santé.
            </p>

            <div style="background: var(--primary-light); padding: 1.5rem; border-radius: var(--radius-lg); margin-bottom: 2rem; text-align: left;">
                <h3 style="color: var(--primary); margin-top: 0; margin-bottom: 1rem;">Prochaines étapes:</h3>
                <ol style="margin: 0; padding-left: 1.5rem; color: var(--text-secondary);">
                    <li style="margin-bottom: 0.5rem;">Choisir votre objectif de santé</li>
                    <li style="margin-bottom: 0.5rem;">Consulter les régimes recommandés</li>
                    <li style="margin-bottom: 0;">Démarrer votre programme personnalisé</li>
                </ol>
            </div>

            <div class="actions">
                <a href="<?= base_url('profil') ?>" class="btn btn-primary">Accéder à mon profil</a>
                <a href="<?= base_url('suggestions') ?>" class="btn btn-secondary" style="text-decoration: none; text-align: center;">Voir les régimes</a>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>
