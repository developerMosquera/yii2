<?php

//namespace app\controllers;
namespace frontend\controllers;


use Yii;
use app\models\Productos;
use app\models\ProductosSearch;
use app\models\SubCategoria;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * ProductosController implements the CRUD actions for Productos model.
 */
class ProductosController extends Controller
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

    public function subCategoriasListAll()
    {
        $modelSubCategorias = new SubCategoria();
        $subCategoriasListAll = ArrayHelper::map($modelSubCategorias::find()->all(), 'idSubCategoria', 'SubCategoria');
        return $subCategoriasListAll;
    }

    /**
     * Lists all Productos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload()
    {
        $model = new Productos();

        $ruta = Yii::$app->basePath . '/uploads/';

        if($model->load(Yii::$app->request->post()))
        {
            $file = UploadedFile::getInstance($model, 'importData');
            $filename = 'proccesar.' . $file->extension;
            $upload = $file->saveAs($ruta . '' . $filename);
            $estructuraCargueError = [];

            if($upload)
            {
                $estructuraCargue = array("idProducto", "idSubCategoria", "nomProducto");

                $data = \moonland\phpexcel\Excel::widget([
                    'mode' => 'import',
                    'fileName' => $ruta."/".$filename,
                    'setFirstRecordAsKeys' => true,
                    'setIndexSheetByName' => true,
                    'getOnlySheet' => 'sheet1',
                ]);

                foreach ($data[0] as $key => $value)
                {
                    if(!in_array($key, $estructuraCargue))
                    {
                        $estructuraCargueError[] = "Error en la estructra, fila #1 columna ". $key ." mal escrtio";
                    }
                }

                if(count($estructuraCargueError) > 0)
                {
                    Yii::$app->session->setFlash('danger', $estructuraCargueError);
                } else {

                    $i = 0;
                    $updates = 0;
                    $creates = 0;
                    $saveErrors = 0;
                    $rowsErrors = [];

                    foreach($data as $key => $rows)
                    {
                        $i++;

                        $valido = Productos::find()->where(['idProducto' => $rows['idProducto']])->one();
                        if($valido != NULL)
                        {
                            $modelNew = $valido;
                            $modelNew->idSubCategoria = $rows['idSubCategoria'];
                            $modelNew->nomProducto = $rows['nomProducto'];

                            if($modelNew->validate() === false)
                            {
                                foreach($modelNew->getErrors() as $key => $value) {
                                    $rowsErrors[] = "Fila #". $i ." columna ". $key ." ". $value[0];
                                }

                                $modelNew->getErrors();
                            } else {
                                if($modelNew->save())
                                {
                                    $updates++;
                                } else {
                                    $saveErrors++;
                                }
                            }

                        } else {
                            $modelNew = new Productos();
                            $modelNew->idSubCategoria = $rows['idSubCategoria'];
                            $modelNew->nomProducto = $rows['nomProducto'];

                            if($modelNew->validate() === false)
                            {
                                foreach($modelNew->getErrors() as $key => $value) {
                                    $rowsErrors[] = "Fila #". $i ." columna ". $key ." ". $value[0];
                                }
                            } else {
                                if($modelNew->save())
                                {
                                    $creates++;
                                } else {
                                    $saveErrors++;
                                }
                            }
                        }
                    }

                    if(count($rowsErrors) > 0)
                    {
                        Yii::$app->session->setFlash('warning', 'Total registros: '. count($data) .', Creados: '. $creates .', Editados: '. $updates);
                        Yii::$app->session->setFlash('danger', $rowsErrors);
                    } else {
                        Yii::$app->session->setFlash('success', 'Total registros: '. count($data) .', Creados: '. $creates .', Editados: '. $updates);
                        return $this->redirect(['productos/index']);
                    }
                }
            }
        }

        return $this->render('upload', [
            'model' => $model, 'prueba' => 'hola mundo']);
    }

    /**
     * Displays a single Productos model.
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
     * Creates a new Productos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idProducto]);
        }

        return $this->render('create', [
            'model' => $model, 'subCategoriaListAll' => $this->subCategoriasListAll(),
        ]);
    }

    /**
     * Updates an existing Productos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $estadoProducto = array("1" => "Activo", "0" => "Inactivo");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idProducto]);
        }

        return $this->render('update', [
            'model' => $model, 'subCategoriaListAll' => $this->subCategoriasListAll(), 'estadoProducto' => $estadoProducto,
        ]);
    }

    /**
     * Deletes an existing Productos model.
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
     * Finds the Productos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
