<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use App\Models\RegimeModel;
use App\Models\RegimePrixModel;
use App\Models\ActiviteModel;

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
            $tailleM = $tailleCm / 100;
            // Poids Cible basé sur un IMC idéal de 22
            $poidsCible = 22 * ($tailleM * $tailleM);
            
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
                
                // Ajouter à la liste finale
                $regimeFinal = [
                    'id' => $regime['id'],
                    'nom' => $regime['nom'],
                    'description' => $regime['description'],
                    'variation_kg_semaine' => $regime['variation_kg_semaine'],
                    'duree_calculee' => $nbSemainesNecessaires,
                    'palier_trouve' => $palier['nb_semaines'],
                    'prix_base' => $prixBase
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
