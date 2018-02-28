<?php
/**
 * @Author: amosquera
 * @Date:   2018-02-19 11:12:42
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-19 12:03:24
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="productos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'importData')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>