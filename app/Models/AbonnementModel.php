<?php

namespace App\Models;

use CodeIgniter\Model;

class AbonnementModel extends Model
{
    protected $table = 'abonnements';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'utilisateur_id',
        'regime_id',
        'activite_id',
        'poids_depart',
        'poids_cible',
        'prix_paye',
        'remise_gold_appliquee',
        'date_debut',
        'date_fin'
    ];
    protected $useTimestamps = false;
}
