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
        return [
            // username rules
            ['username', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_-а-яА-Я\.@]+$/'],
            ['username', 'string', 'min' => 3, 'max' => 25],
            ['username', 'unique'],
            ['username', 'trim'],

            // email rules
            ['email', 'required', 'on' => ['register', 'connect', 'create', 'update']],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique'],
            ['email', 'trim'],

            // password rules
            ['password', 'required', 'on' => ['register']],
            ['password', 'string', 'min' => 6, 'on' => ['register', 'create']],
        ];
    }
    public function scenarios()
    {
        return [
//            'register' => ['email', 'password'],
            'register' => ['username', 'email', 'password'],
            'connect' => ['username', 'email'],
            'create' => ['username', 'email', 'password'],
//            'update' => ['username', 'email', 'telephone', 'password'],
            'update' => ['username', 'email', 'password'],
            'settings' => ['username', 'email', 'telephone', 'password']
        ];
    }
    public function create()
    {
        if ($this->getIsNewRecord() == false) {
            throw new \RuntimeException('Calling "' . __CLASS__ . '::' . __METHOD__ . '" on existing user');
        }

        $this->confirmed_at = time();

        if ($this->password == null) {
            $this->password = Password::generate(8);
        }

        $this->trigger(self::USER_CREATE_INIT);

        if ($this->save()) {
            $this->trigger(self::USER_CREATE_DONE);
            $this->mailer->sendWelcomeMessage($this);
            \Yii::getLogger()->log('User has been created', Logger::LEVEL_INFO);
            return true;
        }

        \Yii::getLogger()->log('An error occurred while creating user account', Logger::LEVEL_ERROR);

        return false;
    }
}