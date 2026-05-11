<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\AbonnementModel;
use App\Models\RegimeModel;
use App\Models\ActiviteModel;
use App\Models\CreditModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $utilisateurModel = new UtilisateurModel();
        $abonnementModel = new AbonnementModel();
        $regimeModel = new RegimeModel();
        $creditModel = new CreditModel();

        // Statistiques générales
        $stats = [
            'total_users' => $utilisateurModel->countAll(),
            'gold_users' => $utilisateurModel->where('est_gold', 1)->countAllResults(),
            'total_subscriptions' => $abonnementModel->countAll(),
            'active_subscriptions' => $abonnementModel->where('date_fin >=', date('Y-m-d'))->countAllResults(),
            'total_regimes' => $regimeModel->where('est_actif', 1)->countAllResults(),
        ];

        // Statistiques financières
        $creditsUsed = $creditModel->where('est_utilise', 1)->selectSum('montant')->first();
        $stats['total_revenue'] = $creditsUsed['montant'] ?? 0;
        
        // Revenue from gold subscriptions
        $goldRevenue = $abonnementModel->selectSum('prix_paye')
            ->where('remise_gold_appliquee', 1)->first();
        $stats['gold_revenue'] = $goldRevenue['prix_paye'] ?? 0;

        // Utilisateurs par objectif
        $objectifs = $utilisateurModel->select('objectif_actuel')
            ->where('objectif_actuel !=', null)
            ->groupBy('objectif_actuel')
            ->findAll();
        
        $data['objectif_stats'] = [];
        foreach ($objectifs as $obj) {
            if (!empty($obj['objectif_actuel'])) {
                $count = $utilisateurModel->where('objectif_actuel', $obj['objectif_actuel'])->countAllResults();
                $data['objectif_stats'][$obj['objectif_actuel']] = $count;
            }
        }

        // Régimes les plus populaires
        $regimesPopulaires = $abonnementModel->select('regime_id')
            ->groupBy('regime_id')
            ->get()
            ->getResultArray();

        $data['regimes_populaires'] = [];
        foreach ($regimesPopulaires as $sub) {
            $regime = $regimeModel->find($sub['regime_id']);
            $count = $abonnementModel->where('regime_id', $sub['regime_id'])->countAllResults();
            if ($regime) {
                $data['regimes_populaires'][] = [
                    'nom' => $regime['nom'],
                    'count' => $count
                ];
            }
        }

        // Progrès moyen des utilisateurs
        $abonnements = $abonnementModel->select('poids_depart, poids_cible')
            ->where('poids_depart !=', null)
            ->where('poids_cible !=', null)
            ->findAll();
        
        $data['avg_weight_loss'] = 0;
        if (!empty($abonnements)) {
            $totalProgression = 0;
            foreach ($abonnements as $ab) {
                $totalProgression += ($ab['poids_depart'] - $ab['poids_cible']);
            }
            $data['avg_weight_loss'] = round($totalProgression / count($abonnements), 2);
        }

        // Taux de succès
        $abonnementsSuccess = $abonnementModel->select('poids_depart, poids_cible')
            ->where('poids_depart !=', null)
            ->where('poids_cible !=', null)
            ->findAll();
        
        $data['success_rate'] = 0;
        if (!empty($abonnementsSuccess)) {
            $successCount = 0;
            foreach ($abonnementsSuccess as $ab) {
                if ($ab['poids_depart'] - $ab['poids_cible'] >= 0) {
                    $successCount++;
                }
            }
            $data['success_rate'] = round(($successCount / count($abonnementsSuccess)) * 100, 2);
        }

        // Distribution par genre
        $genres = $utilisateurModel->select('genre')
            ->where('genre !=', null)
            ->groupBy('genre')
            ->findAll();

        $data['genre_stats'] = [];
        foreach ($genres as $genre) {
            if (!empty($genre['genre'])) {
                $count = $utilisateurModel->where('genre', $genre['genre'])->countAllResults();
                $data['genre_stats'][$genre['genre']] = $count;
            }
        }

        // Données temporelles simplifiées - distributions par régime
        $data['weekly_data'] = [];
        $data['revenue_data'] = [];

        return view('dashboard/index', array_merge($stats, $data));
    }
}
