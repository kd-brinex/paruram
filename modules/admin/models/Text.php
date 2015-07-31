<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "otk_text".
 *
 * @property integer $id
 * @property string $text
 * @property integer $povod_id
 * @property integer $nati
 */
class Text extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otk_text';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'povod_id', 'nati'], 'required'],
            [['povod_id', 'nati'], 'integer'],
            [['autor'], 'string', 'max' => 250],
            [['text'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст поздравления',
            'povod_id' => 'Povod ID',
            'nati' => 'Обращение на "Ты"',
            'povodname' => 'Праздник',
            'autor' => 'Автор',
        ];
    }
    public function getPovod()
    {
        return $this->hasOne(Povod::className(), ['id' => 'povod_id']);
    }
    public function getPovodlist(){
        $models=Povod::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }
    public function getPovodname(){
        return $this->povod->name;
    }
}
