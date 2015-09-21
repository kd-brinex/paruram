<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\admin\models\PovodSearch;
use app\modules\admin\models\ImageSearch;
use app\modules\frends\models\FrendpovodSearch;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','userpovod'],
                'rules' => [
                    [
                        'actions' => ['logout','userpovod','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
//	$this->layout = false;
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionUserpovod()
    {
        //Если гость то выводим список праздников
//        if (\Yii::$app->user->isGuest) {
//            $model=new PovodSearch();
//            $provider=$model->search([]);
//            $columns=[
//                'date:date',
//                'name',
//                'description',
//            ];
//            return $this->redirect('login');
//        } //Если зашел пользователь то
//        else {

            $model = new FrendpovodSearch();
            $id=Yii::$app->user->id;
//        var_dump($id);die;
            $provider = $model->searchPovod(['user_id'=>$id]);
//            var_dump($provider->models[0]);die;
            $columns = [
                'happyday:date',
                'povodname',
//                'frendname',
                'psevdoname',
//                'frendurl',
//                'email',
//                'fcount',
//                'enable',
//                'description',
            ];
           $vars = ['frendpovod' => ['provider' => $provider, 'columns' => $columns]];
            return $this->render('userpovod', $vars);
//        }





    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

}
