<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimePrixModel extends Model
{
    protected $table = 'regime_prix';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'regime_id', 'nb_semaines', 'prix'
    ];
    protected $useTimestamps = false;

    public function getPalierPrix($regimeId, $nbSemaines)
    {
        $builder = $this->builder();
        $builder->where('regime_id', $regimeId)
                ->where('nb_semaines >=', $nbSemaines)
                ->orderBy('nb_semaines', 'ASC')
                ->limit(1);

        $result = $builder->get()->getRowArray();

        if (!$result) {
            $builder = $this->builder();
            $builder->where('regime_id', $regimeId)
                    ->orderBy('nb_semaines', 'DESC')
                    ->limit(1);
            $result = $builder->get()->getRowArray();
        }

        return $result;
    }
}
