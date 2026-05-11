<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddValeurObjectifToUtilisateurs extends Migration
{
    public function up()
    {
        $this->forge->addColumn('utilisateurs', [
            'valeur_objectif' => [
                'type'       => 'DECIMAL',
                'constraint' => '5,2',
                'null'       => true,
                'after'      => 'objectif_actuel',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('utilisateurs', 'valeur_objectif');
    }
}
