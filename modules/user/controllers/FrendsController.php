<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 02.04.15
 * Time: 10:49
 */

namespace app\modules\user\controllers;

use app\modules\frends\models\FrendsSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\frends\controllers\FrendsController as BaseController;


class FrendsController extends BaseController{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'disconnect' => ['post']
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['frends', 'view', 'update', 'create', 'delete', 'import'],
                        'roles'   => ['@']
                    ],
                ]
            ],
        ];
    }

    public function actionFrends()
    {
        $searchModel = new FrendsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        return $this->render('frends', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['frends']);
    }
    public function actionImport()
    {
        $searchModel = new FrendsSearch();
        $searchModel->importAccountFrend();
        return $this->redirect(['frends']);

    }
}