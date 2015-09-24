<?php

namespace app\modules\frends\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "frends".
 *
 * @property integer $id
 * @property string $name
 * @property string $bothday
 * @property integer $user_id
 * @property string $email
 * @property integer $enable
 */
class Frends extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frends';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'enable',  'nati'], 'required'],
            [['bothday'], 'string'],
            [['user_id', 'enable', 'sex', 'id', 'nati', 'pid'], 'integer'],
            [['name'], 'string', 'max' => 25],
            [['domain'], 'string', 'max' => 25],
            [['provider'], 'string', 'max' => 15],
            [['email'], 'email']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '#',
            'name' => 'Имя',
            'bothday' => 'День рождения',
            'user_id' => 'User_ID',
            'email' => 'Email',
            'enable' => 'Поздравлять',
            'sexname' => 'Пол',
            'sex' => 'Пол',
            'nati' => 'Обращаться на "ты".',
            'provider' => 'Сеть',
            'pid' => 'Индекс',
            'domain' => 'Домен',
            'providerlogo'=>'Сеть',
            'valid'=>'Проверка',
        ];
    }

    public function beforeSave($insert)
    {

        if (parent::beforeSave($insert)) {

            $this->bothday = date('Y-m-d', strtotime($this->bothday));//strtotime($this->date_start);

            return true;
        } else {
            return false;
        }
    }

    public static function find()
    {
        $user_id = Yii::$app->user->id;
        $find = parent::find();
        $find->andWhere('user_id=:user_id', [':user_id' => $user_id]);
//        $find->andFilterWhere(['=', 'user_id', $user_id]);
        return $find;
    }

    public function afterFind()
    {
        $date = date('d.m.Y', strtotime($this->bothday));
        $this->bothday = $date;
        parent::afterFind();
    }

    public function getSexname()
    {
        return (($this->sex) == 0) ? '-' : (($this->sex) == 2) ? "мужской" : "женский";
    }





    public function getProviderlogo()
    {

        return Html::tag('span', '', ['class' => 'auth-icon ' . $this->provider]);
    }
    public function getValid()
    {
        if ( strpos($this->email,'@')==0){return false;}
        if  (!$this->enable){return false;}
        if ($this->name==''){return false;}
        return true;
    }
}
