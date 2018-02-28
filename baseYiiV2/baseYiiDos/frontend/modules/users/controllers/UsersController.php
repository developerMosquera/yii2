<?php

namespace frontend\modules\users\controllers;

use Yii;
use common\models\User;
use frontend\models\search\UsersSearch;
use frontend\controllers\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\Roles;
use yii\helpers\ArrayHelper;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends BaseController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $roles = ArrayHelper::map(Roles::find()->all(), 'idRol', 'nomRol');

        if($model->load(Yii::$app->request->post())) {

            $model->generateAuthKey();
            $model->created_at = strtotime("now");
            $model->updated_at = strtotime("now");
            $model->status = 10;

            if(!$model->validate())
            {
                $model->password_hash = "";
                $model->password_repeat = "";

            } else {
                $model->setPassword($model->password_hash);
                $model->password_repeat = $model->password_hash;
                if(!$model->save())
                {
                    $model->password_hash = "";
                    $model->password_repeat = "";
                } else {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,'roles' => $roles,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $roles = ArrayHelper::map(Roles::find()->all(), 'idRol', 'nomRol');

        if($model->load(Yii::$app->request->post())) {

            $model->generateAuthKey();
            $model->created_at = strtotime("now");
            $model->updated_at = strtotime("now");
            $model->status = 10;

            if(!$model->validate())
            {
                $model->password_hash = "";
                $model->password_repeat = "";

            } else {
                $model->setPassword($model->password_hash);
                $model->password_repeat = $model->password_hash;
                if(!$model->save())
                {
                    $model->password_hash = "";
                    $model->password_repeat = "";
                } else {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        $model->password_hash = "";

        return $this->render('update', [
            'model' => $model, 'roles' => $roles,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
