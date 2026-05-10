<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiviteModel extends Model
{
    protected $table = 'activites';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom', 'description', 'intensite', 'est_actif'
    ];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|min_length[2]',
        'description' => 'permit_empty',
        'intensite' => 'required|in_list[faible,moderee,elevee]'
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom de l’activité est requis.',
            'min_length' => 'Le nom doit contenir au moins 2 caractères.'
        ],
        'intensite' => [
            'required' => 'L’intensité est requise.',
            'in_list' => 'L’intensité doit être : faible, moderee ou elevee.'
        ]
    ];

    /**
     * Récupérer les activités selon l'intensité (faible, moderee, elevee)
     */
    public function getActivitesParIntensite($intensite)
    {
        return $this->where('intensite', $intensite)
                    ->where('est_actif', 1)
                    ->findAll();
    }
}
