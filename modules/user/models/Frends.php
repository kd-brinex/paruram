<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 02.04.15
 * Time: 10:46
 */
namespace app\modules\user\models;
use app\modules\frends\models\FrendsSearch as BaseUser;

class Frends extends BaseUser{
    public function register()
    {
        return parent::register();
        // do your magic
    }

}