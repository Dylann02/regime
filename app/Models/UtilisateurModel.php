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
        'poids_actuel'
    ];

    protected $useTimestamps = false;
}