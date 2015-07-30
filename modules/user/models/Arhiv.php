<?php

namespace app\modules\user\models;

use Yii;
use app\modules\admin\models\Povod;
use app\modules\admin\models\Image;
use app\modules\admin\models\Text;
use app\modules\frends\models\Frends;

/**
 * This is the model class for table "arhiv".
 *
 * @property integer $id
 * @property integer $povod_id
 * @property integer $frend_id
 * @property integer $image_id
 * @property integer $text_id
 * @property string $happyday
 * @property resource $data
 *
 * @property Frends $frend
 * @property OtkImage $image
 * @property OtkPovod $povod
 * @property OtkText $text
 */
class Arhiv extends \yii\db\ActiveRecord

{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'arhiv';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['povod_id', 'frend_id', 'image_id', 'text_id', 'happyday'], 'required'],
            [['povod_id', 'frend_id', 'image_id', 'text_id'], 'integer'],
            [['happyday'], 'safe'],
            [['data'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'povod_id' => 'Povod ID',
            'frend_id' => 'Frend ID',
            'image_id' => 'Image ID',
            'text_id' => 'Text ID',
            'happyday' => 'Happyday',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFrend()
    {
        return $this->hasOne(Frends::className(), ['id' => 'frend_id']);
    }
    public function getUser_id()
    {
        return $this->frend->user_id;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPovod()
    {
        return $this->hasOne(Povod::className(), ['id' => 'povod_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getText()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }

}
