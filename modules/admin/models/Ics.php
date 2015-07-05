<?php
namespace app\modules\admin\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use Sabre\VObject\Reader;
///var/www/paruram.dev/vendor/sabre/vobject/lib/Reader.php
/**
* UploadForm is the model behind the upload form.
*/
class Ics extends Model
{
/**
* @var UploadedFile file attribute
*/
public $file;

/**
* @return array the validation rules.
*/
public function rules()
{
return [
[['file'], 'file'],
];
}
    public function filelist(){
        $files= FileHelper::findFiles($this->getUpload());
    return $files;
    }
    public static function getUpload(){
    return \Yii::$app->basePath . '/web' .\Yii::$app->params['uploadPath'];
    }
    public function pathurl()
    {
        return \Yii::$app->request->BaseUrl. \Yii::$app->params['uploadPath'];
    }
    public static function PovodArray($file){
//        $text = file(static::getUpload().$file);
//        $text = VObject\Reader::read(fopen(static::getUpload().$file,'r'));
        $vcal = Reader::read(fopen(static::getUpload().$file, 'r'));
        $text=json_encode($vcal->jsonSerialize());

        return $text;

    }
}