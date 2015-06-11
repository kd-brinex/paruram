<?php

namespace app\modules\admin\controllers;

use Yii;
use app\modules\admin\models\Image;
use app\modules\admin\models\ImageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;

/**
 * ImageController implements the CRUD actions for Image model.
 */
class ImageController extends Controller
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
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return \Yii::$app->user->identity->getIsAdmin();
                        }
                    ],
                    [
                        'actions' => ['blank'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Image models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ImageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Image model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionBlank($id)
    {
        return $this->render('blank', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Image model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Image();

        if ($model->load(Yii::$app->request->post())) {
//            $image = UploadedFile::getInstance($model, 'image');
////            var_dump($image->name);die;
//            $name = explode(".", $image->name);
//            $ext = end($name);
//            $model->image = addslashes(Yii::$app->security->generateRandomString(32)) . '.' . $ext;
//            $path = Yii::$app->basePath . '/web' . Yii::$app->params['imagePath'] . $model->povod_id;
//            if (!file_exists($path)) {
//                mkdir($path);
//            }
//            //            var_dump($path);die;
//            if ($model->save()) {
//                $path = $path . '/' . $model->image;
//                $image->saveAs($path);
            if ($model->loadimage()){
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // error in saving model
            }

        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Image model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//var_dump(Yii::$app->request->post());die;
        if ($model->load(Yii::$app->request->post())&& $model->save() ) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Image model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Image model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Image the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Image::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
