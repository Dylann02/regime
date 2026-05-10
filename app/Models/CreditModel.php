<?php
namespace App\Models;
use CodeIgniter\Model;
class CreditModel extends Model{
    protected $table = "codes_recharge";
    protected $primaryKey = "id";
    protected $allowedFields = [
        'code',
        'montant',
        'est_valide',
        'est_utilise',
        'utilisateur_id',
        'date_utilisation'
    ];
    protected $useTimestamps = false;

    public function findByCode($code){
        

        return $this->where('code' ,$code)
                ->first();
    }
}