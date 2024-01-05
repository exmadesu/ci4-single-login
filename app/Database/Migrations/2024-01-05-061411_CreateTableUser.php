<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableUser extends Migration
{
    public function up()
    {
        $this->forge->addField('id');
        $this->forge->addField([
            'email'      => ['type'=>'VARCHAR','constraint'=>50,'unique'=>true],
            'password'   => ['type'=>'VARCHAR','constraint'=>200],
            'fullname'   => ['type'=>'VARCHAR','constraint'=>50],
            'ip_address' => ['type'=>'VARCHAR','constraint'=>30,'null'=>true],
            'token'      => ['type'=>'VARCHAR','constraint'=>32,'null'=>true],
            'created_at' => ['type'=>'TIMESTAMP'],
            'updated_at' => ['type'=>'DATETIME','null'=>true,'default'=>null],
        ]);
        $this->forge->createTable('users',true);
    }

    public function down()
    {
        $this->forge->dropTable('users',true);
    }
}
