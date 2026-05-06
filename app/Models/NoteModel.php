<?php
namespace App\Models;

use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = 'notes';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'etudiant_id',
        'matiere_id',
        'valeur'
    ];
    protected $useTimestamps = false;

    protected $validationRules = [
        'etudiant_id' => 'required|integer|greater_than[0]',
        'matiere_id' => 'required|integer|greater_than[0]',
        'valeur' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[20]'
    ];

    protected $validationMessages = [
        'etudiant_id' => [
            'required' => 'L\'étudiant est requis',
            'integer' => 'L\'étudiant doit être un nombre',
            'greater_than' => 'Veuillez sélectionner un étudiant valide'
        ],
        'matiere_id' => [
            'required' => 'La matière est requise',
            'integer' => 'La matière doit être un nombre',
            'greater_than' => 'Veuillez sélectionner une matière valide'
        ],
        'valeur' => [
            'required' => 'La note est requise',
            'numeric' => 'La note doit être un nombre',
            'greater_than_equal_to' => 'La note doit être supérieure ou égale à 0',
            'less_than_equal_to' => 'La note doit être inférieure ou égale à 20'
        ]
    ];

    /**
     * Vérifier si une note existe déjà pour cet étudiant et cette matière
     */
    public function noteExists($etudiantId, $matiereId)
    {
        return $this->where('etudiant_id', $etudiantId)
                    ->where('matiere_id', $matiereId)
                    ->first() !== null;
    }

    /**
     * Obtenir les notes d'un étudiant
     */
    public function getNotesByEtudiant($etudiantId)
    {
        return $this->select('notes.*, matieres.nom as matiere_nom')
                    ->join('matieres', 'matieres.id = notes.matiere_id')
                    ->where('notes.etudiant_id', $etudiantId)
                    ->findAll();
    }
}