<?php

namespace app\modules\admin\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\OtkPovod;

/**
 * OtkPovodSearch represents the model behind the search form about `app\modules\admin\models\OtkPovod`.
 */
class PovodSearch extends Povod
{
    /**
     * @inheritdoc
     */
    public $date;
    public $povodurl;
    public $povodurla;

    public function rules()
    {
        return [
            [['id', 'days', 'month','date'], 'integer'],
            [['name', 'function','description'], 'safe'],
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
        $query = Povod::find();

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
            'month' => $this->month,
            'function' => $this->function,
            'days' => $this->days,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        $dataProvider->setSort([
            'attributes'=>[
                'date'=>[
                    'asc' => ['month' => SORT_ASC, 'days' => SORT_ASC,],
                    'desc' => ['month' => SORT_DESC, 'days' => SORT_DESC,],
                    'default'=> SORT_ASC],
            ]
        ]);

        return $dataProvider;
    }
    public function searchuser($param)
    {
        $query = Povod::find();

    }
}
