<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Statistiques</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            color: #333;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #1f2a44;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1.5rem 1rem;
        }

        .sidebar .brand {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .sidebar-nav a {
            color: white;
            text-decoration: none;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            transition: background 0.3s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255,255,255,0.15);
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar h1 {
            font-size: 1.8rem;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .nav-links a:hover {
            background: rgba(255,255,255,0.2);
        }

        .container {
            max-width: 1400px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-left: 4px solid #667eea;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .stat-card.gold {
            border-left-color: #ffc107;
        }

        .stat-card.success {
            border-left-color: #28a745;
        }

        .stat-card.info {
            border-left-color: #17a2b8;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 0.5rem;
        }

        .stat-card.gold .stat-value {
            color: #ffc107;
        }

        .stat-card.success .stat-value {
            color: #28a745;
        }

        .stat-card.info .stat-value {
            color: #17a2b8;
        }

        .stat-unit {
            font-size: 0.9rem;
            color: #999;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
            border-bottom: 2px solid #667eea;
            padding-bottom: 0.5rem;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .table-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #ddd;
        }

        table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            color: #667eea;
        }

        table td {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        table tbody tr:hover {
            background: #f9f9f9;
        }

        .progress-bar {
            background: #e9ecef;
            border-radius: 10px;
            height: 20px;
            overflow: hidden;
            margin-top: 0.5rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.7rem;
            font-weight: bold;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #999;
        }

        .empty-state svg {
            width: 60px;
            height: 60px;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .legend {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
        }

        @media (max-width: 768px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }

            .sidebar .brand {
                margin-bottom: 0;
            }

            .sidebar-nav {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: flex-end;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .stat-value {
                font-size: 1.8rem;
            }

            .navbar {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .nav-links {
                width: 100%;
                flex-direction: column;
            }

            .nav-links a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand">⚙️ Admin</div>
            <nav class="sidebar-nav">
                <a class="active" href="<?= base_url('dashboard') ?>">Tableau de bord</a>
                <a href="<?= base_url('admin/regimes') ?>">Régimes</a>
                <a href="<?= base_url('admin/activites') ?>">Activités sportives</a>
                <a href="<?= base_url('admin/parametres') ?>">Paramètres</a>
                <a href="<?= base_url('logout') ?>">Déconnexion</a>
            </nav>
        </aside>

        <div class="main-content">
            <div class="navbar">
                <h1>📊 Tableau de Bord</h1>
                <div class="nav-links"></div>
            </div>

            <div class="container">
        <!-- Statistiques clés -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Utilisateurs Total</div>
                <div class="stat-value"><?= $total_users ?></div>
                <div class="stat-unit">comptes actifs</div>
            </div>

            <div class="stat-card gold">
                <div class="stat-label">Utilisateurs Gold</div>
                <div class="stat-value"><?= $gold_users ?></div>
                <div class="stat-unit">premium</div>
            </div>

            <div class="stat-card success">
                <div class="stat-label">Abonnements Actifs</div>
                <div class="stat-value"><?= $active_subscriptions ?></div>
                <div class="stat-unit">en cours</div>
            </div>

            <div class="stat-card info">
                <div class="stat-label">Régimes Disponibles</div>
                <div class="stat-value"><?= $total_regimes ?></div>
                <div class="stat-unit">options</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Chiffre d'Affaires</div>
                <div class="stat-value"><?= number_format($total_revenue, 0) ?></div>
                <div class="stat-unit">francs</div>
            </div>

            <div class="stat-card gold">
                <div class="stat-label">Revenue Gold</div>
                <div class="stat-value"><?= number_format($gold_revenue, 0) ?></div>
                <div class="stat-unit">francs</div>
            </div>

            <div class="stat-card success">
                <div class="stat-label">Perte Moyenne</div>
                <div class="stat-value"><?= $avg_weight_loss ?> kg</div>
                <div class="stat-unit">par abonnement</div>
            </div>

            <div class="stat-card info">
                <div class="stat-label">Taux de Succès</div>
                <div class="stat-value"><?= $success_rate ?>%</div>
                <div class="stat-unit">objectif atteint</div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="charts-grid">
            <!-- Utilisateurs par objectif -->
            <?php if (!empty($objectif_stats)): ?>
            <div class="chart-container">
                <div class="chart-title">Distribution des Objectifs</div>
                <canvas id="objectifChart"></canvas>
            </div>
            <?php endif; ?>

            <!-- Utilisateurs par genre -->
            <?php if (!empty($genre_stats)): ?>
            <div class="chart-container">
                <div class="chart-title">Distribution par Genre</div>
                <canvas id="genreChart"></canvas>
            </div>
            <?php endif; ?>

            <!-- Régimes populaires -->
            <?php if (!empty($regimes_populaires)): ?>
            <div class="chart-container">
                <div class="chart-title">Régimes les Plus Populaires</div>
                <canvas id="regimesChart"></canvas>
            </div>
            <?php endif; ?>

            <!-- Revenue Trend -->
            <?php if (!empty($revenue_data)): ?>
            <div class="chart-container">
                <div class="chart-title">Tendance du Chiffre d'Affaires</div>
                <canvas id="revenueChart"></canvas>
            </div>
            <?php endif; ?>

            <!-- Tableau des régimes populaires -->
            <div class="chart-container full-width">
                <div class="chart-title">📋 Régimes par Popularité</div>
                <?php if (!empty($regimes_populaires)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nom du Régime</th>
                            <th>Nombre d'Abonnements</th>
                            <th>Pourcentage</th>
                            <th>Progression</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = array_sum(array_column($regimes_populaires, 'count'));
                        foreach ($regimes_populaires as $regime): 
                            $percentage = $total > 0 ? ($regime['count'] / $total) * 100 : 0;
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($regime['nom']) ?></td>
                            <td><?= $regime['count'] ?></td>
                            <td><?= round($percentage, 2) ?>%</td>
                            <td>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $percentage ?>%">
                                        <?= round($percentage, 0) ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <p>Aucun régime disponible pour le moment</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tableau des objectifs -->
            <div class="chart-container full-width">
                <div class="chart-title">🎯 Objectifs des Utilisateurs</div>
                <?php if (!empty($objectif_stats)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Objectif</th>
                            <th>Nombre d'Utilisateurs</th>
                            <th>Pourcentage</th>
                            <th>Distribution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalUsers = array_sum(array_values($objectif_stats));
                        foreach ($objectif_stats as $objectif => $count): 
                            $percentage = $totalUsers > 0 ? ($count / $totalUsers) * 100 : 0;
                            $label = ucfirst(str_replace('_', ' ', $objectif));
                        ?>
                        <tr>
                            <td><?= $label ?></td>
                            <td><?= $count ?></td>
                            <td><?= round($percentage, 2) ?>%</td>
                            <td>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $percentage ?>%">
                                        <?= round($percentage, 0) ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <p>Aucun objectif enregistré</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Tableau des genres -->
            <div class="chart-container full-width">
                <div class="chart-title">👥 Répartition par Genre</div>
                <?php if (!empty($genre_stats)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Genre</th>
                            <th>Nombre d'Utilisateurs</th>
                            <th>Pourcentage</th>
                            <th>Distribution</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $totalGender = array_sum(array_values($genre_stats));
                        foreach ($genre_stats as $genre => $count): 
                            $percentage = $totalGender > 0 ? ($count / $totalGender) * 100 : 0;
                            $label = ucfirst($genre);
                        ?>
                        <tr>
                            <td><?= $label ?></td>
                            <td><?= $count ?></td>
                            <td><?= round($percentage, 2) ?>%</td>
                            <td>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?= $percentage ?>%">
                                        <?= round($percentage, 0) ?>%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div class="empty-state">
                    <p>Aucun utilisateur enregistré</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
            </div>
        </div>
    </div>

    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Configuration commune des graphiques
        const chartConfig = {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { size: 12 },
                        usePointStyle: true,
                        padding: 20
                    }
                }
            }
        };

        // Graphique des objectifs
        <?php if (!empty($objectif_stats)): ?>
        const objectifCtx = document.getElementById('objectifChart');
        if (objectifCtx) {
            new Chart(objectifCtx, {
                type: 'doughnut',
                data: {
                    labels: [<?php echo implode(', ', array_map(function($k) { return "'" . ucfirst($k) . "'"; }, array_keys($objectif_stats))); ?>],
                    datasets: [{
                        data: [<?php echo implode(', ', array_values($objectif_stats)); ?>],
                        backgroundColor: [
                            '#667eea',
                            '#764ba2',
                            '#f093fb',
                            '#4facfe',
                            '#00f2fe',
                            '#43e97b'
                        ],
                        borderColor: 'white',
                        borderWidth: 2
                    }]
                },
                options: {
                    ...chartConfig,
                    plugins: {
                        ...chartConfig.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed + ' utilisateurs';
                                }
                            }
                        }
                    }
                }
            });
        }
        <?php endif; ?>

        // Graphique des genres
        <?php if (!empty($genre_stats)): ?>
        const genreCtx = document.getElementById('genreChart');
        if (genreCtx) {
            new Chart(genreCtx, {
                type: 'pie',
                data: {
                    labels: [<?php echo implode(', ', array_map(function($k) { return "'" . ucfirst($k) . "'"; }, array_keys($genre_stats))); ?>],
                    datasets: [{
                        data: [<?php echo implode(', ', array_values($genre_stats)); ?>],
                        backgroundColor: [
                            '#FF6B6B',
                            '#4ECDC4',
                            '#95A5A6'
                        ],
                        borderColor: 'white',
                        borderWidth: 2
                    }]
                },
                options: {
                    ...chartConfig
                }
            });
        }
        <?php endif; ?>

        // Graphique des régimes
        <?php if (!empty($regimes_populaires)): ?>
        const regimesCtx = document.getElementById('regimesChart');
        if (regimesCtx) {
            new Chart(regimesCtx, {
                type: 'bar',
                data: {
                    labels: [<?php echo implode(', ', array_map(function($r) { return "'" . addslashes($r['nom']) . "'"; }, $regimes_populaires)); ?>],
                    datasets: [{
                        label: 'Nombre d\'abonnements',
                        data: [<?php echo implode(', ', array_map(function($r) { return $r['count']; }, $regimes_populaires)); ?>],
                        backgroundColor: '#667eea',
                        borderColor: '#667eea',
                        borderWidth: 1
                    }]
                },
                options: {
                    ...chartConfig,
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        <?php endif; ?>

        // Graphique du revenue
        <?php if (!empty($revenue_data)): ?>
        const revenueCtx = document.getElementById('revenueChart');
        if (revenueCtx) {
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: [<?php echo implode(', ', array_map(function($r) { return "'" . ($r['date'] ?? '') . "'"; }, $revenue_data)); ?>],
                    datasets: [{
                        label: 'Chiffre d\'affaires',
                        data: [<?php echo implode(', ', array_map(function($r) { return $r['total'] ?? 0; }, $revenue_data)); ?>],
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#667eea',
                        pointBorderColor: 'white',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }]
                },
                options: {
                    ...chartConfig,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
        <?php endif; ?>
    </script>
</body>
</html>
