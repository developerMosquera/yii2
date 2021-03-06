<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Roles */

$this->title = Yii::t('app', 'Create Roles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="roles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'operaciones' => $operaciones,
    ]) ?>

</div>
