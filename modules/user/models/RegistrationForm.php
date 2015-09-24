<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace app\modules\user\models;

use dektrium\user\models\RegistrationForm as BaseModel;
//use yii\base\Model;

/**
 * Registration form collects user input on registration process, validates it and creates new User model.
 *
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class RegistrationForm extends BaseModel
{
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_-а-яА-Я\.@]+$/'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => $this->module->modelMap['User'],
                'message' => \Yii::t('user', 'This username has already been taken')],
            ['username', 'string', 'min' => 3, 'max' => 20],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => $this->module->modelMap['User'],
                'message' => \Yii::t('user', 'This email address has already been taken')],

            ['password', 'required', 'skipOnEmpty' => $this->module->enableGeneratingPassword],
            ['password', 'string', 'min' => 6],
        ];
    }
//    public function rules()
//    {
//        $rules=parent::rules();
//        $rules[1] =['username', 'match', 'pattern' => '/^[-a-zA-Z0-9_-а-яА-Я\.@]+$/'];
//        return $rules;
//    }


}