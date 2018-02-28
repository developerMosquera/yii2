<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Productos */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'idSubCategoria')->dropDownList($subCategoriaListAll) ?>

    <?= $form->field($model, 'idSubCategoria')->dropDownList($subCategoriaListAll) ?>
    <?=
        dosamigos\formhelpers\Select::widget([
            'model' => $model,
            'attribute' => 'idSubCategoria',
            'items' => $subCategoriaListAll,
            // for all possible client options, please see
            // http://bootstrapformhelpers.com/select/#jquery-plugins
            'clientOptions' => [
                'filter' => 'true', // boolean must be as a string
                'multiple' => 'multiple'
            ]
        ]);
    ?>

    <?= $form->field($model, 'nomProducto')->textInput(['maxlength' => true]) ?>

    <?php
    if($model->getIsNewRecord() === false)
    {
        echo $form->field($model, 'estadoProducto')->dropDownList($estadoProducto);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
