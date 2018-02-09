<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Categorias;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategoria */

$this->title = $model->idSubCategoria;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-categoria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->idSubCategoria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->idSubCategoria], [
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
            'idSubCategoria',
            [
                'attribute' => 'idCategoria',
                'value' => Categorias::findOne($model->idCategoria)->Categoria
            ],
            'SubCategoria',
            [
                'attribute' => 'estadoSubCategoria',
                'value' => ($model->estadoSubCategoria == 1) ? Yii::t('app', 'Activo') : Yii::t('app', 'Inactivo')
            ]
        ],
    ]) ?>

</div>
