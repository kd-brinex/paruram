<?php

namespace app\modules\frends\controllers;

use Yii;
use app\modules\frends\models\Frendpovod;
use app\modules\frends\models\FrendpovodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * FrendPovodController implements the CRUD actions for Frendpovod model.
 */
class FrendpovodController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'listall'],
                        'allow' => true,
//                        'roles' => ['@'],
                        'roles' => ['@'],
//                        'matchCallback' => function ($rule, $action) {
//                            return \Yii::$app->user->identity->getIsAdmin();
//                        }
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Frendpovod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FrendpovodSearch();
//        $id=Yii::$app->user->identity->getId();
        $params=Yii::$app->request->queryParams;
        $dataProvider = $searchModel->searchPovod($params);


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Frendpovod model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Frendpovod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Frendpovod();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Frendpovod model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Frendpovod model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Frendpovod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Frendpovod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Frendpovod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionListall(){
        $model =new FrendpovodSearch();
        $params=$model->listall();
        return $this->render('listall',$params
//        return $this->render('listall',['flist' => $frend_list,'plist'=>$povod_list,'fp'=>$fp
);
    }

}
