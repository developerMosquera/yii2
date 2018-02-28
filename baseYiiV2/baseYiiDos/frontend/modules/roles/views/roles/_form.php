<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Roles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="roles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nomRol')->textInput(['maxlength' => true]) ?>

    <?=$form->field($model, 'operacionesRol')->checkboxList($operaciones, [
	    	'unselect'=>NULL,
	    	'itemOptions' => [
	            'labelOptions' => ['class' => 'col-md-3']
	        ],
	    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
