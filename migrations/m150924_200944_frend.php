<?php

use yii\db\Schema;
use yii\db\Migration;

class m150924_200944_frend extends Migration
{
//    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m150924_200944_frend cannot be reverted.\n";
//
//        return false;
//    }


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->dropColumn('frends','fname');
        $this->dropColumn('frends','oname');
        $this->dropColumn('frends','prefics');
        $this->dropColumn('frends','photo');
        $this->alterColumn('frends','name',Schema::TYPE_STRING.'(50)');
    }

    public function safeDown()
    {
        $this->addColumn('frends','fname',Schema::TYPE_STRING.'(25)');
        $this->addColumn('frends','oname',Schema::TYPE_STRING.'(25)');
        $this->addColumn('frends','prefics',Schema::TYPE_STRING.'(45)');
        $this->addColumn('frends','photo',Schema::TYPE_STRING.'(250)');
        $this->alterColumn('frends','name',Schema::TYPE_STRING.'(25)');
    }

}
