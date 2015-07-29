<?php

namespace app\modules\frends\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\frends\models\Frendpovod;

/**
 * FrendpovodSearch represents the model behind the search form about `app\modules\frends\models\Frendpovod`.
 */
class FrendpovodSearch extends Frendpovod
{
    /**
     * @inheritdoc
     */
    public $frendname;
    public $povodname;
    public $user_id;
    public $function;
    public $date;
    public $frendurl;
    public $happyday;
    public $fcount;
    public $psevdoname;

    public function rules()
    {
        return [
            [['id', 'frend_id', 'povod_id', 'enable', 'date'], 'integer'],
            [['frendname', 'povodname', 'frendurl'], 'string'],

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
        $id = Yii::$app->user->identity->getId();
        $query = Frendpovod::find()->
//            select('*,f.name as frendname,p.name as povodname')->
        leftJoin('`frends` as `f`', '`f`.`id`=`frend_id`')->
        leftJoin('`otk_povod` as `p`', '`p`.`id`=`povod_id`')->
        where('user_id=:user_id', ['user_id' => $id]);


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
            'frendname' => $this->frendname,
            'povodname' => $this->povodname,
        ]);
        $dataProvider->setSort([
            'attributes' => [
                'date' => [
                    'asc' => ['month' => SORT_ASC, 'days' => SORT_ASC],
                    'desc' => ['month' => SORT_DESC, 'days' => SORT_DESC],
                    'default' => SORT_ASC
                ],
            ]
        ]);
        return $dataProvider;
    }

    public function searchPovod($params)
    {

        $query = FrendpovodSearch::find()->
        Select("*")->
        from(['povod'])->
        where($params)->
        groupBy(['frend_id', 'povod_id'])->
        orderBy(['happyday' => 'asc', 'povodname' => 'asc', 'frendname' => 'asc']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;

    }

    public function listall()
    {
        $user_id = Yii::$app->user->id;
        $flist = $this->Frendslist;
        $plist = $this->Povodlist;
        $frend_list = [];
        $povod_list = [];
        $fp = $this->searchPovod(['user_id' => $user_id])->getModels();
        foreach ($fp as $f) {
//            var_dump($f);
            if (!isset($frend_list[$f['frend_id']])) {
                $frend_list[$f['frend_id']] = ['name' => $flist[(int)$f['frend_id']],
                    'frendurl' => $f['frendurl']];
                $frend_list[$f['frend_id']]['enable'] = [];
                $frend_list[$f['frend_id']]['enable'][$f['povod_id']] = $f['enable'];
            } else {
                $frend_list[$f['frend_id']]['enable'][$f['povod_id']] = $f['enable'];
            }
            if (!isset($povod_list[$f['povod_id']])) {
                $povod_list[$f['povod_id']] = $plist[(int)$f['povod_id']];
            }
        }
        return ['frend_list' => $frend_list, 'povod_list' => $povod_list, 'fp' => $fp];
    }


}
