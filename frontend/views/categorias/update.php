<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Categorias */

$this->title = Yii::t('app', 'Update Categorias: {nameAttribute}', [
    'nameAttribute' => $model->idCategoria,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idCategoria, 'url' => ['view', 'id' => $model->idCategoria]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="categorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'estadoCategoria' => $estadoCategoria,
    ]) ?>

</div>
