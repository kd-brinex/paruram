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
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\db\Connection;

class Work
{
    public $image;
    public $text;
    public function searchPovod($params)
    {
        $query = new Query();
        $query->Select("p.*, i.image as image, t.text text, a.happyday isp ")
            ->from('povod p')
            ->leftjoin('otk_image i','i.povod_id = p.povod_id')
            ->leftjoin('otk_text t','t.povod_id = p.povod_id')
            ->leftjoin('arhiv a','p.povod_id=a.povod_id and a.frend_id = p.frend_id and a.happyday=p.happyday')
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
        $plan=$this->searchPovod("p.happyday = '2015.07.25'")->models;
        foreach($plan as $r)
        {
            $this->insertArhiv([
                'povod_id'=>$r['povod_id'],
                'frend_id'=>$r['frend_id'],
                'happyday'=>$r['happyday'],
//                'data'=>':data'
            ]);
        }

    }
    public function insertArhiv($data)
    {
        $query= new Connection(\Yii::$app->db);
//        var_dump($query);die;
        $query->open();
//        $query->createCommand("insert into arhiv (povod_id,frend_id,happyday,data) values (".$data['povod_id'].",".$data['frend_id'].",'".$data['happyday']."',".$this->toBlob($data).")" )->execute();
        $query->createCommand("insert into arhiv (povod_id,frend_id,happyday) values (".$data['povod_id'].",".$data['frend_id'].",'".$data['happyday']."')" )->execute();
    }

}