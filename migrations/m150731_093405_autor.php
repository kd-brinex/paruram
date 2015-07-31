<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_093405_autor extends Migration
{
    public function up()
    {
        $this->addColumn('otk_image','autor',Schema::TYPE_STRING);
        $this->addColumn('otk_text','autor',Schema::TYPE_STRING);
    }

    public function down()
    {
        echo "m150731_093405_autor cannot be reverted.\n";
        $this->dropColumn('otk_text','autor');
        $this->dropColumn('otk_image','autor');
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
