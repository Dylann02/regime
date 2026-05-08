<?php

namespace App\Models;

use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table      = 'utilisateurs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'genre',
        'date_naissance',
        'taille_cm',
        'poids_actuel',
        'objectif_actuel',
        'valeur_objectif',
        'solde',
        'est_gold',
    ];

    protected $useTimestamps = false;

    // Règles de validation pour l'inscription
    protected $validationRules = [
        'nom' => 'required|min_length[2]',
        'prenom' => 'required|min_length[2]',
        'email' => 'required|valid_email|is_unique[utilisateurs.email]',
        'mot_de_passe' => 'required|min_length[8]',
        'genre' => 'required|in_list[homme,femme,autre]',
        'date_naissance' => 'required|valid_date',
    ];

    // Règles de validation pour l'étape 2
    protected $validationRulesEtape2 = [
        'taille_cm' => 'required|numeric',
        'poids_actuel' => 'required|numeric'
    ];

    // Règles de validation pour la mise à jour du profil
    protected $validationRulesUpdateProfile = [
        'nom' => 'required|min_length[2]',
        'prenom' => 'required|min_length[2]',
        // Correction ici :
        'email' => 'required|valid_email|is_unique[utilisateurs.email,id,{id}]',
        'genre' => 'required|in_list[homme,femme,autre]',
        'date_naissance' => 'required|valid_date',
        'taille_cm' => 'required|numeric',
        'poids_actuel' => 'required|numeric'
    ];

    // Règles de validation pour la mise à jour complète
    protected $validationRulesUpdate = [
        'nom' => 'required|min_length[2]',
        'prenom' => 'required|min_length[2]',
        'email' => 'required|valid_email',
        'genre' => 'required|in_list[homme,femme,autre]',
        'date_naissance' => 'required|valid_date',
        'taille_cm' => 'required|numeric',
        'poids_actuel' => 'required|numeric',
        'objectif_actuel' => 'required|in_list[augmenter,reduire,imc_ideal]'
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom est requis.',
            'min_length' => 'Le nom doit contenir au moins 2 caractères.'
        ],
        'prenom' => [
            'required' => 'Le prénom est requis.',
            'min_length' => 'Le prénom doit contenir au moins 2 caractères.'
        ],
        'email' => [
            'required' => 'L\'email est requis.',
            'valid_email' => 'L\'email n\'est pas valide.',
            'is_unique' => 'Cet email est déjà utilisé.'
        ],
        'mot_de_passe' => [
            'required' => 'Le mot de passe est requis.',
            'min_length' => 'Le mot de passe doit comporter au moins 8 caractères.'
        ],
        'genre' => [
            'required' => 'Le genre est requis.',
            'in_list' => 'Le genre doit être parmi: homme, femme, autre.'
        ],
        'date_naissance' => [
            'required' => 'La date de naissance est requise.',
            'valid_date' => 'La date de naissance doit être une date valide.'
        ],
        'taille_cm' => [
            'required' => 'La taille est requise.',
            'numeric' => 'La taille doit être un nombre.'
        ],
        'poids_actuel' => [
            'required' => 'Le poids est requis.',
            'numeric' => 'Le poids doit être un nombre.'
        ],
        'objectif_actuel' => [
            'required' => 'L\'objectif est requis.',
            'in_list' => 'L\'objectif doit être parmi: augmenter, reduire, imc_ideal.'
        ]
    ];

    public function getIMC($id)
    {
        $utilisateur = $this->find($id);
        if ($utilisateur) {
            $taille_m = $utilisateur['taille_cm'] / 100; // Convertir cm en m
            if ($taille_m > 0) {
                return round($utilisateur['poids_actuel'] / ($taille_m * $taille_m), 2);
            }
        }
        return null; // Retourner null si l'utilisateur n'existe pas ou si la taille est invalide
    }

    public function getPoidsIdeal($id)
    {
        $utilisateur = $this->find($id);
        if ($utilisateur) {
            $taille_cm = $utilisateur['taille_cm'];
            $genre = $utilisateur['genre'];
            if ($taille_cm > 0) {
                // Formule de Lorentz
                if ($genre === 'femme') {
                    return round($taille_cm - 100 - ($taille_cm - 150) / 2.5, 2);
                } else {
                    return round($taille_cm - 100 - ($taille_cm - 150) / 4, 2);
                }
            }
        }
        return null;
    }
}