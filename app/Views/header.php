<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? esc($title) : 'Mon site' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="site-header-inner">
            <div class="site-logo">
                <img src="<?= base_url('logo.png') ?>" alt="logo" />
            </div>

            <nav class="site-nav">
                <ul>
                    <li><a href="<?= base_url('suggestions') ?>">Suggestions</a></li>
                    <li><a href="<?= base_url('profil') ?>">Profil</a></li>
                    <li><a href="<?= base_url('gold') ?>">Gold</a></li>
                </ul>
            </nav>

            <div class="site-actions">
                <?php $user = session()->get('user') ?? null; ?>

                <?php if ($user): ?>
                    <a class="btn btn-primary" href="<?= base_url('logout') ?>">Se déconnecter</a>
                <?php else: ?>
                    <a class="btn btn-primary" href="<?= base_url('login') ?>">Se connecter</a>
                <?php endif ?>
            </div>
        </div>
    </header>
    <main class="site-main">
