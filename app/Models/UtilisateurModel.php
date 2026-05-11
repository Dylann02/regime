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
        ],
        'valeur_objectif' => [
            'required' => 'La valeur objectif est requise.',
            'numeric' => 'La valeur objectif doit être un nombre.',
            'greater_than' => 'La valeur objectif doit être supérieure à 0.'
        ]
    ];

    public function updateProfil(int $id, array $data): bool
    {
        $rules = [
            'nom' => 'required|min_length[2]',
            'prenom' => 'required|min_length[2]',
            'email' => 'required|valid_email|is_unique[utilisateurs.email,id,' . $id . ']',
            'genre' => 'required|in_list[homme,femme,autre]',
            'date_naissance' => 'required|valid_date',
            'taille_cm' => 'required|numeric',
            'poids_actuel' => 'required|numeric',
            'objectif_actuel' => 'required|in_list[reduire,augmenter,imc_ideal]',
            'valeur_objectif' => 'required|numeric|greater_than[0]'
        ];

        $this->setValidationRules($rules);
        $this->setValidationMessages($this->validationMessages);

        return $this->update($id, $data) !== false;
    }

    public function getIMC($id)
    {
        $utilisateur = $this->find($id);
        if ($utilisateur) {
            $taille_m = $utilisateur['taille_cm'] / 100; 
            if ($taille_m > 0) {
                return round($utilisateur['poids_actuel'] / ($taille_m * $taille_m), 2);
            }
        }
        return null;
    }

    public function getPoidsIdeal($id)
    {
        $utilisateur = $this->find($id);
        if ($utilisateur) {
            $taille_cm = $utilisateur['taille_cm'];
            $genre = $utilisateur['genre'];
            if ($taille_cm > 0) {
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