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
