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
        var_dump($rules);die;
//        return [
//            // username rules
//            ['username', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            $rules['pattern'] = '/^[-a-zA-Z0-9_-а-я\.@]+$/';
//            ['username', 'string', 'min' => 3, 'max' => 25],
//            ['username', 'unique'],
//            ['username', 'trim'],
//
//            // email rules
//            ['email', 'required', 'on' => ['register', 'connect', 'create', 'update']],
//            ['email', 'email'],
//            ['email', 'string', 'max' => 255],
//            ['email', 'unique'],
//            ['email', 'trim'],
//
//            // password rules
//            ['password', 'required', 'on' => ['register']],
//            ['password', 'string', 'min' => 6, 'on' => ['register', 'create']],
//        ];
        return $rules;
    }
}