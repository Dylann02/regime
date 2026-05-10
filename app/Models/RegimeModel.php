<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
    protected $table = 'regimes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nom', 'description', 'pct_viande', 'pct_poisson', 'pct_volaille', 'variation_kg_semaine', 'est_actif'
    ];
    protected $useTimestamps = false;

    protected $validationRules = [
        'nom' => 'required|min_length[2]',
        'description' => 'permit_empty',
        'pct_viande' => 'required|numeric',
        'pct_poisson' => 'required|numeric',
        'pct_volaille' => 'required|numeric',
        'variation_kg_semaine' => 'required|numeric'
    ];

    protected $validationMessages = [
        'nom' => [
            'required' => 'Le nom du régime est requis.',
            'min_length' => 'Le nom doit contenir au moins 2 caractères.'
        ],
        'pct_viande' => [
            'required' => 'Le pourcentage de viande est requis.',
            'numeric' => 'Le pourcentage de viande doit être un nombre.'
        ],
        'pct_poisson' => [
            'required' => 'Le pourcentage de poisson est requis.',
            'numeric' => 'Le pourcentage de poisson doit être un nombre.'
        ],
        'pct_volaille' => [
            'required' => 'Le pourcentage de volaille est requis.',
            'numeric' => 'Le pourcentage de volaille doit être un nombre.'
        ],
        'variation_kg_semaine' => [
            'required' => 'La variation de poids est requise.',
            'numeric' => 'La variation doit être un nombre.'
        ]
    ];

    /**
     * Récupérer les régimes compatibles avec un objectif
     */
    public function getRegimesParObjectif($objectif)
    {
        $builder = $this->builder();
        $builder->where('est_actif', 1);

        if ($objectif === 'reduire') {
            $builder->where('variation_kg_semaine <', 0);
        } elseif ($objectif === 'augmenter') {
            $builder->where('variation_kg_semaine >', 0);
        }
        
        return $builder->get()->getResultArray();
    }
}
