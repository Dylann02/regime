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
