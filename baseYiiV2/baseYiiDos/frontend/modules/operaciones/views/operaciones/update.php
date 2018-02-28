<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Operaciones */

$this->title = Yii::t('app', 'Update Operaciones: {nameAttribute}', [
    'nameAttribute' => $model->nomOperacion,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nomOperacion, 'url' => ['view', 'id' => $model->idOperacion]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="operaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
