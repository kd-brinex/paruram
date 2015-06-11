<?php

namespace app\modules\admin\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\UploadedFile;

/**
 * This is the model class for table "otk_image".
 *
 * @property integer $id
 * @property string $image
 * @property integer $autor_id
 * @property string $title
 *
 * @property OtkBlank[] $otkBlanks
 * @property OtkAutor $autor
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otk_image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'povod_id'], 'required'],
            [['image'], 'string'],
//            [['image'], 'file', 'extensions'=>'jpg, gif, png','maxSize'=>1024*1024,],
            [['title'], 'string', 'max' => 250],
            [['povod_id'], 'integer'],



        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Код',
            'image' => 'Бланк',
            'title' => 'Подпись',
            'povodurl' => 'Праздник',
            'blankurl'=>'Бланк поздравления',
            'povodname'=>'Праздник',
            'imageurl'=>'Изображение',

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getOtkBlanks()
//    {
//        return $this->hasMany(Blank::className(), ['image_id' => 'id']);
//    }

    /**
     * @return \yii\db\ActiveQuery
     */
//    public function getAutor()
//    {
//        return $this->hasMany(Autor::className(), ['id' => 'autor_id']);
//    }
    public function getImageurl()
    {
        return Yii::$app->request->BaseUrl. Yii::$app->params['imagePath'].$this->povod_id.'/'.$this->image;
    }
    public function getImagepath()
    {
//       var_dump(Yii::$app->basePath .'/web'. Yii::$app->params['imagePath'] .$this->povod_id.'/'. $this->image);die;
       return Yii::$app->basePath .'/web'. Yii::$app->params['imagePath'] .$this->povod_id.'/'. $this->image;
    }
    public function beforeDelete()
    {
//var_dump($this->getImagepath());die;
        unlink($this->getImagepath());
        return parent::beforeDelete();
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
    public function getBlankurl(){
        $url=Url::toRoute(['admin/image/blank','id'=>$this->id],true);
            return HTML::a($this->povodname,$url);
    }
    public function getPovodurl(){
        return $this->povod->povodurla;
    }
    public function loadimage()
    {


            $image = UploadedFile::getInstance($this, 'image');
//            var_dump($image->name);die;
            $name = explode(".", $image->name);
            $ext = end($name);
            $this->image = addslashes(Yii::$app->security->generateRandomString(32)) . '.' . $ext;
            $path = Yii::$app->basePath . '/web' . Yii::$app->params['imagePath'] . $this->povod_id;
            if (!file_exists($path)) {
                mkdir($path);
            }
            //            var_dump($path);die;
            if ($this->save()) {
                $path = $path . '/' . $this->image;
                $image->saveAs($path);
                return true;
        }
        return true;
    }
 }
