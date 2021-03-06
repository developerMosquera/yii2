<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

/*** Adiciona el archivo skinaTour para indicar el funcionamiento de la aplicaión ***/
/************************************************************************************/
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/skinaTour.js', ['depends' => [\yii\web\JqueryAsset::className(), yii\bootstrap\BootstrapPluginAsset::className()]]);
/*** Fin  ***/
/************/

if ((Yii::$app->controller->action->id === 'login') || (Yii::$app->controller->action->id === 'signup') || (Yii::$app->controller->action->id === 'confirm') || (Yii::$app->controller->action->id === 'request-password-reset') || (Yii::$app->controller->action->id === 'reset-password')) {
/**
 * Do not use this code in your template. Remove it.
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="<?= \dmstr\helpers\AdminLteHelper::skinClass() ?>">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
