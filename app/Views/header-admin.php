<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($title) ? esc($title) : 'Admin' ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/site.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">
</head>
<body>
    <header class="site-header">
        <div class="site-header-inner">
            <div class="site-logo">
                <img src="<?= base_url('logo.png') ?>" alt="logo" />
            </div>
            <nav class="site-nav"></nav>
            <div class="site-actions">
                <a class="btn btn-primary" href="<?= base_url('logout') ?>">Se déconnecter</a>
            </div>
        </div>
    </header>
    
    <div class="admin-layout">
        <aside class="admin-sidebar">
            <nav class="sidebar-nav">
                <a class="sidebar-link" href="<?= base_url('dashboard') ?>">📊 Tableau de bord</a>
                <a class="sidebar-link" href="<?= base_url('admin/regimes') ?>">🍽️ Régimes</a>
                <a class="sidebar-link" href="<?= base_url('admin/activites') ?>">🏃 Activités</a>
                <a class="sidebar-link" href="<?= base_url('admin/parametres') ?>">⚙️ Paramètres</a>
            </nav>
        </aside>
        
        <main class="site-main">
