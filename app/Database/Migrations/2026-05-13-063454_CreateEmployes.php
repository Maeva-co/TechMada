<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEmployes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'              => ['type' => 'INTEGER', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nom'             => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => false],
            'prenom'          => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 150, 'unique' => true, 'null' => false],
            'password'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => false],
            'role'            => ['type' => 'VARCHAR', 'constraint' => 50, 'null' => false],
            'departement_id'  => ['type' => 'INTEGER', 'unsigned' => true, 'null' => false],
            'date_embauche'   => ['type' => 'DATE', 'null' => false],
            'actif'           => ['type' => 'INTEGER', 'constraint' => 1, 'default' => 1, 'null' => false, 'check' => 'actif IN (0, 1)'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('departement_id', 'departements', 'id', 'NO ACTION', 'NO ACTION');
        $this->forge->createTable('employes');
    }

    public function down()
    {
        $this->forge->dropTable('employes');
    }
}
