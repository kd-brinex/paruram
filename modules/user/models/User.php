<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 18.03.15
 * Time: 15:46
 */
namespace app\modules\user\models;

use dektrium\user\models\User as BaseUser;

class User extends BaseUser
{

    public function register()
    {
        return parent::register();
        // do your magic
    }
    public function rules()
    {
        $rules=parent::rules();
        $rules[1] =['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_-а-яА-Я\.@]+$/'];
        return $rules;
    }
}