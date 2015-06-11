<?php

namespace app\modules\frends\controllers;

use app\modules\frends\models\FrendpovodSearch;
use Yii;
use app\modules\frends\models\Frends;
use app\modules\frends\models\FrendsSearch;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\models\PovodSearch;

//use app\modules\frends\models\FrendpovodSearch;
//use app\modules\admin\models\PovodSearch;
//use app\modules\frends\models\PovodSearch;

/**
 * FrendsController implements the CRUD actions for Frends model.
 */
class FrendsController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'pupdate', 'delete', 'view'],
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
     * Lists all Frends models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FrendsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Frends model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $query = new Query();
        $model=$this->findModel($id);
        $query->select('p.id as povod_id,p.name,
        (select fp.enable
        from frend_povod as fp
        where fp.povod_id=p.id
        and fp.frend_id=:frend_id) as enable')->
        from('otk_povod as p')->
        params([':frend_id'=>$id])->
        orderBy('name')->
        where('');
        $povod=$query->all();
        return $this->render('view', [
            'model' => $model,
            'povod'=> $povod,
        ]);
    }
    public function actionPupdate(){
    $model=new FrendpovodSearch();
//        var_dump($model);die;
        $post=Yii::$app->request->post();
        $model->updateFrendpovod($post);
           return $this->render(['view', 'id' => $post['frend_id']]);


    }
    /**
     * Creates a new Frends model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Frends();
	
//var_dump(Yii::$app->request->post());die;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Frends model.
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
     * Deletes an existing Frends model.
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
     * Finds the Frends model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Frends the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Frends::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
