<?php
namespace app\modules\admin\models;
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 23.06.15
 * Time: 18:13
 */
use app\modules\frends\models\FrendpovodSearch;
use dosamigos\qrcode\lib\Image;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\db\Connection;
use yii\helpers\Html;

class Work
{
    public $image;
    public $text;
    public function you($ti)
    {
        return ($ti)?'ты':'вы';
    }
    public function thee($ti)
    {
        return ($ti)?'тебя':'вас';
    }
    public function searchPovod($params)
    {
        $query = new Query();
        $query->Select("p.*,
        u.name username,
        i.image as image,
        i.autor as autor_image,
        t.autor as autor_text,
        t.text text,
        a.happyday isp,
        f.email,
        f.nati,
        f.prefics,
        i.id image_id,
        t.id text_id,
        u.public_email")
            ->from('povod p')
            ->leftjoin('otk_image i','i.povod_id = p.povod_id')
            ->leftjoin('otk_text t','t.povod_id = p.povod_id')
            ->leftjoin('arhiv a','p.povod_id=a.povod_id and a.frend_id = p.frend_id and a.happyday=p.happyday')
            ->leftJoin('frends f','f.id = p.frend_id')
            ->leftJoin('profile u','u.user_id = p.user_id')
            ->where($params)
            ->groupBy(['p.frend_id', 'p.povod_id'])
            ->orderBy(['p.happyday' => 'asc', 'p.povodname' => 'asc', 'p.frendname' => 'asc']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
    }


    private function toBlob($data)
    {
        $s='COLUMN_CREATE(';
        foreach($data as $key=>$value)
        {
            $s.="'".$key."','".$value."',";
        }
        $ret=substr($s,0,-1).")";
        return $ret;
//        COLUMN_CREATE('color', 'blue', 'size', 'XL')
    }
    public function sendMessage()
    {
        date_default_timezone_set('Europe/Moscow');
        $autodate=date('Y-m-d');
//        $autodate='2015-07-13 00:00:00';

//        var_dump($autodate,date_default_timezone_get());
        $plan=$this->searchPovod(["p.happyday"=>$autodate])->models;
//        var_dump($plan);die;
        foreach($plan as $r){
//        var_dump($r);die;
            $r['you']=$this->you($r['nati']);
            $r['thee']=$this->thee($r['nati']);
            $r['image']=\Yii::$app->request->BaseUrl. \Yii::$app->params['imagePath'].$r['povod_id'].'/'.$r['image'];
//            var_dump(\Yii::$app->basePath.'/web'.$r['image']);die;
//            if(file_exists(\Yii::$app->basePath.'/web'.$r['image'])){
            if(!empty($r['image_id'])
                and !empty($r['text_id'])
            and !empty($r['public_email'])
                and empty($r['isp'])){

           \Yii::$app->mailer->compose('layouts/congratulation',$r)
                ->setFrom('happy@paruram.ru')

                ->setTo($r['public_email'])
//                ->setTo('hmf73@mail.ru')
                ->setSubject('Поздравление от '.$r['username'])
//                ->setTextBody($r['text'])
//                ->setHtmlBody('<b>'.$r['text'].'</b>')
                ->send();
            $this->insertArhiv($r);
        }}

    }
    public function insertArhiv($data)
    {
//        $query= new Connection(\Yii::$app->db);
//        var_dump($query);die;
//        $query->open();
        $s='';
        foreach($data as $key=>$val){
            $s.='"'.$key.'","'.str_replace(',','.',$val).'",';
        }
        $s='COLUMN_CREATE('.substr($s,0,-1).')';
//        var_dump($s);die;
        $sql="insert into arhiv (povod_id,frend_id,image_id,text_id,happyday,data) values (".$data['povod_id'].",".$data['frend_id'].",".$data['image_id'].",".$data['text_id'].",'".$data['happyday']."',".$s.")" ;
//        var_dump($sql);die;
        $query=\Yii::$app->db->createCommand($sql)->execute();
//        $query->createCommand("insert into arhiv (povod_id,frend_id,happyday,data) values (".$data['povod_id'].",".$data['frend_id'].",'".$data['happyday']."',".$this->toBlob($data).")" )->execute();
//        $query->createCommand()->execute();
    }
    public function searchPovodPlan()
    {
        $sql="SELECT
t.id povod_id,
  t.name,
  max(need)                  blank_count,
  (SELECT count(oi.id)
   FROM otk_image oi
   WHERE oi.povod_id = t.id) image_count,
  (SELECT count(ot.id)
   FROM otk_text ot
   WHERE ot.povod_id = t.id) text_count

FROM
(SELECT
     op.id,
     op.name,
     f.email,
     count(f.email) need
   FROM
     otk_povod op
     LEFT JOIN frend_povod fp ON op.id = fp.povod_id
     LEFT JOIN frends f ON f.id = fp.frend_id
   WHERE NOT f.email = ''
   GROUP BY f.email, op.id) t

GROUP BY t.id";
        $query=\Yii::$app->db->createCommand($sql)->queryAll();
//        var_dump($query);die;
        $dataProvider = new ArrayDataProvider([
            'allModels' => $query,
        ]);

        return $dataProvider;
    }
}