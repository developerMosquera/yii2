<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SubCategoria;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */

$this->title = $model->idProducto;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productos-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idProducto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idProducto], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProducto',
            [
                'attribute' => 'idSubCategoria',
                'value' => SubCategoria::findOne($model->idSubCategoria)->SubCategoria
            ],
            'nomProducto',
            [
                'attribute' => 'estadoProducto',
                'value' => ($model->estadoProducto == 1) ? Yii::t('app', 'Activo') : Yii::t('app', 'Inactivo')
            ]
        ],
    ]) ?>

</div>
