<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Image;

/**
 * ImageSearch represents the model behind the search form about `app\modules\admin\models\Image`.
 */
class ImageSearch extends Image
{
    /**
     * @inheritdoc
     */
    public $imageurl;
    public $imagepath;
    public $povodname;
    public $povodurl;
    public $blankurl;
        public function rules()
    {
        return [
            [['id','povod_id'], 'integer'],
            [['image', 'title','povodname'], 'safe'],
//            [['name'],'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Image::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title]);
//            ->andFilterWhere(['like', 'povodname', $this->povodname]);

        $query->joinWith(['povod' => function ($q) {
            $q->where('name LIKE "%' . $this->povodname . '%" ');
        }]);
        return $dataProvider;
    }

}
