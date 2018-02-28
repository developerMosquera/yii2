<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-26 17:09:08
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-26 17:27:00
 */
use yii\helpers\Html;
?>

<?php
if(isset($result) && $result === true)
{
?>
	<div class="container" style="margin-top: 20px;">
		<div class="alert alert-success" role="alert" style="text-align: center;">
		  Activación completada con exito, <?= Html::a('continuar', ['/site/login']);
                ?>
		</div>
	</div>
<?php
} else {
?>
	<div class="container" style="margin-top: 20px;">
		<div class="alert alert-danger" role="alert" style="text-align: center;">
		  Ha ocurrido un error en el proceso, <?= Html::a('salir', ['/site/login']); ?>
		</div>
	</div>
<?php
}
?>