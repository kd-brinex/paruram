<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * This is the model class for table "otk_povod".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property integer $weekday
 * @property integer $days
 * @property string $function
 *
 * @property Blank[] $Blanks
 */
class Povod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otk_povod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['month', 'days', 'function', 'name'], 'required'],
            [['days', 'month'], 'integer'],
            [['name', 'function'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 200],
            [['name'], 'unique'],
//            [['date'],'date']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'days' => 'День',
            'month' => 'Месяц',
            'function' => 'Функция',
            'description'=>'Описание',
            'date'=>'Ближайшая дата',
            'group'=>'Группа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlanks()
    {
        return $this->hasMany(Blank::className(), ['povod_id' => 'id']);
    }
    public function getDate(){

        $func=$this->function;

        return  call_user_func([$this, $func]);
    }
    public function every_year()
    {
        $now=time();
//        $date = new DateTime();
//        $date=$this->povod->days.'.'.$this->povod->month.'.'.$year;
        $date = mktime(0, 0, 0, $this->month, $this->days, date("Y"));
        $date = ($date < $now) ? mktime(0, 0, 0, $this->month, $this->days, date("Y")+1):$date ;
//        return date('d.m.Y', $date);
        return $date;
    }
    public function bothday(){

        $bd=time();
        $now=time();
        $date=mktime(0,0,0,date('m',$bd),date('d',$bd),date('Y'));
        $date = ($date < $now) ? mktime(0,0,0,date('m',$bd),date('d',$bd),date('Y')+1):$date ;
        return $date;
    }

    public function getPovodurl(){
        return Url::toRoute(['admin/povod/povod','id'=>$this->id],true);
    }
    public function getPovodurla(){
        return HTML::a($this->name,$this->povodurl);
    }
}
