<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateConges extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'employe_id'     => ['type' => 'INTEGER', 'unsigned' => true, 'null' => false],
            'type_conge_id'  => ['type' => 'INTEGER', 'unsigned' => true, 'null' => false],
            'date_debut'     => ['type' => 'DATE', 'null' => false],
            'date_fin'       => ['type' => 'DATE', 'null' => false],
            'nb_jours'       => ['type' => 'DECIMAL', 'constraint' => '5,2', 'null' => false],
            'motif'          => ['type' => 'TEXT', 'null' => true],
            'statut'         => ['type' => 'VARCHAR', 'constraint' => 20,'default' => 'en_attente', 'null' => false, 'check' => "statut IN ('en_attente', 'approuvee', 'refusee', 'annulee')"],
            'commentaire_rh' => ['type' => 'TEXT', 'null' => true],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'traite_par'     => ['type' => 'INTEGER', 'unsigned' => true, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('employe_id', 'employes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('type_conge_id', 'types_conge', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('traite_par', 'employes', 'id', 'SET NULL', 'SET NULL');
        $this->forge->createTable('conges');
    }

    public function down()
    {
        $this->forge->dropTable('conges');
        
    }
}
