<?php

use yii\db\Schema;
use yii\db\Migration;

class m150728_194847_arhiv extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('arhiv', [
            'id' => Schema::TYPE_PK,
            'povod_id' => Schema::TYPE_INTEGER." NOT NULL",
            'frend_id' => Schema::TYPE_INTEGER . ' NOT NULL' ,
            'image_id' => Schema::TYPE_INTEGER . ' NOT NULL' ,
            'text_id'  => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
        $this->createIndex('Index_povod','arhiv', 'povod_id',false);
        $this->createIndex('Index_frend','arhiv', 'frend_id',false);
        $this->createIndex('Index_image','arhiv', 'image_id',false);
        $this->createIndex('Index_text','arhiv', 'text_id',false);
        $this->addForeignKey(
            'FK_arhiv_povod' , 'arhiv', 'povod_id', 'otk_povod', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_arhiv_image', 'arhiv', 'image_id', 'otk_image', 'id', 'CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_arhiv_frend', 'arhiv', 'frend_id', 'frends', 'id','CASCADE', 'CASCADE'
        );
        $this->addForeignKey(
            'FK_arhiv_text', 'arhiv', 'text_id',  'otk_text', 'id','CASCADE', 'CASCADE'
        );
    }

    public function down()
    {
        echo "m150728_194847_arhiv cannot be reverted.\n";
        $this->dropTable('arhiv');
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
