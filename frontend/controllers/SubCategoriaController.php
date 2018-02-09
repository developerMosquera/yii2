<?php

//namespace app\controllers;
namespace frontend\controllers;

use Yii;
use app\models\SubCategoria;
use app\models\SubCategoriaSearch;
use app\models\Categorias;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SubCategoriaController implements the CRUD actions for SubCategoria model.
 */
class SubCategoriaController extends Controller
{
    /**
     * @inheritdoc
     */
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
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','create','update','view'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    public function categoriasListAll()
    {
        $modelCategorias = new Categorias();
        $categoriasListAll = ArrayHelper::map($modelCategorias::find()->all(), 'idCategoria', 'Categoria');
        return $categoriasListAll;
    }

    /**
     * Lists all SubCategoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubCategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubCategoria model.
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
     * Creates a new SubCategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubCategoria();

        if ($model->load(Yii::$app->request->post())) {
            //$model->estadoSubCategoria = 1;
            if($model->save())
            {
                return $this->redirect(['view', 'id' => $model->idSubCategoria]);
            }
        }

        return $this->render('create', [
            'model' => $model, 'categoriasListAll' => $this->categoriasListAll(),
        ]);
    }

    /**
     * Updates an existing SubCategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $estadoSubCategoria = array("1" => "Activo", "0" => "Inactivo");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idSubCategoria]);
        }

        return $this->render('update', [
            'model' => $model, 'categoriasListAll' => $this->categoriasListAll(), 'estadoSubCategoria' => $estadoSubCategoria,
        ]);
    }

    /**
     * Deletes an existing SubCategoria model.
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
     * Finds the SubCategoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SubCategoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubCategoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
