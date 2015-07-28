<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;
use app\modules\admin\models\Work;

//use app\modules\frends\models\FrendpovodSearch;

class AdminController extends Controller
{
    public function actionIndex()
    {
        $model = new Work();
        $provider = $model->searchPovod("");
//            var_dump($provider->models[0]);die;

        $vars = ['frendpovod' => [
            'provider' => $provider,
            'searchModel' => $model,
            ]];
        return $this->render('index', $vars);
//        return $this->render('index');

    }
    public function actionWork()
    {
        $model = new Work();
        $model->sendMessage();
        return $this->redirect('index');
    }
    public function actionPlan()
    {
        $model = new Work();
        $dp=$model->searchPovodPlan();
        return $this->render('plan', ['dataProvider'=>$dp]);
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
                        'actions' => ['index','work','plan'],
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
