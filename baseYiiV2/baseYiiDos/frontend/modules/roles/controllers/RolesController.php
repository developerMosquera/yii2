<?php

namespace frontend\modules\roles\controllers;

use Yii;
use frontend\models\Roles;
use frontend\models\search\RolesSearch;
use frontend\models\Operaciones;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * RolesController implements the CRUD actions for Roles model.
 */
class RolesController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'create', 'update', 'view', 'delete', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * Lists all Roles models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Roles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Roles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Roles();

        $operaciones = Operaciones::find()->all();
        $operaciones = ArrayHelper::map($operaciones, 'idOperacion', 'nomOperacion');

        if($model->load(Yii::$app->request->post()))
        {
            if(!isset($_POST['Roles']['operacionesRol']))
            {
                $model->operacionesRol = [];
            } else {
                $model->operacionesRol = $_POST['Roles']['operacionesRol'];
            }

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->idRol]);
            }
        }

        return $this->render('create', [
            'model' => $model, 'operaciones' => $operaciones,
        ]);
    }

    /**
     * Updates an existing Roles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $operaciones = Operaciones::find()->all();
        $operaciones = ArrayHelper::map($operaciones, 'idOperacion', 'nomOperacion');

        $model->operacionesRol = ArrayHelper::getColumn($model->getRolesOperaciones()->asArray()->all(),'idOperacion');

        if($model->load(Yii::$app->request->post()))
        {
            if(!isset($_POST['Roles']['operacionesRol']))
            {
                $model->operacionesRol = [];
            } else {
                $model->operacionesRol = $_POST['Roles']['operacionesRol'];
            }

            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->idRol]);
            }
        }

        return $this->render('update', [
            'model' => $model, 'operaciones' => $operaciones,
        ]);
    }

    /**
     * Deletes an existing Roles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Roles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Roles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Roles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
