<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\models\Categorias;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SubCategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sub Categorias');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="sub-categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Sub Categoria'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idSubCategoria',
            ['attribute' => 'idCategoria',
                'value' => function($model){
                    $categorias = Categorias::findOne($model->idCategoria);
                    return $categorias->Categoria;
                },
                'filter' => ArrayHelper::map(Categorias::find()->all(), 'idCategoria', 'Categoria'),
            ],
            'SubCategoria',
            ['attribute' => 'estadoSubCategoria',
                'value' => function($model){
                    return($model->estadoSubCategoria == 1) ? Yii::t('app', 'Activo') : Yii::t('app', 'Inactivo');
                },
                'filter' =>  array("1" => "Activo", "0" => "Inactivo"),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
