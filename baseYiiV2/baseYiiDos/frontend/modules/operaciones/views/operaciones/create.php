<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Operaciones */

$this->title = Yii::t('app', 'Create Operaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
