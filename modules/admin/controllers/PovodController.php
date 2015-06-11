<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Povod;
use app\modules\admin\models\PovodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\modules\admin\models\Ics;
use yii\web\UploadedFile;

/**
 * OtkPovodController implements the CRUD actions for OtkPovod model.
 */
class PovodController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view','import','icsfile'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->identity->getIsAdmin();
                        }
                    ],
                    [
                        'actions'=>['povod'],
                        'allow'=>true,
                        'roles'=>['?','@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all OtkPovod models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PovodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OtkPovod model.
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
     * Creates a new OtkPovod model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Povod();
        var_dump(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OtkPovod model.
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
     * Deletes an existing OtkPovod model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    public function actionPovod($id)
    {
        return $this->render('povod', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Finds the OtkPovod model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OtkPovod the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Povod::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionImport(){
        $model = new Ics();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->file && $model->validate()) {
                $model->file->saveAs(Yii::$app->basePath . '/web' .Yii::$app->params['uploadPath'] . $model->file->baseName . '.' . $model->file->extension);
            }
        }
        return $this->render('import',['model' => $model]);
    }
    public function actionIcsfile($file){
//        var_dump(Ics::getUpload().$file);die;

        $afile=Ics::PovodArray($file);
        return $this->render('icsfile',['afile' => $afile]);
    }
}
