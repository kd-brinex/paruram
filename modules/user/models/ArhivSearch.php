<?php
namespace app\modules\user\models;


use yii\data\ActiveDataProvider;
class ArhivSearch extends Arhiv
{
    public $user_id;
    public function search()
    {
        $query = Arhiv::find()
        ->leftJoin('frends f','f.id=frend_id')
//        ->leftJoin('user u','u.id=f.user_id')
        ->andWhere('f.user_id=:user_id',[':user_id'=>\Yii::$app->user->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

//        $this->load($params);


//        $query->andFilterWhere(['like', 'image', $this->image])
//            ->andFilterWhere(['like', 'title', $this->title]);
//            ->andFilterWhere(['like', 'povodname', $this->povodname]);

//        $query->joinWith(['povod' => function ($q) {
//            $q->where('name LIKE "%' . $this->povodname . '%" ');
//        }]);
        return $dataProvider;
    }

}