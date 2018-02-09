<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategoria */

$this->title = Yii::t('app', 'Update Sub Categoria: {nameAttribute}', [
    'nameAttribute' => $model->idSubCategoria,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub Categorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idSubCategoria, 'url' => ['view', 'id' => $model->idSubCategoria]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sub-categoria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'categoriasListAll' => $categoriasListAll, 'estadoSubCategoria' => $estadoSubCategoria,
    ]) ?>

</div>
