<?php

use yii\db\Schema;
use yii\db\Migration;

class m150729_161221_povod extends Migration
{
    public function up()
    {
        $this->execute("
        CREATE
    ALGORITHM = UNDEFINED
    DEFINER = `paruram`@`localhost`
    SQL SECURITY DEFINER
VIEW `paruram`.`povod` AS
    select
        `p`.`name` AS `povodname`,
        `p`.`days` AS `days`,
        `p`.`month` AS `month`,
        `p`.`description` AS `description`,
        `f`.`bothday` AS `bothday`,
        concat(`f`.`fname`,
            ' ',
            `f`.`name`,
            ' ',
            `f`.`oname`) AS `frendname`,
        `f`.`user_id` AS `user_id`,
        `fp`.`frend_id` AS `frend_id`,
        `fp`.`povod_id` AS `povod_id`,
        `fp`.`id` AS `id`,
        set_year((case
                    when
                    (`p`.`function` = 'bothday')
                    then
                        concat(year(now()),
                            '-',
                            month(`f`.`bothday`),
                            '-',
                            dayofmonth(`f`.`bothday`))
                    when
                    (`p`.`function` = 'every_year')
                    then
                        concat(year(now()),
                            '-',
                            `p`.`month`,
                            '-',
                            `p`.`days`)
                    else now()
                end)) AS `happyday`,
        `p`.`function` AS `function`
    from
    ((`paruram`.`otk_povod` `p`
        left join `paruram`.`frend_povod` `fp` ON ((`p`.`id` = `fp`.`povod_id`)))
        left join `paruram`.`frends` `f` ON ((`f`.`id` = `fp`.`frend_id`)))
    where
    ((`f`.`enable` = 1)
        and (`fp`.`enable` = 1))");
    }

    public function down()
    {
        echo "m150729_161221_povod cannot be reverted.\n";
        $this->execute('DROP VIEW IF EXISTS `paruram`.`povod`');
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
