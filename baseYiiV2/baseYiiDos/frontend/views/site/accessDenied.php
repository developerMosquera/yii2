<?php

/**
 * @Author: amosquera
 * @Date:   2018-02-26 14:37:58
 * @Last Modified by:   amosquera
 * @Last Modified time: 2018-02-27 14:29:01
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = "No permitido";
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
    <p>No tiene permiso para acceder a esta página.</p>
    </div>
</div>