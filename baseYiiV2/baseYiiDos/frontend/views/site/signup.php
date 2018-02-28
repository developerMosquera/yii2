<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

if(isset($mailTrue) && $mailTrue == true)
{
    $model->password_hash = "";
    $model->password_repeat = "";
?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info" role="alert" style="text-align: center;">
                <b>Se envio un link al correo <i style="text-decoration: underline;"><?= $model->email; ?></i> para realizar la activación de la cuenta</b>
            </div>
        </div>
    </div>
<?php
}
?>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-success">
            <div class="panel-body">

                <h1><?= Yii::t('app', 'Signup') ?></h1>

                <div class="site-signup">
                    <p><?= Yii::t('app', 'Please fill out the following fields to signup:') ?></p>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                                <?= $form->field($model, 'username')->textInput() ?>

                                <?= $form->field($model, 'email') ?>

                                <?= $form->field($model, 'password_hash')->passwordInput() ?>

                                <?= $form->field($model, 'password_repeat')->passwordInput() ?>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <div class="form-group">
                                            <?= Html::submitButton('Register', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'signup-button']) ?>
                                        </div>
                                    </div>
                                </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-4">
                            <?= Html::a('Sing in', ['/site/login'], ['class' => 'btn btn-primary btn-block btn-flat']);
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>