<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametreModel extends Model
{
    protected $table = 'parametres';
    protected $primaryKey = 'cle_param';
    protected $useAutoIncrement = false;
    protected $allowedFields = ['cle_param', 'valeur', 'description'];
    protected $useTimestamps = false;

    protected $validationRules = [
        'cle_param' => 'required|min_length[2]|max_length[50]',
        'valeur' => 'required|max_length[255]',
        'description' => 'permit_empty|max_length[255]'
    ];

    protected $validationMessages = [
        'cle_param' => [
            'required' => 'La clé du paramètre est requise.',
            'min_length' => 'La clé doit contenir au moins 2 caractères.',
            'max_length' => 'La clé ne doit pas dépasser 50 caractères.'
        ],
        'valeur' => [
            'required' => 'La valeur est requise.',
            'max_length' => 'La valeur ne doit pas dépasser 255 caractères.'
        ],
        'description' => [
            'max_length' => 'La description ne doit pas dépasser 255 caractères.'
        ]
    ];

    public function getValeur(string $cle, ?string $default = null): ?string
    {
        $row = $this->find($cle);
        if (!$row) {
            return $default;
        }
        return $row['valeur'] ?? $default;
    }
}
