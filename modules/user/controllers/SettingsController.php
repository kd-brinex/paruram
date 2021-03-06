<?php
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 23.03.15
 * Time: 9:46
 */
namespace app\modules\user\controllers;

use app\modules\user\models\ArhivSearch;
use dektrium\user\controllers\SettingsController as BaseSettingsController;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class SettingsController extends BaseSettingsController
{
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
                        'actions' => ['profile', 'account', 'confirm', 'networks', 'connect', 'disconnect',
                            'frends', 'frendview', 'frendupdate', 'history'],
                        'roles'   => ['@']
                    ],
                ]
            ],
        ];
    }

    public function actionHistory()
    {
        $model=new ArhivSearch();
        $dp=$model->search();
       return  $this->render('history',['dataProvider'=>$dp]);
    }
}