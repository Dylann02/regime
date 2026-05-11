<?= $this->include('header-admin') ?>

<?php if (isset($title)): ?>
    <div class="page-header"><h1><?= esc($title) ?></h1></div>
<?php endif ?>

<?= $this->renderSection('content') ?>

<?= $this->include('footer-admin') ?>
