<?php

namespace app\modules\frends\models;

use Yii;
use  app\modules\admin\models\Povod;
use app\modules\frends\models\Frends;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "frend_povod".
 *
 * @property integer $id
 * @property integer $frend_id
 * @property integer $povod_id
 *
 * @property Frends $frend
 * @property OtkPovod $povod
 */
class Frendpovod extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frend_povod';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['frend_id', 'povod_id', 'enable', 'id'], 'required'],
            [['frend_id', 'povod_id','enable','id'], 'integer'],
//            [['frendname', 'povodname'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'frendname' => 'Друг',
            'povodname' => 'Праздник',
            'happyday'  => 'Дата',
            'fcount'    => 'Всего',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrend()
    {
        return $this->hasOne(Frends::className(), ['id' => 'frend_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPovod()
    {
        return $this->hasOne(Povod::className(), ['id' => 'povod_id']);
    }

    public function getFrendname()
    {
        return $this->frend->name;
    }
    public function getFunction(){
        return $this->povod->function;
    }
    public function getUser_id(){
        return $this->frend->user_id;
    }
    public function getPovodname()
    {
        return $this->povod->name;
    }

    public function getPovodlist()
    {
        $models = Povod::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
    public function getFrendslist()
    {
        $id=Yii::$app->user->id;
//        $id=Yii::$app->user->identity->getId();
        $models =Frends::find()->where('user_id=:user_id',['user_id'=>$id])
            ->asArray()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
    public function updateFrendpovod($params)
    {
//        $this->insert(true,$params);
//        var_dump($params);die;
        $command = $this->getDb()->createCommand(
            'insert into frend_povod (frend_id,povod_id,enable)values(' . $params['frend_id'] . ',' . $params['povod_id'] . ',true)
ON DUPLICATE KEY UPDATE enable=' . $params['enable']);
//        $command->params=$params;
        $command->execute();
    }
    public function getDate(){

        $func=$this->function;
//       return  call_user_func($func);
       return  call_user_func([$this, $func]);
    }
    public function every_year()
    {
        return  $this->povod->date;
}
    public function bothday(){
        $bd=strtotime($this->frend->bothday);
        $now=time();
//        var_dump($bd,date('m',$bd));die;
        $date=mktime(0,0,0,date('m',$bd),date('d',$bd),date('Y'));
        $date = ($date < $now) ? mktime(0,0,0,date('m',$bd),date('d',$bd),date('Y')+1):$date ;
//        $date=$this->povod->bothday;
        return $date;
    }
    public function getFrendurl(){
        return '/frends/frends/view/?id='.(int) $this->frend_id;
    }
}