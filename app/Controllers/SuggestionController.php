<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\RegimeModel;
use App\Models\RegimePrixModel;
use App\Models\ActiviteModel;
use App\Models\AbonnementModel;

class SuggestionController extends BaseController
{
    public function index()
    {
        $userId = session()->get('user')['id'] ?? null;
        if (!$userId) return redirect()->to('/login');

        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($userId);
        
        if (!$utilisateur) return redirect()->to('/login');

        $suggestions = $this->calculerSuggestions($utilisateur, $utilisateurModel);

        return view('suggestions_regimes', [
            'utilisateur' => $utilisateur,
            'suggestions' => $suggestions['regimes'],
            'activites' => $suggestions['activites'],
            'donneesCalcul' => $suggestions['calculs']
        ]);
    }

    public function souscrire()
    {
        $userId = session()->get('user')['id'] ?? null;
        if (!$userId) return redirect()->to('/login');

        $regimeId = (int) $this->request->getPost('regime_id');
        $activiteId = (int) $this->request->getPost('activite_id');

        if (!$regimeId || !$activiteId) {
            session()->setFlashdata('error', 'Veuillez choisir un régime et une activité.');
            return redirect()->back();
        }

        $utilisateurModel = new UtilisateurModel();
        $utilisateur = $utilisateurModel->find($userId);
        if (!$utilisateur) return redirect()->to('/login');

        $suggestions = $this->calculerSuggestions($utilisateur, $utilisateurModel);

        $regimeSelection = null;
        foreach ($suggestions['regimes'] as $regime) {
            if ((int) $regime['id'] === $regimeId) {
                $regimeSelection = $regime;
                break;
            }
        }

        if (!$regimeSelection) {
            session()->setFlashdata('error', 'Régime sélectionné invalide.');
            return redirect()->back();
        }

        $activiteIds = array_map(static fn($a) => (int) $a['id'], $suggestions['activites']);
        if (!in_array($activiteId, $activiteIds, true)) {
            session()->setFlashdata('error', 'Activité sélectionnée invalide pour votre objectif.');
            return redirect()->back();
        }

        $estGold = !empty($utilisateur['est_gold']);
        $prixFinal = (float) ($regimeSelection['prix_final'] ?? $regimeSelection['prix_base']);
        $remiseGold = (float) ($regimeSelection['remise_gold'] ?? 0.0);

        $solde = (float) ($utilisateur['solde'] ?? 0);
        if ($solde < $prixFinal) {
            session()->setFlashdata('error', 'Solde insuffisant pour souscrire à ce régime.');
            return redirect()->back();
        }

        $dateDebut = new \DateTime('today');
        $semainesPalier = max(1, (int) $regimeSelection['palier_trouve']);
        $dateFin = (clone $dateDebut)->modify('+' . $semainesPalier . ' weeks');

        $utilisateurModel->update($userId, [
            'solde' => $solde - $prixFinal
        ]);

        $abonnementModel = new AbonnementModel();
        $abonnementModel->insert([
            'utilisateur_id' => $userId,
            'regime_id' => $regimeId,
            'activite_id' => $activiteId,
            'poids_depart' => (float) $utilisateur['poids_actuel'],
            'poids_cible' => (float) $suggestions['calculs']['poids_cible'],
            'prix_paye' => $prixFinal,
            'remise_gold_appliquee' => $remiseGold,
            'date_debut' => $dateDebut->format('Y-m-d'),
            'date_fin' => $dateFin->format('Y-m-d')
        ]);

        session()->setFlashdata('success', 'Votre abonnement a été enregistré avec succès.');
        return redirect()->to('/suggestions');
    }

    private function calculerSuggestions($utilisateur, $utilisateurModel)
    {
        $regimeModel = new RegimeModel();
        $prixModel = new RegimePrixModel();
        $activiteModel = new ActiviteModel();

        $poidsActuel = (float) $utilisateur['poids_actuel'];
        $tailleCm = (float) $utilisateur['taille_cm'];
        $valeurObjectif = (float) $utilisateur['valeur_objectif'];
        $objectifType = $utilisateur['objectif_actuel'];

        // Étape 1 & 2 : Calculer le Poids Cible
        $poidsCible = 0;
        $direction = ''; // 'reduire' ou 'augmenter'

        if ($objectifType === 'reduire') {
            $poidsCible = $poidsActuel - $valeurObjectif;
            $direction = 'reduire';
        } elseif ($objectifType === 'augmenter') {
            $poidsCible = $poidsActuel + $valeurObjectif;
            $direction = 'augmenter';
        } elseif ($objectifType === 'imc_ideal') {
            // Utiliser le même poids idéal que dans le formulaire d'objectif
            $poidsCible = $valeurObjectif > 0 ? $valeurObjectif : (float) $utilisateurModel->getPoidsIdeal($utilisateur['id']);
            
            if ($poidsActuel > $poidsCible) {
                $direction = 'reduire';
            } else {
                $direction = 'augmenter';
            }
        }

        // Étape 3 : Calcul du Delta
        $deltaKg = abs($poidsCible - $poidsActuel);

        // Étape 8 : Sélection de l'intensité sportive
        $intensite = 'moderee'; // défaut
        if ($objectifType === 'reduire') {
            $intensite = 'elevee';
        } elseif ($objectifType === 'augmenter') {
            $intensite = 'faible';
        } elseif ($objectifType === 'imc_ideal') {
            $intensite = 'moderee';
        }
        $activitesSuggeres = $activiteModel->getActivitesParIntensite($intensite);

        // Étape 4 : Filtrer les régimes selon la direction
        $regimesCompatibles = $regimeModel->getRegimesParObjectif($direction);

        $regimesFinaux = [];

        // Étape 5 & 6 : Durée par régime et Prix
        $estGold = !empty($utilisateur['est_gold']);

        foreach ($regimesCompatibles as $regime) {
            $variationHebdo = abs((float) $regime['variation_kg_semaine']);
            
            // Si le régime a 0 de variation pour éviter la division par zéro
            if ($variationHebdo == 0) continue; 

            // Durée requise en semaines (arrondie supérieur)
            $nbSemainesNecessaires = ceil($deltaKg / $variationHebdo);

            // Récupérer le palier de prix correspondant
            $palier = $prixModel->getPalierPrix($regime['id'], (int) $nbSemainesNecessaires);
            
            if ($palier) {
                $prixBase = (float) $palier['prix'];
                $remiseGold = $estGold ? round($prixBase * 0.15, 2) : 0.0;
                $prixFinal = $prixBase - $remiseGold;
                
                // Ajouter à la liste finale
                $regimeFinal = [
                    'id' => $regime['id'],
                    'nom' => $regime['nom'],
                    'description' => $regime['description'],
                    'variation_kg_semaine' => $regime['variation_kg_semaine'],
                    'duree_calculee' => $nbSemainesNecessaires,
                    'palier_trouve' => $palier['nb_semaines'],
                    'prix_base' => $prixBase,
                    'prix_final' => $prixFinal,
                    'remise_gold' => $remiseGold,
                    'palier_id' => $palier['id'] ?? null
                ];
                $regimesFinaux[] = $regimeFinal;
            }
        }

        return [
            'calculs' => [
                'poids_cible' => $poidsCible,
                'delta_kg' => $deltaKg,
                'direction' => $direction
            ],
            'regimes' => $regimesFinaux,
            'activites' => $activitesSuggeres
        ];
    }
}
