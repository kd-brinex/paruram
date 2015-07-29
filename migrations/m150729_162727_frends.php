<?php

use yii\db\Schema;
use yii\db\Migration;

class m150729_162727_frends extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('frends', [
            'id' => Schema::TYPE_PK,
            'name' => "VARCHAR(25) NOT NULL",
            'bothday' => Schema::TYPE_DATE,
            'user_id' => Schema::TYPE_INTEGER,
            'email' =>"VARCHAR(25) NOT NULL",
            'enable'=>Schema::TYPE_BOOLEAN,
            'sex'=>Schema::TYPE_INTEGER . ' NULL',
            'prefics'=>"VARCHAR(45) NOT NULL",
            'fname'=>"VARCHAR(25) NOT NULL",
            'oname'=>"VARCHAR(25) NOT NULL",
            'nati'=>Schema::TYPE_BOOLEAN." NOT NULL DEFAULT FALSE",
            'photo'=>"VARCHAR(250) NULL",
            'provider'=>"VARCHAR(15) NULL",
            'pid'=>Schema::TYPE_INTEGER,
            'domain'=>"VARCHAR(25) NULL"
        ], $tableOptions);
        $this->createIndex('i_provider', 'frends', 'provider,pid,user_id', true);

        $this->createTable('frend_povod',[
            'id'=>Schema::TYPE_PK,
            'frend_id'=>Schema::TYPE_INTEGER. ' NOT NULL',
            'povod_id'=>Schema::TYPE_INTEGER. ' NOT NULL',
            'enable'=>Schema::TYPE_BOOLEAN. ' NOT NULL DEFAULT true',
        ]);
        $this->createIndex('i_frend_povod','frend_povod','frend_id,povod_id',true);

        $this->addForeignKey(
            'FK_povod_frend_frends','frend_povod', 'frend_id',  'frends', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_povods_frend_povod','frend_povod', 'povod_id',  'otk_povod', 'id', 'CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        echo "m150729_162727_frends cannot be reverted.\n";
        $this->dropTable('frend_povod');
        $this->dropTable('frends');

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
