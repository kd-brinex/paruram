<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\frends\models\FrendpovodSearch;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $model = new FrendpovodSearch();
        $provider = $model->searchPovod([]);
//            var_dump($provider->models[0]);die;
        $columns = [
            'happyday:date',
            'povodname',
            'frendname',
            'user_id'
//                'fcount',
//                'enable',
//                'description',
        ];
        $vars = ['frendpovod' => [
            'provider' => $provider,
            'searchModel' => $model,
            'columns' => $columns]];
        return $this->render('index', $vars);
//        return $this->render('index');

    }
    public function behaviors()
    {
        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['post'],
//                ],
//            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->identity->getIsAdmin();
                        }
                    ],
                ]
            ],
        ];
    }

}
