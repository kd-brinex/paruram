<?php

use yii\db\Schema;
use yii\db\Migration;

class m150727_192249_otk extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('otk_povod', [
            'id' => Schema::TYPE_PK,
            'name' => "VARCHAR(50) NOT NULL",
            'days' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0' ,
            'function' => "VARCHAR(50) NULL DEFAULT 'every_year'",
            'month'=>Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
            'description'=>Schema::TYPE_STRING . ' NULL',
        ], $tableOptions);
        $this->createIndex('i_name', 'otk_povod', 'name', true);

        $this->createTable('otk_text', [
            'id' => Schema::TYPE_PK,
            'text' => Schema::TYPE_TEXT . ' NOT NULL',
            'povod_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'nati' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0',
        ], $tableOptions);

        $this->createTable('otk_image', [
            'id' => Schema::TYPE_PK,
            'image' => 'VARCHAR(45) NULL',
            'title' => Schema::TYPE_STRING . ' NULL',
            'povod_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey(
            'FK_povod_image', 'otk_image', 'povod_id', 'otk_povod', 'id','CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_povod_text','otk_text', 'povod_id',  'otk_povod', 'id', 'CASCADE', 'CASCADE'
        );

    }

    public function down()
    {
        echo "m150727_192249_otk cannot be reverted.\n";
        $this->dropTable('otk_text');
        $this->dropTable('otk_image');
        $this->dropTable('otk_povod');
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
