<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_140204_set_year extends Migration
{
    public function up()
    {
    $this->hasMethod('set_year');
    }

    public function down()
    {
        echo "m150731_140204_set_year cannot be reverted.\n";

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
