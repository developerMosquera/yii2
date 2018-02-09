<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sub-categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idCategoria')->dropDownList($categoriasListAll) ?>

    <?= $form->field($model, 'SubCategoria')->textInput(['maxlength' => true]) ?>

    <?php
    if($model->getIsNewRecord() === false) {
        echo $form->field($model, 'estadoSubCategoria')->dropDownList($estadoSubCategoria);
    }
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
